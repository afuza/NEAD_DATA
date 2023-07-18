$(document).ready(function () {
    // Form submission for adding a site
    $('#add-site').submit(function (e) {
        e.preventDefault();

        // Disable the submit button and show loading state
        $("#loading").addClass("disabled").attr("disabled", true).val("Please wait...");

        var formData = new FormData(this);
        var site = $('#siteInput').val();
        var email = $('#emailInput').val();
        var file = $('#file-input').val();
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Validate email and presence of all required fields
        if (!emailRegex.test(email) || email === '' || site === '' || file === '') {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: (!emailRegex.test(email)) ? 'Email is not valid!' : 'All fields are required!',
                showConfirmButton: false,
                timer: 1500
            });

            // Enable the submit button and reset its value
            $('#loading').removeClass('disabled').attr('disabled', false).val("Add Site");
            return;
        }

        // Submit the form via AJAX
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
                    text: 'Your file has been added.',
                    showCancelButton: false,
                    confirmButtonColor: '#149414',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Reset the form
                        $('#add-site')[0].reset();
                        $('#file-label').text('Choose file');
                        $('#image-preview').hide();
                        $('#loading').removeClass('disabled').attr('disabled', false).val('Add Site');
                    }
                });
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });

    // Edit button click event
    $(document).on('click', '.edit', function () {
        var id = $(this).attr("id");

        // Fetch data for the selected ID via AJAX
        $.ajax({
            url: api_uri + "/api/v1/situs/data/" + id,
            type: "GET",
            success: function (data) {
                // Fill the edit modal with the retrieved data
                $('#modal_situs').val(data.situs);
                $('#modal_email').val(data.email);
                $('#modal_earning').val(data.earning);
                $('#modal_note').val(data.note);
                $('#image-preview-2').attr('src', data.ss);
                $('#id-edit').val(id);
                $('#img-scr').val(data.ss);
                $('#editmodal').modal("show");
                $('#loading-2').removeClass('disabled').attr('disabled', false).val("Save Changes");
            }
        });
    });

    // Form submission for editing a site
    $('#edit-site').submit(function (e) {
        e.preventDefault();

        // Disable the submit button and show loading state
        $("#loading-2").addClass("disabled").attr("disabled", true).val("Please wait...");

        var formData = new FormData(this);
        var email = $('#modal_email').val();
        var password = $('#modal_password').val();
        var nope = $('#modal_nohp').val();
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Validate email and presence of all required fields
        if (!emailRegex.test(email) || email === '' || password === '' || nope === '') {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: (!emailRegex.test(email)) ? 'Email is not valid!' : 'All fields are required!',
                showConfirmButton: false,
                timer: 1500
            });

            // Enable the submit button and reset its value
            $('#loading-2').removeClass('disabled').attr('disabled', false).val("Save Changes");
            return;
        }

        // Submit the form via AJAX
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
                    text: 'Your file has been edited.',
                    showCancelButton: false,
                    confirmButtonColor: '#149414',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Hide the edit modal
                        $('#editmodal').modal("hide");
                        $('#loading-2').removeClass('disabled').attr('disabled', false).val('Save Changes');
                    }
                });
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
});