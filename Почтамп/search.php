<div style="display:flex">
<h1>Поиск</h1>
<script>   

    function getData(words) {
        console.log('searchjson.php?words='+words);
        $.getJSON('searchjson.php?words='+words, function(data) {
            $('.user-card-gen').remove();
            var i = 0;
            data.forEach(element => {
                i++;
                var cln =  $("#cardmain" ).clone(true);
                cln.appendTo(".user-card-all");
                cln.find('.ava').css("background-image", "url("+JSON.parse(element.user.info_json).avatar+")");
                cln.find('.name').html(element.name);
                cln.attr('class','user-card-gen');
                cln.css("display","flex");
                if (element.friend == true){
                    cln.find('.sendFriend').hide();
                }else{
                    cln.find('.add').attr('onclick','Send('+element.user.id+')');
                    cln.find('.add').attr('id','button'+element.user.id);
                    cln.find('.add2').attr('id','end'+element.user.id);
                }
                if (element.push == true){
                    
                    $('#button'+element.user.id).hide();
                    $('#end'+element.user.id).show();
                }
            });
        });
    }
    function Send(id) {
        $.getJSON('sendfriendRequest.php?id='+id, function(data) {
            $('#button'+id).hide();
            $('#end'+id).show();
        });
    }
    
</script>
<input type="text" style="width:60%; margin-left: 2%; font-size:2vw;" id="input" oninput="getData($('#input').val())">
</div>

<div class="user-card-all">
    <div class="user-card-posts" style="display:flex; width:30%; margin-right:0.8%; flex-wrap:wrap; display:none;" id="cardmain">
        <div class="ava" style="background-image:url();width:10vw; height:10vw; background-repeat: no-repeat;background-size: contain;">
        </div>

        <div style="margin-left:0%; width:100%;">

            <h1  style="cursor:pointer;"> <a class="name" href="?home=&id=<?php echo $user['id']; ?>"><?php echo($user['name']) ?></a>   </h1>

        </div>

        <form style="width:150%; margin-top:1vw;" class="sendFriend">
            <input class="add" style=" cursor:pointer; " type="button" id="button" value="Добавить" onclick="">
            <input class="add2" style="   display:none;" id="" type="button" value="Отправленно" >
        </form>
    </div>
</div