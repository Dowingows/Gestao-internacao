<?php

use yii\helpers\Url;

class ProcedureIndexCest
{
    public function ensureThatProcedureIndexWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/procedure'));
        $I->see('Procedimentos', 'h1');

        $I->seeLink('Cadastrar Procedimento');
    }
}
