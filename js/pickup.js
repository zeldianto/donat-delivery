const btnBack = document.getElementById("btnBack");

btnBack.addEventListener("click", () => {
    window.location.href = "index.php";
});

document.addEventListener("DOMContentLoaded", function () {
    const container = document.querySelector('.container');

    // Ambil data dari server menggunakan fetch
    fetch('./include/get_pickup.php')
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                // Bersihkan container sebelum memasukkan data baru
                container.innerHTML = '';

                // Loop melalui data dan buat elemen HTML untuk setiap item
                data.forEach(item => {
                    const pickupItem = document.createElement('div');
                    pickupItem.classList.add('flex', 'items-center', 'justify-between', 'mt-8', 'gap-4', 'p-2');

                    // Elemen kiri (informasi outlet dan alamat)
                    const leftDiv = document.createElement('div');
                    leftDiv.classList.add('flex', 'flex-col', 'space-y-1');

                    const outletName = document.createElement('p');
                    outletName.classList.add('font-medium', 'text-gray-700');
                    outletName.textContent = item.outlet_name;

                    const address = document.createElement('p');
                    address.classList.add('text-gray-500', 'text-sm');
                    address.textContent = item.address;

                    const dateBadge = document.createElement('div');
                    const dateSpan = document.createElement('span');
                    dateSpan.classList.add('bg-pink-600', 'text-white', 'text-sm', 'rounded-md', 'px-2');
                    dateSpan.textContent = new Date(item.pickup_date).toLocaleDateString('id-ID');
                    dateBadge.appendChild(dateSpan);

                    leftDiv.appendChild(outletName);
                    leftDiv.appendChild(address);
                    leftDiv.appendChild(dateBadge);

                    // Elemen kanan (tombol pickup)
                    const rightButton = document.createElement('button');
                    rightButton.classList.add('text-blue-500', 'hover:text-pink-700', 'font-medium');
                    rightButton.textContent = 'Pickup';
                    rightButton.setAttribute('data-id', item.id);  // Simpan ID untuk aksi pickup

                    // Tambahkan event listener jika dibutuhkan untuk aksi pickup
                    rightButton.addEventListener('click', function () {
                        console.log('Pickup untuk ID: ' + item.id);  // Placeholder untuk aksi pickup
                        window.location.href = "pickup_detail.php?id="+item.id;
                    });

                    // Tambahkan elemen ke dalam container
                    pickupItem.appendChild(leftDiv);
                    pickupItem.appendChild(rightButton);
                    container.appendChild(pickupItem);
                });
            } else {
                container.innerHTML = '<p class="text-center text-gray-500">Tidak ada data penjemputan tersedia.</p>';
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            alert(error);
            container.innerHTML = '<p class="text-center text-red-500">Gagal memuat data.</p>';
        });
});
