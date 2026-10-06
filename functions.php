<?php
/**
 * Holzhacker – Theme-Funktionen
 *
 * @package Holzhacker
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'HOLZHACKER_VERSION', '1.0.0' );

/**
 * Zentrale Firmendaten. Werden in Header, Footer, Kontakt und im
 * strukturierten Daten-Markup (LocalBusiness) verwendet.
 * TODO: Echte Daten eintragen.
 */
function holzhacker_business() {
	return array(
		'name'        => 'Krefelder Holzhacker',
		'owners'      => 'Aron & Peter',
		'street'      => 'Musterstraße 1',
		'zip'         => '47798',
		'city'        => 'Krefeld',
		'region'      => 'NRW',
		'phone'       => '+49 2151 000000',
		'phone_label' => '02151 / 000 000',
		'email'       => 'info@krefelder-holzhacker.de',
		'lat'         => '51.3388',
		'lng'         => '6.5853',
		'area'        => array( 'Krefeld', 'Meerbusch', 'Willich', 'Tönisvorst', 'Moers', 'Duisburg', 'Neuss' ),
	);
}

/**
 * Theme-Setup.
 */
function holzhacker_setup() {
	load_theme_textdomain( 'holzhacker', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 240,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Hauptnavigation', 'holzhacker' ),
			'legal'   => __( 'Rechtliches (Footer)', 'holzhacker' ),
		)
	);
}
add_action( 'after_setup_theme', 'holzhacker_setup' );

/**
 * CSS & JS einbinden. Schriften sind lokal gehostet (DSGVO-konform,
 * keine Verbindung zu Google Fonts).
 */
function holzhacker_enqueue_assets() {
	wp_enqueue_style(
		'holzhacker-style',
		get_stylesheet_uri(),
		array(),
		HOLZHACKER_VERSION
	);

	wp_enqueue_script(
		'holzhacker-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		HOLZHACKER_VERSION,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);
}
add_action( 'wp_enqueue_scripts', 'holzhacker_enqueue_assets' );

/**
 * Wichtigste Schriftschnitte vorladen (verhindert Layout-Sprünge).
 */
function holzhacker_preload_fonts() {
	$fonts = array( 'oswald-latin-700-normal.woff2', 'source-sans-3-latin-400-normal.woff2' );
	foreach ( $fonts as $font ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
			esc_url( get_template_directory_uri() . '/assets/fonts/' . $font )
		);
	}
}
add_action( 'wp_head', 'holzhacker_preload_fonts', 1 );

/**
 * Meta-Description für die Startseite (falls kein SEO-Plugin aktiv ist).
 */
function holzhacker_meta_description() {
	if ( ! is_front_page() || defined( 'WPSEO_VERSION' ) || class_exists( 'RankMath' ) ) {
		return;
	}
	$desc = 'Krefelder Holzhacker – Ihr Baumdienst in Krefeld: Baumpflege, fachgerechter Rückschnitt, Seilklettertechnik und sichere Baumfällung. Jetzt kostenloses Angebot anfordern!';
	printf( '<meta name="description" content="%s">' . "\n", esc_attr( $desc ) );
}
add_action( 'wp_head', 'holzhacker_meta_description', 2 );

/**
 * Strukturierte Daten (Schema.org LocalBusiness) für lokales SEO.
 */
function holzhacker_local_business_schema() {
	if ( ! is_front_page() ) {
		return;
	}
	$b = holzhacker_business();

	$schema = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'LocalBusiness',
		'additionalType' => 'https://www.wikidata.org/wiki/Q1361919', // Baumpflege.
		'name'        => $b['name'],
		'description' => 'Baumdienst aus Krefeld: Baumpflege, Rückschnitt, Seilklettertechnik und Baumfällung.',
		'url'         => home_url( '/' ),
		'telephone'   => $b['phone'],
		'email'       => $b['email'],
		'address'     => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => $b['street'],
			'postalCode'      => $b['zip'],
			'addressLocality' => $b['city'],
			'addressRegion'   => $b['region'],
			'addressCountry'  => 'DE',
		),
		'geo'         => array(
			'@type'     => 'GeoCoordinates',
			'latitude'  => $b['lat'],
			'longitude' => $b['lng'],
		),
		'areaServed'  => array_map(
			function ( $city ) {
				return array(
					'@type' => 'City',
					'name'  => $city,
				);
			},
			$b['area']
		),
		'priceRange'  => '€€',
	);

	if ( has_custom_logo() ) {
		$logo = wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ), 'full' );
		if ( $logo ) {
			$schema['logo'] = $logo;
		}
	}

	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
add_action( 'wp_head', 'holzhacker_local_business_schema' );

/**
 * Fallback-Navigation (One-Pager-Anker), solange im Backend kein Menü
 * für "primary" zugewiesen ist.
 */
function holzhacker_nav_items() {
	return array(
		'home'       => __( 'Start', 'holzhacker' ),
		'ueber-uns'  => __( 'Über uns', 'holzhacker' ),
		'leistungen' => __( 'Leistungen', 'holzhacker' ),
		'zertifikate' => __( 'Zertifikate', 'holzhacker' ),
		'referenzen' => __( 'Referenzen', 'holzhacker' ),
		'kontakt'    => __( 'Kontakt', 'holzhacker' ),
	);
}

function holzhacker_fallback_menu() {
	$base = is_front_page() ? '' : home_url( '/' );
	echo '<ul id="primary-menu" class="nav__list">';
	foreach ( holzhacker_nav_items() as $id => $label ) {
		printf(
			'<li class="nav__item"><a class="nav__link" href="%s#%s">%s</a></li>',
			esc_url( $base ),
			esc_attr( $id ),
			esc_html( $label )
		);
	}
	echo '</ul>';
}

/**
 * Kontaktformular-Verarbeitung (admin-post.php).
 * Versendet die Anfrage per wp_mail() inkl. optionalem Foto-Anhang.
 */
function holzhacker_handle_contact() {
	$redirect = home_url( '/#kontakt' );

	if ( ! isset( $_POST['holzhacker_contact_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['holzhacker_contact_nonce'] ) ), 'holzhacker_contact' ) ) {
		wp_safe_redirect( add_query_arg( 'kontakt', 'fehler', $redirect ) );
		exit;
	}

	// Honeypot: Bots füllen das versteckte Feld aus.
	if ( ! empty( $_POST['website'] ) ) {
		wp_safe_redirect( add_query_arg( 'kontakt', 'danke', $redirect ) );
		exit;
	}

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
	$consent = ! empty( $_POST['privacy'] );

	if ( '' === $name || ! is_email( $email ) || '' === $message || ! $consent ) {
		wp_safe_redirect( add_query_arg( 'kontakt', 'unvollstaendig', $redirect ) );
		exit;
	}

	$attachments = array();
	$tmp_file    = '';

	if ( ! empty( $_FILES['photo']['name'] ) && isset( $_FILES['photo']['error'] ) && UPLOAD_ERR_OK === $_FILES['photo']['error'] ) {
		$max_size = 8 * MB_IN_BYTES;
		$allowed  = array(
			'jpg|jpeg|jpe' => 'image/jpeg',
			'png'          => 'image/png',
			'webp'         => 'image/webp',
			'heic'         => 'image/heic',
		);

		$check = wp_check_filetype_and_ext( $_FILES['photo']['tmp_name'], $_FILES['photo']['name'], $allowed );

		if ( $_FILES['photo']['size'] > $max_size || empty( $check['type'] ) ) {
			wp_safe_redirect( add_query_arg( 'kontakt', 'datei', $redirect ) );
			exit;
		}

		$tmp_file = trailingslashit( get_temp_dir() ) . wp_unique_filename( get_temp_dir(), 'anfrage-' . sanitize_file_name( $_FILES['photo']['name'] ) );
		if ( move_uploaded_file( $_FILES['photo']['tmp_name'], $tmp_file ) ) {
			$attachments[] = $tmp_file;
		}
	}

	$b       = holzhacker_business();
	$subject = sprintf( 'Neue Anfrage über die Website von %s', $name );
	$body    = "Name: {$name}\nE-Mail: {$email}\nTelefon: {$phone}\n\nNachricht:\n{$message}\n";
	$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

	$sent = wp_mail( $b['email'], $subject, $body, $headers, $attachments );

	if ( $tmp_file && file_exists( $tmp_file ) ) {
		wp_delete_file( $tmp_file );
	}

	wp_safe_redirect( add_query_arg( 'kontakt', $sent ? 'danke' : 'fehler', $redirect ) );
	exit;
}
add_action( 'admin_post_nopriv_holzhacker_contact', 'holzhacker_handle_contact' );
add_action( 'admin_post_holzhacker_contact', 'holzhacker_handle_contact' );

/**
 * Inline-SVG-Icons.
 *
 * @param string $name Icon-Name.
 * @return string SVG-Markup.
 */
function holzhacker_icon( $name ) {
	$icons = array(
		'climb'  => '<path d="M12 2v6"/><circle cx="12" cy="11" r="3"/><path d="M12 14v4l-3 4M12 18l3 4M9 13l-4-3M15 13l4-3"/><path d="M12 2c4 0 7 2 9 5"/>',
		'saw'    => '<path d="M3 17 17 3l4 4L7 21H3z"/><path d="m7 13 2 2M10 10l2 2M13 7l2 2"/>',
		'tree'   => '<path d="M12 22v-6"/><path d="M12 2 5 12h4l-3 4h12l-3-4h4z"/>',
		'shield' => '<path d="M12 2 4 5v6c0 5 3.5 9.5 8 11 4.5-1.5 8-6 8-11V5z"/><path d="m9 12 2 2 4-4"/>',
		'award'  => '<circle cx="12" cy="9" r="6"/><path d="m8.5 14-1.5 8 5-3 5 3-1.5-8"/>',
		'helmet' => '<path d="M3 17h18M5 17v-3a7 7 0 0 1 14 0v3"/><path d="M12 7V4"/>',
		'doc'    => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M8 13h8M8 17h5"/>',
		'star'   => '<path d="m12 2 3 7h7l-5.5 4.5 2 7.5L12 17l-6.5 4 2-7.5L2 9h7z"/>',
		'phone'  => '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2z"/>',
		'mail'   => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 6-10 7L2 6"/>',
		'pin'    => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/>',
		'image'  => '<rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-5-5L5 21"/>',
		'upload' => '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12"/>',
	);

	if ( ! isset( $icons[ $name ] ) ) {
		return '';
	}

	return '<svg class="icon icon--' . esc_attr( $name ) . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . $icons[ $name ] . '</svg>';
}
