@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1>Стирки</h1>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Редактировать стирку {{ $laundry->date_wash }} {{ $laundry->time_wash }}</h3>
            </div>
            <form role="form" method="post" action="{{ route('laundries.update', ['laundry' => $laundry->id]) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="id_mash">Номер стиральной машинки</label>
                        <select class="form-control @error('id_mash') is-invalid @enderror" id="id_mash" name="id_mash">
                            @foreach($washing_machines as $washing_machine)
                                <option value="{{ $washing_machine->id }} @if($washing_machine->id == $laundry->id_mash) selected @endif">{{ $washing_machine->id }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date_wash">Дата стирки</label>
                        <input type="date" class="form-control @error('date_wash') is-invalid @enderror" id="date_wash" name="date_wash" value="{{ $laundry->date_wash }}">
                    </div>
                    <div class="form-group">
                        <label for="time_wash">Время стирки</label>
                        <input type="time" class="form-control @error('time_wash') is-invalid @enderror" id="time_wash" name="time_wash" value="{{ $laundry->time_wash }}">
                    </div>
                    <div class="form-group">
                        <label for="id_stud">Студент</label>
                        <select class="form-control @error('id_stud') is-invalid @enderror" id="id_stud" name="id_stud">
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" @if($student->id == $laundry->id_stud) selected @endif>{{ $student->surname }} {{ $student->name }} {{ $student->patronymic }}</option>
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
@endsection

