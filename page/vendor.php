<?php


class page_vendor extends Page {

	function init(){
		parent::init();

		$crud = $this->add('CRUD');
		$crud->setModel('Vendor');

		//$crud->add('Grid')->setModel('Vendor',array('name','description','status'));
		//$crud->grid->addQuickSearch( [ 'name' ,'address' ] );
		//$crud->grid->addPaginator(2);
	}
	
}