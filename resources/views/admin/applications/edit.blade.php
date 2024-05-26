@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1>Заявки</h1>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Редактировать заявку от {{ $application->created_at }} числа</h3>
            </div>
            <form role="form" method="post" action="{{ route('applications.update', ['application' => $application->id]) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="id_category">Категория</label>
                        <select class="form-control @error('id_category') is-invalid @enderror" id="id_category" name="id_category">
                            @foreach($types_applications as $k => $v)
                                <option value="{{ $k }}" @if($k == $application->id_category) selected @endif>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_stud">Студент</label>
                        <select class="form-control @error('id_stud') is-invalid @enderror" id="id_stud" name="id_stud">
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" @if($student->id == $application->id_stud) selected @endif>{{ $student->surname }} {{ $student->name }} {{ $student->patronymic }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ $application->description }}">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                    <button type="button" class="btn btn-outline-secondary"><a href="{{ route('applications.index') }}">Отменить</a></button>
                </div>
            </form>
        </div>
    </section>
@endsection

