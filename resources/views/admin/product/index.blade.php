@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Лента данных от {{ $prod_data['lst']->created_at }}</h4>
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
                            <a class="btn btn-primary" id="prod_add" href="{{ route('admin.product.create') }}">Добавить</a>
                        </div>
                        <form id="prod_form" class="input-group" action="{{ route('admin.allproduct.index') }}" method="post">
                            @csrf
                            <select name="data" class="form-select" aria-label="Default select example">
                                @foreach($prod_data['m_res'] as $res)
                                    <option {{$res === $prod_data['now_data'] ? 'selected' : ''}}
                                    value="{{ $res }}">{{ $res }}</option>
                                @endforeach
                            </select>
                                <button type="submit" class="form-control btn btn-success" id="prod_sel">Выбрать</button>
                        </form>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Дата</th>
                                    <th>Добавил<br>данные</th>
                                    <th>Сырого<br>брикета<br>(день), кг</th>
                                    <th>Количество<br>заложенного<br>в печь<br>(день), кг</th>
                                    <th>Упаковано<br>1 сорт<br>(день), кг</th>
                                    <th>Упаковано<br>2 сорт<br> (день), кг</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            <a href="{{ route('admin.product.show', $product->id) }}">{{ $product->created_at }}</a>
                                        </td>
                                        <td>{{ $product->user->name ?? 'Неизвестно'}}</td>
                                        <td>{{ $product->briquette }}</td>
                                        <td>{{ $product->bake }}</td>
                                        <td>{{ $product->packed_1 }}</td>
                                        <td>{{ $product->packed_2 }}</td>
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
        var  btn1 = document.querySelector('#prod_add');
        var  btn2 = document.querySelector('#prod_sel');
        var  form_sel = document.querySelector('#prod_form');

        btn1.onclick = function (){
                document.querySelector('#prod_add').disabled = true;
                document.querySelector('#prod_add').innerHTML = `<span class="spinner-border spinner-border-sm"></span> Переходим..`;
        }
        btn2.onclick = function (){
            form_sel.submit();
                document.querySelector('#prod_sel').disabled = true;
                document.querySelector('#prod_sel').innerHTML = `<span class="spinner-border spinner-border-sm"></span> Выбираем..`;
        }
    </script>
@endsection
