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
                <h3 class="card-title">Добавить новую комнату</h3>
            </div>
            <form role="form" method="post" action="{{ route('rooms.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="level">Этаж</label>
                        <input type="text" class="form-control @error('level') is-invalid @enderror" id="level" name="level" placeholder="Введите этаж">
                    </div>
                    <div class="form-group">
                        <label for="number">Номер комнаты</label>
                        <input type="text" class="form-control @error('number') is-invalid @enderror" id="number" name="number" placeholder="Введите номер комнаты">
                    </div>
                    <div class="form-group">
                        <label for="id_cond">Состояние</label>
                        <select class="form-control @error('id_cond') is-invalid @enderror" id="id_cond" name="id_cond">
                            @foreach($condition_rooms as $k => $v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="num_beds">Количество мест</label>
                        <input type="text" class="form-control @error('num_beds') is-invalid @enderror" id="num_beds" name="num_beds" placeholder="Введите количество мест">
                    </div>
                    <div class="form-group">
                        <label for="square">Площадь</label>
                        <input type="text" class="form-control @error('square') is-invalid @enderror" id="square" name="square" placeholder="Введите площадь комнаты">
                    </div>
                    <div class="form-group">
                        <label for="properties">Имущество</label>
                        <select name="properties[]" id="properties" onChange="f1()" class="select2 select2-hidden-accessible" multiple="multiple" data-placeholder="Выбор имущества" style="width: 100%;" tabindex="-1" aria-hidden="true">
                            @foreach($properties as $property)
                                <option value="{{ $property->id }}">{{ $property->title }}({{ $property->mark }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </form>
        </div>
    </section>
@endsection

