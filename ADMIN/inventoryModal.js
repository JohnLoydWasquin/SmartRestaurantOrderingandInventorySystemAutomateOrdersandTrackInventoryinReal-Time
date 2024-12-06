function openEditInventoryModal(id, name, category, stock, price) {
    document.getElementById('editItemId').value = id;
    document.getElementById('editItemName').value = name;
    document.getElementById('editCategory').value = category;
    document.getElementById('editStock').value = stock;
    document.getElementById('editPrice').value = price;
    const modal = new bootstrap.Modal(document.getElementById('editInventoryModal'));
    modal.show();
}


function openDeleteInventoryModal(id) {
    console.log(id);
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
            formData.append('id', id);

            fetch('../ADMIN/inventory_function.php?page=inventory', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json()) // Parse JSON response
            .then(result => {
                console.log(id);
                if (result.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'Successfully deleted!',
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

function openAddItemModal() {
    const modal = new bootstrap.Modal(document.getElementById('addItemModal'));
    modal.show();
  }
  