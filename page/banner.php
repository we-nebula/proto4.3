<?php


class page_banner extends Page {

	function init(){
		parent::init();

		$crud = $this->add('CRUD');
		$crud->setModel('Banner');

		//$crud->grid->addQuickSearch(['name']);

	}
	
}