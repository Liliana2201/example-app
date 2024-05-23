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
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
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
                                <th>Дата</th>
                                <th>Время</th>
                                <th>Машинка</th>
                                <th>Студент</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($laundries as $laundry)
                                <tr class="odd">
                                    <td class="seo">{{ $laundry->date_wash }}</td>
                                    <td class="seo">{{ $laundry->time_wash }}</td>
                                    <td class="seo">@foreach ($washing_machines as $washing_machine)
                                            @if ($laundry->id_mash == $washing_machine->id)
                                                {{ $washing_machine->id }}
                                            @endif
                                        @endforeach
                                    </td>
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

