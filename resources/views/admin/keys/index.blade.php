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

</style>


<table border="1">
    <caption>Таблица всех регистрационных ключей</caption>
    <tr>
        <th>id</th>
        <th>Код</th>
        <th>Количество ресторанов на регистрацию</th>
    </tr>


    @foreach($keys as $key)
        <tr>
            <td>{{$key -> id}}</td>
            <td>{{$key -> key_text}}</td>
            <td>{{$key -> restaurant_count}}</td>
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
        <button onclick="sendData()">Создать</button>
    </div>

</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>


        function sendData() {
            $.ajax({
                method: "POST",
                url: "{{url('admin/keys/create')}}",
                data:{'restaurant_count' : $('#restaurant_count').val(), '_token': $('meta[name="csrf-token"]').attr('content')}
            });

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


</script>