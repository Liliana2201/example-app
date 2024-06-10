@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1>Имущество</h1>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <a href="{{ route('properties.create') }}" class="btn btn-primary mb-3">Добавить имущество</a>
        @if (count($properties))
            <div>
                <div class="row mb-2 mt-2">
                    <div class="col-sm-12 col-md-6">
                        <div class="dt-buttons btn-group flex-wrap">
                            <button class="btn btn-secondary buttons-copy" onClick="copytable('table')" type="button">Копировать</button>
                            <button class="btn btn-secondary buttons-excel" onClick="tabletoExcel('table', 'properties')" type="button">Excel</button>
                            <button id="buttons-pdf" class="btn btn-secondary" type="button">PDF</button>
                            <button class="btn btn-secondary buttons-print" onClick="printData()" type="button">Печать</button>
                            <button onclick="openDiv()" class="btn btn-secondary buttons-colvis" type="button">Видимость колонок <i id="column" class="fas fa-caret-down"></i></button>
                            <div class="div_column" style="display: none; position: relative;">
                                <div style="position: absolute; background-color: #ffffff; min-width: 120px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); border-radius: 10px; z-index: 1">
                                    <form style="justify-content: space-around; display: grid;">
                                        <div>
                                            <input id="all2" class="column checked" type="checkbox" checked>
                                            <label for="all2">Все</label>
                                        </div>
                                        <div>
                                            <input id="name" class="column checked" type="checkbox" checked>
                                            <label for="name">Название</label>
                                        </div>
                                        <div>
                                            <input id="mark" class="column checked" type="checkbox" checked>
                                            <label for="mark">Маркировка</label>
                                        </div>
                                        <div>
                                            <input id="year" class="column checked" type="checkbox" checked>
                                            <label for="year">Год</label>
                                        </div>
                                        <div>
                                            <input id="status" class="column checked" type="checkbox" checked>
                                            <label for="status">Статус</label>
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
                                <th class="ascdesc">Название</th>
                                <th class="ascdesc">Маркировка</th>
                                <th class="ascdesc">Год</th>
                                <th>Статус
                                    <button onclick="myFunction(0)" class="btn btn-sm"><i class="fas fa-filter"></i></button>
                                    <div class="div_filter" style="display: none; position: relative;">
                                        <div style="position: absolute; background-color: #ffffff; min-width: 120px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); border-radius: 10px; z-index: 1">
                                            <form style="justify-content: space-around; display: grid;">
                                                <div>
                                                    <input id="all" class="filter unchecked" type="checkbox">
                                                    <label for="all">Все</label>
                                                </div>
                                                <div>
                                                    <input id="stock" class="filter checked" type="checkbox" checked>
                                                    <label for="stock">На складе</label>
                                                </div>
                                                <div>
                                                    <input id="given" class="filter checked" type="checkbox" checked>
                                                    <label for="given">Выдано</label>
                                                </div>
                                                <div>
                                                    <input id="trash" class="filter unchecked" type="checkbox">
                                                    <label for="trash">Списано</label>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($properties as $property)
                                @if($property->status != 2)
                                    <tr>
                                        <td class="seo">{{ $property->title }}</td>
                                        <td class="seo">{{ $property->mark }}</td>
                                        <td class="seo">{{ $property->year }}</td>
                                        <td class="seo td_filter">
                                            @if ($property->status == 0)
                                                На складе
                                            @else
                                                Выдано
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('properties.edit', ['property' => $property->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ route('properties.destroy', ['property' => $property->id]) }}" method="post" class="float-left">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Подтвердите удаление')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @else
                                    <tr style="display: none">
                                        <td class="seo">{{ $property->title }}</td>
                                        <td class="seo">{{ $property->mark }}</td>
                                        <td class="seo">{{ $property->year }}</td>
                                        <td class="seo td_filter">
                                            Списано
                                        </td>
                                        <td>
                                            <a href="{{ route('properties.edit', ['property' => $property->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ route('properties.destroy', ['property' => $property->id]) }}" method="post" class="float-left">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Подтвердите удаление')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        {{ $properties->links() }}
                    </div>
                </div>
                @else
                    <p>Здесь пока пусто..</p>
                @endif
            </div>

    </section>
    <!-- /.content -->
    <script>

    </script>
@endsection

