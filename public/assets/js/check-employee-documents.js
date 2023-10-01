function checkEmployeeDocument(department, totalCertificates, totalDocuments, reference) {
    // Code to get the user's location
    if (department === "Nurse" && totalCertificates >= 20 && totalDocuments >= 10 && reference >= 2) {
        $('#confirm_approval_modal').modal('show');
    } else if(department === "Health Care Assistant" && totalCertificates >= 19 && totalDocuments >= 7 && reference >= 2) {
        $('#confirm_approval_modal').modal('show');
    }else if(department === "Senior Healthcare Assistant" && totalCertificates >= 20 && totalDocuments >= 7 && reference >= 2){
        $('#confirm_approval_modal').modal('show');
    }else if(department === "Cleaning" && totalCertificates >= 7 && totalDocuments >= 7 && reference >= 2){
        $('#confirm_approval_modal').modal('show');
    }else if(department === "Kitchen Assistant" && totalCertificates >= 3 && totalDocuments >= 7 && reference >= 2){
        $('#confirm_approval_modal').modal('show');
    }else if(department === "Chef" && totalCertificates >= 3 && totalDocuments >= 7 && reference >= 2){
        $('#confirm_approval_modal').modal('show');
    }else{
        $('#confirm_approval_modal_error').modal('show');
    }
};