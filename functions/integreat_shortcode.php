<?php
add_shortcode('integreat', 'integreat_shortcode_render_snippet');

function integreat_shortcode_render_snippet() {
    $options = get_option( 'integreat_plugin_options' );
    if ($options['design']  == 'integreat_plugin_design_bg_image' ) {
        integreat_render_design_bg_image($options);
    } else if ($options['design'] == 'integreat_plugin_design_small') {
        integreat_render_design_small($options);
    } else {
        integreat_render_design_big($options);
    }
}

function integreat_render_design_big($options) {
    ?>
        <div id="integreat_plugin_big" class="integreat_plugin integreat_plugin_big">
            <div class="integreat_plugin_column integreat_plugin_column_1_3">
                <img src="https://integreat-app.de/wp-content/uploads/2020/11/T7A5938-scaled.jpg">
            </div>
            <div class="integreat_plugin_column integreat_plugin_column_2_3">
                <h2 class="mb-md"><b>Kennst du schon die Integreat-App?</b></h2>
                <p class="mb-lg">Hier findest Du alle wichtigen Informationen aus deiner Stadt,
                    z.B. Anmeldung im Bürgerservice, Infos rund um den Arztbesuch,
                    Lehrstellenbörse und vieles mehr.
                </p>
                <label class="mb-md"><b>Wonach suchst du in deiner Stadt?</b></label>
                <div class="integreat_plugin_search_bar">
                    <form action="https://integreat.app/<?= strtolower(get_option('integreat_plugin_options')['city']) ?>/de/search" method="get"> <!-- Sprachauswahl backend -->
                        <input class="integreat_plugin_search" id="integreat_plugin_search" name="query" placeholder=<?php (esc_attr( $options['term'] ) ? esc_attr( $options['term'] ) : 'Integrationskurse') ?>>
                        <input class="integreat_plugin_submit" id="integreat_plugin_submit" type="submit" value="<?php esc_attr_e( 'Search' ); ?>">
                    </form>
                </div>
            </div>
        </div>
    <?php
}

function integreat_render_design_bg_image($options) {
    ?>
        <div id="integreat_plugin_bg_image" class="integreat_plugin integreat_plugin_layout integreat_plugin_bg_image">
            <h2 class="mb-md"><b>Kennst du schon die Integreat-App?</b></h2>
            <p class="mb-lg">Hier findest Du alle wichtigen Informationen aus deiner Stadt,
                z.B. Anmeldung im Bürgerservice, Infos rund um den Arztbesuch,
                Lehrstellenbörse und vieles mehr.
            </p>
            <label class="mb-md"><b>Wonach suchst du in deiner Stadt?</b></label>
            <div class="integreat_plugin_search_bar">
                <form action="https://integreat.app/<?= strtolower(get_option('integreat_plugin_options')['city']) ?>/de/search" method="get"> <!-- Sprachauswahl backend -->
                    <input class="integreat_plugin_search" id="integreat_plugin_search" name="query" placeholder="<?= $options['term'] ?>">
                    <input class="integreat_plugin_submit" id="integreat_plugin_submit" type="submit" value="<?php esc_attr_e( 'Search' ); ?>">
                </form>
            </div>
        </div>
    <?php
}

function integreat_render_design_small($options) {
    ?>
    <div id="integreat_plugin_small" class="integreat_plugin integreat_plugin_small">
        <img class="mb-md" src="https://integreat-app.de/wp-content/uploads/2020/11/T7A5938-scaled.jpg">
        <h2 class="mb-md"><b>Kennst du schon die Integreat-App?</b></h2>
        <p class="mb-lg">Hier findest Du alle wichtigen Informationen aus deiner Stadt,
            z.B. Anmeldung im Bürgerservice, Infos rund um den Arztbesuch,
            Lehrstellenbörse und vieles mehr.
        </p>
        <label class="mb-md"><b>Wonach suchst du in deiner Stadt?</b></label>
        <div class="integreat_plugin_search_bar">
            <form action="https://integreat.app/<?= strtolower(get_option('integreat_plugin_options')['city']) ?>/de/search" method="get"> <!-- Sprachauswahl backend -->
                <input class="integreat_plugin_search" id="integreat_plugin_search" name="query" placeholder="<?= $options['term'] ?>">
                <input class="integreat_plugin_submit" id="integreat_plugin_submit" type="submit" value="<?php esc_attr_e( 'Search' ); ?>">
            </form>
        </div>
    </div>
    <?php
}