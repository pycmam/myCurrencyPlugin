<?php
/**
 * Помощник конвертации валют
 */

/**
 * Конвертирует цену согласно выбранной валюте пользователя
 *
 * @return double
 */
function convert_currency($value, $format = true, $round = false) {
    $user = sfContext::getInstance()->getUser();
    $value = myCurrency::convert($value, get_currency());

    if ($round) {
        $value = round($value);
    }

    if ($format) {
        $value = sprintf($user->getAttribute('format', '%s грн.', 'currency'), $value);
    }

    return $value;
}


/**
 * Возвращает текущую валюту пользователя
 *
 * @return int
 */
function get_currency() {
    return sfContext::getInstance()->getUser()->getAttribute('id', null, 'currency');
}