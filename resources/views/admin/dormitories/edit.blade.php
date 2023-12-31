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
                <h3 class="card-title">Редактировать "{{ $dormitory->title }}"</h3>
            </div>
            <form role="form" method="post" action="{{ route('dormitories.update', ['dormitory' => $dormitory->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Название</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $dormitory->title }}">
                    </div>
                    <div class="form-group">
                        <label for="address">Адрес</label>
                        <input type="text" class="form-control  @error('address') is-invalid @enderror" id="address" name="address" value="{{ $dormitory->address }}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Номер вахты</label>
                        <input type="number" class="form-control  @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $dormitory->phone }}">
                    </div>
                    <div class="form-group">
                        <label for="url_photo">Добавить фото</label>
                        <div class="custom-file">
                            <input type="file" name="photo" id="photo" class="custom-file-input">
                            <label class="custom-file-label" for="photo" id="label">Выберите файл</label>
                        </div>
                    </div>
                    <div><img id="image" src="{{ $dormitory->getImage() }}" alt="" class="img-thumbnail mt-2 mb-2" width="200"></div>
                    <div class="form-group">
                        <input type="button" class="btn btn-danger btn-sm" name="del_photo" onclick="return confirm('Подтвердите удаление')" value="Удалить фото">
                        <i class="fas fa-trash-alt"></i>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </section>
    <script>
        document.getElementById('photo').onchange = function () {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image').src = src
            //document.getElementById('label').innerHTML = this.files[0].name;
        }
    </script>
@endsection

