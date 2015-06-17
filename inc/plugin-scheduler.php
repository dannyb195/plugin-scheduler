<?php
/**
 * undocumented class
 *
 * @package default
 * @author
 **/
class DB_Plugin_Scheduler {

	public $active_plugins;
	public $plugin_scheduler_data;
	public $all_plugins;

	public function __construct() {
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
		$this->plugin_scheduler_data = get_option( 'plugin-scheduler-data' );
		$this->active_plugins = get_option( 'active_plugins' );
		$this->all_plugins = get_plugins();
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
		$plugin_scheduler_data = $this->plugin_scheduler_data;
		// echo 'options<pre>';
		// print_r( $plugin_scheduler_data );
		// echo '</pre>';
		$start_time = $plugin_scheduler_data['time']['start'];
		$end_time = $plugin_scheduler_data['time']['end'];
		echo $end_time . ' end time';

		?>
		<form>
			<input type="checkbox" name="plugin_data[day][monday]" class="" <?php if ( array_key_exists( 'monday', $plugin_scheduler_data['day'] ) ) { echo 'checked'; } ?> /><?php esc_html_e( 'Monday', 'plugin-scheduler'); ?><br />
			<input type="checkbox" name="plugin_data[day][tuesday]" class="" /><?php esc_html_e( 'Tuesday', 'plugin-scheduler'); ?><br />
			<input type="checkbox" name="plugin_data[day][wednesday]" class="" /><?php esc_html_e( 'Wednesday', 'plugin-scheduler'); ?><br />
			<input type="checkbox" name="plugin_data[day][thursday]" class="" /><?php esc_html_e( 'Thursday', 'plugin-scheduler'); ?><br />
			<input type="checkbox" name="plugin_data[day][friday]" class="" /><?php esc_html_e( 'Friday', 'plugin-scheduler'); ?><br />
			<input type="checkbox" name="plugin_data[day][saturday]" class="" /><?php esc_html_e( 'Saturday', 'plugin-scheduler'); ?><br />
			<input type="checkbox" name="plugin_data[day][sunday]" class="" /><?php esc_html_e( 'Sunday', 'plugin-scheduler'); ?><br />
			<br />
			<?php esc_html_e( 'Start / Active time (Example 13:30)', 'plugin-scheduler' ); ?><br />
			<input type="text" name="plugin_data[time][start]" <?php if ( ! empty( $start_time ) ) { echo 'value="' . esc_html( $start_time ) . '"'; } ?> /><br />
			<?php esc_html_e( 'Start / Active time (Example 20:30)', 'plugin-scheduler' ); ?><br />
			<input type="text" name="plugin_data[time][end]" <?php if ( ! empty( $end_time ) ) { echo 'value="' . esc_html( $end_time ) . '"'; } ?> /><br />
			<br />
			<?php foreach ( $this->active_plugins as $plugin ) : ?>
				<input type="checkbox" name="plugin_data[plugin][<?php echo $plugin; ?>]" <?php if ( array_key_exists( $plugin, $plugin_scheduler_data['plugin'] ) ) { echo 'checked="checked"'; } ?>><?php echo $plugin; ?></input></br>
			<?php endforeach; ?>
			<input type="hidden" name="page" value="plugin-scheduler" />
			<input type="hidden" name="saving" value="true" />
			<input type="submit" />
		</form>
		<?php
		if ( isset( $_GET['saving'] ) && true == $_GET['saving'] ){
			// sanitize this
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