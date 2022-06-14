<?php

use yii\helpers\Url;

class ProcedureCreateCest
{
    public function ensureThatProcedureCreateWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/procedure/create'));
        $I->see('Cadastrar Procedimento', 'h1');
        $I->fillField('input[name="Procedure[table]"]', '123');
        $I->fillField('input[name="Procedure[procedure_code]"]', '08231');
        $I->fillField('textarea[name="Procedure[description]"]', 'Isso é uma descrição');
        $I->fillField('input[name="Procedure[price]"]', '12.87');

        $I->click('Salvar');
        $I->wait(2); // wait for button to be clicked

        // $I->expectTo('see user info');
        $I->see('Atualizar');
    }
}
