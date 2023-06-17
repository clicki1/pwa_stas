@extends('layouts.app')

@section('content')
    <h3 class="p-3 text-danger">Вы не активированный пользователь, обратитесь к администратору</h3>
    <form  action="{{ route('logout') }}" method="POST">
        @csrf
        <button  href="{{route('logout')}}" type="submit" class="btn btn-lg btn-warning m-3">Выйти</button>
    </form>
@endsection
