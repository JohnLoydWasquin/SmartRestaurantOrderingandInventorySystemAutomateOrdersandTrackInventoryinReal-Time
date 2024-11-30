function openEditInventoryModal(id, name, category, stock, price) {
    document.getElementById('editItemId').value = id;
    document.getElementById('editItemName').value = name;
    document.getElementById('editCategory').value = category;
    document.getElementById('editStock').value = stock;
    document.getElementById('editPrice').value = price;

    new bootstrap.Modal(document.getElementById('editInventoryModal')).show();
}

function deleteInventoryItem(itemId) {
    if (confirm('Are you sure you want to delete this item?')) {
        fetch('../ADMIN/inventory_function.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `action=delete&item_id=${itemId}`
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            location.reload(); // Reload the page to reflect changes
        })
        .catch(error => console.error('Error:', error));
    }
}
