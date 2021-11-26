$.ajax({
    url: base_url('jon'),
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

        div +='<option>'+value.+'</option>'; 

        $('#position').html(div);
      });
      
      $( "#employee-table").DataTable();

    },
    error: function(e){

    }
});