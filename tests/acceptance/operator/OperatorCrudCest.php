<?php

use yii\helpers\Url;

class OperatorCrudCest
{
    protected $nameField = 'input[name="Operator[name]"]';
    protected $ansCodeField = 'input[name="Operator[ans_code]"]';

       

    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/login'));
        $I->see('Login', 'h1');

        $I->amGoingTo('try to login with correct credentials');
        $I->fillField('input[name="LoginForm[username]"]', 'admin');
        $I->fillField('input[name="LoginForm[password]"]', '123456');
        $I->click('login-button');
        $I->wait(2); // wait for button to be clicked

        $I->see('Logout');
        
        $I->amOnPage(Url::toRoute('/operator/index'));
    }

    public function ensureThatIndexOperatorWorks(AcceptanceTester $I)
    {
        $I->see('Operadoras', 'h1');

        $I->seeLink('Cadastrar Operadora');
    }

    public function ensureThatCreateOperatorWorks(AcceptanceTester $I)
    {
        $I->click('Cadastrar Operadora');
        $I->see('Cadastrar Operadora', 'h1');
        
        $newData = [
            'name' => 'Operadora de teste',
            'ans_code' => '45345435'
        ];


        $I->fillField($this->nameField,  $newData['name']);
        $I->fillField($this->ansCodeField, $newData['ans_code']);
       
        $I->click('Salvar');
        $I->wait(2); 

        $I->see('Atualizar');
    }

    public function ensureThatEditOperatorWorks(AcceptanceTester $I)
    {
        $I->click('/html/body/main/div/div/div/table/tbody/tr[1]/td[5]/a[2]');
        $I->see('Salvar', 'button');

        $newData = [
            'name' => 'Atualizacao da operadora',
            'ans_code' => '2346757'
        ];


        $I->fillField($this->nameField,  $newData['name']);
        $I->fillField($this->ansCodeField, $newData['ans_code']);
       
        $I->click('Salvar');
        $I->wait(2); 

        $I->see('Atualizar');
        
    }

    public function ensureThatViewOperatorWorks(AcceptanceTester $I)
    {
        $I->click('/html/body/main/div/div/div/table/tbody/tr[1]/td[5]/a[1]');
        $I->see('Atualizar', 'a');
        $I->see('Remover', 'a');
    }
}
