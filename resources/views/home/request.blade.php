@extends('layouts.single')

@section('title', 'Заявки')

@section('content')

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Добавить новую заявку</h3>
        </div>
        <form action="{{ route('add_application') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="id_category">Категория</label>
                    <select class="form-control" id="id_category" name="id_category">
                        @foreach($types_applications as $k => $v)
                        <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" readonly>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
                </div>
                <div class="form-group">
                    <label for="description">Описание</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Опишите проблему">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Отправить</button>
            </div>
            @if(session('success'))
            <script>
                $(document).ready(function() {
                    $('#successModal').modal('show');
                });
            </script>
            @endif
        </form>
    </div>
</section>

@endsection

@section('right')

<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
    <div class="sidebar">
        <div class="widget-no-style">
            <div class="newsletter-widget text-center align-self-center">
                <h3 class="widget-title">Активные заявки</h3>
            </div>
        </div>
        <div class="widget">
            <div class="link-widget">
                <ul>
                    @foreach($applications as $application)
                    <li>{{ $application->type->name_category }} - {{ $application->description }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection