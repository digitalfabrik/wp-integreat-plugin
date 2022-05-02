<?php
add_shortcode('integreat', 'integreat_shortcode_render_snippet');

function integreat_shortcode_render_snippet() {
    $options = get_option( 'integreat_plugin_options' );
    if ($options['design']  == 'integreat_plugin_design_bg_image' ) {
        integreat_render_design_bg_image($options);
    } else if ($options['design'] == 'integreat_plugin_design_small') {
        integreat_render_design_small($options);
    } else if ($options['design'] == 'integreat_plugin_design_big') {
        integreat_render_design_big($options);
    } else {
        integreat_render_design_search_widget($options);
    }
}

function integreat_render_design_big($options) {
    ?>
        <div id="integreat_plugin_big" class="integreat_plugin integreat_plugin_big">
            <div class="integreat_plugin_column integreat_plugin_column_1_2">
                <img src="<?php if($options['integreat_alternative_image'] != ''){echo $options['integreat_alternative_image'];} else {?> https://integreat-app.de/wp-content/uploads/2020/11/T7A5938-scaled.jpg <?php } ?>">
            </div>
            <div class="integreat_plugin_column integreat_plugin_column_1_2">
                <h2 class="mb-md"><b><?= $options['headline'] ?></b></h2>
                <p class="mb-lg"><?= $options['paragraph'] ?></p>
                <label class="mb-sm"><b><?= $options['notification'] ?></b></label>
                <div class="integreat_plugin_search_bar">
                    <form action="https://integreat.app/<?php echo strtolower(get_option('integreat_plugin_options')['city']) ?>/de/search" method="get"> <!-- Sprachauswahl backend -->
                        <input class="integreat_plugin_search" id="integreat_plugin_search" name="query" placeholder=<?php if (strlen($options['term']) > 2) { echo $options['term']; } else {echo 'Integrationskurse';}  ?>>
                        <input class="integreat_plugin_submit" id="integreat_plugin_submit" type="submit" formtarget="_blank" value="<?php esc_attr_e( 'Search' ); ?>">
                    </form>
                </div>
            </div>
        </div>
    <?php
}

function integreat_render_design_bg_image($options) {
    ?>
        <div <?php if($options['integreat_alternative_image'] != '') {?> style="background-image: url('<?php echo $options['integreat_alternative_image'] ?>')" <?php } ?>id="integreat_plugin_bg_image" class="integreat_plugin integreat_plugin_layout integreat_plugin_bg_image">
            <a class="integreat_plugin_icon_small" target="_blank" href="https://www.integreat.app/<?php echo strtolower(get_option('integreat_plugin_options')['city']) ?>">
                <img class="mb-md" src="https://integreat.app/app-logo.png">
            </a>
            <h2 class="mb-md"><b><?= $options['headline'] ?></b></h2>
            <p class="mb-lg"><?= $options['paragraph'] ?></p>
            <label class="mb-sm"><b><?= $options['notification'] ?></b></label>
            <div class="integreat_plugin_search_bar">
                <form action="https://integreat.app/<?php echo strtolower(get_option('integreat_plugin_options')['city']) ?>/de/search" method="get"> <!-- Sprachauswahl backend -->
                    <input class="integreat_plugin_search" id="integreat_plugin_search" value="<?php if (strlen($options['term']) > 2) { echo $options['term']; } else {echo 'Integrationskurse';} ?>" name="query" placeholder="<?php if (strlen($options['term']) > 2) { echo $options['term']; } else {echo 'Integrationskurse';} ?>">
                    <input class="integreat_plugin_submit" id="integreat_plugin_submit" type="submit" formtarget="_blank" value="<?php esc_attr_e( 'Search' ); ?>">
                </form>
            </div>
        </div>
    <?php
}

function integreat_render_design_small($options) {
    ?>
    <div id="integreat_plugin_small" class="integreat_plugin integreat_plugin_small">
        <a class="integreat_plugin_icon_small" target="_blank" href="https://www.integreat.app/<?php echo strtolower(get_option('integreat_plugin_options')['city']) ?>">
            <img class="mb-md" src="https://integreat.app/app-logo.png">
        </a>
        <img class="mb-md" src="<?php if($options['integreat_alternative_image'] != ''){ echo $options['integreat_alternative_image']; }else {?> https://integreat-app.de/wp-content/uploads/2020/11/T7A5938-scaled.jpg <?php } ?>">
        <h2 class="mb-md"><b><?= $options['headline'] ?></b></h2>
        <p class="mb-lg"><?= $options['paragraph'] ?></p>
        <label class="mb-sm"><b><?= $options['notification'] ?></b></label>
        <div class="integreat_plugin_search_bar">
            <form action="https://integreat.app/<?php echo strtolower(get_option('integreat_plugin_options')['city']) ?>/de/search" method="get"> <!-- Sprachauswahl backend -->
                <input class="integreat_plugin_search" id="integreat_plugin_search" name="query" value="<?php if (strlen($options['term']) > 2) { echo $options['term']; } else {echo 'Integrationskurse';} ?>" placeholder="<?php if (strlen($options['term']) > 2) { echo $options['term']; } else {echo 'Integrationskurse';} ?>">
                <input class="integreat_plugin_submit" id="integreat_plugin_submit" type="submit" formtarget="_blank" value="<?php esc_attr_e( 'Search' ); ?>">
            </form>
        </div>
    </div>
    <?php
}

function integreat_render_design_search_widget($options) {
    ?>
    <div id="integreat_plugin_search_widget" class="integreat_plugin_search_widget">
        <a target="_blank" href="https://www.integreat.app/<?php echo strtolower(get_option('integreat_plugin_options')['city']) ?>">
            <img class="mb-md" src="https://integreat.app/app-logo.png">
        </a>
        <label class="mb-sm"><b><?= $options['notification'] ?></b></label>
        <div class="integreat_plugin_search_bar">
            <form action="https://integreat.app/<?php echo strtolower(get_option('integreat_plugin_options')['city']) ?>/de/search" method="get"> <!-- Sprachauswahl backend -->
                <input class="integreat_plugin_search" id="integreat_plugin_search" name="query" value="<?php if (strlen($options['term']) > 2) { echo $options['term']; } else {echo 'Integrationskurse';} ?>" placeholder="<?php echo $options['term'] ?>">
                <input class="integreat_plugin_submit" id="integreat_plugin_submit" type="submit" formtarget="_blank" value="<?php esc_attr_e( 'Search' ); ?>">
            </form>
        </div>
    </div>
    <?php
}
