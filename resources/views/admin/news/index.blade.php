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

        <a href="{{ route('news.create') }}" class="btn btn-primary mb-3">Добавить новость</a>
        @if (count($news))
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
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
                                <th class="ascdesc">Время публикации</th>
                                <th class="ascdesc">Заголовок</th>
                                <th>Краткое описание</th>
                                <th>Мультимедиа</th>
                                <th>Тэги
                                    <button onclick="myFunction(0)" class="btn btn-sm"><i class="fas fas fa-filter"></i></button>
                                    <div class="div_filter" style="display: none; position: relative;">
                                        <div style="position: absolute; background-color: #ffffff; min-width: 140px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); border-radius: 10px;">
                                            <form style="justify-content: space-around; display: grid;">
                                                <div>
                                                    <input id="all1" class="filter checked" type="checkbox" checked>
                                                    <label for="all1">Все</label>
                                                </div>
                                                @foreach ($tags as $tag)
                                                    <div>
                                                        <input id="{{ $tag->id }}" class="filter checked" type="checkbox" checked>
                                                        <label for="{{ $tag->id }}">{{ $tag->name_tag }}</label>
                                                    </div>
                                                @endforeach
                                            </form>
                                        </div>
                                    </div>
                                </th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($news as $new)
                                <tr>
                                    <td class="seo">{{ $new->created_at }}</td>
                                    <td class="seo">{{ $new->title_news }}</td>
                                    <td class="seo">{{ $new->description }}</td>
                                    <td><img src="{{ $new->getImage() }}" alt="" class="img-thumbnail mt-2" width="200"></td>
                                    <td class="seo td_filter">{{ $new->tags->pluck('name_tag')->join(', ') }}</td>
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

    </section>
    <!-- /.content -->
@endsection

