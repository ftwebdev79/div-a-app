'use strict'
import 'aplayer/dist/APlayer.min.css';
import APlayer from 'aplayer';

export default class AjaxService {
    // /**
    //  * @param {HTMLElement | null}
    //  */

    constructor(element) {
        if (element === null) {
            return
        }
        this.pages = element.querySelectorAll('[data-charge-page]')
        this.content = element.querySelector('#js-display-content')
        this.backBtn = document.querySelector('button#back');
        this.details = document.querySelector('article#details')
        console.log({
            detail: this.details,
            content: this.content
        })
        this.bindEvents()
    }


    bindEvents() {
        this.pages.forEach((page) => {
                page.querySelectorAll('a').forEach(a => {
                    a.addEventListener('click', e => {
                        e.preventDefault()
                        const url = a.href;
                        this.loadUrl(url)
                        this.loadSongs(url)
                    })
                })
            }
        )

        this.backBtn.addEventListener('click', () => {
            this.backToHome();
        })

    }

    async loadUrl(url) {
        const response = await fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })


        if (response.status >= 200 && response.status < 300) {
            const pageContent = await response.text()
            this.details.innerHTML = pageContent
            // const divAppear = document.createElement('div')
            // divAppear.classList.add('.appear')
            // divAppear.appendChild(this.content)
            this.backBtn.classList.remove('d-none');
            this.content.classList.add('d-none');
        } else {
            console.log('error')
        }
    }

    async loadSongs(url) {
        url = "/api" + url;
        const response = await fetch(url);
        console.log(response)

        if (response.status >= 200 && response.status < 300) {
            const songs = await response.json();
            new APlayer({
                container: document.getElementById('aplayer'),
                audio: songs
            });

        } else {
            console.log('error')
        }
    }

    backToHome() {
        this.content.classList.remove('d-none');
        this.backBtn.classList.add("d-none");
        this.details.innerHTML = "";
    }
}
