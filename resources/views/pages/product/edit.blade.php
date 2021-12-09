@extends('main')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="/template/css/my-style.css">
@endsection

@section('footer')
    <script src="/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>
    <script src="/template/js/my-script.js"></script>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <form action="/product/update/{{ $product['id'] }}" method="post">
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
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Avatar</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group avatar--full">
                                <img class="img-avatar" src="{{ $product['avatar'] }}" alt="">
                            </div>
                            <div class="form-group avatar-upload">
                                <label for="avatar">Change avatar</label>
                                <div class="avatar-upload-select">
                                    <div class="avatar-select-button">Choose File</div>
                                    <div class="avatar-select-name">No file chosen...</div> 
                                    <input type="file" name="avatar" class="input-avatar" accept="image/*">
                                </div>
                            </div>
                        </div>
                      <!-- /.card-body -->
                    </div>
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Add images</h3>
            
                            <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="group-images">
                                <label for="avatar">Change avatar</label>
                                <div class="form-group image-upload-mul">
                                    <div class="image-upload-select">
                                        <div class="image-select-button">Choose File</div>
                                        <div class="image-select-name">No file chosen...</div> 
                                        <input type="file" name="images[]" class="input-image" accept="image/*">
                                    </div>
                                    <div class="image-remove">
                                        <i class="fas fa-times"></i>
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group">
                                <div id="add-file-image" class="btn btn-secondary">Add</div>
                            </div>
                        </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="/products" class="btn btn-secondary">Cancel</a>
                    <input type="submit" id="save" value="Save" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
@endsection