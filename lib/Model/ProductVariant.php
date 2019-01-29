<?php


class Model_ProductVariant extends Model_Table {
	public $table = "product_variant";

	public $acl=true;
	public $acl_type = 'ProductVariant';


	public $status=[
		'Active',
		'InActive',
	];

	public $actions=[
		'Active'=>['view','edit','delete','deactivate','pricing'],
		'InActive'=>['view','edit','delete','activate'],
	];

	function init(){
		parent::init();

		$this->hasOne('Employee','created_by_id')->defaultValue($this->app->auth->model->id)->system(true);
		$this->hasOne('Product','product_id');
		$this->hasOne('Attribute','attribute_id');
		$this->addField('description')->type('text')->display(['form'=>'RichText']);

		$this->addField('status')->enum($this->status)->defaultValue('Active');

		$this->hasMany('ProductVariant','attribute_id');
		$this->hasMany('ProductVariant','product_id');
		
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

	function page_pricing($p){
		$m= $this->add('Model_ProductVariantPricing');
		$m->addCondition('product_id',$this->id);

		$c = $p->add('CRUD');
		$c->setModel($m);
	}
}