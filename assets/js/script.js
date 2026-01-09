function toggleMenu() {
    document.getElementById('mobileMenu').classList.toggle('show');
}

// Wait for the window to fully load
window.addEventListener('load', function() {
    const loader = document.getElementById('loader');
    const loaderLogo = document.querySelector('#loader img');

    // Listen for when the spin animation ends
    loaderLogo.addEventListener('animationend', () => {
        // When spin ends, trigger zoom out
        loaderLogo.style.animation = 'zoomOut 0.8s forwards';

        // After zoom out finishes, hide the loader container
        setTimeout(() => {
            loader.style.display = 'none';
        }, 800); // Duration of zoom out animation
    });
});

