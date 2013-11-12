<?php
/*
Version: 131111
Text Domain: wp-products
Plugin Name: WP Products

Author URI: http://www.websharks-inc.com/
Author: WebSharks, Inc. (Jason Caldwell)

Plugin URI: http://www.websharks-inc.com/product/wp-products/
Description: Create Products! This plugin adds a new Post Type. That's it (for now).
*/
if(!defined('WPINC')) // MUST have WordPress.
	exit('Do NOT access this file directly: '.basename(__FILE__));

add_action('init', 'wp_products::init', 1);
register_activation_hook(__FILE__, 'wp_products::activate');
register_deactivation_hook(__FILE__, 'wp_products::deactivate');

class wp_products
{
	public static function init()
		{
			load_plugin_textdomain('wp-products');

			wp_products::register();
		}

	public static function register()
		{
			$post_type_args           = array
			(
				'public'       => TRUE,
				'map_meta_cap' => TRUE, 'capability_type' => array('product', 'products'),
				'rewrite'      => array('slug' => 'product', 'with_front' => FALSE), // Like a Post (but no Post Formats).
				'supports'     => array('title', 'editor', 'author', 'excerpt', 'revisions', 'thumbnail', 'custom-fields', 'comments', 'trackbacks')
			);
			$post_type_args['labels'] = array
			(
				'name'               => __('Products', 'wp-products'),
				'singular_name'      => __('Product', 'wp-products'),
				'add_new'            => __('Add Product', 'wp-products'),
				'add_new_item'       => __('Add New Product', 'wp-products'),
				'edit_item'          => __('Edit Product', 'wp-products'),
				'new_item'           => __('New Product', 'wp-products'),
				'all_items'          => __('All Products', 'wp-products'),
				'view_item'          => __('View Product', 'wp-products'),
				'search_items'       => __('Search Products', 'wp-products'),
				'not_found'          => __('No Product found', 'wp-products'),
				'not_found_in_trash' => __('No Products found in Trash', 'wp-products')
			);
			register_post_type('product', $post_type_args);

			$taxonomy_args = array // Categories.
			(
				'public'       => TRUE, 'show_admin_column' => TRUE,
				'hierarchical' => TRUE, // This will use category labels.
				'rewrite'      => array('slug' => 'product-category', 'with_front' => FALSE),
				'capabilities' => array('assign_terms' => 'edit_products',
				                        'edit_terms'   => 'edit_products',
				                        'manage_terms' => 'edit_others_products',
				                        'delete_terms' => 'delete_others_products')
			);
			register_taxonomy('product_category', array('product'), $taxonomy_args);
		}

	public static function caps($action)
		{
			$all_caps = array // The ability to manage (all caps).
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
			foreach(apply_filters('wp_product_roles_all_caps', array('administrator')) as $_role)
				if(is_object($_role = & get_role($_role)))
					foreach($all_caps as $_cap) switch($action)
					{
						case 'activate':
								$_role->add_cap($_cap);
								break;

						case 'deactivate':
								$_role->remove_cap($_cap);
								break;
					}
			unset($_role, $_cap); // Housekeeping.

			$edit_caps = array // The ability to edit/publish/delete.
			(
				'edit_products',
				'edit_published_products',

				'publish_products',

				'delete_products',
				'delete_published_products'
			);
			foreach(apply_filters('wp_product_roles_edit_caps', array('administrator', 'editor', 'author')) as $_role)
				if(is_object($_role = & get_role($_role)))
					foreach($edit_caps as $_cap) switch($action)
					{
						case 'activate':
								$_role->add_cap($_cap);
								break;

						case 'deactivate':
								$_role->remove_cap($_cap);
								break;
					}
			unset($_role, $_cap); // Housekeeping.
		}

	public static function activate()
		{
			wp_products::register();
			wp_products::caps('activate');
			flush_rewrite_rules();
		}

	public static function deactivate()
		{
			wp_products::caps('deactivate');
			flush_rewrite_rules();
		}
}