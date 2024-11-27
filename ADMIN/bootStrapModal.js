function openEditModal(userId, firstName, email, role) {
    document.getElementById('editUserId').value = userId;
    document.getElementById('editFirstName').value = firstName;
    document.getElementById('editEmail').value = email;
    document.getElementById('editRole').value = role;
    new bootstrap.Modal(document.getElementById('editUserModal')).show();
}

function deleteUser(userId) {
    if (confirm('Are you sure you want to delete this user?')) {
        fetch('../ADMIN/update_delete.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: JSON.stringify({ action: 'delete', user_id: userId }),
        }).then(response => {
            if (response.ok) {
                location.reload();
            } else {
                alert('Error deleting user.');
            }
        });
    }
}
