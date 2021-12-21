@extends('main')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@endsection

@section('footer')
    <script src="/public/template/js/my-script.js"></script>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Categories</h3>

                <div class="card-tools">
                    <a class="btn btn-success btn-sm" href="/public/category/create">
                        <i class="fas fa-plus"></i>
                        New category
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 2%">
                                #
                            </th>
                            <th style="width: 20%">
                                Category name
                            </th>
                            <th style="width: 20%">
                                Avatar
                            </th>
                            <th style="width: 20%">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>
                                    {{ $category['id'] }}
                                </td>
                                <td>
                                    <a>{{ $category['name'] }}</a>
                                </td>
                                <td>
                                    <div class="avatar" style="background-image: url({{ $category['avatar'] }})"></div>
                                </td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm" href="/public/category/edit/{{ $category['id'] }}">
                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                    <button class="btn btn-danger btn-sm btn-del-cate" value="{{ $category['id'] }}">
                                        <i class="fas fa-trash"></i>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection