
<form  method="post" action="{{url('/admin/clients/'.$client ->id.'/update')}}" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="_method" value="POST">

    @if ($errors->any()&& $errors -> first('email'))
        <div class="alert alert-danger">
            {{$errors -> first('email')}}
        </div>
    @endif
<p>E-mail</p>
<input type="" name="email" id="" value="{{old('email',$client -> email)}}">

    @if ($errors->any()&& $errors -> first('firebaseID'))
        <div class="alert alert-danger">
            {{$errors -> first('firebaseID')}}
        </div>
    @endif
<p>firebaseID</p>
<input type="" name="firebaseID" id="" value="{{old('firebaseID',$client -> firebaseID)}}">

    @if ($errors->any()&& $errors -> first('socialNetworkID'))
        <div class="alert alert-danger">
            {{$errors -> first('socialNetworkID')}}
        </div>
    @endif
<p>socialNetworkID</p>
<input type="" name="socialNetworkID" id="" value="{{old('socialNetworkID',$client ->socialNetworkID)}}">

    @if ($errors->any()&& $errors -> first('firstName'))
        <div class="alert alert-danger">
            {{$errors -> first('firstName')}}
        </div>
    @endif
<p>firstName</p>
<input type="" name="firstName" id="" value="{{old('firstName',$client ->firstName)}}">

    @if ($errors->any()&& $errors -> first('lastName'))
        <div class="alert alert-danger">
            {{$errors -> first('lastName')}}
        </div>
    @endif
<p>lastName</p>
<input type="" name="lastName" id="" value="{{old('lastName',$client ->lastName)}}">

    @if ($errors->any()&& $errors -> first('middleName'))
        <div class="alert alert-danger">
            {{$errors -> first('middleName')}}
        </div>
    @endif
<p>middleName</p>
<input type="" name="middleName" id="" value="{{old('middleName',$client -> middleName)}}">

    @if ($errors->any()&& $errors -> first('nickName'))
        <div class="alert alert-danger">
            {{$errors -> first('nickName')}}
        </div>
    @endif
<p>nickName</p>
<input type="" name="nickName" id="" value="{{old('nickName',$client ->nickName)}}">

    @if ($errors->any()&& $errors -> first('sex'))
        <div class="alert alert-danger">
            {{$errors -> first('sex')}}
        </div>
    @endif
<p>sex</p>
<select name="sex">
    <option @if($client->sex == "MEN") selected @endif>MEN</option>
    <option @if($client->sex == "WOMAN") selected @endif>WOMEN</option>
    <option @if($client->sex == "ELSE") selected @endif>ELSE</option>

</select>

    @if ($errors->any()&& $errors -> first('age'))
        <div class="alert alert-danger">
            {{$errors -> first('age')}}
        </div>
    @endif
<p>age</p>
<input type="" name="age" id="" value="{{old('age',$client ->age)}}">
<p>photo</p>
{{--<input type="" name="photo" id="">--}} Сделай!!!!!!!!!! а не как обычно

    @if ($errors->any()&& $errors -> first('reviewer'))
        <div class="alert alert-danger">
            {{$errors -> first('reviewer')}}
        </div>
    @endif
<p>reviewer</p>
<input type="checkbox" name="reviewer" id="" @if($client -> reviewer == true) checked @endif>

    @if ($errors->any()&& $errors -> first('rating'))
        <div class="alert alert-danger">
            {{$errors -> first('rating')}}
        </div>
    @endif
<p>rating</p>
<input type="" name="rating" id="" value="{{old('rating',$client ->rating)}}">

    @if ($errors->any()&& $errors -> first('changePreferences'))
        <div class="alert alert-danger">
            {{$errors -> first('changePreferences')}}
        </div>
    @endif
<p>changePreferences</p>
<input type="checkbox" name="changePreferences" id="" @if($client -> changePreferences == true) checked @endif>

    @if ($errors->any()&& $errors -> first('token'))
        <div class="alert alert-danger">
            {{$errors -> first('token')}}
        </div>
    @endif
<p>token</p>
<input type="" name="token" id="" value="{{old('token',$client ->token)}}">

<input type="submit" value="Отправить">

</form>