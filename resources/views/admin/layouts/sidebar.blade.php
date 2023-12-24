<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" target="_blank" class="brand-link">
        <img src="{{ asset('assets/admin/img/logo.png') }}" alt="logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Перейти на сайт</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/admin/img/avatar.jpg') }}" class="img-circle elevation-2" alt="avatar">
            </div>
            <div class="info">
                <a href="#" class="d-block">Шубина Лилиана</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Главная
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Общежития
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dormitories.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Список общежитий</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dormitories.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Добавить новое</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Имущество
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('properties.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Список имущества</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('properties.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Добавить новое</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Состояния комнат
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('condition_rooms.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Список состояний</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('condition_rooms.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Добавить новое</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Комнаты
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('rooms.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Список комнат</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('rooms.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Добавить новую</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Должности
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('posts.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Список должностей</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('posts.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Добавить новую</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Сотрудники
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('staff.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Список сотрудников</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('staff.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Добавить нового</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Студенты
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('students.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Список студентов</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('students.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Добавить нового</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Категории заявок
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('types_applications.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Список категорий</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('types_applications.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Добавить новую</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Заявки
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('applications.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Список заявок</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('applications.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Добавить новую</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Стиральные машины
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('washing_machines.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Список машин</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('washing_machines.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Добавить новую</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Стирки
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('laundries.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Список стирок</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laundries.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Добавить новую</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Тэги
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('tags.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Список тэгов</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tags.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Добавить новый</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Новости
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('news.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Список новостей</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('news.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Добавить новую</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
