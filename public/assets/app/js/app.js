document.addEventListener("DOMContentLoaded", function (event) {

    const showNavbar = (toggleId, navId, bodyId, headerId) => {
        const toggle = document.getElementById(toggleId),
            nav = document.getElementById(navId),
            bodypd = document.getElementById(bodyId),
            headerpd = document.getElementById(headerId),
            closeNav = document.getElementById('close-nav')

        // Validate that all variables exist
        if (toggle && nav && bodypd && headerpd) {
            toggle.addEventListener('click', () => {
                // show navbar
                nav.classList.toggle('show')
                // change icon
                toggle.classList.toggle('bx-x')
                // add padding to body
                bodypd.classList.toggle('body-pd')
                // add padding to header
                headerpd.classList.toggle('body-pd')
                
                closeNav.classList.toggle('showCloseNav')
            })
        }
    }

    showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

    /*===== LINK ACTIVE =====*/
    const linkColor = document.querySelectorAll('.nav_link')

    function colorLink() {
        if (linkColor) {
            linkColor.forEach(l => l.classList.remove('active'))
            this.classList.add('active')
        }
    }
    linkColor.forEach(l => l.addEventListener('click', colorLink))

    // Your code to run since DOM is loaded and ready

    
    window.addEventListener('click', (e) => {
       
        if(e.target.id == 'close-nav'){
            // close navbar 
            const nav = document.getElementById('nav-bar')
            const toggle = document.getElementById('header-toggle')
            const bodypd = document.getElementById('body-pd')
            const headerpd = document.getElementById('header')
            nav.classList.toggle('show')
            toggle.classList.toggle('bx-x')
            bodypd.classList.toggle('body-pd')
            headerpd.classList.toggle('body-pd')
            e.target.classList.toggle('showCloseNav')
        }
    });

});

