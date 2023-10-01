$(document).ready(function () {
    $('#admincertificateUploadForm').on('submit', function (e) {
        e.preventDefault();

        // Serialize form data to send to the API
        var formData = new FormData(this);
        

        $.ajax({
            url: '/admin/employee/certificate/upload',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // Handle success response (e.g., show a success message)
                console.log(response);
                if(response.error == true){
                    alert(response.message);
                }else{
                    alert(response.message);
                    window.location.reload();
                }
                
                // You can redirect the user or update the UI as needed
            },
            error: function (xhr, status, error) {
                // Handle error response (e.g., display an error message)
                console.error(xhr.responseText);
                alert('Error: ' + xhr.responseText);
            }
        });
    });
});