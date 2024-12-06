document.addEventListener("DOMContentLoaded", function () {
    const tableContainer = document.getElementById("tableContainer");
    const selectedTableInput = document.getElementById("selectedTable");
    
    const tableNumbers = [
        [1, 2, 3], [4, 5, 6]
    ];

    tableNumbers.forEach((row, index) => {
        const rowDiv = document.createElement("div");
        rowDiv.classList.add("table-row");
        row.forEach(table => {
            const tableButton = document.createElement("button");
            tableButton.classList.add("table-button");
            tableButton.innerText = table;
            tableButton.onclick = function () {
               
                document.querySelectorAll('.table-button').forEach(btn => btn.classList.remove('selected'));
                tableButton.classList.add('selected');
                selectedTableInput.value = table;
            };
            rowDiv.appendChild(tableButton);
        });
        tableContainer.appendChild(rowDiv);
    });
});

