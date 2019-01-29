<?php


class page_vendor extends Page {

	function init(){
		parent::init();

		$crud = $this->add('CRUD');
		$crud->setModel('Vendor');

		// $crud->grid->addQuickSearch(['name']);

	}
	
}