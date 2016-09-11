<?php

/*
Plugin Name: Page Link Widget
Plugin URI:
Description: A simple widget to create a link to your choosen page(s).
Author: 
Version: 1.0
Author URI:
*/

// Creating the widget 
class rnf_pagelink_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'rnf_pagelink_widget', 


// Widget name will appear in UI
__('Page Link Widget', 'rnf_pagelink_domain'), 

// Widget description
array( 'description' => __( 'Link to a page', 'rnf_pagelink_domain' ), ) 
);
}

/*
|--------------------------------------------------------------------------
| WIDGET FRONT END
|--------------------------------------------------------------------------
*/

public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
echo __( 'Hello, World!', 'rnf_pagelink_domain' );
echo $args['after_widget'];
}

/*
|--------------------------------------------------------------------------
| WIDGET BACK END
|--------------------------------------------------------------------------
*/

public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
$link_target = esc_attr ($instance[ 'link_target' ]);
}
else {
$title = __( 'New title', 'rnf_pagelink_domain' );
$link_target = '';
}

?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<!-- Link Target Dropdown -->

		<p>
			<label for="<?php echo $this->get_field_id( 'link_target' ); ?>"><?php _e( 'Page to link to:' ); ?></label> 
			<?php wp_dropdown_pages(
				array (
		    		'id' => $this->get_field_id('link_target'),
		    		'name' => $this->get_field_name('link_target'),
		    		'selected' => $instance['link_target'],
		    		'class' => 'widefat'
				)
			); ?>
		</p>
<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['link_target'] = ( ! empty( $new_instance['link_target'] ) ) ? strip_tags( $new_instance['link_target'] ) : '';

return $instance;
}
} // Class rnf_widget ends here


// Register and load the widget
function rnf_load_widget() {
	register_widget( 'rnf_pagelink_widget' );
}
add_action( 'widgets_init', 'rnf_load_widget' );

?>