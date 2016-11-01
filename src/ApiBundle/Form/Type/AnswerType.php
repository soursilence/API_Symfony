<?php

namespace ApiBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AnswerType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('article')
                ->add('content')
                ->add('user_email')
                ->add('save', SubmitType::class);
    }

    public function getName() {
        return 'answer';
    }

}
