document.addEventListener("DOMContentLoaded", function () {
    const imageUpload = document.getElementById('image-upload');

    // Add an event listener for when a file is selected
    imageUpload.addEventListener('change', function (event) {
        const file = event.target.files[0];

        // Ensure a file is selected
        if (!file) {
            alert('Please select an image.');
            return;
        }

        // Create a FormData object to send the file
        const formData = new FormData();
        formData.append('image', file);

        // Get the upload button for updating its state
        const uploadButton = document.getElementById('upload-label'); // Updated selector
        console.log(uploadButton); // Debugging line
        if (!uploadButton) {
            console.error('Upload button not found in the DOM');
            return;
        }
        uploadButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
        uploadButton.disabled = true;

        // Retrieve the CSRF token from the meta tag
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        if (!csrfToken) {
            alert('CSRF token not found. Please try again.');
            uploadButton.innerHTML = 'Ajouter un document depuis une image';
            uploadButton.disabled = false;
            return;
        }

        // Send the image to the OCR API endpoint
        fetch('/api/python/image', {
            method: 'POST',
            body: formData,
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                'X-CSRF-TOKEN': csrfToken, // Include CSRF token in the headers
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok.');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert('Document added successfully!');
                location.reload(); // Reload the page to reflect the new document
            } else {
                alert('Error: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while processing the image.');
        })
        .finally(() => {
            // Reset the button state regardless of success or failure
            uploadButton.innerHTML = 'Ajouter un document depuis une image';
            uploadButton.disabled = false;
        });
    });
});