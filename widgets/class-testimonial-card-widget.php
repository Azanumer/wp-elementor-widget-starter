<?php
/**
 * Testimonial Card widget — a complete example widget you can duplicate
 * and reshape into anything. Shows every common control type:
 * text, textarea, media, slider, color, choose (alignment) and select.
 */

defined('ABSPATH') || exit;

class EWS_Testimonial_Card_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'ews-testimonial-card';
	}

	public function get_title() {
		return esc_html__('Testimonial Card', 'elementor-widget-starter');
	}

	public function get_icon() {
		return 'eicon-testimonial';
	}

	public function get_categories() {
		return array('general');
	}

	public function get_keywords() {
		return array('testimonial', 'review', 'quote', 'card');
	}

	public function get_style_depends() {
		return array('ews-widget');
	}

	public function get_script_depends() {
		return array('ews-widget');
	}

	/**
	 * Controls: Content tab + Style tab.
	 */
	protected function register_controls() {

		$this->start_controls_section('content_section', array(
			'label' => esc_html__('Content', 'elementor-widget-starter'),
			'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
		));

		$this->add_control('review_text', array(
			'label'       => esc_html__('Review text', 'elementor-widget-starter'),
			'type'        => \Elementor\Controls_Manager::TEXTAREA,
			'default'     => esc_html__('This service completely changed how we run our business. Highly recommended!', 'elementor-widget-starter'),
			'placeholder' => esc_html__('Type the testimonial…', 'elementor-widget-starter'),
		));

		$this->add_control('client_name', array(
			'label'   => esc_html__('Client name', 'elementor-widget-starter'),
			'type'    => \Elementor\Controls_Manager::TEXT,
			'default' => esc_html__('Jane Doe', 'elementor-widget-starter'),
		));

		$this->add_control('client_role', array(
			'label'   => esc_html__('Client role / company', 'elementor-widget-starter'),
			'type'    => \Elementor\Controls_Manager::TEXT,
			'default' => esc_html__('Founder, Acme Inc.', 'elementor-widget-starter'),
		));

		$this->add_control('avatar', array(
			'label'   => esc_html__('Avatar', 'elementor-widget-starter'),
			'type'    => \Elementor\Controls_Manager::MEDIA,
			'default' => array('url' => ''),
		));

		$this->add_control('rating', array(
			'label'   => esc_html__('Star rating', 'elementor-widget-starter'),
			'type'    => \Elementor\Controls_Manager::SLIDER,
			'range'   => array('px' => array('min' => 1, 'max' => 5, 'step' => 1)),
			'default' => array('size' => 5),
		));

		$this->add_control('layout', array(
			'label'   => esc_html__('Layout', 'elementor-widget-starter'),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'default' => 'card',
			'options' => array(
				'card'  => esc_html__('Card', 'elementor-widget-starter'),
				'quote' => esc_html__('Big quote', 'elementor-widget-starter'),
			),
		));

		$this->end_controls_section();

		$this->start_controls_section('style_section', array(
			'label' => esc_html__('Style', 'elementor-widget-starter'),
			'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
		));

		$this->add_control('card_bg', array(
			'label'   => esc_html__('Card background', 'elementor-widget-starter'),
			'type'    => \Elementor\Controls_Manager::COLOR,
			'default' => '#ffffff',
			'selectors' => array(
				'{{WRAPPER}} .ews-testimonial' => 'background-color: {{VALUE}};',
			),
		));

		$this->add_control('text_color', array(
			'label'   => esc_html__('Text color', 'elementor-widget-starter'),
			'type'    => \Elementor\Controls_Manager::COLOR,
			'default' => '#333333',
			'selectors' => array(
				'{{WRAPPER}} .ews-testimonial' => 'color: {{VALUE}};',
			),
		));

		$this->add_control('alignment', array(
			'label'   => esc_html__('Alignment', 'elementor-widget-starter'),
			'type'    => \Elementor\Controls_Manager::CHOOSE,
			'default' => 'center',
			'options' => array(
				'left'   => array('title' => esc_html__('Left', 'elementor-widget-starter'), 'icon' => 'eicon-text-align-left'),
				'center' => array('title' => esc_html__('Center', 'elementor-widget-starter'), 'icon' => 'eicon-text-align-center'),
				'right'  => array('title' => esc_html__('Right', 'elementor-widget-starter'), 'icon' => 'eicon-text-align-right'),
			),
			'selectors' => array(
				'{{WRAPPER}} .ews-testimonial' => 'text-align: {{VALUE}};',
			),
		));

		$this->end_controls_section();
	}

	/**
	 * Front-end output. Everything is escaped — never echo raw settings.
	 */
	protected function render() {
		$s      = $this->get_settings_for_display();
		$layout = in_array($s['layout'], array('card', 'quote'), true) ? $s['layout'] : 'card';
		$stars  = max(1, min(5, (int) ($s['rating']['size'] ?? 5)));
		$avatar = !empty($s['avatar']['url']) ? esc_url($s['avatar']['url']) : '';
		?>
		<div class="ews-testimonial ews-layout-<?php echo esc_attr($layout); ?>">
			<div class="ews-stars" aria-label="<?php echo esc_attr(sprintf(__('%d out of 5 stars', 'elementor-widget-starter'), $stars)); ?>">
				<?php for ($i = 0; $i < $stars; $i++) : ?>
					<span class="ews-star">★</span>
				<?php endfor; ?>
			</div>
			<p class="ews-review"><?php echo esc_html($s['review_text']); ?></p>
			<div class="ews-author">
				<?php if ($avatar) : ?>
					<img class="ews-avatar" src="<?php echo $avatar; ?>" alt="<?php echo esc_attr($s['client_name']); ?>" loading="lazy">
				<?php endif; ?>
				<div class="ews-author-meta">
					<strong class="ews-name"><?php echo esc_html($s['client_name']); ?></strong>
					<?php if (!empty($s['client_role'])) : ?>
						<span class="ews-role"><?php echo esc_html($s['client_role']); ?></span>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Live editor preview template (Underscore.js).
	 */
	protected function content_template() {
		?>
		<div class="ews-testimonial ews-layout-{{ settings.layout }}">
			<div class="ews-stars">
				<# for ( var i = 0; i < settings.rating.size; i++ ) { #>
					<span class="ews-star">★</span>
				<# } #>
			</div>
			<p class="ews-review">{{{ settings.review_text }}}</p>
			<div class="ews-author">
				<# if ( settings.avatar.url ) { #>
					<img class="ews-avatar" src="{{ settings.avatar.url }}" alt="">
				<# } #>
				<div class="ews-author-meta">
					<strong class="ews-name">{{{ settings.client_name }}}</strong>
					<span class="ews-role">{{{ settings.client_role }}}</span>
				</div>
			</div>
		</div>
		<?php
	}
}
