@extends('main')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="/template/css/my-style.css">
@endsection

@section('footer')
    <script src="/template/js/my-script.js"></script>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <form action="/category/store" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">New Category</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Category name</label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Avatar of Category</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="form-group avatar-show">
                                    <div id="avatar-show"></div>
                                </div>
                                <div class="form-group avatar-upload">
                                    <div class="avatar-upload-select">
                                        <div class="avatar-select-button">Choose File</div>
                                        <div class="avatar-select-name">No file chosen...</div> 
                                        <input type="file" name="avatar" id="avatar" class="input-avatar" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="/categories" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="New" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
@endsection