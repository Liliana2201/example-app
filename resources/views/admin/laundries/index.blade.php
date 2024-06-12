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

        <a href="{{ route('laundries.create') }}" class="btn btn-primary mb-3">Добавить стирку</a>
        @if (count($laundries))
            <div>
                <div class="row  mb-2 mt-2">
                    <div class="col-sm-12 col-md-6">
                        <div class="dt-buttons btn-group flex-wrap">
                            <button class="btn btn-secondary buttons-copy" onClick="copytable('table')" type="button">Копировать</button>
                            <button class="btn btn-secondary buttons-excel" onClick="tabletoExcel('table', 'laundries')" type="button">Excel</button>
                            <button id="buttons-pdf" class="btn btn-secondary" type="button">PDF</button>
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
                                <th class="ascdesc">Дата</th>
                                <th class="ascdesc">Время</th>
                                <th>Машинка
                                    <button onclick="myFunction(0)" class="btn btn-sm"><i class="fas fas fa-filter"></i></button>
                                    <div class="div_filter" style="display: none; position: relative;">
                                        <div style="position: absolute; background-color: #ffffff; min-width: 140px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); border-radius: 10px;">
                                            <form style="justify-content: space-around; display: grid;">
                                                <div>
                                                    <input id="all1" class="filter checked" type="checkbox" checked>
                                                    <label for="all1">Все</label>
                                                </div>
                                                @foreach ($washing_machines as $washing_machine)
                                                    <div>
                                                        <input id="{{ $washing_machine->id }}" class="filter checked" type="checkbox" checked>
                                                        <label for="{{ $washing_machine->id }}">{{ $washing_machine->id }}</label>
                                                    </div>
                                                @endforeach
                                            </form>
                                        </div>
                                    </div>
                                </th>
                                <th>Студент</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($laundries as $laundry)
                                <tr>
                                    <td class="seo">{{ $laundry->date_wash }}</td>
                                    <td class="seo">{{ $laundry->time_wash }}</td>
                                    <td class="seo td_filter">{{ $laundry->id_mash }}</td>
                                    <td class="seo">@foreach ($students as $student)
                                            @if ($laundry->id_stud == $student->id)
                                                {{ $student->surname }} {{ $student->name }} {{ $student->patronymic }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('laundries.edit', ['laundry' => $laundry->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('laundries.destroy', ['laundry' => $laundry->id]) }}" method="post" class="float-left">
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
                        {{ $laundries->links() }}
                    </div>
                </div>
                @else
                    <p>Здесь пока пусто..</p>
                @endif
            </div>

    </section>
    <!-- /.content -->
@endsection

