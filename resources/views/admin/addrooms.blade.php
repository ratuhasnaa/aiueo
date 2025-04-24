{{-- resources/views/rooms/index.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Rooms</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 20px;
            background: #f9f9f9;
            color: #333;
        }
        h1 { color: #336699; margin-bottom: 10px; }
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .search-box {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            width: 220px;
        }
        .btn {
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
        }
        .btn-add {
            background: #336699;
            color: white;
        }
        .btn-add:hover { background: #25527a; }
        .btn-edit {
            background: #ffc107;
            color: #333;
        }
        .btn-edit:hover { background: #e0a800; }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }
        th, td {
            padding: 12px 14px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th { background: #336699; color: white; }
        tr:hover td { background: #f1f7ff; }
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 99;
            left: 0; top: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.4);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background: white;
            padding: 20px;
            width: 500px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }
        .modal-content h2 { margin-top: 0; color: #336699; }
        .modal-content input,
        .modal-content select {
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        .modal-footer {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
        .btn-cancel { background: #ccc; color: #333; }
        .btn-cancel:hover { background: #b3b3b3; }
        .btn-save { background: #336699; color: white; }
        .btn-save:hover { background: #25527a; }
    </style>
</head>
<body>

    <div class="top-bar">
        <h1>All Rooms</h1>
        <div>
            <input type="text" class="search-box" id="searchBox" placeholder="Search rooms..." onkeyup="searchRooms()">
            <button class="btn btn-add" onclick="openAddModal()">+ Add Room</button>
        </div>
    </div>

    <table id="roomsTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Rent</th>
                <th>Short Code</th>
                <th>No. of Rooms</th>
                <th>Type</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            {{-- Looping data dari Database --}}
            @foreach ($rooms as $room)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $room->name }}</td>
                <td>{{ 'Rp ' . number_format($room->rent, 0, ',', '.') }}</td>
                <td>{{ $room->short_code }}</td>
                <td>{{ $room->number_of_rooms }}</td>
                <td>{{ $room->room_type }}</td>
                <td>{{ $room->status }}</td>
                <td>
                    <!-- Tombol Edit untuk ubah status doang -->
                    <button class="btn btn-edit" onclick="openEditModal('{{ $room->id }}','{{ $room->status }}')">Edit</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Add Room Modal --}}
    <div id="addRoomModal" class="modal">
        <div class="modal-content">
            <h2>Add New Room</h2>
            <form method="POST" action="{{ route('rooms.store') }}" onsubmit="return cleanRupiahBeforeSubmit();">
                @csrf
                <label>Room Name</label>
                <input type="text" name="name" required>
                
                <label>Rent (Basic)</label>
                <input type="text" name="rent" id="roomRent" required oninput="formatRupiah(this)">
                
                <label>Short Code</label>
                <input type="text" name="short_code" required>
                
                <label>No. of Rooms</label>
                <input type="number" name="number_of_rooms" required>
                
                <label>Room Type</label>
                <select name="room_type" required>
                    <option value="Ballroom">Ballroom</option>
                    <option value="Meeting">Meeting</option>
                    <option value="Exhibition">Exhibition</option>
                    <option value="Incentives">Incentives</option>
                    <option value="Conventions">Conventions</option>
                </select>
                
                <label>Status</label>
                <select name="status" required>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" onclick="closeAddModal()">Cancel</button>
                    <button type="submit" class="btn btn-save">Save</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Status Modal --}}
    <div id="editStatusModal" class="modal">
        <div class="modal-content">
            <h2>Edit Room Status</h2>
            <form method="POST" id="editStatusForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="editRoomId">
                <label>Status</label>
                <select name="status" id="editStatusSelect" required>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" onclick="closeEditModal()">Cancel</button>
                    <button type="submit" class="btn btn-save">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Modal Add Room
        function openAddModal() {
            document.getElementById('addRoomModal').style.display = 'flex';
        }
        function closeAddModal() {
            document.getElementById('addRoomModal').style.display = 'none';
        }
        // Modal Edit Status
        function openEditModal(id, status) {
            document.getElementById('editRoomId').value = id;
            document.getElementById('editStatusSelect').value = status;
            // Set action URL ke route update status, pastikan route nya sudah didefinisikan.
            document.getElementById('editStatusForm').action = `/rooms/${id}/update-status`;
            document.getElementById('editStatusModal').style.display = 'flex';
        }
        function closeEditModal() {
            document.getElementById('editStatusModal').style.display = 'none';
        }
        // Search filter function
        function searchRooms() {
            var input = document.getElementById('searchBox').value.toUpperCase();
            var rows = document.querySelectorAll("#roomsTable tbody tr");
            rows.forEach(function(row) {
                var name = row.cells[1].innerText.toUpperCase();
                row.style.display = name.includes(input) ? "" : "none";
            });
        }
        // Format Rupiah saat input
        function formatRupiah(el) {
            let angka = el.value.replace(/[^,\d]/g, '').toString();
            let split = angka.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            el.value = 'Rp ' + rupiah;
        }
        // Bersihkan format Rupiah sebelum submit (ubah jadi angka saja)
        function cleanRupiahBeforeSubmit() {
            var rentInput = document.getElementById('roomRent');
            rentInput.value = rentInput.value.replace(/[^0-9]/g, '');
            return true;
        }
    </script>

</body>
</html>
