document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");

    loginForm.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent actual form submission

        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;

        // Dummy authentication logic (replace with real backend authentication)
        if (email === "user@example.com" && password === "password123") {
            alert("Login Successful!");
            window.location.href = "../student-panel/student-panel.html"; // Redirect to student panel
        } else {
            alert("Invalid email or password. Please try again.");
        }
    });
});
