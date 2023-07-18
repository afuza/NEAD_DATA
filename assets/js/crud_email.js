$(document).ready(function () {
    // Form submission for adding email
    $('#add-email').submit(function (e) {
        e.preventDefault();

        // Disable the loading button
        $("#loading").addClass("disabled").attr("disabled", true).val("Please wait...");

        // Get form data
        var formData = new FormData(this);
        var email = $('#emailInput').val();
        var password = $('#passInput').val();
        var nope = $('#nopeInput').val();
        var file = $('#file-input').val();
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Validate email format
        if (!emailRegex.test(email)) {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Email is not valid!',
                showConfirmButton: false,
                timer: 1500
            });
            // Enable the loading button
            $('#loading').removeClass('disabled').attr('disabled', false).val('Add Email');
            return;
        }

        // Check for empty fields
        if (email === '' || password === '' || nope === '' || file === '') {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'All fields are required!',
                showConfirmButton: false,
                timer: 1500
            });
            // Enable the loading button
            $('#loading').removeClass('disabled').attr('disabled', false).val('Add Email');
            return;
        }

        // Submit the form data via AJAX
        $.ajax({
            url: '../core/nead_core.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // Display success message
                Swal.fire({
                    iconColor: '#149414',
                    background: 'black',
                    color: '#149414',
                    icon: 'success',
                    title: 'Success!',
                    text: 'Your file has been Add.',
                    showCancelButton: false,
                    confirmButtonColor: '#149414'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Reset the form and associated elements
                        $('#loading').removeClass('disabled').attr('disabled', false).val('Add Email');
                        $('#add-email')[0].reset();
                        $('#file-label').text('Choose file');
                        $('#image-preview').hide();
                    }
                });
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
});

// Edit email
$(document).on('click', '.edit', function () {
    var id = $(this).attr("id");
    // Retrieve email data via AJAX
    $.ajax({
        url: api_uri + "/api/v1/email/data/" + id,
        type: "GET",
        success: function (data) {
            // Populate the modal fields with the retrieved data
            $('#modal_email').val(data.email);
            $('#modal_password').val(data.password);
            $('#modal_nohp').val(data.nohp);
            $('#modal_note').val(data.note);
            $('#image-preview-3').attr('src', data.ss);
            $('#id-edit').val(id);
            $('#img-scr').val(data.ss);
            // Set the bootstrap toggle based on the status
            $('input[data-toggle="toggle"]').bootstrapToggle(data.status === "Active" ? 'on' : 'off');
            // Show the edit modal
            $('#editmodal').modal("show");
        }
    });
});

$(document).ready(function () {
    // Form submission for editing email
    $('#edit-email').submit(function (e) {
        e.preventDefault();
        // Disable the loading button
        $("#loading").addClass("disabled").attr("disabled", true).val("Please wait...");

        // Get form data
        var formData = new FormData(this);
        var email = $('#modal_email').val();
        var password = $('#modal_password').val();
        var nope = $('#modal_nohp').val();
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Validate email format
        if (!emailRegex.test(email)) {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Email is not valid!',
                showConfirmButton: false,
                timer: 1500
            });
            // Enable the loading button
            $('#loading').removeClass('disabled').attr('disabled', false).val("Save changes");
            return;
        }

        // Check for empty fields
        if (email === '' || password === '' || nope === '') {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'All fields are required!',
                showConfirmButton: false,
                timer: 1500
            });
            // Enable the loading button
            $('#loading').removeClass('disabled').attr('disabled', false).val("Save changes");
            return;
        }

        // Submit the form data via AJAX
        $.ajax({
            url: '../core/nead_core.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // Display success message
                Swal.fire({
                    iconColor: '#149414',
                    background: 'black',
                    color: '#149414',
                    icon: 'success',
                    title: 'Success!',
                    text: 'Your file has been Edit.',
                    showCancelButton: false,
                    confirmButtonColor: '#149414'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Enable the loading button
                        $('#loading').removeClass('disabled').attr('disabled', false).val('Save changes');
                        // Hide the edit modal
                        $('#editmodal').modal("hide");
                    }
                });
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
});