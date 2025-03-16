document.addEventListener("DOMContentLoaded", function () {
    const examSchedule = [
        { subject: "Computer Science", level: "Secondary", date: "2025-03-15", time: "10:00" },
        { subject: "Programming", level: "Higher Secondary", date: "2025-03-16", time: "11:00" },
        { subject: "Data Structures", level: "University - Departmental", date: "2025-03-17", time: "12:00" },
        { subject: "Networking", level: "University - Non-Departmental", date: "2025-03-18", time: "13:00" }
    ];

    const examTableBody = document.getElementById("examTableBody");

    // Insert exam data into the table
    examSchedule.forEach((exam) => {
        let row = document.createElement("tr");
        row.innerHTML = `
            <td>${exam.subject}</td>
            <td>${exam.level}</td>
            <td>${exam.date}</td>
            <td>${exam.time}</td>
        `;
        examTableBody.appendChild(row);

        // Set a notification for 5 minutes before the exam
        scheduleNotification(exam.subject, exam.date, exam.time);
    });
});

// Function to schedule notifications
function scheduleNotification(subject, examDate, examTime) {
    let examDateTime = new Date(`${examDate}T${examTime}:00`);
    let notificationTime = new Date(examDateTime.getTime() - 5 * 60000); // 5 minutes before

    let currentTime = new Date();

    if (currentTime < notificationTime) {
        let timeUntilNotification = notificationTime - currentTime;

        setTimeout(() => {
            alert(`Reminder: Your ${subject} exam starts in 5 minutes!`);
        }, timeUntilNotification);
    }
}
