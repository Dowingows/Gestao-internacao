<?php

use yii\helpers\Url;

class HospitalCrudCest
{
    protected $nameField = 'input[name="Hospital[name]"]';
    protected $tradeNameFiled = 'input[name="Hospital[trade_name]"]';
    protected $cnpjField = 'input[name="Hospital[cnpj]"]';
       

    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/hospital/index'));
    }

    public function ensureThatIndexHospitalWorks(AcceptanceTester $I)
    {
        $I->see('Hospitais', 'h1');

        $I->seeLink('Cadastrar Hospital');
    }

    public function ensureThatCreateHospitalWorks(AcceptanceTester $I)
    {
        $I->click('Cadastrar Hospital');
        $I->see('Cadastrar Hospital', 'h1');
        
        $newData = [
            'name' => 'Hospital de teste',
            'trade_name' => '876123',
            'cnpj' => '87114364000180'
        ];


        $I->fillField($this->nameField,  $newData['name']);
        $I->fillField($this->tradeNameFiled, $newData['trade_name']);
        $I->fillField($this->cnpjField, $newData['cnpj']);
       
        $I->click('Salvar');
        $I->wait(2); 

        $I->see('Atualizar');
    }

    public function ensureThatEditHospitalWorks(AcceptanceTester $I)
    {
        $I->click('/html/body/main/div/div/div/table/tbody/tr/td[6]/a[2]');
        $I->see('Salvar', 'button');
        
        $newData = [
            'name' => 'Hospital de teste 2',
            'trade_name' => '876123',
            'cnpj' => '87114364000180'
        ];


        $I->fillField($this->nameField,  $newData['name']);
        $I->fillField($this->tradeNameFiled, $newData['trade_name']);
        $I->fillField($this->cnpjField, $newData['cnpj']);
       
        $I->click('Salvar');
        $I->wait(2); 

        $I->see('Atualizar');
        
    }

    public function ensureThatViewHospitalWorks(AcceptanceTester $I)
    {
        $I->click('/html/body/main/div/div/div/table/tbody/tr[1]/td[6]/a[1]');
        $I->see('Atualizar', 'a');
        $I->see('Remover', 'a');
    }
}
