jQuery(document).ready(function($) {

    "use strict";
    var title = $('html head').find('title').text();
    var Page = (function() {

        var $container = $('#hs-container'),
                // the scroll container that wraps the articles
                $scroller = $container.find('div.hs-content-scroller'),
                $menu = $container.find('aside'),
                // menu links
                $links = $menu.find('nav > a'),
                $articles = $container.find('div.hs-content-wrapper > article'),
                // button to scroll to the top of the page
                // only shown when screen size < 755
                $toTop = $container.find('a.hs-totop-link'),
                // the browser nhistory object
                History = window.History,
                // animation options
                animation = {speed: 800, easing: 'easeInOutQuad'},
        // jScrollPane options
        scrollOptions = {verticalGutter: 0, hideFocus: false, contentWidth: '0px'},
        // init function
        init = function() {
            // initialize the jScrollPane on both the menu and articles
            _initCustomScroll();
            // initialize some events
            _initEvents();
            // sets some css properties 
            _layout();
            // jumps to the respective section
            // according to the url
            _goto();

        },
                _initCustomScroll = function() {
                    // Only add custom scroll to articles if screen size > 755.
                    // If not the articles will be expanded
                    if ($(window).width() > 755) {
                        $articles.jScrollPane(scrollOptions);
                    }
                    // add custom scroll to menu
                    $menu.children('nav').jScrollPane(scrollOptions);
                },
                _goto = function(section) {

                    // get the url from history state (e.g. section=3) and extract the section number
                    var section = section || History.getState().url.queryStringToJSON().section,
                            isHome = (section === undefined),
                            // we will jump to the section1 section if theres no section
                            $article = $(section ? '#' + 'section' + section : '#' + 'section1');
                    if ($article.length) {
                        // left / top of the element
                        var left = $article.position().left,
                                top = $article.position().top,
                                // check if we are scrolling down or left
                                // is_v will be true when the screen size < 755
                                is_v = ($(document).height() - $(window).height() > 0),
                                // animation parameters:
                                // if vertically scrolling then the body will animate the scrollTop,
                                // otherwise the scroller (div.hs-content-scroller) will animate the scrollLeft
                                param = (is_v) ? {scrollTop: (isHome) ? top : top + $menu.outerHeight(true)} : {scrollLeft: left},
                        $elScroller = (is_v) ? $('html, body') : $scroller;
                        $elScroller.stop().animate(param, animation.speed, animation.easing);
                        $('nav a').removeClass('active-sec');
                        $('.hs-content .sec-icon').removeClass('active-sec');
                        $('[href="' + "#" + $article.attr("id") + '"]').addClass('active-sec');
                        $("#" + $article.attr("id") + ' .sec-icon').addClass('active-sec');
                    }
                    $('html head').find('title').text(title);
                },
                _saveState = function(section) {

                    // adds a new state to the history object
                    // this will trigger the statechange on the window
                    if (History.getState().url.queryStringToJSON().section !== section) {

                        History.pushState(null, null, '?section=' + section);
                    }
                },
                _layout = function() {
                    // control the overflow property of the scroller (div.hs-content-scroller)
                    var windowWidth = $(window).width();
                    switch (true) {

                        case (windowWidth <= 755) :
                            $scroller.scrollLeft(0).css('overflow', 'visible');
                            break;
                        case (windowWidth <= 1024):
                            $scroller.css('overflow-x', 'scroll');
                            break;
                        case (windowWidth > 1024) :
                            $scroller.css('overflow', 'hidden');
                            break;
                    }
                    ;
                },
                _initEvents = function() {

                    _initWindowEvents();
                    _initMenuEvents();
                    _initArticleEvents();
                    _initArrowEvents();
                },
                _initWindowEvents = function() {

                    $(window).on({
                        // when resizing the window we need to reinitialize or destroy the jScrollPanes
                        // depending on the screen size
                        'smartresize': function(event) {
                            _layout();
                            $('article.hs-content').each(function() {

                                var $article = $(this),
                                        aJSP = $article.data('jsp');

                                if ($(window).width() > 755) {

                                    (aJSP === undefined) ? $article.jScrollPane(scrollOptions) : aJSP.reinitialise();

                                    _initArticleEvents();
                                }
                                else {
                                    // destroy article's custom scroll if screen size <= 755px
                                    if (aJSP !== undefined)
                                        aJSP.destroy();
                                    $container.off('click', 'article.hs-content');
                                }

                            });
                            var nJSP = $menu.children('nav').data('jsp');
                            nJSP.reinitialise();

                            // jumps to the current section
                            //_goto();
                        },
                        // triggered when the history state changes - jumps to the respective section
                        'statechange': function(event) {

                            _goto();
                        }
                    });
                },
                _initMenuEvents = function() {

                    // when we click a menu link we check which section the link refers to,
                    // and we save the state on the history obj.
                    // the statechange of the window is then triggered and the page/scroller scrolls to the 
                    // respective section's position
                    $links.on('click', function(event) {

                        var href = $(this).attr('href'),
                                section = (href.search(/section/) !== -1) ? href.substring(8) : 0;
                        _saveState(section);

                        return false;
                    });

                    $('.home').on('click',function() {
                        _saveState(1);
                    });

                    $('.contact-button').on('click',function() {
                        _saveState(8);
                    });

                    // scrolls to the top of the page.
                    // this button will only be visible for screen size < 755
                    $(window).on('scroll',function() {
                        if ($(this).scrollTop() > 100) {
                            $toTop.fadeIn();
                        } else {
                            $toTop.fadeOut();
                        }
                    });
                    $toTop.on('click', function(event) {

                        $('html, body').stop().animate({scrollTop: 0}, animation.speed, animation.easing);

                        return false;
                    });
                    $('html head').find('title').text(title);
                },
                _initArticleEvents = function() {

                    // when we click on an article we check which section the article refers to,
                    // and we save the state on the history obj.
                    // the statechange of the window is then triggered and the page/scroller scrolls to the 
                    // respective section's position
                    $container.on('click', 'article.hs-content', function(event) {

                        var id = $(this).attr('id'),
                                section = (id.search(/section/) !== -1) ? id.substring(7) : 0;
                        _saveState(section);
                    });
                },
                _initArrowEvents = function() {

                    $container.on("click", ".previous-page", function(event) {
                        $(".next-page").css("color", "#878e98");
                        var section = section || History.getState().url.queryStringToJSON().section;
                        if (section == undefined) {
                            _saveState(1);
                        } else {
                            if (section != 1) {
                                _saveState(section - 1);
                                
                                if ((section - 1) == 1) {
                                    console.log("kayna");
                                    $(".previous-page").css("color", "#D2D6DB");
                                }
                            }
                        }
                        return false;
                    });
                    $container.on("click", ".next-page", function(event) {
                        $(".previous-page").css("color", "#878e98");
                        var section = section || History.getState().url.queryStringToJSON().section;

                        if (section == undefined) {
                            _saveState(2);
                        } else {
                            if (section != $articles.length) {
                                _saveState(section + 1);
                                if ((section + 1) == $articles.length) {
                                    $(".next-page").css("color", "#D2D6DB");
                                }
                            }
                        }
                        return false;
                    });

                    $(".hs-content-scroller").on('scroll',function() {
                        var section = section || History.getState().url.queryStringToJSON().section;

                        if ((section) != 1 || (section != $articles.length)) {
                            $(".previous-page").css("color", "#878e98");
                            $(".next-page").css("color", "#878e98");
                        }
                        if ((section) == 1) {
                            $(".previous-page").css("color", "#D2D6DB");
                            $(".next-page").css("color", "#878e98");
                        }
                        if (section == $articles.length) {
                            $(".previous-page").css("color", "#878e98");
                            $(".next-page").css("color", "#D2D6DB");
                        }
                    });

                        var section = section || History.getState().url.queryStringToJSON().section;
                        if (section == undefined)
                        {
                            section = 1;
                        }
                        if ((section) != 1 || (section != $articles.length)) {
                            $(".previous-page").css("color", "#878e98");
                            $(".next-page").css("color", "#878e98");
                        }
                        if ((section) == 1) {
                            $(".previous-page").css("color", "#D2D6DB");
                            $(".next-page").css("color", "#878e98");
                        }
                        if (section == $articles.length) {
                            $(".previous-page").css("color", "#878e98");
                            $(".next-page").css("color", "#D2D6DB");
                        }

                };
        return {init: init};
    })();
    Page.init();
});