<?php

namespace ItelixInvestment\LoanCalculatorBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertTrue($crawler->filter('html:contains("#loan-calculator")')->count() > 0);
        $this->assertTrue($crawler->filter('html:contains("#installments-table")')->count() > 0);

        $form = $crawler->selectButton('Oblicz')->form(array(
            'calculatorSettings[amount]' => '44444',
            'calculatorSettings[interest]' => '3',
            'calculatorSettings[repayment_period]' => '3'
        ));

        $crawler = $client->submit($form);
        $this->assertTrue($crawler->filter('html:contains("rata")')->count() > 0);
        //...
    }
}
