
<table border="1" id="show_equipment">
    <caption>Таблица всех регистрационных ключей</caption>
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Описане</th>
        <th>Кухня</th>
        <th>Категория</th>
        <th>Цена</th>
        <th>Вес</th>
        <th>Единица измерения</th>
        <th>Время приготовления</th>
        <th>Рейтинг</th>
        <th>Ингредиенты</th>
    </tr>

    @foreach($products as $product)
        <tr id = "{{$product -> id}}">
            <td>{{$product -> id}}</td>
            <td>{{$product -> name}}</td>
            <td>{{$product -> description}}</td>
            <td>{{$product -> kitchen}}</td>
            <td>{{$product -> category}}</td>
            <td>{{$product -> prise}}</td>
            <td>{{$product -> weight}}</td>
            <td>{{$product -> unit_of_measurement}}</td>
            <td>{{$product -> cooking_time}}</td>
            <td>{{$product -> rating}}</td>
            <td>{{$product -> ingredients}}</td>
        </tr>

    @endforeach
</table>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>


    $(document).ready(function() {
        $(document).on('click', 'tr', function () {

            location.href = '{{url('/admin/restaurant/')}}' + '/' + this.id + '/product';
        });


    });


</script>