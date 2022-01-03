<!DOCTYPE html>
<html lang="en">
@include('template.admin.segments.header')
  <body class="fixed-nav sticky-footer bg-dark" id="page-top">
  @include('template.admin.segments.navbar')
    <style>
      .newmsg{
        font-weight: bolder;
      }
      .hover:hover{
        cursor: pointer;
        background-color: #e0fbff;
      }
      .from,.to{
        padding: 10px;
        border:solid 1px #000;
        margin-top:10px;
        font-size:20px;
        border-radius: 20px;
      }
      .from{
        background-color:#fff;
      }
      .to{
        background-color:#e0fbff;
      }
    </style>
    <div class="content-wrapper">
      <div class="container-fluid">


      <div class="row">
        <div class="col-md-6">
          <table class="table table-bordered" width="100%" id="chat-table" cellspacing="0">
            <thead>
              <tr>
                <th>Inbox</th>
              </tr>
            </thead>
           
            <tbody id="chatTbody"></tbody>
        </table>
        </div>
        <div class="col-md-6">
          <div id="message_cont" style="height:350px;width:100%;background-color:#ace;padding:20px;overflow-y:scroll">
          </div>
          <br>
          <input type="text" id="msg" class="form-control"><br><button class="btn btn-lg btn-default pull-right" id="send">Send</button>
        </div>

      </div>
      <div class="row">
       <div class="container">
 </div>
      </div>
      <br>



      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-wrapper -->
    
  @include('template.admin.segments.footer')

  <script>
//setInterval(function () {
  $.ajax({
    url: base_url('chat'),
    type: 'GET',
    dataType: 'json',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
    success: function(ret){
       console.log(ret);

       var chats = '';
       var user = "{{Auth::user()->id}}";
       var pull ='';

       $.each(ret,function(k,v){

        var d1 = new Date(v.created_at);
        var datestring1 = d1.toLocaleString('en-US', { timeZone: 'Asia/Manila' });

         if(v.from == user){
          pull = 'from pull-right';
         }else{
          pull = 'to pull-left';
         }


        chats += '<div class="chat_cont '+pull+'">';
        chats += ''+v.msg+'<p style="font-size:9px;">'+datestring1+'</p>';
        chats += '</div><p class=""><p><br><br><br><br>';

       });

      $('#message_cont').html(chats);
  
    },
    error: function(e){
  
    }
  });
//}, 300);



  $(document).on('click','#send',function(){
    var msg = $('#msg').val();

    if(msg == ''){
      alert("Message required!");
    }else{
    
    show_loader();
    $.ajax({
    url: base_url('chat'),
    type: 'POST',
    dataType: 'json',
    data:{msg:msg},
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
    success: function(ret){
       console.log(ret);
  
       $('#msg').val('');

       hide_loader();
  
    },
    error: function(e){
  
    }
  });

  }


  });


  </script>

  <script>
    //var user_id = '{{Auth::user()->id}}';
    show_loader();
    $.ajax({
    url: base_url('getAdminChats'),
    type: 'get',
    dataType: 'json',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
    success: function(ret){
      console.log(ret);

      ret.sort();
      
      var div = '';
      
      $.each(ret,function(k,v){
        
        var newmsg = '';
        if(v.chat[0].status == 0){
          newmsg = 'newmsg';
        }

        div += '<tr class="hover">';
        div += '<td class="'+newmsg+'">'+v.user+': '+v.chat[0].msg+'</td>';
        div += '</tr>';
      }); 

      $('#chatTbody').html(div);

       hide_loader();
  
       $('#chat-table').DataTable();
    },
    error: function(e){
  
      alert('Error on events table!');
  
    }
  });
  </script>

  </body>

</html>
