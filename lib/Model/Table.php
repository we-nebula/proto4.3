<?php


class Model_Table extends SQL_Model {

	public $acl = false;
	public $namespace ='\\';
	public $acl_type=null;

	function init(){
		parent::init();
		$this->add('Controller_Validator');
	}
}