(function() {
    document.addEventListener("DOMContentLoaded", function() {
        var sliderList = document.querySelector('.price_slider');

        if (sliderList) {
            sliderList.addEventListener('mouseup', function () {
                document.querySelector('.widget_price_filter form').submit();
            });
        }
    });
})();