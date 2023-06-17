@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Таблицы</h4>
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
                        <div class="card-header input-group">
                            <form id="excel_form"  action="{{ route('admin.excel') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input hidden name="data" type="text" value="{{ $prod_data['now_data'] }}">
                                <button id="excel_btn" type="submit" class="btn btn-success">Скачать в Excel за {{$prod_data['now_data']}}</button>
                            </form>
                        </div>
                        <form id="post_form" class="input-group" action="{{ route('admin.table.post') }}" method="post">
                            @csrf
                            <select name="data" class="form-select" aria-label="Default select example">
                                @foreach($prod_data['m_res'] as $res)
                                    <option {{$res === $prod_data['now_data'] ? 'selected' : ''}}
                                            value="{{ $res }}">{{ $res }}</option>
                                @endforeach
                            </select>
                            <button id="post_btn" class="btn btn-success" type="submit" >Выбрать</button>
                        </form>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                {{--                                <tr>--}}
                                {{--                                    <th>2023</th>--}}

                                {{--                                </tr>--}}
                                </thead>
                                <tbody>
                                @foreach($arrs_filter as $key1 => $res_arr)
                                    <tr>
                                    @foreach($res_arr as $key2 => $res)

                                            <td>{{ $res }}</td>


                                    @endforeach
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
        var  post_btn = document.querySelector('#post_btn');
        var  post_form = document.querySelector('#post_form');

        var  excel_btn = document.querySelector('#excel_btn');
        var  excel_form = document.querySelector('#excel_form');

        excel_btn.onclick = function (){
            excel_form.submit();
            excel_btn.disabled = true;
            excel_btn.innerHTML = `<span class="spinner-border spinner-border-sm"></span> Загружаем..`;
            setTimeout(() => {
                excel_btn.disabled = false;
                excel_btn.innerHTML = `Скачать в Excel за {{$prod_data['now_data']}}`;
            }, "3000");
        }
        post_btn.onclick = function (){
            post_form.submit();
            post_btn.disabled = true;
            post_btn.innerHTML = `<span class="spinner-border spinner-border-sm"></span> Выбираем..`;
        }
    </script>
@endsection
