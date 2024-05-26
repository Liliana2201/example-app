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
        <a href="{{ route('applications.create') }}" class="btn btn-primary mb-3">Добавить заявку</a>
        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
            @if (count($applications))
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="dt-buttons btn-group flex-wrap">
                            <button class="btn btn-secondary buttons-copy buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>Copy</span></button>
                            <button class="btn btn-secondary buttons-csv buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>CSV</span></button>
                            <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>Excel</span></button>
                            <button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>PDF</span></button>
                            <button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="example1" type="button"><span>Print</span></button>
                            <div class="btn-group">
                                <button class="btn btn-secondary buttons-collection dropdown-toggle buttons-colvis" tabindex="0" aria-controls="example1" type="button" aria-haspopup="true"><span>Column visibility</span><span class="dt-down-arrow"></span></button>
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
                                                    <div>
                                                        <input id="{{ $types_application->id }}" class="filter checked" type="checkbox" checked>
                                                        <label for="{{ $types_application->id }}">{{ $types_application->name_category }}</label>
                                                    </div>
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
                                <th>Действия</th>
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
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        {{ $applications->links() }}
                    </div>
                </div>
            @else
                <p>Здесь пока пусто..</p>
            @endif
        </div>
    </section>
    <!-- /.content -->
@endsection

