"use strict";


//  init Fancybox
if (typeof Fancybox !== "undefined" && Fancybox !== null) {
    Fancybox.bind("[data-fancybox]", {
        dragToClose: false,
        closeButton: false
    });
}




$(function () {


    // detect user OS
    const isMobile = {
        Android: () => /Android/i.test(navigator.userAgent),
        BlackBerry: () => /BlackBerry/i.test(navigator.userAgent),
        iOS: () => /iPhone|iPad|iPod/i.test(navigator.userAgent),
        Opera: () => /Opera Mini/i.test(navigator.userAgent),
        Windows: () => /IEMobile/i.test(navigator.userAgent),
        any: function () {
            return this.Android() || this.BlackBerry() || this.iOS() || this.Opera() || this.Windows();
        },
    };

    function getNavigator() {
        if (isMobile.any() || $(window).width() < 992) {
            $('body').removeClass('_pc').addClass('_touch');
        } else {
            $('body').removeClass('_touch').addClass('_pc');
        }
    }

    getNavigator();

    $(window).on('resize', () => {
        getNavigator();
    });


    $('a[href="#request"]').on('click', function (e) {
        e.preventDefault();

        console.log('work');


        $('html, body').animate({
            scrollTop: $('#request').offset().top
        }, 300);


        $('#request').find('input:not(:hidden)').first().focus();
    });



    // event handlers
    $(document).on('click', (e) => {
        const $target = $(e.target);

        //  menu
        if ($target.closest('.header__menu-toggler').length) {
            $('.header').toggleClass('open-menu');
            $('body').toggleClass('open-menu');
        }

        if ($target.is('.wrapper') && $('.header').hasClass('open-menu')) {
            $('.header').removeClass('open-menu');
        }

        // faq accordion
        if ($target.closest('.faq__item-title').length) {
            const $faqItem = $target.closest('.faq__item-title');
            $faqItem.toggleClass('active');
            $faqItem.next('.faq__item-answer').slideToggle()
        }

        // filter Toggler
        if ($target.is('.products__filter-toggler')) {
            $target.next().slideToggle()
        }

    });


    $('[data-tooltip]').hover(function () {
        var tooltipText = $(this).data('tooltip');
        var tooltip = $('<div class="tooltip"></div>').text(tooltipText);

        $('body').append(tooltip);

        var offset = $(this).offset();
        tooltip.css({
            top: offset.top - tooltip.outerHeight() - 5,
            left: offset.left + $(this).outerWidth() / 2 - tooltip.outerWidth() / 2
        });

        tooltip.fadeIn(200);
    }, function () {
        $('.tooltip').remove();
    });


    //  sliders
    if ($('.single-product__slider').length) {
        new Swiper('.single-product__slider .swiper', {
            spaceBetween: 20,
            slidesPerView: 1.5,
            loop: true,
            navigation: {
                prevEl: '.single-product__prev',
                nextEl: '.single-product__next',
            },
            breakpoints: {
                575.98: {
                    slidesPerView: 2,
                },
                991.98: {
                    slidesPerView: 3,
                },
                1199.98: {
                    slidesPerView: 4,
                }
            }
        })
    }

    // function getMobileSlider(sliderName, options) {

    //     let init = false;
    //     let swiper = null;

    //     function getSwiper() {
    //         if (window.innerWidth <= 767.98) {
    //             if (!init) {
    //                 init = true;
    //                 swiper = new Swiper(sliderName, options);
    //             }
    //         } else if (init) {
    //             swiper.destroy();
    //             swiper = null;
    //             init = false;
    //         }
    //     }
    //     getSwiper();
    //     window.addEventListener("resize", getSwiper);
    // }

    // // observer header scroll
    // const callback = (entries) => {
    //     if (entries[0].isIntersecting) {
    //         $('.header').removeClass('scroll');
    //     } else {
    //         $('.header').addClass('scroll');
    //     }
    // };

    // const headerObserver = new IntersectionObserver(callback);
    // headerObserver.observe($('.header')[0]);


    // observer header height
    // function updateHeaderHeight() {
    //     var headerHeight = $('.header__wrapper').outerHeight() / parseFloat($('html').css('font-size'));

    //     $('body').css('--header-height', headerHeight + 'rem');
    // }

    // updateHeaderHeight();

    // $(window).on('resize', function () {
    //     updateHeaderHeight();
    // });


    // tabs
    // class Tabs {
    //     constructor(wrapper) {
    //         this.$wrapper = $(wrapper);
    //         this.$tabButtons = this.$wrapper.find('.tabs__item');
    //         this.$tabContents = this.$wrapper.find('.tab-content');
    //         this.init();
    //     }

    //     init() {
    //         this.$tabButtons.each((index, button) => {
    //             $(button).on('click', () => this.activateTab(index));
    //         });
    //     }

    //     activateTab(index) {
    //         this.$tabButtons.removeClass('active');
    //         this.$tabContents.removeClass('active');

    //         this.$tabButtons.eq(index).addClass('active');
    //         this.$tabContents.eq(index).addClass('active');
    //     }
    // }

    // $('.tabs-wrapper').each((_, wrapper) => new Tabs(wrapper));



    // Custom Select

    class CustomSelect {

        static openDropdown = null

        constructor(selectElement) {
            this.$select = $(selectElement);
            this.defaultText = this.$select.find('option:selected').text();
            this.selectName = this.$select.attr('name');
            this.$options = this.$select.find('option');
            this.icon = this.$select.data('icon');
            this.title = this.$select.data('title');
            this.$dropdown = null;
            this.initialState = {};
            this.init();
        }

        init() {
            if (!this.$select.length) return;
            this.saveInitialState();
            this.$select.addClass('hidden');
            this.renderDropdown();
            this.setupEvents();
        }

        saveInitialState() {
            const $selectedOption = this.$select.find('option:selected');
            this.initialState = {
                selectedText: $selectedOption.text(),
                selectedValue: $selectedOption.val(),
            };
        }

        renderDropdown() {
            const isDisabled = this.$select.is(':disabled')

            let buttonTemplate = `
                    <button type="button" class="dropdown__button icon-chevron-down" 
                        aria-expanded="false" 
                        aria-haspopup="true" 
                        ${isDisabled ? 'disabled' : ''}>
                        <span class="dropdown__button-text">${this.defaultText}</span>
                    </button>
                `;

            this.$dropdown = $(`
                <div class="dropdown">
                    ${buttonTemplate}
                    <div class="dropdown__body" aria-hidden="true">
                        <ul class="dropdown__list" role="listbox"></ul>
                    </div>
                </div>
            `);

            const $list = this.$dropdown.find('.dropdown__list');
            this.$options.each((index, option) => {
                const $option = $(option);
                const value = $option.attr('value');
                const text = $option.text();
                const isSelected = $option.is(':selected');
                const isDisabled = $option.is(':disabled');

                $list.append(`
                    <li role="option"
                        data-value="${value}"
                        aria-checked="${isSelected}"
                        class="dropdown__list-item${isSelected ? ' selected' : ''}${isDisabled ? ' disabled' : ''}" 
                        ${isDisabled ? 'aria-disabled="true"' : ''}>
                        ${text}
                    </li>
                `);
            });

            this.$select.after(this.$dropdown);


        }

        setupEvents() {
            this.$dropdown.find('.dropdown__button').on('click', (event) => {
                event.stopPropagation();
                const isOpen = this.$dropdown.hasClass('visible');
                this.toggleDropdown(!isOpen);
            });

            this.$dropdown.find('.dropdown__list-item').on('click', (event) => {
                event.stopPropagation();
                const $item = $(event.currentTarget);

                if (!$item.hasClass('disabled')) {
                    this.selectOption($item);
                }
            });

            $(document).on('click', () => this.closeDropdown());
            $(document).on('keydown', (event) => {
                if (event.key === 'Escape') this.closeDropdown();
            });

            this.$select.closest('form').on('reset', () => this.restoreInitialState());

            const observerDisabled = new MutationObserver(() => {
                const isSelectDisabled = this.$select.is(':disabled');
                const $button = this.$dropdown.find('.dropdown__button');

                if (isSelectDisabled) {
                    $button.prop('disabled', true);
                } else {
                    $button.prop('disabled', false);
                }
            });

            observerDisabled.observe(this.$select[0], {
                attributes: true,
                attributeFilter: ['disabled']
            });

            const observerSelected = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'disabled') {
                        const $option = $(mutation.target);
                        const value = $option.attr('value');
                        const isDisabled = $option.is(':disabled');
                        const $item = this.$dropdown.find(`.dropdown__list-item[data-value="${value}"]`);

                        $item.toggleClass('disabled', isDisabled);
                        if (isDisabled) {
                            $item.attr('aria-disabled', 'true');
                        } else {
                            $item.removeAttr('aria-disabled');
                        }
                    }

                    if (mutation.type === 'attributes' && mutation.attributeName === 'selected') {
                        this.syncSelectedOption();
                    }
                });
            });

            observerSelected.observe(this.$select[0], {
                childList: true,
                subtree: true,
                attributes: true,
                attributeFilter: ['selected', 'disabled']
            });
        }

        toggleDropdown(isOpen) {
            if (isOpen && CustomSelect.openDropdown && CustomSelect.openDropdown !== this) {
                CustomSelect.openDropdown.closeDropdown();
            }

            const $body = this.$dropdown.find('.dropdown__body');
            const $list = this.$dropdown.find('.dropdown__list');
            const hasScroll = $list[0].scrollHeight > $list[0].clientHeight;

            this.$dropdown.toggleClass('visible', isOpen);
            this.$dropdown.find('.dropdown__button').attr('aria-expanded', isOpen);
            $body.attr('aria-hidden', !isOpen);

            if (isOpen) {
                CustomSelect.openDropdown = this;
                this.$dropdown.removeClass('dropdown-top');
                const dropdownRect = $body[0].getBoundingClientRect();
                const viewportHeight = window.innerHeight;
                if (dropdownRect.bottom > viewportHeight) {
                    this.$dropdown.addClass('dropdown-top');
                }

                $list.toggleClass('has-scroll', hasScroll);
            } else {
                if (CustomSelect.openDropdown === this) {
                    CustomSelect.openDropdown = null;
                }
            }
        }

        closeDropdown() {
            this.toggleDropdown(false);
        }

        selectOption($item) {
            const value = $item.data('value');
            const text = $item.text();

            this.$dropdown.find('.dropdown__list-item').removeClass('selected').attr('aria-checked', 'false');
            $item.addClass('selected').attr('aria-checked', 'true');

            this.$dropdown.find('.dropdown__button-text').text(text);
            this.$select.val(value).trigger('change');
            this.closeDropdown();
        }

        restoreInitialState() {
            const state = this.initialState;
            this.$select.val(state.selectedValue).trigger('change');
            this.$dropdown.find('.dropdown__list-item').removeClass('selected').attr('aria-checked', 'false');
            this.$dropdown
                .find(`.dropdown__list-item[data-value="${state.selectedValue}"]`)
                .addClass('selected')
                .attr('aria-checked', 'true');
            this.$dropdown.find('.dropdown__button-text').text(state.selectedText);
        }

        syncSelectedOption() {
            const $selectedOption = this.$select.find('option:selected');
            const selectedValue = $selectedOption.val();
            const selectedText = $selectedOption.text();


            this.$dropdown.find('.dropdown__list-item').removeClass('selected').attr('aria-checked', 'false');
            this.$dropdown
                .find(`.dropdown__list-item[data-value="${selectedValue}"]`)
                .addClass('selected')
                .attr('aria-checked', 'true');
            this.$dropdown.find('.dropdown__button-text').text(selectedText);
        }
    }

    $('.select').each((index, element) => {
        new CustomSelect(element);
    });
    $('.variations select').each((index, element) => {
        new CustomSelect(element);
    });


    $('input[type="tel"]').each(function () {
        const input = $(this)[0];

        const codeArray = [
            {
                mask: "+247-0000",
                startsWith: "247",
                lazy: false,
                country: "Ascension"
            },
            {
                mask: "+376-000-000",
                startsWith: "376",
                lazy: false,
                country: "Andorra"
            },
            {
                mask: "+971-50-000-0000",
                startsWith: "9715",
                lazy: false,
                country: "United Arab Emirates"
            },
            {
                mask: "+971-0-000-0000",
                startsWith: "971",
                lazy: false,
                country: "United Arab Emirates"
            },
            {
                mask: "+93-00-000-0000",
                startsWith: "93",
                lazy: false,
                country: "Afghanistan"
            },
            {
                mask: "+1(268)000-0000",
                startsWith: "1268",
                lazy: false,
                country: "Antigua & Barbuda"
            },
            {
                mask: "+1(264)000-0000",
                startsWith: "1264",
                lazy: false,
                country: "Anguilla"
            },
            {
                mask: "+355(000)000-000",
                startsWith: "355",
                lazy: false,
                country: "Albania"
            },
            {
                mask: "+374-00-000-000",
                startsWith: "374",
                lazy: false,
                country: "Armenia"
            },
            {
                mask: "+599-000-0000",
                startsWith: "599",
                lazy: false,
                country: "Caribbean Netherlands"
            },
            {
                mask: "+599-000-0000",
                startsWith: "599",
                lazy: false,
                country: "Netherlands Antilles"
            },
            {
                mask: "+599-9000-0000",
                startsWith: "599",
                lazy: false,
                country: "Netherlands Antilles"
            },
            {
                mask: "+244(000)000-000",
                startsWith: "244",
                lazy: false,
                country: "Angola"
            },
            {
                mask: "+672-100-000",
                startsWith: "6721",
                lazy: false,
                country: "Australian bases in Antarctica"
            },
            {
                mask: "+54(000)000-0000",
                startsWith: "54",
                lazy: false,
                country: "Argentina"
            },
            {
                mask: "+1(684)000-0000",
                startsWith: "1684",
                lazy: false,
                country: "American Samoa"
            },
            {
                mask: "+43(000)000-0000",
                startsWith: "43",
                lazy: false,
                country: "Austria"
            },
            {
                mask: "+61-0-0000-0000",
                startsWith: "61",
                lazy: false,
                country: "Australia"
            },
            {
                mask: "+297-000-0000",
                startsWith: "297",
                lazy: false,
                country: "Aruba"
            },
            {
                mask: "+994-00-000-00-00",
                startsWith: "994",
                lazy: false,
                country: "Azerbaijan"
            },
            {
                mask: "+387-00-00000",
                startsWith: "387",
                lazy: false,
                country: "Bosnia and Herzegovina"
            },
            {
                mask: "+1(246)000-0000",
                startsWith: "1246",
                lazy: false,
                country: "Barbados"
            },
            {
                mask: "+880-00-000-000",
                startsWith: "880",
                lazy: false,
                country: "Bangladesh"
            },
            {
                mask: "+32(000)000-000",
                startsWith: "32",
                lazy: false,
                country: "Belgium"
            },
            {
                mask: "+226-00-00-0000",
                startsWith: "226",
                lazy: false,
                country: "Burkina Faso"
            },
            {
                mask: "+359(000)000-000",
                startsWith: "359",
                lazy: false,
                country: "Bulgaria"
            },
            {
                mask: "+973-0000-0000",
                startsWith: "973",
                lazy: false,
                country: "Bahrain"
            },
            {
                mask: "+257-00-00-0000",
                startsWith: "257",
                lazy: false,
                country: "Burundi"
            },
            {
                mask: "+229-00-00-0000",
                startsWith: "229",
                lazy: false,
                country: "Benin"
            },
            {
                mask: "+1(441)000-0000",
                startsWith: "1441",
                lazy: false,
                country: "Bermuda"
            },
            {
                mask: "+673-000-0000",
                startsWith: "673",
                lazy: false,
                country: "Brunei Darussalam"
            },
            {
                mask: "+591-0-000-0000",
                startsWith: "591",
                lazy: false,
                country: "Bolivia"
            },
            {
                mask: "+55(00)0000-0000",
                startsWith: "55",
                lazy: false,
                country: "Brazil"
            },
            {
                mask: "+55(00){7}000-0000",
                startsWith: "55",
                lazy: false,
                country: "Brazil"
            },
            {
                mask: "+55(00)90000-0000",
                startsWith: "55",
                lazy: false,
                country: "Brazil"
            },
            {
                mask: "+1(242)000-0000",
                startsWith: "1242",
                lazy: false,
                country: "Bahamas"
            },
            {
                mask: "+975-17-000-000",
                startsWith: "97517",
                lazy: false,
                country: "Bhutan"
            },
            {
                mask: "+975-0-000-000",
                startsWith: "975",
                lazy: false,
                country: "Bhutan"
            },
            {
                mask: "+267-00-000-000",
                startsWith: "267",
                lazy: false,
                country: "Botswana"
            },
            {
                mask: "+375(00)000-00-00",
                startsWith: "375",
                lazy: false,
                country: "Belarus"
            },
            {
                mask: "+501-000-0000",
                startsWith: "501",
                lazy: false,
                country: "Belize"
            },
            {
                mask: "+243(000)000-000",
                startsWith: "243",
                lazy: false,
                country: "Dem. Rep. Congo"
            },
            {
                mask: "+236-00-00-0000",
                startsWith: "236",
                lazy: false,
                country: "Central African Republic"
            },
            {
                mask: "+242-00-000-0000",
                startsWith: "242",
                lazy: false,
                country: "Congo (Brazzaville)"
            },
            {
                mask: "+41-00-000-0000",
                startsWith: "41",
                lazy: false,
                country: "Switzerland"
            },
            {
                mask: "+225-00-000-000",
                startsWith: "225",
                lazy: false,
                country: "Cote d’Ivoire (Ivory Coast)"
            },
            {
                mask: "+682-00-000",
                startsWith: "682",
                lazy: false,
                country: "Cook Islands"
            },
            {
                mask: "+56-0-0000-0000",
                startsWith: "56",
                lazy: false,
                country: "Chile"
            },
            {
                mask: "+237-0000-0000",
                startsWith: "237",
                lazy: false,
                country: "Cameroon"
            },
            {
                mask: "+86(000)0000-0000",
                startsWith: "86",
                lazy: false,
                country: "China (PRC)"
            },
            {
                mask: "+57(000)000-0000",
                startsWith: "57",
                lazy: false,
                country: "Colombia"
            },
            {
                mask: "+506-0000-0000",
                startsWith: "506",
                lazy: false,
                country: "Costa Rica"
            },
            {
                mask: "+53-0-000-0000",
                startsWith: "53",
                lazy: false,
                country: "Cuba"
            },
            {
                mask: "+238(000)00-00",
                startsWith: "238",
                lazy: false,
                country: "Cape Verde"
            },
            {
                mask: "+599-000-0000",
                startsWith: "599",
                lazy: false,
                country: "Curacao"
            },
            {
                mask: "+357-00-000-000",
                startsWith: "357",
                lazy: false,
                country: "Cyprus"
            },
            {
                mask: "+420(000)000-000",
                startsWith: "420",
                lazy: false,
                country: "Czech Republic"
            },
            {
                mask: "+49(0000)000-0000",
                startsWith: "49",
                lazy: false,
                country: "Germany"
            },
            {
                mask: "+253-00-00-00-00",
                startsWith: "253",
                lazy: false,
                country: "Djibouti"
            },
            {
                mask: "+45-00-00-00-00",
                startsWith: "45",
                lazy: false,
                country: "Denmark"
            },
            {
                mask: "+1(767)000-0000",
                startsWith: "1767",
                lazy: false,
                country: "Dominica"
            },
            {
                mask: "+1(809)000-0000",
                startsWith: "1809",
                lazy: false,
                country: "Dominican Republic"
            },
            {
                mask: "+213-00-000-0000",
                startsWith: "213",
                lazy: false,
                country: "Algeria"
            },
            {
                mask: "+593-00-000-0000",
                startsWith: "593",
                lazy: false,
                country: "Ecuador"
            },
            {
                mask: "+372-0000-0000",
                startsWith: "372",
                lazy: false,
                country: "Estonia "
            },
            {
                mask: "+20(000)000-0000",
                startsWith: "20",
                lazy: false,
                country: "Egypt"
            },
            {
                mask: "+291-0-000-000",
                startsWith: "291",
                lazy: false,
                country: "Eritrea"
            },
            {
                mask: "+34(000)000-000",
                startsWith: "34",
                lazy: false,
                country: "Spain"
            },
            {
                mask: "+251-00-000-0000",
                startsWith: "251",
                lazy: false,
                country: "Ethiopia"
            },
            {
                mask: "+358(000)000-00-00",
                startsWith: "358",
                lazy: false,
                country: "Finland"
            },
            {
                mask: "+679-00-00000",
                startsWith: "679",
                lazy: false,
                country: "Fiji"
            },
            {
                mask: "+500-00000",
                startsWith: "500",
                lazy: false,
                country: "Falkland Islands"
            },
            {
                mask: "+691-000-0000",
                startsWith: "691",
                lazy: false,
                country: "F.S. Micronesia"
            },
            {
                mask: "+298-000-000",
                startsWith: "298",
                lazy: false,
                country: "Faroe Islands"
            },
            {
                mask: "+262-00000-0000",
                startsWith: "262",
                lazy: false,
                country: "Mayotte"
            },
            {
                mask: "+33(000)000-000",
                startsWith: "33",
                lazy: false,
                country: "France"
            },
            {
                mask: "+508-00-0000",
                startsWith: "508",
                lazy: false,
                country: "St Pierre & Miquelon"
            },
            {
                mask: "+590(000)000-000",
                startsWith: "590",
                lazy: false,
                country: "Guadeloupe"
            },
            {
                mask: "+241-0-00-00-00",
                startsWith: "241",
                lazy: false,
                country: "Gabon"
            },
            {
                mask: "+1(473)000-0000",
                startsWith: "1473",
                lazy: false,
                country: "Grenada"
            },
            {
                mask: "+995(000)000-000",
                startsWith: "995",
                lazy: false,
                country: "Rep. of Georgia"
            },
            {
                mask: "+594-00000-0000",
                startsWith: "594",
                lazy: false,
                country: "Guiana (French)"
            },
            {
                mask: "+233(000)000-000",
                startsWith: "233",
                lazy: false,
                country: "Ghana"
            },
            {
                mask: "+350-000-00000",
                startsWith: "350",
                lazy: false,
                country: "Gibraltar"
            },
            {
                mask: "+299-00-00-00",
                startsWith: "299",
                lazy: false,
                country: "Greenland"
            },
            {
                mask: "+220(000)00-00",
                startsWith: "220",
                lazy: false,
                country: "Gambia"
            },
            {
                mask: "+224-00-000-000",
                startsWith: "224",
                lazy: false,
                country: "Guinea"
            },
            {
                mask: "+240-00-000-0000",
                startsWith: "240",
                lazy: false,
                country: "Equatorial Guinea"
            },
            {
                mask: "+30(000)000-0000",
                startsWith: "30",
                lazy: false,
                country: "Greece"
            },
            {
                mask: "+502-0-000-0000",
                startsWith: "502",
                lazy: false,
                country: "Guatemala"
            },
            {
                mask: "+1(671)000-0000",
                startsWith: "1671",
                lazy: false,
                country: "Guam"
            },
            {
                mask: "+245-0-000000",
                startsWith: "245",
                lazy: false,
                country: "Guinea-Bissau"
            },
            {
                mask: "+592-000-0000",
                startsWith: "592",
                lazy: false,
                country: "Guyana"
            },
            {
                mask: "+852-0000-0000",
                startsWith: "852",
                lazy: false,
                country: "Hong Kong"
            },
            {
                mask: "+504-0000-0000",
                startsWith: "504",
                lazy: false,
                country: "Honduras"
            },
            {
                mask: "+385-00-000-000",
                startsWith: "385",
                lazy: false,
                country: "Croatia"
            },
            {
                mask: "+509-00-00-0000",
                startsWith: "509",
                lazy: false,
                country: "Haiti"
            },
            {
                mask: "+36(000)000-000",
                startsWith: "36",
                lazy: false,
                country: "Hungary"
            },
            {
                mask: "+62(800)000-0000",
                startsWith: "628",
                lazy: false,
                country: "Indonesia "
            },
            {
                mask: "+62-00-000-00",
                startsWith: "62",
                lazy: false,
                country: "Indonesia"
            },
            {
                mask: "+62-00-000-000",
                startsWith: "62",
                lazy: false,
                country: "Indonesia"
            },
            {
                mask: "+62-00-000-0000",
                startsWith: "62",
                lazy: false,
                country: "Indonesia"
            },
            {
                mask: "+62(800)000-000",
                startsWith: "628",
                lazy: false,
                country: "Indonesia "
            },
            {
                mask: "+62(800)000-00-000",
                startsWith: "628",
                lazy: false,
                country: "Indonesia "
            },
            {
                mask: "+353(000)000-000",
                startsWith: "353",
                lazy: false,
                country: "Ireland"
            },
            {
                mask: "+972-50-000-0000",
                startsWith: "9725",
                lazy: false,
                country: "Israel "
            },
            {
                mask: "+91(0000)000-000",
                startsWith: "91",
                lazy: false,
                country: "India"
            },
            {
                mask: "+246-000-0000",
                startsWith: "246",
                lazy: false,
                country: "Diego Garcia"
            },
            {
                mask: "+964(000)000-0000",
                startsWith: "964",
                lazy: false,
                country: "Iraq"
            },
            {
                mask: "+98(000)000-0000",
                startsWith: "98",
                lazy: false,
                country: "Iran"
            },
            {
                mask: "+354-000-0000",
                startsWith: "354",
                lazy: false,
                country: "Iceland"
            },
            {
                mask: "+39(000)0000-000",
                startsWith: "39",
                lazy: false,
                country: "Italy"
            },
            {
                mask: "+1(876)000-0000",
                startsWith: "1876",
                lazy: false,
                country: "Jamaica"
            },
            {
                mask: "+962-0-0000-0000",
                startsWith: "962",
                lazy: false,
                country: "Jordan"
            },
            {
                mask: "+81-00-0000-0000",
                startsWith: "81",
                lazy: false,
                country: "Japan "
            },
            {
                mask: "+81(000)000-000",
                startsWith: "81",
                lazy: false,
                country: "Japan"
            },
            {
                mask: "+254-000-000000",
                startsWith: "254",
                lazy: false,
                country: "Kenya"
            },
            {
                mask: "+996(000)000-000",
                startsWith: "996",
                lazy: false,
                country: "Kyrgyzstan"
            },
            {
                mask: "+855-00-000-000",
                startsWith: "855",
                lazy: false,
                country: "Cambodia"
            },
            {
                mask: "+686-00-000",
                startsWith: "686",
                lazy: false,
                country: "Kiribati"
            },
            {
                mask: "+269-00-00000",
                startsWith: "269",
                lazy: false,
                country: "Comoros"
            },
            {
                mask: "+1(869)000-0000",
                startsWith: "1869",
                lazy: false,
                country: "Saint Kitts & Nevis"
            },
            {
                mask: "+850-191-000-0000",
                startsWith: "850191",
                lazy: false,
                country: "DPR Korea (North) "
            },
            {
                mask: "+850-00-000-000",
                startsWith: "850",
                lazy: false,
                country: "DPR Korea (North)"
            },
            {
                mask: "+82-00-000-0000",
                startsWith: "82",
                lazy: false,
                country: "Korea (South)"
            },
            {
                mask: "+965-0000-0000",
                startsWith: "965",
                lazy: false,
                country: "Kuwait"
            },
            {
                mask: "+1(345)000-0000",
                startsWith: "1345",
                lazy: false,
                country: "Cayman Islands"
            },
            {
                mask: "+7(600)000-00-00",
                startsWith: "76",
                lazy: false,
                country: "Kazakhstan"
            },
            {
                mask: "+7(700)000-00-00",
                startsWith: "77",
                lazy: false,
                country: "Kazakhstan"
            },
            {
                mask: "+856(2000)000-000",
                startsWith: "85620",
                lazy: false,
                country: "Laos "
            },
            {
                mask: "+856-00-000-000",
                startsWith: "856",
                lazy: false,
                country: "Laos"
            },
            {
                mask: "+961-00-000-000",
                startsWith: "961",
                lazy: false,
                country: "Lebanon "
            },
            {
                mask: "+961-0-000-000",
                startsWith: "961",
                lazy: false,
                country: "Lebanon"
            },
            {
                mask: "+1(758)000-0000",
                startsWith: "1758",
                lazy: false,
                country: "Saint Lucia"
            },
            {
                mask: "+423(000)000-0000",
                startsWith: "423",
                lazy: false,
                country: "Liechtenstein"
            },
            {
                mask: "+94-00-000-0000",
                startsWith: "94",
                lazy: false,
                country: "Sri Lanka"
            },
            {
                mask: "+231-00-000-000",
                startsWith: "231",
                lazy: false,
                country: "Liberia"
            },
            {
                mask: "+266-0-000-0000",
                startsWith: "266",
                lazy: false,
                country: "Lesotho"
            },
            {
                mask: "+370(000)00-000",
                startsWith: "370",
                lazy: false,
                country: "Lithuania"
            },
            {
                mask: "+352(000)000-000",
                startsWith: "352",
                lazy: false,
                country: "Luxembourg"
            },
            {
                mask: "+371-00-000-000",
                startsWith: "371",
                lazy: false,
                country: "Latvia"
            },
            {
                mask: "+218-00-000-000",
                startsWith: "218",
                lazy: false,
                country: "Libya"
            },
            {
                mask: "+212-00-0000-000",
                startsWith: "212",
                lazy: false,
                country: "Morocco"
            },
            {
                mask: "+377(000)000-000",
                startsWith: "377",
                lazy: false,
                country: "Monaco"
            },
            {
                mask: "+373-0000-0000",
                startsWith: "373",
                lazy: false,
                country: "Moldova"
            },
            {
                mask: "+382-00-000-000",
                startsWith: "382",
                lazy: false,
                country: "Montenegro"
            },
            {
                mask: "+261-00-00-00000",
                startsWith: "261",
                lazy: false,
                country: "Madagascar"
            },
            {
                mask: "+692-000-0000",
                startsWith: "692",
                lazy: false,
                country: "Marshall Islands"
            },
            {
                mask: "+389-00-000-000",
                startsWith: "389",
                lazy: false,
                country: "Republic of Macedonia"
            },
            {
                mask: "+223-00-00-0000",
                startsWith: "223",
                lazy: false,
                country: "Mali"
            },
            {
                mask: "+95-00-000-000",
                startsWith: "95",
                lazy: false,
                country: "Burma (Myanmar)"
            },
            {
                mask: "+976-00-00-0000",
                startsWith: "976",
                lazy: false,
                country: "Mongolia"
            },
            {
                mask: "+853-0000-0000",
                startsWith: "853",
                lazy: false,
                country: "Macau"
            },
            {
                mask: "+1(670)000-0000",
                startsWith: "1670",
                lazy: false,
                country: "Northern Mariana Islands"
            },
            {
                mask: "+596(000)00-00-00",
                startsWith: "596",
                lazy: false,
                country: "Martinique"
            },
            {
                mask: "+222-00-00-0000",
                startsWith: "222",
                lazy: false,
                country: "Mauritania"
            },
            {
                mask: "+1(664)000-0000",
                startsWith: "1664",
                lazy: false,
                country: "Montserrat"
            },
            {
                mask: "+356-0000-0000",
                startsWith: "356",
                lazy: false,
                country: "Malta"
            },
            {
                mask: "+230-000-0000",
                startsWith: "230",
                lazy: false,
                country: "Mauritius"
            },
            {
                mask: "+960-000-0000",
                startsWith: "960",
                lazy: false,
                country: "Maldives"
            },
            {
                mask: "+265-1-000-000",
                startsWith: "2651",
                lazy: false,
                country: "Malawi"
            },
            {
                mask: "+52(000)000-0000",
                startsWith: "52",
                lazy: false,
                country: "Mexico"
            },
            {
                mask: "+60-00-000-0000",
                startsWith: "60",
                lazy: false,
                country: "Malaysia "
            },
            {
                mask: "+258-00-000-000",
                startsWith: "258",
                lazy: false,
                country: "Mozambique"
            },
            {
                mask: "+264-00-000-0000",
                startsWith: "264",
                lazy: false,
                country: "Namibia"
            },
            {
                mask: "+687-00-0000",
                startsWith: "687",
                lazy: false,
                country: "New Caledonia"
            },
            {
                mask: "+227-00-00-0000",
                startsWith: "227",
                lazy: false,
                country: "Niger"
            },
            {
                mask: "+672-300-000",
                startsWith: "6723",
                lazy: false,
                country: "Norfolk Island"
            },
            {
                mask: "+234(000)000-0000",
                startsWith: "234",
                lazy: false,
                country: "Nigeria"
            },
            {
                mask: "+505-0000-0000",
                startsWith: "505",
                lazy: false,
                country: "Nicaragua"
            },
            {
                mask: "+31-00-000-0000",
                startsWith: "31",
                lazy: false,
                country: "Netherlands"
            },
            {
                mask: "+47(000)00-000",
                startsWith: "47",
                lazy: false,
                country: "Norway"
            },
            {
                mask: "+977-00-000-000",
                startsWith: "977",
                lazy: false,
                country: "Nepal"
            },
            {
                mask: "+674-000-0000",
                startsWith: "674",
                lazy: false,
                country: "Nauru"
            },
            {
                mask: "+683-0000",
                startsWith: "683",
                lazy: false,
                country: "Niue"
            },
            {
                mask: "+64(000)000-000",
                startsWith: "64",
                lazy: false,
                country: "New Zealand"
            },
            {
                mask: "+64-00-000-000",
                startsWith: "64",
                lazy: false,
                country: "New Zealand"
            },
            {
                mask: "+968-00-000-000",
                startsWith: "968",
                lazy: false,
                country: "Oman"
            },
            {
                mask: "+507-000-0000",
                startsWith: "507",
                lazy: false,
                country: "Panama"
            },
            {
                mask: "+51(000)000-000",
                startsWith: "51",
                lazy: false,
                country: "Peru"
            },
            {
                mask: "+689-00-00-00",
                startsWith: "689",
                lazy: false,
                country: "French Polynesia"
            },
            {
                mask: "+675(000)00-000",
                startsWith: "675",
                lazy: false,
                country: "Papua New Guinea"
            },
            {
                mask: "+63(000)000-0000",
                startsWith: "63",
                lazy: false,
                country: "Philippines"
            },
            {
                mask: "+92(000)000-0000",
                startsWith: "92",
                lazy: false,
                country: "Pakistan"
            },
            {
                mask: "+48(000)000-000",
                startsWith: "48",
                lazy: false,
                country: "Poland"
            },
            {
                mask: "+970-00-000-0000",
                startsWith: "970",
                lazy: false,
                country: "Palestine"
            },
            {
                mask: "+351-00-000-0000",
                startsWith: "351",
                lazy: false,
                country: "Portugal"
            },
            {
                mask: "+680-000-0000",
                startsWith: "680",
                lazy: false,
                country: "Palau"
            },
            {
                mask: "+595(000)000-000",
                startsWith: "595",
                lazy: false,
                country: "Paraguay"
            },
            {
                mask: "+974-0000-0000",
                startsWith: "974",
                lazy: false,
                country: "Qatar"
            },
            {
                mask: "+262-00000-0000",
                startsWith: "262",
                lazy: false,
                country: "Reunion"
            },
            {
                mask: "+40-00-000-0000",
                startsWith: "40",
                lazy: false,
                country: "Romania"
            },
            {
                mask: "+381-00-000-0000",
                startsWith: "381",
                lazy: false,
                country: "Serbia"
            },
            {
                mask: "+7(000)000-00-00",
                startsWith: "7",
                lazy: false,
                country: "Russia"
            },
            {
                mask: "+250(000)000-000",
                startsWith: "250",
                lazy: false,
                country: "Rwanda"
            },
            {
                mask: "+966-5-0000-0000",
                startsWith: "9665",
                lazy: false,
                country: "Saudi Arabia "
            },
            {
                mask: "+677-000-0000",
                startsWith: "677",
                lazy: false,
                country: "Solomon Islands "
            },
            {
                mask: "+248-0-000-000",
                startsWith: "248",
                lazy: false,
                country: "Seychelles"
            },
            {
                mask: "+249-00-000-0000",
                startsWith: "249",
                lazy: false,
                country: "Sudan"
            },
            {
                mask: "+46-00-000-0000",
                startsWith: "46",
                lazy: false,
                country: "Sweden"
            },
            {
                mask: "+65-0000-0000",
                startsWith: "65",
                lazy: false,
                country: "Singapore"
            },
            {
                mask: "+290-0000",
                startsWith: "290",
                lazy: false,
                country: "Saint Helena"
            },
            {
                mask: "+290-0000",
                startsWith: "290",
                lazy: false,
                country: "Tristan da Cunha"
            },
            {
                mask: "+386-00-000-000",
                startsWith: "386",
                lazy: false,
                country: "Slovenia"
            },
            {
                mask: "+421(000)000-000",
                startsWith: "421",
                lazy: false,
                country: "Slovakia"
            },
            {
                mask: "+232-00-000000",
                startsWith: "232",
                lazy: false,
                country: "Sierra Leone"
            },
            {
                mask: "+378-0000-000000",
                startsWith: "378",
                lazy: false,
                country: "San Marino"
            },
            {
                mask: "+221-00-000-0000",
                startsWith: "221",
                lazy: false,
                country: "Senegal"
            },
            {
                mask: "+252-00-000-000",
                startsWith: "252",
                lazy: false,
                country: "Somalia"
            },
            {
                mask: "+597-000-0000",
                startsWith: "597",
                lazy: false,
                country: "Suriname "
            },
            {
                mask: "+211-00-000-0000",
                startsWith: "211",
                lazy: false,
                country: "South Sudan"
            },
            {
                mask: "+239-00-00000",
                startsWith: "239",
                lazy: false,
                country: "Sao Tome and Principe"
            },
            {
                mask: "+503-00-00-0000",
                startsWith: "503",
                lazy: false,
                country: "El Salvador"
            },
            {
                mask: "+1(721)000-0000",
                startsWith: "1721",
                lazy: false,
                country: "Sint Maarten"
            },
            {
                mask: "+963-00-0000-000",
                startsWith: "963",
                lazy: false,
                country: "Syrian Arab Republic"
            },
            {
                mask: "+268-00-00-0000",
                startsWith: "268",
                lazy: false,
                country: "Swaziland"
            },
            {
                mask: "+1(649)000-0000",
                startsWith: "1649",
                lazy: false,
                country: "Turks & Caicos"
            },
            {
                mask: "+235-00-00-00-00",
                startsWith: "235",
                lazy: false,
                country: "Chad"
            },
            {
                mask: "+228-00-000-000",
                startsWith: "228",
                lazy: false,
                country: "Togo"
            },
            {
                mask: "+66-00-000-0000",
                startsWith: "66",
                lazy: false,
                country: "Thailand "
            },
            {
                mask: "+66-00-000-000",
                startsWith: "66",
                lazy: false,
                country: "Thailand"
            },
            {
                mask: "+992-00-000-0000",
                startsWith: "992",
                lazy: false,
                country: "Tajikistan"
            },
            {
                mask: "+690-0000",
                startsWith: "690",
                lazy: false,
                country: "Tokelau"
            },
            {
                mask: "+670-000-0000",
                startsWith: "670",
                lazy: false,
                country: "East Timor"
            },
            {
                mask: "+993-0-000-0000",
                startsWith: "993",
                lazy: false,
                country: "Turkmenistan"
            },
            {
                mask: "+216-00-000-000",
                startsWith: "216",
                lazy: false,
                country: "Tunisia"
            },
            {
                mask: "+676-00000",
                startsWith: "676",
                lazy: false,
                country: "Tonga"
            },
            {
                mask: "+90(000)000-0000",
                startsWith: "90",
                lazy: false,
                country: "Turkey"
            },
            {
                mask: "+1(868)000-0000",
                startsWith: "1868",
                lazy: false,
                country: "Trinidad & Tobago"
            },
            {
                mask: "+688-900000",
                startsWith: "68890",
                lazy: false,
                country: "Tuvalu"
            },
            {
                mask: "+886-0-0000-0000",
                startsWith: "886",
                lazy: false,
                country: "Taiwan"
            },
            {
                mask: "+886-0000-0000",
                startsWith: "886",
                lazy: false,
                country: "Taiwan"
            },
            {
                mask: "+255-00-000-0000",
                startsWith: "255",
                lazy: false,
                country: "Tanzania"
            },
            {
                mask: "+380(00)000-00-00",
                startsWith: "380",
                lazy: false,
                country: "Ukraine"
            },
            {
                mask: "+256(000)000-000",
                startsWith: "256",
                lazy: false,
                country: "Uganda"
            },
            {
                mask: "+44-00-0000-0000",
                startsWith: "44",
                lazy: false,
                country: "United Kingdom"
            },
            {
                mask: "+598-0-000-00-00",
                startsWith: "598",
                lazy: false,
                country: "Uruguay"
            },
            {
                mask: "+998-00-000-0000",
                startsWith: "998",
                lazy: false,
                country: "Uzbekistan"
            },
            {
                mask: "+39-6-698-00000",
                startsWith: "396698",
                lazy: false,
                country: "Vatican City"
            },
            {
                mask: "+1(784)000-0000",
                startsWith: "1784",
                lazy: false,
                country: "Saint Vincent & the Grenadines"
            },
            {
                mask: "+58(000)000-0000",
                startsWith: "58",
                lazy: false,
                country: "Venezuela"
            },
            {
                mask: "+1(284)000-0000",
                startsWith: "1284",
                lazy: false,
                country: "British Virgin Islands"
            },
            {
                mask: "+1(340)000-0000",
                startsWith: "1340",
                lazy: false,
                country: "US Virgin Islands"
            },
            {
                mask: "+84-00-0000-000",
                startsWith: "84",
                lazy: false,
                country: "Vietnam"
            },
            {
                mask: "+678-00-00000",
                startsWith: "678",
                lazy: false,
                country: "Vanuatu"
            },
            {
                mask: "+681-00-0000",
                startsWith: "681",
                lazy: false,
                country: "Wallis and Futuna"
            },
            {
                mask: "+685-00-0000",
                startsWith: "685",
                lazy: false,
                country: "Samoa"
            },
            {
                mask: "+967-0-000-000",
                startsWith: "967",
                lazy: false,
                country: "Yemen"
            },
            {
                mask: "+27-00-000-0000",
                startsWith: "27",
                lazy: false,
                country: "South Africa"
            },
            {
                mask: "+260-00-000-0000",
                startsWith: "260",
                lazy: false,
                country: "Zambia"
            },
            {
                mask: "+263-0-000000",
                startsWith: "263",
                lazy: false,
                country: "Zimbabwe"
            },
            {
                mask: "+1(000)000-0000",
                startsWith: "1",
                lazy: false,
                country: "USA and Canada"
            },
            {
                mask: "0000000000000",
                startsWith: "",
                country: "unknown"
            }
        ]

        IMask(input, {
            mask: codeArray,
            dispatch: function (appended, dynamicMasked) {
                const number = (dynamicMasked.value + appended).replace(/\D/g, '');

                return dynamicMasked.compiledMasks.find(function (m) {
                    return number.indexOf(m.startsWith) === 0;
                });
            }
        });

    });





})




