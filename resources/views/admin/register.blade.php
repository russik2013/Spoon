<form  method="post" action="{{url('/russik')}}" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="_method" value="POST">
    @if ($errors->any()&& $errors -> first('email'))
        <div class="alert alert-danger">
            {{$errors -> first('email')}}
        </div>
    @endif
    <br>
    Почта
    <br>
    <input id="email" type="email"  name="email" value="{{old('email')}}">
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
        <input id="monday_work_time" type="time" name="monday"></p>
        <p>Вторник
        <input id="tuesday_work_time" type="time" name="tuesday" ></p>
        <p>Среда
        <input id="wednesday_work_time" type="time" name="wednesday" ></p>
        <p>Четверг
        <input id="thursday_work_time" type="time" name="thursday" ></p>
        <p>Пятница
        <input id="friday_work_time" type="time" name="friday" ></p>
        <p>Суббота
        <input id="saturday_work_time" type="time" name="saturday" ></p>
        <p>Воскресенье
        <input id="sunday_work_time" type="time" name="sunday" ></p>
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
            }else {
                $('#work_time_block').hide();
                $("#monday_work_time").prop('disabled', true);
                $("#tuesday_work_time").prop('disabled', true);
                $("#wednesday_work_time").prop('disabled', true);
                $("#thursday_work_time").prop('disabled', true);
                $("#friday_work_time").prop('disabled', true);
                $("#saturday_work_time").prop('disabled', true);
                $("#sunday_work_time").prop('disabled', true);
            }


        });
    });


</script>