@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Пользователи</h4>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a id="user_btn" class="btn btn-primary" href="{{ route('admin.user.create') }}">Добавить</a>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Имя</th>
                                    <th>Email</th>
                                    <th>Пароль</th>
                                    <th>Роль</th>
                                    <th>Ключ</th>
                                    <th>Активирован</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr class=" {{ $user->active == 'on' ? 'table-success' : 'table-danger' }} table-success">
                                        <td>{{ $user->id }}</td>
                                        <td>
                                            <a href="{{ route('admin.user.show', $user->id) }}">{{ $user->name }}</a>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->nohash_password }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>{{ $user->key }}</td>
                                        <td>{{ $user->active}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
            <!-- /.row -->

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <script>
        var  user_btn = document.querySelector('#user_btn');

        user_btn.onclick = function (){

            user_btn.disabled = true;
            user_btn.innerHTML = `<span class="spinner-border spinner-border-sm"></span> Переходим..`;
        }
    </script>
@endsection
