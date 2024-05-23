@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1>Стиральные машины</h1>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <a href="{{ route('washing_machines.create') }}" class="btn btn-primary mb-3">Добавить машинку</a>
        @if (count($washing_machines))
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div id="example1_filter" class="dataTables_filter mt-2 mb-2">
                        <div class="row">
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
                                <th>Номер</th>
                                <th>Последняя дата проверки</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($washing_machines as $washing_machine)
                                <tr class="odd">
                                    <td class="seo">{{ $washing_machine->id }}</td>
                                    <td class="seo">{{ $washing_machine->date_check }}</td>
                                    <td>
                                        <a href="{{ route('washing_machines.edit', ['washing_machine' => $washing_machine->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('washing_machines.destroy', ['washing_machine' => $washing_machine->id]) }}" method="post" class="float-left">
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
                        {{ $washing_machines->links() }}
                    </div>
                </div>
                @else
                    <p>Здесь пока пусто..</p>
                @endif
            </div>

    </section>
    <!-- /.content -->
@endsection

