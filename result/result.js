document.addEventListener("DOMContentLoaded", function () {
    let resultData = [
        { question: "What is the full form of CPU?", yourAnswer: "Central Processing Unit", correctAnswer: "Central Processing Unit", marks: 10 },
        { question: "Explain the working of an OS", yourAnswer: "It manages hardware and software", correctAnswer: "It manages hardware and software", marks: 20 }
    ];

    let resultTable = document.getElementById("resultTable");
    let totalScore = 0;

    resultData.forEach((item) => {
        let row = document.createElement("tr");
        row.innerHTML = `
            <td>${item.question}</td>
            <td>${item.yourAnswer}</td>
            <td>${item.correctAnswer}</td>
            <td>${item.marks}</td>
        `;
        totalScore += item.marks;
        resultTable.appendChild(row);
    });

    document.getElementById("totalScore").textContent = totalScore;
    document.getElementById("certScore").textContent = totalScore;

    // Set certificate date
    document.getElementById("certDate").textContent = new Date().toLocaleDateString();
});

// Generate Certificate
function generateCertificate() {
    document.getElementById("certificate").style.display = "block";
}

// Download Certificate as Image
function downloadCertificate() {
    html2canvas(document.getElementById("certificate")).then((canvas) => {
        let link = document.createElement("a");
        link.download = "certificate.png";
        link.href = canvas.toDataURL();
        link.click();
    });
}
