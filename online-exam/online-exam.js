document.addEventListener("DOMContentLoaded", function () {
    let examStartTime = new Date(document.getElementById("examStartTime").textContent);
    let startExamBtn = document.getElementById("startExamBtn");
    let timerElement = document.getElementById("timer");
    let examForm = document.getElementById("examForm");

    function updateCountdown() {
        let currentTime = new Date();
        let timeLeft = examStartTime - currentTime;

        if (timeLeft <= 0) {
            startExamBtn.disabled = false;
            timerElement.textContent = "00:00:00";
            clearInterval(countdownInterval);
        } else {
            let hours = Math.floor(timeLeft / (1000 * 60 * 60));
            let minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
            timerElement.textContent = `${String(hours).padStart(2, "0")}:${String(minutes).padStart(2, "0")}:${String(seconds).padStart(2, "0")}`;
        }
    }

    // Start the countdown
    let countdownInterval = setInterval(updateCountdown, 1000);
    updateCountdown();

    // Start Exam Function
    window.startExam = function () {
        startExamBtn.style.display = "none";
        examForm.style.display = "block";

        // Set Timer for Auto-Submit (30 min exam)
        let examEndTime = new Date(examStartTime.getTime() + 30 * 60 * 1000);

        let autoSubmitInterval = setInterval(() => {
            let currentTime = new Date();
            if (currentTime >= examEndTime) {
                clearInterval(autoSubmitInterval);
                alert("Time's up! Your exam has been submitted.");
                document.getElementById("examForm").submit();
            }
        }, 1000);
    };

    // Submit Exam
    document.getElementById("examForm").addEventListener("submit", function (e) {
        e.preventDefault();
        alert("Exam submitted successfully!");
        window.location.href = "results.html";
    });
});
