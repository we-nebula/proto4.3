<?php


class Model_Banner extends Model_Table {
	public $table = "banner";

	public $acl=true;
	public $acl_type = 'Banner';


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
		$this->addField('bannertype')->enum(['Video','Image']);
		$this->addField('displayon')->setValueList(['Homepage','Category','Product']);
		$this->addField('image')->hint('Add image option, when banner type is image');
		$this->addField('video')->hint('Add video option, when banner type is video');
		$this->addfield('alt');
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