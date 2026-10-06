<?php
/**
 * Footer-Template
 *
 * @package Holzhacker
 */

$holzhacker_b     = holzhacker_business();
$holzhacker_tel   = preg_replace( '/[^0-9+]/', '', $holzhacker_b['phone'] );
$holzhacker_imp   = get_page_by_path( 'impressum' );
$holzhacker_priv  = get_privacy_policy_url();
?>

<footer class="site-footer">
	<div class="container site-footer__grid">
		<div class="site-footer__col">
			<p class="site-footer__brand">Krefelder Holzhacker</p>
			<p><?php esc_html_e( 'Professionelle Baumpflege & Fällung in Krefeld und Umgebung.', 'holzhacker' ); ?></p>
		</div>

		<div class="site-footer__col">
			<h2 class="site-footer__title"><?php esc_html_e( 'Kontakt', 'holzhacker' ); ?></h2>
			<address class="site-footer__address">
				<span class="contact-line"><?php echo holzhacker_icon( 'pin' ); // phpcs:ignore ?>
					<span><?php echo esc_html( $holzhacker_b['street'] ); ?><br><?php echo esc_html( $holzhacker_b['zip'] . ' ' . $holzhacker_b['city'] ); ?></span>
				</span>
				<a class="contact-line" href="tel:<?php echo esc_attr( $holzhacker_tel ); ?>"><?php echo holzhacker_icon( 'phone' ); // phpcs:ignore ?>
					<span><?php echo esc_html( $holzhacker_b['phone_label'] ); ?></span>
				</a>
				<a class="contact-line" href="mailto:<?php echo esc_attr( antispambot( $holzhacker_b['email'] ) ); ?>"><?php echo holzhacker_icon( 'mail' ); // phpcs:ignore ?>
					<span><?php echo esc_html( antispambot( $holzhacker_b['email'] ) ); ?></span>
				</a>
			</address>
		</div>

		<div class="site-footer__col">
			<h2 class="site-footer__title"><?php esc_html_e( 'Einsatzgebiet', 'holzhacker' ); ?></h2>
			<p><?php echo esc_html( implode( ' · ', $holzhacker_b['area'] ) ); ?></p>
		</div>
	</div>

	<div class="site-footer__bottom">
		<div class="container site-footer__bottom-inner">
			<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> Krefelder Holzhacker – Aron &amp; Peter</p>
			<nav aria-label="<?php esc_attr_e( 'Rechtliches', 'holzhacker' ); ?>">
				<?php if ( has_nav_menu( 'legal' ) ) : ?>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'legal',
							'container'      => false,
							'menu_class'     => 'legal-nav',
							'depth'          => 1,
						)
					);
					?>
				<?php else : ?>
					<ul class="legal-nav">
						<li><a href="<?php echo esc_url( $holzhacker_imp ? get_permalink( $holzhacker_imp ) : home_url( '/impressum/' ) ); ?>"><?php esc_html_e( 'Impressum', 'holzhacker' ); ?></a></li>
						<li><a href="<?php echo esc_url( $holzhacker_priv ? $holzhacker_priv : home_url( '/datenschutz/' ) ); ?>"><?php esc_html_e( 'Datenschutz', 'holzhacker' ); ?></a></li>
					</ul>
				<?php endif; ?>
			</nav>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
