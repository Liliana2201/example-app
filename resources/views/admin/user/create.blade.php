@extends('admin.layouts.layout')

@section('content')
    <section>
        <div class="card-header">
            <h3 class="card-title">Регистрация</h3>
        </div>
        <form role="form" method="post" action="{{ route('register.store') }}">
            <div class="card-body">
                @csrf
                <div class="form-group">
                    <label for="user">Студент</label>
                    <select class="form-control @error('user') is-invalid @enderror" id="user" name="user">
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->surname }} {{ $student->name }} {{ $student->patronymic }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Зарегистрировать</button>
            </div>
        </form>
    </section>
@endsection
