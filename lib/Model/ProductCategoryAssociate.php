<?php


class Model_ProductCategoryAssociate extends Model_Table {
	public $table = "product_category_associate";

	public $acl=true;
	public $acl_type = 'ProductCategoryAssociate';


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
		$this->hasOne('Category','category_id');
		$this->hasOne('Product','product_id')->hint('Todo many');
		$this->addField('status')->enum($this->status)->defaultValue('Active');

		$this->hasMany('ProductCategoryAssociate','product_id');
		$this->hasMany('ProductCategoryAssociate','category_id');
		
		$this->add('dynamic_model/Controller_AutoCreator');

		/*$this->is([
			'name|to_trim|required'
		]);*/

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