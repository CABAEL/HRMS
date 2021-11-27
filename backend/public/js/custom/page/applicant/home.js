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


$('#ApplicationDetails').on('click',function(event){
  console.log('pasok');

  event.preventDefault();
  // Get form
  var form = $('#applicant_details_form');
  // FormData object 
  var formData = form.serialize();
  show_loader();
  $.ajax({
    url: base_url('applicant_details'),
    type: 'POST',
    dataType: 'json',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
    data:formData,
    success: function(ret) {


    },
    error: function(e) {
      //alert(e.responseJSON.message +"<br>"+e.responseJSON.errors);
      var element = $('#application_detail_errors');
      var form = '#applicant_details_form';
      promt_errors(form,element,e);

      hide_loader();
    }
});  

});