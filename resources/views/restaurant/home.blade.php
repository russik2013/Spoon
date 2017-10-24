Информация о ресторане

<p>Название</p>
{{$restaurant -> name}}
<p>Категория</p>
{{$restaurant -> name}}
<p>Описание</p>
{{$restaurant -> description}}
<p>Телефон</p>
{{$restaurant -> phone}}
<p>Средний чек</p>
{{$restaurant -> average_check}}

@if($restaurant -> verified == 0)
    <p> Не проверенный</p>
    @else
    <p>Проверенный</p>
    @endif

@if($restaurant -> specify_time == 0)

    <p>Время работы не указанно</p>
    @else
    <p>Время работы</p>

    <p>Понедельник</p>
    {{$restaurant -> monday}}
    <p>Вторник</p>
    {{$restaurant -> tuesday}}
    <p>Среда</p>
    {{$restaurant -> wednesday}}
    <p>Четверг</p>
    {{$restaurant -> thursday}}
    <p>Пятница</p>
    {{$restaurant -> friday}}
    <p>Суббота</p>
    {{$restaurant -> saturday}}
    <p>Воскресенье</p>
    {{$restaurant -> sunday}}

    @endif
<p>Адресс</p>
{{$restaurant -> address}}
<p>Местоположение</p>
{{$restaurant -> location}}
<p>Рейтинг</p>
{{$restaurant -> rating}}
<p>Фотографии</p>
<p>Блюдо недели</p>
<p>Меню</p>
<p>Приоритеты продуктов</p>
<button onclick="toPreference()">Посмотреть</button>
<p>Количество свободных столиков</p>
<p>Дата изменения</p>
{{$restaurant -> updated_at}}

<script>
    
    function toPreference() {
        document.location.href = '{{url('/restaurant/preference')}}';

    }
    
</script>

 