function getLocation() {
    var locationElement = document.getElementById("location");

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        locationElement.innerHTML = "Geolocation tidak didukung oleh browser ini.";
    }
}

function showPosition(position) {
    var geolocation = document.getElementById("geolocation");
    geolocation.value = `https://www.google.com/maps/dir/?api=1&destination=${position.coords.latitude},${position.coords.longitude}`;
}

function showError(error) {
    var locationElement = document.getElementById("location");
    switch (error.code) {
        case error.PERMISSION_DENIED:
            locationElement.innerHTML = "Pengguna menolak permintaan Geolocation.";
            break;
        case error.POSITION_UNAVAILABLE:
            locationElement.innerHTML = "Informasi lokasi tidak tersedia.";
            break;
        case error.TIMEOUT:
            locationElement.innerHTML = "Permintaan untuk mendapatkan lokasi pengguna melebihi batas waktu.";
            break;
        case error.UNKNOWN_ERROR:
            locationElement.innerHTML = "Terjadi kesalahan yang tidak diketahui.";
            break;
    }
}