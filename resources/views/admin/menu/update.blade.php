
@extends('layouts.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('partials.content-header', ['name'=>'Menu', 'key'=>'Update'])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('menus.update', ['id' => $menu->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Ten danh muc</label>
                                <input type="text"
                                       class="form-control"
                                       placeholder="nhap ten danh muc"
                                       name="name"
                                       value="{{$menu->name}}"
                                >

                                <div class="form-group">
                                    <label>Chon danh muc cha</label>
                                    <select class="form-control"
                                            name="parent_id">
                                        <option value="0">Chon danh muc cha</option>
                                        {!! $htmlOption !!}
                                    </select>
                                </div>
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

