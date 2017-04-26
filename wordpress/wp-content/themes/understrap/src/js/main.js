
$ = jQuery;

jQuery(document).ready(function(){
    
    // active menu item on scroll
    setHomeScroll();
    
    $('.carousel-control-prev').click(function() {
        $('#myCarousel').carousel('prev');
    });

    $('.carousel-control-next').click(function() {
        $('#myCarousel').carousel('next');
    });
    
    // open image in pop up
    $(".pop").each(function() {
        
        $(this).on("click", function() {
            
            var img = getImage($(this));

            $('#imagepreview').attr('src', img); // here assign the image to the modal when the user click the enlarge link
            $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function

        });
    });
    
    // enable hover menu item to show sub menu instead on click
    $('.dropdown-toggle').mouseover(function() {
        $('.dropdown-menu').show();
    });

    $('.dropdown-toggle').mouseout(function() {
        hideDropdown();
    });
    
    $('.dropdown-toggle').click(function() {
        hideDropdown();
    });
    
    
    // always open the page (instead of toggle open) when user clicks an item
    $('.init').click(function(event) {
        slidePage($(this), event.forceOpen);
    });
    
    // trigger click of homepages when a menu item ir opened
    $('#main-menu .nav-link').each(function () {
        
        var menuItem;
        var anchor;
        var id;
        
        // if menu item clicked isn't from main menu, get parent item
        if($(this).parent().parent().attr('id') !== "main-menu") {

            menuItem = $(this).parent().parent().siblings("a");

        } else {
            
            menuItem = $(this);
            
        }
        
        anchor = menuItem.attr('href').split("#");
        id = anchor[anchor.length - 1];
        
        $(this).on('click', function(){
            
            $('a[name="' + id + '"]').parent().siblings(".init").trigger({type:'click', forceOpen: true});
        });
        
    });
    
    // slide page to close in home
    $('.close-page').on('click', function(){
        
        $(this).parent().siblings(".init").trigger({type:'click'});
        
    });
    
    // in case it's mobile mode, close the menu when a menu item is clicked
    $('.menu-item a').on('click', function() {

        if($('#hamburguer').is(':visible')) {
            
            $('#navbar-main').removeClass('show');
        }
    });
    
    
    scrollToHash();
    
});

function getImage(_this){
    var bg = _this.css('background-image');
    bg = bg.replace('url(','').replace(')','').replace(/\"/gi, "");
    return (bg);
}

/**
 * In  case the url has hashtag, send user to the place
 * @returns {undefined}
 */
function scrollToHash () {

    if (window.location.hash != ""){
        // find menu item of correpondent page
        var navLink = $.find('a[href="' + window.location + '"]');
        // goto page and open it
        $(navLink).trigger({type:'click', forceOpen: true});
    }
}

function hideDropdown () {
    t = setTimeout(function() {
        $('.dropdown-menu').hide();
    }, 100);

    $('.dropdown-menu').on('mouseenter', function() {
        $('.dropdown-menu').show();
        clearTimeout(t);
    }).on('mouseleave', function() {
        $('.dropdown-menu').hide();
    });
}

/**
 * Wrap text in span(for hom titles with "<br>"
 * 
 * @param {type} classElement
 * @returns {undefined}
 */
function setTextWithinSpan (classElement) {
    
    var $element = $("." + classElement);
    
    $element.each(function(){
        var str = $(this).html();
        
        var newStr = "<span>" + str.split("<br>").join("</span><br><span>") + "</span>";
        
        $(this).html(newStr);
        $(this).show();
    });
    
}(jQuery);


/**
 * Opens / closes a page on home
 * 
 * @param {type} thisObj
 * @param {type} forceOpen
 * @returns {undefined}
 */
function slidePage (thisObj, forceOpen) {
    
    var $element = $(thisObj).parent().children(".page-wrap").children(".page-content");
    var $close = $element.siblings('.close-page');
    
    // handle the button to open or close the pages
    if ($element.is(':visible')){
        $close.html('<i class="fa fa-chevron-circle-down"></i>');
    } else {
        $close.html('<i class="fa fa-chevron-circle-up"></i>');
    }
    
    // force open if user clicked on the menu
    if(forceOpen){
        $element.slideDown('show');
    } else {
        
        // slide page down or up
        $element.slideToggle('swing', function() {
            
            // if page is opening, after the slide, scroll so user can see the page
            if ($(this).is(':visible')){
                $('html,body').animate({scrollTop: $(this).siblings(".anchor").offset().top});
            }
        });
    }
    
    $close.css({bottom:0});
    $close.css({display:"inherit"});
}(jQuery);

/**
 * Smooth scroll
 * @returns {undefined}
 */
$(function() {
  $('a[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});


function setHomeScroll(){
    
    // Cache selectors
    var topMenu = $("#main-menu");
    var topMenuHeight = topMenu.outerHeight() + 300;
    
    // All list items
    var menuItems = topMenu.find('a[href!=""]').filter('a[href!="#"]');
    
    // Anchors corresponding to menu items
    var scrollItems = menuItems.map(function(){
      var item = $(this);
      
      // if item exists and it's from the main menu
      if (item.length && item.parent().parent().attr('id') === "main-menu") {
          
          return item;
      }
    });
    
    // Bind to scroll
    $(window).scroll(function(){
        // Get container scroll position
        var fromTop = $(this).scrollTop() + topMenuHeight;
       
        // Get id of current page item that is visible in screen
        var cur = scrollItems.map(function(){
            var href = $(this).attr('href');
            // find the anchor in the page
            var anchor = $(document).find('a[name="' + getHashFromUrl(href) + '"]');

            if (anchor.length) {

                var offset = $(anchor).offset();

             if(offset.top < fromTop) {

                 return this;
             }
          }

        });
        
        if(cur.length) {
            // Set/remove active class to item menu
            menuItems.removeClass("active");
            // Set the visible page matching menu item to active
            // in cur obj are all the items above in scroll, so we just need to get the last one
            $(cur[cur.length - 1][0]).addClass("active");
        }



///////HALF DONE/////////////->finds the sidebar when visible,
//sets it to fixed when scrolling down and achieving the top of its page
//it's missing finding the .page-wrap (pageContent) to calculate the end of the area that the sidebar should be fixed
//so it doesn't override the next page!!!!!!!!!
//
        // check if there exists a side bar
        // if exists, fix it to the top of the page when the user scrolls down and the initial position is negative
//        var topRef = topMenuHeight - 100;
//        $(".sidebar").each(function() {
//
//            if($(this).length && !$(this).is(':hidden')) {// the sidebar is there
//                var sidebarScroll = $(this).parent().offset().top;
//                var pageContent = $(this).parent().parent('.page-wrap');
//
//                //console.log("anchor: ", anchor.attr('name'), " -> ", anchorScroll, " # ", sidebarScroll, " TOPREF: ", topRef, "FROMTOP: ", fromTop, (fromTop - anchorScroll),  ((fromTop - anchorScroll) > topRef));
//
//                // If scroll level passes the anchor of the sidebar
//                if((fromTop - sidebarScroll) > topRef) {
//                    console.log("FIX until end of its page ", pageContent);
//                    //$(this).addClass('fixed');
//                    console.log("height: " + ((fromTop - sidebarScroll) + $(this).height()));
//                    console.log("page content: ", (fromTop - pageContent.offset().top) + pageContent.height);
//                } else {
//                    $(this).removeClass('fixed');
//                }
//            }
//       });
       
    });
    
    function getHashFromUrl(url) {
        
        var startIndex = url.lastIndexOf("#") + 1;
        var endIndex = url.length;
        
        return url.substr(startIndex, endIndex);

    }
    
};