=== WP Products ===

Stable tag: 131111
Requires at least: 3.3
Tested up to: 3.7.1
Text Domain: wp-products

License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Contributors: WebSharks
Donate link: http://www.websharks-inc.com/r/wp-theme-plugin-donation/
Tags: product, products, ecommerce, e-commerce, post type, post types, utilities, posts, pages

Create Products! This plugin adds a new Post Type. That's it (for now).

== Description ==

This plugin is VERY simple. There are NO configuration options necessary.

This plugin adds a new Post Type. This plugin makes it SUPER easy to create Products (as a separate Post Type in WordPress). This is a very lightweight plugin (for now). In the future we may add some additional functionality for Product integrations w/ other plugins.

After installing this plugin, create a new Product (find menu item on the left in your Dashboard). Products are just like any other Post, except they have a different classification so that themes/plugins may identify Products and/or separate them from other Posts.

== Frequently Asked Questions ==

#### Who can manage Products in the Dashboard?

By default, only WordPress® Administrators can manage (i.e. create/edit/delete/manage) Products. Editors and Authors can create/edit/delete their own Products, but permissions are limited for Editors/Authors. If you would like to give other WordPress Roles the Capabilities required, please use a plugin like [Enhanced Capability Manager](http://wordpress.org/extend/plugins/capability-manager-enhanced/).

Add the following Capabilities to the additional Roles that should be allowed to manage Products.

	$caps = array
			(
				'edit_products',
				'edit_others_products',
				'edit_published_products',
				'edit_private_products',
				'publish_products',
				'delete_products',
				'delete_private_products',
				'delete_published_products',
				'delete_others_products',
				'read_private_products'
			);

NOTE: There are also some WordPress filters integrated into the code for this plugin, which can make permissions easier to deal with in many cases. You can have a look at the source code and determine how to proceed on your own; if you choose this route.

== Installation ==

= WP Products is very easy to install (instructions) =
1. Upload the `/wp-products` folder to your `/wp-content/plugins/` directory.
2. Activate the plugin through the `Plugins` menu in WordPress®.
3. Create Products in WordPress® (see: Dashboard -› Products).

== Changelog ==

= v131111 =
 * Initial release.