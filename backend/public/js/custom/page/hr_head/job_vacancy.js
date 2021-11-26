$.ajax({
    url: base_url('job'),
    type: 'GET',
    dataType: 'json',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
    success: function(ret) {
     // console.log(ret);
      var div = '';

      $.each(ret.data, function( index, value ) {
       // console.log( index + ": " + value.username );
        div +='<tr>'; 
        div +='<td>'+value.name+'</td>';
        div +='<td>'+value.description+'</td>';
        div +='<td><button class="btn btn-sm btn-default delete_job" data-id="'+value.id+'"><i class="fa fa-trash"></i> Delete</button>&nbsp;<button class="btn btn-sm btn-default edit_job" data-id="'+value.id+'"><i class="fa fa-edit"></i> Edit</button></td>';
        div +='</tr>';
        $('#JobListBody').html(div);
      });
      
      $( "#job-table").DataTable();

    },
    error: function(e){

    }
});

$('#add_job_vacancy').on('click',function(event) {
    event.preventDefault();
    // Get form
    var form = $('#add_job_from');
    // FormData object 
    var formData = form.serialize();

  show_loader();
   $.ajax({
    url: base_url("job"),
    type: 'POST', 
    dataType: 'json',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
    data:formData,
    success: function(data) {
      console.log(data);
      alert('Job added successfully!');
      //promt_success(element,data)
      hide_loader();
      window.location.replace('/hr_head/job_vacancies');
    },
    error: function(e){
      //alert(e.responseJSON.message +"<br>"+e.responseJSON.errors);
      var element = $('#add_job_errors');
      var form = '#add_job'; 
      promt_errors(form,element,e);
      hide_loader();
    }
});

});