@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Изменить данные пользователя</h4>
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
                <form action="{{ route('admin.user.update', $user->id) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="form-group pt-1">
                        <input type="text" name="name" value="{{ $user->name ?? old('name') }}" class="form-control" placeholder="Имя">
                    </div>
                    <div class="form-group pt-1">
                        <select name="role" class="custom-select form-control" id="selectUsername">
                            <option disabled selected>Роль</option>
                            <option {{ $user->role == 'admin' || old('admin') == 'admin' ? 'selected' : '' }} value="admin">АДМИН</option>
                            <option {{ $user->role == 'worker' || old('worker') == 'worker' ? 'selected' : '' }} value="worker">Рабочий</option>
                        </select>
                    </div>
                    <div class="form-group pt-1">
                        <input type="checkbox" class="btn-check" name="active" id="btn-check-2" {{ $user->active == 'on' || old('active') == 'on' ? 'checked' : '' }} autocomplete="off">
                        <label class="btn btn-outline-success" for="btn-check-2">Активировать</label>
                    </div>
                    <div class="form-group pt-1">
                        <input type="submit" class="btn btn-primary" value="Внести изменения">
                    </div>
                </form>
            </div>
            <!-- /.row -->

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
