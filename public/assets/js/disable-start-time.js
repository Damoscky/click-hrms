// Wait for the DOM to be ready
$(document).ready(function () {
    // Get references to the "All Day" checkbox and the "Start Time" and "End Time" input fields
    var $allDayCheckbox = $('#customSwitch1');
    var $startTimeInput = $('#startTime');
    var $endTimeInput = $('#endTime');

    // Function to toggle the disabled state of the time inputs
    function toggleTimeInputs() {
        var isAllDayChecked = $allDayCheckbox.prop('checked');
        $startTimeInput.prop('disabled', isAllDayChecked);
        $endTimeInput.prop('disabled', isAllDayChecked);
    }

    // Initially, set the state of time inputs based on the checkbox state
    toggleTimeInputs();

    // Add a change event listener to the "All Day" checkbox
    $allDayCheckbox.on('change', function () {
        toggleTimeInputs(); // Toggle the time inputs based on the new checkbox state
    });
});
