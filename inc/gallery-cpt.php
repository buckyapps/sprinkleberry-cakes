<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sprinkleberry_register_gallery() {
	register_taxonomy(
		'sbc_album',
		array( 'sbc_photo', 'attachment' ),
		array(
			'labels' => array(
				'name'          => 'Albums',
				'singular_name' => 'Album',
				'add_new_item'  => 'Add Album',
				'search_items'  => 'Search Albums',
			),
			'public'            => false,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_menu'      => false,
			'hierarchical'      => true,
			'rewrite'           => false,
			'show_in_rest'      => true,
		)
	);

	register_post_type(
		'sbc_photo',
		array(
			'labels' => array(
				'name'               => 'Bakery Gallery',
				'singular_name'      => 'Photo',
				'add_new'            => 'Add Photo',
				'add_new_item'       => 'Add Gallery Photo',
				'edit_item'          => 'Edit Photo',
				'all_items'          => 'All Photos',
				'featured_image'     => 'Photo',
				'set_featured_image' => 'Set gallery photo',
			),
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'supports'            => array( 'title', 'thumbnail', 'editor' ),
			'taxonomies'          => array( 'sbc_album' ),
			'show_in_rest'        => true,
		)
	);
}
add_action( 'init', 'sprinkleberry_register_gallery' );

function sprinkleberry_ensure_albums() {
	$albums = array(
		'artisan-cakes' => 'Artisan Cakes',
		'cupcakes'      => 'Cupcakes',
		'desserts'      => 'Desserts',
		'cheesecakes'   => 'Cheesecakes',
		'pies'          => 'Pies',
		'sweet-treats'  => 'Sweet Treats',
	);
	foreach ( $albums as $slug => $name ) {
		if ( ! term_exists( $slug, 'sbc_album' ) ) {
			wp_insert_term( $name, 'sbc_album', array( 'slug' => $slug ) );
		}
	}
}
add_action( 'init', 'sprinkleberry_ensure_albums', 20 );

function sprinkleberry_photo_src( $post_id ) {
	$thumb = get_post_thumbnail_id( $post_id );
	if ( $thumb ) {
		$url = wp_get_attachment_image_url( $thumb, 'large' );
		if ( $url ) {
			return array( $url, get_the_title( $post_id ) );
		}
	}
	$attached = get_attached_media( 'image', $post_id );
	if ( $attached ) {
		$img = reset( $attached );
		$url = wp_get_attachment_image_url( $img->ID, 'large' );
		if ( $url ) {
			return array( $url, get_the_title( $post_id ) );
		}
	}
	$content = get_post_field( 'post_content', $post_id );
	if ( $content && preg_match( '/<img[^>]+src=["\']([^"\']+)["\']/', $content, $m ) ) {
		return array( $m[1], get_the_title( $post_id ) );
	}
	return null;
}

function sprinkleberry_album_photos( $album_slug ) {
	$out   = array();
	$posts = get_posts(
		array(
			'post_type'      => 'sbc_photo',
			'post_status'    => array( 'publish', 'private' ),
			'posts_per_page' => 60,
			'orderby'        => 'date',
			'order'          => 'DESC',
			'tax_query'      => array(
				array(
					'taxonomy' => 'sbc_album',
					'field'    => 'slug',
					'terms'    => array( $album_slug ),
				),
			),
		)
	);
	foreach ( $posts as $post ) {
		$src = sprinkleberry_photo_src( $post->ID );
		if ( $src ) {
			$out[] = array(
				'url' => $src[0],
				'alt' => $src[1],
				'id'  => $post->ID,
			);
		}
	}
	$media = get_posts(
		array(
			'post_type'      => 'attachment',
			'post_status'    => 'inherit',
			'post_mime_type' => 'image',
			'posts_per_page' => 60,
			'tax_query'      => array(
				array(
					'taxonomy' => 'sbc_album',
					'field'    => 'slug',
					'terms'    => array( $album_slug ),
				),
			),
		)
	);
	foreach ( $media as $img ) {
		$url = wp_get_attachment_image_url( $img->ID, 'large' );
		if ( ! $url ) {
			continue;
		}
		$already = false;
		foreach ( $out as $row ) {
			if ( $row['url'] === $url ) {
				$already = true;
				break;
			}
		}
		if ( ! $already ) {
			$out[] = array(
				'url' => $url,
				'alt' => get_the_title( $img ),
				'id'  => 0,
			);
		}
	}
	return $out;
}

function sprinkleberry_grab_featured_on_save( $post_id ) {
	if ( get_post_type( $post_id ) !== 'sbc_photo' ) {
		return;
	}
	if ( has_post_thumbnail( $post_id ) ) {
		return;
	}
	$attached = get_attached_media( 'image', $post_id );
	if ( $attached ) {
		$img = reset( $attached );
		set_post_thumbnail( $post_id, $img->ID );
	}
}
add_action( 'save_post_sbc_photo', 'sprinkleberry_grab_featured_on_save' );

function sprinkleberry_gallery_menu() {
	add_menu_page(
		'Bakery Gallery',
		'Bakery Gallery',
		'edit_posts',
		'sbc-gallery',
		'sprinkleberry_render_gallery_board',
		'dashicons-format-gallery',
		21
	);
	add_submenu_page( 'sbc-gallery', 'By Category', 'By Category', 'edit_posts', 'sbc-gallery', 'sprinkleberry_render_gallery_board' );
	add_submenu_page( 'sbc-gallery', 'All Photos', 'All Photos', 'edit_posts', 'edit.php?post_type=sbc_photo' );
	add_submenu_page( 'sbc-gallery', 'Add Photo', 'Add Photo', 'edit_posts', 'post-new.php?post_type=sbc_photo' );
}
add_action( 'admin_menu', 'sprinkleberry_gallery_menu' );

function sprinkleberry_render_gallery_board() {
	$albums = get_terms(
		array(
			'taxonomy'   => 'sbc_album',
			'hide_empty' => false,
			'orderby'    => 'name',
		)
	);
	if ( is_wp_error( $albums ) ) {
		$albums = array();
	}
	echo '<div class="wrap sbc-board">';
	echo '<h1>Bakery Gallery</h1>';
	echo '<p>Photos are grouped by category. Open a category to see its thumbnails. Use <strong>Add photo</strong> inside a category so it lands in the right gallery on the website.</p>';

	if ( empty( $albums ) ) {
		echo '<p>No albums yet. Visit the public site once, then refresh this page.</p></div>';
		return;
	}

	foreach ( $albums as $album ) {
		$photos = sprinkleberry_album_photos( $album->slug );
		$count  = count( $photos );
		$add    = admin_url( 'post-new.php?post_type=sbc_photo&sbc_album=' . rawurlencode( $album->slug ) );
		$open   = $count ? ' open' : '';
		echo '<details class="sbc-album"' . $open . '>';
		echo '<summary><strong>' . esc_html( $album->name ) . '</strong> <span>' . intval( $count ) . ' photo' . ( 1 === $count ? '' : 's' ) . '</span></summary>';
		echo '<p><a class="button button-primary" href="' . esc_url( $add ) . '">Add photo to ' . esc_html( $album->name ) . '</a></p>';
		if ( $photos ) {
			echo '<div class="sbc-thumbs">';
			foreach ( $photos as $photo ) {
				$edit = ! empty( $photo['id'] ) ? get_edit_post_link( $photo['id'] ) : '';
				echo '<div class="sbc-thumb">';
				if ( $edit ) {
					echo '<a href="' . esc_url( $edit ) . '">';
				}
				echo '<img src="' . esc_url( $photo['url'] ) . '" alt="' . esc_attr( $photo['alt'] ) . '">';
				if ( $edit ) {
					echo '</a>';
				}
				echo '<span>' . esc_html( $photo['alt'] ) . '</span>';
				echo '</div>';
			}
			echo '</div>';
		} else {
			echo '<p class="description">No photos in this category yet.</p>';
		}
		echo '</details>';
	}
	echo '</div>';
}

function sprinkleberry_gallery_admin_css() {
	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
	if ( ! $screen || ( isset( $screen->id ) && $screen->id !== 'toplevel_page_sbc-gallery' && $screen->post_type !== 'sbc_photo' ) ) {
		if ( empty( $_GET['page'] ) || $_GET['page'] !== 'sbc-gallery' ) {
			if ( ! $screen || $screen->post_type !== 'sbc_photo' ) {
				return;
			}
		}
	}
	echo '<style>
	.sbc-album{background:#fff;border:1px solid #dcdcde;border-radius:8px;margin:16px 0;padding:8px 16px 16px}
	.sbc-album summary{cursor:pointer;font-size:16px;padding:10px 0}
	.sbc-album summary span{color:#646970;font-weight:400;margin-left:8px}
	.sbc-thumbs{display:grid;grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:12px;margin-top:12px}
	.sbc-thumb img{width:100%;height:120px;object-fit:cover;border-radius:8px;display:block;background:#f0f0f1}
	.sbc-thumb span{display:block;font-size:12px;margin-top:6px;color:#1d2327}
	</style>';
}
add_action( 'admin_head', 'sprinkleberry_gallery_admin_css' );

function sprinkleberry_preselect_album() {
	global $post;
	if ( empty( $_GET['sbc_album'] ) || ! $post || $post->post_type !== 'sbc_photo' ) {
		return;
	}
	$slug = sanitize_title( wp_unslash( $_GET['sbc_album'] ) );
	$term = get_term_by( 'slug', $slug, 'sbc_album' );
	if ( $term && ! wp_get_object_terms( $post->ID, 'sbc_album', array( 'fields' => 'ids' ) ) ) {
		wp_set_object_terms( $post->ID, array( (int) $term->term_id ), 'sbc_album', false );
	}
}
add_action( 'add_meta_boxes', 'sprinkleberry_preselect_album' );

function sprinkleberry_gallery_help() {
	$screen = get_current_screen();
	if ( ! $screen || $screen->post_type !== 'sbc_photo' ) {
		return;
	}
	echo '<div class="notice notice-info"><p><strong>How this photo gets on the website:</strong> set the Photo box on the right, keep the correct Album checked, then Publish. Or start from <a href="' . esc_url( admin_url( 'admin.php?page=sbc-gallery' ) ) . '">Bakery Gallery → By Category</a>.</p></div>';
}
add_action( 'admin_notices', 'sprinkleberry_gallery_help' );
