const barCtx = document.getElementById("barChart").getContext("2d");
    const lineCtx = document.getElementById("lineChart").getContext("2d");

    // Fetch dynamic sales data from an API
    fetch("https://www.clickhrm.com/api/reports/sales/overview")
      .then(response => response.json())
      .then(data => {
        console.log(data.data);
        const months = data.data.months;
        const revenueSalesData = data.data.revenueSalesData;
        const shiftSalesData = data.data.shiftSalesData;

        // Create the bar chart
        new Chart(barCtx, {
          type: 'bar',
          data: {
            labels: months,
            datasets: [{
              label: 'Monthly Revenue',
              data: revenueSalesData,
              backgroundColor: 'rgba(54, 162, 235, 0.6)', // Bar color
              borderColor: 'rgba(54, 162, 235, 1)',
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });

        // Create the line graph
        new Chart(lineCtx, {
          type: 'line',
          data: {
            labels: months,
            datasets: [{
              label: 'Shift Overview',
              data: shiftSalesData,
              borderColor: 'rgba(75, 192, 192, 1)', // Line color
              fill: false
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      })
      .catch(error => console.error("Error fetching data:", error));
