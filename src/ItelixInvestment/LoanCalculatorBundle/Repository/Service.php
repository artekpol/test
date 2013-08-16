<?php

/**
 * Here are housed services related with bundle
 */

namespace ItelixInvestment\LoanCalculatorBundle\Repository;

use appDevDebugProjectContainer;

class Service
{
    /**
     * @var appDevDebugProjectContainer
     */
    protected $serviceContainer;

    /**
     * @return appDevDebugProjectContainer
     */
    public function getServiceContainer()
    {
        return $this->serviceContainer;
    }

    /**
     * @param appDevDebugProjectContainer $serviceContainer
     */
    public function __construct(appDevDebugProjectContainer $serviceContainer)
    {
        $this->serviceContainer = $serviceContainer;
    }

    /**
     * @return \ItelixInvestment\LoanCalculatorBundle\Calculator\LoanDistribution
     */
    public function getLoanDistributionCalculator()
    {
        return $this->getServiceContainer()->get('loan_calculator.loan_distribution');
    }
}