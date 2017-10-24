Редактирование приоритеты продуктов

<form id="image-form" role="form" action="{{url('/admin/restaurant/preference/update')}}" method="post" enctype="multipart/form-data">

    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="_method" value="POST">

    <p>Американская</p>
    <input type="text" name="AMERICAN" value="{{$restaurant_preference -> AMERICAN}}">
    <p>Азиатская</p>
    <input type="text" name="ASIAN" value="{{$restaurant_preference -> ASIAN}}">
    <p>Барная</p>
    <input type="text" name="BAR" value="{{$restaurant_preference -> BAR}}">
    <p>Бургерная</p>
    <input type="text" name="BURGER" value="{{$restaurant_preference -> BURGER}}">
    <p>Кафе</p>
    <input type="text" name="CAFE" value="{{$restaurant_preference -> CAFE}}">
    <p>Китайская</p>
    <input type="text" name="CHINESE" value="{{$restaurant_preference -> CHINESE}}">
    <p>Десертная</p>
    <input type="text" name="DESSERT" value="{{$restaurant_preference -> DESSERT}}">
    <p>Итальянская</p>
    <input type="text" name="ITALIAN" value="{{$restaurant_preference -> ITALIAN}}">
    <p>Японская</p>
    <input type="text" name="JAPANESE" value="{{$restaurant_preference -> JAPANESE}}">
    <p>Мексиканская</p>
    <input type="text" name="MEXICAN" value="{{$restaurant_preference -> MEXICAN}}">
    <p>Пиццерия</p>
    <input type="text" name="PIZZA" value="{{$restaurant_preference -> PIZZA}}">
    <p>Морская кухня</p>
    <input type="text" name="SEAFOOD" value="{{$restaurant_preference -> SEAFOOD}}">
    <p>Стейк хаус</p>
    <input type="text" name="STEAKHOUSE" value="{{$restaurant_preference -> STEAKHOUSE}}">
    <p>Суши</p>
    <input type="text" name="SUSHI" value="{{$restaurant_preference -> SUSHI}}">


    <p>   <input type="submit" value="Сохранить"> </p>

</form>

<p> <a href="{{url('/restaurant')}}"> На главную</a> </p>