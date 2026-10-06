<?php
/**
 * Header-Template
 *
 * @package Holzhacker
 */

$holzhacker_b = holzhacker_business();
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#1f3d2b">
	<script>document.documentElement.classList.add('js');</script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Zum Inhalt springen', 'holzhacker' ); ?></a>

<header class="site-header" id="site-header">
	<div class="container site-header__inner">
		<div class="site-branding">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php echo holzhacker_icon( 'tree' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span class="site-logo__text">
						<span class="site-logo__top">Krefelder</span>
						<span class="site-logo__bottom">Holzhacker</span>
					</span>
				</a>
			<?php endif; ?>
		</div>

		<button class="nav-toggle" type="button" aria-controls="site-nav" aria-expanded="false">
			<span class="nav-toggle__bar" aria-hidden="true"></span>
			<span class="screen-reader-text"><?php esc_html_e( 'Menü öffnen', 'holzhacker' ); ?></span>
		</button>

		<nav class="site-nav" id="site-nav" aria-label="<?php esc_attr_e( 'Hauptnavigation', 'holzhacker' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'nav__list',
					'fallback_cb'    => 'holzhacker_fallback_menu',
					'depth'          => 1,
				)
			);
			?>
			<a class="btn btn--small btn--accent site-nav__cta" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $holzhacker_b['phone'] ) ); ?>">
				<?php echo holzhacker_icon( 'phone' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<span><?php echo esc_html( $holzhacker_b['phone_label'] ); ?></span>
			</a>
		</nav>
	</div>
</header>
