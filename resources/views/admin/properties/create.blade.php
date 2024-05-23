@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1>Имущество</h1>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Добавить новое имущество</h3>
            </div>
            <form role="form" method="post" action="{{ route('properties.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="category">Категория</label>
                        <select class="form-control @error('category') is-invalid @enderror" id="category" name="category">
                            <option value="Комнаты">Комнаты</option>
                            <option value="Студенты">Студенты</option>
                            <option value="Постельное">Постельное</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Название</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Введите название">
                    </div>
                    <div class="form-group">
                        <label for="mark">Маркировка</label>
                        <input type="text" class="form-control @error('mark') is-invalid @enderror" id="mark" name="mark" placeholder="Введите марку">
                    </div>
                    <div class="form-group">
                        <label for="year">Год</label>
                        <input type="number" min="1900" max="2099" step="1" class="form-control @error('year') is-invalid @enderror" id="year" name="year">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </form>
        </div>
    </section>
@endsection

