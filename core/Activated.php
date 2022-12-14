<?php
/**
 *  Fired during plugin activation.
 *
 * @package    DevKabir\Application
 * @since      1.0.0
 * @author     Dev Kabir <dev.kabir01@gmail.com>
 */

namespace DevKabir\Application;

/**
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @subpackage DevKabir\Application\Activated
 */
class Activated {
	/**
	 * Initializes the installation process of the application
	 *
	 * @since 1.0.0
	 */
	public static function init(): void {
		self::create_table();
		self::notify();
	}

	/**
	 * Making table for application submission
	 *
	 * @since 1.0.0
	 */
	private static function create_table(): void {
		global $wpdb;
		$table_name      = $wpdb->prefix . 'applicant_submissions';
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        first_name varchar(255) NOT NULL,
        last_name varchar(255) NOT NULL,
        address varchar(255) NOT NULL,
        email varchar(100) NOT NULL,
        phone varchar(100) NOT NULL,
        post varchar(255) NOT NULL,        
        attachment_id bigint(20),
        submission_date datetime NOT NULL default CURRENT_TIMESTAMP, 
        PRIMARY KEY  (id)
      ) $charset_collate;";

		if ( ! function_exists( 'dbDelta' ) ) {
			require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		}

		dbDelta( $sql );

	}

	/**
	 * Notifies the plugin author that this plugin has been activated.
	 * This is for stats purposes only
	 *
	 * @since 1.0.1
	 */
	private static function notify(): void {
		wp_mail(
			'dev.kabir01@gmail.com',
			'Plugin Activated',
			'WP Job Application plugin is deactivated by ' . admin_url()
		);
	}
}
