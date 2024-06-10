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

        <a href="{{ route('rooms.create') }}" class="btn btn-primary mb-3">Добавить комнату</a>
        @if (count($rooms))
            <div>
                <div class="row mb-2 mt-2">
                    <div class="col-sm-12 col-md-6">
                        <div class="dt-buttons btn-group flex-wrap">
                            <button class="btn btn-secondary buttons-copy" onClick="copytable('table')" type="button">Копировать</button>
                            <button class="btn btn-secondary buttons-excel" onClick="tabletoExcel('table', 'rooms')" type="button">Excel</button>
                            <button id="buttons-pdf" class="btn btn-secondary" type="button">PDF</button>
                            <button class="btn btn-secondary buttons-print" onClick="printData()" type="button">Печать</button>
                            <button onclick="openDiv()" class="btn btn-secondary buttons-colvis" type="button">Видимость колонок <i id="column" class="fas fa-caret-down"></i></button>
                            <div class="div_column" style="display: none; position: relative;">
                                <div style="position: absolute; background-color: #ffffff; min-width: 200px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); border-radius: 10px; z-index: 1">
                                    <form style="justify-content: space-around; display: grid;">
                                        <div>
                                            <input id="all3" class="column checked" type="checkbox" checked>
                                            <label for="all3">Все</label>
                                        </div>
                                        <div>
                                            <input id="level" class="column checked" type="checkbox" checked>
                                            <label for="level">Этаж</label>
                                        </div>
                                        <div>
                                            <input id="number" class="column checked" type="checkbox" checked>
                                            <label for="number">Номер комнаты</label>
                                        </div>
                                        <div>
                                            <input id="condition" class="column checked" type="checkbox" checked>
                                            <label for="condition">Состояние</label>
                                        </div>
                                        <div>
                                            <input id="num_beds" class="column checked" type="checkbox" checked>
                                            <label for="num_beds">Количество мест</label>
                                        </div>
                                        <div>
                                            <input id="square" class="column checked" type="checkbox" checked>
                                            <label for="square">Площадь</label>
                                        </div>
                                        <div>
                                            <input id="properties" class="column checked" type="checkbox" checked>
                                            <label for="properties">Имущество</label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div>
                            <div class="row">
                                <div class="col-2">
                                    <label for="search">Поиск</label>
                                </div>
                                <div class="col-10">
                                    <input type="text" class="form-control" onkeyup="Search()" id="search" name="search">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="table" class="table table-bordered table-striped dataTable dtr-inline">
                            <thead>
                            <tr>
                                <th class="ascdesc">Этаж
                                    <button onclick="myFunction(0)" class="btn btn-sm"><i class="fas fas fa-filter"></i></button>
                                    <div class="div_filter" style="display: none; position: relative;">
                                        <div style="position: absolute; background-color: #ffffff; min-width: 80px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); border-radius: 10px;">
                                            <form style="justify-content: space-around; display: grid;">
                                                <div>
                                                    <input id="all" class="filter checked" type="checkbox" checked>
                                                    <label for="all">Все</label>
                                                </div>
                                                <div>
                                                    <input id="two" class="filter checked" type="checkbox" checked>
                                                    <label for="two">2</label>
                                                </div>
                                                <div>
                                                    <input id="three" class="filter checked" type="checkbox" checked>
                                                    <label for="three">3</label>
                                                </div>
                                                <div>
                                                    <input id="four" class="filter checked" type="checkbox" checked>
                                                    <label for="four">4</label>
                                                </div>
                                                <div>
                                                    <input id="five" class="filter checked" type="checkbox" checked>
                                                    <label for="five">5</label>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </th>
                                <th class="ascdesc">Номер комнаты</th>
                                <th>Состояние
                                    <button onclick="myFunction(1)" class="btn btn-sm"><i class="fas fas fa-filter"></i></button>
                                    <div class="div_filter" style="display: none; position: relative;">
                                        <div style="position: absolute; background-color: #ffffff; min-width: 140px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); border-radius: 10px;">
                                            <form style="justify-content: space-around; display: grid;">
                                                <div>
                                                    <input id="all2" class="filter checked" type="checkbox" checked>
                                                    <label for="all2">Все</label>
                                                </div>
                                                @foreach ($condition_rooms as $condition_room)
                                                    <div>
                                                        <input id="{{ $condition_room->id }}" class="filter checked" type="checkbox" checked>
                                                        <label for="{{ $condition_room->id }}">{{ $condition_room->title }}</label>
                                                    </div>
                                                @endforeach
                                            </form>
                                        </div>
                                    </div>
                                </th>
                                <th>Количество мест</th>
                                <th class="ascdesc">Площадь</th>
                                <th>Имущество</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($rooms as $room)
                                <tr>
                                    <td class="seo td_filter">{{ $room->level }}</td>
                                    <td class="seo">{{ $room->number }}</td>
                                    <td class="seo td_filter">{{ $room->condition_room->title }}</td>
                                    <td class="seo">{{ $room->num_beds }}</td>
                                    <td class="seo">{{ $room->square }}</td>
                                    <td class="seo">
                                        @foreach($room->properties as $property_room)
                                            @foreach($properties as $property)
                                                @if($property->id == $property_room->id)
                                                    {{ $property->title }}({{ $property->mark }});
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('rooms.edit', ['room' => $room->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('rooms.destroy', ['room' => $room->id]) }}" method="post" class="float-left">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Подтвердите удаление')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        {{ $rooms->links() }}
                    </div>
                </div>
                @else
                    <p>Здесь пока пусто..</p>
                @endif
            </div>

    </section>
    <!-- /.content -->
@endsection

