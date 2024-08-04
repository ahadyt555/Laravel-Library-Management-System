<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <title>Admin Panel</title>
</head>
<body>
    @yield('content')
    @stack('script')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
    document.getElementById('addBookForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const bookName = document.getElementById('bookName').value;
        const author = document.getElementById('author').value;
        const availability = document.getElementById('availability').value;

        const table = document.getElementById('booksTable').getElementsByTagName('tbody')[0];
        const newRow = table.insertRow();

        const bookNameCell = newRow.insertCell(0);
        const authorCell = newRow.insertCell(1);
        const availabilityCell = newRow.insertCell(2);
        const actionsCell = newRow.insertCell(3);

        bookNameCell.textContent = bookName;
        authorCell.textContent = author;
        availabilityCell.textContent = availability;

        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete';
        deleteButton.className = 'btn btn-danger btn-sm';
        deleteButton.addEventListener('click', function() {
            table.deleteRow(newRow.rowIndex - 1);
        });

        const toggleAvailabilityButton = document.createElement('button');
        toggleAvailabilityButton.textContent = availability === 'Available' ? 'Mark as Not Available' : 'Mark as Available';
        toggleAvailabilityButton.className = 'btn btn-secondary btn-sm ms-2';
        toggleAvailabilityButton.addEventListener('click', function() {
            availabilityCell.textContent = availabilityCell.textContent === 'Available' ? 'Not Available' : 'Available';
            toggleAvailabilityButton.textContent = availabilityCell.textContent === 'Available' ? 'Mark as Not Available' : 'Mark as Available';
        });

        actionsCell.appendChild(deleteButton);
        actionsCell.appendChild(toggleAvailabilityButton);

        document.getElementById('addBookForm').reset();
        const addBookModal = document.getElementById('addBookModal');
        const modal = bootstrap.Modal.getInstance(addBookModal);
        modal.hide();
    });
</script>
</body>
</html>