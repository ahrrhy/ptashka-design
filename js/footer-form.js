
//*************** FOOTER FORM ***************//

(function () {

    document.addEventListener("DOMContentLoaded", function() {

        /*** CREATE FAKE SELECT LIST ***/
        let form = document.querySelector('.wpcf7-form'),
            select = document.querySelector('select[name="menu-89"]'),
            contactFormWrap = document.querySelector('#wpcf7-f46-o1'),
            formWrap = document.querySelector('#form-wrap'),
            fakeListWrap = document.createElement('div'),//.fake-select-wrap
            fakeList = document.createElement('ul'),
            spanSelect = document.querySelector('span.wpcf7-form-control-wrap.menu-89'),
            fakeSpanSelect = document.createElement('span');

        /*** ADD FAKE OPTIONS LIST WRAP ***/
        fakeListWrap.setAttribute('class', 'fake-select-wrap hidden');
        contactFormWrap.appendChild(fakeListWrap);
        /*** ADD FAKE OPTIONS LIST WITH ATTRIBUTES ***/
        fakeList.setAttribute('class', 'fake-select-list reset-list');
        fakeList.setAttribute('id', 'fake-select-list');
        fakeListWrap.appendChild(fakeList);
        /*** ADD FAKE SELECT SPAN WITH FIRST OPTION ***/
        fakeSpanSelect.innerHTML = select[0].innerHTML;
        fakeSpanSelect.setAttribute('class', 'wpcf7-form-control-wrap menu-89 select-feedback');
        document.querySelector('#form-list').insertBefore(fakeSpanSelect, spanSelect);
        spanSelect.style.display = "none";

        /*** ADD VALUES TO FAKE SELECT LIST ***/
        for (let i = 0; i < select.length; i++) {
            let fakeListItem = document.createElement('li');
            fakeListItem.setAttribute('class', 'fake-list-item fake-option');
            fakeListItem.setAttribute('data-id', `${i}`);
            fakeListItem.innerHTML = select[i].innerHTML;
            fakeList.appendChild(fakeListItem);
        }

        /*** ADD ACTIONS ***/
        document.querySelector('#call-form').addEventListener('click', function () {
            formWrap.classList.remove('hidden');
        });

        fakeSpanSelect.addEventListener('click', function () {
            fakeListWrap.classList.remove('hidden');
        });

        fakeList.addEventListener('click', function (e) {
            if (e.target !== undefined) {
                fakeSpanSelect.innerHTML = e.target.innerHTML;
                /*** REMOVE ALL :SELECTED FROM SELECT OPTIONS ***/
                for (let i = 0; i < select.length; i++) {
                    if (i === select[0] || i === select[e.target.getAttribute('data-id')]) {
                        continue;
                    }
                    /*** ADD NEW :SELECT ***/
                    select[i].removeAttribute('selected');
                }
                select[e.target.getAttribute('data-id')].setAttribute('selected', '');
                fakeListWrap.classList.add('hidden');
            }
        });

        window.addEventListener('click', function (e) {
            if (e.target === formWrap) {
                formWrap.classList.add('hidden');
            }
        });

        form.addEventListener('submit', function () {
            formWrap.classList.add('hidden');
        });
    });
})();
