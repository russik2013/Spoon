Введите свой почтовый ящик
<br/>
<input type="text" name="email" id = "email">
<br/>
<button onclick="sendMail()">Send code</button>

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>

    function sendMail() {
        $.ajax({
            method: "POST",
            url: "{{url('/reset')}}",
            data: {email : $('#email').val(), _token : '{{csrf_token()}}' }
        }).done(function( msg ) {

           msg = JSON.parse(msg);
           if(msg['result'] == 'done'){

               alert('Сообщение было отправлено');
               location.href = '{{url('/login')}}';

           }else{
               alert('На такой почтовый ящик не зарегистрирован аккаунт');
           }
        }) .fail(function( msg ) {

        });

    }

</script>