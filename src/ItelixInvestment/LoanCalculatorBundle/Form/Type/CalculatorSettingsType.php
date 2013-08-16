<?php

// src/ItelixInvestment/LoanCalculatorBundle/Form/Type/CalculatorSettingsType.php

namespace ItelixInvestment\LoanCalculatorBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;

class CalculatorSettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('amount', 'money', array(
                'label' => 'Kwota kredytu',
                'currency' => 'PLN',
                'constraints' => array(
                    new NotBlank(),
                    new LessThanOrEqual(array('value' => 99999)),
                    new GreaterThanOrEqual(array('value' => 1)),
                ),
                'attr' => array(
                    'class' => 'input-mini validate[required], min[1], max[99999]'
                )
            ))
            ->add('interest', 'percent', array(
                'label' => 'Oprocentowanie',
                'constraints' => array(
                    new NotBlank(),
                    new LessThanOrEqual(array('value' => 999)),
                    new GreaterThanOrEqual(array('value' => 0)),
                ),
                'attr' => array(
                    'class' => 'input-mini validate[required, , min[0], max[999]]'
                )
            ))
            ->add('repayment_period', 'integer', array(
                'label' => 'Okres spłaty (miesiące)',
                'constraints' => array(
                    new NotBlank(),
                    new LessThanOrEqual(array('value' => 36)),
                    new GreaterThanOrEqual(array('value' => 1)),
                ),
                'attr' => array(
                    'class' => 'input-mini validate[required, min[1], max[36]]',
                )
            ))
        ;
    }

    public function getName()
    {
        return 'calculatorSettings';
    }
}