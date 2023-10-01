function filterEmployees() {
    const employeeNameFilter = document.getElementById('employee_name_filter').value.trim().toLowerCase();
    const departmentFilter = document.getElementById('department_filter').value.toLowerCase();

    const employeeCards = document.querySelectorAll('.profile-widget');

    employeeCards.forEach(card => {
        const employeeName = card.querySelector('.user-name a');
        const employeeDepartment = card.querySelector('.small.text-muted:last-child');

        if (employeeName && employeeDepartment) {
            const name = employeeName.textContent.toLowerCase();
            const department = employeeDepartment.textContent.trim().toLowerCase();

            const nameMatch = name.includes(employeeNameFilter);
            const departmentMatch = department === 'select department' || department === '' || department === departmentFilter;

            if (nameMatch && departmentMatch) {
                card.style.display = 'block'; // Show the card
            } else {
                card.style.display = 'none'; // Hide the card
            }
        }
    });
}

// Attach event listeners to filter elements
document.getElementById('employee_name_filter').addEventListener('input', filterEmployees);
document.getElementById('department_filter').addEventListener('change', filterEmployees);

// Call the filterEmployees function once to initially display all employees
filterEmployees();