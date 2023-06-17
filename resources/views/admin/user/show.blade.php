@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Пользователь</h4>
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
                        <div class="card-header d-flex">
                            <div class="m-1">
                                <a class="btn btn-success" href="{{ route('admin.user.edit', $user->id) }}">Редактировать</a>
                            </div>
                            <form class="m-1" action="{{ route('admin.user.delete', $user->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" value="Удалить" class="btn btn-danger">
                            </form>
                        </div>

                        <div class="card-body table-responsive">
                            <table class="table table-hover text-nowrap">
                                <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $user->id }} </td>
                                </tr>
                                <tr>
                                    <td>Имя</td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td>Пароль</td>
                                    <td>{{ $user->nohash_password }}</td>
                                </tr>
                                <tr>
                                    <td>Роль</td>
                                    <td>{{ $user->role }}</td>
                                </tr>
                                <tr>
                                    <td>Ключ</td>
                                    <td>{{ $user->key }}</td>
                                </tr>
                                <tr>
                                    <td>Активирован</td>
                                    <td>{{ $user->active }}</td>
                                </tr>
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
@endsection
