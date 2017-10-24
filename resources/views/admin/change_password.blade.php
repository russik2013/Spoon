@if(isset($_GET['email']))
<p>Введите код</p>
<input type="text" name="kod" id="kod">

<p>Новый пароль</p>
<input type="text" name="password" id="password">

<p>Повторить пароль</p>
<input type="text" name="confirm_password" id="confirm_password">


<button onclick="sendData()">Сменить пароль</button>


<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<script>

    function sendData() {
        $.ajax({
            method: "POST",
            url: "{{url('/change')}}",
            data: {email : '{{$_GET['email']}}', _token : '{{csrf_token()}}', kod : $('#kod').val(), password : $('#password').val() }
        }).done(function( msg ) {

            msg = JSON.parse(msg);
            if(msg['result'] == 'done'){

                alert('Пароль был изменен');
                location.href = '{{url('/login')}}';

            }
            if(msg['result'] == 'kod error'){
                alert('Код не верен');
            }
            if(msg['result'] == 'email error'){
                alert('На такой почтовый ящик код не отправлялся');
            }
        }) .fail(function( msg ) {

        });

    }


</script>

@else

    На ваш почтовый ящик код не отправлялся

@endif

