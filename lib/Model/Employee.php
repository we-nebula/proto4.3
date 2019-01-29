<?php


class Model_Employee extends Model_Table {
	public $table ='employee';

	function init(){
		parent::init();

		$this->hasOne('Post','post_id');
		$this->addField('name');
		$this->addField('username');
		$this->addField('password');
		$this->addField('joined_on')->type('datetime');
		$this->addField('scope')->enum(['SuperUser','Admin']);

		$this->add('dynamic_model/Controller_AutoCreator');
	}

	function isSuperUser(){
		return $this['scope']=='SuperUser';
	}
}