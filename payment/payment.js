document.addEventListener("DOMContentLoaded", function () {
    let paymentMethodSelect = document.getElementById("paymentMethod");
    let cardDetails = document.getElementById("cardDetails");
    let paypalDetails = document.getElementById("paypalDetails");
    let mobileDetails = document.getElementById("mobileDetails");
    let payNowBtn = document.getElementById("payNowBtn");
    let paymentStatus = document.getElementById("paymentStatus");

    // Hide all payment details initially
    cardDetails.style.display = "none";
    paypalDetails.style.display = "none";
    mobileDetails.style.display = "none";

    // Show selected payment details
    paymentMethodSelect.addEventListener("change", function () {
        cardDetails.style.display = "none";
        paypalDetails.style.display = "none";
        mobileDetails.style.display = "none";

        if (this.value === "card") {
            cardDetails.style.display = "block";
        } else if (this.value === "paypal") {
            paypalDetails.style.display = "block";
        } else if (this.value === "mobile") {
            mobileDetails.style.display = "block";
        }
    });

    // Process Payment
    payNowBtn.addEventListener("click", function () {
        let paymentMethod = paymentMethodSelect.value;

        if (paymentMethod === "card") {
            let cardNumber = document.getElementById("cardNumber").value;
            let cardExpiry = document.getElementById("cardExpiry").value;
            let cardCVV = document.getElementById("cardCVV").value;

            if (cardNumber && cardExpiry && cardCVV) {
                paymentStatus.innerHTML = "<span style='color:green;'>Payment Successful!</span>";
            } else {
                paymentStatus.innerHTML = "<span style='color:red;'>Please enter all card details.</span>";
            }
        } else if (paymentMethod === "paypal") {
            paymentStatus.innerHTML = "<span style='color:blue;'>Redirecting to PayPal...</span>";
            setTimeout(() => {
                paymentStatus.innerHTML = "<span style='color:green;'>Payment Successful!</span>";
            }, 2000);
        } else if (paymentMethod === "mobile") {
            let mobileNumber = document.getElementById("mobileNumber").value;
            let transactionID = document.getElementById("transactionID").value;

            if (mobileNumber && transactionID) {
                paymentStatus.innerHTML = "<span style='color:green;'>Payment Successful!</span>";
            } else {
                paymentStatus.innerHTML = "<span style='color:red;'>Please enter mobile banking details.</span>";
            }
        }
    });
});
