@extends('layouts.admin')

@section('title')
    <title>Permissions</title>
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('partials.content-header', ['name'=>'Permission', 'key'=>'Add'])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('permissions.update',['id'=>$permission->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Permission name</label>
                                <input type="text"
                                       class="form-control "
                                       placeholder="example: add product"
                                       name="name"
                                       value="{{$permission->name}}"
                                >
                            </div>

                            <div class="form-group">
                                <label>Parent permission</label>
                                <select class="form-control"
                                        name="parent_id">
                                    <option value="0">Itself</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Permission description</label>
                                <input type="text"
                                       class="form-control "
                                       placeholder="example: Them san pham"
                                       name="display_name"
                                       value="{{$permission->display_name}}"
                                >
                            </div>
                            <div class="form-group">
                                <label>Permission key_code</label>
                                <input type="text"
                                       class="form-control "
                                       placeholder="example: product_add"
                                       name="key_code"
                                       value="{{$permission->key_code}}"
                                >
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

