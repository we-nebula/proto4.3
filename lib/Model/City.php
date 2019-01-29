<?php


class Model_City extends Model_Table {
	public $table = "city";

	public $acl=true;
	public $acl_type = 'City';


	public $status=[
		'Active',
		'InActive',
	];

	public $actions=[
		'Active'=>['view','edit','delete','deactivate'],
		'InActive'=>['view','edit','delete','activate'],
	];

	function init(){
		parent::init();

		$this->hasOne('Employee','created_by_id')->defaultValue($this->app->auth->model->id)->system(true);
		//$this->hasOne('MemberType','membertype_id');
		$this->addField('name');
		$this->addField('status')->enum($this->status)->defaultValue('Active');

		$this->add('dynamic_model/Controller_AutoCreator');

		$this->is([
			'name|to_trim|required'
		]);

	}

	function deactivate(){

		$this['status']='InActive';
		$this->save();
	}

	function activate(){
		$this['status']='Active';
		$this->save();
	}
}