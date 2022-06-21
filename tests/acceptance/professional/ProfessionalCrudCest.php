<?php

use yii\helpers\Url;

class ProfessionalCrudCest
{
    protected $nameField = 'input[name="Professional[name]"]';
    protected $councilField = 'input[name="Professional[council]"]';
    protected $councilNumberField = 'input[name="Professional[council_number]"]';
    protected $uFField = 'input[name="Professional[uf]"]';
    protected $cboCodeField = 'input[name="Professional[cbo_code]"]';
    protected $typeField = 'select[name="Professional[type]"]';
    

    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/professional/index'));
    }

    public function ensureThatIndexProfessionalWorks(AcceptanceTester $I)
    {
        $I->see('Profissionais', 'h1');

        $I->seeLink('Cadastrar Profissional');
    }

    public function ensureThatCreateProfessionalWorks(AcceptanceTester $I)
    {
        $I->click('Cadastrar Profissional');
        $I->see('Cadastrar Profissional', 'h1');
        
        $newData = [
            'name' => 'Jon Doe',
            'council' => 'JDE',
            'council_number' => '65231',
            'uf' => 'MA',
            'cbo_code' => '65731',
            'type' => 'TERA'
        ];

        $I->fillField($this->nameField,  $newData['name']);
        $I->fillField($this->councilField, $newData['council']);
        $I->fillField($this->councilNumberField, $newData['council_number']);
        $I->fillField($this->uFField, $newData['uf']);
        $I->fillField($this->cboCodeField, $newData['cbo_code']);
        $I->selectOption($this->typeField, $newData['type']);

        $I->click('Salvar');
        $I->wait(2); // wait for button to be clicked

        // $I->expectTo('see user info');
        $I->see('Atualizar');
    }

    public function ensureThatEditProfessionalWorks(AcceptanceTester $I)
    {
        $I->click('/html/body/main/div/div/div/table/tbody/tr[1]/td[6]/a[2]');
        $I->see('Salvar', 'button');
        
        $newData = [
            'name' => 'Mary New',
            'council' => 'ZKL',
            'council_number' => '43276',
            'uf' => 'MA',
            'cbo_code' => '862316',
            'type' => 'PSI'
        ];

        $I->fillField($this->nameField,  $newData['name']);
        $I->fillField($this->councilField, $newData['council']);
        $I->fillField($this->councilNumberField, $newData['council_number']);
        $I->fillField($this->uFField, $newData['uf']);
        $I->fillField($this->cboCodeField, $newData['cbo_code']);
        $I->selectOption($this->typeField, $newData['type']);

        $I->click('Salvar');
        $I->wait(2); // wait for button to be clicked

        $I->see('Atualizar');
        
    }

    

    public function ensureThatViewProfessionalWorks(AcceptanceTester $I)
    {
        $I->click('/html/body/main/div/div/div/table/tbody/tr[1]/td[6]/a[1]');
        $I->see('Atualizar', 'a');
        $I->see('Remover', 'a');
    }
}
