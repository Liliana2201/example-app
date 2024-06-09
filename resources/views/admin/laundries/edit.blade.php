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
                        <select class="form-control @error('time_wash') is-invalid @enderror" id="time_wash" name="time_wash">
                            <option value="06:20">06:20-07:30</option>
                            <option value="07:30">07:30-08:40</option>
                            <option value="08:40">08:40-09:50</option>
                            <option value="09:50">09:50-11:00</option>
                            <option value="11:00">11:00-12:10</option>
                            <option value="12:10">12:10-13:20</option>
                            <option value="13:20">13:20-14:30</option>
                            <option value="14:30">14:30-15:40</option>
                            <option value="15:40">15:40-16:50</option>
                            <option value="16:50">16:50-18:00</option>
                            <option value="18:00">18:00-19:10</option>
                            <option value="19:10">19:10-20:20</option>
                            <option value="20:20">20:20-21:30</option>
                            <option value="21:30">21:30-22:40</option>
                            <option value="22:40">22:40-23:50</option>
                        </select>
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
                    <button type="button" class="btn btn-outline-secondary"><a href="{{ route('laundries.index') }}">Отменить</a></button>
                </div>
            </form>
        </div>
    </section>
@endsection

