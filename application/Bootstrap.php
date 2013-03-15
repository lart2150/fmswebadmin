<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected function _initAutoload()
	{
		$autoLoader = Zend_Loader_Autoloader::getInstance();
		$resourceLoader = new Zend_Loader_Autoloader_Resource(array(
				'basePath' => APPLICATION_PATH,
				'namespace' => '',
				'resourceTypes' => array(
						'App' => array(
								'path' => '../library/app',
								'namespace' => 'App_'
						)
				),
		));
	}
	protected function _initACL()
	{
		$acl = new Zend_Acl();
		$roleGuest = new Zend_Acl_Role('guest');
		$acl->addRole($roleGuest);
		$acl->addRole(new Zend_Acl_Role('view'), $roleGuest);
		$acl->addRole(new Zend_Acl_Role('files'), 'view');
		$acl->addRole(new Zend_Acl_Role('clients'), 'view');
		$acl->addRole(new Zend_Acl_Role('administrator'));
	
		$acl->allow('view', null, array('view'));
		$acl->allow('files', null, array('files'));
		$acl->allow('clients', null, array('clients'));
		$acl->allow('administrator');
	
		Zend_Registry::set('acl', $acl);
	}
	protected function _initAuthAdapter()
	{
		$adapter = new App_Fmrest_Auth_Adapter();
		Zend_Registry::set('auth', $adapter);
	}
	protected function _initLayoutAuth()
	{
		$this->ident = Zend_Auth::getInstance()->getIdentity();
		Zend_Layout::startMvc();
		$layout = Zend_Layout::getMvcInstance();
		$view = $layout->getView();
		
		$helper = new App_View_Helper_Navbar();
	    $view->registerHelper($helper, 'navbar');
	}
	protected function _initConfig()
	{
		$config = new Zend_Config($this->getOptions(), true);
		Zend_Registry::set('config', $config);
	}
}

