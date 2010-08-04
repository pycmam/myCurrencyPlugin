<?php

/**
 * Компонент смены валют
 */
class myCurrencyComponents extends sfComponents
{
    /**
     * Список выбора валюты
     */
    public function executeChanger()
    {
        $table = myCurrencyTable::getInstance();

        $this->items = $table->getActiveCurrency();

        $this->currentId = $this->getUser()->getAttribute('id', $table->getDefaultCurrency()->getId(), 'currency');
    }
}