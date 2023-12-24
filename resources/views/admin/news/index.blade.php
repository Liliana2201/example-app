@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1>Новости</h1>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Список новостей</h3>

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
                <a href="{{ route('news.create') }}" class="btn btn-primary mb-3">Добавить новость</a>
                @if (count($news))
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
                                <div id="example1_filter" class="dataTables_filter mt-2 mb-2">
                                    <div class="row">
                                        <div class="col-2">
                                            <label>Search:</label>
                                        </div>
                                        <div class="col-10">
                                            <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                                    <thead>
                                    <tr>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">Время публикации</th>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">Общежитие</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">Заголовок</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">Краткое описание</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">Мультимедиа</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">Тэги</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($news as $new)
                                        <tr class="odd">
                                            <td>{{ $new->created_at }}</td>
                                            <td>{{ $new->dormitory->title }}</td>
                                            <td>{{ $new->title_news }}</td>
                                            <td>{{ $new->description }}</td>
                                            <td><img src="{{ $new->getImage() }}" alt="" class="img-thumbnail mt-2" width="200"></td>
                                            <td>{{ $new->tags->pluck('name_tag')->join(', ') }}</td>
                                            <td>
                                                <a href="{{ route('news.edit', ['news' => $new->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <form action="{{ route('news.destroy', ['news' => $new->id]) }}" method="post" class="float-left">
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
                                {{ $news->links() }}
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

