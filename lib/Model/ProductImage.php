<?php


class Model_ProductImage extends Model_Table {
	public $table = "product_image";

	public $acl=true;
	public $acl_type = 'ProductImage';


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
		$this->hasOne('Product','product_id');
		$this->addField('image')->hint('Add video and image option.');
		$this->addField('imageorder');
		$this->add('filestore/Field_File','file');
		$this->add('filestore/Field_Image','picture');
		$this->addField('status')->enum($this->status)->defaultValue('Active');

		$this->hasMany('ProductImage','product_id');

		$this->is([
			'imageorder|to_trim|int'
		]);
		
		$this->add('dynamic_model/Controller_AutoCreator');

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