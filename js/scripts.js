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

// PHOTO NAV SINGLE
function loadThumbnail(direction) {
    
    var wrapper = document.querySelector('.thumbnail-wrapper');

    var thumbnail = document.createElement('img');

    var arrowLink = (direction === 'prev') ? document.getElementById('prev-arrow-link') : document.getElementById('next-arrow-link');

    var thumbnailURL = arrowLink.getAttribute('data-thumbnail');

    thumbnail.src = thumbnailURL;

    console.log('URL de la miniature :', thumbnail.src);

    while (wrapper.firstChild) {
        wrapper.removeChild(wrapper.firstChild);
    }

    wrapper.appendChild(thumbnail);
}

function hideThumbnail() {
    var wrapper = document.querySelector('.thumbnail-wrapper');

    while (wrapper.firstChild) {
        wrapper.removeChild(wrapper.firstChild);
    }
}

var prevArrowLink = document.getElementById('prev-arrow-link');
var nextArrowLink = document.getElementById('next-arrow-link');

prevArrowLink.addEventListener('mouseover', function () {
    loadThumbnail('prev');
});

prevArrowLink.addEventListener('mouseout', function () {
    hideThumbnail();
});

nextArrowLink.addEventListener('mouseover', function () {
    loadThumbnail('next');
});

nextArrowLink.addEventListener('mouseout', function () {
    hideThumbnail();
});

// REF CONTACT FORM 7
jQuery(document).ready(function($) {
    $("#réf.photo").val(acfReferencePhoto);
});

// PAGINATION

jQuery(function ($) {
    var page = 2; 
    var loading = false; 
    var $loadMoreButton = $('#load-more-posts'); 
    var $container = $('.thumbnail-container-accueil');  

    $loadMoreButton.on('click', function () {
        if (!loading) {
            loading = true;
            $loadMoreButton.text('Chargement en cours...'); 

            $.ajax({
                type: 'POST',
                url: wp_data.ajax_url, 
                data: {
                    action: 'load_more_posts',
                    page: page,
                },
                success: function (response) {
                    if (response) {
                        $container.append(response); 
                        $loadMoreButton.text('Charger plus');
                        page++; 
                        loading = false; 
                    } else {
                        $loadMoreButton.text('Fin des publications'); 
                    }
                },
            });
        }
    });
});
