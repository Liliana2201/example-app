@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1>Студенты</h1>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Добавить студента</a>
        @if (count($students))
            <div>
                <div class="row mb-2 mt-2">
                    <div class="col-sm-12 col-md-7">
                        <div class="dt-buttons btn-group flex-wrap">
                            <button class="btn btn-secondary buttons-copy" onClick="copytable('table')" type="button">Копировать</button>
                            <button class="btn btn-secondary buttons-excel" onClick="tabletoExcel('table', 'properties')" type="button">Excel</button>
                            <button id="buttons-pdf" class="btn btn-secondary" type="button">PDF</button>
                            <button class="btn btn-secondary buttons-print" onClick="printData()" type="button">Печать</button>
                            <button onclick="openDiv(0)" class="btn btn-secondary buttons-colvis" type="button">Видимость колонок <i class="fas fa-caret-down i_column"></i></button>
                            <div class="div_column" style="display: none; position: relative;">
                                <div style="position: absolute; background-color: #ffffff; min-width: 400px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); border-radius: 10px; z-index: 1">
                                    <form style="justify-content: space-around; display: list-item; padding: 10px">
                                        <div class="row">
                                            <div class="col-6">
                                                <div>
                                                    <input id="all5" class="column unchecked" type="checkbox">
                                                    <label for="all5">Все</label>
                                                </div>
                                                <div>
                                                    <input id="level" class="column checked" type="checkbox" checked>
                                                    <label for="level">Этаж</label>
                                                </div>
                                                <div>
                                                    <input id="room" class="column checked" type="checkbox" checked>
                                                    <label for="room">Комната</label>
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
                                                    <input id="status" class="column checked" type="checkbox" checked>
                                                    <label for="status">Статус</label>
                                                </div>
                                                <div>
                                                    <input id="form_edu" class="column unchecked" type="checkbox">
                                                    <label for="form_edu">Форма обучения</label>
                                                </div>
                                                <div>
                                                    <input id="group" class="column unchecked" type="checkbox">
                                                    <label for="group">Группа</label>
                                                </div>
                                                <div>
                                                    <input id="passport" class="column unchecked" type="checkbox">
                                                    <label for="passport">Паспорт</label>
                                                </div>
                                                <div>
                                                    <input id="issued_pas" class="column unchecked" type="checkbox">
                                                    <label for="issued_pas">Кем выдан</label>
                                                </div>
                                                <div>
                                                    <input id="date_pas" class="column unchecked" type="checkbox">
                                                    <label for="date_pas">Дата выдачи</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div>
                                                    <input id="date_births" class="column checked" type="checkbox" checked>
                                                    <label for="date_births">Дата рождения</label>
                                                </div>
                                                <div>
                                                    <input id="hometown" class="column unchecked" type="checkbox">
                                                    <label for="hometown">Родной город</label>
                                                </div>
                                                <div>
                                                    <input id="contract" class="column unchecked" type="checkbox">
                                                    <label for="contract">Договор</label>
                                                </div>
                                                <div>
                                                    <input id="balance" class="column checked" type="checkbox" checked>
                                                    <label for="balance">Баланс</label>
                                                </div>
                                                <div>
                                                    <input id="phone" class="column checked" type="checkbox" checked>
                                                    <label for="phone">Телефон</label>
                                                </div>
                                                <div>
                                                    <input id="email" class="column unchecked" type="checkbox">
                                                    <label for="email">Почта</label>
                                                </div>
                                                <div>
                                                    <input id="work_out" class="column unchecked" type="checkbox">
                                                    <label for="work_out">Отработано часов</label>
                                                </div>
                                                <div>
                                                    <input id="date_flg" class="column unchecked" type="checkbox">
                                                    <label for="date_flg">Дата флг</label>
                                                </div>
                                                <div>
                                                    <input id="photo" class="column unchecked" type="checkbox">
                                                    <label for="photo">Фото</label>
                                                </div>
                                                <div>
                                                    <input id="properties" class="column unchecked" type="checkbox">
                                                    <label for="properties">Имущество</label>
                                                </div>
                                                <div>
                                                    <input id="family" class="column unchecked" type="checkbox">
                                                    <label for="family">Контакты родителей</label>
                                                </div>
                                                <div>
                                                    <input id="notes" class="column unchecked" type="checkbox">
                                                    <label for="notes">Примечания</label>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <button onclick="openDiv(1)" class="btn btn-secondary buttons-livevis" type="button">Проживают <i class="fas fa-caret-down i_column"></i></button>
                            <div class="div_column" style="display: none; position: relative;">
                                <div style="position: absolute; background-color: #ffffff; min-width: 160px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); border-radius: 10px; z-index: 1">
                                    <form style="justify-content: space-around; display: list-item; padding: 10px">
                                        <div>
                                            <input id="all6" class="live_ch unchecked" type="checkbox">
                                            <label for="all6">Все</label>
                                        </div>
                                        <div>
                                            <input id="live" class="live_ch checked" type="checkbox" checked>
                                            <label for="live">Проживают</label>
                                        </div>
                                        <div>
                                            <input id="unlive" class="live_ch unchecked" type="checkbox">
                                            <label for="unlive">Не проживают</label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-5">
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
                <div class="row" style="overflow: auto;">
                    <table id="table" class="table table-bordered table-striped dataTable dtr-inline">
                        <thead>
                        <tr>
                            <th class="ascdesc">Этаж
                                <button onclick="myFunction(0)" class="btn btn-sm"><i class="fas fas fa-filter"></i></button>
                                <div class="div_filter" style="display: none; position: relative;">
                                    <div style="position: absolute; background-color: #ffffff; min-width: 80px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); border-radius: 10px;">
                                        <form style="justify-content: space-around; display: grid;">
                                            <div>
                                                <input id="all" class="filter checked" type="checkbox" checked>
                                                <label for="all">Все</label>
                                            </div>
                                            <div>
                                                <input id="two" class="filter checked" type="checkbox" checked>
                                                <label for="two">2</label>
                                            </div>
                                            <div>
                                                <input id="three" class="filter checked" type="checkbox" checked>
                                                <label for="three">3</label>
                                            </div>
                                            <div>
                                                <input id="four" class="filter checked" type="checkbox" checked>
                                                <label for="four">4</label>
                                            </div>
                                            <div>
                                                <input id="five" class="filter checked" type="checkbox" checked>
                                                <label for="five">5</label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </th>
                            <th class="ascdesc">Комната
                                <button onclick="myFunction(1)" class="btn btn-sm"><i class="fas fas fa-filter"></i></button>
                                <div class="div_filter" style="display: none; position: relative;">
                                    <div style="position: absolute; background-color: #ffffff; min-width: 80px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); border-radius: 10px;">
                                        <form style="justify-content: space-around; display: grid;">
                                            <div>
                                                <input id="all1" class="filter checked" type="checkbox" checked>
                                                <label for="all1">Все</label>
                                            </div>
                                            @foreach ($rooms as $room)
                                                <div>
                                                    <input id="{{ $room->id }}" class="filter checked" type="checkbox" checked>
                                                    <label for="{{ $room->id }}">{{ $room->number }}</label>
                                                </div>
                                            @endforeach
                                        </form>
                                    </div>
                                </div>
                            </th>
                            <th class="ascdesc">Фамилия</th>
                            <th>Имя</th>
                            <th>Отчество</th>
                            <th>Статус
                                <button onclick="myFunction(2)" class="btn btn-sm"><i class="fas fas fa-filter"></i></button>
                                <div class="div_filter" style="display: none; position: relative;">
                                    <div style="position: absolute; background-color: #ffffff; min-width: 220px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); border-radius: 10px;">
                                        <form style="justify-content: space-around; display: grid;">
                                            <div>
                                                <input id="all2" class="filter checked" type="checkbox" checked>
                                                <label for="all2">Все</label>
                                            </div>
                                            <div>
                                                <input id="normal" class="filter checked" type="checkbox" checked>
                                                <label for="normal">Обычный</label>
                                            </div>
                                            <div>
                                                <input id="invalid" class="filter checked" type="checkbox" checked>
                                                <label for="invalid">Инвалид</label>
                                            </div>
                                            <div>
                                                <input id="foreign" class="filter checked" type="checkbox" checked>
                                                <label for="foreign">Иностранный студент</label>
                                            </div>
                                            <div>
                                                <input id="orphan" class="filter checked" type="checkbox" checked>
                                                <label for="orphan">Сирота</label>
                                            </div>
                                            <div>
                                                <input id="needy" class="filter checked" type="checkbox" checked>
                                                <label for="needy">Малоимущая семья</label>
                                            </div>
                                            <div>
                                                <input id="incomplete" class="filter checked" type="checkbox" checked>
                                                <label for="incomplete">Неполная семья</label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </th>
                            <th style="display: none">Форма обучения
                                <button onclick="myFunction(3)" class="btn btn-sm"><i class="fas fas fa-filter"></i></button>
                                <div class="div_filter" style="display: none; position: relative;">
                                    <div style="position: absolute; background-color: #ffffff; min-width: 100px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); border-radius: 10px;">
                                        <form style="justify-content: space-around; display: grid;">
                                            <div>
                                                <input id="all3" class="filter checked" type="checkbox" checked>
                                                <label for="all3">Все</label>
                                            </div>
                                            <div>
                                                <input id="budget" class="filter checked" type="checkbox" checked>
                                                <label for="budget">Бюджет</label>
                                            </div>
                                            <div>
                                                <input id="payment" class="filter checked" type="checkbox" checked>
                                                <label for="payment">Платно</label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </th>
                            <th style="display: none">Группа</th>
                            <th style="display: none">Паспорт</th>
                            <th style="display: none">Кем выдан</th>
                            <th style="display: none">Дата выдачи</th>
                            <th class="ascdesc">Дата рождения</th>
                            <th style="display: none">Родной город</th>
                            <th style="display: none">Договор</th>
                            <th class="ascdesc">Баланс</th>
                            <th>Телефон</th>
                            <th style="display: none">Почта</th>
                            <th class="ascdesc" style="display: none">Отработано часов</th>
                            <th class="ascdesc" style="display: none">Дата флг</th>
                            <th style="display: none">Фото</th>
                            <th style="display: none">Имущество</th>
                            <th style="display: none">Контакты родителей</th>
                            <th style="display: none">Примечания</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($students as $student)
                            @if ($student->live)
                                <tr class="odd" style="display: none">
                            @else
                                <tr class="odd">
                            @endif
                                <td class="seo td_filter">{{ $student->room->level }}</td>
                                <td class="seo td_filter">{{ $student->room->number }}</td>
                                <td class="seo">{{ $student->surname }}</td>
                                <td class="seo">{{ $student->name }}</td>
                                <td class="seo">{{ $student->patronymic }}</td>
                                <td class="seo td_filter">{{ $student->status }}</td>
                                <td class="seo td_filter" style="display: none">{{ $student->form_edu }}</td>
                                <td class="seo" style="display: none">{{ $student->group }}</td>
                                <td class="seo" style="display: none">{{ $student->passport }}</td>
                                <td class="seo" style="display: none">{{ $student->issued_pas }}</td>
                                <td class="seo" style="display: none">{{ $student->date_pas }}</td>
                                <td class="seo">{{ $student->date_births }}</td>
                                <td class="seo" style="display: none">{{ $student->hometown }}</td>
                                <td style="display: none"><a href="{{ $student->getContract() }}">{{ $student->contract }}</a></td>
                                <td class="seo">{{ $student->balance }}</td>
                                <td class="seo">{{ $student->phone }}</td>
                                <td class="seo" style="display: none">{{ $student->email }}</td>
                                <td class="seo" style="display: none">{{ $student->work_out }}</td>
                                <td class="seo" style="display: none">{{ $student->date_flg }}</td>
                                <td style="display: none"><img src="{{ $student->getImage() }}" alt="" class="img-thumbnail mt-2" width="200"></td>
                                <td style="display: none">
                                    @foreach($student->properties as $property_student)
                                        @foreach($properties as $property)
                                            @if($property->id == $property_student->id)
                                                {{ $property->title }}({{ $property->mark }});
                                            @endif
                                        @endforeach
                                    @endforeach
                                </td>
                                <td class="seo" style="display: none">{{ $student->family }}</td>
                                <td class="seo" style="display: none">{{ $student->notes }}</td>
                                <td>
                                    <a href="{{ route('students.edit', ['student' => $student->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('students.destroy', ['student' => $student->id]) }}" method="post" class="float-left">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Подтвердите удаление')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                                <td class="live" style="display: none">{{ $student->live }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-12">
                        {{ $students->links() }}
                    </div>
                </div>
                @else
                    <p>Здесь пока пусто..</p>
                @endif
            </div>
    </section>

    <!-- /.content -->
@endsection

