<?php


class page_pagecontent extends Page {

	function init(){
		parent::init();

		$crud = $this->add('CRUD');
		$crud->setModel('PageContent');

		$crud->grid->addQuickSearch(['name']);

	}
	
}