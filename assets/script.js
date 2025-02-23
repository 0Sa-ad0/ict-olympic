document.addEventListener("DOMContentLoaded", function () {
    console.log("ICT Olympic website loaded successfully!");
});

function toggleDivision() {
    const levelSelect = document.getElementById("levelSelect");
    const divisionSection = document.getElementById("divisionSection");

    if (levelSelect.value === "University") {
        divisionSection.style.display = "block";
    } else {
        divisionSection.style.display = "none";
    }
}

function validateForm() {
    const levelSelect = document.getElementById("levelSelect");
    const divisionSelect = document.getElementById("divisionSelect");
    const nameInput = document.getElementById("nameInput");
    const emailInput = document.getElementById("emailInput");
    const phoneInput = document.getElementById("phoneInput");
    const messageInput = document.getElementById("messageInput");

    if (levelSelect.value === "University" && divisionSelect.value === "") {
        alert("Please select a division.");
        return false;
    }

    if (nameInput.value === "") {
        alert("Please enter your name.");
        return false;
    }

    if (emailInput.value === "") {
        alert("Please enter your email address.");
        return false;
    }

    if (phoneInput.value === "") {
        alert("Please enter your phone number.");
        return false;
    }

    if (messageInput.value === "") {
        alert("Please enter a message.");
        return false;
    }

    return true;
}

function submitForm() {
    if (validateForm()) {
        alert("Form submitted successfully!");
    }
}

function resetForm() {
    document.getElementById("contactForm").reset();
    alert("Form reset successfully!");
}

function toggleMenu() {
    const menu = document.getElementById("menu");
    menu.classList.toggle("show");
}

function toggleDarkMode() {
    const body = document.body;
    body.classList.toggle("dark-mode");
}

function toggleFontSize() {
    const body = document.body;
    body.classList.toggle("large-font");
}

function toggleContrast() {
    const body = document.body;
    body.classList.toggle("high-contrast");
}

function toggleSpacing() {
    const body = document.body;
    body.classList.toggle("wide-spacing");
}

function toggleImages() {
    const body = document.body;
    body.classList.toggle("no-images");
}

function toggleAnimations() {
    const body = document.body;
    body.classList.toggle("no-animations");
}

function toggleTransitions() {
    const body = document.body;
    body.classList.toggle("no-transitions");
}

function toggleScrollbars() {
    const body = document.body;
    body.classList.toggle("no-scrollbars");
}

function toggleShadows() {
    const body = document.body;
    body.classList.toggle("no-shadows");
}

function toggleBorders() {
    const body = document.body;
    body.classList.toggle("no-borders");
}

function toggleOutlines() {
    const body = document.body;
    body.classList.toggle("no-outlines");
}

function toggleUnderlines() {
    const body = document.body;
    body.classList.toggle("no-underlines");
}

function toggleOverlines() {
    const body = document.body;
    body.classList.toggle("no-overlines");
}

function toggleItalics() {
    const body = document.body;
    body.classList.toggle("no-italics");
}

function toggleBold() {
    const body = document.body;
    body.classList.toggle("no-bold");
}

function toggleUppercase() {
    const body = document.body;
    body.classList.toggle("no-uppercase");
}

function toggleLowercase() {
    const body = document.body;
    body.classList.toggle("no-lowercase");
}

function toggleCapitalize() {
    const body = document.body;
    body.classList.toggle("no-capitalize");
}

function toggleTextAlign() {
    const body = document.body;
    body.classList.toggle("center-text");
}

function toggleTextTransform() {
    const body = document.body;
    body.classList.toggle("no-transform");
}

function toggleTextDecoration() {
    const body = document.body;
    body.classList.toggle("no-decoration");
}

function toggleTextShadow() {
    const body = document.body;
    body.classList.toggle("no-shadow");
}
