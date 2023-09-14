function getPostalCodeFromLocation(postcode, id) {
    // Code to get the user's location
    if ('geolocation' in navigator) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                // Success callback
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                // Create a LatLng object from the coordinates
                const latLng = new google.maps.LatLng(latitude, longitude);

                // Initialize a Geocoder object
                const geocoder = new google.maps.Geocoder();

                // Perform reverse geocoding to get postal code
                geocoder.geocode({ 'latLng': latLng }, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            const postalCode = getPostalCodeFromResults(results[0]);
                            // $('#clock_in-' + id).modal('show');
                            if (postalCode === postcode) {
                                // Postal code matches, display the modal
                                $('#clock_in-' + id).modal('show');
                            } else {
                                // Postal code does not match
                                // Handle other actions or conditions here
                                $('#clock_in_error-' + id).modal('show');
                                // alert('You need to be at the location to start your shift.');
                            }
                        } else {
                            alert('Error occured while fetching your location');
                        }
                    } else {
                        console.log('Geocoder failed due to: ' + status);
                    }
                });
            },
            function (error) {
                // Error callback
                // Handle errors here
            }
        );
    }
};

// Helper function to extract postal code from geocoder results
function getPostalCodeFromResults(result) {
    for (let component of result.address_components) {
        for (let type of component.types) {
            if (type === 'postal_code') {
                return component.long_name;
            }
        }
    }
    return null;
}
