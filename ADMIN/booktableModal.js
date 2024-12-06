    function openEditModal(userId, firstName, email, role) {
        document.getElementById('editUserId').value = userId;
        document.getElementById('editFirstName').value = firstName;
        document.getElementById('editEmail').value = email;
        document.getElementById('editRole').value = role;

        $('#editUserModal').modal('show');
    }

    function openDeleteModal(userId) {
        document.getElementById('deleteUserId').value = userId;

        $('#deleteUserModal').modal('show');
    }

    function openEditInventoryModal(itemId, itemName, category, stock, price) {
        document.getElementById('editItemId').value = itemId;
        document.getElementById('editItemName').value = itemName;
        document.getElementById('editCategory').value = category;
        document.getElementById('editStock').value = stock;
        document.getElementById('editPrice').value = price;

        $('#editItemModal').modal('show');
    }

    function openDeleteInventoryModal(itemId) {
        document.getElementById('deleteItemId').value = itemId;

        $('#deleteItemModal').modal('show');
    }

    function openAddItemModal() {
        document.getElementById('addItemName').value = '';
        document.getElementById('addCategory').value = '';
        document.getElementById('addStock').value = '';
        document.getElementById('addPrice').value = '';

        $('#addItemModal').modal('show');
    }

    function showAlert(message) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: message
        });
    }

    function showErrorAlert(message) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: message
        });
    }

    function showConfirmationAlert(message, confirmCallback) {
        Swal.fire({
            title: 'Are you sure?',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, proceed!'
        }).then((result) => {
            if (result.isConfirmed) {
                confirmCallback();
            }
        });
    }

