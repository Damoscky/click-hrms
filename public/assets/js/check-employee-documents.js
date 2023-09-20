function checkEmployeeDocument(department, totalCertificates, totalDocuments, reference) {
    // Code to get the user's location
    if (department === "Nurse" && totalCertificates >= 20 && totalDocuments >= 10 && reference >= 2) {
        $('#confirm_approval_modal').modal('show');
    } else if(department === "Health Care Assistant" && totalCertificates >= 18 && totalDocuments >= 8 && reference >= 2) {
        $('#confirm_approval_modal').modal('show');
    }else if(department === "Senior Health Care Assistant" && totalCertificates >= 20 && totalDocuments >= 10 && reference >= 2){
        $('#confirm_approval_modal').modal('show');
    }else if(department === "Kitchen Assistant" && totalCertificates >= 1 && totalDocuments >= 8 && reference >= 2){
        $('#confirm_approval_modal').modal('show');
    }else{
        $('#confirm_approval_modal_error').modal('show');
    }
};