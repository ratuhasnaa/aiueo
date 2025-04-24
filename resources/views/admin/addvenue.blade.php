<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Venue (MICE)</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f4f4f9;
      color: #333;
    }
    .top-nav {
      background-color: #ffffff;
      padding: 15px 20px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .brand-title {
      font-size: 20px;
      font-weight: bold;
      color: #336699;
    }
    .search-box {
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 5px;
      width: 300px;
    }
    .form-wrapper {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: calc(100vh - 70px);
      padding: 20px;
    }
    .form-container {
      background-color: #fff;
      max-width: 800px;
      width: 100%;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      animation: slideDown 0.5s ease-out forwards;
    }
    @keyframes slideDown {
      0% { transform: translateY(-30px); opacity: 0; }
      100% { transform: translateY(0); opacity: 1; }
    }
    .form-container h2 {
      color: #336699;
      margin-bottom: 20px;
      text-align: center;
    }
    .form-group {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-bottom: 15px;
    }
    .form-group > div {
      flex: 1;
      min-width: 240px;
    }
    .form-group label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }
    .form-group input,
    .form-group select,
    .form-group textarea {
      width: 100%;
      padding: 10px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .form-group textarea { resize: vertical; min-height: 100px; }
    .button-group { text-align: right; margin-top: 20px; }
    .btn {
      background-color: #336699;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .btn:hover { background-color: #285580; }
    .btn-cancel {
      background-color: #ccc;
      margin-right: 10px;
    }
    .btn-cancel:hover { background-color: #999; }
    .image-preview {
      margin-top: 10px;
      max-width: 100%;
      height: auto;
      border: 1px solid #ddd;
      border-radius: 5px;
      display: none;
    }
    .cancel-img-btn {
      display: none;
      margin-top: 10px;
      background-color: #e74c3c;
      color: white;
      border: none;
      padding: 8px 12px;
      border-radius: 5px;
      cursor: pointer;
    }
    .toast {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: #28a745;
      color: #fff;
      padding: 15px 20px;
      border-radius: 5px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      opacity: 0;
      transition: opacity 0.5s ease-out, bottom 0.5s;
      z-index: 9999;
    }
    .toast.show {
      opacity: 1;
      bottom: 40px;
    }
    progress {
      width: 100%;
      height: 15px;
      margin-top: 10px;
      display: none;
    }
    @media (max-width: 768px) {
      .search-box { width: 100%; margin-bottom: 10px; }
      .form-group { flex-direction: column; }
      .form-group > div { width: 100%; }
    }
  </style>
</head>
<body>
  <div class="main-container">
    <div class="top-nav">
      <span class="brand-title">Add Venue</span>
      <div>
        <input type="text" class="search-box" placeholder="Search...">
        <button class="toggle-mode" onclick="alert('Jangan lupa disimpan ya!')">ℹ️</button>
      </div>
    </div>
    <div class="form-wrapper">
      <div class="form-container">
        <h2>Add New Venue</h2>
        @if(session('success'))
  <div style="margin-bottom: 15px; padding: 10px; background-color: #d4edda; color: #155724; border-radius: 5px; border: 1px solid #c3e6cb;">
    {{ session('success') }}
  </div>
@endif
<form action="{{ route('venues.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
          <div class="form-group">
            <div>
              <label for="venue-name">Venue Name</label>
              <input type="text" id="venue-name" name="name" required>
            </div>
            <div>
              <label for="venue-address">Address</label>
              <input type="text" id="venue-address" name="address" required>
            </div>
          </div>

          <div class="form-group">
            <div>
              <label for="city">City</label>
              <select id="city" name="city" required>
                <option value="">-- Select City --</option>
                <option value="city1">City 1</option>
                <option value="city2">City 2</option>
              </select>
            </div>
            <div>
              <label for="price">Price</label>
              <input type="number" id="price" name="price" required>
            </div>
          </div>

          <div class="form-group">
            <div>
              <label for="capacity">Capacity</label>
              <input type="number" id="capacity" name="capacity" required>
            </div>
            <div>
              <label for="category">Category (MICE)</label>
              <select id="category" name="category" required>
                <option value="">-- Select MICE Type --</option>
                <option value="meeting">Meeting</option>
                <option value="incentive">Incentive</option>
                <option value="convention">Convention</option>
                <option value="exhibition">Exhibition</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <div>
              <label for="venue-image">Upload Image</label>
              <input type="file" id="venue-image" name="image" accept="image/*" onchange="previewImage(event)">
              <img id="imagePreview" class="image-preview">
              <button type="button" class="cancel-img-btn" id="cancelImageBtn" onclick="cancelImage()">Cancel Image</button>
              <progress id="uploadProgress" value="0" max="100"></progress>
            </div>
            <div>
              <label for="description">Description</label>
              <textarea id="description" name="description"></textarea>
            </div>
          </div>

          <div class="button-group">
            <button type="button" class="btn btn-cancel" onclick="cancelEdit()">Cancel</button>
            <button type="submit" class="btn">Add Venue</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    function previewImage(event) {
      const file = event.target.files[0];
      const preview = document.getElementById('imagePreview');
      const progressBar = document.getElementById('uploadProgress');
      const cancelBtn = document.getElementById('cancelImageBtn');

      if (file) {
        const reader = new FileReader();
        progressBar.style.display = 'block';
        cancelBtn.style.display = 'inline-block';
        progressBar.value = 0;
        let progress = 0;
        const interval = setInterval(() => {
          progress += 10;
          progressBar.value = progress;
          if (progress >= 100) clearInterval(interval);
        }, 100);
        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
      } else {
        cancelImage();
      }
    }

    function cancelImage() {
      document.getElementById('venue-image').value = '';
      document.getElementById('imagePreview').style.display = 'none';
      document.getElementById('uploadProgress').style.display = 'none';
      document.getElementById('cancelImageBtn').style.display = 'none';
    }

    function cancelEdit() {
      if (confirm("Are you sure you want to cancel changes?")) {
        document.querySelectorAll('input, textarea, select').forEach(el => el.value = '');
        cancelImage();
      }
    }
  </script>
</body>
</html>
