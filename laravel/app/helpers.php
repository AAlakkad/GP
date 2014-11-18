<?php

function set_active( $path, $active = 'active' )
{
    return Request::segment( 1 ) == $path ? 'active' : '';

}

/**
 * Convert list array to checkbox lists
 *
 * @param array $list
 * @param $name
 * @param null|array|string $values
 */
function list_to_checklist( $list, $name, $values = null )
{
    foreach ($list as $key => $label) {
        $checked = '';
        if (is_array( $values ) and in_array( $key, $values )) {
            $checked = ' checked';
        } elseif ($key == $values) {
            $checked = ' checked';
        }
        ?>
        <div class="checkbox">
            <label for="item_<?= $key ?>">
                <input type="checkbox" id="item_<?= $key ?>" name="<?= $name ?>[]" value="<?= $key ?>" <?= $checked ?>>
                <?= $label ?>
            </label>
        </div>
    <?php
    }
}

function list_to_ingredients( $list, $name, $recipe = null )
{
    if ($recipe) {
        $selectedValues = $recipe->ingredients->lists( 'unit', 'id' );
    }
    foreach ($list as $key => $label) {
        $checked = '';
        $amount  = 0;
        if (isset( $selectedValues ) and is_array( $selectedValues )) {
            if (array_key_exists( $key, $selectedValues )) {
                $checked = ' checked';
                $amount  = (int) $recipe->ingredients()->find( $key )->amount;
            }
        }
        $unit = Ingredient::find( $key )->unit;

        ?>
        <div class="row">
            <div class="checkbox">
                <div class="col-md-3">
                    <label for="item_<?= $key ?>">
                        <input type="checkbox" id="item_<?= $key ?>" name="<?= $name ?>[<?= $key ?>][id]"
                               value="<?= $key ?>" <?= $checked ?>>
                        <?= $label ?>
                    </label>
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="<?= $name ?>[<?= $key ?>][amount]" value="<?= $amount ?>"/>
                </div>
                <div class="col-md-2">
                    <span><?= $unit ?></span>
                </div>
            </div>
        </div>
    <?php
    }
}
