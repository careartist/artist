// if ($.cookie("theme_csspath")) {
//     $('link#theme-stylesheet').attr("href", $.cookie("theme_csspath"));
// }
// if ($.cookie("theme_layout")) {
//     $('body').addClass($.cookie("theme_layout"));
// }

$(function () {

    // sliderHomepage();
    // sliders();
    fullScreenContainer();
    // productDetailGallery(4000);
    menuSliding();
    // productDetailSizes();
    utils();
    // animations();
    // counters();
    // demo();

});


/* menu sliding */

function menuSliding() {


    $('.dropdown').on('show.bs.dropdown', function (e) {

	if ($(window).width() > 750) {
	    $(this).find('.dropdown-menu').first().stop(true, true).slideDown();

	}
	else {
	    $(this).find('.dropdown-menu').first().stop(true, true).show();
	}
    }

    );
    $('.dropdown').on('hide.bs.dropdown', function (e) {
	if ($(window).width() > 750) {
	    $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
	}
	else {
	    $(this).find('.dropdown-menu').first().stop(true, true).hide();
	}
    });

}

/* picture zoom */

function pictureZoom() {

    $('.product .image, .post .image, .photostream div').each(function () {
	var imgHeight = $(this).find('img').height();
	$(this).height(imgHeight);
    });
}

/* full screen intro */

function fullScreenContainer() {

    var screenWidth = $(window).width() + "px";

    if ($(window).height() > 500) {
	var screenHeight = $(window).height() + "px";
    }
    else {
	var screenHeight = "500px";
    }


    $("#intro, #intro .item").css({
	width: screenWidth,
	height: screenHeight
    });
}

function utils() {

    /* tooltips */

    $('[data-toggle="tooltip"]').tooltip();

    /* click on the box activates the radio */

    $('#checkout').on('click', '.box.shipping-method, .box.payment-method', function (e) {
	var radio = $(this).find(':radio');
	radio.prop('checked', true);
    });
    /* click on the box activates the link in it */

    $('.box.clickable').on('click', function (e) {

	window.location = $(this).find('a').attr('href');
    });
    /* external links in new window*/

    $('.external').on('click', function (e) {

	e.preventDefault();
	window.open($(this).attr("href"));
    });
    /* animated scrolling */

    $('.scroll-to, .scroll-to-top').click(function (event) {

	var full_url = this.href;
	var parts = full_url.split("#");
	if (parts.length > 1) {

	    scrollTo(full_url);
	    event.preventDefault();
	}
    });
    function scrollTo(full_url) {
	var parts = full_url.split("#");
	var trgt = parts[1];
	var target_offset = $("#" + trgt).offset();
	var target_top = target_offset.top - 100;
	if (target_top < 0) {
	    target_top = 0;
	}

	$('html, body').animate({
	    scrollTop: target_top
	}, 1000);
    }
}


$.fn.alignElementsSameHeight = function () {
    $('.same-height-row').each(function () {

	var maxHeight = 0;
	var children = $(this).find('.same-height');
	children.height('auto');
	if ($(window).width() > 768) {
	    children.each(function () {
		if ($(this).innerHeight() > maxHeight) {
		    maxHeight = $(this).innerHeight();
		}
	    });
	    children.innerHeight(maxHeight);
	}

	maxHeight = 0;
	children = $(this).find('.same-height-always');
	children.height('auto');
	children.each(function () {
	    if ($(this).height() > maxHeight) {
		maxHeight = $(this).innerHeight();
	    }
	});
	children.innerHeight(maxHeight);

    });
}

// $(window).load(function () {

//     windowWidth = $(window).width();

//     $(this).alignElementsSameHeight();
//     pictureZoom();
// });

$(window).resize(function () {

    newWindowWidth = $(window).width();

    if (windowWidth !== newWindowWidth) {
	setTimeout(function () {
	    $(this).alignElementsSameHeight();
	    fullScreenContainer();
	    pictureZoom();
	}, 205);
	windowWidth = newWindowWidth;
    }

});
