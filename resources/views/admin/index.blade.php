@extends('admin.layouts.layout')

@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Главная</h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row mr-2 ml-2">
                <h5>Здравствуйте, {{ Auth::user()->name }}!</h5>
            </div>

        </section>
        <!-- /.content -->
@endsection

