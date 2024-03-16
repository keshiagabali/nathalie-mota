// MODAL HEADER

var headerModal = document.getElementById('myModal');
var headerBtn = document.getElementById("open-modal-button-header");
var headerSpan = document.getElementsByClassName("close")[0];

headerBtn.onclick = function() {
    headerModal.style.display = "block";
}

headerSpan.onclick = function() {
    headerModal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == headerModal) {
        headerModal.style.display = "none";
    }
}

// MODAL SINGLE
var photoModal = document.getElementById('myModal');
var photoBtn = document.getElementById("myBtn-photo");
var photoSpan = document.getElementsByClassName("close-photo")[0];

photoBtn.onclick = function() {
    photoModal.style.display = "block";
}

photoSpan.onclick = function() {
    photoModal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == photoModal) {
        photoModal.style.display = "none";
    }
}

// REF CONTACT FORM 7
jQuery(document).ready(function($) {
    $("#réf.photo").val(acfReferencePhoto);
});