@extends('main')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@endsection

@section('footer')
    <script src="/public/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>
    {{-- <script src="/public/template/js/my-script.js"></script> --}}
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <form action="/public/product/update/{{ $product['id'] }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Edit</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="idEdit">Id</label>
                                <input type="text" id="idEdit" name="id" class="form-control" value="{{ $product['id'] }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="name">Product name</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ $product['name'] }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Product description</label>
                                <textarea id="description" name="description" class="form-control" rows="10">{!! $product['description'] !!}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputStatus">Category</label>
                                <select id="inputStatus" name="category_id" class="form-control custom-select">
                                    <option disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category['id'] }}" {{ $product['category_id'] == $category['id'] ? 'selected' : ''; }}>{{ $category['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" id="price" name="price" class="form-control" value="{{ $product['price'] }}">
                            </div>
                        </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Avatar of product</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="form-group avatar-show">
                                    <div id="avatar-show" style="background-image: url({{ $product['avatar'] }})"></div>
                                </div>
                                <div class="form-group avatar-upload">
                                    <div class="avatar-upload-select">
                                        <div class="avatar-select-button">Choose File</div>
                                        <div class="avatar-select-name">No file chosen...</div> 
                                        <input type="file" name="avatarEdit" id="avatarEdit" class="input-avatar" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Image added</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="imageAdded">
                                    @foreach ($images as $image)
                                        <div class="added" style="background-image: url({{ $image['image'] }})" rel="{{ $image['id'] }}">
                                            <span>remove</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Add image</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="images">
                                    <div class="pic">
                                        add
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="/public/products" class="btn btn-secondary">Cancel</a>
                    <input type="submit" id="save" value="Save" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
@endsection