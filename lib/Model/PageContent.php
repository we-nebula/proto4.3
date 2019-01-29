<?php


class Model_PageContent extends Model_Table {
	public $table = "pagecontent";

	public $acl=true;
	public $acl_type = 'PageContent';


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
		$this->addField('name');
		$this->addfield('description')->type('text')->display(['form'=>'RichText']);
		$this->addField('url');
		$this->addField('image')->hint('Add image option');
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