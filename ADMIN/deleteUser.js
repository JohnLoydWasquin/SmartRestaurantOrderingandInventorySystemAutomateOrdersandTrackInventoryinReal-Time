// Delete User Function
function deleteUser(userId) {
    if (confirm("Are you sure you want to delete this user?")) {
        fetch('delete_user.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ user_id: userId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                location.reload(); // Reload to update the table
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

// Edit User Function
function editUser(userId, currentName, currentEmail, currentRole) {
    const newName = prompt("Edit Name:", currentName);
    const newEmail = prompt("Edit Email:", currentEmail);
    const newRole = prompt("Edit Role (Admin/User):", currentRole);

    if (newName && newEmail && newRole) {
        fetch('update_user.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                user_id: userId,
                name: newName,
                email: newEmail,
                role: newRole
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                location.reload(); // Reload to update the table
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }
}
