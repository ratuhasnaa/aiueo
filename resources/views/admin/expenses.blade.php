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
    width: 500px;  
    max-width: 80%;  /* Batasan lebar modal, agar tidak terlalu besar */
    height: auto;  /* Tinggi otomatis menyesuaikan isi */
    max-height: 80%;  /* Menjaga agar modal tidak terlalu tinggi */
    overflow-y: auto;  /* Jika konten melebihi tinggi, beri scroll */
    margin-left: 10px;
    margin-top: 40px;
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
    select.form-control {
      width: 65%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
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
      <div class="top-nav"><p>Expenses List</p></div>

      <div class="bot-nav">
        <div class="tab-header">
          <ul class="nav nav-tabs left-tabs">
            <li class="nav-item">
              <a class="nav-link" href="/admin/suppliers">Suppliers</a>
            </li>
          </ul>
          <ul class="nav nav-tabs right-tabs">
            <li class="nav-item">
              <a class="nav-link active" href="#">Expenses</a>
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
              <button class="btn" id="downloadBtn"><i class="fas fa-download"></i> Download</button>
              <button id="addSupplierBtn" onclick="showModal()"><i class="fas fa-plus"></i> Add Expenses</button>
            </div>
          </div>

          <div class="bot-content">
            <table class="supplier-table" id="expensesTable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Supplier Name</th>
                  <th>Description</th>
                  <th>Date</th>
                  <th>Item </th>
                  <th>Amount</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($expenses as $expense)
                  <tr data-id="{{ $expense->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $expense->supplier_name }}</td>
                    <td>{{ $expense->description }}</td>
                    <td>{{ \Carbon\Carbon::parse($expense->date)->format('d M Y') }}</td>
                    <td>{{ $expense->item_total }}</td>
                    <td>Rp {{ number_format($expense->amount, 0, ',', '.') }}</td>
                    <td>
                      <button class="action-btn edit" onclick="editExpense(this)">Edit</button>
                      <button class="action-btn delete" onclick="deleteExpense(this)">Delete</button>
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

  <!-- Modal -->
  <div id="addExpenseModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="expenseModalTitle">Add Expenses</h5>
      </div>
      <form id="addExpenseForm">
        <div class="form-group">
          <label for="supplierName">Supplier Name</label>
          <select id="supplierName" name="supplier_name" required style="width: 65%; padding: 8px; border: 1px solid #787474; border-radius: 3px; font-size: 14px;">
            <option value="">-- Select Supplier --</option>
            @foreach ($suppliers as $supplier)
              <option value="{{ $supplier->name }}">{{ $supplier->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <input type="text" id="description" required>
        </div>
        <div class="form-group">
          <label for="date">Date</label>
          <input type="date" id="date" required>
        </div>
        <div class="form-group">
          <label for="itemTotal">Item Total</label>
          <input type="text" id="itemTotal" required>
        </div>
        <div class="form-group">
          <label for="amount">Amount</label>
          <input type="number" id="amount" name="amount" class="form-control" required> <!-- bisa diketik -->
        </div>
        <input type="hidden" id="editingId">
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="hideModal()">Cancel</button>
          <button type="button" class="btn btn-primary" onclick="saveNewExpense()">Save</button>
        </div>
      </form>
    </div>
  </div>
  <meta name="csrf-token" content="{{ csrf_token() }}"> 
  {{-- close modal --}}

<!-- Modal Pilih Tanggal untuk Download -->
<div id="selectFieldsModal" class="modal" style="display: none; position: fixed; z-index: 9999; top: 0; left: 0; width: 100%; height: 100%; justify-content: center; align-items: center; background-color: rgba(0, 0, 0, 0.4);">
  <div class="modal-content" style="background: white; padding: 20px; border-radius: 8px; min-width: 300px;">
    <div class="modal-header">
      <h5>Select Date to Download</h5>
    </div>
    <form id="selectFieldsForm">
      <div class="form-group">
        <label for="filterDate">Select Date:</label>
        <input type="date" id="filterDate" class="form-control" />
      </div>
      <div class="modal-footer" style="margin-top: 15px; display: flex; justify-content: flex-end; gap: 10px;">
        <button type="button" class="btn btn-secondary" onclick="hideModal()">Cancel</button>
        <button type="button" class="btn btn-primary" style="background-color: #336699; color: white;">Download</button>
      </div>
    </form>
  </div>
</div>

{{-- close modal --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script>
    // Show modal
    function showModal() {
      document.getElementById("addExpenseModal").style.display = "flex";
      document.getElementById("addExpenseForm").reset();
      document.getElementById("editingId").value = '';
      document.getElementById("expenseModalTitle").innerText = 'Add Expenses';
    }

    // Hide modal
    function hideModal() {
      document.getElementById("addExpenseModal").style.display = "none";
      document.getElementById("selectFieldsModal").style.display = "none";
    }

    // Save or update expense
    function saveNewExpense() {
      const id = document.getElementById("editingId").value;
      const supplier_name = document.getElementById("supplierName").value;
      const description = document.getElementById("description").value;
      const date = document.getElementById("date").value;
      const item_total = document.getElementById("itemTotal").value;
      const amount = document.getElementById("amount").value;

      if (!supplier_name || !description || !date || !item_total || !amount) {
        alert("All fields are required.");
        return;
      }

      const payload = { supplier_name, description, date, item_total, amount };
      const url = id ? `/expenses/update/${id}` : "{{ route('admin.expenses.store') }}";
      const method = id ? "PUT" : "POST";

      fetch(url, {
        method: method,
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(payload)
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          window.location.reload();
        } else {
          alert(data.message || "Something went wrong.");
        }
      });
    }

// Edit expense
    function editExpense(button) {
      const row = button.closest("tr");
      const id = row.getAttribute("data-id");
      const cells = row.querySelectorAll("td");

      const supplierName = cells[1].innerText.trim();
      const description = cells[2].innerText.trim();
      const date = convertDateFormat(cells[3].innerText.trim());
      const itemTotal = parseInt(cells[4].innerText.trim());
      const amount = parseFloat(cells[5].innerText.replace(/\D/g, ""));

      const unitPrice = amount / itemTotal;

      document.getElementById("editingId").value = id;
      document.getElementById("supplierName").value = supplierName;
      document.getElementById("description").value = description;
      document.getElementById("date").value = date;
      document.getElementById("itemTotal").value = itemTotal;
      document.getElementById("amount").value = amount;

      // Set readonly biar gak bisa diketik manual pas edit
      document.getElementById("amount").readOnly = true;

      document.getElementById("expenseModalTitle").innerText = 'Edit Expense';
      document.getElementById("addExpenseModal").style.display = "flex";

      // Handle perhitungan ulang saat item total diubah
      const itemTotalInput = document.getElementById("itemTotal");
      const amountInput = document.getElementById("amount");

      itemTotalInput.oninput = () => {
        const newQty = parseInt(itemTotalInput.value) || 0;
        amountInput.value = newQty * unitPrice;
      };
    }

    // Convert displayed date to input value
    function convertDateFormat(dateStr) {
      const [day, monthName, year] = dateStr.split(" ");
      const months = {
        Jan: "01", Feb: "02", Mar: "03", Apr: "04", May: "05", Jun: "06",
        Jul: "07", Aug: "08", Sep: "09", Oct: "10", Nov: "11", Dec: "12"
      };
      return `${year}-${months[monthName]}-${day}`;
    }

    // Delete expense
    function deleteExpense(button) {
      const row = button.closest("tr");
      const id = row.getAttribute("data-id");

      if (confirm("Are you sure you want to delete this expense?")) {
        fetch(`/expenses/delete/${id}`, {
          method: "DELETE",
          headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            row.remove();
          } else {
            alert(data.message || "Delete failed.");
          }
        });
      }
    }

    // Search filter
    document.getElementById("searchBtn").addEventListener("click", function () {
      const searchName = document.getElementById("searchName").value.toLowerCase();
      const searchDate = document.getElementById("searchDate").value;
      const rows = document.querySelectorAll("#expensesTable tbody tr");

      rows.forEach(row => {
        const name = row.children[1].innerText.toLowerCase();
        const date = convertDateFormat(row.children[3].innerText);
        const matchName = name.includes(searchName);
        const matchDate = !searchDate || date === searchDate;

        row.style.display = matchName && matchDate ? "" : "none";
      });
    });

    // Close modal on background click
    window.onclick = function(event) {
      const modal = document.getElementById("addExpenseModal");
      if (event.target == modal) {
        hideModal();
      }
    }

// Menambahkan event listener untuk tombol download
document.addEventListener("DOMContentLoaded", function () {
  const { jsPDF } = window.jspdf;

  document.getElementById("downloadBtn").addEventListener("click", function () {
    document.getElementById("selectFieldsModal").style.display = "flex";
  });

  document.querySelector('#selectFieldsModal .btn-primary').addEventListener("click", function () {
    downloadInvoice();
  });

  function downloadInvoice() {
  const selectedDate = document.getElementById("filterDate").value;

  if (!selectedDate) {
    alert("Please select a date to filter.");
    return;
  }

  fetch(`/expenses?date_filter=${selectedDate}`, {
    headers: {
      'X-Requested-With': 'XMLHttpRequest'
    }
  })
  .then(res => res.json())
  .then(data => {
    const { expenses } = data;

    if (!expenses || expenses.length === 0) {
      alert("No expenses found for the selected date.");
      return;
    }

    const doc = new jsPDF();
    let y = 20;
    let total = 0;

    // Header Title
    doc.setFontSize(16);
    doc.setTextColor(51, 102, 153); // #336699
    doc.text("AIUEO MICE — Expenses Report", 10, y);
    y += 10;

    // Tanggal
    doc.setFontSize(10);
    doc.setTextColor(0, 0, 0);
    doc.text(`Date Filter: ${selectedDate}`, 10, y);
    y += 10;

    // Header Table
    doc.setFillColor(242, 242, 242); // #f2f2f2
    doc.rect(10, y - 6, 190, 8, 'F');
    doc.setTextColor(0, 0, 0);
    doc.setFont(undefined, 'bold');

    const headers = ['Supplier', 'Description', 'Date', 'Qty', 'Amount'];
    let x = 10;
    headers.forEach(header => {
      doc.text(header, x, y);
      x += 38;
    });

    y += 8;
    doc.setFont(undefined, 'normal');

    // Data Table
    expenses.forEach(expense => {
      x = 10;
      doc.text((expense.supplier_name || '').toString(), x, y);
      x += 38;
      doc.text((expense.description || '').toString(), x, y);
      x += 38;
      doc.text((expense.date || '').toString(), x, y);
      x += 38;
      doc.text((expense.item_total || '0').toString(), x, y);
      x += 38;
      const amountText = "Rp " + Number(expense.amount || 0).toLocaleString();
      doc.text(amountText, x, y);

      total += Number(expense.amount || 0);
      y += 8;
    });

    // Total Section
    y += 5;
    doc.setFont(undefined, 'bold');
    doc.setTextColor(51, 102, 153);
    doc.text("TOTAL", 134, y);
    doc.text("Rp " + total.toLocaleString(), 172, y, { align: "right" });

    // Simpan PDF
    const today = new Date().toISOString().split('T')[0];
    doc.save(`Invoice-AIUEO-MICE-${today}.pdf`);

    // Tutup modal
    document.getElementById("selectFieldsModal").style.display = "none";
  })
  .catch(error => {
    console.error("❌ Fetch error:", error);
  });
}
});
</script>
</body>
</html>
