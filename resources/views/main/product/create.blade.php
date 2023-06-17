@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Добавить данные</h4>
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
                <form id="prod_form" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group pt-1">
                        <input type="number" id="briquette" name="briquette" value="{{ old('briquette') }}" class="form-control "
                               placeholder="Сырого брикета (день), кг">
                    </div>
                    <div class="form-group pt-1">
                        <input type="number" id="bake" name="bake" value="{{ old('bake') }}" class="form-control "
                               placeholder="Количество заложенного в печь (день), кг">
                    </div>
                    <div class="form-group pt-1">
                        <input type="number" id="packed_1" name="packed_1" value="{{ old('packed_1') }}" class="form-control "
                               placeholder="Упаковано 1 сорт (день), кг">
                    </div>
                    <div class="form-group pt-1">
                        <input type="number" id="packed_2" name="packed_2" value="{{ old('packed_2') }}" class="form-control "
                               placeholder="Упаковано 2 сорт (день), кг">
                    </div>
                    <div class="form-group pt-3">
                        <button type="submit" class="btn btn-primary btn-lg" id="prod_btn">Отправить</button>
                    </div>
                </form>
            </div>
            <!-- /.row -->

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <script>
        var  btn = document.querySelector('#prod_btn');
        var  briquette = document.querySelector('#briquette');
        var  bake = document.querySelector('#bake');
        var  packed_1 = document.querySelector('#packed_1');
        var  packed_2 = document.querySelector('#packed_2');
        var  prod_form = document.querySelector('#prod_form');
        btn.onclick = function (){
            if(briquette.value && bake.value && packed_1.value && packed_2.value){
                prod_form.submit();
                document.querySelector('#prod_btn').disabled = true;
                document.querySelector('#prod_btn').innerHTML = `<span class="spinner-border spinner-border-sm"></span> Отправка данных`;
                console.log('yes');
            }
            console.log('no');
        }
    </script>
@endsection
