@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1>Студенты</h1>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Редактировать студента "{{ $student->surname }} {{ $student->name }} {{ $student->patronymic }}"</h3>
            </div>
            <form role="form" method="post" action="{{ route('students.update', ['student' => $student->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="room_id">Комната</label>
                        <select class="form-control @error('room_id') is-invalid @enderror" id="room_id" name="room_id">
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}" @if($room->id == $student->room_id) selected @endif>{{ $room->number }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="surname">Фамилия</label>
                        <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname" value="{{ $student->surname }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $student->name }}">
                    </div>
                    <div class="form-group">
                        <label for="patronymic">Отчество</label>
                        <input type="text" class="form-control @error('patronymic') is-invalid @enderror" id="patronymic" name="patronymic" value="{{ $student->patronymic }}">
                    </div>
                    <div class="form-group">
                        <label for="status">Статус</label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="Обычный" @if($student->status == "Обычный") selected @endif>Обычный</option>
                            <option value="Инвалид" @if($student->status == "Инвалид") selected @endif>Инвалид</option>
                            <option value="Иностранный студент" @if($student->status == "Иностранный студент") selected @endif>Иностранный студент</option>
                            <option value="Сирота" @if($student->status == "Сирота") selected @endif>Сирота</option>
                            <option value="Малоимущая семья" @if($student->status == "Малоимущая семья") selected @endif>Малоимущая семья</option>
                            <option value="Неполная семья" @if($student->status == "Неполная семья") selected @endif>Неполная семья</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="form_edu">Форма обучения</label>
                        <select class="form-control @error('form_edu') is-invalid @enderror" id="form_edu" name="form_edu">
                            <option value="Бюджет" @if($student->form_edu == "Бюджет") selected @endif>Бюджет</option>
                            <option value="Платно" @if($student->form_edu == "Платно") selected @endif>Платно</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="group">Группа</label>
                        <input type="text" class="form-control @error('group') is-invalid @enderror" id="group" name="group" value="{{ $student->group }}">
                    </div>
                    <div class="form-group">
                        <label for="passport">Паспорт</label>
                        <input type="text" class="form-control @error('passport') is-invalid @enderror" id="passport" name="passport" value="{{ $student->passport }}">
                    </div>
                    <div class="form-group">
                        <label for="issued_pas">Кем выдан</label>
                        <input type="text" class="form-control @error('issued_pas') is-invalid @enderror" id="issued_pas" name="issued_pas" value="{{ $student->issued_pas }}">
                    </div>
                    <div class="form-group">
                        <label for="date_pas">Дата выдачи</label>
                        <input type="date" class="form-control @error('date_pas') is-invalid @enderror" id="date_pas" name="date_pas" value="{{ $student->date_pas }}">
                    </div>
                    <div class="form-group">
                        <label for="date_births">Дата рождения</label>
                        <input type="date" class="form-control @error('date_births') is-invalid @enderror" id="date_births" name="date_births" value="{{ $student->date_births }}">
                    </div>
                    <div class="form-group">
                        <label for="hometown">Родной город</label>
                        <input type="text" class="form-control @error('hometown') is-invalid @enderror" id="hometown" name="hometown" value="{{ $student->hometown }}">
                    </div>
                    <div class="form-group">
                        <label for="contract">Добавить скан договора</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="contract" id="contract" class="custom-file-input @error('contract') is-invalid @enderror">
                                <label class="custom-file-label" for="contract" id="label">Выберите файл</label>
                            </div>
                        </div>
                    </div>
                    <div><a id="file" href="{{ $student->getContract() }}">{{ $student->contract }}</a></div>
                    <div class="form-group">
                        <label for="balance">Баланс</label>
                        <input type="text" class="form-control @error('balance') is-invalid @enderror" id="balance" name="balance" value="{{ $student->balance }}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Телефон</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $student->phone }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Почта</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $student->email }}">
                    </div>
                    <div class="form-group">
                        <label for="work_out">Отработано часов</label>
                        <input type="number" class="form-control @error('work_out') is-invalid @enderror" id="work_out" name="work_out" value="{{ $student->work_out }}">
                    </div>
                    <div class="form-group">
                        <label for="date_flg">Дата последней флюрографии</label>
                        <input type="date" class="form-control @error('date_flg') is-invalid @enderror" id="date_flg" name="date_flg" value="{{ $student->date_flg }}">
                    </div>
                    <div class="form-group">
                        <label for="photo">Добавить фото</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="photo" id="photo" class="custom-file-input @error('photo') is-invalid @enderror">
                                <label class="custom-file-label" for="photo" id="label">Выберите файл</label>
                            </div>
                        </div>
                    </div>
                    <div><img id="image" src="{{ $student->getImage() }}" alt="" class="img-thumbnail mt-2 mb-2" width="200"></div>
                    <div class="form-group">
                        <input type="button" class="btn btn-danger btn-sm" name="del_photo" onclick="return confirm('Подтвердите удаление')" value="Удалить фото" disabled="disabled"/>
                        <i class="fas fa-trash-alt"></i>
                    </div>
                    <div class="form-group">
                        <label for="properties">Имущество</label>
                        <select name="properties[]" id="properties" class="select2 @error('properties') is-invalid @enderror" multiple="multiple"
                                data-placeholder="Выбор имущества" style="width: 100%;">
                            @foreach($properties as $property)
                                @if (count($student->properties))
                                    @foreach($student->properties as $property_student)
                                        <option value="{{ $property->id }}" @if($property->id == $property_student->id) selected @endif>{{ $property->title }}({{ $property->mark }})</option>
                                    @endforeach
                                @else
                                    <option value="{{ $property->id }}">{{ $property->title }}({{ $property->mark }})</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="family">Контакты родителей</label>
                        <input type="text" class="form-control @error('family') is-invalid @enderror" id="family" name="family" value="{{ $student->family }}">
                    </div>
                    <div class="form-group">
                        <label for="notes">Примечания</label>
                        <input type="text" class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" value="{{ $student->notes }}">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                    <button type="button" class="btn btn-outline-secondary"><a href="{{ route('students.index') }}">Отменить</a></button>
                </div>
            </form>
        </div>
    </section>
    <script>
        document.getElementById('photo').onchange = function () {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image').src = src
        }
        document.getElementById('contract').onchange = function () {
            var href = URL.createObjectURL(this.files[0])
            document.getElementById('file').href = href
        }
    </script>
@endsection

