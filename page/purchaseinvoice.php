<?php


class page_purchaseinvoice extends Page {

	function init(){
		parent::init();

		$crud = $this->add('CRUD');
		$crud->setModel('PurchaseInvoice');
		$crud->addRef('QSPDetail');

		// $crud->grid->addQuickSearch(['name']);

	}
	
}