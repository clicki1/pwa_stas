@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Данные от {{ $product->created_at }}</h4>
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
                            <div  class="m-1">
                                <a class="btn btn-success" href="{{ route('admin.product.edit', $product->id) }}">Редактировать</a>
                            </div>
                            <form  class="m-1" action="{{ route('admin.product.delete', $product->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" value="Удалить" class="btn btn-danger">
                            </form>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $product->id }} </td>
                                </tr>
                                <tr>
                                    <td>Дата</td>
                                    <td>{{ $product->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Пользователь</td>
                                    <td>{{ $product->user->name ?? 'Неизвестно' }}</td>
                                </tr>
                                <tr>
                                    <td>Сырого брикета (день), кг</td>
                                    <td>{{ $product->briquette }}</td>
                                </tr>
                                <tr>
                                    <td>Количество заложенного в печь (день), кг</td>
                                    <td>{{ $product->bake }}</td>
                                </tr>
                                <tr>
                                    <td>Упаковано 1 сорт (день), кг</td>
                                    <td>{{ $product->packed_1 }}</td>
                                </tr>
                                <tr>
                                    <td>Упаковано 2 сорт (день), кг</td>
                                    <td>{{ $product->packed_2 }}</td>
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
