const hamburger = document.querySelector('.hamburger-menu');
const mainNav = document.querySelector('.main-nav');
const stickyWrapper = document.querySelector('.header-sticky-wrapper');

hamburger.addEventListener('click', () => {
    // Adiciona/remove a classe 'is-active' no menu de navegação
    mainNav.classList.toggle('is-active');

    // Troca o ícone de hambúrguer por um "X" e vice-versa
    const icon = hamburger.querySelector('i');
    const isExpanded = mainNav.classList.contains('is-active');
    
    if (isExpanded) {
        icon.classList.remove('fa-bars');
        icon.classList.add('fa-times');
        hamburger.setAttribute('aria-expanded', 'true');
    } else {
        icon.classList.remove('fa-times');
        icon.classList.add('fa-bars');
        hamburger.setAttribute('aria-expanded', 'false');
    }
});


if (stickyWrapper) {
    window.addEventListener('scroll', () => {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        // --- Lógica para MOBILE (Header inteligente que some/reaparece) ---
        if (window.innerWidth <= 768) {
            if (scrollTop > lastScrollTop) {
                // Rolando para BAIXO: esconde o header
                stickyWrapper.classList.add('header-sticky-wrapper--hidden');
            } else {
                // Rolando para CIMA: mostra o header
                stickyWrapper.classList.remove('header-sticky-wrapper--hidden');
            }
        } 
        // --- Lógica para DESKTOP (Nav some e só reaparece no topo) ---
        else {
            if (scrollTop > 10) {
                stickyWrapper.classList.add('is-scrolled');
            } else {
                stickyWrapper.classList.remove('is-scrolled');
            }
        }
        
        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    });
}