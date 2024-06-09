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
                <h3 class="card-title">Добавить новую заявку</h3>
            </div>
            <form role="form" method="post" action="{{ route('applications.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="id_category">Категория</label>
                        <select class="form-control @error('id_category') is-invalid @enderror" id="id_category" name="id_category">
                            @foreach($types_applications as $k => $v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_stud">Студент</label>
                        <select class="form-control @error('id_stud') is-invalid @enderror" id="id_stud" name="id_stud">
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->surname }} {{ $student->name }} {{ $student->patronymic }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Опишите проблему">
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                    <button type="button" class="btn btn-outline-secondary"><a href="{{ route('applications.index') }}">Отменить</a></button>
                </div>
            </form>
        </div>
    </section>
@endsection

