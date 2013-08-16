<?php

namespace ItelixInvestment\LoanCalculatorBundle\Calculator;

use \ItelixInvestment\LoanCalculatorBundle\Calculator\LoanDistribution\Exception;
use ItelixInvestment\LoanCalculatorBundle\Calculator\LoanDistribution\Installment;

/**
 * Loans calculator
 */
class LoanDistribution
{

    /**
     * Main method create and return collection of installment
     *
     * @param $amount
     * @param $interest
     * @param $repaymentPeriod
     * @return array|Installment[]
     * @throws LoanDistribution\Exception
     */
    public function distribute($amount, $interest, $repaymentPeriod)
    {
        $this->checkValues($amount, $interest, $repaymentPeriod);
        $installments = array();
        $cumulativeInstallmentAmount = 0;
        for($i = 1; $i <= $repaymentPeriod; $i++){

            $installmentAmount = $this->calculateInstallmentAmount($i, $amount, $interest, $repaymentPeriod);
            $cumulativeInstallmentAmount = bcadd($cumulativeInstallmentAmount, $installmentAmount, 2);
            $installments[] = new Installment($i, $installmentAmount, $cumulativeInstallmentAmount);
        }
        return $installments;
    }

    /**
     * Calculate the amount of the installment ($no - number of installments sought)
     *
     * @param $no
     * @param $amount
     * @param $interest
     * @param $repaymentPeriod
     * @return string
     */
    protected function calculateInstallmentAmount($no, $amount, $interest, $repaymentPeriod)
    {
        $installmentAmount = bcsub($repaymentPeriod, $no);
        $installmentAmount = bcadd($installmentAmount, 1);
        $installmentAmount = bcmul($installmentAmount, bcdiv($interest, 12, 4), 4);
        $installmentAmount = bcadd($installmentAmount, 1, 6);
        $installmentAmount = bcmul($installmentAmount, $amount, 8);
        $installmentAmount = bcdiv($installmentAmount, $repaymentPeriod, 2);
        return $installmentAmount;
    }

    /**
     * Create installment distribution from array data
     *
     * @param array $array
     * @return array|\ItelixInvestment\LoanCalculatorBundle\Calculator\LoanDistribution\Installment[]
     * @throws LoanDistribution\Exception
     */
    public function distributeFromArray(array $array)
    {
        $requireKeys = array('amount', 'interest', 'repayment_period');
        if(count(array_intersect_key($array, array_flip($requireKeys))) !== count($requireKeys)){
            throw new Exception(sprintf('Some params are missing (%s params are required)', implode(', ', $requireKeys)));
        }
        return $this->distribute($array['amount'], $array['interest'], $array['repayment_period']);
    }

    /**
     * @param $amount
     * @param $interest
     * @param $repaymentPeriod
     * @throws LoanDistribution\Exception
     * @return $this
     */
    protected function checkValues($amount, $interest, $repaymentPeriod)
    {
        if(!$this->isValidAmountValue($amount)){
            throw new Exception(sprintf('Amount %s  isn\'t correct', $amount));
        }

        if(!$this->isValidAmountValue($amount)){
            throw new Exception(sprintf('Interest %s  isn\'t correct', $interest));
        }

        if(!$this->isValidAmountValue($amount)){
            throw new Exception(sprintf('Repayment period %s  isn\'t correct', $repaymentPeriod));
        }

        return $this;
    }

    /**
     * Tell if amount is valid
     *
     * @param $amount
     * @return bool
     */
    protected function isValidAmountValue($amount)
    {
        return true;
    }

    /**
     * Tell if interest is valid
     *
     * @param $interest
     * @return bool
     */
    protected function isValidInterestValue($interest)
    {
        return true;
    }
    /**
     * Tell if repayment period is valid
     *
     * @param $repaymentPeriod
     * @return bool
     */
    protected function isValidRepaymentPeriodValue($repaymentPeriod)
    {
        return true;
    }
}