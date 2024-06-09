@extends('admin.layouts.layout')

@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Главная</h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Title</h3>

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
                    @if (Auth::user()->is_admin)
                        Привет, Админ!
                    @endif
                    @if (Auth::user()->is_smm)
                        Привет, SMM!
                    @endif
                    @if (Auth::user()->is_head)
                        Привет, Заведующий общежитием!
                    @endif
                    @if (Auth::user()->is_house)
                        Привет, Заведующий хозяйством!
                    @endif
                    @if (Auth::user()->is_mentor)
                        Привет, Специалист воспитательной службы!
                    @endif
                    @if (Auth::user()->is_fitter)
                        Привет, Специалист аварийной службы!
                    @endif
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Footer
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
@endsection

