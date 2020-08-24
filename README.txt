=== SEO Slider ===
Contributors: seothemes
Tags: slider
Donate link: https://seothemes.com
Requires at least: 5.2
Tested up to: 5.5
Requires PHP: 5.6
Stable tag: trunk
License: GPL-2.0-or-later
License URI: http://www.gnu.org/licenses/gpl-2.0.txt

Displays a lightweight slider optimized for search engines, accessibility and mobile devices.

== Description ==
SEO Slider creates a new `slider` custom post type and provides plenty of options to create multiple sliders with either a widget or a shortcode.

= Slider Settings =
* Overlay Color
* Text Color
* Enable dots
* Enable arrows
* Enable loop
* Enable autoplay
* Effect style
* Slide duration
* Slide transition
* Slider height

= Shortcode Usage =
Here is an example of the SEO Slider shortcode. The slider ID can be found from the Edit Slider screen:

`[slider id="1234"]`

== Installation ==
1. Go to Plugins > Add New.
2. Type in the name of the WordPress Plugin or descriptive keyword, author, or tag in Search Plugins box or click a tag link below the screen.
3. Find the WordPress Plugin you wish to install.
4. Click Details for more information about the Plugin and instructions you may wish to print or save to help setup the Plugin.
5. Click Install Now to install the WordPress Plugin.
6. The resulting installation screen will list the installation as successful or note any problems during the install.
7. If successful, click Activate Plugin to activate it, or Return to Plugin Installer for further actions.

== Screenshots ==
1. Edit Slider screen

== Frequently Asked Questions ==

= How to enable unsupported HTML tags in slider content? =
By default, SEO Slider uses the same markup filters as the WordPress editor: do_shortcode, wp_kses_post & wpautop. To remove these, you can use the 'seo_slider_content_output' filter by adding the following to your child themes functions.php file:

`add_filter('seo_slider_content_output', function( $default, $raw ) {
    return $raw;
} );`

= How is this slider SEO friendly? =
SEO Slider has been built with SEO in mind. We've taken extra care to ensure that it's as lightweight as possible with only one JavaScript file and one CSS file. We've also added some extra schema markup to help search engines understand the content. While no slider is perfect for SEO, we'll do our best to make sure this plugin is as SEO friendly as possible.

= Is this plugin accessibility ready? =
This plugin uses the Slick Slider JavaScript plugin which supports keyboard arrow key navigation. Give it a try yourself at https://demo.seothemes.com/corporate-pro/ using just the keyboard to navigate through the slides.

== Changelog ==

= 1.1.0 =
* Added filter for content output
* Added helper functions
* Updated slick.js
* Removed use of constants

= 1.0.10 =
* Fix conflict with corporate pro

= 1.0.9 =
* Move inline scripts and styles to footer

= 1.0.8 =
* Fix minor bugs when no slider is set

= 1.0.7 =
* Add extra args to hooks and filters

= 1.0.6 =
* Add unique classes to slides

= 1.0.5 =
* Fix missing assets

= 1.0.4 =
* Fix compatibility with Gutenberg
* Remove schema if Yoast is active

= 1.0.3 =
* Enable shortcodes in slide content
* Add filter for wysiwyg sanitization callback
* Remove cmb2 plugin header comment

= 1.0.2 =
* Update CMB2 to version 2.3.0

= 1.0.1 =
* Added Gulp and minified assets
* Added max width of slider wrapper
* Added extra filters for image args
* Fixed deprecated 'default' CMB2 field to 'default_cb'
* Removed CMB2 plugin header comment

= 1.0.0 =
* Initial release.
