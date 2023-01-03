const activePage = window.location.pathname
const links = document.querySelectorAll('#admin_link')

links.forEach(link =>{
    if(link.href.includes(`${activePage}`)){
        link.classList.add('link_active')
    }else {
        link.classList.remove('link_active')
    }
})
