<?php

use yii\helpers\Url;

class PatientCrudCest
{
    protected $nameField = 'input[name="Patient[name]"]';
    protected $cardIdNumber = 'input[name="Patient[card_id_number]"]';
    protected $cardExpirationDateField = 'input[name="Patient[card_expiration_date]"]';
    protected $cardHealthNationalField = 'input[name="Patient[card_health_national]"]';
       

    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/patient/index'));
    }

    public function ensureThatIndexPatientWorks(AcceptanceTester $I)
    {
        $I->see('Pacientes', 'h1');

        $I->seeLink('Cadastrar Paciente');
    }

    public function ensureThatCreatePatientWorks(AcceptanceTester $I)
    {
        $I->click('Cadastrar Paciente');
        $I->see('Cadastrar Paciente', 'h1');
        
        $newData = [
            'name' => 'Paciente 1',
            'card_id_number' => '876123',
            'card_expiration_date' => '2022-08-20',
            'card_health_national' => '231234451',
        ];


        $I->fillField($this->nameField,  $newData['name']);
        $I->fillField($this->cardIdNumber, $newData['card_id_number']);
        $I->fillField($this->cardExpirationDateField, $newData['card_expiration_date']);
        $I->fillField($this->cardHealthNationalField, $newData['card_health_national']);
       
        $I->click('Salvar');
        $I->wait(2); // wait for button to be clicked

        
        $I->see('Atualizar');
    }

    public function ensureThatEditPatientWorks(AcceptanceTester $I)
    {
        $I->click('/html/body/main/div/div/div/table/tbody/tr[1]/td[7]/a[2]');
        $I->see('Salvar', 'button');
        
        $newData = [
            'name' => 'Impaciente',
            'card_id_number' => '34234',
            'card_expiration_date' => '2024-09-15',
            'card_health_national' => '445190898',
        ];


        $I->fillField($this->nameField,  $newData['name']);
        $I->fillField($this->cardIdNumber, $newData['card_id_number']);
        $I->fillField($this->cardExpirationDateField, $newData['card_expiration_date']);
        $I->fillField($this->cardHealthNationalField, $newData['card_health_national']);
       
        $I->click('Salvar');
        $I->wait(2); // wait for button to be clicked

        
        $I->see('Atualizar');
        
    }

    

    public function ensureThatViewPatientWorks(AcceptanceTester $I)
    {
        $I->click('/html/body/main/div/div/div/table/tbody/tr[1]/td[7]/a[1]');
        $I->see('Atualizar', 'a');
        $I->see('Remover', 'a');
    }
}
