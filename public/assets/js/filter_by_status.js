// Get references to the input, select, and clear filter button elements
const searchInput = document.getElementById("searchInput");
const statusFilter = document.getElementById("statusFilter");
const tableRows = document.querySelectorAll(".table tbody tr");
const clearFilterBtn = document.getElementById("clearFilterBtn");

// Attach event listeners to the input, select, and clear filter button elements
searchInput.addEventListener("input", filterTable);
statusFilter.addEventListener("change", filterTable);
clearFilterBtn.addEventListener("click", clearFilter);

function filterTable() {
    const searchText = searchInput.value.toLowerCase();
    const selectedStatus = statusFilter.value.toLowerCase();

    tableRows.forEach((row) => {
        const type = row.querySelector("td:nth-child(1)").textContent.toLowerCase();
        const status = row.querySelector("td:nth-child(9) a").textContent.toLowerCase();

        if (
            (searchText === "" || type.includes(searchText)) &&
            (selectedStatus === "" || status.includes(selectedStatus))
        ) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });

    // Enable or disable the Clear Filter button based on whether there's a filter
    const hasFilter = searchText !== "" || selectedStatus !== "";
    clearFilterBtn.disabled = !hasFilter;
}

function clearFilter() {
    // Clear the search input and select
    searchInput.value = "";
    statusFilter.value = "";

    // Show all table rows
    tableRows.forEach((row) => {
        row.style.display = "";
    });

    // Disable the Clear Filter button after clearing the filter
    clearFilterBtn.disabled = true;
}