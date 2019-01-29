<?php


class Model_Point extends Model_Table {
	public $table = "point";

	public $acl=true;
	public $acl_type = 'Point';


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
		$this->addField('currency')->hint('default currency');
		$this->addField('amount')->hint('Allow float val');
		$this->addField('to_convert_point');
		$this->addField('status')->enum($this->status)->defaultValue('Active');

		$this->add('dynamic_model/Controller_AutoCreator');

		$this->is([
			'currency|to_trim|required',
			'amount|to_trim|required|int',
			'to_convert_point|to_trim|required|int'
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