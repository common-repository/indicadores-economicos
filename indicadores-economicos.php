<?php
/**
 * @package Indicadores Economicos
 * @author Andres Molina
 * @version 1.0
 */
/*
Plugin Name: Indicadores Economicos
Plugin URI: http://andresmolina.net/
Description:Muestra los Indicadores Economicos para Chile
Author: Andres Molina
Version: 2.0
Author URI: http://andresmolina.net/
*/

require_once(ABSPATH . WPINC . '/formatting.php');

// defining default variables
// Vamos a definir los valores por defecto de las variables, en nuestro caso solo el titulo del widget
static $am_wpie_titulo = 'Indicadores Ecnonomicos';

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'load_am_wpie' );

 

function am_wpie_install () {
   global $wpdb;
   global $am_wpie_db_version;
echo $wpdb->prefix;
   $table_name = $wpdb->prefix . "indicadores_economicos";
   if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
      
      $sql = "CREATE TABLE " . $table_name . " (
				`fecha` VARCHAR(20) NOT NULL ,
				`uf` VARCHAR(20) NOT NULL ,
				`dolar` VARCHAR(20) NOT NULL ,
				`utm` VARCHAR(20) NOT NULL
		);";

      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      dbDelta($sql);

      $welcome_name = "Indicadores Económicos";
      $welcome_text = "¡Felicidades, instalación exitosa!";

    
 
      add_option("am_wpie_db_version", "1.0");

   }
 
}

register_activation_hook(__FILE__,'am_wpie_install');

/**
 * Register our widget.
 * 'am_wpie' is the widget class used below.
 *
 * @since 0.1
 */
function load_am_wpie() {
	register_widget( 'am_wpie' );
}
class am_wpie extends WP_Widget {
	/**
	 * Widget setup.
	 */
	function am_wpie() {
		/* Widget settings. */
		$widget_ops = array( 'description' => __('Widget para mostrar Indicadores Economicos de Chile.', 'am_wpie') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'am_wpie' );

		/* Create the widget. */
		$this->WP_Widget( 'am_wpie', __('Indicadores Economicos CL', 'am_wpie'), $widget_ops, $control_ops );
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['titulo'] = strip_tags( $new_instance['titulo'] );
		
		return $instance;
	}


/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'titulo' => __('Indicadores Economicos', 'indicadores economicos'));
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'titulo' ); ?>"><?php _e('Titulo:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'titulo' ); ?>" name="<?php echo $this->get_field_name( 'titulo' ); ?>" value="<?php echo $instance['titulo']; ?>" size="30" />
		</p>

	<?php
	}
	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$titulo = apply_filters('widget_title', $instance['titulo'] );
		
		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $titulo )
			echo $before_title . $titulo . $after_title;

		/* Display name from widget settings if one was input. */
		
		$this->buildWidget();
			
		/* After widget (defined by themes). */
		echo $after_widget;
	}
function getData($tipo,$limite, $fin,$fuente) {
		

$domain = strstr($fuente, $limite);

$domain = $domain;


switch ($tipo) {
    case "fecha":
		$domain=split('\n',$domain);
       return strip_tags(str_replace("al ","",str_replace($fin,"",$domain[0])));
        break;
    case "uf":
		$domain=strip_tags($domain);
		$domain=split('\n',$domain);
        return str_replace(array("\r\n", "\n", "\r", "\t","&","UF"," ","$"),"",$domain[0]);
        break;
	 case "utm":
		$domain=strip_tags($domain);
		$domain=split('\n',$domain);
        return str_replace(array("\r\n", "\n", "\r", "\t","&","UTM"," ","$"),"",$domain[0]);
        break;
		 case "dolar":
		$domain=strip_tags($domain);
		$domain=split('\n',$domain);
        return str_replace(array("\r\n", "\n", "\r", "\t","&","lar Observado"," ","$"),"",$domain[0]);
        break;
   
}


	}
	

function buildWidget() {
GLOBAL $wpdb;
  $qry = "SELECT * from ".$wpdb->prefix . "indicadores_economicos where fecha='".date("d/m/Y")."'";
  $indicadores = $wpdb->get_row($qry);

if($wpdb->num_rows>0){
$fecha=$indicadores->fecha;
$dolar=$indicadores->dolar;
$uf=$indicadores->uf;
$utm=$indicadores->utm;
}else{
		$fuente  = file_get_contents('http://www.bancoestado.cl/bancoestado/indiceseconomicos/indicadores.asp');
		$fecha = $this->getData('fecha','al ', ")</fo",$fuente);
		$uf=$this->getData('uf','UF</a></font></td>', "z",$fuente);
		$utm=$this->getData('utm','UTM</a></font></td>', "z",$fuente);
		$dolar=$this->getData('dolar','lar Observado</a></font></td>', "z",$fuente);
		 $insert = "INSERT INTO ".$wpdb->prefix . "indicadores_economicos ".
           " (fecha, uf, dolar, utm) " .
            "VALUES ('" . $fecha . "','" . $uf . "','" . $dolar . "', '".$utm."')";

      $results = $wpdb->query( $insert );
      /*Todo:
	Verificar si es viernes, para asignar los valores del viernes al sabado y domingo, verificar si el dia siguiente es feriado, para asiganrle el valor de oy, al proximo feriado
      */
      if(date('l')=="Friday"){
      
      
      }

}
 
 
 
		echo '
		<div class="am_wpie" style="float:right">
		<dl>
			<dd class="today">
				<span class="condition">Indicadores</span>
				<span class="temperature">Al: '.$fecha.'</span>
			</dd>
			<dd class="today"  style="height:20px;">
				<span class="condition">UF: '.$uf.'</span>
			</dd>
			<dd class="today"  style="height:20px;">
				<span class="temperature">UTM: '.$utm.'</span>
			</dd>
			<dd class="today"  style="height:20px;">
				<span class="condition">Dolar: '.$dolar.'</span>
				 
			</dd>
		';	
		
		 
		echo '
		</dl>
		</div>
		<div style="clear: both;"></div>
		';
	}


}
function wpame_css() {
	echo '<link rel="stylesheet" type="text/css" media="screen" href="'. WP_PLUGIN_URL . '/indicadores-economicos/economicos.css"/>';	
}

add_action('wp_head', 'wpame_css');

?>
