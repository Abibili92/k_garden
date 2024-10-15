let currentImageIndex = 0;
const images = ["img/a.jpg", "img/b.jpg", "img/c.jpg"];
const imageElement = document.getElementById("image");
const intervalTime = 3000;

function changeImage() {
    currentImageIndex = (currentImageIndex + 1) % images.length;
    imageElement.src = images[currentImageIndex];
}

setInterval(changeImage, intervalTime);
