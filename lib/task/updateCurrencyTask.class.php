<?php
/**
 * Обновление курсов валют
 */
class updateCurrencyTask extends sfBaseTask
{
    protected function configure()
    {
        $this->namespace        = 'crimea';
        $this->name             = 'updateCurrency';
        $this->briefDescription = '';
        $this->detailedDescription = <<<EOF
The [updateCurrency|INFO] task does update currency from www.cbr.ru.
Call it with:

  [php symfony crimea:updateCurrency|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array())
    {
        new sfDatabaseManager($this->configuration);

        $content = file_get_contents('http://www.cbr.ru/scripts/XML_daily.asp', false,
            stream_context_create(array('http' => array('method' => 'GET'))));

        if ($xml = simplexml_load_string($content)) {
            $currency = Doctrine::getTable('myCurrency')->createQuery('c')
                ->where('c.valute_id IS NOT NULL')
                ->execute();

            foreach ($currency as $c) {
                list($node) = $xml->xpath('//Valute[@ID="'.$c->getValuteId().'"]');

                $value = str_replace(',', '.', $node->Value);
                $course = (real)$value / $node->Nominal;

                $c->setCourse($course);
                $c->save();

                $this->logSection('success', sprintf('1 %s = %s RUR', $c->getAbbreviation(), $course));
            }
        } else {
            throw new Exception(__METHOD__ . ': could\'t parse xml');
        }
    }
}
