<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
    	$this->setName("login");
    	$this->setMethod('post');
    	
    	$this->addElement('select', 'server',
    			array(
    					'required' => true,
    					'label' => 'Server:'
    			)
    	);
    	$servers = Zend_Registry::get('config')->fm->servers->toArray();
    	$this->getElement('server')->addMultiOptions($servers );
    	
    	$this->addElement('text', 'username',
    			array(
    					'filters' => array(
    							'StringTrim',
    							'StringToLower'
    					),
    					'validators' => array(
    							array(
    									'StringLength',
    									false,
    									array(
    											0,
    											50
    									)
    							)
    					),
    					'required' => true,
    					'label' => 'Username:'
    			)
    	);
    	$this->getElement('username')->setAttribs(array('placeholder' => 'Username'));
    	
    	$this->addElement('password', 'password',
    			array(
    					'filters' => array(
    							'StringTrim'
    					),
    					'validators' => array(
    							array(
    									'StringLength',
    									false,
    									array(0, 50)
    							)
    					) ,
    					'required' => true,
    					'label' => 'Password:'
    			)
    	);
    	$this->getElement('password')->setAttribs(array('placeholder' => 'Password'));
    	
    	$this->addElement('submit', 'login',
    			array(
    					'required' => false,
    					'ignore' => true,
    					'label' => 'Login'
    			)
    	);
    	$this->getElement('login')->class = 'btn btn-primary';
    }


}

