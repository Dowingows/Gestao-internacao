<?php

use yii\helpers\Url;

class HomeCest
{
    public function ensureThatHomePageWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));        
        $I->see('Seja bem-vindo!');
    
        $I->wait(2); // wait for page to be opened
        
        $I->see('Tabelas');
    }
}
