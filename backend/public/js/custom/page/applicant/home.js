$.ajax({
    url: base_url('job'),
    type: 'GET',
    dataType: 'json',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
    success: function(ret) {
     console.log(ret);
      var div = '';
      div +='<option value="">---</option>'; 
      $.each(ret.data, function( index, value ) {
        div +='<option value="'+value.id+'">'+value.name+'</option>'; 
        $('#position').html(div);
      });
      
      $( "#employee-table").DataTable();

    },
    error: function(e){

    }
});


$.ajax({
    url: base_url('user_applicant_details'),
    type: 'GET',
    dataType: 'json',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
    success: function(ret) {
     console.log(ret);
     if(ret.length == 0){
      $('#resume_href').attr('href',base_url('../upload/no_resume.pdf'));

     }else{
      if(ret[0].resume_link != null){

        $('#resume_href').attr('href',base_url('../upload/resume/'+ret[0].resume_link));
       }
       else{
        $('#resume_href').attr('href',base_url('../upload/no_resume.pdf'));
       }
     }

     
    },
    error: function(e){
     
    }
});


$('#ApplicationDetails').on('click',function(event){
  event.preventDefault();
  //var form = $('#applicant_details_form');

 // fd.append('file',files[0]);
 var formData = new FormData($('#applicant_details_form')[0]);
 files = $('#resume_file');
 formData.append('file',files);

  show_loader();
  $.ajax({
    type:'POST',
    url: base_url('add_applicant_details'),
    data:formData,
    cache:false,
    contentType: false,
    processData: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
    success:function(data){
        alert("application details added");
        console.log(data);
        window.location.reload();
    },
    error: function(data){
        console.log("error");
        console.log(data);
    }
});  

});
$('#uploadResume').on('click',function(event){
  //console.log('sss');

  var fd = new FormData();
  var files = $('#resume_file')[0].files;
  
  console.log(files);

  show_loader();
  if(files.length > 0 ){
    fd.append('file',files[0]);

    $.ajax({
      url: base_url('upload_resume'),
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
       type: 'post',
       data: fd,
       contentType: false,
       processData: false,
       success: function(response){
        console.log(response);
        $('#resume_form')[0].reset();
        alert(response.message);
        //$('#upload_resume_modal').modal('hide');
        hide_loader();
        location.reload(); 
       },
    });
 }else{
    alert("Please select a file.");
 } 

});