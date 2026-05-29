// Gallery Page - Scroll to Top Button
window.onscroll = function () {
    let button = document.querySelector('.scrollToTopBtn');
    let scrollPosition = document.documentElement.scrollTop || document.body.scrollTop;

    let triggerScrollPosition = 200;

    if (scrollPosition > triggerScrollPosition) {
        button.style.display = "block";
    } else {
        button.style.display = "none";
    }
};

// Gallery Page - Smooth Scroll
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' 
    });
}

// About Page - Banner Carousel
if (document.querySelector('.bannerPicCar')) {
    let currentIndex = 0;
    const images = document.querySelectorAll('.bannerPicCar');
    const dots = document.querySelectorAll('.dot');
    const totalImages = images.length;

    function showImage(index) {
        images.forEach((img, i) => {
            img.style.display = (i === index) ? 'block' : 'none';
        });

        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });
    }

    function nextImage() {
        currentIndex = (currentIndex + 1) % totalImages;
        showImage(currentIndex);
    }

    function prevImage() {
        currentIndex = (currentIndex - 1 + totalImages) % totalImages;
        showImage(currentIndex);
    }

    showImage(currentIndex);
    setInterval(nextImage, 3000);

    const arrow = document.querySelector('.arrowAbout');
    if (arrow) {
        arrow.addEventListener('click', nextImage);
    }

    dots.forEach((dot, i) => {
        dot.addEventListener('click', () => {
            currentIndex = i;
            showImage(currentIndex);
        });
    });
}

//About us - Read More btn
document.addEventListener('DOMContentLoaded', function() {
    const readMoreBtn = document.getElementById('readMoreBtn');
    const moreText = document.getElementById('moreText');

    // Initially, the 'moreText' span is hidden
    if (readMoreBtn) {
        readMoreBtn.addEventListener('click', function() {
            // Toggle visibility of the additional text
            if (moreText.style.display === "none") {
                moreText.style.display = "inline";  
                readMoreBtn.textContent = "Hide";
            } else {
                moreText.style.display = "none"; // Hide the extra text
                readMoreBtn.textContent = "Read More";
            }
        });
    }
});


// Gallery Page - View More Button and Image Popup
if (document.querySelector('.galleryAlbum')) {
    const viewMoreButton = document.querySelector('.viewMoreBut');
    const extraImages = document.querySelector('.galleryAlbumExtra');
const closeBtn = document.querySelector('.imageClicked .closeBtn');
if (closeBtn) {
    closeBtn.addEventListener('click', () => {
        const popup = document.querySelector('.imageClicked');
        if (popup) popup.style.display = 'none';
    });
}
    if (viewMoreButton && extraImages) {
        viewMoreButton.addEventListener('click', () => {
            const isVisible = extraImages.style.display === 'block';
            extraImages.style.display = isVisible ? 'none' : 'block';
            viewMoreButton.innerText = isVisible ? 'View More' : 'View Less';
        });
    }

    document.querySelectorAll('.galleryAlbum img').forEach(image => {
        image.onclick = () => {
            const popup = document.querySelector('.imageClicked');
            if (popup) {
                popup.style.display = 'flex';
                popup.querySelector('img').src = image.src;
            }
        };
    });

    const popupImage = document.querySelector('.imageClicked');
    if (popupImage) {
        popupImage.addEventListener('click', (e) => {
            if (e.target === popupImage) {
                popupImage.style.display = 'none';
            }
        });
    }
}

// Menu Page - Slide Show for Categories
if (document.querySelector('.menuItemSlide')) {
    function setupSlides(sectionClass) {
        const slides = document.querySelectorAll(`.${sectionClass} .menuItemSlide`);
        const leftArrow = document.querySelector(`.${sectionClass} .leftArrow`);
        const rightArrow = document.querySelector(`.${sectionClass} .rightArrow`);
        let currentSlide = 0;

        if (!slides.length || !leftArrow || !rightArrow) return;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
            });
        }

        leftArrow.addEventListener('click', () => {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        });

        rightArrow.addEventListener('click', () => {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        });

        showSlide(currentSlide);
    }

    // Set up the slides for each category
    setupSlides('coldDrinkCat');
    setupSlides('hotDrinkCat');
    setupSlides('mealSetsCat');
    setupSlides('menuPromoBox');
    setupSlides('menuBestSellerBox');
}

// Menu Page - Search Function
/*const searchInput = document.querySelector('.searchInput');
const menuSlides = document.querySelectorAll('.menuItemSlide');

searchInput.addEventListener('input', () => {
    const query = searchInput.value.toLowerCase().trim();

    menuSlides.forEach(slide => {
        const menuItems = slide.querySelectorAll('.menuItem');
        let matchCount = 0;

        menuItems.forEach(item => {
            const name = item.querySelector('.menuName').textContent.toLowerCase();

            if (query && name.includes(query)) {
                item.style.display = 'flex';
                matchCount++;
            } else {
                item.style.display = 'none';
            }
        });
        slide.style.display = matchCount > 0 ? 'flex' : 'none';
    });
});
*/
// Hamburger Menu - Toggle Navigation Links
const hamburger = document.querySelector(".hamburger");
const navLinks = document.querySelector(".navLink");
const overlay = document.querySelector('.navOverlay');

if (hamburger && navLinks && overlay) {
    hamburger.addEventListener("click", function () {
        navLinks.classList.toggle("active");
        hamburger.classList.toggle("active");
        overlay.classList.toggle('active');
    });

    const navItems = document.querySelectorAll(".navLink a");
    navItems.forEach(link => {
        link.addEventListener("click", () => {
            navLinks.classList.remove("active");
            hamburger.classList.remove("active");
            overlay.classList.remove('active');
        });
    });
}

/* Previous Star Rating Code - Using data-value attribute for db or review.php

// Review Section - Star Rating
const starContainer = document.getElementById("starRating");
const stars = starContainer.querySelectorAll("label");
let selectedRating = 0;

stars.forEach((star) => {
    const rating = parseInt(star.getAttribute("data-value"));

    star.addEventListener("mouseover", () => {
        highlightStars(rating);
    });

    star.addEventListener("mouseout", () => {
        highlightStars(selectedRating);
    });

    star.addEventListener("click", () => {
        selectedRating = rating;
        highlightStars(rating);
        document.querySelector(`input#star${rating}`).checked = true;
    });
});

*/

// Review Section - Star Rating
const starContainer = document.querySelector(".starRating");

if (starContainer) {
    const stars = starContainer.querySelectorAll("label");
    let selectedRating = 0;

    stars.forEach((star) => {
        const rating = parseInt(star.getAttribute("for").replace("star", ""));

        star.addEventListener("mouseover", () => {
            highlightStars(rating);
        });

        star.addEventListener("mouseout", () => {
            highlightStars(selectedRating);
        });

        star.addEventListener("click", () => {
            selectedRating = rating;
            highlightStars(rating);
            document.querySelector(`#star${rating}`).checked = true;
        });
    });

    function highlightStars(rating) {
        stars.forEach((star) => {
            const current = parseInt(star.getAttribute("for").replace("star", ""));
            star.style.color = current <= rating ? "#D2BC72" : "#E6E6E6";
        });
    }
}

function highlightStars(rating) {
    stars.forEach((star) => {
        const current = parseInt(star.getAttribute("data-value"));
        star.style.color = current <= rating ? "#D2BC72" : "#E6E6E6";
    });
}

// Review Section - Review Slides
if (document.querySelector('.reviewSlidesWrapper')) {
    const slides = document.querySelectorAll('.reviewSlidesWrapper .slide');
    const prevBtn = document.querySelector('.reviewPrevBtn');
    const nextBtn = document.querySelector('.reviewNextBtn');
    let currentSlide = 0;

    if (slides.length && prevBtn && nextBtn) {
        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
            });
        }

        prevBtn.addEventListener('click', () => {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        });

        nextBtn.addEventListener('click', () => {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        });

        showSlide(currentSlide);
    }
}
