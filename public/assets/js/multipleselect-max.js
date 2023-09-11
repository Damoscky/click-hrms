document.addEventListener('DOMContentLoaded', function() {
    // Get the form element
    var form = document.getElementById('myForm');

    form.addEventListener('submit', function(event) {
        // Validate Employee Name field (at least one option selected)
        var employeeNameSelect = form.querySelector('select[name="employee_name[]"]');
        if (employeeNameSelect && employeeNameSelect.selectedOptions.length === 0) {
            alert('Please select at least one employee.');
            event.preventDefault(); // Prevent form submission
            return;
        }

        // You can add more validation checks for other fields here if needed.
    });
});