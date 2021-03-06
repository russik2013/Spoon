Регистрация блюда

<form  method="post" action="{{url('/restaurant/products/create')}}" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="_method" value="POST">
    @if ($errors->any()&& $errors -> first('name'))
        <div class="alert alert-danger">
            {{$errors -> first('name')}}
        </div>
    @endif
    <p>Название</p>
    <input type="text" name="name">

    @if ($errors->any()&& $errors -> first('image'))
        <div class="alert alert-danger">
            {{$errors -> first('image')}}
        </div>
    @endif
    <p>Фотография</p>
    <input type="file" name="image">

    @if ($errors->any()&& $errors -> first('description'))
        <div class="alert alert-danger">
            {{$errors -> first('description')}}
        </div>
    @endif
    <p>Описание</p>
    <textarea name="description" rows="10" cols="45"></textarea>

    @if ($errors->any()&& $errors -> first('kitchen'))
        <div class="alert alert-danger">
            {{$errors -> first('kitchen')}}
        </div>
    @endif
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

    @if ($errors->any()&& $errors -> first('category'))
        <div class="alert alert-danger">
            {{$errors -> first('category')}}
        </div>
    @endif
    <p>Категория</p>
    <select name="category">
        <option>BREAKFAST</option>
        <option>DINNER</option>
        <option>SUPPER</option>
        <option>DRINKS</option>
        <option>SWEET</option>
        <option>ELSE</option>
    </select>

    @if ($errors->any()&& $errors -> first('prise'))
        <div class="alert alert-danger">
            {{$errors -> first('prise')}}
        </div>
    @endif
    <p>Цена</p>
    <input type="number" name="prise" min="1" max="99999">

    @if ($errors->any()&& $errors -> first('weight'))
        <div class="alert alert-danger">
            {{$errors -> first('weight')}}
        </div>
    @endif
    <p>Вес (объем)</p>
    <input type="number" name="weight" min="1" max="999">

    @if ($errors->any()&& $errors -> first('unit_of_measurement'))
        <div class="alert alert-danger">
            {{$errors -> first('unit_of_measurement')}}
        </div>
    @endif
    <p>Единица измерения</p>
    <select name="unit_of_measurement">
        <option>KILO</option>
        <option>LITER</option>
        <option>GRAMS</option>
        <option>MILLILITER</option>
    </select>

    @if ($errors->any()&& $errors -> first('cooking_time'))
        <div class="alert alert-danger">
            {{$errors -> first('cooking_time')}}
        </div>
    @endif
    <p>Время приготовления(минуты)</p>
    <input type="number" name="cooking_time" min="1" max="999">

    @if ($errors->any()&& $errors -> first('ingredients'))
        <div class="alert alert-danger">
            {{$errors -> first('ingredients')}}
        </div>
    @endif
    <p>Ингредиенты</p>
    <textarea name="ingredients" rows="10" cols="45"></textarea>


    <input type="submit">
</form>