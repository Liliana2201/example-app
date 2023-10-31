@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1>Общежития</h1>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Изменить общежитие</h3>
            </div>
            <form role="form" method="post" action="{{ route('dormitories.update', ['dormitory' => $dormitory->id_dom]) }}"  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Название</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Введите название" value="{{ $dormitory->title }}">
                    </div>
                    <div class="form-group">
                        <label for="address">Адрес</label>
                        <input type="text" class="form-control  @error('address') is-invalid @enderror" id="address" placeholder="Введите адрес" value="{{ $dormitory->address }}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Номер вахты</label>
                        <input type="number" class="form-control  @error('phone') is-invalid @enderror" id="phone" placeholder="Введите номер" value="{{ $dormitory->phone }}">
                    </div>
                    <div class="form-group">
                        <label for="url_photo">Добавить фото</label>
                        <input type="text" class="form-control  @error('url_photo') is-invalid @enderror" id="url_photo" placeholder="Введите url фото" value="{{ $dormitory->url_photo }}">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </section>
@endsection

