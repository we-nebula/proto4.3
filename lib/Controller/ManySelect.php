<?php


class Controller_ManySelect extends AbstractController {
	public $first_model =null;
	public $second_model = null;
	public $association_model=null;
	public $grid_fields=null;
	public $delete_old=true;
	public $first_field_in_association=null;
	public $second_field_in_association=null;
	public $search_fields = null;

	function init(){
		parent::init();

		$this->association_model->addCondition($this->first_field_in_association,$this->first_model->id);
		$old_associats = array_column($this->association_model->getRows(), $this->second_field_in_association);


		$grid = $this->owner->add('Grid');
		$grid->setModel($this->second_model,$this->grid_fields);
		$grid->addPaginator(100);
		$grid->addQuickSearch($this->search_fields);
		
		$form = $this->owner->add('Form');
		$selected_field = $form->addField('hidden','selected');
		$selected_field->set(json_encode($old_associats));
		$form->addSubmit('Update');
		
		$grid->addSelectable($selected_field);

		if($form->isSubmitted()){

			$selected = json_decode($form['selected'],true);
						
			// remove differences of old_products and selected products
			if($this->delete_old){
				$un_selected = array_diff($old_associats, $selected);
				if(count($un_selected)>0){
					$m = $this->association_model->newInstance();
					$m->addCondition($this->first_field_in_association,$this->first_model->id);
					$m->addCondition($this->second_field_in_association,$un_selected);
					$m->deleteAll();
				}
			}
			

			foreach ($selected as $s) {
				$m = $this->association_model->newInstance();
				$m->addCondition($this->first_field_in_association,$this->first_model->id);
				$m->addCondition($this->second_field_in_association,$s);
				$m->tryLoadAny();
				if(!$m->loaded()) $m->save();
			}

			$this->app->page_action_result = $form->js()->reload();
			
		}
	}
}