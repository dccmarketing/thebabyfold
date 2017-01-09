/**
 * Collapsable Widgets
 *
 * Click the title of the block, the block appears, click it again and it disappears.
 * Includes a plus/minus icon at the end that changes based on the open/closed state
 */
jQuery(document).ready(function($){

	$(".block-title").css("cursor", "pointer");

	$(".block").each( function() {

		var block = $(this);
		var title = block.children(":first-child");
		var content = block.children(":last-child");
		var plus_minus = $(this).children(".show_hide");

		if ( ! block.hasClass( "open" ) ) {

			title.click( function(){

				content.slideToggle(250);
				title.toggleClass("open");

				if ( title.hasClass( "open" ) ) {

					plus_minus.html("-");

				} else {

					plus_minus.html("+");

				}

			}); // title.click()

		}

	}); // .block

});

/**
 * Collapsable Post Titles
 *
 * Click the title of the widget, the widget appears, click it again and it disappears.
 * Includes a plus/minus icon at the end that changes based on the open/closed state
 */
jQuery(document).ready(function($){

	$(".showhide").css("cursor", "pointer");

	$(".page-template-page-page-with-posts-php .category-volunteer-opportunities, .page-template-page-page-with-posts-php .category-help-you").each( function() {

		var post = $(this);
		var title = post.children(":first-child");
		var content = post.children(":last-child");
		var plus_minus = title.children(".show_hide");

		title.click( function(){

			content.slideToggle(250);
			title.toggleClass("open");

			if ( title.hasClass( "open" ) ) {

				plus_minus.html("-");

			} else {

				plus_minus.html("+");

			}

		}); // title.click()

	}); // .post

});