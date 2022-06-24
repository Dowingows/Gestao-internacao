<?php

use yii\helpers\Url;

class MedicineCrudCest
{
    protected $codTissField = 'input[name="Medicine[cod_tiss]"]';
    protected $umVrField = 'input[name="Medicine[um_vr]"]';
    protected $undField = 'input[name="Medicine[und]"]';
    protected $descriptionField = 'textarea[name="Medicine[description]"]';
    protected $codTnumField = 'input[name="Medicine[cod_tnumm]"]';
    protected $codBrasIndiceField = 'input[name="Medicine[cod_brasindice]"]';
    protected $codTiss2Field = 'input[name="Medicine[cod_tiss_2]"]';
    protected $codAgendField = 'input[name="Medicine[cod_agend]"]';
    protected $codAgendCobField = 'input[name="Medicine[cod_agend_cob]"]';
    protected $priceField = 'input[name="medicine-price-disp"]';
    
    

    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/medicine/index'));
    }

    public function ensureThatIndexMedicineWorks(AcceptanceTester $I)
    {
        $I->see('Medicamentos', 'h1');

        $I->seeLink('Cadastrar Medicamento');
    }

    public function ensureThatCreateMedicineWorks(AcceptanceTester $I)
    {
        $I->click('Cadastrar Medicamento');
        $I->see('Cadastrar Medicamento', 'h1');
        
        $newData = [
            'cod_tiss' => '57344',
            'um_vr' => 'R$',
            'und' => 'und',
            'description' => 'VIDMAX 50 mg. cpr.',
            'cod_tnum' => '1',
            'cod_brasindice' => '048.21819.CLQD',
            'cod_tiss_2' =>'1',
            'cod_agend'=> '123',
            'cod_agend_cob'=>'234',
            'price' => '1,75',
        ];


        $I->fillField($this->codTissField,  $newData['cod_tiss']);
        $I->fillField($this->umVrField, $newData['um_vr']);
        $I->fillField($this->undField, $newData['und']);
        $I->fillField($this->descriptionField, $newData['description']);
        $I->fillField($this->codTnumField, $newData['cod_tnum']);
        $I->fillField($this->codBrasIndiceField,  $newData['cod_brasindice']);
        $I->fillField($this->codTiss2Field, $newData['cod_tiss_2']);
        $I->fillField($this->codAgendField, $newData['cod_agend']);
        $I->fillField($this->codAgendCobField, $newData['cod_agend_cob']);
        $I->fillField($this->priceField, $newData['price']);
        
        

        $I->click('Salvar');
        $I->wait(2); // wait for button to be clicked

        
        $I->see('Atualizar');
    }

    public function ensureThatEditMedicineWorks(AcceptanceTester $I)
    {
        $I->click('/html/body/main/div/div/div/table/tbody/tr[1]/td[7]/a[2]');
        $I->see('Salvar', 'button');
        
        $newData = [
            'cod_tiss' => '34457',
            'um_vr' => 'US$',
            'und' => 'NDU',
            'description' => 'DIPIRONA 50 mg. cpr.',
            'cod_tnum' => '2',
            'cod_brasindice' => 'X23.012.8769',
            'cod_tiss_2' =>'2',
            'cod_agend'=> '627',
            'cod_agend_cob'=>'432',
            'price' => '3,55',
        ];


        $I->fillField($this->codTissField,  $newData['cod_tiss']);
        $I->fillField($this->umVrField, $newData['um_vr']);
        $I->fillField($this->undField, $newData['und']);
        $I->fillField($this->descriptionField, $newData['description']);
        $I->fillField($this->codTnumField, $newData['cod_tnum']);
        $I->fillField($this->codBrasIndiceField,  $newData['cod_brasindice']);
        $I->fillField($this->codTiss2Field, $newData['cod_tiss_2']);
        $I->fillField($this->codAgendField, $newData['cod_agend']);
        $I->fillField($this->codAgendCobField, $newData['cod_agend_cob']);
        $I->fillField($this->priceField, $newData['price']);
        
        

        $I->click('Salvar');
        $I->wait(2); // wait for button to be clicked

        
        $I->see('Atualizar');
        
    }

    

    public function ensureThatViewMedicineWorks(AcceptanceTester $I)
    {
        $I->click('/html/body/main/div/div/div/table/tbody/tr[1]/td[7]/a[1]');
        $I->see('Atualizar', 'a');
        $I->see('Remover', 'a');
    }
}
