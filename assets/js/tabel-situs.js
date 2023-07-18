$(document).ready(function () {
    var table = $('#emaildata').DataTable({
        // Fetch data from the API
        ajax: {
            url: api_uri + "/api/v1/situs/data",
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                populateTable(data);
            },
            error: function () {
                alert('Error retrieving data');
            }
        },
        ordering: true,
        paging: true,
        searching: true,
        lengthChange: false,
        pageLength: 5,
        responsive: true,
        pagingType: 'simple',
        autoWidth: true,
    });

    // Handle delete email button click
    $(document).on('click', '.link-hapus', function () {
        // Display a confirmation dialog
        var id_situs = $(this).attr("id");
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            iconColor: '#149414',
            background: 'black',
            showCancelButton: true,
            confirmButtonColor: '#149414',
            cancelButtonColor: 'transparent',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Send a DELETE request to the API to delete the email
                $.ajax({
                    url: api_uri + "/api/v1/situs/data/" + id_situs,
                    type: 'DELETE',
                    success: function () {
                        // Display a success message after deletion
                        Swal.fire({
                            iconColor: '#149414',
                            background: 'black',
                            color: '#149414',
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'Your file has been deleted.',
                            showCancelButton: false,
                            confirmButtonColor: '#149414',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                table.ajax.reload(null, false);
                            }
                        });
                    }
                });
            }
        });
    });

    // Handle view screenshot button click
    $(document).on('click', '.link-ss', function () {
        var id = $(this).attr("id");
        // Fetch the screenshot data from the API
        $.ajax({
            url: api_uri + "/api/v1/situs/data/" + id,
            type: "GET",
            success: function (data) {
                // Display the screenshot in a modal
                $('#img_modal').html('<img class="hello_img" src="' + data.ss + '">');
                $('#view_gambar').modal("show");
            },
            error: function () {
                alert('Error retrieving data');
            }
        });
    });

    // Handle note button click
    $(document).on('click', '.note', function () {
        var id = $(this).attr("id");
        // Fetch the email data from the API
        $.ajax({
            url: api_uri + "/api/v1/situs/data/" + id,
            type: "GET",
            success: function (data) {
                // Format the creation date of the email
                var timestamp = data.createdAt;
                var datetime = new Date(timestamp);
                var options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                };
                var formattedDate = datetime.toLocaleDateString('id-ID', options);
                // Display the email note and creation date in a modal
                $('#your_modal_detail').html(data.note);
                $('#your_modal_date').html(formattedDate);
                $('#dataModal').modal("show");
            },
            error: function () {
                alert('Error retrieving data');
            }
        });
    });

    // Function to populate the table with data
    function populateTable(data) {
        var table = $('#emaildata').DataTable();
        // Clear the table
        table.clear();
        var i = 0;
        // Loop through the JSON data and add rows
        $.each(data, function (index, item) {
            // Set the status color based on the email status
            var statusColor = (item.status == "Active") ? "#149414" : "#e91b1b";
            // Create the view button for the screenshot
            var viewButton = '<button class="link-ss" id="' + item._id + '">View</button>';
            // Create the action buttons for delete, edit, and note
            var actionButtons = '<button class="link-hapus" id="' + item._id + '">HAPUS</button>|' +
                '<button class="edit bg-none-green" data-bs-toggle="modal" id="' + item._id + '">Edit</button>|' +
                '<button type="button" class="note bg-note" data-bs-toggle="modal" id="' + item._id + '">NOTE</button>';
            // Add the row to the table
            table.row.add([
                ++i,
                item.situs,
                item.email,
                item.earning,
                viewButton,
                actionButtons
            ]);
        });

        // Draw the table to display the new data
        table.draw();
    }

    // Reload the table data every 30 seconds
    setInterval(function () {
        table.ajax.reload(null, false); // user paging is not reset on reload
    }, 30000);

    new $.fn.dataTable.FixedHeader(table);
});