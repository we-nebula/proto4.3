<?php
class Model_Wallet extends Model_Table {
	public $table = "wallet";
	public $acl=true;
	public $acl_type = 'Wallet';
	public $status=[
		'Active',
		'InActive',
	];

	public $actions=[
		'Active'=>['view','edit','delete','deactivate'],
		'InActive'=>['view','edit','delete','activate']
	];

	function init(){
		parent::init();

		$this->hasOne('Employee','created_by_id')->defaultValue($this->app->auth->model->id)->system(true);
		$this->hasOne('AppUser','user_id');
		
		$this->addField('type')->enum(['Earned','Purchased']);
		$this->addField('point');
		$this->addfield('description')->type('text')->display(['form'=>'RichText']);
		$this->addField('status')->enum($this->status)->defaultValue('Active');

		$this->add('dynamic_model/Controller_AutoCreator');

		$this->is([
			'user_id|to_trim|required',
			'point|to_trim|required|int',
			'type|to_trim|required'
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