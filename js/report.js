const btnBack = document.getElementById("btnBack");
const dateInput = document.getElementById('date');
const getButton = document.getElementById('btnGet');

btnBack.addEventListener("click", () => {
    window.location.href = "index.php";
});

dateInput.value = new Date().toISOString().slice(0, 10);

getButton.addEventListener('click', function () {
    const selectedDate = dateInput.value;

    if (!selectedDate) {
        alert("Pilih tanggal terlebih dahulu.");
        return;
    }

    // Kirim request ke server untuk mendapatkan data laporan
    fetch(`./include/get_report.php?date=${selectedDate}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                renderReport(data.reports);
            } else {
                showNoDataMessage();
            }
        })
        .catch(error => {
            console.error('Error fetching report data:', error);
            showNoDataMessage();
        });
});

// Fungsi untuk menampilkan data laporan di dalam halaman
function renderReport(reports) {
    const container = document.querySelector('.container.mx-auto');
    container.innerHTML = ''; // Kosongkan container sebelum render

    let totalPendapatan = 0;
    let totalOutlet = reports.length;

    reports.forEach(report => {
        totalPendapatan += report.pendapatan;

        // Template untuk satu laporan outlet
        const reportHTML = `
            <div class="bg-gray-400 rounded-lg p-2 mt-2">
                <div class="text-white text-center p-2">${report.outlet} (${report.address})</div>
                <div class="bg-white rounded-lg flex item-center justify-between">
                    <div class="text-center p-3">
                        <h4 class="text-sm">Nitip</h4>
                        <h2 class="text-xl font-bold">${report.qty}</h2>
                    </div>
                    <div class="text-center p-3">
                        <h4 class="text-sm">Laku</h4>
                        <h2 class="text-xl font-bold">${report.laku}</h2>
                    </div>
                    <div class="text-center p-3">
                        <h4 class="text-sm">Sisa</h4>
                        <h2 class="text-xl font-bold">${report.sisa}</h2>
                    </div>
                </div>
                <div class="text-center text-white p-3">
                    <h4 class="text-sm">Pendapatan</h4>
                    <h2 class="text-lg font-bold">Rp. ${new Intl.NumberFormat('id-ID').format(report.pendapatan)}</h2>
                </div>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', reportHTML);
    });

    // Menambahkan total pendapatan di bagian bawah
    const totalHTML = `
        <div class="flex item-center justify-between mt-2 mx-2 rounded-lg text-md font-bold">
            <div>Total Outlet</div>
            <div>${totalOutlet}</div>
        </div>
        <div class="flex item-center justify-between mx-2 rounded-lg text-xl font-bold">
            <div>Total Pendapatan</div>
            <div>Rp. ${new Intl.NumberFormat('id-ID').format(totalPendapatan)}</div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', totalHTML);
}

function showNoDataMessage() {
    const container = document.querySelector('.container.mx-auto');
    container.innerHTML = ''; // Kosongkan container sebelum render
    const noDataHTML = `
        <div class="text-center text-gray-500 mt-4">
            <h2 class="text-md">Data tidak ditemukan untuk tanggal yang dipilih.</h2>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', noDataHTML);
}

