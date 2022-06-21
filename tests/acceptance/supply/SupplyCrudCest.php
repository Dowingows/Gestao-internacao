<?php

use yii\helpers\Url;

class SupplyCrudCest
{
    protected $codSimproField = 'input[name="Supply[cod_simpro]"]';
    protected $unVrField = 'input[name="Supply[un_vr]"]';
    protected $undField = 'input[name="Supply[und]"]';
    protected $descriptionField = 'textarea[name="Supply[description]"]';
    protected $codTNummField = 'input[name="Supply[cod_tnumm]"]';
    protected $codPadraoField = 'input[name="Supply[cod_padrao]"]';
    protected $codAgendNumberField = 'input[name="Supply[cod_agend]"]';
    protected $codAgendCobField = 'input[name="Supply[cod_agend_cob]"]';
    protected $natureField = 'input[name="Supply[nature]"]';
    protected $priceField = 'input[name="Supply[price]"]';
    
    

    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/supply/index'));
    }

    public function ensureThatIndexSupplyWorks(AcceptanceTester $I)
    {
        $I->see('Materiais', 'h1');

        $I->seeLink('Cadastrar Material');
    }

    public function ensureThatCreateSupplyWorks(AcceptanceTester $I)
    {
        $I->click('Cadastrar Material');
        $I->see('Cadastrar Material', 'h1');
        
        $newData = [
            'cod_simpro' => '90123093',
            'un_vr' => 'R$',
            'und' => 'und',
            'description' => 'SOLUÇÃO CLORETO DE SÓDIO 0,9% EP 500ml (Restrito Hosp.)',
            'cod_tnumm' => '3246787',
            'cod_padrao' => '12',
            'cod_agend' => '324671287',
            'cod_agend_cob' => '234234',
            'nature' => 'C',
            'price' => '5.00',
        ];

        $I->fillField($this->codSimproField,  $newData['cod_simpro']);
        $I->fillField($this->unVrField,  $newData['un_vr']);
        $I->fillField($this->undField,  $newData['und']);
        $I->fillField($this->descriptionField,  $newData['description']);
        $I->fillField($this->codTNummField,  $newData['cod_tnumm']);
        $I->fillField($this->codPadraoField,  $newData['cod_padrao']);
        $I->fillField($this->codAgendNumberField,  $newData['cod_agend']);
        $I->fillField($this->codAgendCobField,  $newData['cod_agend_cob']);
        $I->fillField($this->natureField,  $newData['nature']);
        $I->fillField($this->priceField,  $newData['price']);
        
       
       

        $I->click('Salvar');
        $I->wait(2); // wait for button to be clicked

        
        $I->see('Atualizar');
    }

    public function ensureThatEditSupplyWorks(AcceptanceTester $I)
    {
        $I->click('/html/body/main/div/div/div/table/tbody/tr[1]/td[7]/a[2]');
        $I->see('Salvar', 'button');
        
        $newData = [
            'cod_simpro' => '90123093',
            'un_vr' => 'US$',
            'und' => 'u',
            'description' => 'DIPIRONA',
            'cod_tnumm' => '987123',
            'cod_padrao' => '12',
            'cod_agend' => '8767862',
            'cod_agend_cob' => '212567',
            'nature' => 'g',
            'price' => '2.53',
        ];

        $I->fillField($this->codSimproField,  $newData['cod_simpro']);
        $I->fillField($this->unVrField,  $newData['un_vr']);
        $I->fillField($this->undField,  $newData['und']);
        $I->fillField($this->descriptionField,  $newData['description']);
        $I->fillField($this->codTNummField,  $newData['cod_tnumm']);
        $I->fillField($this->codPadraoField,  $newData['cod_padrao']);
        $I->fillField($this->codAgendNumberField,  $newData['cod_agend']);
        $I->fillField($this->codAgendCobField,  $newData['cod_agend_cob']);
        $I->fillField($this->natureField,  $newData['nature']);
        $I->fillField($this->priceField,  $newData['price']);
        
       
       

        $I->click('Salvar');
        $I->wait(2); // wait for button to be clicked

        
        $I->see('Atualizar');
        
    }

    

    public function ensureThatViewSupplyWorks(AcceptanceTester $I)
    {
        $I->click('/html/body/main/div/div/div/table/tbody/tr[1]/td[7]/a[1]');
        $I->see('Atualizar', 'a');
        $I->see('Remover', 'a');
    }
}
