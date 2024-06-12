@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1>Сотрудники</h1>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <a href="{{ route('staff.create') }}" class="btn btn-primary mb-3">Добавить сотрудника</a>
        @if (count($staff))
            <div>
                <div class="row mb-2 mt-2">
                    <div class="col-sm-12 col-md-6">
                        <div class="dt-buttons btn-group flex-wrap">
                            <button class="btn btn-secondary buttons-copy" onClick="copytable('table')" type="button">Копировать</button>
                            <button class="btn btn-secondary buttons-excel" onClick="tabletoExcel('table', 'staff')" type="button">Excel</button>
                            <button id="buttons-pdf" class="btn btn-secondary" type="button">PDF</button>
                            <button onclick="openDiv(0)" class="btn btn-secondary buttons-colvis" type="button">Видимость колонок <i class="i_column fas fa-caret-down"></i></button>
                            <div class="div_column" style="display: none; position: relative;">
                                <div style="position: absolute; background-color: #ffffff; min-width: 140px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); border-radius: 10px; z-index: 1">
                                    <form style="justify-content: space-around; display: grid;">
                                        <div>
                                            <input id="all2" class="column checked" type="checkbox" checked>
                                            <label for="all2">Все</label>
                                        </div>
                                        <div>
                                            <input id="surname" class="column checked" type="checkbox" checked>
                                            <label for="surname">Фамилия</label>
                                        </div>
                                        <div>
                                            <input id="name" class="column checked" type="checkbox" checked>
                                            <label for="name">Имя</label>
                                        </div>
                                        <div>
                                            <input id="patronymic" class="column checked" type="checkbox" checked>
                                            <label for="patronymic">Отчество</label>
                                        </div>
                                        <div>
                                            <input id="post" class="column checked" type="checkbox" checked>
                                            <label for="post">Должность</label>
                                        </div>
                                        <div>
                                            <input id="office" class="column checked" type="checkbox" checked>
                                            <label for="office">Кабинет</label>
                                        </div>
                                        <div>
                                            <input id="phone" class="column checked" type="checkbox" checked>
                                            <label for="phone">Телефон</label>
                                        </div>
                                        <div>
                                            <input id="email" class="column checked" type="checkbox" checked>
                                            <label for="email">Почта</label>
                                        </div>
                                        <div>
                                            <input id="photo" class="column checked" type="checkbox" checked>
                                            <label for="photo">Фото</label>
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
                                <th class="ascdesc">Фамилия</th>
                                <th>Имя</th>
                                <th>Отчество</th>
                                <th>Должность
                                    <button onclick="myFunction(0)" class="btn btn-sm"><i class="fas fas fa-filter"></i></button>
                                    <div class="div_filter" style="display: none; position: relative;">
                                        <div style="position: absolute; background-color: #ffffff; min-width: 240px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); border-radius: 10px;">
                                            <form style="justify-content: space-around; display: grid;">
                                                <div>
                                                    <input id="all1" class="filter checked" type="checkbox" checked>
                                                    <label for="all1">Все</label>
                                                </div>
                                                @foreach ($posts as $post)
                                                    <div>
                                                        <input id="{{ $post->id }}" class="filter checked" type="checkbox" checked>
                                                        <label for="{{ $post->id }}">{{ $post->title }}</label>
                                                    </div>
                                                @endforeach
                                            </form>
                                        </div>
                                    </div>
                                </th>
                                <th>Кабинет</th>
                                <th>Телефон</th>
                                <th>Почта</th>
                                <th>Фото</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($staff as $staffer)
                                <tr>
                                    <td class="seo">{{ $staffer->surname }}</td>
                                    <td class="seo">{{ $staffer->name }}</td>
                                    <td class="seo">{{ $staffer->patronymic }}</td>
                                    <td class="seo td_filter">{{ $staffer->post->title }}</td>
                                    <td class="seo">{{ $staffer->office }}</td>
                                    <td class="seo">{{ $staffer->phone }}</td>
                                    <td class="seo">{{ $staffer->email }}</td>
                                    <td><img src="{{ $staffer->getImage() }}" alt="" class="img-thumbnail mt-2" width="200"></td>
                                    <td>
                                        <a href="{{ route('staff.edit', ['staff' => $staffer->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('staff.destroy', ['staff' => $staffer->id]) }}" method="post" class="float-left">
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
                        {{ $staff->links() }}
                    </div>
                </div>
                @else
                    <p>Здесь пока пусто..</p>
                @endif
            </div>

    </section>
    <!-- /.content -->
@endsection

