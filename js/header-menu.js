//*************** HEADER MENU ***************//

(function () {

    document.addEventListener("DOMContentLoaded", function() {

        // find the menu elements

        let homeItem = document.querySelector('.menu-item-home'),
            homeItemActive = homeItem.classList.contains('active'),
            homeItemHeight = homeItem.offsetHeight,
            menuBtn = document.querySelector('.navbar-toggler'),
            ariaExpanded = menuBtn.getAttribute('aria-expanded'),
            header = document.querySelector('#masthead'),
            headerHeight = header.offsetHeight;

        let content = document.querySelector('#content');
        content.style.paddingTop = headerHeight + 'px';
        function addOrder() {
            if (ariaExpanded) {
                homeItem.classList.add('order-first');
            } else {
                homeItem.classList.remove('order-first');
            }
        }

        // make order for home-item first in mobile
        menuBtn.addEventListener('click', function() {
            if ( CLIENT_WIDTH < TABLET_WIDTH ) {
                addOrder();
            }
        });

        // make sticky header

        function hide (elem) {
            if (window.pageYOffset > (headerHeight + 30)) {

                // Give the element a height to change from
                elem.style.height = elem.scrollHeight + 'px';
                // Set the height back to 0
                window.setTimeout(function () {
                    elem.style.height = '0';
                }, 1);

                // When the transition is complete, hide it
                window.setTimeout(function () {
                    elem.classList.add('hidden');
                }, TRANSITION_TIME);
            }
        }

        function show(elem) {
            elem.classList.remove('hidden');
            elem.style.height = homeItemHeight +'px';
        }

        function resizeHomeItem() {
            if (window.pageYOffset > headerHeight) {
                homeItem.classList.remove('col-md-3');
            } else {
                homeItem.classList.add('col-md-3');
            }
        }

        window.onscroll = function() {
            if (CLIENT_WIDTH > TABLET_WIDTH && homeItemActive) {
                if (window.pageYOffset >= headerHeight && !homeItem.classList.contains('hidden')) {
                    hide(homeItem);
                }
                if (window.pageYOffset < headerHeight) {
                    show(homeItem);
                }

            }
            if (CLIENT_WIDTH > TABLET_WIDTH && !homeItemActive) {
                resizeHomeItem();
            }
        };

    });

})();
