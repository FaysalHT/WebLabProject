// Global variable to store the fetched university data
let allUniversities = [];

// Function to fetch universities from CSV URL
async function fetchUniversities() {
  const url = "https://raw.githubusercontent.com/endSly/world-universities-csv/master/world-universities.csv"; // Full dataset
  try {
    const response = await fetch(url);
    const csvText = await response.text();

    // Check if we have received the correct response (entire CSV)
    console.log(csvText.slice(0, 500));  // Log the first 500 characters to inspect the CSV response

    // Parse the CSV data
    const universities = parseCSV(csvText);
    allUniversities = universities;

    // Check if universities were successfully parsed
    console.log(allUniversities.length);  // Log the number of universities to see if it's complete

    // Display all universities
    displayUniversities(universities);
  } catch (error) {
    console.error('Error fetching universities:', error);
  }
}

// Function to parse the CSV data into an array of objects
function parseCSV(csvText) {
  const rows = csvText.split('\n').slice(1); // Skip header row
  return rows.map(row => {
    const [countryCode, universityName, website] = row.split(',');
    return { countryCode, universityName, website };
  }).filter(university => university.countryCode && university.universityName); // Filter out invalid rows
}

// Function to display universities on the page
function displayUniversities(universities) {
  const universityList = document.getElementById('universityList');
  universityList.innerHTML = ''; // Clear existing universities before appending new ones

  universities.forEach(university => {
    const universityCard = document.createElement('div');
    universityCard.classList.add('col-md-4');
    universityCard.innerHTML = `
      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title">${university.universityName}</h5>
          <p class="card-text">Country Code: ${university.countryCode}</p>
          <a href="${university.website}" class="btn btn-primary" target="_blank">Visit Website</a>
        </div>
      </div>
    `;
    universityList.appendChild(universityCard);
  });
}

// Function to filter universities based on search input
function filterUniversities() {
  const countrySearch = document.getElementById("countrySearch").value.toLowerCase();
  const universitySearch = document.getElementById("universitySearch").value.toLowerCase();

  const filteredUniversities = allUniversities.filter((university) => {
    const countryMatch = university.countryCode.toLowerCase().includes(countrySearch);
    const universityMatch = university.universityName.toLowerCase().includes(universitySearch);
    return countryMatch && universityMatch;
  });

  displayUniversities(filteredUniversities); // Display filtered results
}

// Event listeners for search inputs
document.getElementById("countrySearch").addEventListener("input", filterUniversities);
document.getElementById("universitySearch").addEventListener("input", filterUniversities);

// Document Ready
document.addEventListener("DOMContentLoaded", () => {
  if (document.getElementById("universityList")) {
    fetchUniversities(); // Fetch all universities immediately when the page loads
  }
  handleDynamicFields();
  setupFormHandlers();
  enableSmoothScrolling();
});



// Form handlers for login and signup
function setupFormHandlers() {
  const loginForm = document.getElementById("loginForm");
  const signupForm = document.getElementById("signupForm");

  if (loginForm) {
    loginForm.addEventListener("submit", (e) => {
      e.preventDefault();
      const email = loginForm.querySelector('input[type="email"]').value;
      const password = loginForm.querySelector('input[type="password"]').value;

      if (email && password) {
        alert("Login Successful! (This is a dummy validation)");
        bootstrap.Modal.getInstance(document.getElementById("loginModal")).hide();
      } else {
        alert("Please enter both email and password.");
      }
    });
  }

  if (signupForm) {
    signupForm.addEventListener("submit", (e) => {
      e.preventDefault();
      const fullName = signupForm.querySelector('input[type="text"]').value;
      const email = signupForm.querySelector('input[type="email"]').value;
      const password = signupForm.querySelector('input[type="password"]').value;

      if (fullName && email && password) {
        alert("Account Created Successfully! (This is a dummy validation)");
        bootstrap.Modal.getInstance(document.getElementById("signupModal")).hide();
      } else {
        alert("Please fill in all required fields.");
      }
    });
  }
}

// Nav active link marking
function setActiveLink() {
  const navLinks = document.querySelectorAll(".nav-link");
  const currentPage = window.location.pathname;

  navLinks.forEach((link) => {
    if (link.getAttribute("href") === currentPage) {
      link.classList.add("active");
    } else {
      link.classList.remove("active");
    }
  });
}

// Smooth scrolling for navigation
function enableSmoothScrolling() {
  document.querySelectorAll("a[href^='#']").forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();
      document.querySelector(this.getAttribute("href")).scrollIntoView({
        behavior: "smooth",
      });
    });
  });
}

// Document Ready
document.addEventListener("DOMContentLoaded", () => {
  if (document.getElementById("universityList")) {
    fetchUniversities();
  }
  handleDynamicFields();
  setupFormHandlers();
  enableSmoothScrolling();
});
