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

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Projects</h3>

                <div class="card-tools">
                    <a class="btn btn-success btn-sm" href="/product/create">
                        <i class="fas fa-plus"></i>
                        New product
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 2%" class="text-center">
                                #
                            </th>
                            <th style="width: 38%" class="text-center">
                                Product name
                            </th>
                            <th style="width: 10%" class="text-center">
                                Avatar
                            </th>
                            <th style="width: 10%" class="text-center">
                                Category
                            </th>
                            <th style="width: 10%" class="text-center">
                                Price
                            </th>
                            <th style="width: 10%" class="text-center">
                                Likes
                            </th>
                            <th style="width: 20%">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    {{ $product['id'] }}
                                </td>
                                <td>
                                    <a>{{ $product['name'] }}</a>
                                </td>
                                <td>
                                    <div class="avatar" style="background-image: url({{ $product['avatar'] }})"></div>
                                    {{-- <img src="{{ $product['avatar'] }}" /> --}}
                                </td>
                                <td class="project-state">
                                    {{ $product['category_id'] }}
                                </td>
                                <td class="project_progress">
                                    {{ $product['price'] }}
                                </td>
                                <td class="project-state">
                                    {{ $product['count_likes'] }}
                                </td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm" href="/product/edit/{{ $product['id'] }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <button class="btn btn-danger btn-sm btn-del-pro" value="{{ $product['id'] }}">
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