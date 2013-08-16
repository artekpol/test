<?php

namespace ItelixInvestment\LoanCalculatorBundle\Tests\Calculator;

use ItelixInvestment\LoanCalculatorBundle\Calculator\LoanDistribution;

class LoanDistributionTest extends \PHPUnit_Framework_TestCase
{
    public function testDistributeFromArray()
    {
        $testData = array('amount' => '4444', 'interest' => '3', 'repayment_period' => '3');
        $ld = new LoanDistribution();
        $distribution = $ld->distributeFromArray($testData);
        $this->assertEquals(3, count($distribution));
        $this->assertEquals('2592.33', $distribution[0]->getAmount());
        //...
    }
}