<?php


class page_coupon extends Page {

	function init(){
		parent::init();

		$crud = $this->add('CRUD');
		$crud->setModel('Coupon');

		$crud->grid->addQuickSearch(['code']);

	}
	
}