<?php

/**
 * This controller is inherited by other controllers and it does not contain the actions.
 */

namespace ItelixInvestment\RootBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
    /**
     * @param \Symfony\Component\Form\Form $form
     * @return bool
     */
    protected function isValidPost(\Symfony\Component\Form\Form $form)
    {
        $form->handleRequest($request = $this->getRequest());
        if(!$request->isMethod('POST')){
            return false;
        }
        return $form->isValid();
    }

    /**
     * @return bool
     */
    protected function isAjax()
    {
        return $this->getRequest()->isXmlHttpRequest();
    }
}
