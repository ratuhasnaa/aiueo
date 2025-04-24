<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Booking Report</title>
  <style>
    body {
      background-color: #f5f7fa;
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      color: #333;
    }

    .header {
      background-color: #336699;
      color: #fff;
      text-align: center;
      padding: 20px 0;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    }

    .header h1 {
      margin: 0;
      font-size: 28px;
    }

    .header p {
      margin: 5px 0 0;
      font-size: 16px;
    }

    .table-container {
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      padding: 20px;
      max-width: 1100px;
      margin: 30px auto;
    }

    .section-title {
      text-align: center;
      margin-bottom: 20px;
    }

    .section-title h2 {
      color: #336699;
      font-size: 22px;
      margin: 0;
    }

    .section-title p {
      color: #6c757d;
      font-size: 14px;
    }

    .table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    .table thead th {
      background-color: #336699;
      color: #ffffff;
      text-align: center;
      padding: 10px;
    }

    .table tbody td {
      text-align: center;
      vertical-align: middle;
      padding: 10px;
      border-bottom: 1px solid #e9ecef;
    }

    .table-striped tbody tr:nth-of-type(odd) {
      background-color: #f9fbfd;
    }

    .table-striped tbody tr:hover {
      background-color: #eef4fa;
    }

    .btn {
      padding: 5px 10px;
      font-size: 14px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: 0.3s ease;
    }

    .btn-danger {
      background-color: #d9534f;
      color: white;
    }

    .btn-danger:hover {
      background-color: #b52a25;
    }

    .btn-info {
      background-color: #5bc0de;
      color: white;
    }

    .btn-info:hover {
      background-color: #31b0d5;
    }

    .btn-sm {
      font-size: 12px;
    }

    .status-paid {
      background-color: #d4edda;
      color: #155724;
      font-weight: bold;
      border-radius: 5px;
      padding: 4px 8px;
      display: inline-block;
    }

    .status-pending {
      background-color: #f8d7da;
      color: #721c24;
      font-weight: bold;
      border-radius: 5px;
      padding: 4px 8px;
      display: inline-block;
    }
  </style>
</head>
<body>
  <div class="header">
    <h1>Swiss-Belinn Booking Admin</h1>
    <p>Manage and monitor all ballroom booking records</p>
  </div>      

  <div class="container table-container">
    <div class="section-title">
      <h2>Booking Report</h2>
      <p>Manage all booking records in one place.</p>
    </div>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Room ID</th>
          <th>Room Type</th>
          <th>Date</th>
          <th>Time Range</th>
          <th>Total Amount</th>
          <th>Status</th>
          <th>Payment Method</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="tableBody">
        <tr>
          <td>1</td>
          <td>101101</td>
          <td>Meeting</td>
          <td>01 Jan 2022</td>
          <td>09:00 - 12:00</td>
          <td>Rp 3,500,000</td>
          <td><span class="status-paid">Paid</span></td>
          <td>Bank Mandiri</td>
          <td>
            <button class="btn btn-sm btn-danger" onclick="deleteRow(this)">Delete</button>
            <button class="btn btn-sm btn-info" onclick="viewDetails(this)">View</button>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td>102102</td>
          <td>Incentives</td>
          <td>02 Jan 2022</td>
          <td>13:00 - 17:00</td>
          <td>Rp 4,200,000</td>
          <td><span class="status-pending">Pending</span></td>
          <td>GoPay</td>
          <td>
            <button class="btn btn-sm btn-danger" onclick="deleteRow(this)">Delete</button>
            <button class="btn btn-sm btn-info" onclick="viewDetails(this)">View</button>
          </td>
        </tr>
        <tr>
          <td>3</td>
          <td>103103</td>
          <td>Convention</td>
          <td>03 Jan 2022</td>
          <td>10:00 - 15:00</td>
          <td>Rp 2,000,000</td>
          <td><span class="status-paid">Paid</span></td>
          <td>BCA</td>
          <td>
            <button class="btn btn-sm btn-danger" onclick="deleteRow(this)">Delete</button>
            <button class="btn btn-sm btn-info" onclick="viewDetails(this)">View</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <script>
    function deleteRow(button) {
      if (confirm('Are you sure you want to delete this record?')) {
        const row = button.parentElement.parentElement;
        row.remove();
        updateRowNumbers();
      }
    }

    function updateRowNumbers() {
      const rows = document.querySelectorAll('#tableBody tr');
      rows.forEach((row, index) => {
        row.querySelector('td:first-child').textContent = index + 1;
      });
    }

    function viewDetails(button) {
      const row = button.parentElement.parentElement;
      const statusText = row.querySelector('td:nth-child(7)').textContent.trim();
      if (statusText === 'Paid') {
        alert('Bukti pembayaran:\n\n[Contoh bukti pembayaran di sini]');
      } else if (statusText === 'Pending') {
        alert('Informasi pembayaran belum dilakukan.');
      }
    }
  </script>
</body>
</html>
