# Elementor Widget Starter

Boilerplate for building **custom Elementor widgets**. Ships with a complete, working example — a **Testimonial Card** widget — covering every common control type so you can duplicate it and build your own.

## The example widget

**Testimonial Card** (`ews-testimonial-card`) under the *General* category:

- **Content tab** — review text (textarea), client name, role/company, avatar (media), star rating (slider 1–5), layout select (card / big quote)
- **Style tab** — card background, text color (live via `selectors`), alignment (choose control)
- Live preview in the editor via `content_template()` (Underscore.js)
- Entrance animation on scroll (IntersectionObserver in `assets/js/widget.js`)
- All output escaped (`esc_html` / `esc_url` / `esc_attr`)

## Files

| File | Purpose |
|---|---|
| `wp-elementor-widget-starter.php` | Plugin bootstrap: boots only when Elementor is loaded, registers widgets, styles and scripts |
| `widgets/class-testimonial-card-widget.php` | The example widget class |
| `assets/css/widget.css` | Front-end styles |
| `assets/js/widget.js` | Editor script (`frontend/element_ready` hook) |

## Building your own widget

1. Copy `widgets/class-testimonial-card-widget.php` → `widgets/class-my-widget.php`
2. Rename the class (e.g. `EWS_My_Widget`), change `get_name()`, `get_title()`, `get_icon()`
3. Rewrite `register_controls()` with your controls — the Content and Style tab pattern is already there
4. Rewrite `render()` (front-end) and `content_template()` (editor preview)
5. Register it in `ews_register_widgets()`:

```php
function ews_register_widgets( $widgets_manager ) {
	$widgets_manager->register( new \EWS_Testimonial_Card_Widget() );
	$widgets_manager->register( new \EWS_My_Widget() );
}
```

## Requirements

- WordPress 6.0+, PHP 7.4+
- Elementor (free) installed and activated

## Installation

1. Copy the whole folder into `wp-content/plugins/wp-elementor-widget-starter/`
2. Activate **Elementor Testimonial Widget (Starter)**
3. Edit any page with Elementor → search **"Testimonial Card"**

MIT licensed.
