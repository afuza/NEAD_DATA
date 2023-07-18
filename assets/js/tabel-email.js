$(document).ready(function () {
    // Initialize DataTable
    var table = $('#emaildata').DataTable({
        // Fetch data from the server
        ajax: {
            url: api_uri + "/api/v1/email/data",
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

    // Handle delete email action
    $(document).on('click', '.link-hapus', function () {
        // Display a confirmation dialog
        var id_email = $(this).attr("id");
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            color: '#149414',
            iconColor: '#149414',
            background: 'black',
            showCancelButton: true,
            confirmButtonColor: '#149414',
            cancelButtonColor: 'transparent',
            confirmButtonText: 'Yes, delete it!'
        }).then(function (result) {
            if (result.isConfirmed) {
                // Send a DELETE request to the server
                $.ajax({
                    url: api_uri + "/api/v1/email/data/" + id_email,
                    type: 'DELETE',
                    success: function () {
                        // Show a success message after successful deletion
                        Swal.fire({
                            iconColor: '#149414',
                            background: 'black',
                            color: '#149414',
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'Your file has been deleted.',
                            showCancelButton: false,
                            confirmButtonColor: '#149414',
                        }).then(function (result) {
                            if (result.isConfirmed) {
                                // Reload the DataTable after deletion
                                table.ajax.reload(null, false);
                            }
                        });
                    }
                });
            }
        });
    });

    // Handle view SS browser action
    $(document).on('click', '.link-ss', function () {
        var id = $(this).attr("id");
        // Fetch the data for the selected email ID
        $.ajax({
            url: api_uri + "/api/v1/email/data/" + id,
            type: "GET",
            success: function (data) {
                // Display the screenshot in a modal
                $('#img_modal').html('<img class="hello_img" src="' + data.ss + '">');
                $('#view_gambar').modal("show");
            }
        });
    });

    // Handle note email action
    $(document).on('click', '.note', function () {
        var id = $(this).attr("id");
        // Fetch the data for the selected email ID
        $.ajax({
            url: api_uri + "/api/v1/email/data/" + id,
            type: "GET",
            success: function (data) {
                // Format the date
                var timestamp = data.date ? data.date : data.createdAt;
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
                // Display the note and date in a modal
                $('#your_modal_detail').html(data.note);
                $('#your_modal_date').html(formattedDate);
                $('#dataModal').modal("show");
            }
        });
    });

    // Function to populate the DataTable with data
    function populateTable(data) {
        var table = $('#emaildata').DataTable();
        table.clear();

        var i = 0;
        $.each(data, function (index, item) {
            // Determine the status color based on the "status" property
            var statusColor = item.status === "Active" ? '#149414' : '#e91b1b';
            var statusHTML = '<span style="color: ' + statusColor + ';">' + (item.status === "Active" ? 'On' : 'Off') + '</span>';
            var viewButton = '<button class="link-ss" id="' + item._id + '">View</button>';
            var actionButtons = '<button class="link-hapus" id="' + item._id + '">HAPUS</button>|' +
                '<button class="edit bg-none-green" data-bs-toggle="modal" id="' + item._id + '">Edit</button>|' +
                '<button type="button" class="note bg-note" data-bs-toggle="modal" id="' + item._id + '">NOTE</button>';

            var row = [
                ++i,
                item.email,
                item.password,
                item.nohp,
                statusHTML,
                viewButton,
                actionButtons
            ];

            table.row.add(row);
        });

        table.draw();
    }

    // Reload the DataTable periodically
    setInterval(function () {
        table.ajax.reload(null, false);
    }, 20000);

    // Initialize FixedHeader plugin
    new $.fn.dataTable.FixedHeader(table);
});