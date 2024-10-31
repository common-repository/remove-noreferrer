<?php
/**
 * Abstract class for the Plugin
 *
 * @package Remove_Noreferrer
 * @subpackage Base
 * @since 2.0.0
 */

namespace Remove_Noreferrer\Base;

/**
 * Abstract class for the plugins
 *
 * @since 2.0.0
 */
abstract class Plugin {
	/**
	 * Used to format needed action
	 *
	 * @since 2.0.0
	 * @access private
	 * @var string $stringified_class
	 */
	private $stringified_class;

	/**
	 * Constructor
	 *
	 * @since 2.0.0
	 * @access public
	 */
	public function __construct() {
		$this->stringified_class = $this->stringify_called_class();

		$this->do_action( 'loaded' );
	}

	/**
	 * Fires required action depends on plugin's instance name
	 *
	 * @since 2.0.0
	 * @access private
	 *
	 * @param string $name Action name.
	 */
	protected function do_action( $name ) {
		// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.DynamicHooknameFound
		do_action( $this->format_action( $name ) );
		// phpcs:enable WordPress.NamingConventions.PrefixAllGlobals.DynamicHooknameFound
	}

	/**
	 * Get child class
	 *
	 * @since 2.0.0
	 * @access private
	 *
	 * @return array
	 */
	private function stringify_called_class() {
		return strtolower( str_replace( '\\', '_', get_called_class() ) );
	}

	/**
	 * Formats action depends on child class
	 *
	 * @since 2.0.0
	 * @access private
	 *
	 * @param string $suffix Action's suffix.
	 *
	 * @return string
	 */
	private function format_action( $suffix ) {
		return sprintf( '%s_%s', $this->stringified_class, $suffix );
	}
}

