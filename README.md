# Holzhacker – WordPress-Theme für Krefelder Holzhacker

Maßgeschneidertes, responsives One-Pager-Theme (Mobile First) für den Baumdienst Krefelder Holzhacker.

## Installation
Repository als Ordner `holzhacker` nach `wp-content/themes/` kopieren/klonen, Theme aktivieren und unter
*Einstellungen → Lesen* eine statische Startseite festlegen (die Startseite nutzt automatisch `front-page.php`).

## Struktur
| Datei | Zweck |
|---|---|
| `style.css` | Theme-Header + komplettes Styling (Design-Tokens in `:root`) |
| `functions.php` | Theme-Support, Enqueueing, Firmendaten, LocalBusiness-Schema, Kontaktformular-Handler |
| `header.php` / `footer.php` | Navigation (Anker-Links) bzw. Kontakt, Impressum, Datenschutz |
| `front-page.php` | One-Pager: `#home`, `#ueber-uns`, `#leistungen`, `#zertifikate`, `#referenzen`, `#kontakt` |
| `index.php` | Fallback für Unterseiten (Impressum, Datenschutz) |
| `assets/js/main.js` | Mobile Menü, aktive Sektion, Animationen, Datei-Upload |
| `assets/fonts/` | Oswald & Source Sans 3, lokal gehostet (DSGVO, keine Google-Fonts-Verbindung) |

## TODO
- Echte Firmendaten in `holzhacker_business()` (`functions.php`) eintragen
- Wald-Aquarell in `.hero__bg` (`style.css`) hinterlegen
- Zertifikate, Projektbilder und Google-Bewertungen ergänzen
- Seiten „Impressum“ (Slug `impressum`) und Datenschutz anlegen
- Für zuverlässigen Mailversand ein SMTP-Plugin einrichten
