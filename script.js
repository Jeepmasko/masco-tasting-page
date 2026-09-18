/* =====================================================
   MASCO HOSPITALS JAVASCRIPT
===================================================== */

document.addEventListener("DOMContentLoaded", function () {


    /* =================================================
       MOBILE MENU
    ================================================= */

    const menuToggle =
        document.getElementById("menuToggle");

    const mainNav =
        document.getElementById("mainNav");


    if (menuToggle && mainNav) {

        menuToggle.addEventListener(
            "click",
            function () {

                const isOpen =
                    mainNav.classList.toggle("active");

                menuToggle.setAttribute(
                    "aria-expanded",
                    isOpen
                );


                if (isOpen) {

                    menuToggle.innerHTML =
                        '<i class="fa-solid fa-xmark"></i>';

                } else {

                    menuToggle.innerHTML =
                        '<i class="fa-solid fa-bars"></i>';

                }

            }
        );


        /* CLOSE MENU AFTER CLICKING A LINK */

        const navLinks =
            mainNav.querySelectorAll("a");


        navLinks.forEach(function (link) {

            link.addEventListener(
                "click",
                function () {

                    mainNav.classList.remove(
                        "active"
                    );

                    menuToggle.setAttribute(
                        "aria-expanded",
                        "false"
                    );

                    menuToggle.innerHTML =
                        '<i class="fa-solid fa-bars"></i>';

                }
            );

        });

    }


    /* =================================================
       SEARCH
    ================================================= */

    const searchForm =
        document.getElementById("searchForm");

    const searchInput =
        document.getElementById("searchInput");


    function performSearch() {

        if (!searchInput) {
            return;
        }


        const searchTerm =
            searchInput.value.trim().toLowerCase();


        if (searchTerm === "") {

            alert(
                "Please enter something to search."
            );

            searchInput.focus();

            return;
        }


        const elements =
            document.querySelectorAll(
                "h1, h2, h3, h4, p, li"
            );


        for (const element of elements) {

            const text =
                element.textContent.toLowerCase();


            if (text.includes(searchTerm)) {

                element.scrollIntoView({
                    behavior: "smooth",
                    block: "center"
                });


                element.classList.add(
                    "search-highlight"
                );


                setTimeout(function () {

                    element.classList.remove(
                        "search-highlight"
                    );

                }, 2000);


                return;
            }

        }


        alert(
            "No results found for: " +
            searchInput.value
        );

    }


    if (searchForm) {

        searchForm.addEventListener(
            "submit",
            function (event) {

                event.preventDefault();

                performSearch();

            }
        );

    }


    /* =================================================
       DYNAMIC COPYRIGHT YEAR
    ================================================= */

    const currentYear =
        document.getElementById("currentYear");


    if (currentYear) {

        currentYear.textContent =
            new Date().getFullYear();

    }


    /* =================================================
       FORM STATUS AFTER PHP REDIRECT
    ================================================= */

    const urlParams =
        new URLSearchParams(
            window.location.search
        );

    const status =
        urlParams.get("status");


    if (status === "success") {

        alert(
            "Your request has been sent successfully."
        );

        window.history.replaceState(
            {},
            document.title,
            window.location.pathname
        );

    }


    if (status === "error") {

        alert(
            "Your request could not be sent. Please try again."
        );

        window.history.replaceState(
            {},
            document.title,
            window.location.pathname
        );

    }

});