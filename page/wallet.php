<?php
class page_wallet extends Page {

	function init(){
		parent::init();

		$crud = $this->add('CRUD');
		$crud->setModel('Wallet');

		// $crud->grid->addQuickSearch(['name']);

	}
	
}