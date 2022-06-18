<?php

namespace App\Http\Controllers\customers;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use App\Traits\StorageImageTraits;
use Illuminate\Http\Request;

class UserController extends Controller
{   use StorageImageTraits;
    //
    public function show()
    {
        try {
            $user_info = UserProfile::where('user_id', auth()->user()->id)->first();
            return view('profile.user-profile',[
                'userInfo' => $user_info
            ]);
        }
        catch (\Exception $exception){
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'phone_number' => $request->phone,
                'address' => $request->address,
                'name' => $request->name,
                'gender' => $request->gender,
            ];
            if ($request->hasFile('avt_image')) {
                $image_file = $request->avt_image;
                $product_image_info = $this->getUploadedImageInfo($image_file, 'avatars');
                if (!empty($product_image_info)) {
                    $data['image_path'] = $product_image_info['file_path'];
                    $data['image_name'] = $product_image_info['file_name'];
                }
            }
            UserProfile::updateOrCreate(
                ['user_id'=> auth()->user()->id],
                $data
            );
            return redirect()->back();
        }
        catch (\Exception $exception){
            return redirect()->back();
        }
    }
}
