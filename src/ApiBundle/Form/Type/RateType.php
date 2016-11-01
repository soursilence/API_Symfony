<?php

namespace ApiBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RateType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('rate')
                ->add('article')
                ->add('save', SubmitType::class);
    }

    public function getName() {
        return 'rate';
    }

}
