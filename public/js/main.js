(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($("#spinner").length > 0) {
                $("#spinner").removeClass("show");
            }
        }, 1);
    };
    spinner(0);

    // Initiate the wowjs
    new WOW().init();

    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $(".back-to-top").fadeIn("slow");
        } else {
            $(".back-to-top").fadeOut("slow");
        }
    });
    $(".back-to-top").click(function () {
        $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");
        return false;
    });

    // Modal Video
    $(document).ready(function () {
        var $videoSrc;
        $(".btn-play").click(function () {
            $videoSrc = $(this).data("src");
        });
        console.log($videoSrc);

        $("#videoModal").on("shown.bs.modal", function (e) {
            $("#video").attr(
                "src",
                $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0"
            );
        });

        $("#videoModal").on("hide.bs.modal", function (e) {
            $("#video").attr("src", $videoSrc);
        });
    });

    // Facts counter
    $('[data-toggle="counter-up"]').counterUp({
        delay: 10,
        time: 2000,
    });

    // Testimonial carousel
    $(".testimonial-carousel-1").owlCarousel({
        loop: true,
        dots: false,
        margin: 25,
        autoplay: true,
        slideTransition: "linear",
        autoplayTimeout: 0,
        autoplaySpeed: 10000,
        autoplayHoverPause: false,
        responsive: {
            0: {
                items: 1,
            },
            575: {
                items: 1,
            },
            767: {
                items: 2,
            },
            991: {
                items: 3,
            },
        },
    });

    $(".testimonial-carousel-2").owlCarousel({
        loop: true,
        dots: false,
        rtl: true,
        margin: 25,
        autoplay: true,
        slideTransition: "linear",
        autoplayTimeout: 0,
        autoplaySpeed: 10000,
        autoplayHoverPause: false,
        responsive: {
            0: {
                items: 1,
            },
            575: {
                items: 1,
            },
            767: {
                items: 2,
            },
            991: {
                items: 3,
            },
        },
    });
})(jQuery);

document.addEventListener("DOMContentLoaded", function () {
    let selectedCurrencyText = document.getElementById(
        "selected-currency-text"
    );
    let selectedFlag = document.getElementById("selected-flag");
    let currencyOptions = document.querySelectorAll(".currency-option");

    if (
        !selectedCurrencyText ||
        !selectedFlag ||
        currencyOptions.length === 0
    ) {
        console.error(
            "Dropdown elements not found. Ensure your dropdown exists in the HTML."
        );
        return;
    }

    // Get stored values (default to INR)
    let storedCurrency = localStorage.getItem("selectedCurrency") || "INR";
    let storedFlag =
        localStorage.getItem("selectedFlag") ||
        "{{ asset('img/flags/inr.png') }}";

    // Update UI
    selectedCurrencyText.textContent = storedCurrency;
    selectedFlag.src = storedFlag;

    currencyOptions.forEach((option) => {
        option.addEventListener("click", function (e) {
            e.preventDefault();

            let selectedCurrency = this.getAttribute("data-country");
            let selectedFlagUrl = this.getAttribute("data-flag");

            if (!selectedCurrency || !selectedFlagUrl) {
                console.error("Missing currency or flag attributes.");
                return;
            }

            // Update UI immediately
            selectedCurrencyText.textContent = selectedCurrency;
            selectedFlag.src = selectedFlagUrl;

            // Save in localStorage
            localStorage.setItem("selectedCurrency", selectedCurrency);
            localStorage.setItem("selectedFlag", selectedFlagUrl);

            // Make AJAX request to update session only (DO NOT update user country)
            fetch("{{ route('set.currency') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ currency: selectedCurrency }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        console.log(
                            "Currency updated in session:",
                            selectedCurrency
                        );
                        location.reload(); // Refresh to apply conversion
                    }
                })
                .catch((error) =>
                    console.error("Error updating session:", error)
                );
        });
    });
});
