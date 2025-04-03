document.addEventListener("DOMContentLoaded", function () {
  const loginForm = document.getElementById("loginForm");
  const errorMessage = document.getElementById("errorMessage");

  loginForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission

    const email = document.getElementById("username").value; // Using email as username
    const password = document.getElementById("password").value;

    // Send a POST request to the new admin-specific API
    fetch("./admin-login-api.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: new URLSearchParams({
        email: email,
        password: password,
      }),
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
      })
      .then((data) => {
        if (data.message === "Login successful") {
          alert("Login Successful! Redirecting to Admin Dashboard...");
          window.location.href = "../admin.html"; // Redirect to Admin Panel
        } else {
          errorMessage.classList.remove("hidden"); // Show error message
          errorMessage.textContent = data.message; // Display the error message
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        errorMessage.classList.remove("hidden"); // Show error message
        errorMessage.textContent = "An error occurred. Please try again.";
      });
  });

  // Logout functionality
  const logoutButton = document.getElementById("logoutButton");
  if (logoutButton) {
    logoutButton.addEventListener("click", function () {
      // Clear session or token
      localStorage.removeItem("adminToken"); // Adjust based on how the session is managed

      // Redirect to login page
      window.location.href = "../admin-login/admin-login.html"; // Adjust the path as necessary
    });
  }
});
