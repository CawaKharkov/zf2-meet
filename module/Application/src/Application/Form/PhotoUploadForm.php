<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class PhotoUploadForm extends Form {

    public function __construct($name = null)
    {
        parent::__construct('PhotoUpload');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype','multipart/form-data');
        
       
        $this->add(array(
            'name' => 'photoUpload',
            'attributes' => array(
                'type'  => 'file',
            ),
            'options' => array(
                'label' => 'Upload photo',
            ),
        )); 
        
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Upload Now',
                'class' => 'tiny round button'
            ),
        )); 
    }
}