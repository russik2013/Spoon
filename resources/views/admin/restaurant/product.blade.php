
<form  method="post" action="{{url('admin/restaurant/'.$product ->id.'/updateProduct')}}" enctype="multipart/form-data">
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

    @if ($errors->any()&& $errors -> first('ingredients'))
        <div class="alert alert-danger">
            {{$errors -> first('ingredients')}}
        </div>
    @endif
    <p>Ингредиенты</p>
    <textarea name="ingredients" rows="10" cols="45">{{old('',$product -> ingredients)}}</textarea>


    <input type="submit">
</form>