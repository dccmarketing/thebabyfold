/**
 * Collapsable Widgets
 *
 * Click the title of the widget, the widget appears, click it again and it disappears.
 * Includes a plus/minus icon at the end that changes based on the open/closed state
 */
jQuery(document).ready(function($){

	$(".widget-title").css("cursor", "pointer");

	$(".widget").each( function() {

		var widget = $(this);
		var title = widget.children(":first-child");
		var content = widget.children(":last-child");
		var plus_minus = $(this).children(".show_hide");

		title.click( function(){

			content.slideToggle(250);
			title.toggleClass("open");
			
			if ( title.hasClass( "open" ) ) {

				plus_minus.html("-");

			} else {

				plus_minus.html("+");

			}

		}); // title.click()

	}); // .widget

});

/**
 * Collapsable Post Titles
 *
 * Click the title of the widget, the widget appears, click it again and it disappears.
 * Includes a plus/minus icon at the end that changes based on the open/closed state
 */
jQuery(document).ready(function($){

	$(".showhide").css("cursor", "pointer");

	$(".page-template-page-page-with-posts-php .category-volunteer-opportunities").each( function() {

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