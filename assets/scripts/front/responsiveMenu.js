'use strict'
const mediaQuery = window.matchMedia("(max-width: 768px")
const disc = document.querySelector('.logo')
const responsiveMenu = document.querySelector('aside')

if(mediaQuery.matches){


    disc.addEventListener("mouseover", ()=> {
        responsiveMenu.classList.remove('responsive_menu')
        responsiveMenu.classList.add('display_responsive')
    })
    console.log(disc)
} else {
    responsiveMenu.classList.remove('display_responsive')
    responsiveMenu.classList.add('responsive_menu')
}




