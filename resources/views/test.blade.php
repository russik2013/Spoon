<script>
    var str = ["Widget","Widget", "with", "id"];
    var find = 'Widget123<>&^&';
    var result;
    find = find.replace(/[^-A-Z]/gim,'');
    for(var i=0; i < str.length; i++){
       if(!str[i].indexOf(find)) {
           result[i] = str[i];
           console.log(str[i]);
           console.log(i);
       }
    }
    console.log(result);
 //   alert( str.indexOf("Widget") ); // 0, т.к. "Widget" найден прямо в начале str
 //   alert( str.indexOf("id") ); // 1, т.к. "id" найден, начиная с позиции 1
 //   alert( str.indexOf("widget") ); // -1, не найдено, так как поиск учитывае
</script>