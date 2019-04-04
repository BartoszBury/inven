<?php

class HtmlBlocks {
	function __construct() {
		add_action( 'init', array( $this, 'cpt_html_blocks' ), 0 );
		add_filter( 'manage_edit-html_blocks_columns', array( $this, 'cpt_add_column' ) );
		add_action( 'manage_html_blocks_posts_custom_column', array( $this, 'cpt_add_data_to_column' ) );
		add_shortcode( 'html_block', array( $this, 'render' ) );

	}

	function cpt_html_blocks() {
		register_post_type( 'html-blocks',
			array(
				'labels'              => array(
					'name'          => __( 'HTML Bloki' ),
					'singular_name' => __( 'HTML Bloki' ),
				),
				'public'              => true,
				'publicly_queryable'  => true,
				'show_in_menu'        => true,
				'show_ui'             => true,
				'has_archive'         => false,
				'exclude_from_search' => true,
				'show_in_nav_menus'   => false,
				'rewrite'             => false,
				'menu_position'       => 102,
				'menu_icon'           => 'dashicons-schedule',
			)

		);
	}

	function cpt_add_column( $columns ) {

		$columns = array(
			'cb'        => '<input type="checkbox" />',
			'Font' => __( 'HTML Bloki' ),
			'shortcode' => __( 'ShortCode' ),
		);

		return $columns;
	}

	function cpt_add_data_to_column( $column = false, $post_id = false ) {
		$post = get_post( $post_id );
		$slug = $post->post_name;

		switch ( $column ) {
			case 'shortcode':
				echo '<b>';
				echo '[html_block slug="' . $slug . '"]';
				echo '</b>';
		}

	}

	function render( $atts ) {
		$a    = shortcode_atts( array(
			'slug' => ''
		), $atts );
		$slug = $a["slug"];

		if ( $post = get_page_by_path( $slug, OBJECT, 'html_blocks' ) ) {
			$id = $post->ID;
		} else {
			exit();
		}

		$content_id = get_post_field( 'post_content', $id );

		$content = do_shortcode( $content_id );

		$shortcodes_custom_css = get_post_meta( $id, '_wpb_shortcodes_custom_css', true );
		if ( ! empty( $shortcodes_custom_css ) ) {
			$content .= '<style type="text/css" data-type="vc_shortcodes-custom-css">';
			$content .= $shortcodes_custom_css;
			$content .= '</style>';
		}

		return $content;
	}

}

new HtmlBlocks();









