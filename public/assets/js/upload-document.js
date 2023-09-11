function removeUploadedOption() {
    // Get the select element
    var selectElement = document.querySelector('select[name="document_type"]');
    
    // Get the options that have been uploaded (you will need to implement this logic)
    var uploadedOption = document.querySelector('select[name="document_type"]').value; // Example uploaded option

    // Make an API request to upload the document
    fetch('{{ route('employee.document.upload.api') }}', {
        method: 'POST',
        body: new FormData(document.querySelector('form')),
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === 'Document uploaded successfully') {
            // Remove the uploaded option from the select
            for (var i = 0; i < selectElement.options.length; i++) {
                if (selectElement.options[i].value === uploadedOption) {
                    selectElement.remove(i);
                    break; // Exit the loop once the option is removed
                }
            }
            alert('Document uploaded successfully');
        } else {
            alert('Error uploading document');
        }
    })
    .catch(error => {
        console.error(error);
        alert('An error occurred');
    });
}