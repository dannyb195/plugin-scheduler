<?php
/**
 * undocumented class
 *
 * @package default
 * @author
 **/
class DB_Plugin_Scheduler {

	public $active_plugins;

	public function __construct() {
		// $active_plugins = get_option( 'active_plugins' );
		$this->active_plugins = get_option( 'active_plugins' );
		add_action( 'admin_menu', array( $this, 'admin_page' ) );
		add_action( 'init', array( $this, 'active_plugins' ), 99 );
	}

	/**
	 * [admin_page description]
	 * @return [type] [description]
	 */
	public function admin_page() {
		add_submenu_page(
			'tools.php',
			__( 'Plugin Scheduler', 'plugin-scheduler' ),
			__( 'Plugin Scheduler', '' ),
			'update_core',
			'plugin-scheduler',
			array( $this, 'admin_page_output' )
		);
	}

	/**
	 * [admin_page_output description]
	 * @return [type] [description]
	 */
	public function admin_page_output() {
		echo 'options<pre>';
		print_r( get_option( 'plugin-scheduler-data' ) );
		echo '</pre>';
		?>
		<form>
				<input type="checkbox" name="plugin_data[day][monday]" class="" />
				<input type="checkbox" name="plugin_data[day][tuesday]" class="" />
				<input type="checkbox" name="plugin_data[day][wednesday]" class="" />
				<input type="checkbox" name="plugin_data[day][thursday]" class="" />
				<input type="checkbox" name="plugin_data[day][friday]" class="" />
				<input type="checkbox" name="plugin_data[day][saturday]" class="" />
				<input type="checkbox" name="plugin_data[day][sunday]" class="" />
			<?php foreach ( $this->active_plugins as $plugin ) : ?>
				<input type="checkbox" name="plugin_data[plugin][<?php echo $plugin; ?>]" checked="checked"><?php echo $plugin; ?></input></br>
			<?php endforeach; ?>
				<input type="hidden" name="page" value="plugin-scheduler" />
				<input type="hidden" name="saving" value="true" />
				<input type="submit" />
		</form>
		<?php
		if ( isset( $_GET['saving'] ) && true == $_GET['saving'] ){
			echo '<pre>';
			print_r($_GET);
			echo '</pre>';
			update_option( 'plugin-scheduler-data', $_GET['plugin_data'] );
		}
	}

	/**
	 * [active_plugins description]
	 * @return [type] [description]
	 */
	public function active_plugins() {

		// unset( $active_plugins[0] );
		// echo '<pre>';
		// print_r( $active_plugins );
		// echo '</pre>';

		// update_option( 'active_plugins', $active_plugins );
	}

} // END class

new DB_Plugin_Scheduler();