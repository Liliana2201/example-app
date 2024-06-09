@extends('layouts.layout')

@section('title', 'Стирка')

@section('content')

<div class="container-fluid">
    <!-- Календарь будет вставлен здесь -->
</div>
<div id="schedule" class="hidden">
    <p id="selected-date"></p>
    <table id="time-slots">
        <tr>
            <th>Время</th>
            <th>Машинка 1</th>
            <th>Машинка 2</th>
            <th>Машинка 3</th>
        </tr>
        <!-- Временные интервалы будут вставлены здесь -->
    </table>
</div>

<div id="modalOverlay" class="modal-overlay hidden"></div>

<div id="modal" class="hidden">
    <p id="confirmation"></p>
    <button onclick="closeModal()">Закрыть</button>
</div>

<script>
    const timeIntervals = [
        '06:00 - 07:10', '07:10 - 08:20', '08:20 - 09:30', '09:30 - 10:40',
        '10:40 - 11:50', '12:00 - 13:10', '13:10 - 14:20', '14:20 - 15:30',
        '15:30 - 16:40', '16:40 - 17:50', '18:00 - 19:10', '19:10 - 20:20',
        '20:20 - 21:30', '21:30 - 22:40', '22:40 - 23:50'
    ];

    function createFullMonthCalendar() {
        var now = new Date();
        var currentMonth = now.getMonth();
        var currentYear = now.getFullYear();
        var firstDayOfMonth = new Date(currentYear, currentMonth, 1);
        var lastDayOfMonth = new Date(currentYear, currentMonth + 1, 0);

        // Получаем день недели первого дня месяца и корректируем его, чтобы неделя начиналась с понедельника
        var startDayOfWeek = firstDayOfMonth.getDay();
        var adjustedStartDay = (startDayOfWeek === 0) ? 6 : startDayOfWeek - 1;

        var calendar = '<div class="calendar">';
        var header = '<h2>Запись на ';

        // Проверяем, затрагивают ли активные дни следующий месяц
        var lastActiveDay = addDays(now, 3);
        if (lastActiveDay.getMonth() !== currentMonth) {
            // Формируем заголовок для двух месяцев
            header += getMonthName(currentMonth) + ' - ' + getMonthName(lastActiveDay.getMonth());
        } else {
            // Формируем заголовок для одного месяца
            header += getMonthName(currentMonth);
        }
        header += '</h2>';

        // Добавляем заголовок перед календарем
        calendar = header + calendar;

        // Добавляем пустые ячейки для дней до первого понедельника месяца
        for (var i = 0; i < adjustedStartDay; i++) {
            calendar += '<div class="day inactive"></div>';
        }

        // Создаем ячейки календаря для каждого дня месяца
        for (var day = 1; day <= lastDayOfMonth.getDate(); day++) {
            var date = new Date(currentYear, currentMonth, day);
            var isWithinActiveRange = date >= now && date <= addDays(now, 3);
            var className = isWithinActiveRange ? 'day active-day' : 'day inactive';
            if (day === now.getDate()) {
                className += ' today';
            }
            calendar += '<div class="' + className + '" ' + (isWithinActiveRange ? 'onclick="selectDate(' + day + ', ' + currentMonth + ', ' + currentYear + ')"' : '') + '>' + day + '</div>';
        }
        calendar += '</div>';
        return calendar;
    }

    function addDays(date, days) {
        var result = new Date(date);
        result.setDate(result.getDate() + days);
        return result;
    }

    function selectDate(day, month, year) {
        var selectedDate = new Date(year, month, day);
        document.getElementById('schedule').classList.remove('hidden');
        const options = {
            day: 'numeric',
            month: 'long',
            weekday: 'long'
        };
        const formattedDate = selectedDate.toLocaleDateString('ru-RU', options);
        document.getElementById('selected-date').textContent = `Выбранное число: ${formattedDate}`;
        generateTimeSlots();
    }

    function disableRandomButtons(count) {
        const buttons = document.querySelectorAll('#time-slots button');
        const shuffled = [...buttons].sort(() => 0.5 - Math.random());
        shuffled.slice(0, count).forEach(button => {
            button.disabled = true;
            button.textContent = 'Записи нет'; // Добавлен текст для неактивных кнопок
        });
    }

    function generateTimeSlots() {
        const timeSlotsTable = document.getElementById('time-slots');
        // Удаляем предыдущие строки, кроме заголовка
        while (timeSlotsTable.rows.length > 1) {
            timeSlotsTable.deleteRow(1);
        }
        // Добавляем строки с временными интервалами и кнопками
        timeIntervals.forEach(interval => {
            const row = timeSlotsTable.insertRow();
            const timeCell = row.insertCell();
            timeCell.textContent = interval;
            for (let i = 0; i < 3; i++) {
                const cell = row.insertCell();
                const button = document.createElement('button');
                button.textContent = 'Записаться';
                button.setAttribute('data-interval', interval);
                button.setAttribute('data-machine-number', i + 1);
                button.onclick = function(event) {
                    bookTime(event, interval, i + 1);
                };
                cell.appendChild(button);
            }
        });
        disableRandomButtons(17);
    }

    function bookTime(event, interval, machineNumber) {
        // Убедимся, что функция вызывается
        console.log('bookTime called with interval:', interval, 'and machineNumber:', machineNumber);

        // Отображаем оверлей
        var overlay = document.getElementById('modalOverlay');
        overlay.classList.remove('hidden');
        overlay.style.display = 'block'; // Добавьте эту строку, чтобы оверлей отображался

        // Отображаем модальное окно
        var modal = document.getElementById('modal');
        modal.classList.remove('hidden');
        modal.style.display = 'block';

        // Формируем текст подтверждения
        const selectedDate = document.getElementById('selected-date').textContent;
        confirmation.textContent = `Вы записаны на стирку. ${selectedDate}. Ваше время: ${interval}, машинка ${machineNumber}`;

        // Показываем модальное окно
        modal.style.display = 'block'; // Используем свойство style для управления отображением
        console.log(modal.classList);

        // Отключаем кнопку, чтобы предотвратить повторное бронирование
        event.currentTarget.disabled = true;
        event.currentTarget.textContent = 'Записи нет';
    }

    function closeModal() {
        // Получаем элемент модального окна и оверлея
        const modal = document.getElementById('modal');
        const overlay = document.getElementById('modalOverlay');

        // Скрываем модальное окно и оверлей
        modal.style.display = 'none';
        overlay.classList.add('hidden');
    }

    document.getElementById('time-slots').addEventListener('click', function(event) {
        if (event.target.tagName === 'BUTTON' && !event.target.disabled) {
            const interval = event.target.getAttribute('data-interval');
            const machineNumber = event.target.getAttribute('data-machine-number');
            bookTime(event, interval, machineNumber);
        }
    });

    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelector('.container-fluid').innerHTML = createFullMonthCalendar();
    });

    document.getElementById('modalOverlay').addEventListener('click', function(event) {
        closeModal();
    });

    function getMonthName(monthIndex) {
        const monthNames = [
            'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
            'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
        ];
        return monthNames[monthIndex];
    }
</script>


@endsection