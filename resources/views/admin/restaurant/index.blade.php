
<table border="1" id="show_equipment">
    <caption>Таблица всех регистрационных ключей</caption>
    <tr>
        <th rowspan="2">id</th>
        <th rowspan="2">E-mail</th>
        <th rowspan="2">Название</th>
        <th rowspan="2">Сеть</th>
        <th rowspan="2">Категория</th>
        <th rowspan="2">Описание</th>
        <th rowspan="2">Телефон</th>
        <th rowspan="2">Средний чек</th>
        <th rowspan="2">Варификация</th>
        <th colspan="7">Время работы</th>

        <th rowspan="2">Проверенно цензором</th>
        <th rowspan="2">Адресс</th>
        <th rowspan="2">Местоположение</th>
        <th rowspan="2">Рейтинг</th>
        <th rowspan="2">Показывать столики</th>
        <th rowspan="2">Количество свободных столиков</th>
        <th rowspan="2">Меню</th>
        <th rowspan="2">Комментарии</th>
    </tr>
    <tr>
        <th>Подедельник</th>
        <th>Вторник</th>
        <th>Среда</th>
        <th>Четверг</th>
        <th>Пятница</th>
        <th>Суббота</th>
        <th>Воскресенье</th>
    </tr>

    @foreach($restaurants as $restaurant)
        <tr id = "{{$restaurant -> id}}">
            <td>{{$restaurant -> id}}</td>
            <td>{{$restaurant -> email}}</td>
            <td>{{$restaurant -> name}}</td>
            <td>{{$restaurant -> nets}}</td>
            <td>{{$restaurant -> category}}</td>
            <td>{{$restaurant -> description}}</td>
            <td>{{$restaurant -> phone}}</td>
            <td>{{$restaurant -> average_check}}</td>
            <td>{{$restaurant -> verified}}</td>
            <td>{{$restaurant -> monday}}</td>
            <td>{{$restaurant -> tuesday}}</td>
            <td>{{$restaurant -> wednesday}}</td>
            <td>{{$restaurant -> thursday}}</td>
            <td>{{$restaurant -> friday}}</td>
            <td>{{$restaurant -> saturday}}</td>
            <td>{{$restaurant -> sunday}}</td>
            <td>{{$restaurant -> reviewer_review}}</td>
            <td>{{$restaurant -> address}}</td>
            <td>{{$restaurant -> location}}</td>
            <td>{{$restaurant -> rating}}</td>
            <td>{{$restaurant -> display_tables}}</td>
            <td>{{$restaurant -> number_of_free_tables}}</td>
            <td class="menu_1"><button onclick="showMenu({{$restaurant-> id}})">Меню</button></td>
            <td class="comments_1"><button onclick="showComments({{$restaurant-> id}})">Комментарии</button></td>
        </tr>

        @endforeach
</table>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>


    $(document).ready(function() {
        $(document).on('click', 'tr', function () {

            location.href = '{{url('/admin/restaurant/')}}' + '/' + this.id + '/edit';
        });

        $(document).on('click', '.menu_1', function () {

            return false
        });

        $(document).on('click', '.comments_1', function () {

            return false
        });
    });

    function showMenu(id) {

        location.href = '{{url('/admin/restaurant/')}}' + '/' + id + '/menu';


    }
    function showComments(id) {

        location.href = '{{url('/admin/restaurant/comments/')}}' + '/' + id;


    }


</script>