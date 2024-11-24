function deleteUser(userId) {
    if (confirm("Are you sure you want to delete this user?")) {
        fetch('../ADMIN/delete_user.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ userId: userId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload(); // Refresh the page after successful deletion
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while trying to delete the user.');
        });
    }
}
