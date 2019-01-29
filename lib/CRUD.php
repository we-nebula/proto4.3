<?php


class CRUD extends View_CRUD {

	public $status_color = [];
	public $grid_class='Grid';
	public $permissive_acl = false;
	public $actionsWithoutACL = false;
	public $show_spot_acl = true;
	public $add_actions = true;

	public $acl_controller=null;
	public $pass_acl = false;


	protected function configureAdd($fields){
		if($this->add_button)
			$this->add_button->addClass(' btn btn-primary pull-right');
		if(isset($this->action_page)){
			$this->add_button->setHTML('<i class="icon-plus"></i> Add '.htmlspecialchars($this->entity_name));
			$this->add_button->js('click')->univ()->location($this->api->url($this->action_page,['action'=>'add']));
		}else
			parent::configureAdd($fields);
	}

	protected function configureEdit($fields){
		if(isset($this->action_page) || isset($this->edit_page)){
			$this->grid->addColumn('template','edit')->setTemplate(' ');
			$this->grid->on('click','.pb_edit')->univ()->location(
				[
					$this->api->url($this->edit_page?:$this->action_page),
					[
						'action'=>'edit',
						$this->model->table.'_id'=>$this->js()->_selectorThis()->closest('[data-id]')->data('id')
					]
				]
			);
		}else{
			parent::configureEdit($fields);
		}
	}


	function setModel($model,$grid_fields=null,$form_fields=null){

		$m = parent::setModel($model,$grid_fields,$form_fields);
		
		if(($m instanceof \Model) && !$this->pass_acl){
			if($this->actionsWithoutACL || isset($this->app->actionsWithoutACL)){
				$this->acl_controller = $this->add('Controller_Action',['status_color'=>$this->status_color,'permissive_acl'=>$this->permissive_acl,'show_spot_acl'=>$this->show_spot_acl,'actionsWithoutACL'=>$this->actionsWithoutACL]);
			}else{
				$this->acl_controller = $this->add('Controller_ACL',['status_color'=>$this->status_color,'permissive_acl'=>$this->permissive_acl,'show_spot_acl'=>$this->show_spot_acl,'actionsWithoutACL'=>$this->actionsWithoutACL,'add_actions'=>$this->add_actions]);
			}
		}
		return $m;
	}

	function recursiveRender(){
		if($this->grid->hasColumn('edit')){
			$this->grid->addOrder()->move('edit','before','delete')->now();
		}
		return parent::recursiveRender();
	}
}