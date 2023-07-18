$(document).ready(function () {
    // Function to handle file input changes
    function handleFileInput(fileInput, fileLabel, imagePreview) {
        var file = fileInput.files[0];
        var fileName = file.name;
        var fileExtension = fileName.split('.').pop().toLowerCase();
        var allowedExtensions = ['png', 'jpg', 'jpeg'];

        // Check if the file extension and type are valid for images
        if (allowedExtensions.indexOf(fileExtension) !== -1 && file.type.startsWith('image/')) {
            fileLabel.text(fileName);
            var reader = new FileReader();

            // Read the file and display the image preview
            reader.onload = function (e) {
                imagePreview.attr('src', e.target.result);
                imagePreview.show(); // Show the image preview
            }

            reader.readAsDataURL(file);
        } else {
            // Invalid file format, display an error message and hide the image preview
            fileLabel.text('Invalid file format');
            imagePreview.attr('src', '');
            imagePreview.hide(); // Hide the image preview
        }
    }

    // Event handler for the first file input
    $('#file-input').on('change', function () {
        var fileInput = this;
        var fileLabel = $('#file-label');
        var imagePreview = $('#image-preview');
        handleFileInput(fileInput, fileLabel, imagePreview);
    });

    // Event handler for the second file input
    $('#file-input-2').on('change', function () {
        var fileInput = this;
        var fileLabel = $('#file-label-2');
        var imagePreview = $('#image-preview-2');
        handleFileInput(fileInput, fileLabel, imagePreview);
    });

    // Event handler for the third file input
    $('#file-input-3').on('change', function () {
        var fileInput = this;
        var fileLabel = $('#file-label-3');
        var imagePreview = $('#image-preview-3');
        handleFileInput(fileInput, fileLabel, imagePreview);
    });
});