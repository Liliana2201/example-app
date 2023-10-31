@extends('admin.layouts.layout')

@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <h1>Общежития</h1>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Список общежитий</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <a href="{{ route('dormitories.create') }}" class="btn btn-primary mb-3">Добавить общежитие</a>
                    @if (count($dormitories))
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
                                    <div id="example1_filter" class="dataTables_filter">
                                        <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                                        <thead>
                                        <tr>
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">Title</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Address</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Phone</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">URL_photo</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($dormitories as $dormitory)
                                            <tr class="odd">
                                                <td class="dtr-control sorting_1">{{ $dormitory->title_dom }}</td>
                                                <td>{{ $dormitory->address }}</td>
                                                <td>{{ $dormitory->phone }}</td>
                                                <td>{{ $dormitory->url_photo }}</td>
                                                <td>
                                                    <a href="{{ route('dormitories.edit', ['dormitory' => $dormitory->id_dom]) }}" class="btn btn-info btn-sm float-left mr-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <form action="{{ route('dormitories.destroy', ['dormitory' => $dormitory->id_dom]) }}" method="post" class="float-left">
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
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 27 entries</div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button page-item previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                                            <li class="paginate_button page-item active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                            <li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                            <li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                            <li class="paginate_button page-item next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p>Здесь пока пусто..</p>
                        @endif
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
@endsection

