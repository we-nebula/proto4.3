<?php


class Model_Department extends Model_Table {
	public $table = "department";

	function init(){
		parent::init();

		$this->addField('name');

		$this->hasMany('Post','department_id');

		$this->add('dynamic_model/Controller_AutoCreator');

	}
}