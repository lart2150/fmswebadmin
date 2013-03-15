<?php

class ClientsController extends Zend_Controller_Action
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
		$this->view->clients = App_Fmrest_Abstractrequest::basicRequest('/rest/clients/', $this->ident);
	}
	public function adminClientAction() {
		$id = (int) $this->_getParam('id');
		$this->view->client = App_Fmrest_Abstractrequest::basicRequest('/rest/clients/client/' . $id, $this->ident);
		if ($this->view->client->databaseConnections)
		{
			$files = array();
			$allfiles = App_Fmrest_Abstractrequest::basicRequest('/rest/files/', $this->ident);
			foreach($allfiles as $file) {
				$files[$file->fileID] = $file;
			}
			$this->view->files = $files;
		}
	}
}

