$(document).ready(function() {
    if ($(".logged").length) {
        setTimeout(function () {
            $(".logged").fadeOut();
        }, 3000);
    }
});




// $('#homeForm').on('submit', function (event) {
//     event.preventDefault();

//     const formData = $(this).serialize();;

//     $.ajax({
//         url: "/home",
//         type: 'GET',
//         data: formData,
//         dataType: 'json',
//         success: function (response) {
//             // Handle the response data as needed

//             // Update the page content with the response data
//             // For example, you can replace the current property listings with the updated listings
//             console.log('ok');
//         },
//         error: function (error) {
//             console.error('Error:', error);
//         }
//     });
// });




// $(document).ready(function () {
 
//     var form = $('#homeForm');
 
//     form.submit(function(e) {
 
//         e.preventDefault();
//         $.ajax({
//             url     : "/home",
//             type    : "GET",
//             data    : form.serialize(),
//             success : function (data)
//             {
//                 $('#properties').empty();
//                 $.each(data.properties, function(index, property) {
//                     $('.property-card-container').append(`
//                         <div class="card m-1" style="width: 18rem;">
//                             <img src="` + property.image + `" class="card-img-top image" alt="Card image cap">
//                             <div class="card-body">
//                               <h5 class="card-title">` + property.user.phone + `</h5>
//                               <p class="card-text">` + property.description + `</p>
//                               <p class="card-text"><small class="text-muted">` + agoTime(property.expires_at) + `</small></p>
//                             </div>
//                           </div>
//                     `);
//                 });
//                 console.log('ok');
//             },
//             error: function( json )
//             {
//                 if(json.status === 422) {
//                     var errors = json.responseJSON;
//                     $.each(json.responseJSON, function (key, value) {
//                         $('.'+key+'-error').html(value);
//                     });
//                 } else {
//                     // Error
//                     // Incorrect credentials
//                     // alert('Incorrect credentials. Please try again.')
//                 }
//             }
//         });
//     });
 
// });
