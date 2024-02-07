if ( admin_object['version'] === 'v1' ) {
    setTimeout(() => {
        const els = document.querySelectorAll('[data-name*="v2"]');
        els.forEach(function(el) {
            el.style.display = "none";
        });
    }, 1000);
}
