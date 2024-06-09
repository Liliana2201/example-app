<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed;">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" target="_blank" class="brand-link">
        <img src="{{ asset('assets/admin/img/logo.png') }}" alt="logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Перейти на сайт</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="display: flex; ">
            <div class="image">
                <img src="{{asset(Auth::user()->photo)}}" class="img-circle elevation-2" alt="avatar" style="width: 3rem;">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>

        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @if (Auth::user()->is_admin)
                    <li class="nav-item">
                        <a href="{{ route('register.create') }}" class="nav-link">
                            <i class="nav-icon fas fa-user-plus"></i>
                            <p>
                                Зарегистрировать SMM
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('admin.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Главная
                        </p>
                    </a>
                </li>
                @if (Auth::user()->is_admin || Auth::user()->is_house)
                    <li class="nav-item">
                        <a href="{{ route('properties.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-layer-group"></i>
                            <p>
                                Имущество
                            </p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->is_admin)
                    <li class="nav-item">
                        <a href="{{ route('condition_rooms.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-brush"></i>
                            <p>
                                Состояния комнат
                            </p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->is_admin || Auth::user()->is_house || Auth::user()->is_head)
                <li class="nav-item">
                    <a href="{{ route('rooms.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-bed"></i>
                        <p>
                            Комнаты
                        </p>
                    </a>
                </li>
                @endif
                @if (Auth::user()->is_admin)
                    <li class="nav-item">
                        <a href="{{ route('posts.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-address-card"></i>
                            <p>
                                Должности
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('staff.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>
                                Сотрудники
                            </p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->is_admin || Auth::user()->is_house || Auth::user()->is_head)
                    <li class="nav-item">
                        <a href="{{ route('students.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-user-graduate"></i>
                            <p>
                                Студенты
                            </p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->is_admin)
                <li class="nav-item">
                    <a href="{{ route('types_applications.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Категории заявок
                        </p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('applications.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>
                            Заявки
                        </p>
                    </a>
                </li>
                @if (Auth::user()->is_admin || Auth::user()->is_house || Auth::user()->is_head)
                    <li class="nav-item">
                        <a href="{{ route('washing_machines.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-screwdriver"></i>
                            <p>
                                Стиральные машины
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('laundries.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>
                                Стирки
                            </p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->is_admin || Auth::user()->is_smm)
                <li class="nav-item">
                    <a href="{{ route('tags.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>
                            Тэги
                        </p>
                    </a>
                </li>
                @endif
                @if (Auth::user()->is_admin || Auth::user()->is_head || Auth::user()->is_smm)
                <li class="nav-item">
                    <a href="{{ route('news.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>
                            Новости
                        </p>
                    </a>
                </li>
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
