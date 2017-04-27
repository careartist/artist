

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