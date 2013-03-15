<?php

class IndexController extends Zend_Controller_Action
{
	protected $ident;
    public function init()
    {
    	$this->ident  = Zend_Auth::getInstance()->getIdentity();
    	$acl = Zend_Registry::get('acl');
    	if (!$this->ident || !$acl->isAllowed($this->ident['role'], null, 'view'))
    	{
    		$this->_helper->redirector('index', 'auth');
    	}
    }

    public function indexAction()
    {
		$this->view->json = App_Fmrest_Abstractrequest::basicRequest('/rest/server-status/', $this->ident);
    }


}

