document.addEventListener("DOMContentLoaded", function () {
    const dynamicInputsContainer = document.querySelector('.dynamic-inputs');
    const addMoreButtons = document.querySelectorAll('.add-more-button');

    // Function to add a new set of input fields
    function addInputSet() {
        const clone = dynamicInputsContainer.querySelector('.record-set').cloneNode(true);
        const removeButton = clone.querySelector('.remove-record');

        // Add an event listener to the new "Remove" button
        removeButton.addEventListener("click", function (event) {
            event.preventDefault();
            dynamicInputsContainer.removeChild(clone);
            // Check the number of items after removal
            if (dynamicInputsContainer.querySelectorAll('.record-set').length === 1) {
                dynamicInputsContainer.querySelector('.record-set .remove-record').style.display = 'none';
            }
        });

        dynamicInputsContainer.appendChild(clone);

        // Show the "Remove" button if there are multiple items
        if (dynamicInputsContainer.querySelectorAll('.record-set').length > 1) {
            removeButton.style.display = 'inline-block';
        } else {
            removeButton.style.display = 'none';
        }
    }

    // Event listener for all "Add More" buttons
    addMoreButtons.forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            addInputSet();
        });
    });
});
