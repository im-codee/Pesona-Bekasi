function checkLocationPermission() {
    console.log("🔍 Memeriksa izin lokasi...");

    if (!navigator.permissions) {
        console.log("❌ Browser tidak mendukung Permissions API.");
        getLocation();
        return;
    }

    navigator.permissions.query({ name: "geolocation" }).then(function (result) {
        console.log("🛠️ Status izin lokasi:", result.state);

        if (result.state === "granted") {
            console.log("✅ Izin lokasi sudah diberikan, langsung ambil lokasi.");

            if (!localStorage.getItem("location_confirmed")) {
                getLocation();
                localStorage.setItem("location_confirmed", "true");
            }
        } else if (result.state === "prompt") {
            console.log("⏳ Izin lokasi belum diminta, meminta izin...");
            getLocation();
        } else if (result.state === "denied") {
            console.log("❌ Izin lokasi ditolak, menampilkan SweetAlert.");

            Swal.fire({
                title: "Izin Lokasi Diperlukan",
                text: "Lokasi Anda diperlukan untuk fitur pencarian berdasarkan jarak. Aktifkan izin lokasi di pengaturan browser Anda.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Coba Lagi",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log("🔄 User mencoba lagi");
                    checkDeviceLocationSettings();
                }
            });
        }

        result.onchange = () => handlePermission(result.state);
    }).catch(error => {
        console.log("⚠️ Terjadi error saat memeriksa izin lokasi:", error);
    });
}

function getLocation() {
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                let latitude = position.coords.latitude;
                let longitude = position.coords.longitude;
                let os = getOS();

                console.log("✅ Lokasi berhasil didapatkan:", latitude, longitude, os);

                if (!localStorage.getItem("location_alert_shown")) {
                    Swal.fire({
                        title: "Lokasi Berhasil Diakses!",
                        text: "Lokasi Anda telah diperbarui.",
                        icon: "success",
                        confirmButtonText: "OK",
                    });
                    localStorage.setItem("location_alert_shown", "true");
                }

                sendLocationToServer(latitude, longitude, os);
            },
            function (error) {
                handleLocationError(error);
            }
        );
    } else {
        Swal.fire({
            title: "Error",
            text: "Browser ini tidak mendukung Geolocation.",
            icon: "error",
        });
    }
}

function checkDeviceLocationSettings() {
    navigator.geolocation.getCurrentPosition(
        function (position) {
            console.log("✅ Perangkat memungkinkan lokasi, izin mungkin masih bisa diberikan.");
            getLocation();
        },
        function (error) {
            if (error.code === error.PERMISSION_DENIED) {
                console.log("🚫 Perangkat atau browser benar-benar memblokir akses lokasi.");

                let settingsURL = "";

                if (/Chrome/.test(navigator.userAgent) && /Android/.test(navigator.userAgent)) {
                    settingsURL = "chrome://settings/content/location";
                } else if (/CriOS/.test(navigator.userAgent)) {
                    settingsURL = "ios:settings";
                }

                Swal.fire({
                    title: "Akses Lokasi Diblokir!",
                    html: `
                        <p>Lokasi Anda diblokir oleh pengaturan perangkat atau browser.</p>
                        <p>Silakan periksa pengaturan:</p>
                        <ul style="text-align: left;">
                            <li>🔍 <b>Android (Chrome)</b>: <a href="${settingsURL}" target="_blank">Klik di sini</a> untuk membuka pengaturan lokasi.</li>
                            <li>🍏 <b>iPhone (Safari)</b>: Buka <b>Pengaturan > Safari > Lokasi</b> dan ubah ke "Minta" atau "Izinkan".</li>
                            <li>💻 <b>PC</b>: Klik ikon gembok 🔒 di bilah alamat dan aktifkan lokasi.</li>
                        </ul>
                    `,
                    icon: "error",
                    confirmButtonText: settingsURL ? "Buka Pengaturan" : "Saya Mengerti",
                }).then((result) => {
                    if (result.isConfirmed && settingsURL) {
                        window.open(settingsURL, "_blank");
                    }
                });
            }
        }
    );
}

function handleLocationError(error) {
    switch (error.code) {
        case error.PERMISSION_DENIED:
            Swal.fire({
                title: "Akses Lokasi Ditolak",
                text: "Anda menolak akses lokasi. Beberapa fitur mungkin tidak berfungsi.",
                icon: "error",
                confirmButtonText: "Oke"
            });
            break;
        case error.POSITION_UNAVAILABLE:
            Swal.fire({
                title: "Informasi Lokasi Tidak Tersedia",
                text: "Kami tidak dapat menentukan lokasi Anda saat ini.",
                icon: "warning",
                confirmButtonText: "Oke"
            });
            break;
        case error.TIMEOUT:
            Swal.fire({
                title: "Permintaan Lokasi Timeout",
                text: "Gagal mendapatkan lokasi dalam waktu yang cukup.",
                icon: "warning",
                confirmButtonText: "Coba Lagi"
            }).then(() => getLocation());
            break;
        default:
            Swal.fire({
                title: "Terjadi Kesalahan",
                text: "Kesalahan yang tidak diketahui terjadi.",
                icon: "error",
                confirmButtonText: "Oke"
            });
            break;
    }
}

function getOS() {
    let userAgent = navigator.userAgent;
    if (userAgent.includes("Windows")) return "Windows";
    if (userAgent.includes("Mac OS")) return "Mac OS";
    if (userAgent.includes("Linux")) return "Linux";
    if (userAgent.includes("Android")) return "Android";
    if (userAgent.includes("iPhone") || userAgent.includes("iPad")) return "iOS";
    return "Unknown";
}

function sendLocationToServer(latitude, longitude, os) {
    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`)
        .then(response => response.json())
        .then(data => {
            let lokasi = data.address.city || data.address.town || data.address.village || "Tidak diketahui";

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

            fetch("/save-location", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify({
                    latitude: latitude,
                    longitude: longitude,
                    os: os,
                    lokasi: lokasi,
                }),
            })
            .then(response => response.json())
            .then(data => console.log("✅ Server response:", data))
            .catch(error => console.error("❌ Error mengirim lokasi:", error));
        })
        .catch(error => console.error("❌ Error mendapatkan lokasi:", error));
}

document.addEventListener("DOMContentLoaded", function () {
    console.log("📢 Halaman selesai dimuat, memeriksa izin lokasi...");
    checkLocationPermission();
});
