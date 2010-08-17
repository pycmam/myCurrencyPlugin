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
    $value = myCurrency::convert($value, get_currency());

    if ($round) {
        $value = round($value);
    }

    if ($format) {
        $value = currency_apply_format($value);
    }

    return $value;
}

/**
 * Конвертировать валюту из указанной в текущую
 *
 * @param double $value
 * @param integer $sourceCurrencyId
 * @param boolean $format
 * @param boolean $round
 */
function currencyFrom($value, $sourceCurrencyId, $format = true, $round = false)
{
    $value = myCurrency::convertFromTo($value, $sourceCurrencyId, get_currency());

    if ($round) {
        $value = round($value);
    }

    if ($format) {
        $value = currency_apply_format($value);
    }

    return $value;
}

/**
 * Конвертация валюты в другую валюту
 *
 * @param double_ $value
 * @param integer $sourceCurrencyId
 * @param integer $targetCurrencyId
 * @param boolean $format
 * @param boolean $round
 */
function currency2currency($value, $sourceCurrencyId, $targetCurrencyId, $format = true, $round = false) {
    $value = myCurrency::convertFromTo($value, $sourceCurrencyId, $targetCurrencyId);

    if ($round) {
        $value = round($value);
    }

    if ($format) {
        $value = currency_apply_format($value);
    }

    return $value;
}

/**
 * Применить форматирование к цене
 *
 * @param double $value
 */
function currency_apply_format($value) {
    use_helper('Number');
    $user = sfContext::getInstance()->getUser();
    return sprintf($user->getAttribute('format', myCurrency::getDefaultCurrency()->getFormat(), 'currency'), format_number($value));
}


/**
 * Возвращает текущую валюту пользователя
 *
 * @return int
 */
function get_currency() {
    $currencyId = sfContext::getInstance()->getUser()->getAttribute('id', false, 'currency');

    if (false == $currencyId) {
        $currencyId = myCurrency::getDefaultCurrency()->getId();
    }

    return $currencyId;
}