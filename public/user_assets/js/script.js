// toggle class active
const navbarNav = document.querySelector(".navbar-nav");
//  ketika hamburger menu di klik
document.querySelector("#hamburger-menu").onclick = () => {
    navbarNav.classList.toggle("active");
};

// klik di luar sidebar untuk menghilangkan nav
const hamburger = document.querySelector("#hamburger-menu");

document.addEventListener("click", function (e) {
    if (!hamburger.contains(e.target) && !navbarNav.contains(e.target)) {
        navbarNav.classList.remove("active");
    }
});
const mainImages = document.querySelectorAll(".default .main-img img");
const thumbnails = document.querySelectorAll(".default .thumb-list div");

let currentImageIndex = 0;

const changeImage = (index, mainImages, thumbnails) => {
    mainImages.forEach((img) => {
        img.classList.remove("active");
    });
    thumbnails.forEach((thumb) => {
        thumb.classList.remove("active");
    });

    mainImages[index].classList.add("active");
    thumbnails[index].classList.add("active");
    currentImageIndex = index;
};

thumbnails.forEach((thumb, index) => {
    thumb.addEventListener("click", () => {
        changeImage(index, mainImages, thumbnails);
    });
});

window.onload = function() {
    const loaderOverlay = document.getElementById('loader-overlay');
    const images = document.querySelectorAll('img'); // Pilih semua elemen gambar
    let loadedImages = 0;

    // Tambahkan event listener 'load' ke semua gambar
    images.forEach((img) => {
        if (img.complete) {
            // Gambar sudah dimuat sebelumnya
            loadedImages++;
        } else {
            // Tambahkan event listener untuk gambar yang belum dimuat
            img.addEventListener('load', () => {
                loadedImages++;
                if (loadedImages === images.length) {
                    hideLoader(loaderOverlay);
                }
            });

            // Tangani kasus gambar gagal dimuat
            img.addEventListener('error', () => {
                loadedImages++;
                if (loadedImages === images.length) {
                    hideLoader(loaderOverlay);
                }
            });
        }
    });

    // Jika semua gambar sudah dimuat sebelumnya
    if (loadedImages === images.length) {
        hideLoader(loaderOverlay);
    }
};

// Fungsi untuk menyembunyikan loader
function hideLoader(loaderOverlay) {
    loaderOverlay.style.opacity = '0';
    setTimeout(() => {
        loaderOverlay.style.display = 'none';
    }, 500); // Tunggu animasi selesai
}
