<?php

class FilesController extends Zend_Controller_Action
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
		$this->view->files = App_Fmrest_Abstractrequest::basicRequest('/rest/files/', $this->ident);
	}
	public function adminFileAction() {
		$id = (int) $this->_getParam('id');
		$this->view->file = App_Fmrest_Abstractrequest::basicRequest('/rest/files/file/' . $id, $this->ident);
		
	}
}

