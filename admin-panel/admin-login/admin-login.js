document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");
    const errorMessage = document.getElementById("errorMessage");

    loginForm.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent form submission

        const username = document.getElementById("username").value;
        const password = document.getElementById("password").value;

        // Default login credentials
        const adminUsername = "johndoe";
        const adminPassword = "123456789";

        if (username === adminUsername && password === adminPassword) {
            alert("Login Successful! Redirecting to Admin Dashboard...");
            window.location.href = "../admin.html"; // Redirect to Admin Panel
        } else {
            errorMessage.classList.remove("hidden"); // Show error message
        }
    });
});
