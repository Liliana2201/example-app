@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1>Комнаты</h1>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Редактировать комнату "{{ $room->number }}"</h3>
            </div>
            <form role="form" method="post" action="{{ route('rooms.update', ['room' => $room->id]) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="level">Этаж</label>
                        <input type="text" class="form-control @error('level') is-invalid @enderror" id="level" name="level" value="{{ $room->level }}">
                    </div>
                    <div class="form-group">
                        <label for="number">Номер комнаты</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="number" name="number" value="{{ $room->number }}">
                    </div>
                    <div class="form-group">
                        <label for="id_cond">Состояние</label>
                        <select class="form-control @error('id_cond') is-invalid @enderror" id="id_cond" name="id_cond">
                            @foreach($condition_rooms as $k => $v)
                                <option value="{{ $k }}" @if($k == $room->id_cond) selected @endif>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="num_beds">Количество мест</label>
                        <input type="text" class="form-control @error('num_beds') is-invalid @enderror" id="num_beds" name="num_beds" value="{{ $room->num_beds }}">
                    </div>
                    <div class="form-group">
                        <label for="square">Площадь</label>
                        <input type="text" class="form-control @error('square') is-invalid @enderror" id="square" name="square" value="{{ $room->square }}">
                    </div>
                    <div class="form-group">
                        <label for="properties">Имущество</label>
                        <select name="properties[]" id="properties" class="select2 @error('properties') is-invalid @enderror" multiple="multiple"
                                data-placeholder="Выбор имущества" style="width: 100%;">
                            @foreach($room->properties as $property_room)
                                @foreach($properties as $property)
                                    <option value="{{ $property->id }}" @if($property->id == $property_room->id) selected @endif>{{ $property->title }}({{ $property->mark }})</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                    <button type="button" class="btn btn-outline-secondary"><a href="{{ route('rooms.index') }}">Отменить</a></button>
                </div>
            </form>
        </div>
    </section>
@endsection

