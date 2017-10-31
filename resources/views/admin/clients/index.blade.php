Все клиенты

@foreach( $clients as $client)

    <p>{{$client-> email}} {{$client->firstName}} {{$client->lastName}} {{$client->nickName}}</p>

    @endforeach
