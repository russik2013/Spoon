
<form  method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

    @if ($errors->has('login_error'))
        @foreach($errors->all() as $error)
            <div class="alert alert-danger"> {{ $error }}</div>
        @endforeach
    @endif
            <input id="email" type="email"  name="email" >
            <input id="password" type="password"  name="password" >

            <button type="submit" class="btn btn-primary">
                Login
            </button>



</form>