<!DOCTYPE html>

<html lang="ru">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('/assets/students/css/web.assets_common.0.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/students/css/website.assets_frontend.0.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/students/css/website.assets_frontend.1.css') }}">
    <link rel="icon" type="image/png" href="/assets/students/img/favicon-32x32.png">
    <script src="/assets/students/js/web.assets_common.js"></script>
    <script src="/assets/students/js/website.assets_frontend.js"></script>
    <script src="https://kit.fontawesome.com/7cdabb21f6.js" crossorigin="anonymous"></script>

</head>

<body>
    <div id="js-mobile-mmenu" class="mobile-mmenu mm-menu mm-offcanvas mm-hasnavbar-bottom-1 mm-fx-menu-slide mm-pagedim-black mm-border-full mm-multiline" aria-hidden="true">
        <div class="mm-panel mm-hidden mm-hasnavbar" id="mm-7" aria-hidden="true">
            <div class="mm-navbar">
                <ul class="mm-listview">
                    <li><a href="https://abiturient.sibsau.ru/">Главная</a></li>
                    @if (Route::has('login'))
                    @auth
                    <li><a href="ссылка на личный кабинет">Личный кабинет</a></li>
                    <li><a href="{{ route('logout') }}">Выйти</a></li>
                    @else
                    <li><a href="https://abiturient.sibsau.ru/">Поступающему</a></li>
                    <li><a href="{{ route('login') }}">Войти</a></li>
                    @endauth
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapwrap" class="mm-page mm-slideout">
        <header id="sibgu_header">
            <header class="main-head">
                <div class="top-line">
                    <div class="container">
                        <div class="top-line-left-content">
                            <div class="mobile-menu-button-wrap">
                                <button id="js-button-mobile-mmenu" class="hamburger hamburger--spin" type="button">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>

                        </div>
                        <div class="top-line-right-content">
                            <div class="res-links-wrap">
                                <div class="res-links">
                                    <div id="js-res-links" class="droplist-main">
                                        @if (Route::has('login'))
                                        @auth
                                        <div class="quick-links-wrap">
                                            <div class="quick-links">
                                                <a href="ссылка на личный кабинет">Личный кабинет</a>
                                            </div>
                                        </div>
                                        @endauth
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="head-content">
                    <div class="container">
                        <div class="main-title-wrap clearfix">
                            <img class="main-logo" src="\assets\students\img\main_logo.svg">
                            <span class="main-title-container">
                                <h1 class="main-title"> Университет Решетнёва. Общежитие № 3</h1>
                            </span>
                        </div>
                    </div>
                    <div class="search-area search-area--mobile">
                        <form class="search-area-form" action="https://sibsau.ru/page/search" method="get" target="_self" accept-charset="utf-8" role="search">
                            <div>
                                <input type="hidden" name="searchid" value="2334777">
                                <input type="hidden" name="l10n" value="ru">
                                <input type="hidden" name="reqenc" value="">
                                <input type="text" name="text" placeholder=" Поиск">
                                <button type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="dekstop-target-menu dekstop-target-menu--inner">
                    <div class="container">
                        <ul id="js-main-audit-menu" class="wrap-target-menu clearfix">
                            <li>
                                <a target="_blank" href="https://abiturient.sibsau.ru/"><i class="fa fa-home" aria-hidden="true"></i>Главная</a>
                            </li>
                            @if (Route::has('login'))
                            @auth
                            <li>
                                <a target="_blank" href="{{ route('logout') }}"><i class="fa-solid fa-clipboard"></i>Новости</a>
                            </li>
                            <li>
                                <a target="_blank" href="{{ route('logout') }}"><i class="fa-solid fa-pen-to-square"></i>Заявки</a>
                            </li>
                            <li>
                                <a target="_blank" href="{{ route('logout') }}"><i class="fa-solid fa-jug-detergent"></i>Стирка</a>
                            </li>
                            <li>
                                <a target="_blank" href="{{ route('logout') }}"><i class="fa fa-ban" aria-hidden="true"></i>Жалоба на шум</a>
                            </li>
                            <li>
                                <a target="_blank" href="{{ route('logout') }}"><i class="fa-solid fa-door-closed"></i>Выход</a>
                            </li>
                            @else
                            <li>
                                <a target="_blank" href="https://abiturient.sibsau.ru/"><i class="fa fa-user" aria-hidden="true"></i>Поступающему</a>
                            </li>
                            <li>
                                <a target="_blank" href="{{ route('login') }}"><i class="fa-solid fa-door-open"></i>Войти</a>
                            </li>
                            @endauth
                            @endif
                        </ul>
                    </div>
                </div>
            </header>
        </header>
        <main>
            @yield('slider')
            <section class="main-sect white-sect news-sect">
                <div class="container">
                    @yield('content')
                </div>
            </section>
        </main>
        <footer>
            <div class="main-footer">
                <div class="foot-first-level">
                    <div class="container">
                        <div class="row wrap-foot-level second-foot-line">
                            <div class="col-md-8 col-sm-12" style="height: auto;">
                                <div class="wrap-foot-contacts">
                                    <h5>Адреc</h5>
                                    <ul class="foot-contacts-content">
                                        <li>660037, Сибирский федеральный округ, <br>Красноярский край, г. Красноярск, <br>​Ленинский район, Волгоградская улица, 35</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12" style="height: auto;">
                                <div class="wrap-foot-contancts">
                                    <h5>Контакты</h5>
                                    <ul class="foot-contacts-content foot-contacts-content-col-2">
                                        Заведующая общежитием</br>Ракута Алена Романовна <strong class="foot-contacts-item"><a href="tel:+73912629556">+7 391 262-95-56</a></strong></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12" style="height: auto;">
                                <div class="wrap-foot-contacts">
                                    <a href="https://www.sibsau.ru/page/contacts">Пользовательское соглашение</a><br>
                                    <a href="https://www.sibsau.ru/map/">Политика конфиденциальности</a>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="foot-second-level">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-24">
                                <div class="copy-sibgu">© Сибирский государственный университет науки и технологий имени академика М.Ф. Решетнева,
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="/assets/students/js/jquery-libs.js"></script>
            <script src="/assets/students/js/common.js"></script>
            <script type="text/javascript" src="/assets/students/js/openapi.js"></script>
        </footer>
    </div>
    <div id="mm-blocker" class="mm-slideout"></div>
</body>

</html>