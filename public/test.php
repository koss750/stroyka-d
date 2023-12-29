<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<title>Real Estate Showcase</title>
<style>
  /* Custom CSS for Real Estate Showcase */

body {
  font-family: 'Open Sans', sans-serif; /* Example font */
  color: #333; /* Adjust the color to match the design */
}

/* Navbar Custom Styles */
.navbar-custom {
  background-color: #fff; /* Adjust the color to match the design */
  box-shadow: 0 2px 4px rgba(0,0,0,.1); /* Example shadow */
  /* Other styles as per the design */
}

/* Main Image and Settings Section */
.main-image {
  width: 100%;
  height: auto;
  border-radius: 10px; /* Adjust as needed */
}

.settings-section {
  padding: 20px; /* Adjust spacing as needed */
  /* Add styles for each setting option */
}

/* Card Styles for Houses Grid */
.house-card {
  border: none;
  border-radius: 10px; /* Match to design */
  overflow: hidden;
  box-shadow: 0 4px 8px rgba(0,0,0,.1); /* Example shadow */
}

.house-card img {
  height: 200px; /* Adjust to match design */
  object-fit: cover; /* Ensure images cover the card area */
}

.house-card .card-body {
  padding: 15px;
  background-color: #fff; /* Match to design */
}

/* Footer Custom Styles */
.footer-custom {
  background-color: #f8f9fa; /* Adjust the color to match the design */
  padding: 20px 0;
  /* Add any additional styles */
}

/* Responsive Adjustments */
@media (max-width: 768px) {
  .settings-section, .main-image {
    margin-bottom: 20px;
  }

  .house-card img {
    height: auto;
  }
}

/* Add more custom responsive styles as needed */

</style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-custom">
  <a class="navbar-brand" href="#">Navbar</a>
  <!-- Other navbar content -->
</nav>

<!-- Main Image with Settings -->
<div class="container-fluid">
  <div class="row">
    <!-- Settings Section -->
    <div class="col-md-3 settings-section">
      <!-- Add settings options here -->
    </div>
    <!-- Main House Image -->
    <div class="col-md-9">
      <img src="main-house.jpg" alt="Main House" class="main-image img-fluid">
    </div>
  </div>
</div>

<!-- Houses Grid -->
<div class="container">
  <div class="row">
    <!-- House Card -->
    <div class="col-md-4 mb-3">
      <div class="card house-card">
        <img class="card-img-top" src="house1.jpg" alt="House 1">
        <!-- Card content -->
      </div>
    </div>
    <!-- Repeat for other house cards -->
  </div>
</div>

<!-- Footer -->
<footer class="bg-light text-center text-lg-start footer-custom">
  <!-- Footer content -->
</footer>

<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
