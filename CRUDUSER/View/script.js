document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('deliveryDate').addEventListener('input', calculateEstimatedDelivery);
    document.getElementById('deliveryForm').addEventListener('submit', validatePhoneNumber);
    calculateEstimatedDelivery();
});

function calculateEstimatedDelivery() {
    var selectedDate = new Date(document.getElementById('deliveryDate').value);

    if (!isNaN(selectedDate.getTime())) {
        var estimatedDeliveryDate = new Date(selectedDate);
        estimatedDeliveryDate.setDate(selectedDate.getDate() + 3);

        var formattedDeliveryDate = estimatedDeliveryDate.toISOString().split('T')[0];
        var defaultDeliveryTime = "12:00 PM";
        document.getElementById('deliveryTime').value = defaultDeliveryTime;
    } else {
        console.error("Invalid date selected");
    }
}

function validatePhoneNumber(event) {
    var phoneNumber = document.getElementById('phoneNumber').value;
    var phoneRegex = /^\+\d{1,3} \d{1,}-\d{1,}-\d{1,}$/;

    if (!phoneRegex.test(phoneNumber)) {
        alert("Invalid phone number format. Please use the format: +XXX XX-XXX-XXX");
        event.preventDefault(); // Prevent the form from submitting
    }
}
