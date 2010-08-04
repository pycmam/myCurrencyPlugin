<?php

/**
 * Модуль смены валют
 */
class myCurrencyActions extends sfActions
{
    /**
     * Сменить валюту
     */
    public function executeChange(sfWebRequest $request)
    {
        $currency = myCurrencyTable::getInstance()
            ->findOneById((int) $request->getParameter('currency'));

        $this->forward404Unless($currency);

        $this->getUser()->setAttribute('id', $currency->getId(), 'currency');
        $this->getUser()->setAttribute('format', $currency->getFormat(), 'currency');

        if ($referer = $request->getReferer()) {
            return $this->redirect($referer);
        } else {
            return $this->redirect('homepage');
        }
    }
}
