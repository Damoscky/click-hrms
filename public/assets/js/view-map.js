
// Function to fetch data from the API
function fetchData(id) {

    // Construct the API URL with the ID
    var apiUrl = 'http://127.0.0.1:8000/api/client/location/' + id;

    // Make the API request
    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            // Handle the API response here (e.g., display it)
            var apiResponseElement = document.getElementById('apiResponse');
            apiResponseElement.textContent = JSON.stringify(data, null, 2);
            var latitude = data.latitude;
            var longitude = data.longitude;
            initMap(latitude, longitude);

            // You can also call other functions or update the map here if needed
            // For example: initMap(data.latitude, data.longitude);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}

 
function initMap(latitude, longitude) {
    // Create a map center using the dynamic coordinates
    var mapCenter = { lat: latitude, lng: longitude };

    // Create a new map object and associate it with the map container
    var map = new google.maps.Map(document.getElementById('map'), {
        center: mapCenter,
        zoom: 10 // Adjust the zoom level as needed
    });

    // You can add markers, polygons, and other elements to the map as well.
}