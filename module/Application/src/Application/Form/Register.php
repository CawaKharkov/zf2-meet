<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterProviderInterface;


class Register extends Form implements InputFilterProviderInterface
{

    public function __construct()
    {
        parent::__construct('form-user');

        $this->setAttribute('method', 'post')
             ->setInputFilter(new InputFilter);

        $this->add([
            'name' => 'firstName',
            'options' => [
                'label' => 'First Name',
                'label_attributes' => [
                    'class' => 'control-label',
                ],
            ],
            'attributes' => [
                'required' => 'required',
            ],
        ]);

        $this->add([
            'name' => 'lastName',
            'options' => [
                'label' => 'Last Name',
                'label_attributes' => [
                    'class' => 'control-label',
                ],
            ],
            'attributes' => [
                'required' => 'required',
            ],
        ]);

        $this->add([
            'name' => 'displayName',
            'options' => [
                'label' => 'Display Name',
                'label_attributes' => [
                    'class' => 'control-label',
                ],
            ],
            'attributes' => [
                'required' => 'required',
            ],
        ]);

        $this->add([
            'name' => 'email',
            'options' => [
                'label' => 'Email',
                'label_attributes' => [
                    'class' => 'control-label',
                ],
            ],
            'attributes' => [
                'required' => 'required',
            ],
        ]);

        $this->add([
            'name' => 'created',
            'options' => [
                'label' => 'Created',
                'label_attributes' => [
                    'class' => 'control-label',
                ],
            ],
        ]);

        $this->add([
            'name' => 'lastLogin',
            'options' => [
                'label' => 'Last Login',
                'label_attributes' => [
                    'class' => 'control-label',
                ],
            ],
        ]);

        $this->add([
            'name' => 'id',
            'attributes' => [
                'type' => 'hidden',
            ],
        ]);

        $this->add([
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf',
        ]);

        /*$this->add([
            'name' => 'submit',
            'attributes' => [
                'type' => 'submit',
                'value' => 'Send',
            ],
        ]);*/
    }

    public function getInputFilterSpecification()
    {
        return [
            'displayName' => [
                'required' => true,
            ],
        ];
    }
}
