<?php
class CanvasWidget extends WP_Widget
{
	const CANVAS_DEFAULT_URL = 'https://canvas.vuelio.co.uk/demoazurevueliocouk/canvas';
	static $widgetCounter;
	function __construct()
	{
		parent::__construct(
			'CanvasWidget',
			__('Canvas Widget', 'canvas_widget_domain'),
			array('description' => __( 'Include a Vuelio Canvas', 'canvas_widget_domain' ),)
		);
	}

  public function form( $instance )
	{
    $canvasUrl = CANVAS_DEFAULT_URL;
		if(is_array($instance) && in_array('canvasUrl', $instance))
			$canvasUrl = $instance['canvasUrl'];
	?>
	<p>
	<label for="<?php echo $this->get_field_id( 'canvasUrl' ); ?>"><?php _e( 'Vuelio Canvas URL (Note: this is a site wide setting for all canvas widgets)'); ?></label>
	<input type="text" class ="widefat" id="<?php echo $this->get_field_id( 'canvasUrl' ); ?>" name="<?php echo $this->get_field_name( 'canvasUrl' ); ?>" value="<?php echo get_option('CANVAS_URL_SIDEBAR', ''); ?>" placeholder="<?php echo CANVAS_ROOT_URL; ?>">
	</p>

	<?php
	}

  public function widget($args, $instance)
 {
   global $post;
   $data = '<div class="responsive-iframe-container responsive-iframe-container--sidebar"><iframe src="' . get_option("CANVAS_URL_SIDEBAR",  "") . '"></iframe></div>';
   if(!empty($data)) {
     $html = $data;
     echo  $html;
   }
 }

 public function update($new_instance, $old_instance)
 {
	 $canvasPattern = '/^http(s)*:\/\/canvas\.vuelio\.co\.uk\/(.)*/i';
	 if(preg_match($canvasPattern, $new_instance['canvasUrl'])) {
	   update_option('CANVAS_URL_SIDEBAR', $new_instance['canvasUrl']);
	   return $instance;
	 }
 }

	public function init()
	{
    //do something
	}

	public function showWidget($data)
	{
		echo $data;
	}
}
?>
