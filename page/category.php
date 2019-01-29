<?php


class page_category extends Page {

	function init(){
		parent::init();

		$crud = $this->add('CRUD');
		$crud->setModel('Category');

		// $crud->grid->addQuickSearch(['name']);

	}
	
}