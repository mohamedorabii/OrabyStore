(function ($) {
    "use strict";

    document.querySelectorAll(".search-wrapper[data-live-search-url]").forEach(function (wrapper) {
        const input = wrapper.querySelector("#live-search-input");
        const dropdown = wrapper.querySelector("#search-dropdown");
        const results = wrapper.querySelector("#search-results");
        const allLink = wrapper.querySelector("#search-all-link");
        const allDiv = wrapper.querySelector("#search-all");

        if (!input || !dropdown || !results || !allLink || !allDiv) {
            return;
        }

        const liveSearchUrl = wrapper.dataset.liveSearchUrl || "/search/live";
        const searchUrl = wrapper.dataset.searchUrl || "/search";
        let timeout = null;

        function hideDropdown() {
            dropdown.style.display = "none";
        }

        function showDropdown() {
            dropdown.style.display = "block";
        }

        input.addEventListener("input", function () {
            clearTimeout(timeout);
            const query = this.value.trim();

            if (query.length < 2) {
                results.innerHTML = "";
                hideDropdown();
                return;
            }

            timeout = setTimeout(function () {
                fetch(`${liveSearchUrl}?q=${encodeURIComponent(query)}`)
                    .then((response) => response.json())
                    .then((data) => {
                        let html = "";

                        if (data.products && data.products.length > 0) {
                            html += `<div class="search-section-title">Products</div>`;
                            data.products.forEach((product) => {
                                html += `
                                    <a href="${product.url}" class="search-item">
                                        <img src="${product.image}" alt="${product.name}" />
                                        <div class="search-item-info">
                                            <h6>${product.name}</h6>
                                            <span>$${product.price}</span>
                                        </div>
                                    </a>`;
                            });
                        }

                        if (data.categories && data.categories.length > 0) {
                            html += `<div class="search-section-title">Categories</div>`;
                            data.categories.forEach((category) => {
                                html += `<a href="${category.url}" class="search-text-item">${category.name}</a>`;
                            });
                        }

                        if (data.brands && data.brands.length > 0) {
                            html += `<div class="search-section-title">Brands</div>`;
                            data.brands.forEach((brand) => {
                                html += `<a href="${brand.url}" class="search-text-item">${brand.name}</a>`;
                            });
                        }

                        if (html === "") {
                            html = `<div class="search-no-results">No results found</div>`;
                            allDiv.style.display = "none";
                        } else {
                            allDiv.style.display = "block";
                            allLink.href = `${searchUrl}?q=${encodeURIComponent(query)}`;
                        }

                        results.innerHTML = html;
                        showDropdown();
                    })
                    .catch(function () {
                        results.innerHTML = `<div class="search-no-results">Search is temporarily unavailable</div>`;
                        allDiv.style.display = "none";
                        showDropdown();
                    });
            }, 250);
        });

        document.addEventListener("click", function (event) {
            if (!wrapper.contains(event.target)) {
                hideDropdown();
            }
        });

        input.addEventListener("focus", function () {
            if (results.innerHTML.trim()) {
                showDropdown();
            }
        });

        input.addEventListener("keydown", function (event) {
            if (event.key === "Enter" && this.value.trim()) {
                event.preventDefault();
                window.location.href = `${searchUrl}?q=${encodeURIComponent(this.value.trim())}`;
            }
        });
    });

    $(document).ready(function ($) {
        // testimonial sliders
        $(".testimonial-sliders").owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            responsive: {
                0: {
                    items: 1,
                    nav: false,
                },
                600: {
                    items: 1,
                    nav: false,
                },
                1000: {
                    items: 1,
                    nav: false,
                    loop: true,
                },
            },
        });

        // homepage slider
        $(".homepage-slider").owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            nav: true,
            dots: false,
            navText: [
                '<i class="fas fa-angle-left"></i>',
                '<i class="fas fa-angle-right"></i>',
            ],
            responsive: {
                0: {
                    items: 1,
                    nav: false,
                    loop: true,
                },
                600: {
                    items: 1,
                    nav: true,
                    loop: true,
                },
                1000: {
                    items: 1,
                    nav: true,
                    loop: true,
                },
            },
        });

        // logo carousel
        $(".logo-carousel-inner").owlCarousel({
            items: 4,
            loop: true,
            autoplay: true,
            margin: 30,
            responsive: {
                0: {
                    items: 1,
                    nav: false,
                },
                600: {
                    items: 3,
                    nav: false,
                },
                1000: {
                    items: 4,
                    nav: false,
                    loop: true,
                },
            },
        });

        // count down
        if ($(".time-countdown").length) {
            $(".time-countdown").each(function () {
                var $this = $(this),
                    finalDate = $(this).data("countdown");
                $this.countdown(finalDate, function (event) {
                    var $this = $(this).html(
                        event.strftime(
                            "" +
                                '<div class="counter-column"><div class="inner"><span class="count">%D</span>Days</div></div> ' +
                                '<div class="counter-column"><div class="inner"><span class="count">%H</span>Hours</div></div>  ' +
                                '<div class="counter-column"><div class="inner"><span class="count">%M</span>Mins</div></div>  ' +
                                '<div class="counter-column"><div class="inner"><span class="count">%S</span>Secs</div></div>',
                        ),
                    );
                });
            });
        }

        // projects filters isotop
        $(".product-filters li").on("click", function () {
            $(".product-filters li").removeClass("active");
            $(this).addClass("active");

            var selector = $(this).attr("data-filter");

            $(".product-lists").isotope({
                filter: selector,
            });
        });

        // isotop inner
        $(".product-lists").isotope();

        // magnific popup
        $(".popup-youtube").magnificPopup({
            disableOn: 700,
            type: "iframe",
            mainClass: "mfp-fade",
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false,
        });

        // light box
        $(".image-popup-vertical-fit").magnificPopup({
            type: "image",
            closeOnContentClick: true,
            mainClass: "mfp-img-mobile",
            image: {
                verticalFit: true,
            },
        });

        // homepage slides animations
        $(".homepage-slider").on("translate.owl.carousel", function () {
            $(".hero-text-tablecell .subtitle")
                .removeClass("animated fadeInUp")
                .css({ opacity: "0" });
            $(".hero-text-tablecell h1")
                .removeClass("animated fadeInUp")
                .css({ opacity: "0", "animation-delay": "0.3s" });
            $(".hero-btns")
                .removeClass("animated fadeInUp")
                .css({ opacity: "0", "animation-delay": "0.5s" });
        });

        $(".homepage-slider").on("translated.owl.carousel", function () {
            $(".hero-text-tablecell .subtitle")
                .addClass("animated fadeInUp")
                .css({ opacity: "0" });
            $(".hero-text-tablecell h1")
                .addClass("animated fadeInUp")
                .css({ opacity: "0", "animation-delay": "0.3s" });
            $(".hero-btns")
                .addClass("animated fadeInUp")
                .css({ opacity: "0", "animation-delay": "0.5s" });
        });

        // stikcy js
        $("#sticker").sticky({
            topSpacing: 0,
        });

        //mean menu
        $(".main-menu").meanmenu({
            meanMenuContainer: ".mobile-menu",
            meanScreenWidth: "992",
        });

        // search form
        $(".search-bar-icon").on("click", function () {
            $(".search-area").addClass("search-active");
        });

        $(".close-btn").on("click", function () {
            $(".search-area").removeClass("search-active");
        });

    });

    jQuery(window).on("load", function () {
        jQuery(".loader").fadeOut(1000);
    });
})(jQuery);
