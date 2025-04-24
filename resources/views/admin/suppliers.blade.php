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
      color: #336699;
      margin-left: 13px;
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
        <p>Supplier Management</p>
      </div>

      <div class="bot-nav">
        <div class="tab-header">
          <ul class="nav nav-tabs left-tabs">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#suppliers">Suppliers</a>
            </li>
          </ul>
          <ul class="nav nav-tabs right-tabs">
            <li class="nav-item">
              <a class="nav-link " data-toggle="tab" href="/expenses">Expenses</a>
            </li>
          </ul>
        </div>
        <div class="tab-line"></div>

        <section class="section-content">
          <div class="top-content">
            <p></p>
            <div class="button-group">
              <input type="text" id="searchName" placeholder="Search by Name" style="width: 250px; padding: 7px; border: 1px solid #ddd; border-radius: 5px;" />
              <input type="date" id="searchDate" />
              <button id="searchBtn"><i class="fas fa-search"></i> Search</button>
              <button id="addSupplierBtn"><i class="fas fa-plus"></i> Add Supplier</button>
            </div>            
          </div>

          <div class="bot-content">
            <table class="supplier-table" id="supplierTable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Supplier Name</th>
                  <th>Phone Number</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody id="supplierTableBody">
                @foreach($suppliers as $supplier)
                  <tr data-id="{{ $supplier->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->phone }}</td>
                    <td>{{ $supplier->date }}</td>
                    <td>
                      <button class="action-btn edit" onclick="editSupplier({{ $supplier->id }})">
                        <i class="fas fa-edit"></i> Edit
                      </button>
                      <button class="action-btn delete"><i class="fas fa-trash"></i> Delete</button>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </section>
      </div>
    </div>
  </div>

  <!-- Modal for Adding/Editing Supplier -->
  <div id="addSupplierModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        {{-- <span class="close">&times;</span> --}}
        <h5 class="modal-title" id="modalTitle">Add Supplier</h5>
      </div>
      <form id="addSupplierForm">
        <div class="modal-body">
          <div class="form-group">
            <label for="supplierName">Supplier Name</label>
            <input type="text" id="supplierName" name="name" class="form-control" required />
          </div>
          <div class="form-group">
            <label for="supplierPhone">Phone Number</label>
            <input type="text" id="supplierPhone" name="phone" class="form-control" required />
          </div>
          <div class="form-group">
            <label for="supplierDate">Date</label>
            <input type="date" id="supplierDate" name="date" class="form-control" required />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="closeModalBtn">Close</button>
          <button type="submit" class="btn btn-primary" id="saveSupplierBtn">Save Supplier</button>
        </div>
      </form>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- CRUD --}}
<script> 
let editingSupplierId = null;

// Fungsi untuk edit supplier
function editSupplier(id) {
  editingSupplierId = id;

  // Ambil data supplier berdasarkan ID
  $.ajax({
    url: `/admin/suppliers/${id}/edit`,  // URL untuk mengambil data supplier
    method: 'GET',
    success: function(response) {
      if (response.status === 'success') {
        const supplier = response.data;
        
        // Isi modal dengan data supplier
        $('#supplierName').val(supplier.name);
        $('#supplierPhone').val(supplier.phone);
        $('#supplierDate').val(supplier.date);

        // Ganti judul modal menjadi "Edit Supplier"
        $('#modalTitle').text('Edit Supplier');
        
        // Tampilkan modal
        $('#addSupplierModal').show();
      }
    },
    error: function() {
      alert('Error fetching supplier data.');
    }
  });
}

// Fungsi untuk menambah supplier (Add Supplier)
$('#addSupplierBtn').click(function() {
  // Reset form dan modal untuk menambah supplier baru
  $('#supplierName').val('');
  $('#supplierPhone').val('');
  $('#supplierDate').val('');
  
  // Ganti judul modal menjadi "Add Supplier"
  $('#modalTitle').text('Add Supplier');
  
  // Menampilkan modal untuk menambah supplier
  editingSupplierId = null; // Reset id karena ini untuk add
  $('#addSupplierModal').show();
});

// Fungsi untuk menghapus supplier
$('.action-btn.delete').click(function () {
  const id = $(this).closest('tr').data('id');
  
  // Konfirmasi penghapusan
  if (confirm('Are you sure you want to delete this supplier?')) {
    $.ajax({
      url: `/admin/suppliers/${id}`,
      method: 'DELETE',
      data: {
        _token: '{{ csrf_token() }}'
      },
      success: function(response) {
        if (response.status === 'success') {
          // Hapus baris tabel setelah berhasil dihapus
          $(`tr[data-id="${id}"]`).remove();
        }
      },
      error: function() {
        alert('Error deleting supplier.');
      }
    });
  }
});

// Handle form submission via AJAX (Add/Edit Supplier)
$('#addSupplierForm').on('submit', function(e) {
  e.preventDefault();

  const supplierName = $('#supplierName').val();
  const supplierPhone = $('#supplierPhone').val();
  const supplierDate = $('#supplierDate').val();

  let url = '{{ route('admin.suppliers.store') }}';
  let method = 'POST';
  let data = {
    _token: '{{ csrf_token() }}',
    name: supplierName,
    phone: supplierPhone,
    date: supplierDate
  };

  // Jika sedang mengedit, ubah URL dan metode menjadi PUT
  if (editingSupplierId) {
    url = `/admin/suppliers/${editingSupplierId}`;
    method = 'PUT';
    data._method = 'PUT';  // Kirim metode PUT sebagai hidden field
  }

  // Kirim data ke server menggunakan AJAX
  $.ajax({
    url: url,
    method: method,
    data: data,
    success: function (response) {
      if (response.status === 'success') {
        // Update tabel jika operasi berhasil
        if (editingSupplierId) {
          // Update baris dengan data baru
          $(`#supplierTableBody tr[data-id="${editingSupplierId}"] td:nth-child(2)`).text(response.data.name);
          $(`#supplierTableBody tr[data-id="${editingSupplierId}"] td:nth-child(3)`).text(response.data.phone);
          $(`#supplierTableBody tr[data-id="${editingSupplierId}"] td:nth-child(4)`).text(response.data.date);
        } else {
          // Tambahkan baris baru ke tabel
          const newRow = `
            <tr data-id="${response.data.no}">
              <td>${response.data.no}</td>
              <td>${response.data.name}</td>
              <td>${response.data.phone}</td>
              <td>${response.data.date}</td>
              <td>
                <button class="action-btn edit" onclick="editSupplier(${response.data.no})"><i class="fas fa-edit"></i> Edit</button>
                <button class="action-btn delete"><i class="fas fa-trash"></i> Delete</button>
              </td>
            </tr>
          `;
          $('#supplierTableBody').append(newRow);
        }

        // Tutup modal dan bersihkan form
        $('#addSupplierModal').hide();
        $('#supplierName').val('');
        $('#supplierPhone').val('');
        $('#supplierDate').val('');
      }
    },
    error: function () {
      alert('Error saving supplier.');
    }
  });
});

// Close modal jika user mengklik luar modal
$(window).click(function (event) {
  if (event.target === $('#addSupplierModal')[0]) {
    $('#addSupplierModal').hide();
  }
});

// Menutup modal secara manual
$('#closeModalBtn').click(function() {
  $('#addSupplierModal').hide();
});

</script>
{{-- END CRUD --}}

{{-- search --}}
<script>
// Fungsi untuk pencarian berdasarkan nama dan tanggal
$('#searchBtn').click(function() {
  const searchName = $('#searchName').val().toLowerCase();
  const searchDate = $('#searchDate').val();
  
  // Iterasi melalui setiap baris di tabel supplier
  $('#supplierTableBody tr').each(function() {
    const row = $(this);
    
    // Ambil data dari kolom nama dan tanggal
    const supplierName = row.find('td:nth-child(2)').text().toLowerCase(); // Kolom nama
    const supplierDate = row.find('td:nth-child(4)').text(); // Kolom tanggal

    // Cek apakah nama dan tanggal cocok dengan pencarian
    const matchesName = supplierName.includes(searchName);
    const matchesDate = supplierDate.includes(searchDate);

    // Jika nama dan tanggal cocok, tampilkan baris, jika tidak, sembunyikan
    if (matchesName && matchesDate) {
      row.show();
    } else {
      row.hide();
    }
  });
});

</script>

{{-- end search --}}

</html>