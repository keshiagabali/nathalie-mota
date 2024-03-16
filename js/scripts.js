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
if( jQuery('#myBtn-photo').length ){

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
    jQuery(document).ready(function($) {
        $("#ref-photo").val(acfReferencePhoto);
    });
}

// PHOTO NAV SINGLE

if( $('.right-container').length ){
    const wrapper = document.querySelector('.thumbnail-wrapper');
    const prevArrowLink = document.getElementById('prev-arrow-link');
    const nextArrowLink = document.getElementById('next-arrow-link');

    const currentThumbnailPreloader = new Image();
    const currentThumbnailURL = document.querySelector('.right-container a.photo img').getAttribute('src');
    currentThumbnailPreloader.src = currentThumbnailURL;
    currentThumbnailPreloader.onload = function () {
        preloadCurrentThumbnail(); 
    };

    function loadThumbnail(thumbnailURL) {
        const thumbnail = document.createElement('img');
        thumbnail.src = thumbnailURL;

        while (wrapper.firstChild) {
            wrapper.removeChild(wrapper.firstChild);
        }

        wrapper.appendChild(thumbnail);
}

function preloadCurrentThumbnail() {
    loadThumbnail(currentThumbnailURL);
}

function handleMouseover(direction) {
    const arrowLink = (direction === 'prev') ? prevArrowLink : nextArrowLink;
    const thumbnailURL = arrowLink.getAttribute('data-thumbnail');
    loadThumbnail(thumbnailURL);
}

function handleMouseout() {
    preloadCurrentThumbnail();
}
window.addEventListener('load', preloadCurrentThumbnail);

prevArrowLink.addEventListener('mouseover', () => handleMouseover('prev'));
    nextArrowLink.addEventListener('mouseover', () => handleMouseover('next'));
    prevArrowLink.addEventListener('mouseout', handleMouseout);
    nextArrowLink.addEventListener('mouseout', handleMouseout);
}

// REF CONTACT FORM 7
jQuery(document).ready(function($) {
    $("#réf.photo").val(acfReferencePhoto);
});

// PAGINATION FILTRE

let loading = false; 
const $loadMoreButton = $('#load-more-posts'); 
const $container = $('.thumbnail-container-accueil'); 

$loadMoreButton.on('click', function () {
    get_more_posts(true) 
});

function get_more_posts(load) {
    let inputPage = $('input[name="page"]');
    let page = parseInt(inputPage.val());
    page = load ? page + 1 : 1; 
    const category = $('select[name="category-filter"]').val();
    const format = $('select[name="format-filter"]').val();
    const dateSort = $('select[name="date-sort"]').val();

    console.log(category, format, dateSort, page);

    $.ajax({
        type: 'GET',
        url: wp_data.ajax_url, 
        data: {
            action: 'load_more_posts',
            page,
            category,
            format,
            dateSort
        },
        success: function (response) {
            if (response) {
                if (load) {
                    $container.append(response); 
                } else {
                    $container.html(response);  
                }
                $loadMoreButton.text('Charger plus'); 
                inputPage.val(page); 
                loading = false; 
            } else {
                if (load) {
                    $loadMoreButton.text('Fin des publications'); 
                } else {
                    let txt = '<div style="text-align:center;width:100%; color: #000;font-family: Space Mono, monospace;font-size: 16px;"><p>Aucun résultat ne correspond aux filtres de recherche.<br>';
                    $container.html(txt); 
                }
            }
        },
    });
    if (!loading) {
        loading = true;
        $loadMoreButton.text('Chargement en cours...'); 
    }
}

function recursive_change(selectId) {
    $('#' + selectId).change(function () {
        get_more_posts(false); 
    });
}

if ($('#category-filter').length) {
    recursive_change('category-filter'); 
}
if ($('#format-filter').length) {
    recursive_change('format-filter'); 
}
if ($('#date-sort').length) {
    recursive_change('date-sort'); 
}

// LIGHTBOX SINGLE

$('.right-container img').click(function(){
    $('.modal-container').addClass('opened');

    const imageSrc = $(this).attr('src');

    const prevArrow = $('#prev-arrow-link').clone();
    const nextArrow = $('#next-arrow-link').clone();

    const reference = $('#ph-reference').text();
    const category = $('#ph-category').text();

    $('#modal-reference').html(reference);
    $('#modal-category').html(category);
    $('.middle-image').attr('src', imageSrc);
    $('.left-arrow').html(prevArrow);
    $('.right-arrow').html(nextArrow);

    const refLeft = $('.left-arrow > a').attr('href');
    const refRight = $('.right-arrow > a').attr('href');

    $('.left-arrow > a').attr('href', refLeft + '?modal=1');
    $('.right-arrow > a').attr('href', refRight + '?modal=1');

    if (!$('.left-arrow > a > span').length) {
        $('.left-arrow > a').append('<span>Précédente</span>');
    }

    if (!$('.right-arrow > a > span').length) {
        $('.right-arrow > a').append('<span>Suivante</span>');
    }
})

$('.btn-close').click(function(e){
    $('.modal-container').removeClass('opened');
})

var queryString = window.location.search;

var searchParams = new URLSearchParams(queryString);

var modal = searchParams.get('modal');

if( modal ){
    $('.right-container img').click();
}
