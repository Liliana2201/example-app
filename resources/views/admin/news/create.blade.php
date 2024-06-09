@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1>Новости</h1>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Добавить новость</h3>
            </div>
            <form role="form" method="post" action="{{ route('news.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title_news">Заголовок</label>
                        <input type="text" class="form-control @error('title_news') is-invalid @enderror" id="title_news" name="title_news" placeholder="Введите заголовок новости">
                    </div>
                    <div class="form-group">
                        <label for="description">Краткое описание</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" rows="3" id="description" name="description" placeholder="Введите описание"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="content">Содержание</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" rows="7" id="content" name="content" placeholder="Введите содержание"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="url_photo">Добавить фото</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="url_photo" id="url_photo" class="custom-file-input @error('url_photo') is-invalid @enderror">
                                <label class="custom-file-label" for="url_photo" id="label">Выберите файл</label>
                            </div>
                        </div>
                    </div>
                    <div><img id="image" src="{{ asset("no-image.png") }}" alt="" class="img-thumbnail mt-2 mb-2" width="200"></div>
                    <div class="form-group">
                        <input type="button" class="btn btn-danger btn-sm" name="del_photo" onclick="return confirm('Подтвердите удаление')" value="Удалить фото" disabled="disabled"/>
                        <i class="fas fa-trash-alt"></i>
                    </div>
                    <div class="form-group">
                        <label for="tags">Тэги</label>
                        <select name="tags[]" id="tags" class="select2 @error('tags') is-invalid @enderror" multiple="multiple"
                                data-placeholder="Выбор тэгов" style="width: 100%;">
                            @foreach($tags as $k => $v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                    <button type="button" class="btn btn-outline-secondary"><a href="{{ route('news.index') }}">Отменить</a></button>
                </div>
            </form>
        </div>
    </section>
    <script>
        document.getElementById('url_photo').onchange = function () {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image').src = src
        }
    </script>
@endsection

