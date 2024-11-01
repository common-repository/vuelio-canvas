<?php
   /*
   Plugin Name: Vuelio Canvas
   Plugin URI: canvas.vuelio.co.uk
   Description: a plugin to insert the responsive Vuelio Canvas into your blog
   Version: 1.0
   Author: Vuelio
   Author URI: www.vuelio.com
   License: GPL2
   */

define( 'CANVAS__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define('CANVAS_URL', plugins_url('', __FILE__).'/');
define('CANVAS_DIR_NAME', 'vuelio-canvas');
define('CANVAS_ROOT_URL', 'https://canvas.vuelio.co.uk/');
define('CANVAS_DEFAULT_URL', 'https://canvas.vuelio.co.uk/demoazurevueliocouk/canvas/');

require_once( CANVAS__PLUGIN_DIR . 'class.canvas.php' );
$canvas = new Canvas();
$canvas->init();
