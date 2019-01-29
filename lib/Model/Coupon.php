<?php


class Model_Coupon extends Model_Table {
	public $table = "coupon";

	public $acl=true;
	public $acl_type = 'Coupon';


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
		$this->addField('for_member_only')->type('boolean')->defaultValue(true);

		$this->addField('code');
		$this->addField('type')->enum(['Fixed','Percentage']);
		$this->addField('amount');
		$this->addField('startdate')->type('date');
		$this->addField('enddate')->type('date');
		$this->addField('used');
		$this->addField('shipping');
		$this->addField('status')->enum($this->status)->defaultValue('Active');

		$this->add('dynamic_model/Controller_AutoCreator');

		$this->is([
			'code|to_trim|required',
			'amount|required|int',
			'used|int'
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