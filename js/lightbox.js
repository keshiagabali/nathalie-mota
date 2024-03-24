document.addEventListener('DOMContentLoaded', function() {

    var lightboxModal = document.getElementById('myLightbox');
    var lightboxBtn = document.getElementById("open-lightbox-button");
    var lightboxSpan = document.getElementsByClassName("lightbox__close")[0];

    lightboxBtn.onclick = function() {
        lightboxModal.style.display = "block";
    }

    lightboxSpan.onclick = function() {
        lightboxModal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == lightboxModal) {
            lightboxModal.style.display = "none";
        }
    }
});

