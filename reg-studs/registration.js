document.addEventListener("DOMContentLoaded", function () {
    const levelSelect = document.getElementById("level");
    const universityDivisions = document.querySelector(".university-divisions");
    const registrationForm = document.getElementById("registrationForm");
    const registrationIdField = document.getElementById("registrationId");
    const paymentBtn = document.getElementById("paymentBtn");

    // Show/hide university division selection
    levelSelect.addEventListener("change", function () {
        if (this.value === "university") {
            universityDivisions.classList.remove("hidden");
        } else {
            universityDivisions.classList.add("hidden");
        }
    });

    // Generate Unique Registration ID
    function generateRegistrationId() {
        return "ICT" + Math.floor(1000 + Math.random() * 9000);
    }

    // Handle Form Submission
    registrationForm.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent actual form submission

        // Generate and display registration ID
        const registrationId = generateRegistrationId();
        registrationIdField.value = registrationId;

        alert("Registration Successful! Your ID: " + registrationId);

        // Enable Payment Button
        paymentBtn.classList.remove("disabled");
        paymentBtn.removeAttribute("disabled");
    });
});
