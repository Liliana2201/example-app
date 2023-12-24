@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1>Категории заявок</h1>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Добавить новую категорию</h3>
            </div>
            <form role="form" method="post" action="{{ route('types_applications.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name_category">Название категории</label>
                        <input type="text" class="form-control @error('name_category') is-invalid @enderror" id="name_category" name="name_category" placeholder="Введите название категории">
                    </div>
                    <div class="form-group">
                        <label for="id_post">Ответственная должность</label>
                        <select class="form-control @error('id_post') is-invalid @enderror" id="id_post" name="id_post">
                            @foreach($posts as $k => $v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </form>
        </div>
    </section>
@endsection

