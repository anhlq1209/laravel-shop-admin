@extends('main')

@section('head')
    <script src="../../template/js/my-script.js"></script>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <form action="/category/update/{{ $category['id'] }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Edit category</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Category name</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ $category['name'] }}">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="/categories" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Save" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
@endsection