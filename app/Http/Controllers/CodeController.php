<?php

namespace App\Http\Controllers;

use App\Http\Requests\CodeAddRequest;
use App\Http\Requests\CodeUpdateRequest;
use App\Models\Code;
use App\Models\Order;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;
use Yajra\DataTables\Facades\DataTables;

class CodeController extends Controller
{
    use DeleteModelTrait;
    private $code;
    public function __construct(Code $code)
    {
        $this->code =$code;
    }

    //
    public function  index(){
        return view('admin.code.index');
    }
    public function api()
    {
//        return Datatables::of(Code::query())->make(true);
        return DataTables::of(Code::query())
            ->addIndexColumn()
            ->editColumn('created_at', function ($code) {
                return $code->created_at->format('Y-m-d | H:i');
            })
            ->editColumn('updated_at', function ($code) {
                return $code->updated_at->format('Y-m-d | H:i');
            })
            ->editColumn('is_enable', function ($code) {
                return $code->is_enable==1  ?'Enable'." [".$code->is_enable ."]":'Disable' ." [".$code->is_enable ."]";
            })
            ->editColumn('discount', function ($code) {
                return $code->discount . " %";
            })
            ->addColumn('edit', function ($code) {
                return route('codes.edit', ['id' => $code->id]);
            })
            ->addColumn('delete', function ($code) {
                return route('codes.delete', ['id' => $code->id]);
            })
            ->make(true);
    }

    public function check_code(Request $request): JsonResponse
    {
        try {
            $data = $request->all();
            $couponCode = $data['coupon_code'];
            $coupon = Code::where('code',Str::upper($couponCode))
                ->where('is_enable',1)
                ->first();
            if($coupon){
                $discount = $coupon->discount;
                return response()->json([
                    'code' => 200,
                    'message' => 'success',
                    'discount' => $discount,
                    'code_id' => $coupon->id,
                ]);
            }
            else{
                return response()->json([
                    'code' => 204 ,
                    'message' => 'success',
                ]);
            }
        } catch (\Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . '----Line: ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'failed',
            ],500);
        }

    }
    public function create(){
        return view('admin.code.add');
    }
    public function  store(CodeAddRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $newCode = [
                'code' => Str::upper($request->code),
                'discount' => $request->discount,
                'is_enable' => $request->is_enable,
                'description' => $request->description,
            ];
            Code::updateOrCreate(
                ['code' => Str::upper($request->code)],
                $newCode
            );
            DB::commit();
            $resMessage = 'Thêm thành công!';
            return redirect()->route('codes.create')->with('success', $resMessage);
        } catch (\Exception $exception) {
            DB::rollBack();
            $resMessage = 'Thêm thất bại!';
            Log::error('Message: ' . $exception->getMessage() . '----Line: ' . $exception->getLine());
            return redirect()->route('codes.create')->with('failure', $resMessage);

        }
    }

    public function edit($id){
        $code = $this->code->find($id);
        return view('admin.code.edit', [
            'code' => $code,
        ]);
    }
    public function update($id, CodeUpdateRequest $request){
        $this->code->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->slug)
        ]);
        return redirect()->route('codes.index');

    }
    public function delete($id){
        return $this->deleteModelTrait($id, $this->code);
    }

}
