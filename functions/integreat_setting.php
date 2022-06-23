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
    add_settings_field( 'integreat_plugin_options_city', __('City', 'integreat-search-widget'), 'integreat_plugin_options_city', 'integreat_plugin', 'api_settings' );
    add_settings_field( 'integreat_plugin_search_term', __('Search Term (Placeholder)', 'integreat-search-widget'), 'integreat_plugin_search_term', 'integreat_plugin', 'api_settings' );
    add_settings_field( 'integreat_plugin_design', 'Template', 'integreat_plugin_design', 'integreat_plugin', 'api_settings' );
    add_settings_field( 'integreat_plugin_add_headline', __('Headline','integreat-search-widget'), 'integreat_plugin_add_headline', 'integreat_plugin', 'api_settings' );
    add_settings_field( 'integreat_plguin_add_paragraph', __('Paragraph', 'integreat-search-widget'), 'integreat_plguin_add_paragraph', 'integreat_plugin', 'api_settings' );
    add_settings_field( 'integreat_plugin_add_notification', __('Notification', 'integreat-search-widget'), 'integreat_plugin_add_notification', 'integreat_plugin', 'api_settings' );
}
add_action( 'admin_init', 'integreat_register_settings' );

function integreat_plugin_options_validate( $input ) {
    $newinput['language'] = sanitize_text_field(trim( $input['language'] ));
    $newinput['city'] = sanitize_text_field(trim( $input['city'] ));
    $newinput['term'] = sanitize_text_field(trim( $input['term'] ));
    $newinput['design'] = trim( $input['design']);
    $newinput['integreat_alternative_image'] = sanitize_text_field(trim( $input['integreat_alternative_image'] ));
    $newinput['headline'] = sanitize_textarea_field(trim( $input['headline'] )); 
    $newinput['paragraph'] = sanitize_textarea_field(trim( $input['paragraph'] )); 
    $newinput['notification'] = sanitize_textarea_field(trim( $input['notification'] )); 
    
    if (! preg_match( '/^[a-z0-9]{32}$/i', $newinput['language'] ) && $_POST['integreat_plugin_options_language'] != null) {
        $newinput['language'] = sanitize_text_field($_POST['integreat_plugin_options_language']);
    }
    if ( ! preg_match( '/^[a-z0-9]{32}$/i', $newinput['city'] ) && $_POST['integreat_plugin_options_city'] != null ) {
        $newinput['city'] = sanitize_text_field($_POST['integreat_plugin_options_city']);
    }
    if ( ! preg_match( '/^[a-z0-9]{32}$/i', $newinput['term'] ) && $_POST['integreat_plugin_search_term'] != null) {
        $newinput['term'] = sanitize_text_field($_POST['integreat_plugin_search_term']);
    }
    if ( ! preg_match( '/^[a-z0-9]{32}$/i', $newinput['design'] ) && $_POST['integreat_plugin_design'] != null) {
        $newinput['design'] = $_POST['integreat_plugin_design'];
    }
    if ( ! preg_match( '/^[a-z0-9]{32}$/i', $newinput['integreat_alternative_image'] ) && $_POST['integreat_alternative_image'] != null) {
        $newinput['integreat_alternative_image'] = sanitize_text_field($_POST['integreat_alternative_image']);
    }
    if ( ! preg_match( '/^[a-z0-9]{32}$/i', $newinput['headline'] ) && $_POST['integreat_plugin_headline'] != null) {
        $newinput['headline'] = sanitize_textarea_field($_POST['integreat_plugin_headline']);
    }
    if ( ! preg_match( '/^[a-z0-9]{32}$/i', $newinput['paragraph'] ) && $_POST['integreat_plugin_paragraph'] != null) {
        $newinput['paragraph'] = sanitize_textarea_field($_POST['integreat_plugin_paragraph']);
    }
    if ( ! preg_match( '/^[a-z0-9]{32}$/i', $newinput['notification'] ) && $_POST['integreat_plugin_notification'] != null) {
        $newinput['notification'] = sanitize_textarea_field($_POST['integreat_plugin_notification']);
    }
    return $newinput;
}

function integreat_plugin_section_text() {
    echo '<p>' . __('Here you can change the settings for using the Integreat App Plugin.', 'integreat-search-widget') . '</p>';
    echo '<p>' . __('Add the Integreat search widget by inserting this shortcode', 'integreat-search-widget') . '<span class="font-highlighting font-warning"> [integreat]</span>.</p>';  
}

function integreat_plugin_options_city() {
    $options = get_option( 'integreat_plugin_options' );
    echo "<input id='integreat_plugin_options_city' placeholder='Augsburg' name='integreat_plugin_options_city' type='text' value='" . (esc_attr( $options['city'] ) ? esc_attr( $options['city'] ) : 'Augsburg') . "' />";
    echo "<p><b>" . __("Please note:", "integreat-search-widget") . "</b> " . __("Please write the city's name as it is inside the Integreat App.", "integreat-search-widget") . "</p>";
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
        <p><b><?php echo esc_html(__('Please note:', 'integreat-search-widget'));  ?></b>
        <?php echo esc_html(__('If you want to, you can add a custom image for this template here. Otherwise the default Integreat image will be used.', 'integreat-search-widget')) ?></p>
        <label><?php echo esc_html(__('Please insert the url of the image here', 'integreat-search-widget')); ?></label>
        <br>
        <input value="<?php if(isset($options['integreat_alternative_image'])) { echo esc_attr($options['integreat_alternative_image']); } ?>" name="integreat_alternative_image">
    <?php } else if ($options['design'] == 'integreat_plugin_design_bg_image') { ?>
        <p><b><?php echo esc_html(__('Please note:', 'integreat-search-widget')); ?></b>
        <?php echo esc_html(__('If you want to, you can add a custom image for this template here. Otherwise the default Integreat image will be used.', 'integreat-search-widget')) ?></p>
        <label><?php echo esc_html(__('Please insert the url of the image here', 'integreat-search-widget')); ?></label>
        <br>
        <input value="<?php if(isset($options['integreat_alternative_image'])) { echo esc_attr($options['integreat_alternative_image']); } ?>" name="integreat_alternative_image">
    <?php
    } else if ($options['design'] == 'integreat_plugin_design_small') {?>
        <p><b><?php echo esc_html(__('Please note:', 'integreat-search-widget')); ?></b>
        <?php echo esc_html(__('If you want to, you can add a custom image for this template here. Otherwise the default Integreat image will be used.', 'integreat-search-widget')) ?></p>
        <label><?php echo esc_html(__('Please insert the url of the image here', 'integreat-search-widget')); ?></label>
        <br>
        <input value="<?php if(isset($options['integreat_alternative_image'])) { echo esc_attr($options['integreat_alternative_image']); } ?>" name="integreat_alternative_image">
    <?php
    }
}

function integreat_plugin_add_headline() {
    $options = get_option( 'integreat_plugin_options' );
    ?>
        <div>
            <textarea name="integreat_plugin_headline">
                <?php if ($options['headline'] != null) {
                    echo esc_textarea($options['headline']);
                } else {
                    echo 'Kennen Sie schon die Integreat-App?';
                } ?>
            </textarea>
        </div>
    <?php
}

function integreat_plguin_add_paragraph() {
    $options = get_option( 'integreat_plugin_options' );
    ?>
        <div>
            <textarea name="integreat_plugin_paragraph">
                <?php if ($options['paragraph'] != null) {
                    echo esc_textarea($options['paragraph']);
                } else {
                    echo 'Hier finden Sie alle wichtigen Informationen in Ihrer Sprache, z.B. Anmeldungen im Bürgerservice, Infos rund um den Arztbesuch, Lehrstellenbörse und vieles mehr';
                } ?>
            </textarea>
        </div>
    <?php
}

function integreat_plugin_add_notification() {
    $options = get_option( 'integreat_plugin_options' );
    ?>
        <div>
            <textarea name="integreat_plugin_notification">
                <?php if ($options['notification'] != null) {
                    echo esc_textarea($options['notification']); }
                else {
                    echo 'Mehrsprachige Informationen in Augsburg finden!';
                } ?>
            </textarea>
        </div>
    <?php
}