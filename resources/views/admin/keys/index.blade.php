<meta name="csrf-token" content="{!! csrf_token() !!}">
<style>

    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    p.clip {
        white-space: nowrap; /* Запрещаем перенос строк */
        overflow: hidden; /* Обрезаем все, что не помещается в область */
        background: #fc0; /* Цвет фона */
        padding: 5px; /* Поля вокруг текста */
        text-overflow: ellipsis; /* Добавляем многоточие */
        width: 100px;
    }

</style>


<table border="1" id="show_equipment">
    <caption>Таблица всех регистрационных ключей</caption>
    <tr>
        <th>id</th>
        <th>Код</th>
        <th>Количество ресторанов на регистрацию</th>

    </tr>


    @foreach($keys as $key)
        <tr id="{{$key -> id}}">
            <td>{{$key -> id}}</td>
            <td><p class="clip">{{$key -> key_text}}</p></td>
            <td>{{$key -> restaurant_count}}</td>
            <td><button onclick="deleteData()">Удалить</button></td>
        </tr>
        @endforeach

</table>

<!-- Trigger/Open The Modal -->
<p><button id="myBtn">Добавить код</button></p>

<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>На какое количество ресторанов выдать код?</p>
        <input id="restaurant_count" type="number" name="restaurant_count">
        <p>Почта получателя</p>
        <input id="user_email" type="text" name="user_email">
        <button onclick="sendData()">Создать</button>
    </div>

</div>

<!-- The Modal -->
<div id="codModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="closes">&times;</span>
        <div style="width: 100%; overflow-x: scroll;">
        <p id="kod_text"></p>
        </div>
    </div>

</div>



<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>

    $(document).ready(function(){

        $(document).on('click','tr',function(){
            $.ajax({
                method: "POST",
                url: "{{url('admin/keys/get')}}",
                data:{'_token': $('meta[name="csrf-token"]').attr('content'), key_id:this.id}
            }).done(function (msg) {

                document.getElementById('kod_text').innerHTML = msg.key_text;

                console.log(msg.key_text);

                var modal = document.getElementById('codModal');



                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("closes")[0];


                // When the user clicks on <span> (x), close the modal
                span.onclick = function() {
                    modal.style.display = "none";
                }

                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }


                modal.style.display = "block";

            });
            ///alert(this.id);

        });

    });



    setInterval(function() {
        $.ajax({
            method: "POST",
            url: "{{url('admin/keys/all')}}",
            data:{'_token': $('meta[name="csrf-token"]').attr('content')}
        }).done(function (msg) {
            for (var i = document.getElementById('show_equipment').getElementsByTagName('tr').length -1; i; i--) {
                document.getElementById('show_equipment').deleteRow(i);

            }
            var d = document;

            var tbody = d.getElementById('show_equipment').getElementsByTagName('TBODY')[0];


            for(var y = 0; y < msg.length; y++) {

                var row = d.createElement("TR");
                row.id = msg[y].id;
                tbody.appendChild(row);

                var td1 = d.createElement("TD");
                var td2 = d.createElement("TD");
                var td3 = d.createElement("TD");
                var td4 = d.createElement("TD");

                row.appendChild(td1);
                row.appendChild(td2);
                row.appendChild(td3);
                row.appendChild(td4);

                td1.innerHTML = msg[y].id;
                td2.innerHTML = '<p class="clip">' + msg[y].key_text + '</p>';
                td3.innerHTML = msg[y].restaurant_count;
                td4.innerHTML = '<button onclick="deleteData()">Удалить</button>';
            }

        });
      //  console.log('russik');
    }, 3000);


    function deleteData() {

        $('tr').click(function(){

            $.ajax({
                method: "POST",
                url: "{{url('admin/keys/delete')}}",
                data:{'key_id' : this.id, '_token': $('meta[name="csrf-token"]').attr('content')}
            });

        });

    }

        function sendData() {
            $.ajax({
                method: "POST",
                url: "{{url('admin/keys/create')}}",
                data:{'restaurant_count' : $('#restaurant_count').val(), user_email : $('#user_email').val(),
                    '_token': $('meta[name="csrf-token"]').attr('content')}
            });

            var modal = document.getElementById('myModal');

            modal.style.display = "none";

        }





    // Get the modal
    var modal = document.getElementById('myModal');

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }


    // Get the modal


</script>