$.ajax({
    url: base_url('employee_list'),
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
        div +='<td>'+value.username+'</td>';
        div +='<td>'+value.role+'</td>';
        div +='<td><button class="btn btn-sm btn-default viewuser" data-id="'+value.id+'"><i class="fa fa-user"></i></button></td>';
        div +='</tr>';
        $('#UserListBody').html(div);
      });
      
      $( "#employee-table").DataTable();

    },
    error: function(e){

    }
});