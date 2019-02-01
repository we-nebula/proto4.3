<?php


class page_purchaseinvoice extends Page {

	function init(){
		parent::init();

		$m = $this->add('Model_PurchaseInvoice');
		$m->getElement('invoice_no')->defaultValue($m->newInvoiceNumber());
		$crud = $this->add('CRUD');
		$crud->setModel($m);
		$crud->addRef('QSPDetail');

		

		// $crud->grid->addQuickSearch(['name']);

	}
	
}