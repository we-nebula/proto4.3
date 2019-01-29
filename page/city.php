<?php


class page_city extends Page {

	function init(){
		parent::init();

		$crud = $this->add('CRUD');
		$crud->setModel('City');

		// $crud->grid->addQuickSearch(['name']);

	}
	
}