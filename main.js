// Runs after the page is fully loaded
document.addEventListener("DOMContentLoaded", function () {
  handleUserStatus();
  loadLaptopsFromAPI();
});

// ✅ Display user status
function handleUserStatus() {
  const userId = localStorage.getItem('user_id');
  if (userId) {
    console.log("Logged in as user ID:", userId);
  } else {
    console.log("User not logged in.");
  }
}

// ✅ Fetch laptops from your API and inject them into the homepage
function loadLaptopsFromAPI() {
  const API_URL = "https://yug-patel-profile.top/api_services.php";
  const container = document.getElementById("laptop-container");
  const dropdown = document.getElementById("laptopSelector");

  fetch(API_URL)
    .then(response => response.json())
    .then(services => {
      services.forEach(service => {
        addLaptopCard(service, container);
        addLaptopToDropdown(service, dropdown);
      });
    })
    .catch(error => console.error("Error loading laptops:", error));
}

// ✅ Render a single laptop box in the grid
function addLaptopCard(service, container) {
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
}

// ✅ Add a laptop option to the dropdown
function addLaptopToDropdown(service, dropdown) {
  if (!dropdown) return;
  const option = document.createElement("option");
  option.value = service.learnMoreUrl;
  option.textContent = service.name;
  dropdown.appendChild(option);
}

function goToLaptopPage() {
  const selectedUrl = document.getElementById("laptopSelector").value;
  if (selectedUrl) {
    window.location.href = selectedUrl;
  } else {
    alert("Please select a laptop first.");
  }
}
