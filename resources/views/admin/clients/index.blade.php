<meta name="csrf-token" content="{!! csrf_token() !!}">
Все клиенты

<table border="1" id="show_equipment">
    <caption>Таблица всех регистрационных ключей</caption>
    <tr>
        <th>id</th>
        <th>ФИО</th>
        <th>E-mail</th>
        <th>Никнейм</th>
        <th>Рейтинг</th>
        <th>Рецензент</th>
        <th>Доступ</th>

    </tr>

    @foreach( $clients as $client)

    <tr id="{{$client-> id}}">
        <td>{{$client-> id}}</td>
        <td>{{$client->firstName}} {{$client->middleName}} {{$client->lastName}}</td>
        <td>{{$client-> email}}</td>
        <td>{{$client->nickName}}</td>
        <td>{{$client-> rating}}</td>
        @if($client-> reviewer == true )
            <td class="reviewer_1"><button onclick="changeReviewer({{$client-> id}})" id="reviewer_{{$client-> id}}">Отключить</button></td>
        @else
            <td class="reviewer_1"><button onclick="changeReviewer({{$client-> id}})" id="reviewer_{{$client-> id}}">Включить</button></td>
        @endif


        @if($client -> access == true)
            <td class="button_1"><button onclick="changeStatus({{$client-> id}})" id="button_{{$client-> id}}">Отключить</button></td>
        @else
            <td class="button_1"><button onclick="changeStatus({{$client-> id}})" id="button_{{$client-> id}}">Включить</button></td>
        @endif

    </tr>
        {{--<a href="{{url('/admin/clients/'.$client->id.'/edit')}}">Изменить</a></p>--}}
    @endforeach

</table>
@if($count > 1)
    @for($i = 1; $i <= $count; $i++)
        <a href="{{url('/admin/clients/'.$i)}}">{{$i}}</a>
        @endfor
@endif
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>

    function changeStatus(id) {
        $.ajax({
            method: "POST",
            url: "{{url('admin/clients/change')}}",
            data:{'_token': $('meta[name="csrf-token"]').attr('content'), id:id}
        }).done(function (msg) {

            if($('#button_'+id).text() === 'Включить')
                document.getElementById('button_'+id).innerHTML = 'Отключить';
            else
                document.getElementById('button_'+id).innerHTML = 'Включить';

        });

    }

    function changeReviewer(id) {
        $.ajax({
            method: "POST",
            url: "{{url('admin/clients/reviewer')}}",
            data:{'_token': $('meta[name="csrf-token"]').attr('content'), id:id}
        }).done(function (msg) {

            if($('#reviewer_'+id).text() === 'Включить')
                document.getElementById('reviewer_'+id).innerHTML = 'Отключить';
            else
                document.getElementById('reviewer_'+id).innerHTML = 'Включить';

        });

    }







    $(document).ready(function() {
        $(document).on('click', 'tr', function () {
            location.href = '{{url('/admin/clients/')}}' + '/' + this.id + '/edit';
        });

        $(document).on('click', '.button_1', function () {

            return false
        });

        $(document).on('click', '.reviewer_1', function () {

            return false
        });
    });


</script>