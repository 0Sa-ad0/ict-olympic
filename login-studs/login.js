document.addEventListener("DOMContentLoaded", function () {
  const loginForm = document.getElementById("loginForm");

  loginForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent actual form submission

    const email = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    // Send login request to the backend
    fetch("../api/login.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(
        password
      )}`,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.message === "Login successful") {
          alert("Login Successful!");
          if (data.role === "student") {
            window.location.href = "../student-panel/student-panel.html"; // Redirect to student panel
          }
        } else {
          alert(data.message);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        alert("An error occurred. Please try again.");
      });
  });
});
