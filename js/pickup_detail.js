const btnBack = document.getElementById("btnBack");
const urlParams = new URLSearchParams(window.location.search);
const checkbox = document.getElementById('nonActive');
const inputQty = document.getElementById('nextQty');
const submitBtn = document.getElementById("submitBtn");
const qtyInput = document.getElementById('qty');
const soldQtyInput = document.getElementById('sold_qty');
const sisaInput = document.getElementById('sisa');
const id = urlParams.get('id');

btnBack.addEventListener("click", () => {
    window.location.href = "pickup.php";
});

document.addEventListener('DOMContentLoaded', function () {
    if (id) {
        // Kirim request AJAX untuk mendapatkan detail penjemputan
        fetch(`./include/get_pickup_detail.php?id=${id}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data.success)
                if (data.success) {
                    // Isi form dengan data yang diambil
                    document.getElementById('deliveryID').value = data.delivery_id;
                    // document.getElementById('date').value = data.pickup_date;
                    document.getElementById("date").value = new Date().toISOString().slice(0, 10);
                    document.getElementById('name').textContent = data.name;
                    document.getElementById('address').textContent = data.address;
                    document.getElementById('qty').value = data.qty;
                    document.getElementById('nextQty').value = data.qty;
                    document.getElementById('note').value = data.note;
                    document.getElementById('direction').addEventListener('click', function () {
                        window.open(data.geolocation, '_blank');
                    });
                    checkbox.addEventListener('change', function () {
                        if (checkbox.checked) {
                            inputQty.value = '';
                            inputQty.disabled = true;
                        } else {
                            inputQty.value = data.qty;
                            inputQty.disabled = false;
                        }
                    });
                } else {
                    alert("Data tidak ditemukan");
                }
            })
            .catch(error => {
                alert(error);
                console.error('Error fetching data:', error);
            });
    } else {
        alert("ID tidak ditemukan di URL.");
    }
});

// document.getElementById('sold_qty').addEventListener('input', calculateDeposit);
document.getElementById('sisa').addEventListener('input', calculateDeposit);
document.getElementById('price').addEventListener('input', calculateDeposit);

function updateSisa() {
    const qty = parseInt(qtyInput.value) || 0;
    const soldQty = parseInt(soldQtyInput.value) || 0;
    sisaInput.value = qty - soldQty;
}

function updateSoldQty() {
    const qty = parseInt(qtyInput.value) || 0;
    const sisa = parseInt(sisaInput.value) || 0;
    soldQtyInput.value = qty - sisa;
}

soldQtyInput.addEventListener('input', updateSisa);
sisaInput.addEventListener('input', updateSoldQty);

submitBtn.addEventListener("click", (e) => {
    e.preventDefault();

    const formData = new FormData(pickupForm);
    console.log(checkbox.checked)

    fetch(`./include/post_pickup.php`, {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data)
            window.location.href = "pickup.php";
        })
        .catch(error => {
            alert(error);
            console.error('Error:', error);
        });
});

function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix === undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

function roundDownToNearest500(value) {
    return Math.floor(value / 500) * 500;
}

function calculateDeposit() {
    // var soldQty = document.getElementById('sold_qty').value;
    console.log(qtyInput.value)
    var soldQty = (qtyInput.value - document.getElementById('sisa').value);
    var price = document.getElementById('price').value;
    var deposit = soldQty * price;
    var roundedDeposit = roundDownToNearest500(deposit);
    document.getElementById('deposit').value = formatRupiah(roundedDeposit.toString(), 'Rp. ');
    document.getElementById('depositReal').value = roundedDeposit;
}

