<?php


class Model_Learn extends Model_Table {
	public $table = "learn";

	public $acl=true;
	public $acl_type = 'Learn';


	public $status=[
		'Active',
		'InActive',
	];

	public $actions=[
		'Active'=>['view','edit','delete','deactivate','goToWork'],
		'InActive'=>['view','edit','delete','activate'],
	];

	function init(){
		parent::init();

		$this->hasOne('Employee','created_by_id')->defaultValue($this->app->auth->model->id)->system(true);
		$this->addField('name');
		$this->addfield('mobileno');
		$this->addfield('email');
		$this->addfield('password')->display(['form' => 'password', 'grid' => 'text']);
		$this->addfield('confirm_password');
		$this->hasOne('City','city_id');
		$this->addField('daily_salary');
        $this->addField('due_payment');
		$this->addField('status')->enum($this->status)->defaultValue('Active');

		$this->add('dynamic_model/Controller_AutoCreator');

		$this->is(['name|to_trim|required'] );
		$this->is(['mobileno|required|int|>10']);
		$this->is(['email|to_trim|required'] );
		$this->is(['email|to_trim|required'] );
		$this->is(['city|required']);
		$this->is(['confirm_password|to_trim|required']);
		$this->is('confirm_password=password');

	}

	function deactivate(){

		$this['status']='InActive';
		$this->save();
	}

	function activate(){
		$this['status']='Active';
		$this->save();
	}
	function goToWork(){
        $this['due_payment'] = $this['due_payment']
            +$this['daily_salary'];
        //return $this;
        $this->save();
    }
}