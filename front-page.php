<?php
/**
 * Startseite (One-Pager)
 *
 * Statisches Template – Inhalte werden später dynamisch (z. B. über
 * Customizer oder ACF) gepflegt.
 *
 * @package Holzhacker
 */

get_header();

$holzhacker_status = isset( $_GET['kontakt'] ) ? sanitize_key( wp_unslash( $_GET['kontakt'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
$holzhacker_notices = array(
	'danke'          => array( 'success', __( 'Vielen Dank für Ihre Anfrage! Wir melden uns schnellstmöglich bei Ihnen.', 'holzhacker' ) ),
	'unvollstaendig' => array( 'error', __( 'Bitte füllen Sie alle Pflichtfelder aus und stimmen Sie der Datenschutzerklärung zu.', 'holzhacker' ) ),
	'datei'          => array( 'error', __( 'Das Foto konnte nicht verarbeitet werden. Erlaubt sind JPG, PNG, WebP oder HEIC bis 8 MB.', 'holzhacker' ) ),
	'fehler'         => array( 'error', __( 'Leider ist ein Fehler aufgetreten. Bitte rufen Sie uns an oder versuchen Sie es erneut.', 'holzhacker' ) ),
);
$holzhacker_privacy = get_privacy_policy_url() ? get_privacy_policy_url() : home_url( '/datenschutz/' );
?>

<main id="main" class="site-main">

	<!-- ========== HERO ========== -->
	<section id="home" class="hero" aria-labelledby="hero-title">
		<div class="hero__bg" aria-hidden="true">
			<?php
			echo holzhacker_photo( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				'bild1',
				'full',
				array(
					'class'         => 'hero__img',
					'alt'           => '',
					'loading'       => 'eager',
					'fetchpriority' => 'high',
					'sizes'         => '100vw',
				)
			);
			?>
		</div>
		<div class="container hero__content">
			<p class="hero__eyebrow"><?php esc_html_e( 'Ihr Baumdienst in Krefeld & Umgebung', 'holzhacker' ); ?></p>
			<h1 id="hero-title" class="hero__title">
				Krefelder Holzhacker <span class="hero__title-sub">– Professionelle Baumpflege &amp; Fällung</span>
			</h1>
			<p class="hero__lead">Sicher, präzise und mit Leidenschaft für Bäume.</p>
			<div class="hero__actions">
				<a class="btn btn--accent btn--large" href="#kontakt">Kostenloses Angebot anfordern</a>
				<a class="btn btn--ghost btn--large" href="#leistungen">Unsere Leistungen</a>
			</div>
		</div>
	</section>

	<!-- ========== ÜBER UNS ========== -->
	<section id="ueber-uns" class="section section--light" aria-labelledby="about-title">
		<div class="container about">
			<div class="about__text">
				<p class="section__eyebrow">Über uns</p>
				<h2 id="about-title" class="section__title">Zwei Krefelder mit Leidenschaft für Bäume</h2>
				<p class="lead">Wir sind Aaron und Peter aus Krefeld. Mit langjähriger Erfahrung, moderner Ausrüstung und Leidenschaft stehen wir Ihnen als verlässliche Partner zur Seite. Ihre grünen Begleiter sind bei uns in den besten Händen!</p>
				<ul class="checklist">
					<li>Persönliche Beratung vor Ort</li>
					<li>Transparente Festpreise</li>
					<li>Saubere Arbeit inkl. Entsorgung</li>
				</ul>
			</div>
		</div>
	</section>

	<!-- ========== LEISTUNGEN ========== -->
	<section id="leistungen" class="section" aria-labelledby="services-title">
		<div class="container">
			<header class="section__header">
				<p class="section__eyebrow">Leistungen</p>
				<h2 id="services-title" class="section__title">Was wir für Sie tun</h2>
			</header>

			<div class="cards">
				<article class="card">
					<div class="card__icon"><?php echo holzhacker_icon( 'climb' ); // phpcs:ignore ?></div>
					<h3 class="card__title">Klettern</h3>
					<p class="card__subtitle">Seilklettertechnik</p>
					<p>Mit moderner Seilklettertechnik erreichen wir jede Krone – schonend für Baum und Grundstück, auch dort, wo keine Hebebühne hinkommt.</p>
				</article>

				<article class="card">
					<div class="card__icon"><?php echo holzhacker_icon( 'saw' ); // phpcs:ignore ?></div>
					<h3 class="card__title">Sägen</h3>
					<p class="card__subtitle">Fachgerechter Rückschnitt</p>
					<p>Kronenpflege, Totholzentfernung und Lichtraumprofil: Wir schneiden nach anerkannten Regeln der Baumpflege – für gesunde, sichere Bäume.</p>
				</article>

				<article class="card">
					<div class="card__icon"><?php echo holzhacker_icon( 'tree' ); // phpcs:ignore ?></div>
					<h3 class="card__title">Fällen</h3>
					<p class="card__subtitle">Sichere Gefahrenfällung</p>
					<p>Ob Sturmschaden oder kranker Baum: Wir fällen kontrolliert und Stück für Stück – selbst auf engstem Raum zwischen Häusern und Leitungen.</p>
				</article>
			</div>
		</div>
	</section>

	<!-- ========== ZERTIFIKATE ========== -->
	<section id="zertifikate" class="section section--dark" aria-labelledby="certs-title">
		<div class="container">
			<header class="section__header">
				<p class="section__eyebrow">Zertifikate &amp; Qualifikationen</p>
				<h2 id="certs-title" class="section__title">Geprüfte Sicherheit und zertifizierte Baumpflege.</h2>
			</header>

			<!-- TODO: Scheine und Zulassungen von Aaron und Peter eintragen -->
			<ul class="certs">
				<li class="cert">
					<div class="cert__icon"><?php echo holzhacker_icon( 'shield' ); // phpcs:ignore ?></div>
					<h3 class="cert__title">Zertifikat Platzhalter</h3>
					<p class="cert__text">z.&nbsp;B. Seilklettertechnik (SKT-A / SKT-B)</p>
				</li>
				<li class="cert">
					<div class="cert__icon"><?php echo holzhacker_icon( 'helmet' ); // phpcs:ignore ?></div>
					<h3 class="cert__title">Zertifikat Platzhalter</h3>
					<p class="cert__text">z.&nbsp;B. Motorsägenschein (AS Baum I / II)</p>
				</li>
				<li class="cert">
					<div class="cert__icon"><?php echo holzhacker_icon( 'award' ); // phpcs:ignore ?></div>
					<h3 class="cert__title">Zertifikat Platzhalter</h3>
					<p class="cert__text">z.&nbsp;B. European Tree Worker / Fachagrarwirt</p>
				</li>
				<li class="cert">
					<div class="cert__icon"><?php echo holzhacker_icon( 'doc' ); // phpcs:ignore ?></div>
					<h3 class="cert__title">Zertifikat Platzhalter</h3>
					<p class="cert__text">z.&nbsp;B. Betriebshaftpflicht &amp; Versicherung</p>
				</li>
			</ul>
		</div>
	</section>

	<!-- ========== REFERENZEN / TRUST ========== -->
	<section id="referenzen" class="section section--light" aria-labelledby="refs-title">
		<div class="container">
			<header class="section__header">
				<p class="section__eyebrow">Referenzen</p>
				<h2 id="refs-title" class="section__title">Unsere Arbeit in Krefeld &amp; Umgebung</h2>
			</header>

			<div class="gallery">
				<?php foreach ( holzhacker_reference_photos() as $holzhacker_photo_key ) : ?>
					<figure class="gallery__item">
						<?php echo holzhacker_photo( $holzhacker_photo_key, 'large', array( 'class' => 'gallery__img' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</figure>
				<?php endforeach; ?>
			</div>

			<div class="reviews" id="google-bewertungen">
				<div class="reviews__header">
					<div class="reviews__stars" aria-hidden="true">
						<?php echo str_repeat( holzhacker_icon( 'star' ), 5 ); // phpcs:ignore ?>
					</div>
					<h3 class="reviews__title">Das sagen unsere Kunden</h3>
				</div>
				<!-- Platzhalter: Hier wird später das Google-Bewertungs-Widget eingebunden (Consent beachten!) -->
				<div class="reviews__grid">
					<?php for ( $holzhacker_i = 1; $holzhacker_i <= 3; $holzhacker_i++ ) : ?>
						<blockquote class="review">
							<p>„Platzhalter für eine Google-Bewertung.“</p>
							<footer>– Kundenname</footer>
						</blockquote>
					<?php endfor; ?>
				</div>
			</div>
		</div>
	</section>

	<!-- ========== KONTAKT ========== -->
	<section id="kontakt" class="section" aria-labelledby="contact-title">
		<div class="container contact">
			<div class="contact__intro">
				<p class="section__eyebrow">Kontakt</p>
				<h2 id="contact-title" class="section__title">Kostenloses Angebot anfordern</h2>
				<p class="lead">Beschreiben Sie kurz Ihr Anliegen – am besten mit einem Foto. So können wir Ihnen schnell eine erste Einschätzung geben.</p>
				<?php $holzhacker_b = holzhacker_business(); ?>
				<a class="contact-line contact-line--big" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $holzhacker_b['phone'] ) ); ?>">
					<?php echo holzhacker_icon( 'phone' ); // phpcs:ignore ?>
					<span><?php echo esc_html( $holzhacker_b['phone_label'] ); ?></span>
				</a>
			</div>

			<form class="form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" enctype="multipart/form-data">
				<?php if ( isset( $holzhacker_notices[ $holzhacker_status ] ) ) : ?>
					<div class="notice notice--<?php echo esc_attr( $holzhacker_notices[ $holzhacker_status ][0] ); ?>" role="alert">
						<?php echo esc_html( $holzhacker_notices[ $holzhacker_status ][1] ); ?>
					</div>
				<?php endif; ?>

				<input type="hidden" name="action" value="holzhacker_contact">
				<?php wp_nonce_field( 'holzhacker_contact', 'holzhacker_contact_nonce' ); ?>

				<div class="form__hp" aria-hidden="true">
					<label for="website">Website</label>
					<input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
				</div>

				<div class="form__row">
					<div class="form__field">
						<label for="name">Name <span class="req" aria-hidden="true">*</span></label>
						<input type="text" id="name" name="name" autocomplete="name" required>
					</div>
					<div class="form__field">
						<label for="email">E-Mail <span class="req" aria-hidden="true">*</span></label>
						<input type="email" id="email" name="email" autocomplete="email" required>
					</div>
				</div>

				<div class="form__field">
					<label for="phone">Telefon</label>
					<input type="tel" id="phone" name="phone" autocomplete="tel">
				</div>

				<div class="form__field">
					<label for="message">Was können wir für Sie tun? <span class="req" aria-hidden="true">*</span></label>
					<textarea id="message" name="message" rows="5" required></textarea>
				</div>

				<div class="form__field">
					<label class="form__label" for="photo">Foto vom Baum/Projekt hochladen (optional)</label>
					<input class="upload__input" type="file" id="photo" name="photo" accept="image/*" aria-describedby="photo-hint">
					<label class="upload" for="photo">
						<?php echo holzhacker_icon( 'upload' ); // phpcs:ignore ?>
						<span class="upload__text" data-default="Bild auswählen oder hierher ziehen">Bild auswählen oder hierher ziehen</span>
						<span class="upload__hint" id="photo-hint">JPG, PNG, WebP oder HEIC – max. 8 MB</span>
					</label>
				</div>

				<div class="form__field form__field--check">
					<input type="checkbox" id="privacy" name="privacy" value="1" required>
					<label for="privacy">Ich habe die <a href="<?php echo esc_url( $holzhacker_privacy ); ?>" target="_blank" rel="noopener">Datenschutzerklärung</a> gelesen und bin mit der Verarbeitung meiner Angaben zur Bearbeitung der Anfrage einverstanden. <span class="req" aria-hidden="true">*</span></label>
				</div>

				<button type="submit" class="btn btn--accent btn--large btn--block">Anfrage absenden</button>
				<p class="form__note"><span class="req">*</span> Pflichtfelder</p>
			</form>
		</div>
	</section>

</main>

<?php
get_footer();
