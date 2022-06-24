<?php

use yii\helpers\Url;

class ProcedureCrudCest
{
    protected $tableField = 'input[name="Procedure[table]"]';
    protected $procedureCodeField = 'input[name="Procedure[procedure_code]"]';
    protected $descriptionField = 'textarea[name="Procedure[description]"]';
    protected $priceField = 'input[name="procedure-price-disp"]';

    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/procedure/index'));
    }

    public function ensureThatIndexProcedureWorks(AcceptanceTester $I)
    {
        $I->see('Procedimentos', 'h1');

        $I->seeLink('Cadastrar Procedimento');
    }

    public function ensureThatCreateProcedureWorks(AcceptanceTester $I)
    {
        $I->click('Cadastrar Procedimento');
        $I->see('Cadastrar Procedimento', 'h1');
        
        $newData = [
            'table' => '2030',
            'procedure_code' => '9876',
            'description' => 'Descrição inicial',
            'price' => '12,35',
        ];

        $I->fillField($this->tableField,  $newData['table']);
        $I->fillField($this->procedureCodeField, $newData['procedure_code']);
        $I->fillField($this->descriptionField, $newData['description']);
        $I->fillField($this->priceField, $newData['price']);

        $I->click('Salvar');
        $I->wait(2); // wait for button to be clicked

        // $I->expectTo('see user info');
        $I->see('Atualizar');
    }

    public function ensureThatEditProcedureWorks(AcceptanceTester $I)
    {
        $I->click('/html/body/main/div/div/div/table/tbody/tr[1]/td[7]/a[2]');
        $I->see('Salvar', 'button');
        
        $newData = [
            'table' => '1020',
            'procedure_code' => '1234',
            'description' => 'Nova descrição',
            'price' => '20,32',
        ];

        $I->fillField($this->tableField,  $newData['table']);
        $I->fillField($this->procedureCodeField, $newData['procedure_code']);
        $I->fillField($this->descriptionField, $newData['description']);
        $I->fillField($this->priceField, $newData['price']);

        $I->click('Salvar');
        $I->wait(2); // wait for button to be clicked

        $I->see('Atualizar');
        
    }

    

    public function ensureThatViewProcedureWorks(AcceptanceTester $I)
    {
        $I->click('/html/body/main/div/div/div/table/tbody/tr[1]/td[7]/a[1]');
        $I->see('Atualizar', 'a');
        $I->see('Remover', 'a');
    }
}
