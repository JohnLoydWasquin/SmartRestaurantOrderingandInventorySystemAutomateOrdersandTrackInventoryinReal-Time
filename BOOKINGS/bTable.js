function validateForm() {
    var firstName = document.getElementById("first_name").value;
    var lastName = document.getElementById("last_name").value;
    var email = document.getElementById("email").value;
    var phone = document.getElementById("phone").value;
    var bookingDate = document.getElementById("booking_date").value;
    var bookingTime = document.getElementById("booking_time").value;
    var selectedTable = document.querySelector('input[name="selectedTable"]:checked');

    // Check if all required fields are filled
    if (!firstName || !lastName || !email || !phone || !bookingDate || !bookingTime || !selectedTable) {
        // Use SweetAlert instead of alert
        Swal.fire({
            title: 'Missing Information!',
            text: 'Please fill in all fields and select a table.',
            icon: 'error',
            confirmButtonText: 'OK',
            customClass: {
                confirmButton: 'go-back-button' // Add custom class to the button
            }
        }).then((result) => {
            if (result.isConfirmed) {
                history.back(); // Go back to the previous page without refreshing
            }
        });

        return false; // Prevent form submission
    }

    return true; // Allow form submission if everything is valid
}
