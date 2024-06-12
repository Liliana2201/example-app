<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/plain; charset=UTF-8"/>
    <title>Админка</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper" style="min-width: fit-content;">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top" >
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->
            <li>
                <button type="button" class="btn btn-danger btn-sm">
                    <a href="{{ route('logout') }}" style="color: #ffffff">Выйти</a>
                </button>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    @include('admin.layouts.sidebar')
    >

    <div class="content-wrapper" style=" margin-top: 40px">
        <div class="container mt-5">
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

    // функция сортировки столбцов в алфавитном порядке и наоборот если у столбца присутствует класс ascdesc
    const table = document.querySelector("#table");
    const th = table.querySelectorAll("th");
    let tbody = table.querySelector("tbody");
    let rows = [...tbody.rows];

    th.forEach((header) => {
        if (header.classList.contains("ascdesc")){
            header.addEventListener("click", function () {
                let columnIndex = header.cellIndex;
                let sortDirection =
                    header.getAttribute("data-sort-direction") === "asc" ? "desc" : "asc";
                header.setAttribute("data-sort-direction", sortDirection);

                rows.sort((a, b) => {
                    let aValue = a.cells[columnIndex].textContent;
                    let bValue = b.cells[columnIndex].textContent;

                    if (sortDirection === "asc") {
                        return aValue > bValue ? 1 : -1;
                    } else {
                        return bValue > aValue ? 1 : -1;
                    }
                });

                tbody.remove();
                tbody = document.createElement("tbody");
                rows.forEach((row) => tbody.appendChild(row));
                table.appendChild(tbody);
            });
        }
    });
    // функция отображения окна с фильтром и перекрашивания иконки, типо активная
    function myFunction(i) {
        let btn = document.getElementsByClassName("div_filter").item(i);
        let icon = document.getElementsByClassName("fa-filter").item(i);
        if (btn.style.display === "none"){
            btn.style.display="inline-block";
            icon.style.color="#007bff";
        }
        else{
            btn.style.display="none";
            icon.style.color="#000000";
        }
    }
    // функция фильтрации записей
    const btn = document.getElementsByClassName("div_filter");
    const tr = document.getElementById("table").querySelectorAll("tr");

    for (let a=0; a<btn.length; a++){
        const check = btn.item(a).getElementsByClassName("filter");
        for (let i=0; i < check.length; i++){
            check.item(i).addEventListener('change', function() {
                if (check.item(i).id.includes('all')){
                    if (check.item(i).classList.contains("unchecked")){ // если включили "все"
                        check.item(i).classList.replace("unchecked", "checked");
                        for (let j = i; j < check.length; j++){
                            check.item(j).classList.replace("unchecked", "checked");
                            check.item(j).checked = true;
                        } // убираем у скрытых строк этот класс
                        for (let n=1; n<tr.length; n++){
                            if (tr[n].style.display === "none")
                                tr[n].style.display = "";
                        }
                    }
                    else{ // если выключили "все"
                        check[i].classList.replace("checked", "unchecked");
                        for (let j = i; j < check.length; j++){
                            check.item(j).classList.replace("checked", "unchecked");
                            check.item(j).checked = false;
                        } // добавляем всем строкам в таблицы скрытность
                        for (let n=1; n<tr.length; n++){
                            tr[n].style.display = "none";
                        }
                    }
                }
                else{
                    if (check.item(i).classList.contains("unchecked")){ // включили один из пунктов
                        check.item(i).classList.replace("unchecked", "checked");
                        let flag = true;
                        for (let k=1; k<check.length; k++){
                            if (check.item(k).classList.contains("unchecked") && k !== i)
                                flag=false;
                        }
                        if(flag){ // если все остальные включены, включили "все"
                            check.item(0).classList.replace("unchecked", "checked");
                            check.item(0).checked = true;
                        }
                        let label = document.querySelector('label[for="' + check.item(i).id + '"]');
                        for (let n=1; n<tr.length; n++){
                            let td = tr[n].getElementsByTagName("td");
                            for (let k=0; k<td.length; k++){
                                if (td[k].classList.contains("td_filter") && td[k].innerText.includes(label.innerText)){
                                    if(tr[n].style.display === "none")
                                        tr[n].style.display = "";
                                }
                            }
                        }
                    }
                    else{ // выключили один из пунктов
                        check.item(i).classList.replace("checked", "unchecked");
                        if (check.item(0).classList.contains("checked")){ // если включено "все" - выключаем
                            check.item(0).classList.replace("checked", "unchecked");
                            check.item(0).checked = false;
                        }
                        let label = document.querySelector('label[for="' + check.item(i).id + '"]');
                        for (let n=1; n<tr.length; n++){
                            let td = tr[n].getElementsByTagName("td");
                            for (let k=0; k<td.length; k++){
                                if (td[k].classList.contains("td_filter") && td[k].innerText.includes(label.innerText)){
                                    tr[n].style.display = "none";
                                }
                            }
                        }
                    }
                }
            });
        }
    }
    // функция отображения проживающих и не проживающих студентов
    const check_live = document.getElementsByClassName("live_ch");

    for (let i=0; i < check_live.length; i++){
        check_live.item(i).addEventListener('change', function() {
            if (check_live.item(i).id.includes('all')){
                if (check_live.item(i).classList.contains("unchecked")){ // если включили "все"
                    check_live.item(i).classList.replace("unchecked", "checked");
                    for (let j = i; j < check_live.length; j++){
                        check_live.item(j).classList.replace("unchecked", "checked");
                        check_live.item(j).checked = true;
                    } // убираем у скрытых строк этот класс
                    for (let n=1; n<tr.length; n++){
                        tr[n].style.display = "";
                    }
                }
                else{ // если выключили "все"
                    check_live[i].classList.replace("checked", "unchecked");
                    for (let j = i; j < check_live.length; j++){
                        check_live.item(j).classList.replace("checked", "unchecked");
                        check_live.item(j).checked = false;
                    } // добавляем всем строкам в таблице скрытность
                    for (let n=1; n<tr.length; n++){
                        tr[n].style.display = "none";
                    }
                }
            }
            else{
                if (check_live.item(i).classList.contains("unchecked")){ // включили один из пунктов
                    check_live.item(i).classList.replace("unchecked", "checked");
                    let flag = true;
                    for (let k=1; k<check_live.length; k++){
                        if (check_live.item(k).classList.contains("unchecked") && k !== i)
                            flag=false;
                    }
                    if(flag){ // если все остальные включены, включили "все"
                        check_live.item(0).classList.replace("unchecked", "checked");
                        check_live.item(0).checked = true;
                    }
                    if (check_live.item(i).id === 'live')
                        for (let n=1; n<tr.length; n++){
                            if (tr[n].getElementsByClassName('live').item(0).innerText == 0)
                                tr[n].style.display = "";
                        }
                    else
                        for (let n=1; n<tr.length; n++){
                            if (tr[n].getElementsByClassName('live').item(0).innerText == 1)
                                tr[n].style.display = "";
                        }
                }
                else{ // выключили один из пунктов
                    check_live.item(i).classList.replace("checked", "unchecked");
                    if (check_live.item(0).classList.contains("checked")){ // если включено "все" - выключаем
                        check_live.item(0).classList.replace("checked", "unchecked");
                        check_live.item(0).checked = false;
                    }
                    if (check_live.item(i).id === 'live')
                        for (let n=1; n<tr.length; n++){
                            if (tr[n].getElementsByClassName('live').item(0).innerText == 0)
                                tr[n].style.display = "none";
                        }
                    else
                        for (let n=1; n<tr.length; n++){
                            if (tr[n].getElementsByClassName('live').item(0).innerText == 1)
                                tr[n].style.display = "none";
                        }
                }
            }
        });
    }

    function openDiv(i) {
        let btn = document.getElementsByClassName("div_column").item(i);
        let icon = document.getElementsByClassName("i_column").item(i);
        if (btn.style.display === "none"){
            btn.style.display="inline-block";
            icon.classList.remove("fa-caret-down");
            icon.classList.add("fa-caret-up");
        }
        else{
            btn.style.display="none";
            icon.classList.remove("fa-caret-up");
            icon.classList.add("fa-caret-down");
        }
    }
    const check_col = document.getElementsByClassName("column");

    for (let i=0; i < check_col.length; i++){
        check_col.item(i).addEventListener('change', function() {
            if (check_col.item(i).id.includes('all')){
                if (check_col.item(i).classList.contains("unchecked")){ // если включили "все"
                    check_col.item(i).classList.replace("unchecked", "checked");
                    for (let j = i; j < check_col.length; j++){
                        check_col.item(j).classList.replace("unchecked", "checked");
                        check_col.item(j).checked = true;
                    } // убираем у скрытых заголовков этот класс
                    for (let n=0; n<th.length; n++){
                        if (th[n].style.display === "none")
                            th[n].style.display = "";
                    } // убираем у скрытых столбцов этот класс
                    for (let n=1; n<tr.length; n++){
                        let td = tr[n].getElementsByTagName("td");
                        for (let k=0; k<td.length; k++){
                            if (td[k].style.display === "none")
                                td[k].style.display = "";
                        }
                    }
                }
                else{ // если выключили "все"
                    check_col[i].classList.replace("checked", "unchecked");
                    for (let j = i; j < check_col.length; j++){
                        check_col.item(j).classList.replace("checked", "unchecked");
                        check_col.item(j).checked = false;
                    } // добавляем всем столбцам в таблицы скрытность
                    for (let n=0; n<th.length; n++) {
                        th[n].style.display = "none";
                    }
                    for (let n=1; n<tr.length; n++){
                        let td = tr[n].getElementsByTagName("td");
                        for (let k=0; k<td.length; k++){
                            td[k].style.display = "none";
                        }
                    }
                }
            }
            else{
                if (check_col.item(i).classList.contains("unchecked")){ // включили один из пунктов
                    check_col.item(i).classList.replace("unchecked", "checked");
                    let flag = true;
                    for (let k=1; k<check_col.length; k++){
                        if (check_col.item(k).classList.contains("unchecked") && k !== i)
                            flag=false;
                    }
                    if(flag){ // если все остальные включены, включили "все"
                        check_col.item(0).classList.replace("unchecked", "checked");
                        check_col.item(0).checked = true;
                    }
                    let label = document.querySelector('label[for="' + check_col.item(i).id + '"]');
                    for (let n=0; n<th.length; n++) {
                        if (th[n].innerText.includes(label.innerText)){
                            if (th[n].style.display === "none"){
                                th[n].style.display = "";
                                for (let k=1; k<tr.length; k++){
                                    let td = tr[k].getElementsByTagName("td")[n];
                                    if (td.style.display === "none")
                                        td.style.display = "";
                                }
                            }
                        }
                    }
                }
                else{ // выключили один из пунктов
                    check_col.item(i).classList.replace("checked", "unchecked");
                    if (check_col.item(0).classList.contains("checked")){ // если включено "все" - выключаем
                        check_col.item(0).classList.replace("checked", "unchecked");
                        check_col.item(0).checked = false;
                    }
                    let label = document.querySelector('label[for="' + check_col.item(i).id + '"]');
                    for (let n=0; n<th.length; n++) {
                        if (th[n].innerText.includes(label.innerText)){
                            th[n].style.display = "none";
                            for (let k=1; k<tr.length; k++){
                                let td = tr[k].getElementsByTagName("td")[n];
                                td.style.display = "none";
                            }
                        }
                    }
                }
            }
        });
    }
    function copytable(el) {
        var urlField = document.getElementById(el)
        var range = document.createRange()
        range.selectNode(urlField)
        window.getSelection().addRange(range)
        document.execCommand('copy')
    }

</script>
</body>
</html>
