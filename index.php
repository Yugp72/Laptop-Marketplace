<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <title>LapCart - Laptop Marketplace</title>
</head>
<body>

<!-- Header -->
<?php include('includes/header.php'); ?>

<main>
  <section class="first-section">
    <div>
      <h1>Welcome to <br> <strong>LapCart</strong></h1>
      <p>Buy, sell, and explore the latest laptops from top brands at the best prices.</p>
      <a href="#browse-laptops" class="btn-action link-action">Browse Laptops</a>
    </div>
    <div class="box-img-main">
      <img class="img-profile" src="./images/laptop-image.jpg" alt="Laptop Marketplace Image" />
    </div>
  </section>

  <section id="browse-laptops" class="second-section">
    <h2 class="title">Browse Laptops</h2>
    <div>
      <p>Find laptops by brand, specs, or price.</p>
    </div>
    <div class="scroll-box">
      <div class="box-laptop"><img src="./images/laptop-image.jpg" alt="Laptop 1"><p>Laptop 1</p></div>
      <div class="box-laptop"><img src="./images/laptop-image.jpg" alt="Laptop 2"><p>Laptop 2</p></div>
      <div class="box-laptop"><img src="./images/laptop-image.jpg" alt="Laptop 3"><p>Laptop 3</p></div>
      <div class="box-laptop"><img src="./images/laptop-image.jpg" alt="Laptop 4"><p>Laptop 4</p></div>
    </div>
  </section>

  <section id="features" class="features-section">
    <h2 class="title">Why Choose LapCart?</h2>
    <div class="features-container">
      <div class="feature-item">
        <img src="./images/fast-delivery.svg" alt="Fast Shipping" class="feature-icon">
        <h3>Fast Shipping</h3>
        <p>Get your laptops delivered quickly and safely, right to your doorstep.</p>
      </div>
      <div class="feature-item">
        <img src="./images/payment.png" alt="Secure Payments" class="feature-icon">
        <h3>Secure Payments</h3>
        <p>Shop with peace of mind using our trusted and secure payment methods.</p>
      </div>
      <div class="feature-item">
        <img src="./images/support.svg" alt="24/7 Support" class="feature-icon">
        <h3>24/7 Customer Support</h3>
        <p>Our dedicated support team is here to help you anytime, day or night.</p>
      </div>
      <div class="feature-item">
        <img src="./images/quality.png" alt="Quality Assurance" class="feature-icon">
        <h3>Quality Assurance</h3>
        <p>Only top-quality laptops from trusted brands make it to LapCart.</p>
      </div>
    </div>
  </section>

  <section id="dynamic-laptops" class="dynamic-section">
    <h2 class="title">Latest Laptops on LapCart</h2>
    <div id="laptop-container" class="laptop-grid">
      <!-- Dynamic content will be injected here -->
    </div>
  </section>

  <section id="select-laptop" class="select-laptop-section" style="padding: 40px 20px;">
    <h2 class="title">View Individual Laptop Page</h2>
    <div style="max-width: 400px; margin: auto; text-align: center;">
      <select id="laptopSelector" class="btn-action" style="width: 100%; padding: 10px; font-size: 1rem;">
        <option value="">-- Select a Laptop --</option>
      </select>
      <button onclick="goToLaptopPage()" class="btn-action" style="margin-top: 15px;">View Details</button>
    </div>
  </section>

  <section id="sell-laptops" class="fourth-section">
    <h2 class="title">Sell Your Laptop on LapCart</h2>
    <p>Want to sell your laptop? Join our marketplace today.</p>
    <button class="btn-action">Start Selling</button>
  </section>
</main>

<!-- Footer -->
<?php include('includes/footer.php'); ?>

<!-- JS -->
<script src="main.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const userId = localStorage.getItem('user_id');
  if (userId) {
    console.log("Logged in as user ID:", userId);
  } else {
    console.log("User not logged in.");
  }

  fetch("https://yug-patel-profile.top/api_services.php")
    .then(response => response.json())
    .then(services => {
      const container = document.getElementById("laptop-container");
      const dropdown = document.getElementById("laptopSelector");

      services.forEach(service => {
        // Grid
        const div = document.createElement("div");
        div.classList.add("box-laptop");
        div.innerHTML = `
          <a href="${service.learnMoreUrl}" style="text-decoration: none; color: inherit;">
            <img src="${service.imageUrl}" alt="${service.name}" />
            <p><strong>${service.name}</strong></p>
            <p style="color: green; font-weight: bold;">${service.price}</p>
          </a>
        `;
        container.appendChild(div);

        // Dropdown
        const option = document.createElement("option");
        option.value = service.learnMoreUrl;
        option.textContent = service.name;
        dropdown.appendChild(option);
      });
    })
    .catch(error => console.error("Error loading laptops:", error));
});

function goToLaptopPage() {
  const selectedUrl = document.getElementById("laptopSelector").value;
  if (selectedUrl) {
    window.location.href = selectedUrl;
  } else {
    alert("Please select a laptop first.");
  }
}
</script>

</body>
</html>
