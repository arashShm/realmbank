

$("#menu-toggle").click(function (e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
});



$(document).on('click', '.deleteRecord', function () {
  var recordId = $(this).data('record-id');

  $.ajax({
    url: url,
    type: 'DELETE',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (response) {
      swal({
        icon: 'success',
        title: 'Success!',
        text: response.message,
      });
    },
    error: function (xhr, status, error) {
      swal({
        icon: 'error',
        title: 'Error!',
        text: 'Deleting Failed!',
      });
    }
  });
});



$(document).ready(function(){
  $('#form').submit(function (e) {
    e.preventDefault();
  
    $.ajax({
      type: 'POST',
      url: $(this).attr('action'),
      data: $(this).serialize(),
      success: function(response){
        // swal.fire({
        //   title: "Success!",
        //   text: "Form submitted",
        //   icon: "success",
        // });
        console.log(response);
      },
      error: function(xhr , status , error){
        // swal.fire({
        //   title: "Error!",
        //   text: "An Error Occurred!",
        //   icon: "error"
        // });
        console.log(xhr ,responseText, error);
      }
    });
})
});




// $('#navForm').submit(function (e) {
//   e.preventDefault();

//   $.ajax({
//     type: 'GET',
//     url: $(this).attr('action'),
//     data: $(this).serialize(),
//   });
// });




$('#countrySelect').on('change', function() {
  var countryId = $(this).val();
  if(countryId) {
      $.ajax({
          url: '/admin/getCities/'+countryId,
          type: 'GET',
          dataType: "json",
          success: function(data) {
              $('#citySelect').empty();
              $('#citySelect').append('<option value="">Select City</option>');
              data.forEach(function(city) {
                  $('#citySelect').append('<option value="' + city.id + '" >' + city.cityName + '</option>');
              });
          }
      });
  } else {
      $('#citySelect').empty();
      $('#citySelect').append('<option value="">Choose City...</option>');
  }
});



$(document).ready(function() {
  $('#multiple-select-field').select2()});

$(document).ready(function() {
    $('#multiple-select-field2').select2()});



    function deleteAccount() {
      Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
          if (result.isConfirmed) {
            document.getElementById('delete-form').submit();
          }
      });
  }


  $('#countrySelect2').on('change', function() {
    var countryId = $(this).val();
    if(countryId) {
        $.ajax({
            url: '/getCities/'+countryId,
            type: 'GET',
            dataType: "json",
            success: function(data) {
                $('#citySelect2').empty();
                $('#citySelect2').append('<option value="">Select City</option>');
                data.forEach(function(city) {
                    $('#citySelect2').append('<option value="' + city.id + '" >' + city.cityName + '</option>');
                });
            }
        });
    } else {
        $('#citySelect2').empty();
        $('#citySelect2').append('<option value="">Choose City...</option>');
    }
  });

