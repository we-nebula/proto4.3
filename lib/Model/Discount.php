<?php


class Model_Discount extends Model_Table {
	public $table = "discount";

	public $acl=true;
	public $acl_type = 'Discount';


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
		$this->hasOne('Category','category_id')->hint('TODO MANY');
		$this->hasOne('Product','product_id')->hint('TODO MANY');
		$this->hasOne('MemberType','membertype_id')->hint('TODO MANY');
		$this->addField('Member')->enum(['Member','Non-member']);

		$this->addField('type')->enum(['Fixed','Percentage']);
		$this->addField('discount');
		$this->addField('startdate')->type('date');
		$this->addField('enddate')->type('date');
		$this->addField('status')->enum($this->status)->defaultValue('Active');

		$this->add('dynamic_model/Controller_AutoCreator');

		$this->is([
			'type|required',
			'discount|to_trim|required|int'
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