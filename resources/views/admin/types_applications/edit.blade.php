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
                <h3 class="card-title">Редактировать категорию "{{ $types_application->name_category }}"</h3>
            </div>
            <form role="form" method="post" action="{{ route('types_applications.update', ['types_application' => $types_application->id]) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="name_category">Название категории</label>
                        <input type="text" class="form-control @error('name_category') is-invalid @enderror" id="name_category" name="name_category" value="{{ $types_application->name_category }}">
                    </div>
                    <div class="form-group">
                        <label for="id_post">Состояние</label>
                        <select class="form-control @error('id_post') is-invalid @enderror" id="id_post" name="id_post">
                            @foreach($posts as $k => $v)
                                <option value="{{ $k }}" @if($k == $types_application->id_post) selected @endif>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                    <button type="button" class="btn btn-outline-secondary"><a href="{{ route('types_applications.index') }}">Отменить</a></button>
                </div>
            </form>
        </div>
    </section>
@endsection

