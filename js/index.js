document.addEventListener('DOMContentLoaded', () => {
    "use strict";

    const preloader = document.querySelector('#preloader');
    if (preloader) {
      window.addEventListener('load', () => {
        preloader.remove();
      });
    }

$(document).ready(function(){
    $('.slider').click(function(){
        $(".index-dropdown").toggleClass("active");
    });

    $('.settings-dropper').click(function(){
        $(".setting-dropdown").toggleClass("active");
    });
});

});