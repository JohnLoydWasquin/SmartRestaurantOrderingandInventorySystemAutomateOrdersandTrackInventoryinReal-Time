function openEditModal(userId, firstName, email, role) {
    document.getElementById('editUserId').value = userId;
    document.getElementById('editFirstName').value = firstName;
    document.getElementById('editEmail').value = email;
    document.getElementById('editRole').value = role;
    new bootstrap.Modal(document.getElementById('editUserModal')).show();
}

function deleteUser(userId) {
    if (confirm('Are you sure you want to delete this user?')) {
        const formData = new FormData();
        formData.append('action', 'delete');
        formData.append('user_id', userId);

        fetch('../ADMIN/update_delete.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(result => {
            alert(result);
            location.reload(); // Reload the page after successful deletion
        })
        .catch(error => console.error('Error:', error));
    }
}

