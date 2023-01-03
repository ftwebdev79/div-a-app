'use strict'
import {tns} from "tiny-slider";


const artistTnsSlider = tns({
        container: ".slider-wrapper-artist",
        items: 6,
        slideBy: 2,
        speed: 400,
        prevButton: ".previous_artist",
        nextButton: ".next_artist",
        nav: false,
        autoHeight: true,
        responsive: {
            340: {
              items: 2
            },
            640: {
                items: 2
            },
            768: {
                items: 3
            },
            1024: {
                items: 6
            }
        }
    }
)

const albumTnsSlider = tns({
        container: ".slider-wrapper-songs",
        items: 6,
        slideBy: 2,
        speed: 400,
        prevButton: ".previous_song",
        nextButton: ".next_song",
        nav: false,
        autoHeight: true,
        responsive: {
           400: {
                items: 2
            },
            900: {
                items: 3
            },
            1024: {
               items: 6
            },
            1670: {
                items: 8
            }
        }

    }
)

// //
// // const sliderElement = document.querySelector('.slider-wrapper-artist');
// // const slides = document.querySelectorAll('.item');
// // const nextButton = document.querySelector('.next');
// // const prevButton = document.querySelector('.previous');
// //
// // console.log(slides)
// //
// // let currentIndex = 0;
// // const MAX_SLIDES = 8;
// // // const SLIDES_PER_PAGE = 4;
// //
// // function updateSlides() {
// //     // // Hide all slides
// //     // slides.forEach(slide => {
// //     //     slide.style.display = 'none';
// //     // });
// //     //
// //     // // Show the current page of slides
// //     // for (let i = currentIndex; i < currentIndex + SLIDES_PER_PAGE; i++) {
// //     //     slides[i].style.display = 'block';
// //     // }
// //     sliderElement.scrollLeft = currentIndex * 100;
// // }
// //
// // function nextPage() {
// //     // currentIndex += SLIDES_PER_PAGE;
// //     // if (currentIndex >= MAX_SLIDES) {
// //     //     currentIndex = 0;
// //     // }
// //     // updateSlides();
// //     currentIndex += 3;
// //     if (currentIndex >= MAX_SLIDES) {
// //         currentIndex = 0;
// //     }
// //     updateSlides();
// // }
// //
// // function prevPage() {
// //     // currentIndex -= SLIDES_PER_PAGE;
// //     // if (currentIndex < 0) {
// //     //     currentIndex = MAX_SLIDES - SLIDES_PER_PAGE;
// //     // }
// //     // updateSlides();
// //     currentIndex -= 3;
// //     if (currentIndex < 0) {
// //         currentIndex = MAX_SLIDES - 3;
// //     }
// //     updateSlides();
// // }
// //
// // // Initialize the slider
// // updateSlides();
// //
// // // Add event listeners for the next and prev buttons
// // nextButton.addEventListener('click', nextPage);
// // prevButton.addEventListener('click', prevPage);
//
// class Slider {
//     constructor(sliderElement, slides, nextButton, prevButton, maxSlides) {
//         this.sliderElement = sliderElement;
//         this.slides = slides;
//         this.nextButton = nextButton;
//         this.prevButton = prevButton;
//         this.maxSlides = maxSlides;
//         this.currentIndex = 0;
//     }
//
//     updateSlides() {
//         this.sliderElement.scrollLeft = this.currentIndex * 100;
//     }
//
//     nextPage() {
//         this.currentIndex += 3;
//         if (this.currentIndex >= this.maxSlides) {
//             this.currentIndex = 0;
//         }
//         this.updateSlides();
//     }
//
//     prevPage() {
//         this.currentIndex -= 3;
//         if (this.currentIndex < 0) {
//             this.currentIndex = this.maxSlides - 3;
//         }
//         this.updateSlides();
//     }
// }
//
// const slider1 = new Slider(
//     document.querySelector('.slider-wrapper-artist'),
//     document.querySelectorAll('.item'),
//     document.querySelector('.next'),
//     document.querySelector('.previous'),
//     12
// );
//
// slider1.updateSlides();
// slider1.nextButton.addEventListener('click', slider1.nextPage.bind(slider1));
// slider1.prevButton.addEventListener('click', slider1.prevPage.bind(slider1));
//
// const slider2 = new Slider(
//     document.querySelector('.slider-wrapper-songs'),
//     document.querySelectorAll('.item'),
//     document.querySelector('.next_song'),
//     document.querySelector('.previous_song'),
//     8
// );
//
// slider2.updateSlides();
// slider2.nextButton.addEventListener('click', slider2.nextPage.bind(slider2));
// slider2.prevButton.addEventListener('click', slider2.prevPage.bind(slider2));