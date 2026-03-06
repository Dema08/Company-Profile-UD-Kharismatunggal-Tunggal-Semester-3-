function cekWaktu() {
    // Ambil timestamp dari percakapan terakhir
    let waktuKomentarTerakhir = parseInt(document.getElementById('add-comment-btn').getAttribute('data-timestamp'));
    let waktuSekarang = Math.floor(Date.now() / 1000); // Waktu sekarang dalam detik

    // Periksa apakah sudah lebih dari 60 detik
    if (waktuSekarang - waktuKomentarTerakhir < 60) {
        alert("Anda hanya bisa menambahkan komentar semenit lagi");
    } else {
        // Izinkan untuk menambah komentar dan perbarui timestamp
        document.getElementById('add-comment-btn').setAttribute('data-timestamp', waktuSekarang);
        window.dialog.showModal(); // Misalnya ini membuka modal komentar
    }
}
