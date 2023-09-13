const getLocationButton = document.getElementById('getLocationButton');

getLocationButton.addEventListener('click', function () {
    // Code to get the user's location
    if ('geolocation' in navigator) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                // Success callback
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                console.log(`Latitude: ${latitude}, Longitude: ${longitude}`);
            },
            function (error) {
                // Error callback
                // Handle errors here
            }
        );
    }
});
