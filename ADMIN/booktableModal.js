     // Function to open the Edit Modal for Users
    function openEditModal(userId, firstName, email, role) {
        // Populate modal fields with user data
        document.getElementById('editUserId').value = userId;
        document.getElementById('editFirstName').value = firstName;
        document.getElementById('editEmail').value = email;
        document.getElementById('editRole').value = role;

        // Show the modal (make sure jQuery and Bootstrap JS are included)
        $('#editUserModal').modal('show');
    }

    // Function to open the Delete Modal for Users
    function openDeleteModal(userId) {
        // Set the user ID in the modal
        document.getElementById('deleteUserId').value = userId;

        // Show the modal
        $('#deleteUserModal').modal('show');
    }

    // Function to open the Edit Modal for Inventory Items
    function openEditInventoryModal(itemId, itemName, category, stock, price) {
        // Populate modal fields with inventory item data
        document.getElementById('editItemId').value = itemId;
        document.getElementById('editItemName').value = itemName;
        document.getElementById('editCategory').value = category;
        document.getElementById('editStock').value = stock;
        document.getElementById('editPrice').value = price;

        // Show the modal
        $('#editItemModal').modal('show');
    }

    // Function to open the Delete Modal for Inventory Items
    function openDeleteInventoryModal(itemId) {
        // Set the item ID in the modal
        document.getElementById('deleteItemId').value = itemId;

        // Show the modal
        $('#deleteItemModal').modal('show');
    }

    // Function to open the Add Item Modal
    function openAddItemModal() {
        // Clear the fields in the modal
        document.getElementById('addItemName').value = '';
        document.getElementById('addCategory').value = '';
        document.getElementById('addStock').value = '';
        document.getElementById('addPrice').value = '';

        // Show the modal
        $('#addItemModal').modal('show');
    }

    // Function to display a success alert
    function showAlert(message) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: message
        });
    }

    // Function to display an error alert
    function showErrorAlert(message) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: message
        });
    }

    // Example for showing a confirmation alert before performing an action
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

