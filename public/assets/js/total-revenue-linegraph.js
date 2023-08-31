const ctx = document.getElementById("salesLineChart").getContext("2d");

    // Data for the line graph
    const months = [
      "January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December"
    ];

    const salesData = [1200, 1500, 1800, 1300, 2000, 2200, 2500, 2800, 2300, 2700, 3000, 3200];

    // Create the line graph
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: months,
        datasets: [{
          label: 'Sales Revenue',
          data: salesData,
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