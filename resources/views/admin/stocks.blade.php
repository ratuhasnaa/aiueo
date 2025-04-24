<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title> Suppliers List</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f0f2f5;
      margin: 0;
      padding: 0;
    }

    .container {
      display: flex;
      min-height: 100vh;
    }

    .sidebar {
      width: 180px;
      background-color: #336699;
      color: white;
      padding: 20px;
      flex-shrink: 0;
    }

    .sidebar h2 {
      margin-bottom: 20px;
      margin-left: 30px;
      font-size: 20px;
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
    }

    .sidebar ul li {
      margin-bottom: 15px;
    }

    .sidebar a {
      color: white;
      text-decoration: none;
      display: block;
      padding: 10px;
      border-radius: 5px;
      transition: background 0.3s;
    }

    .sidebar a:hover {
      background-color: rgba(255, 255, 255, 0.2);
    }

    .main-content {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
    }

    .top-nav {
      display: flex;
      justify-content: flex-start;
      align-items: center;
      height: 60px;
      padding-left: 20px;
      
    }

    .top-nav p {
      margin-top: 50px;
      font-size: 22px;
      font-weight: bold;
      margin-left: 13px;
      color: #336699
    }

    .bot-nav {
      background-color: #f0f2f5;
      display: flex;
      flex-direction: column;
      padding: 20px;
      margin-top: 10px;
    }

    .tab-header {
      position: relative;
      display: flex;
      align-items: flex-end;
      gap: 10px;
      margin-left: 10px;
    }

    .left-tabs,
    .right-tabs {
      display: flex;
      list-style: none;
      padding-left: 0;
      margin: 0;
    }

    .nav-tabs .nav-link {
      border: 1.3px solid #336699;
      border-radius: 6px 6px 0 0;
      background-color: #f8f9fa;
      padding: 6px 16px;
      color: #336699;
      font-weight: 500;
      text-decoration: none !important;
    }

    .nav-tabs .nav-link.active {
      background-color: #336699;
      color: white;
      text-decoration: none !important;
    }

    .tab-line {
      height: 1.8px;
      background-color: #336699;
      margin-top: 26px;
      position: absolute;
      left: 418px;
      width: calc(100% - 418px - 30px);
      z-index: 0;
    }

    .section-content {
      display: flex;
      flex-direction: column;
      gap: 20px;
      width: 100%;
      padding: 20px 0;
    }

    .top-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 10px;
    }

    .top-content p {
      margin: 0;
      font-weight: bold;
      font-size: 16px;
    }

    .button-group {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      align-items: center;
    }

    .button-group input[type="date"] {
      padding: 6px 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .button-group button {
      display: flex;
      align-items: center;
      gap: 5px;
      padding: 6px 12px;
      background-color: #336699;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background 0.3s;
      font-size: 14px;
    }

    .button-group button:hover {
      background-color: #2a527a;
    }

    .bot-content {
      padding: 0 10px;
    }

    .form-group {
      display: flex;
      justify-content: space-between;
      margin-bottom: 15px;
    }

    .form-group label {
      width: 120px; 
      margin-right: 10px;
      text-align: left;
    }

    .form-group input {
      width: 100%;
      max-width: 300px;  /
      height: 35px;
      padding: 5px;
    }

    .form-group input[type="date"] {
      width: 100%;
      max-width: 300px;
      height: 35px;
      padding: 5px;
    }

    .supplier-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
      background-color: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .supplier-table th {
      background-color: #336699;
      color: white;
      padding: 12px;
      text-align: left;
      font-weight: bold;
    }

    .supplier-table td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
    }

    .action-btn {
      padding: 6px 12px;
      border: none;
      border-radius: 4px;
      color: white;
      cursor: pointer;
      font-weight: 600;
      font-size: 14px;
    }

    .action-btn.edit {
      background-color: #f0ad4e; 
    }

    .action-btn.delete {
      background-color: #d9534f; 
    }

  
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
    }

    .modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    width: 500px;  /* Setel lebar modal */
    max-width: 80%;  /* Batasan lebar modal, agar tidak terlalu besar */
    height: auto;  /* Tinggi otomatis menyesuaikan isi */
    max-height: 80%;  /* Menjaga agar modal tidak terlalu tinggi */
    overflow-y: auto;  /* Jika konten melebihi tinggi, beri scroll */
    margin-left: 418px;
    margin-top: 120px;
  }

    .modal-header {
      border-bottom: 1px solid #ddd;
      margin-block: 20px;
    }

    .modal-footer {
      display: flex;
      justify-content: flex-end;
      margin-top: 50px;
    }

    .modal-footer button {
      padding: 6px 12px;
      background-color: #336699;
      color: white;
      border: none;
      border-radius: 4px;
    }

    .modal-footer .btn-primary {
      margin-left: auto;
      background-color: #007bff;
      border-color: #007bff;
    }

    .modal-footer .btn-secondary {
      background-color: #d9534f;
      border-color: #d9534f;
    }

    .modal-footer .btn-secondary:hover {
      background-color: #c9302c;
      border-color: #c9302c;
    }

    .modal-footer .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }

    .close {
      color: #aaa;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }

    .status {
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 12px;
            text-align: center;
        }
        .status.available {
            background-color: #e6f7e6;
            color: #33cc33;
        }
        .status.low {
            background-color: #fff3cd;
            color: #ff9900;
        }
        .status.outofstock {
            background-color: #f8d7da;
            color: #ff6666;
        }
  </style>
</head>
<body>
  <div class="container">
    <div class="sidebar">
      <h2>Sidebar</h2>
      <ul>
        <li><a href="{{ route('admin.dashboard') }}">🏠 Dashboard</a></li>
        <li><a href="{{ route('admin.suppliers') }}">💸 Expenses</a></li>
        <li><a href="{{ url('/stocks') }}">📦 Stocks</a></li>
        <li><a href="{{ url('/bookings') }}">📅 Booking</a></li>
      </ul>
    </div>

    <div class="main-content">
      <div class="top-nav">
        <p>Stock Detail</p>
      </div>

      <div class="bot-nav">
        <section class="section-content">
          <div class="top-content">
            {{-- <div class="button-group">
                <select id="bulkAction" style=" width:150px; height: 28px; background-color: #fffff; border-radius: 3px; border: 1px solid #ddd; " >
                    <option value="">Bulk Action</option>
                    <option value="delete">Delete</option>
                    <option value="edit">Edit</option>
                </select>
                <button onclick="applyBulkAction()">Apply</button>
            </div> --}}
            <form method="GET" action="{{ route('stocks.index') }}" class="button-group" style="display: flex; gap: 5px;">
              <input type="text" id="searchName" name="searchName" placeholder="Search by Name" style="width: 250px; padding: 7px; border: 1px solid #ddd; border-radius: 5px;" />
              <button id="searchBtn"><i class="fas fa-search"></i> Search</button>
            </div>            
          </div>

          <div class="bot-content">
            <form id="bulk-delete-form" method="POST" action="{{ route('stocks.bulk-delete') }}">
                @csrf
            <table class="supplier-table" id="stockTable">
                <thead>
                    <tr>
                        {{-- <th><input type="checkbox" id="selectAll" onclick="toggleAll()"></th> --}}
                        <th>No</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price (pcs)</th>
                        <th>Status</th>
                    </tr>
                </thead>
              <tbody>
                @foreach ($stockItems as $index => $item)
                <tr>
                    {{-- <td><input type="checkbox" class="row-checkbox" name="ids[]" value="{{ $item->id }}"></td> --}}
                    
                    {{-- Ganti ID ke nomor urut biasa --}}
                    <td>{{ $index + 1 }}</td>
                    
                    <td>{{ $item->product_name }}</td>
                    
                    <td>
                        <span class="quantity-display" data-id="{{ $item->id }}">{{ $item->quantity }}</span>
                        <input type="number" 
                               class="editable-input quantity-input" 
                               name="items[{{ $item->id }}][quantity]" 
                               value="{{ $item->quantity }}" 
                               style="display:none;" 
                               form="bulk-edit-form" 
                               disabled />
                    </td>
                    
                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    
                    <td>
                        @php
                            $status = 'available';
                            if ($item->quantity <= 5 && $item->quantity > 0) {
                                $status = 'low';
                            } elseif ($item->quantity == 0) {
                                $status = 'outofstock';
                            }
                        @endphp
                        <span class="status {{ $status }}">{{ ucfirst($status == 'outofstock' ? 'Out of Stock' : $status) }}</span>
                    </td>
                </tr>
                @endforeach                 
              </tbody>
            </table>
        </form>

            <form id="bulk-edit-form" method="POST" action="{{ route('stocks.bulk-update') }}">
                @csrf
                <input type="hidden" name="edit_ids" id="editIdsInput">
                <button type="submit" style="display:none;" id="submitEditBtn">Submit Edit</button>
            </form>
        </div>   
        </section>
    </div>
</body>
<script>
    function toggleAll() {
        let selectAll = document.getElementById("selectAll");
        let checkboxes = document.querySelectorAll(".row-checkbox");
        checkboxes.forEach(checkbox => checkbox.checked = selectAll.checked);
    }

    function applyBulkAction() {
        let action = document.getElementById("bulkAction").value;
        let checkboxes = document.querySelectorAll(".row-checkbox:checked");
        let selectedIds = Array.from(checkboxes).map(cb => cb.value);

        if (action === "delete") {
            if (selectedIds.length > 0) {
                if (confirm("Yakin ingin menghapus item yang dipilih?")) {
                    document.getElementById('bulk-delete-form').submit();
                }
            } else {
                alert('Please select items to delete.');
            }
        } else if (action === "edit") {
            if (selectedIds.length > 0) {
                document.getElementById('editIdsInput').value = selectedIds.join(',');
                document.querySelectorAll('input[disabled]').forEach(el => el.disabled = false);
                document.getElementById('submitEditBtn').click();
            } else {
                alert('Please select items to edit.');
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.quantity-display').forEach(function(span) {
            span.addEventListener('click', function() {
                const row = this.closest('tr');
                const quantityDisplay = row.querySelector('.quantity-display');
                const quantityInput = row.querySelector('.quantity-input');
                
                quantityDisplay.style.display = 'none';
                quantityInput.style.display = 'inline-block';
                quantityInput.disabled = false;
                quantityInput.focus();
            });
        });

        document.querySelectorAll('.quantity-input').forEach(function(input) {
            input.addEventListener('input', function () {
                let quantity = parseInt(this.value);
                let row = this.closest('tr');
                let statusElement = row.querySelector('.status');

                if (!isNaN(quantity)) {
                    if (quantity === 0) {
                        statusElement.textContent = 'Out of Stock';
                        statusElement.className = 'status outofstock';
                    } else if (quantity <= 5) {
                        statusElement.textContent = 'Low';
                        statusElement.className = 'status low';
                    } else {
                        statusElement.textContent = 'Available';
                        statusElement.className = 'status available';
                    }
                } else {
                    statusElement.textContent = '-';
                    statusElement.className = 'status';
                }
            });
        });
    });

    function formatRupiah(input) {
        let value = input.value.replace(/[^,\d]/g, '').toString();
        let split = value.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        input.value = 'Rp ' + rupiah;
    }
</script>

</html>