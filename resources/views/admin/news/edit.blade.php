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
                <h3 class="card-title">Редактировать новость "{{ $new->title_news }}"</h3>
            </div>
            <form role="form" method="post" action="{{ route('news.update', ['news' => $new->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="id_dom">Общежитие</label>
                        <select class="form-control @error('id_dom') is-invalid @enderror" id="id_dom" name="id_dom">
                            @foreach($dormitories as $k => $v)
                                <option value="{{ $k }}" @if($k == $new->id_dom) selected  @endif>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title_news">Заголовок</label>
                        <input type="text" class="form-control @error('title_news') is-invalid @enderror" id="title_news" name="title_news" value="{{ $new->title_news }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Краткое описание</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" rows="3" id="description" name="description">{{ $new->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="content">Содержание</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" rows="7" id="content" name="content">{{ $new->content }}</textarea>
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
                    <div><img id="image" src="{{ $new->getImage() }}" alt="" class="img-thumbnail mt-2 mb-2" width="200"></div>
                    <div class="form-group">
                        <input type="button" class="btn btn-danger btn-sm" name="del_photo" onclick="return confirm('Подтвердите удаление')" value="Удалить фото" disabled="disabled"/>
                        <i class="fas fa-trash-alt"></i>
                    </div>
                    <div class="form-group">
                        <label for="tags">Тэги</label>
                        <select name="tags[]" id="tags" class="select2 @error('tags') is-invalid @enderror" multiple="multiple"
                                data-placeholder="Выбор тэгов" style="width: 100%;">
                            @foreach($tags as $k => $v)
                                <option value="{{ $k }}" @if(in_array($k, $new->tags->pluck('id')->all())) selected @endif>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
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

