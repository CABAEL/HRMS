var employee_id = window.location.pathname.split("/").pop();
show_loader();
$.ajax({
    url: base_url('employee/')+employee_id,
    type: 'GET',
    dataType: 'json',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
    success: function(ret) {
      $('#employee_id').html(ret[0].employee_id);
      $('#gender').html(ret[0].gender);
      $('#mobile').html(ret[0].mobile_number);
      $('#email').html(ret[0].email);
      if(ret[0].mname != null){
        mname = ret[0].mname;
      }else{
        mname = '';
      }
      $('#name').html(''+(ret[0].lname+', '+ret[0].fname+' '+mname).toUpperCase());
      console.log(ret);
      hide_loader();
    },
    error: function(e){

    }
});