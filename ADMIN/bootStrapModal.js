function openEditModal(userId, firstName, email, role) {
    document.getElementById('editUserId').value = userId;
    document.getElementById('editFirstName').value = firstName;
    document.getElementById('editEmail').value = email;
    document.getElementById('editRole').value = role;
    new bootstrap.Modal(document.getElementById('editUserModal')).show();
}

function openDeleteModal(userId) {
    console.log(userId);
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to undo this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData();
            formData.append('action', 'delete');
            formData.append('user_id', userId);

            fetch('../ADMIN/update_delete.php?page=users', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json()) // Parse JSON response
            .then(result => {
                console.log(userId);
                if (result.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: result.message,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload(); // Reload the page after deletion
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: result.message,
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'Successfully deleted!',
                });
            });
        }
    });
}

