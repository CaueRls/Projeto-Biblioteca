const headerWrapper = document.querySelector('.header-sticky-wrapper');
let lastScrollTop = 0;

window.addEventListener('scroll', function() {
    // Apenas executa a lógica em telas de celular/tablet
    if (window.innerWidth <= 768) {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop) {
            // Rolando para BAIXO
            headerWrapper.classList.add('header-sticky-wrapper--hidden');
        } else {
            // Rolando para CIMA
            headerWrapper.classList.remove('header-sticky-wrapper--hidden');
        }
        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // Para tratar o caso de rolar para o topo
    }
});