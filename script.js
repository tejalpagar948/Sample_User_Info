$(document).ready(function () {
  $('.contact-form').on('submit', function (event) {
    event.preventDefault(); // Prevent default form submission
    var formData = {
      username: $('#username').val(),
      password: $('#password').val(),
    };
    console.log('formData' + formData);
    var formData = $(this).serialize(); // Serialize form data

    $.ajax({
      url: register.php, // WordPress AJAX URL
      type: 'POST',
      data: formData,
      success: function (response) {
        console.log('Form submitted successfully!'); // Handle success
      },
      error: function () {
        alert('An error occurred.'); // Handle error
      },
    });
  });
});

// $(document).ready(function () {
//   console.log('Hi');
//   console.log('Hi');
//   $('button').on('click', function (event) {
//     event.preventDefault(); // Prevent the default form submission
//     console.log('Hi');
//     // Get form data
//     var formData = {
//       username: $('#username').val(),
//       password: $('#password').val(),
//     };

//     console.log('Hi', formData);

//     // Send AJAX request
//     $.ajax({
//       type: 'POST',
//       url: 'register.php',
//       data: formData,
//       dataType: 'json',
//       success: function (response) {
//         if (response.status === 'success') {
//           $('#responseMessage').html(
//             '<p style="color: green;">' + response.message + '</p>'
//           );
//         } else {
//           $('#responseMessage').html(
//             '<p style="color: red;">' + response.message + '</p>'
//           );
//         }
//       },
//       error: function () {
//         $('#responseMessage').html(
//           '<p style="color: red;">An error occurred. Please try again.</p>'
//         );
//       },
//     });
//   });
// });
