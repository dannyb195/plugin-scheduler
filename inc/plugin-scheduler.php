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
		add_action( 'admin_init', array( $this, 'scripts' ) );
	}

	public function scripts() {
		wp_enqueue_script( 'jquery-ui-datepicker' );
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
		?>
		<script type="text/javascript">
			jQuery( document ).ready( function() {
				jQuery( 'input.date' ).datepicker();
			});
		</script>
		<form>
				<input class="date" value="" />
			<?php foreach ( $this->active_plugins as $plugin ) : ?>
				<input type="hidden" name="page" value="plugin-scheduler" />
				<input type="checkbox" checked="checked"><?php echo $plugin; ?></input></br>
			<?php endforeach; ?>
				<input type="submit" />
		</form>
		<?php
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