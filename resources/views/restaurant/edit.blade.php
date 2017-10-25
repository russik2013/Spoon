Редактирование информации о ресторане


<form id="image-form" role="form" action="{{url('/restaurant/update')}}" method="post" enctype="multipart/form-data">

    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="_method" value="POST">

    @if ($errors->any()&& $errors -> first('name'))
        <div class="alert alert-danger">
            {{$errors -> first('name')}}
        </div>
    @endif
    <p>Название</p>
    <input id="name" type="text"  name="name" value="{{old('name', $restaurant -> name)}}">

    @if ($errors->any()&& $errors -> first('nets'))
        <div class="alert alert-danger">
            {{$errors -> first('nets')}}
        </div>
    @endif
    <p>Сеть ресторанов</p>
    <input type="checkbox" @if($restaurant -> nets != null) checked @endif name="nets_check" id="nets_check">
    <div id="nets_name_block">
        <p>Название сети</p>
        <input id="nets" type="text" name="nets" value="{{old('nets', $restaurant -> nets)}}">
    </div>

    @if ($errors->any()&& $errors -> first('category'))
        <div class="alert alert-danger">
            {{$errors -> first('category')}}
        </div>
    @endif
    <p>Категория заведения</p>
    <input id="category" type="text" name="category" value="{{old('category', $restaurant ->category)}}">

    @if ($errors->any()&& $errors -> first('description'))
        <div class="alert alert-danger">
            {{$errors -> first('description')}}
        </div>
    @endif
    <p>Описание</p>
    <textarea name="description" rows="10" cols="45">{{old('description', $restaurant ->description)}}</textarea>

    @if ($errors->any()&& $errors -> first('phone'))
        <div class="alert alert-danger">
            {{$errors -> first('phone')}}
        </div>
    @endif
    <p>Номер телефона</p>
    <input id="phone" type="text" name="phone" value="{{old('phone', $restaurant ->phone)}}">

    @if ($errors->any()&& $errors -> first('average_check'))
        <div class="alert alert-danger">
            {{$errors -> first('average_check')}}
        </div>
    @endif
    <p>Средний чек</p>
    <input id="average_check" type="number" name="average_check" value="{{old('average_check', $restaurant ->average_check)}}">

    <p>Указать время работы</p>
    <input type="checkbox" @if($restaurant -> specify_time != null) checked @endif  name="specify_time" id="work_time">
    <div id="work_time_block">
        <p>Понедельник
            с <input id="monday_work_time" type="time" name="monday_from" value="{{old('monday_from', $restaurant ->monday_from)}}">
            по <input id="monday_work_time_to" type="time" name="monday_to" value="{{old('monday_to', $restaurant ->monday_to)}}"></p>
        <p>Вторник
            с <input id="tuesday_work_time" type="time" name="tuesday_from" value="{{old('tuesday_from', $restaurant ->tuesday_from)}}">
            по <input id="tuesday_work_time_to" type="time" name="tuesday_to" value="{{old('tuesday_to', $restaurant ->tuesday_to)}}"></p>
        <p>Среда
            с <input id="wednesday_work_time" type="time" name="wednesday_from" value="{{old('wednesday_from', $restaurant ->wednesday_from)}}">
            по <input id="wednesday_work_time_to" type="time" name="wednesday_to" value="{{old('wednesday_to', $restaurant ->wednesday_to)}}"></p>
        <p>Четверг
            с <input id="thursday_work_time" type="time" name="thursday_from" value="{{old('thursday_from', $restaurant ->thursday_from)}}">
            по <input id="thursday_work_time_to" type="time" name="thursday_to" value="{{old('thursday_to', $restaurant ->thursday_to)}}"></p>
        <p>Пятница
            с <input id="friday_work_time" type="time" name="friday_from" value="{{old('friday_from', $restaurant ->friday_from)}}">
            по <input id="friday_work_time_to" type="time" name="friday_to" value="{{old('friday_to', $restaurant ->friday_to)}}"></p>
        <p>Суббота
            с <input id="saturday_work_time" type="time" name="saturday_from" value="{{old('saturday_from', $restaurant ->saturday_from)}}">
            по <input id="saturday_work_time_to" type="time" name="saturday_to" value="{{old('saturday_to', $restaurant ->saturday_to)}}"></p>
        <p>Воскресенье
            с <input id="sunday_work_time" type="time" name="sunday_from" value="{{old('sunday_from', $restaurant ->sunday_from)}}">
            по <input id="sunday_work_time_to" type="time" name="sunday_to" value="{{old('sunday_to', $restaurant ->sunday_to)}}"></p>
    </div>
    @if ($errors->any()&& $errors -> first('address'))
        <div class="alert alert-danger">
            {{$errors -> first('address')}}
        </div>
    @endif
    <p>Адрес</p>
    <input type="text" name="address" value="{{old('address', $restaurant ->address)}}">

    {{--Обязательно доделай, а не как обычно--}}
    {{--@if ($errors->any()&& $errors -> first('photos'))--}}
        {{--<div class="alert alert-danger">--}}
            {{--{{$errors -> first('photos')}}--}}
        {{--</div>--}}
    {{--@endif--}}
    {{--<p>Фотографии</p>--}}
    {{--<input type="file" name="photos">--}}

    <p><input type="submit" value="Сохранить"></p>

</form>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>

    @if($restaurant -> nets == null)
     $('#nets_name_block').hide();
     $("#nets").prop('disabled', true);
    @endif

    @if($restaurant -> specify_time == null)
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
    @endif


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




