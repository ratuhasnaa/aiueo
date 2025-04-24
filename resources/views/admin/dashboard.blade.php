<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>
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
      height: 60px;

      display: flex;
      justify-content: flex-end;
      align-items: center;
      flex-shrink: 0;
      padding: 20px;

    }

    .top-nav .profile {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-right: 15px;
    }

    .profile img {
      width: 35px;
      height: 45px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 20px;
    }


    .bot-nav {
    height: 450px;
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    align-items: flex-start;
    padding: 20px;
    flex-shrink: 0;
    overflow-y: auto;
    overflow-x: hidden;
    margin-top: 30px;
    margin-bottom: 20px;
    }


    .card {
      flex: 1;
      min-width: 250px;
      height: 300px;
      background-color: white;
      border-radius: 10px;
      padding: 10px 15px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      transition: transform 0.2s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 24px rgba(0, 0, 0, 0.15);
    }

    .card:nth-child(1) { background-color: #e8f0fe; }
    .card:nth-child(2) { background-color: #e6ffe6; }
    .card:nth-child(3) { background-color: #fff4e6; }
    .card:nth-child(4) { background-color: #fef7e0; }
    .card:nth-child(5) { background-color: #f3f8ff; }

    .card h3 {
      margin-top: 0;
      font-size: 18px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .card p,
    .card ul li {
      font-size: 14px;
      color: #333;
    }

    ul {
      padding-left: 20px;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }

      .sidebar {
        width: 100%;
      }

      .bot-nav {
        flex-direction: column;
        height: auto;
      }
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
        <div class="profile">
            {{-- <img src="https://via.placeholder.com/35" alt="Profile Picture" /> --}}
            {{-- <span>Mitra Swiss Bell-Inn</span> --}}
        </div>
      </div>

      <div class="bot-nav">

        <div class="card">
          <h3>💸 Total Expenses</h3>
          <p style="font-size: 24px; font-weight: bold;">Rp {{ number_format($totalExpenses, 0, ',', '.') }}</p>
          <p>Accumulate all data from the expenses table.</p>
        </div>
        
        <div class="card">
          <h3>📊 Spending Chart per Month</h3>
          <canvas id="expensesChart" style="width: 100%; height: 240px;"></canvas>
        </div>
        
        @if($highestExpense)
        <div class="card" style="background-color: #fff6e5;">
          <h3>📌 Insights & Notices</h3>
          <ul>
            <strong>Rp {{ number_format($highestExpense->amount, 0, ',', '.') }}</strong>
            – {{ $highestExpense->description }} ({{ $highestExpense->supplier_name }})
          </li>
          <li>🏷️ Most used supplier: 
            <strong>{{ $mostUsedSupplier->supplier_name }}</strong> – {{ $mostUsedSupplier->total }} transactions</li>
          <li>💼 Total active suppliers: <strong>{{ $supplierCount }}</strong></li>
        </ul>
      </div>
      @endif
        
        @if($topSpending)
        <div class="card">
          <h3>💰 Top Spending This Month</h3>
          <p><strong>{{ $topSpending->description }} – Rp {{ number_format($topSpending->amount, 0, ',', '.') }}</strong></p>
          <p>From: {{ $topSpending->supplier_name }}</p>
        </div>
        @endif
        
        <div class="card">
          <h3>📈 Expense Trend</h3>
          <p>This month: Rp 114.250.000</p>
          <p style="color: green;">⬆️ +12% compared to last month</p>
        </div>
        
        <div class="card" style="background-color: #eef6ff;">
          <h3>📊 Financial Summary Note</h3>
          <p>✔️ All suppliers accounted for April</p>
          <p>📈 Your monthly expense exceeded Q1 average</p>
          <p>📁 Don't forget to export April invoice reports</p>
        </div>                    
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx = document.getElementById('expensesChart').getContext('2d');

    const expenseChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: {!! json_encode(array_map(fn($m) => \Carbon\Carbon::create()->month($m)->format('F'), array_keys($monthlyExpenses))) !!},
        datasets: [{
          label: 'Expenses per Month',
          data: {!! json_encode(array_values($monthlyExpenses)) !!},
          backgroundColor: '#FF6B6B',
          borderRadius: 6,
          barThickness: 40
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              callback: function(value) {
                return 'Rp ' + value.toLocaleString('id-ID');
              }
            }
          }
        },
        plugins: {
          legend: {
            labels: {
              font: { size: 12 }
            }
          }
        }
      }
    });

    document.querySelectorAll('.dropdown-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        btn.classList.toggle('active');
      });
    });
  </script>

</body>
</html>
