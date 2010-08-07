<?php

/**
 * PluginmyCurrency form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginmyCurrencyForm extends BasemyCurrencyForm
{
    public function setup()
    {
        parent::setup();

        $this->useFields(array('valute_id', 'is_default', 'is_base', 'abbreviation', 'course'));

        $this->embedI18n(array('ru', 'en'));
    }
}
