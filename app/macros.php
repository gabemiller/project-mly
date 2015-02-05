<?php

/**
 * -----------------------------------------------------------------------------
 * Form macros
 * -----------------------------------------------------------------------------
 *
 * Saját form függvények definiálása.
 *
 */
Form::macro('selection', function ($name, $options, $attr = NULL, $selected = NULL) {

    $select = '<select ';

    $select .= 'id="' . $name . '" ';

    $select .= 'name="' . $name . '" ';

    foreach ($attr as $key => $value) {
        $select .= $key . '="' . $value . '" ';
    }

    $select .= '>';

    foreach ($options as $key => $value) {
        $select .= '<option';

        if (is_array($selected)) {
            if (in_array($key, $selected)) {
                $select .= ' selected="selected" ';
            }
        } else if(is_int($selected)) {
            if ($key == $selected) {
                $select .= ' selected="selected" ';
            }
        }


        if (!empty($key)) {
            $select .= ' value="' . $key . '" ';
        }

        $select .= '>' . $value . '</option>';
    }

    $select .= '</select>';

    return $select;
});


/**
 * -----------------------------------------------------------------------------
 * Blade macros
 * -----------------------------------------------------------------------------
 *
 * Saját blade függvények definiálása.
 *
 */