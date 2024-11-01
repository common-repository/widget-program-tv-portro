<?php
/* Plugin Name: Widget PORT.ro
Plugin URI: http://widget.port.ro
Description: A PORT.ro wordpress plugin wich displays TV Programs
Version: 2.1
Author: Daniel Ordean
Author URI: http://port.ro
Licence: GPLv2 or later
*/
class WidgetRO extends WP_Widget {
    function WidgetRO() {
        $widget_ops = array(
            'classname' => 'WidgetRO',
            'description' => 'A Widget who displays TV programs shows'
        );
        $this->WP_Widget(
            'WidgetRO',
            'Widget PORT ro',
            $widget_ops
        );
    }
    function form($instance){
        if($instance){
            $port_ro_widget_id = esc_attr($instance['port_ro_widget_id']);
        }
        else{
            $widgetid = '';
        }
        ?>
        <p>
            <label for="prowid"> ID Widget :</label>
            <input id="prowid"  name="<?php echo $this->get_field_name('port_ro_widget_id'); ?>" type="text" value="<?php echo $port_ro_widget_id; ?>" />
        </p>
        <p>
            <small>
                Pentru a obtine un ID, configurati un widget la adresa <a href="http://widget.port.ro" target="_blank">widget.port.ro</a>
            </small>
        </p>
    <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        // Fields
        $instance['port_ro_widget_id'] = strip_tags($new_instance['port_ro_widget_id']);

        return $instance;
    }

    function widget($args, $instance) { // widget sidebar output
        extract($args, EXTR_SKIP);
        echo $before_widget; // pre-widget code from theme
        $wdid = trim($instance['port_ro_widget_id']);
        echo "<div id='wid-".$wdid."'><p>Program TV oferit de <a href='www.port.ro'>PORT.ro </a></p></div><script type='text/javascript' src='http://widget.port.ro/widgetdata/getwidget/".$wdid."/wpmode'> </script>";                               echo $after_widget; // post-widget code from theme
    }
}
add_action(
    'widgets_init',
    create_function('','return register_widget("WidgetRO");')
);
?>