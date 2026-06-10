function removePreloader(){
    const handler = function () {
        const preloaderContainer = document.getElementById('preloader');
        //========== !SETTIMEOUT USED TO SHOW ANIMATION -- remove for production
        setTimeout(() => {
            preloaderContainer.style.display = 'none';
        }, 1000)
        // remove event lisenter
        document.removeEventListener("DOMContentLoaded", handler)
    }

    document.addEventListener("DOMContentLoaded", handler);
}

removePreloader();