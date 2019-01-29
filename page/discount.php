<?php


class page_discount extends Page {

	function init(){
		parent::init();

		$crud = $this->add('CRUD');
		$crud->setModel('Discount');

		//$crud->grid->addQuickSearch(['code']);

	}
	
}