<?php
/**
 * Setting page
 * Author: Johannes Stock
 */

function integreat_add_settings_page() {
    add_options_page( 'integreat', 'Integreat', 'manage_options', 'dbi-example-plugin', 'integreat_render_plugin_settings_page' );
}
add_action( 'admin_menu', 'integreat_add_settings_page' );

function integreat_render_plugin_settings_page() {
    ?>
    <form action="options.php" method="post">
        <?php 
        settings_fields( 'integreat_plugin_options' );
        do_settings_sections( 'integreat_plugin' ); ?>
        <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Save' ); ?>" />
    </form>
    <?php
}

function integreat_register_settings() {
    register_setting( 'integreat_plugin_options', 'integreat_plugin_options', 'integreat_plugin_options_validate' );
    add_settings_section( 'api_settings', 'Integreat', 'integreat_plugin_section_text', 'integreat_plugin' );
    add_settings_field( 'integreat_plugin_options_language', 'Degree of formality', 'integreat_plugin_options_language', 'integreat_plugin', 'api_settings' );
    add_settings_field( 'integreat_plugin_options_city', 'City', 'integreat_plugin_options_city', 'integreat_plugin', 'api_settings' );
    add_settings_field( 'integreat_plugin_search_term', 'Search Term', 'integreat_plugin_search_term', 'integreat_plugin', 'api_settings' );
    add_settings_field( 'integreat_plugin_design', 'Template', 'integreat_plugin_design', 'integreat_plugin', 'api_settings' );
}
add_action( 'admin_init', 'integreat_register_settings' );

function integreat_plugin_options_validate( $input ) {
    $newinput['language'] = trim( $input['language'] );
    $newinput['city'] = trim( $input['city'] );
    $newinput['term'] = trim( $input['term'] );
    $newinput['design'] = trim( $input['design'] );
    if (! preg_match( '/^[a-z0-9]{32}$/i', $newinput['language'] ) && $_POST['integreat_plugin_options_language'] != null) {
        $newinput['language'] = $_POST['integreat_plugin_options_language'];
    }
    if ( ! preg_match( '/^[a-z0-9]{32}$/i', $newinput['city'] ) && $_POST['integreat_plugin_options_city'] != null ) {
        $newinput['city'] = $_POST['integreat_plugin_options_city'];
    }
    if ( ! preg_match( '/^[a-z0-9]{32}$/i', $newinput['term'] ) && $_POST['integreat_plugin_search_term'] != null) {
        $newinput['term'] = $_POST['integreat_plugin_search_term'];
    }
    if ( ! preg_match( '/^[a-z0-9]{32}$/i', $newinput['design'] ) && $_POST['integreat_plugin_design'] != null) {
        $newinput['design'] = $_POST['integreat_plugin_design'];
    }
    if ( ! preg_match( '/^[a-z0-9]{32}$/i', $newinput['design'] ) && $_POST['integreat_plugin_design_big_image'] != null) {
        $newinput['image_big'] = $_POST['integreat_plugin_design'];
    }
    return $newinput;
}

function integreat_plugin_section_text() {
    echo '<p>Here you can change the settings for using the Integreat App Plugin.</p>';
    echo '<p>Add the Integreat search widget by inserting this shortcode <span class="font-highlighting font-warning">[integreat]</span>.</p>';  
}

function integreat_plugin_options_language() {
    $options = get_option( 'integreat_plugin_options' );
    if ($options['language'] == 'on') {
        echo "<input name='integreat_plugin_options_language' type='checkbox' checked>Use second form singular";   
    } else {
        echo "<input name='integreat_plugin_options_language' type='checkbox'>Use second form singular";
    }
}

function integreat_plugin_options_city() {
    $options = get_option( 'integreat_plugin_options' );
    echo "<input id='integreat_plugin_options_city' placeholder='Augsburg' name='integreat_plugin_options_city' type='text' value='" . (esc_attr( $options['city'] ) ? esc_attr( $options['city'] ) : 'Augsburg') . "' />";
    echo "<p><b>Please note:</b> Add the city name as it is in the url slug of <a href='https://www.integreat.app/'> Integreat</a>. For example add LkAugsburg instead of Landkreis Augsburg.</p>";
}

function integreat_plugin_search_term() {
    $options = get_option( 'integreat_plugin_options' );
    echo "<input id='integreat_plugin_search_term' placeholder='Suchbegriff' name='integreat_plugin_search_term' type='text' value='" . (esc_attr( $options['term'] ) ? esc_attr( $options['term'] ) : 'Integrationskurse') . "'/>";
}

function integreat_plugin_design() {
    $options = get_option( 'integreat_plugin_options' );
    ?>    
        <select id='integreat_plugin_design' name='integreat_plugin_design'>
            <option <?php if ($options['design'] == 'integreat_render_design_search_widget') {?> selected="selected" <?php } ?> value="integreat_render_design_search_widget">Kleines Such-Widget</option>
            <option <?php if ($options['design'] == 'integreat_plugin_design_small') {?> selected="selected" <?php } ?> value="integreat_plugin_design_small">Kleiner Ein-Spalter</option>
            <option <?php if ($options['design'] == 'integreat_plugin_design_big') {?> selected="selected" <?php } ?> value="integreat_plugin_design_big">Vollflächiger Zwei-Spalter</option>
            <option <?php if ($options['design'] == 'integreat_plugin_design_bg_image') {?> selected="selected" <?php } ?> value="integreat_plugin_design_bg_image">Vollflächiger Ein-Spalter</option>
        </select>
    <?php
    if ($options['design'] == 'integreat_plugin_design_big') { ?>
        <p><b>Please Note:</b> If you want to, you can add a custom image for this template here. Otherwise the default Integreat image will be used.</p>
        <label>Please insert the url of the image here</label>
        <br>
        <input value="<?php /* $options['image_big'] */ ?>" name="integreat_plugin_design_big_image">
    <?php } else if ($options['design'] == 'integreat_plugin_design_bg_image') {

    } else if ($options['design'] == 'integreat_plugin_design_small') {

    }
}