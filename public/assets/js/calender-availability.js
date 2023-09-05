document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('employee-calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: ['dayGrid'],
      // Add other configuration options here
  
      events: {
        url: '/availability', // URL to fetch availability data
        method: 'GET',
        success: function (data) {
          // Process the availability data and add it to the calendar
          var events = data.map(function (availability) {
            return {
              title: 'Available',
              start: availability.date, // Date of availability
              // Add more event properties as needed
            };
          });
  
          calendar.addEventSource(events);
        },
        failure: function () {
          alert('Failed to load availability data');
        },
      },
    });
  
    calendar.render();
  });
  