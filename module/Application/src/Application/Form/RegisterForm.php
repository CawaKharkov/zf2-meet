<?php

namespace Application\Form;

use Zend\Form\Element\Captcha as Captcha;
use ZfcUser\Options\RegistrationOptionsInterface;
use Zend\InputFilter\InputFilter;

class RegisterForm extends \ZfcUser\Form\Base
{
    protected $captchaElement= null;

    /**
     * @var RegistrationOptionsInterface
     */
    protected $registrationOptions;

    /**
     * @param string|null $name
     * @param RegistrationOptionsInterface $options
     */
    public function __construct($name = null, RegistrationOptionsInterface $options)
    {
        $this->setRegistrationOptions($options);
        parent::__construct($name);

        $this->remove('userId');
        if (!$this->getRegistrationOptions()->getEnableUsername()) {
            $this->remove('username');
        }

        if (!$this->getRegistrationOptions()->getEnableDisplayName()) {
            $this->remove('display_name');
        }
        if ($this->getRegistrationOptions()->getUseRegistrationFormCaptcha() && $this->captchaElement) {
            $this->add($this->captchaElement, array('name'=>'captcha'));
        }
        $this->get('submit')->setLabel('Register');
        $this->get('submit')->setAttribute('class', 'small round success button');
        $this->getEventManager()->trigger('init', $this);

        $this->setAttribute('method', 'post')
                ->setInputFilter(new InputFilter);

        $this->add([
            'name' => 'real_name',
            'attributes' => [
                'type' => 'input',
                'required' => 'required',
                'class' => 'six',
            ],
            'options' => [
                'label' => "Real name"

                ],
        ]);

        $this->add([
            'name' => 'birth',
            'attributes' => [
                'type' => 'date',
                'required' => 'required',
                'class' => 'datepicker three'
            ],
            'options' => [
                'label' => "Birth"
                ],
        ]);


        $this->add([
            'name' => 'country',
            'attributes' => [
                'type' => 'text',
                'required' => 'required',
                'class' => 'six'
            ],
            'options' => [
                'label' => "Country"
                ],
        ]);





    }

    public function setCaptchaElement(Captcha $captchaElement)
    {
        $this->captchaElement= $captchaElement;
    }

    /**
     * Set Regsitration Options
     *
     * @param RegistrationOptionsInterface $registrationOptions
     * @return Register
     */
    public function setRegistrationOptions(RegistrationOptionsInterface $registrationOptions)
    {
        $this->registrationOptions = $registrationOptions;
        return $this;
    }

    /**
     * Get Regsitration Options
     *
     * @return RegistrationOptionsInterface
     */
    public function getRegistrationOptions()
    {
        return $this->registrationOptions;
    }
}
