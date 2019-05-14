<?php
/**
 * CF_Phone_Better_Intl_Polylang class.
 */

class CF_Phone_Better_Intl_Polylang {

	/**
	 * Version.
	 *
	 * @since 0.1
	 * @var string
	 */
	public $version = '0.1';

	/**
	 * Constructor.
	 *
	 * @since 0.1
	 */
	public function __construct() {

		$this->register_hooks();

	}

	/**
	 * Register hooks.
	 *
	 * @since 0.1
	 */
	public function register_hooks() {

		// add field config template
		add_action( 'caldera_forms_field_settings_template', [__CLASS__, 'add_config_template'], 10, 2 );
		// filter phone better js options
		add_filter( 'caldera_forms_phone_js_options', [__CLASS__, 'filter_phone_better_initial_country'], 3, 10 );

	}

	/**
	 * Filters the Phone Better Intl options and sets the
	 * initialCountry to the current Pollylanf country.
	 *
	 * @since 0.1
	 * @param array $options Options to use for this field
	 * @param array $field The field config
	 * @param array $form The form config
	 * @return array $options The modified options
	 */
	public function filter_phone_better_initial_country( $options, $field, $form ) {

		// bail if not enabled
		if ( ! isset( $field['config']['is_pollylang_initial_country'] ) )
			return $options;

		// get current locale
		$locale = pll_current_language( 'locale' );

		// bail if no locale
		if ( empty( $locale ) ) return $options;

		// extract the country iso
		$initial_country = substr( $locale, strpos( $locale, '_' ) + 1 );

		// set initial conuntry to locale
		if ( ! empty( $initial_country ) )
			$options['initialCountry'] = strtolower( $initial_country );

		return $options;

	}

	/**
	 * Adds config template for Phone Better fields.
	 *
	 * @since 0.1
	 * @param array $config The field config
	 * @param string $field_slug The field type slug
	 */
	public function add_config_template( $config, $field_slug ) {

		if ( $field_slug != 'phone_better') return;

		?>
			<div class="caldera-config-group">
				<div class="caldera-config-field">
					<label for="{{_id}}_is_polylang_initial_country">
						<input id="{{_id}}_is_polylang_initial_country" type="checkbox" class="field-config" name="{{_name}}[is_polylang_initial_country]" {{#if is_polylang_initial_country}}checked="checked"{{/if}} value="1">
						<?php _e( 'Set Initial Country based on Polylang current language.', 'caldera-forms-civicrm' ); ?>
					</label>
				</div>
			</div>
		<?php

	}

}
