Все блюда



@foreach($products as $product)

    <p>

        {{$product -> name}}

        <a href="{{url('/restaurant/products/'.$product -> id.'/edit')}}">Изменить</a>
        <a href="{{url('/restaurant/products/'.$product -> id.'/delete')}}">Удалить</a>
    </p>

    @endforeach

<a href="{{url('/restaurant/products/add')}}">Добавить</a>