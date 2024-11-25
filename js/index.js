const deliveryLink = document.getElementById("deliveryLink");
const pickupLink = document.getElementById("pickupLink");
const reportLink = document.getElementById("reportLink");
const outletLink = document.getElementById("outletLink");
const prepareLink = document.getElementById("prepareLink");
const LABEL_PAST_DUE = document.getElementById("pastDue");
const LABEL_TODAY = document.getElementById("today");
const LABEL_TOMORROW = document.getElementById("tomorrow");

deliveryLink.addEventListener("click", () => {
    window.location.href = "delivery.php";
});

pickupLink.addEventListener("click", () => {
    window.location.href = "pickup.php";
});

reportLink.addEventListener("click", () => {
    window.location.href = "report.php";
});

outletLink.addEventListener("click", () => {
    window.location.href = "outlet.php";
});

prepareLink.addEventListener("click", () => {
    window.location.href = "prepare.php";
});

function updateDateTime() {
    const now = new Date();
    const date = now.toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
    const time = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' }).replace(/\./g, ':');

    document.getElementById('date').textContent = date;
    document.getElementById('time').textContent = time;
}

setInterval(updateDateTime, 1000);
updateDateTime();

document.addEventListener("DOMContentLoaded", function () {
    fetch('./include/get_dashboard.php')
        .then(response => response.json())
        .then(data => {
            LABEL_PAST_DUE.textContent = data.total_past_due || 0;
            LABEL_TODAY.textContent = data.total_today || 0;
            LABEL_TOMORROW.textContent = data.total_tomorrow || 0;
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            alert(error);
        });
});