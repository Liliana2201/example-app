@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1>Список заявок</h1>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        @if (Auth::user()->is_admin)
            <a href="{{ route('applications.create') }}" class="btn btn-primary mb-3">Добавить заявку</a>
        @endif
        @if (count($applications))
            <div>
                <div class="row mb-2 mt-2">
                    <div class="col-sm-12 col-md-6">
                        <div class="dt-buttons btn-group flex-wrap">
                            <button class="btn btn-secondary buttons-copy" onClick="copytable('table')" type="button">Копировать</button>
                            <button class="btn btn-secondary buttons-excel" onClick="tabletoExcel('table', 'applications')" type="button">Excel</button>
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
                                <th class="ascdesc">Категория
                                    <button onclick="myFunction(0)" class="btn btn-sm"><i class="fas fas fa-filter"></i></button>
                                    <div class="div_filter" style="display: none; position: relative;">
                                        <div style="position: absolute; background-color: #ffffff; min-width: 140px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); border-radius: 10px;">
                                            <form style="justify-content: space-around; display: grid;">
                                                <div>
                                                    <input id="all1" class="filter checked" type="checkbox" checked>
                                                    <label for="all1">Все</label>
                                                </div>
                                                @foreach ($types_applications as $types_application)
                                                    @if (Auth::user()->is_admin)
                                                        <div>
                                                            <input id="{{ $types_application->id }}" class="filter checked" type="checkbox" checked>
                                                            <label for="{{ $types_application->id }}">{{ $types_application->name_category }}</label>
                                                        </div>
                                                    @elseif($types_application->post == $auth_post)
                                                        <div>
                                                            <input id="{{ $types_application->id }}" class="filter checked" type="checkbox" checked>
                                                            <label for="{{ $types_application->id }}">{{ $types_application->name_category }}</label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </form>
                                        </div>
                                    </div>
                                </th>
                                <th>Студент</th>
                                <th>Описание</th>
                                <th>Состояние
                                    <button onclick="myFunction(1)" class="btn btn-sm"><i class="fas fas fa-filter"></i></button>
                                    <div class="div_filter" style="display: none; position: relative;">
                                        <div style="position: absolute; background-color: #ffffff; min-width: 120px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); border-radius: 10px;">
                                            <form style="justify-content: space-around; display: grid;">
                                                <div>
                                                    <input id="all2" class="filter checked" type="checkbox" checked>
                                                    <label for="all2">Все</label>
                                                </div>
                                                <div>
                                                    <input id="work" class="filter checked" type="checkbox" checked>
                                                    <label for="work">В работе</label>
                                                </div>
                                                <div>
                                                    <input id="end" class="filter checked" type="checkbox" checked>
                                                    <label for="end">Завершено</label>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </th>
                                @if (Auth::user()->is_admin)
                                    <th>Действия</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($applications as $application)
                                <tr class="odd">
                                    <td class="seo">{{ $application->created_at }}</td>
                                    <td class="seo td_filter">{{ $application->category->name_category }}</td>
                                    <td class="seo">@foreach ($students as $student)
                                            @if ($application->id_stud == $student->id)
                                                {{ $student->surname }} {{ $student->name }} {{ $student->patronymic }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="seo">{{ $application->description }}</td>
                                    <td class="seo td_filter">@if ($application->is_check == 0)
                                            В работе
                                            <a href="{{ route('status', ['id' => $application->id]) }}" class="btn-btn-success"><i class="fas fa-check-square"></i></a>
                                        @else
                                            Завершено
                                        @endif

                                    </td>
                                    @if (Auth::user()->is_admin)
                                        <td>
                                            <div>
                                                <a href="{{ route('applications.edit', ['application' => $application->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            </div>
                                            <div>
                                                <form action="{{ route('applications.destroy', ['application' => $application->id]) }}" method="post" class="float-left">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Подтвердите удаление')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <p>Здесь пока пусто..</p>
        @endif
    </section>
    <!-- /.content -->
@endsection

