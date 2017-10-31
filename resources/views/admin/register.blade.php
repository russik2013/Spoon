<form  method="post" action="{{url('/register')}}" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="_method" value="POST">


    @if ($errors->any()&& $errors -> first('register_key'))
        <div class="alert alert-danger">
            {{$errors -> first('register_key')}}
        </div>
    @endif
    <br>
    Ключ регистрации
    <br>
    <input id="register_key" type="text"  name="register_key" value="{{old('register_key')}}">


    @if ($errors->any()&& $errors -> first('email'))
        <div class="alert alert-danger">
            {{$errors -> first('email')}}
        </div>
    @endif
    <br>
    Почта
    <br>
    <input id="email" type="text"  name="email" value="{{old('email')}}">
    @if ($errors->any()&& $errors -> first('password'))
        <div class="alert alert-danger">
            {{$errors -> first('password')}}
        </div>
    @endif
    <br>
    Пароль
    <br>
    <input id="password" type="password"  name="password" >
    <p>Повтор пароля</p>
    <input id="confirm_password" type="password"  name="confirm_password" >
    @if ($errors->any()&& $errors -> first('name'))
        <div class="alert alert-danger">
            {{$errors -> first('name')}}
        </div>
    @endif
    <p>Название</p>
    <input id="name" type="text"  name="name" value="{{old('name')}}">
    @if ($errors->any()&& $errors -> first('nets'))
        <div class="alert alert-danger">
            {{$errors -> first('nets')}}
        </div>
    @endif
    <p>Сеть ресторанов</p>
    <input type="checkbox"  name="nets_check" id="nets_check">
    <div id="nets_name_block">
    <p>Название сети</p>
    <input id="nets" type="text" name="nets" value="{{old('nets')}}">
    </div>
    @if ($errors->any()&& $errors -> first('category'))
        <div class="alert alert-danger">
            {{$errors -> first('category')}}
        </div>
    @endif
    <p>Категория заведения</p>
    <input id="category" type="text" name="category" value="{{old('category')}}">
    @if ($errors->any()&& $errors -> first('description'))
        <div class="alert alert-danger">
            {{$errors -> first('description')}}
        </div>
    @endif
    <p>Описание</p>
    <textarea name="description" rows="10" cols="45">{{old('description')}}</textarea>
    @if ($errors->any()&& $errors -> first('phone'))
        <div class="alert alert-danger">
            {{$errors -> first('phone')}}
        </div>
    @endif
    <p>Номер телефона</p>
    <input id="phone" type="text" name="phone" value="{{old('phone')}}">
    @if ($errors->any()&& $errors -> first('average_check'))
        <div class="alert alert-danger">
            {{$errors -> first('average_check')}}
        </div>
    @endif
    <p>Средний чек</p>
    <input id="average_check" type="number" name="average_check" value="{{old('average_check')}}">
    <p>Указать время работы</p>
    <input type="checkbox" name="specify_time" id="work_time">
    <div id="work_time_block">
        <p>Понедельник
        с <input id="monday_work_time" type="time" name="monday_from"> по <input id="monday_work_time_to" type="time" name="monday_to"></p>
        <p>Вторник
        с <input id="tuesday_work_time" type="time" name="tuesday_from" > по <input id="tuesday_work_time_to" type="time" name="tuesday_to"></p>
        <p>Среда
        с <input id="wednesday_work_time" type="time" name="wednesday_from" > по <input id="wednesday_work_time_to" type="time" name="wednesday_to"></p>
        <p>Четверг
        с <input id="thursday_work_time" type="time" name="thursday_from" > по <input id="thursday_work_time_to" type="time" name="thursday_to"></p>
        <p>Пятница
        с <input id="friday_work_time" type="time" name="friday_from" > по <input id="friday_work_time_to" type="time" name="friday_to"></p>
        <p>Суббота
        с <input id="saturday_work_time" type="time" name="saturday_from" > по <input id="saturday_work_time_to" type="time" name="saturday_to"></p>
        <p>Воскресенье
        с <input id="sunday_work_time" type="time" name="sunday_from" > по <input id="sunday_work_time_to" type="time" name="sunday_to"></p>
    </div>
    @if ($errors->any()&& $errors -> first('address'))
        <div class="alert alert-danger">
            {{$errors -> first('address')}}
        </div>
    @endif
    <p>Адрес</p>
    <input type="text" name="address" value="{{old('address')}}">
    @if ($errors->any()&& $errors -> first('photos'))
        <div class="alert alert-danger">
            {{$errors -> first('photos')}}
        </div>
    @endif
    <p>Фотографии</p>
    <input type="file" name="photos">

   <input type="submit">

</form>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
    $('#nets_name_block').hide();
    $('#work_time_block').hide();

    $("#monday_work_time").prop('disabled', true);
    $("#tuesday_work_time").prop('disabled', true);
    $("#wednesday_work_time").prop('disabled', true);
    $("#thursday_work_time").prop('disabled', true);
    $("#friday_work_time").prop('disabled', true);
    $("#saturday_work_time").prop('disabled', true);
    $("#sunday_work_time").prop('disabled', true);

    $("#monday_work_time_to").prop('disabled', true);
    $("#tuesday_work_time_to").prop('disabled', true);
    $("#wednesday_work_time_to").prop('disabled', true);
    $("#thursday_work_time_to").prop('disabled', true);
    $("#friday_work_time_to").prop('disabled', true);
    $("#saturday_work_time_to").prop('disabled', true);
    $("#sunday_work_time_to").prop('disabled', true);

    $("#nets").prop('disabled', true);
    $( document ).ready(function() {
        $('#nets_check').click(function(){
            if(this.checked) {
                $('#nets_name_block').show();
                $("#nets").prop('disabled', false);
            }else {
                $('#nets_name_block').hide();
                $("#nets").prop('disabled', true);
            }


        });
        $('#work_time').click(function(){
            if(this.checked) {
                $('#work_time_block').show();
                $("#monday_work_time").prop('disabled', false);
                $("#tuesday_work_time").prop('disabled', false);
                $("#wednesday_work_time").prop('disabled', false);
                $("#thursday_work_time").prop('disabled', false);
                $("#friday_work_time").prop('disabled', false);
                $("#saturday_work_time").prop('disabled', false);
                $("#sunday_work_time").prop('disabled', false);

                $("#monday_work_time_to").prop('disabled', false);
                $("#tuesday_work_time_to").prop('disabled', false);
                $("#wednesday_work_time_to").prop('disabled', false);
                $("#thursday_work_time_to").prop('disabled', false);
                $("#friday_work_time_to").prop('disabled', false);
                $("#saturday_work_time_to").prop('disabled', false);
                $("#sunday_work_time_to").prop('disabled', false);
            }else {
                $('#work_time_block').hide();
                $("#monday_work_time").prop('disabled', true);
                $("#tuesday_work_time").prop('disabled', true);
                $("#wednesday_work_time").prop('disabled', true);
                $("#thursday_work_time").prop('disabled', true);
                $("#friday_work_time").prop('disabled', true);
                $("#saturday_work_time").prop('disabled', true);
                $("#sunday_work_time").prop('disabled', true);

                $("#monday_work_time_to").prop('disabled', true);
                $("#tuesday_work_time_to").prop('disabled', true);
                $("#wednesday_work_time_to").prop('disabled', true);
                $("#thursday_work_time_to").prop('disabled', true);
                $("#friday_work_time_to").prop('disabled', true);
                $("#saturday_work_time_to").prop('disabled', true);
                $("#sunday_work_time_to").prop('disabled', true);
            }


        });
    });


</script>