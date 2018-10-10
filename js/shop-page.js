;(function ($) {

    /*** PAGINATION ***/
    document.addEventListener('DOMContentLoaded', function () {
        let prev = document.querySelector('.page-numbers .prev'),
            next = document.querySelector('.page-numbers .next');

        if (prev) {
            prev.innerHTML = '<';
        }

        if (next) {
            next.innerHTML = '>';
        }
    });
})();

;(function () {
    /**** CATEGORY FILTER DROPDOWN ****/
    // $(document).ready(function () {
    //     let parentCategoryLi   = $('li.cat-parent'),
    //         childrenCategoryUl = parentCategoryLi.find('ul.children');
    //
    //     if (parentCategoryLi) {
    //         childrenCategoryUl.addClass('hidden');
    //     }
    // });
})(jQuery);