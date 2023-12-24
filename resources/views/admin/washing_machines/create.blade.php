@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1>Категории стиральных машин</h1>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Добавить новую стиральную машину</h3>
            </div>
            <form role="form" method="post" action="{{ route('washing_machines.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="id_dom">Общежитие</label>
                        <select class="form-control @error('id_dom') is-invalid @enderror" id="id_dom" name="id_dom">
                            @foreach($dormitories as $k => $v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date_check">Дата последней проверки</label>
                        <input type="date" class="form-control @error('date_check') is-invalid @enderror" id="date_check" name="date_check">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </form>
        </div>
    </section>
@endsection

