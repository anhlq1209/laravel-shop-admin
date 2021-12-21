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
        <div class="row">
            <div class="col-6">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th style="width: 2%">
                                        #
                                    </th>
                                    <th style="width: 20%">
                                        Name
                                    </th>
                                    <th style="width: 20%">
                                        Email
                                    </th>
                                    
                                    <th style="width: 20%">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            {{ $user['id'] }}
                                        </td>
                                        <td>
                                            <a>{{ $user['name'] }}</a>
                                        </td>
                                        <td>
                                            <a>{{ $user['email'] }}</a>
                                        </td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-danger btn-sm" href="/public/user/upgrade/{{ $user['id'] }}">
                                                <i class="fas fa-fire"></i>
                                                Upgrade to admin
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-6">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Admin</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th style="width: 2%">
                                        #
                                    </th>
                                    <th style="width: 20%">
                                        Name
                                    </th>
                                    <th style="width: 20%">
                                        Email
                                    </th>
                                    
                                    <th style="width: 20%">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            {{ $user['id'] }}
                                        </td>
                                        <td>
                                            <a>{{ $user['name'] }}</a>
                                        </td>
                                        <td>
                                            <a>{{ $user['email'] }}</a>
                                        </td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-info btn-sm" href="/public/user/upgrade/{{ $user['id'] }}">
                                                <i class="fas fa-tint"></i>
                                                Demote to user
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    </section>
    <!-- /.content -->
@endsection