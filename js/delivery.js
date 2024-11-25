const btnBack = document.getElementById("btnBack");
const submitBtn = document.getElementById("submitBtn");

const inputName = document.getElementById("name");
const inputAddress = document.getElementById("address");
const inputQty = document.getElementById("qty");

btnBack.addEventListener("click", () => {
    window.history.back();
});

document.getElementById("date").value = new Date().toISOString().slice(0, 10);

submitBtn.addEventListener("click", (e) => {
    e.preventDefault();

    const formData = new FormData(deliveryForm);

    if (inputName.value.trim() === "" || inputAddress.value.trim() === "" || inputQty.value.trim() === "") {
        alert("Harap isi semua input yang diperlukan.");
        return;
    }

    fetch('./include/post_delivery.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            window.history.back();
        })
        .catch(error => {
            alert(error);
            console.error('Error:', error);
        });
});
