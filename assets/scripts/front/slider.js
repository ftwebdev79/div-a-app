// 'use strict'
//
// class Slider {
//
//     /**
//      *
//      * @param {HTMLElement} element
//      * @param options
//      */
//     constructor(element, options = {}) {
//         this.element = element,
//             this.options = Object.assign({},
//                 {
//                     slidesToScroll: 1,
//                     slidesVisible: 1
//                 }, options)
//         let children = [].slice.call(element.children)
//         this.currentItem = 0
//
//         this.root = this.createDivWithClass('carousel')
//         this.container = this.createDivWithClass('carousel_container')
//         this.root.appendChild(this.container)
//         this.element.appendChild(this.root)
//         this.items = children.map((child) => {
//             let item = this.createDivWithClass('carousel_item')
//
//             item.appendChild(child)
//             this.container.appendChild(item)
//             return item
//         });
//         this.setStyle();
//         this.createNavigation();
//     }
//
//     setStyle() {
//         let ratio = this.items.length / this.options.slidesVisible
//         this.container.style.width = (ratio * 100) + "%"
//         this.items.forEach(item => item.style.width = ((100 / this.options.slidesVisible) / ratio) + '%')
//     }
//
//     /**
//      *
//      * @param {string} className
//      * @returns {HTMLElement}
//      */
//     createDivWithClass(className) {
//         let div = document.createElement('div')
//         div.setAttribute('class', className)
//         return div
//     }
//
//     createNavigation() {
//         let nextButton = this.createDivWithClass('carousel_next')
//         let prevButton = this.createDivWithClass('carousel_prev')
//         this.root.appendChild(nextButton)
//         this.root.appendChild(prevButton)
//         nextButton.addEventListener('click', this.next.bind(this))
//         prevButton.addEventListener('click', this.next.bind(this))
//     }
//
//     next() {
//         this.goToItem(this.currentItem + this.options.slidesToScroll)
//     }
//
//     prev() {
//         this.goToItem(this.currentItem - this.options.slidesToScroll)
//     }
//
//     /**
//      *
//      * @param {number} index
//      */
//     goToItem(index) {
//         let translateX = index * -100 / this.items.length
//         this.container.style.transform = 'translate3d(' + translateX + ' %, 0, 0)'
//         this.currentItem = index;
//     }
// }
//
// document.addEventListener('DOMContentLoaded', function () {
//     new Slider(
//         document.querySelector('.slider-wrapper-artist'), {
//             'slidesToScroll': 2,
//             'slidesVisible': 5,
//         }
//     )
// })
//
//

class Carousel {
    constructor(element, itemsPerPage) {
        this.element = element;
        this.itemsPerPage = itemsPerPage;
        this.items = element.querySelectorAll('.item');
        this.numPages = Math.ceil(this.items.length / this.itemsPerPage);
        this.currentPage = 0;

        this.prevButton = document.querySelector('.previous');
        this.nextButton = document.querySelector('.next');

        this.init();
    }

    init() {
        this.prevButton.addEventListener('click', () => this.prevPage());
        this.nextButton.addEventListener('click', () => this.nextPage());
    }

    prevPage() {
        this.currentPage = Math.max(0, this.currentPage - 1);
        this.update();
    }

    nextPage() {
        this.currentPage = Math.min(this.numPages - 1, this.currentPage + 1);
        this.update();
    }

    update() {
        for (let i = 0; i < this.items.length; i++) {
            let item = this.items[i];
            let pageStart = this.currentPage * this.itemsPerPage;
            let pageEnd = pageStart + this.itemsPerPage;

            if (i >= pageStart && i < pageEnd) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        }
    }
}


let carouselElement = document.querySelector('.slider-wrapper-artist');
let carousel = new Carousel(carouselElement, 8 );