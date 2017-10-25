Регистрация блюда

<form  method="post" action="{{url('/restaurant/products/create')}}" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="_method" value="POST">
    <p>Название</p>
    <input type="text" name="name">
    <p>Фотография</p>
    <input type="file" name="image">
    <p>Описание</p>
    <textarea name="description" rows="10" cols="45"></textarea>
    <p>Кухня</p>
    <select name="kitchen">
        <option>AMERICAN</option>
        <option>ASIAN</option>
        <option>BAR</option>
        <option>BURGER</option>
        <option>CAFE</option>
        <option>CHINESE</option>
        <option>DESSERT</option>
        <option>ITALIAN</option>
        <option>JAPANESE</option>
        <option>MEXICAN</option>
        <option>PIZZA</option>
        <option>SEAFOOD</option>
        <option>STEAKHOUSE</option>
        <option>SUSHI</option>
        <option>ELSE</option>
    </select>
    <p>Категория</p>
    <select name="category">
        <option>BREAKFAST</option>
        <option>DINNER</option>
        <option>SUPPER</option>
        <option>DRINKS</option>
        <option>SWEET</option>
        <option>ELSE</option>
    </select>
    <p>Цена</p>
    <input type="number" name="prise" min="1" max="99999">
    <p>Вес (объем)</p>
    <input type="number" name="weight" min="1" max="999">
    <p>Единица измерения</p>
    <select name="unit_of_measurement">
        <option>KILO</option>
        <option>LITER</option>
        <option>GRAMS</option>
        <option>MILLILITER</option>
    </select>

    <p>Время приготовления(минуты)</p>
    <input type="number" name="cooking_time" min="1" max="999">
    <p>Ингредиенты</p>
    <textarea name="ingredients" rows="10" cols="45"></textarea>


    <input type="submit">
</form>