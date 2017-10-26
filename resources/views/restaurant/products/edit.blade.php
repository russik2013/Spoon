Редактирование блюда



<form  method="post" action="{{url('/restaurant/products/'.$product ->id.'/update')}}" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="_method" value="POST">
    @if ($errors->any()&& $errors -> first('name'))
        <div class="alert alert-danger">
            {{$errors -> first('name')}}
        </div>
    @endif
    <p>Название</p>
    <input type="text" name="name" value="{{old('',$product -> name)}}">

    @if ($errors->any()&& $errors -> first('image'))
        <div class="alert alert-danger">
            {{$errors -> first('image')}}
        </div>
    @endif
    <p>Фотография</p>
    <input type="file" name="image" >

    @if ($errors->any()&& $errors -> first('description'))
        <div class="alert alert-danger">
            {{$errors -> first('description')}}
        </div>
    @endif
    <p>Описание</p>
    <textarea name="description" rows="10" cols="45"> {{old('',$product -> description)}}</textarea>

    @if ($errors->any()&& $errors -> first('kitchen'))
        <div class="alert alert-danger">
            {{$errors -> first('kitchen')}}
        </div>
    @endif
    <p>Кухня</p>
    <select name="kitchen">
        @foreach($kitchens as $kitchen)

            <option @if($product -> kitchen == $kitchen -> name) selected @endif>{{$kitchen -> name}}</option>

            @endforeach
    </select>

    @if ($errors->any()&& $errors -> first('category'))
        <div class="alert alert-danger">
            {{$errors -> first('category')}}
        </div>
    @endif
    <p>Категория</p>
    <select name="category">
        <option @if($product ->category == 'BREAKFAST') selected @endif>BREAKFAST</option>
        <option @if($product ->category == 'DINNER') selected @endif>DINNER</option>
        <option @if($product ->category == 'SUPPER') selected @endif>SUPPER</option>
        <option @if($product ->category == 'DRINKS') selected @endif>DRINKS</option>
        <option @if($product ->category == 'SWEET') selected @endif>SWEET</option>
        <option @if($product ->category == 'ELSE') selected @endif>ELSE</option>
    </select>

    @if ($errors->any()&& $errors -> first('prise'))
        <div class="alert alert-danger">
            {{$errors -> first('prise')}}
        </div>
    @endif
    <p>Цена</p>
    <input type="number" name="prise" min="1" max="99999" value="{{old('',$product -> prise)}}">

    @if ($errors->any()&& $errors -> first('weight'))
        <div class="alert alert-danger">
            {{$errors -> first('weight')}}
        </div>
    @endif
    <p>Вес (объем)</p>
    <input type="number" name="weight" min="1" max="999" value="{{old('',$product -> weight)}}">

    @if ($errors->any()&& $errors -> first('unit_of_measurement'))
        <div class="alert alert-danger">
            {{$errors -> first('unit_of_measurement')}}
        </div>
    @endif
    <p>Единица измерения</p>
    <select name="unit_of_measurement">
        <option @if($product ->unit_of_measurement == 'KILO') selected @endif>KILO</option>
        <option @if($product ->unit_of_measurement == 'LITER') selected @endif>LITER</option>
        <option @if($product ->unit_of_measurement == 'GRAMS') selected @endif>GRAMS</option>
        <option @if($product ->unit_of_measurement == 'MILLILITER') selected @endif>MILLILITER</option>
    </select>

    @if ($errors->any()&& $errors -> first('cooking_time'))
        <div class="alert alert-danger">
            {{$errors -> first('cooking_time')}}
        </div>
    @endif
    <p>Время приготовления(минуты)</p>
    <input type="number" name="cooking_time" min="1" max="999" value="{{old('',$product -> cooking_time)}}" >

    @if ($errors->any()&& $errors -> first('ingredients'))
        <div class="alert alert-danger">
            {{$errors -> first('ingredients')}}
        </div>
    @endif
    <p>Ингредиенты</p>
    <textarea name="ingredients" rows="10" cols="45">{{old('',$product -> ingredients)}}</textarea>


    <input type="submit">
</form>