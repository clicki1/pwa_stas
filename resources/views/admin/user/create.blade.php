@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Добавить пользователя</h4>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row w-50">
                <form id="user_form" action="{{ route('admin.user.store') }}" method="post">
                    @csrf
                    <div class="form-group pt-1">
                        <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Имя">
                    </div>
                    <div class="form-group pt-1">
                        <input id="email" type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group pt-1">
                        <input id="password" type="text" name="password" value="{{ old('password') }}" class="form-control" placeholder="Пароль">
                    </div>
                    <div class="form-group pt-1">
                        <input id="password_confirmation" type="text" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control" placeholder="Повторить Пароль">
                    </div>
                    <div class="form-group pt-1">
                        <select  name="role" class="custom-select form-control" id="selectUsername">
                            <option disabled selected>Роль</option>
                            <option {{ old('role') == 'admin' ? 'selected' : '' }} value="admin">АДМИН</option>
                            <option {{ old('role') == 'worker' ? 'selected' : '' }} value="worker">Рабочий</option>
                        </select>
                    </div>
                    <div class="form-group pt-1">
                        <input type="checkbox" class="btn-check" name="active" id="btn-check-2" {{ old('active') == 'on' ? 'checked' : '' }} autocomplete="off">
                        <label class="btn btn-outline-success" for="btn-check-2">Активировать</label>
                    </div>

                    <div class="form-group pt-3">
                        <button id="btn_user" type="submit" class="btn btn-primary">Добавить</button>
                    </div>

                </form>
            </div>
            <!-- /.row -->

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <script>
        var  btn_user = document.querySelector('#btn_user');
        var  user_form = document.querySelector('#user_form');
        var  name = document.querySelector('#name');
        var  email = document.querySelector('#email');
        var  password = document.querySelector('#password');
        var  password_confirmation = document.querySelector('#password_confirmation');

        btn_user.onclick = function (){
                user_form.submit();
                btn_user.disabled = true;
                btn_user.innerHTML = `<span class="spinner-border spinner-border-sm"></span>  Отправляем..`;
        }
    </script>
@endsection
