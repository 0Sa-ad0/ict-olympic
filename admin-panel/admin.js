// Upload Questions
function uploadQuestions() {
  let fileInput = document.getElementById("questionFile");
  if (fileInput.files.length > 0) {
    alert("Questions uploaded successfully!");
  } else {
    alert("Please select a file to upload.");
  }
}

// Set Exam Time
function setExamTime() {
  let examTime = document.getElementById("examTime").value;
  if (examTime) {
    alert("Exam scheduled for: " + examTime);
  } else {
    alert("Please select a date and time.");
  }
}

// Manage Students
function manageStudents() {
  alert("Redirecting to student management...");
}

function logout() {
  // Clear session or token
  localStorage.removeItem("adminToken"); // Adjust based on how the session is managed

  // Redirect to login page
  window.location.href = "../homepage/ict.html"; // Adjust the path as necessary
}

// Manage Payments
function managePayments() {
  alert("Redirecting to payment management...");
}

// Publish Results
function publishResults() {
  alert("Results have been published successfully!");
}

// Generate Reports
function generateReports() {
  alert("Reports generated successfully!");
}
