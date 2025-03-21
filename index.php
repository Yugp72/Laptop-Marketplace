<!-- <?php
include('header.php'); 
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<title>Laptop Marketplace</title>
</head>
<body>
<?php include('header.php'); ?>

<main>
<section class="first-section">
<div>
<h1>Welcome to the <br> <strong>Laptop Marketplace</strong></h1>
<p>Buy, sell, and explore the latest laptops from top brands at the best prices.</p>
<a href="#browse-laptops" class="btn-action link-action">Browse Laptops</a>
</div>
<div class="box-img-main">
<img class="img-profile" src="./images/laptop-image.jpg" alt="Laptop Marketplace Image">
</div>
</section>

<section id="browse-laptops" class="second-section">
<h2 class="title">Browse Laptops</h2>
<div>
<p>Find laptops by brand, specs, or price.</p>
</div>
<!-- Scrollable Container -->
<div class="scroll-box">
<div class="box-laptop">
<img src="./images/laptop-image.jpg" alt="Laptop 1">
<p>Laptop 1</p>
</div>
<div class="box-laptop">
<img src="./images/laptop-image.jpg" alt="Laptop 2">
<p>Laptop 2</p>
</div>
<div class="box-laptop">
<img src="./images/laptop-image.jpg" alt="Laptop 3">
<p>Laptop 3</p>
</div>
<div class="box-laptop">
<img src="./images/laptop-image.jpg" alt="Laptop 4">
<p>Laptop 4</p>
</div>
<div class="box-laptop">
<img src="./images/laptop-image.jpg" alt="Laptop 5">
<p>Laptop 5</p>
</div>
</div>
</section>

<section id="features" class="features-section">
<h2 class="title">Our Features</h2>
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
<p>Only top-quality laptops from trusted brands make it to our marketplace.</p>
</div>
</div>
</section>

<!-- Dynamic Data Section -->
<section id="dynamic-laptops" class="dynamic-section">
<h2 class="title">Latest Laptops</h2>
<div id="laptop-container" class="laptop-grid"></div>
</section>

<section id="sell-laptops" class="fourth-section">
<h2 class="title">Sell Your Laptop</h2>
<p>Want to sell your laptop? Join our marketplace today.</p>
<button class="btn-action">Start Selling</button>
</section>
</main>

<?php include('footer.php'); ?>
</body>
<script src="main.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    fetch("https://example.com/laptops-data") // Replace with the actual external website URL
        .then(response => response.text())
        .then(data => {
            let container = document.getElementById("laptop-container");
            let parser = new DOMParser();
            let doc = parser.parseFromString(data, "text/html");
            let laptopItems = doc.querySelectorAll(".laptop-item"); // Modify selector as needed
            
            laptopItems.forEach(item => {
                let name = item.querySelector(".laptop-name").textContent;
                let imgSrc = item.querySelector("img").src;
                let div = document.createElement("div");
                div.classList.add("box-laptop");
                div.innerHTML = `<img src="${imgSrc}" alt="${name}"><p>${name}</p>`;
                container.appendChild(div);
            });
        })
        .catch(error => console.error("Error loading laptops:", error));
});
</script>
</html>
