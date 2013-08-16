<?php

namespace ItelixInvestment\LoanCalculatorBundle\Calculator\LoanDistribution;
/**
 * Representation of one installment
 *
 * Class Installment
 * @package ItelixInvestment\LoanCalculatorBundle\Calculator\LoanDistribution
 */
class Installment
{
    /**
     * @var string
     */
    protected $no;

    /**
     * @var string
     */
    protected $amount;

    /**
     * @var string
     */
    protected $cumulativeAmount;

    /**
     * @param string $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param string $cumulativeAmount
     * @return $this
     */
    public function setCumulativeAmount($cumulativeAmount)
    {
        $this->cumulativeAmount = $cumulativeAmount;

        return $this;
    }

    /**
     * @return string
     */
    public function getCumulativeAmount()
    {
        return $this->cumulativeAmount;
    }

    /**
     * @param string $no
     * @return $this
     */
    public function setNo($no)
    {
        $this->no = $no;

        return $this;
    }

    /**
     * @return string
     */
    public function getNo()
    {
        return $this->no;
    }



    /**
     * @param $no
     * @param $amount
     * @param $cumulativeAmount
     */
    public function __construct($no, $amount, $cumulativeAmount)
    {
        $this->no = $no;
        $this->amount = $amount;
        $this->cumulativeAmount = $cumulativeAmount;
    }


}