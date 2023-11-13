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
                <h3 class="card-title">Редактировать комнату "{{ $room->number }}" из "{{ $room->dormitory->title }}"</h3>
            </div>
            <form role="form" method="post" action="{{ route('rooms.update', ['room' => $room->id]) }}}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="id_dom">Общежитие</label>
                        <select class="form-control @error('id_dom') is-invalid @enderror" id="id_dom" name="id_dom">
                            @foreach($dormitories as $k => $v)
                                <option value="{{ $k }}" @if($k == $room->id_dom) selected @endif>{{ $v }}</option>
                            @endforeach
                        </select>
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
                        <label for="properties">Имущество</label>
                        <select name="properties[]" id="properties" class="select2 @error('properties') is-invalid @enderror" multiple="multiple"
                                data-placeholder="Выбор имущества" style="width: 100%;">
                            @foreach($properties as $k => $v)
                                <option value="{{ $k }}" @if(in_array($k, $room->properties->pluck('id')->all())) selected @endif>{{ $v }}</option>
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

