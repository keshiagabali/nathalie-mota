document.addEventListener('DOMContentLoaded', function() {

    // BURGER MENU

    $('#open-fullscreen-menu-button').click(function(e) {
        e.stopPropagation(); 
        $('header').toggleClass('mobile-menu-opened');
        console.log('BOUTON CLIQUÉ!');
    });

    $('#close-fullscreen-menu-button').click(function() {
        $('header').removeClass('mobile-menu-opened');
        console.log('MENU FERMÉ!');
    });

    $(document).click(function(event) {
        if (!$('header').has(event.target).length && !$('header').is(event.target)) {
            $('header').removeClass('mobile-menu-opened');
        }
    });

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
    if (jQuery('#myBtn-photo').length) {

        var photoModal = document.getElementById('myModal-photo');
        var photoBtn = document.getElementById("myBtn-photo");
        var photoSpan = document.getElementsByClassName("close-photo")[0];
        var referenceInput = photoModal.querySelector('input[name="your-subject"]');


        photoBtn.onclick = function() {
            photoModal.style.display = "block";
        
        var referenceText = this.getAttribute('data-reference');
        if (referenceInput) {
            referenceInput.value = referenceText;
            }   
        }

        photoSpan.onclick = function() {
            photoModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == photoModal) {
                photoModal.style.display = "none";
            }
        }
    }

    // PHOTO NAV SINGLE

        if ($('.right-container').length) {
            const wrapper = document.querySelector('.thumbnail-wrapper');
            const prevArrowLink = document.getElementById('prev-arrow-link');
            const nextArrowLink = document.getElementById('next-arrow-link');

            const currentThumbnailURL = document.querySelector('.right-container a.photo img').getAttribute('src');
            const currentThumbnailPreloader = new Image();

            currentThumbnailPreloader.src = currentThumbnailURL;
            currentThumbnailPreloader.onload = function () {
                preloadCurrentThumbnail(currentThumbnailURL);
            };

            function loadThumbnail(thumbnailURL) {
                const thumbnail = document.createElement('img');
                thumbnail.src = thumbnailURL;

                while (wrapper.firstChild) {
                    wrapper.removeChild(wrapper.firstChild);
                }

                wrapper.appendChild(thumbnail);
            }

            function preloadCurrentThumbnail(thumbnailURL) {
                loadThumbnail(thumbnailURL);
            }

            function handleMouseover(direction) {
                const arrowLink = (direction === 'prev') ? prevArrowLink : nextArrowLink;
                const thumbnailURL = arrowLink.getAttribute('data-thumbnail');
                loadThumbnail(thumbnailURL);
            }

            function handleMouseout() {
                preloadCurrentThumbnail(currentThumbnailURL);
            }

            window.addEventListener('load', () => preloadCurrentThumbnail(currentThumbnailURL));

            prevArrowLink.addEventListener('mouseover', () => handleMouseover('prev'));
            nextArrowLink.addEventListener('mouseover', () => handleMouseover('next'));
            prevArrowLink.addEventListener('mouseout', handleMouseout);
            nextArrowLink.addEventListener('mouseout', handleMouseout);
        }    
    
    // LOAD MORE 

    jQuery(document).ready(function($) {
        var page = 1;

        $('#load-more-posts').on('click', function() {
            page++;
            loadMorePosts(page);
        });

        function loadMorePosts(pageNumber) {
            var ajaxurl = $('#load-more-posts').data('ajaxurl');            
            var nonce = $('#load-more-posts').data('nonce');

            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'load_more_posts',
                    page: pageNumber,
                    security: nonce
                },
                success: function(data) {
                    if (data) {
                        $('.thumbnail-container-accueil').append(data);
                    } else {
                        $('#load-more-posts').text('Aucune photo supplémentaire à charger');
                    }
                }
            });
        }
    });

    // LIGHTBOX

    $(document).ready(function() {
        var currentIndex = 0;
        var images = $('.fullscreen-icon').map(function() {
            return {
                src: $(this).data('src'),
                reference: $(this).siblings('.photo-info').find('.photo-info-left p').text(),
                category: $(this).siblings('.photo-info').find('.photo-info-right p').text()
            };
        }).get();
    
        function updateLightbox(index) {
            currentIndex = ((index % images.length) + images.length) % images.length;
            var imageData = images[currentIndex];
    
            $('#myLightbox .lightbox__container').html('<img src="' + imageData.src + '">');
            $('#myLightbox .photo-info-left-lightbox').html('<p>' + imageData.reference + '</p>');
            $('#myLightbox .photo-info-right-lightbox').html('<p>' + imageData.category + '</p>');
        }
    
        $('.fullscreen-icon').click(function(event) {
            event.preventDefault(); 
            event.stopPropagation();
            
            currentIndex = $('.fullscreen-icon').index(this); 
            updateLightbox(currentIndex); 
            
            $('#myLightbox').css('display', 'block');
        });
    
        $('.lightbox__close').click(function() {
            $('#myLightbox').css('display', 'none');
        });
    
        $('.lightbox__prev').click(function(event) {
            event.preventDefault();
            updateLightbox(currentIndex - 1); 
        });
    
        $('.lightbox__next').click(function(event) {
            event.preventDefault();
            updateLightbox(currentIndex + 1); 
        });
        
    });
});


