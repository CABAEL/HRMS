$.ajax({
    url: base_url('applicant_details'),
    type: 'GET',
    dataType: 'json',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
    success: function(ret) {
     
      var div = '';
      $.each(ret.data, function( index, value ) {
        console.log(ret);
        var status = 0;
        if(value.status == 0){
          status = "Pending";
        }
        if(value.status == 1){
          status = "Accepted";
        }
        if(value.status == 2){
          status = "Rejected";
        }

        const d = value.created_at;
        
        var actual_date= d.substring(0, 10);

        div +='<tr>'; 
        div +='<td>'+value.lname+' '+value.fname+'</td>';
        div +='<td>'+value.name+'</td>';
        div +='<td>'+status+'</td>';
        div +='<td>'+actual_date+'</td>';
        div +='<td><button class="btn btn-sm btn-default viewApplicationDetails" data-id="'+value.user_id+'">View Application Details</button></td>';
        div +='</tr>';
        $('#ApplicantListBody').html(div);
      });
      
      $( "#applicant-table").DataTable();

    },
    error: function(e){

    }
});


$(document).on("click",".viewApplicationDetails",function(e) {
//$('').on('click',function() {
  var id = $(this).data('id');
  console.log(id);
  $.ajax({
    url: base_url('applicant_details'),
    type: 'GET',
    dataType: 'json',
    data:{id:id},
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
    success: function(ret) {
      console.log(ret);
      var name = "&nbsp;"+ret.data[0].lname+", "+ret.data[0].fname;
      var resume_link = '&nbsp;<a href="../upload/resume/'+ret.data[0].resume_link+'" target="_blank">View Resume</a>';
      var email = "&nbsp;"+ret.data[0].email;
      var mobile_number = "&nbsp;"+ret.data[0].mobile_number;
      var position = "&nbsp;"+ret.data[0].name;
      var self = "&nbsp;"+ret.data[0].about_self;
      var id = ret.data[0].user_id;


      $('#applicant_name').html(name);
      $('#applicant_resume_link').html(resume_link);
      $('#applicant_email').html(email);
      $('#applicant_mobile_number').html(mobile_number);
      $('#applicant_position_applied').html(position);
      $('#applicant_about_self').html(self);

      $('#accept_application').attr('data-id',id);
      $('#decline_application').attr('data-id',id);

      $('#viewApplicant').modal('toggle');

    },
    error: function(e){

    }
});

});

$(document).on("click","#accept_application",function(e) {
  var id = $(this).data('id');
  alert(id);
});

$(document).on("click","#decline_application",function(e) {
  var id = $(this).data('id');
  alert(id);
});