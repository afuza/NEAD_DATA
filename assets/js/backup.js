// <!-- <script>
// $('input[data-toggle="toggle"]').bootstrapToggle();
// </script> -->
// <!-- <script>
// $(document).ready(function() {
//     $('.link-ss').click(function() {
//         var id = $(this).attr("id");
//         $.ajax({
//             url: "https://api.afuza.dev/email/apiv3/" + id,
//             type: "GET",
//             success: function(data) {
//                 // alert(data.status);
//                 $('#img_modal').html('<img class="hello_img" src="' + data.ss +
//                     '">');
//                 $('#view_gambar').modal("show");
//             }
//         });
//     });
// });
// </script> -->
// <!-- <script>
// $(document).ready(function() {
//     $('.note').click(function() {
//         var id = $(this).attr("id");
//         $.ajax({
//             url: "https://api.afuza.dev/email/apiv3/" + id,
//             type: "GET",
//             success: function(data) {
//                 // alert(data.status);
//                 $('#your_modal_detail').html(data.note);
//                 $('#dataModal').modal("show");
//             }
//         });
//     });
// });
// </script> -->
// <!-- <script>
// $(document).ready(function() {
//     $('.edit').click(function() {
//         var id = $(this).attr("id");
//         $.ajax({
//             url: "https://api.afuza.dev/email/apiv3/" + id,
//             type: "GET",
//             success: function(data) {
//                 // alert(data.status);
//                 $('#modal_email').val(data.email);
//                 $('#modal_password').val(data.password);
//                 $('#modal_nohp').val(data.nohp);
//                 $('#modal_note').val(data.note);
//                 var checkbox = $('#checkbox_st');
//                 if (data.status == "Active") {
//                     checkbox.prop('checked', true);
//                 } else {
//                     checkbox.prop('checked', false);
//                 }

//                 $('#editmodal').modal("show");

//             }
//         });
//     });
// });
// </script> -->
// <!-- <script>
// $(document).ready(function() {
//     $('.link-hapus').click(function() {
//         Swal.fire({
//             title: 'Are you sure?',
//             text: "You won't be able to revert this!",
//             icon: 'warning',
//             color: '#149414',
//             iconColor: '#149414',
//             background: 'black',
//             showCancelButton: true,
//             confirmButtonColor: '#149414',
//             cancelButtonColor: 'transparent',
//             confirmButtonText: 'Yes, delete it!'
//         }).then((result) => {
//             var id_email = $(this).attr("id");
//             if (result.isConfirmed) {
//                 $.ajax({
//                     url: "https://api.afuza.dev/email/apiv3/" + id_email,
//                     type: 'delete',
//                     success: function() {
//                         Swal.fire({
//                             iconColor: '#149414',
//                             background: 'black',
//                             color: '#149414',
//                             icon: 'success',
//                             title: 'Deleted!',
//                             text: 'Your file has been deleted.',
//                             showCancelButton: false,
//                             confirmButtonColor: '#149414',
//                         }).then((result) => {
//                             if (result.isConfirmed) {
//                                 location.reload();
//                             }
//                         })
//                     }
//                 })
//             }
//         })
//     });
// });
// </script> -->