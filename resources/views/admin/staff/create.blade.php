@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1>Сотрудники</h1>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Добавить нового сотрудника</h3>
            </div>
            <form role="form" method="post" action="{{ route('staff.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="surname">Фамилия</label>
                        <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname" placeholder="Введите фамилию">
                    </div>
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Введите имя">
                    </div>
                    <div class="form-group">
                        <label for="patronymic">Отчество</label>
                        <input type="text" class="form-control @error('patronymic') is-invalid @enderror" id="patronymic" name="patronymic" placeholder="Введите отчество">
                    </div>
                    <div class="form-group">
                        <label for="id_post">Должность</label>
                        <select class="form-control @error('id_post') is-invalid @enderror" id="id_post" name="id_post">
                            @foreach($posts as $k => $v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="office">Кабинет</label>
                        <input type="text" class="form-control @error('office') is-invalid @enderror" id="office" name="office" placeholder="Введите номер кабинета">
                    </div>
                    <div class="form-group">
                        <label for="phone">Телефон</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Введите номер телефона">
                    </div>
                    <div class="form-group">
                        <label for="email">Почта</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Введите электронную почту">
                    </div>
                    <div class="form-group">
                        <label for="photo">Добавить фото</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="photo" id="photo" class="custom-file-input">
                                <label class="custom-file-label" for="photo" id="label">Выберите файл</label>
                            </div>
                        </div>
                    </div>
                    <div><img id="image" src="{{ asset("no-image.png") }}" alt="" class="img-thumbnail mt-2 mb-2" width="200"></div>
                    <div class="form-group">
                        <input type="button" class="btn btn-danger btn-sm" name="del_photo" onclick="return confirm('Подтвердите удаление')" value="Удалить фото" disabled="disabled"/>
                        <i class="fas fa-trash-alt"></i>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                    <button type="button" class="btn btn-outline-secondary"><a href="{{ route('staff.index') }}">Отменить</a></button>
                </div>
            </form>
        </div>
    </section>
    <script>
        document.getElementById('photo').onchange = function () {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image').src = src
            //document.getElementById('del_photo').disabled = "enable";
            document.getElementById('label').innerHTML = this.files[0].name;
        }
    </script>
@endsection

