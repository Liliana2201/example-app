@extends('layouts.layout')

@section('title', 'Личный кабинет')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <h3 class="profile-username text-center">{{ $fullName }}</h3>
                        <p class="text-muted text-center">Комната: {{ $roomNumber }}</p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Баланс</b>
                                <p class="float-right">{{ $balance }} рублей</p>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link" href="#im" data-toggle="tab">Имущество</a></li>
                            <li class="nav-item"><a class="nav-link" href="#st" data-toggle="tab">Активные записи на стирку</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="im">

                                <div class="user-block">
                                    <span class="description">
                                        {{ !empty($propertiesList) ? 'Имущество, выданное общежитием:' : 'У вас нет имущества, выданного общежитием.' }}
                                    </span>
                                    {!! $properties !!}
                                </div>

                            </div>

                            <div class="tab-pane" id="st">
                                <div>
                                    <div class="user-block">
                                        <span>{{ $laundryStatus }}</span>
                                        @if (!empty($laundryList))
                                        <ul>{!! $laundryList !!}</ul>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="settings">

                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>
</section>

@endsection