document.addEventListener("DOMContentLoaded", function () {
  const levelSelect = document.getElementById("level");
  const universityDivisions = document.querySelector(".university-divisions");
  const registrationForm = document.getElementById("registrationForm");
  const paymentBtn = document.getElementById("paymentBtn");

  // Show/hide university division selection
  levelSelect.addEventListener("change", function () {
    if (this.value === "university") {
      universityDivisions.classList.remove("hidden");
    } else {
      universityDivisions.classList.add("hidden");
    }
  });

  // Handle Form Submission
  registrationForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent actual form submission

    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const mobile = document.getElementById("mobile").value;
    const institution = document.getElementById("institution").value;
    const level = document.getElementById("level").value;

    // Generate a unique registration ID
    const registrationId = `ICT-${Date.now()}-${Math.floor(
      Math.random() * 1000
    )}`;

    // Send registration request to the backend
    fetch("../api/register.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `name=${encodeURIComponent(name)}&email=${encodeURIComponent(
        email
      )}&password=${encodeURIComponent(password)}&mobile=${encodeURIComponent(
        mobile
      )}&institution=${encodeURIComponent(
        institution
      )}&level=${encodeURIComponent(level)}&registrationId=${encodeURIComponent(
        registrationId
      )}`,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.message === "Registration successful") {
          alert(
            `Registration successful! Your unique registration ID is: ${registrationId}`
          );
          // Enable Payment Button
          paymentBtn.classList.remove("disabled");
          paymentBtn.removeAttribute("disabled");
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
