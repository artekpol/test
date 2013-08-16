<?php

namespace ItelixInvestment\LoanCalculatorBundle\Controller;

use ItelixInvestment\LoanCalculatorBundle\Form\Type\CalculatorSettingsType;
use ItelixInvestment\LoanCalculatorBundle\Repository\Service;
use ItelixInvestment\RootBundle\Controller\CoreController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends CoreController
{

    /**
     * Main action
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $form = $this->createForm(new CalculatorSettingsType());
        $installments = array();
        if($this->isValidPost($form)){
            /**@var $service Service*/
            $service = $this->get('loan_calculator.service_repository');
            $installments = $service->getLoanDistributionCalculator()->distributeFromArray($form->getData());
        }

        if($this->isAjax()){
            $view = $this->renderView('ItelixInvestmentLoanCalculatorBundle:Default:_installment-table.html.twig',
                array('installments' => $installments
            ));
            $response = new Response(json_encode($view));
        }else{
            $response = $this->render('ItelixInvestmentLoanCalculatorBundle:Default:index.html.twig', array(
                'form' => $form->createView(), 'installments' => $installments
            ));
        }

        return $response;
    }
}
