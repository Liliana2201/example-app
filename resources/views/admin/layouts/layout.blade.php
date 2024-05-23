<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Админка</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    @include(('admin.layouts.navbar'))

    @include('admin.layouts.sidebar')

    <div class="content-wrapper">
        <div class="container mt-2">
            <div id="sms" class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach($errors->all() as $error)
                                    <li>
                                        {{ $error }}
                                        <button style="float: right; margin: -0.25rem;" id="error" type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                            <button style="float: right; margin: -0.25rem;" id="success" type="button" class="btn btn-tool" data-card-widget="remove" title="Success">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @yield('content')
    </div>
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.2.0
        </div>
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="{{ asset('assets/admin/js/admin.js') }}"></script>
<script>
    var url = window.location.href;
    $('ul.nav-sidebar a').filter(function() {
        let location = window.location.protocol + '//' + window.location.host + window.location.pathname;
        let link = this.href;
        if(link == location) {
            $(this).addClass('active');
        }
    });
    $('ul.nav-treeview a').filter(function() {
        var rgx = new RegExp($(this).attr("href"), "gi");
        return url.match(rgx);
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').addClass('active');
    $(document).ready(function() {
        bsCustomFileInput.init();
    });

    const button1 = document.getElementById('error');
    if (button1) {
        button1.addEventListener('click', function () {
            closeBlock();
        });
    }
    const button2 = document.getElementById('success');
    if (button2) {
        button2.addEventListener('click', function () {
            closeBlock();
        });
    }

    function closeBlock() {
        const block = document.getElementById('sms');
        if (!block) {
            return;
        }
        return block.hidden= !block.hidden;
    }

    function Search() {
        var input, filter, table, tr, th, td, i, j, txtValue;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        table = document.getElementById("table");
        tr = table.getElementsByTagName("tr");
        th = document.getElementsByTagName("th");

        // Перебирайте все строки таблицы и скрывайте тех, кто не соответствует поисковому запросу
        for (i = 0; i < tr.length; i++) {
            for (j = 0; j < th.length; j++){
                td = tr[i].getElementsByTagName("td")[j];
                if (td && td.classList.contains("seo")) {
                    txtValue = td.textContent;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        break;
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    }
    // определиться, нужна ли эта функция вообще, ибо выбранные элементы и так серые, а то что я написала вообще не работает
    var element = document.getElementById("properties");
    var i;
    function f1(){
        if (element.childNodes.length){
            for(i = 0; i < element.childNodes.length; i++) {
                if(element.options[i].selected === true) {
                    element.options[i].setAttribute('display', 'none');
                }
                else {
                    element.options[i].removeAttribute('display')
                }
            }
        }
    }

</script>
</body>
</html>
