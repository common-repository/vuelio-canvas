<?php
require_once( CANVAS__PLUGIN_DIR .'canvasWidget.php');

class Canvas {
    public function init() {
      register_activation_hook( __FILE__, array('Canvas', 'register_activation_hook'));
      register_deactivation_hook( __FILE__, array('Canvas', 'register_activation_hook'));
      add_action('media_buttons', array($this, 'mediaButtons'), 11);
      add_action( 'wp_enqueue_scripts', array($this, 'register_plugin_styles'));
      add_action( 'widgets_init', array($this, 'load_widget') );
      add_shortcode('sgmb', array($this, 'showShortCode'));
  	}

    public function register_activation_hook() {
      //
    }

    public function register_deactivation_hook() {
      //
    }

    public function register_uninstall_hook() {
      //
    }

    public function register_plugin_styles()
    {
      wp_register_style('canvas-style', plugins_url(CANVAS_DIR_NAME.'/css/plugin.css'));
		  wp_enqueue_style('canvas-style');
    }

    public function mediaButtons()
  	{
      wp_register_script('canvas-classWidget-scripts', CANVAS_URL.'js/plugin.js', array('jquery', 'jquery-ui-core', 'jquery-ui-tabs', 'jquery-ui-draggable', 'jquery-ui-droppable', 'jquery-ui-accordion', 'jquery-ui-dialog'),null);
  		wp_enqueue_script('canvas-classWidget-scripts');
      wp_register_style('canvas_theme_style', CANVAS_URL.'css/plugin.css');
  		wp_enqueue_style('canvas_theme_style');
      $output = '<button class="button" onclick="jQuery(\'#canvas-thickbox\').dialog({ width: 450, modal: true });return false;">Insert Vuelio Canvas</button>';
  		echo $output;
      add_action('admin_footer', array($this, 'mediaButtonThickboxs'));
  	}

    public function mediaButtonThickboxs()
  	{
  		?>
  		<div id="canvas-thickbox" style="display: none" class="thickbox">
  			<div class="wrap">
        <img src="<?php echo CANVAS_URL ?>/assets/vuelio-logo.png" class="thickbox__logo" />
  				<p>Insert the URL of your Vuelio canvas</p>
  				<input type="text" placeholder="https://canvas.vuelio.co.uk/demoazurevueliocouk/canvas/" id="canvas-url" />
          <p id="canvas-error">Please enter a valid canvas url of the format https://canvas/vuelio.co.uk/xxx/xxx</p>
          <p class="submit">
            <input type="button" id="canvas-insert" class="button-primary" value="Insert"/>
  					<a class="button-secondary" onclick="jQuery('#canvas-thickbox').dialog('close')"; title="Cancel">Cancel</a>
          </p>
  			</div>
  		</div>
  	<?php
  	}

    public function load_widget()
  	{
  		register_widget('CanvasWidget');
  	}

    public function showShortCode($args)
    {
      $widget = new CanvasWidget();
      return $widget->init($args);
    }
}
