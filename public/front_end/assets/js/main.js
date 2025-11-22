/*
Template Name: Appvilla - Creative Landing Page HTML Template.
Author: GrayGrids
*/

(function () {
    //===== Prealoder

    window.onload = function () {
        window.setTimeout(fadeout, 500);
    };

    function fadeout() {
        document.querySelector(".preloader").style.opacity = "0";
        document.querySelector(".preloader").style.display = "none";
    }

    /*=====================================
    Sticky
    ======================================= */
    window.onscroll = function () {
        var header_navbar = document.querySelector(".navbar-area");
        var sticky = header_navbar.offsetTop;

        var logo = document.querySelector(".navbar-brand img");
        if (window.pageYOffset > sticky) {
            header_navbar.classList.add("sticky");
            logo.src = "assets/images/logo/logo.svg";
        } else {
            header_navbar.classList.remove("sticky");
            logo.src = "assets/images/logo/white-logo.svg";
        }

        // show or hide the back-top-top button
        var backToTo = document.querySelector(".scroll-top");
        if (
            document.body.scrollTop > 50 ||
            document.documentElement.scrollTop > 50
        ) {
            backToTo.style.display = "flex";
        } else {
            backToTo.style.display = "none";
        }
    };

    // section menu active
    function onScroll(event) {
        var sections = document.querySelectorAll(".page-scroll");
        var scrollPos =
            window.pageYOffset ||
            document.documentElement.scrollTop ||
            document.body.scrollTop;

        for (var i = 0; i < sections.length; i++) {
            var currLink = sections[i];
            var val = currLink.getAttribute("href");
            var refElement = document.querySelector(val);
            var scrollTopMinus = scrollPos + 73;
            if (
                refElement.offsetTop <= scrollTopMinus &&
                refElement.offsetTop + refElement.offsetHeight > scrollTopMinus
            ) {
                document
                    .querySelector(".page-scroll")
                    .classList.remove("active");
                currLink.classList.add("active");
            } else {
                currLink.classList.remove("active");
            }
        }
    }

    window.document.addEventListener("scroll", onScroll);

    // for menu scroll
    var pageLink = document.querySelectorAll(".page-scroll");

    pageLink.forEach((elem) => {
        elem.addEventListener("click", (e) => {
            e.preventDefault();
            document.querySelector(elem.getAttribute("href")).scrollIntoView({
                behavior: "smooth",
                offsetTop: 1 - 60,
            });
        });
    });

    // WOW active
    new WOW().init();

    let filterButtons = document.querySelectorAll(
        ".portfolio-btn-wrapper button"
    );
    filterButtons.forEach((e) =>
        e.addEventListener("click", () => {
            let filterValue = event.target.getAttribute("data-filter");
            iso.arrange({
                filter: filterValue,
            });
        })
    );

    var elements = document.getElementsByClassName("portfolio-btn");
    for (var i = 0; i < elements.length; i++) {
        elements[i].onclick = function () {
            var el = elements[0];
            while (el) {
                if (el.tagName === "BUTTON") {
                    el.classList.remove("active");
                }
                el = el.nextSibling;
            }
            this.classList.add("active");
        };
    }

    //===== mobile-menu-btn
    let navbarToggler = document.querySelector(".mobile-menu-btn");
    navbarToggler.addEventListener("click", function () {
        navbarToggler.classList.toggle("active");
    });
})();

// section 1
// ==== Deteksi saat gambar muncul di layar ====
const image = document.querySelector(".responsive-image");
const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.classList.add("animate");
            observer.unobserve(entry.target);
        }
    });
});
observer.observe(image);

// SECTION 4
document.addEventListener("DOMContentLoaded", () => {
    // === Count Up Animation ===
    const counters = document.querySelectorAll(".counter");
    const speed = 100;
    const animateCounters = () => {
        counters.forEach((counter) => {
            const updateCount = () => {
                const target = +counter.getAttribute("data-target");
                const count = +counter.innerText;
                const increment = target / speed;

                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(updateCount, 30);
                } else {
                    counter.innerText = target;
                }
            };
            updateCount();
        });
    };

    const observer = new IntersectionObserver(
        (entries, obs) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    animateCounters();
                    obs.disconnect();
                }
            });
        },
        { threshold: 0.3 }
    );

    observer.observe(document.querySelector(".counter"));

    // === Vehicle ↔ Electric Toggle ===
    const btnVehicle = document.getElementById("btn-vehicle");
    const btnElectric = document.getElementById("btn-electric");
    const vehicleLogos = document.getElementById("vehicle-logos");
    const electricLogos = document.getElementById("electric-logos");

    btnVehicle.addEventListener("click", (e) => {
        e.preventDefault();
        vehicleLogos.classList.remove("d-none");
        electricLogos.classList.add("d-none");
        btnVehicle.classList.add("active-link");
        btnElectric.classList.remove("active-link");
        btnElectric.classList.add("text-muted");
    });

    btnElectric.addEventListener("click", (e) => {
        e.preventDefault();
        electricLogos.classList.remove("d-none");
        vehicleLogos.classList.add("d-none");
        btnElectric.classList.add("active-link");
        btnVehicle.classList.remove("active-link");
        btnVehicle.classList.add("text-muted");
    });
});

// SECTION 5
document.getElementById("scrollLeft").addEventListener("click", () => {
    document
        .getElementById("vehicle-scroll")
        .scrollBy({ left: -300, behavior: "smooth" });
});
document.getElementById("scrollRight").addEventListener("click", () => {
    document
        .getElementById("vehicle-scroll")
        .scrollBy({ left: 300, behavior: "smooth" });
});
