<?php

use Currency\CurrencyPlugin;
use Currency\FileManager;

/**
 * Currency plugin
 *
 *
 * @link              http://premmerce.com
 * @since             1.0.0
 * @package           Currency
 *
 * @wordpress-plugin
 * Plugin Name:       Currency
 * Plugin URI:        http://premmerce.com
 * Description:       Create/Edit currencies
 * Version:           1.0
 * Author:            premmerce
 * Author URI:        http://premmerce.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp_currencies
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

call_user_func( function () {

	require_once plugin_dir_path( __FILE__ ) . 'autoload.php';

	$main = new CurrencyPlugin( new FileManager( __FILE__ ) );

	register_activation_hook( __FILE__, [ $main, 'activate' ] );

	register_deactivation_hook( __FILE__, [ $main, 'deactivate' ] );

	register_uninstall_hook( __FILE__, [ CurrencyPlugin::class, 'uninstall' ] );

	$main->run();
} );