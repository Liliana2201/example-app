@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1>Тэги</h1>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Добавить новый тэг</h3>
            </div>
            <form role="form" method="post" action="{{ route('tags.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name_tag">Название тэга</label>
                        <input type="text" class="form-control @error('name_tag') is-invalid @enderror" id="name_tag" name="name_tag" placeholder="Введите название тэга">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                    <button type="button" class="btn btn-outline-secondary"><a href="{{ route('tags.index') }}">Отменить</a></button>
                </div>
            </form>
        </div>
    </section>
@endsection

