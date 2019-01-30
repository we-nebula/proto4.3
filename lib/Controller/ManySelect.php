<?php


class Controller_ManySelect extends AbstractController {
	public $first_model =null;
	public $second_model = null;
	public $association_model=null;
	public $grid_fields=null;
	public $delete_old=true;
	public $first_field_in_association=null;
	public $second_field_in_association=null;

	function init(){
		parent::init();

		$this->association_model->addCondition($this->first_field_in_association,$first_model->id);
		$old_associats = array_column($this->association_model->getRows(), $this->second_field_in_association);

		$form = $this->owner->add('Form');
		$selected_field = $form->addField('Text','selected');
		$selected_field->set(json_encode($old_associats));
		$form->addSubmit('Update');

		$grid = $this->owner->add('Grid');
		$grid->setModel($this->second_model,$this->grid_fields);
		$grid->addSelectable($selected_field);
		$grid->addPaginator(100);

		if($form->isSubmitted()){

			$selected = json_decode($form['selected'],true);
			// remove differences of old_products and selected products

			if($this->delete_old){
				$un_selected = array_merge([0],array_diff($selected, $old_associats));

				$m = $this->association_model->newInstance();
				$m->addCondition($this->first_field_in_association,$first_model->id);
				$m->addCondition($this->second_field_in_association,$un_selected);
				$m->deleteAll();
			}
			

			foreach ($selected as $s) {
				$m = $this->association_model->newInstance();
				$m->addCondition($this->first_field_in_association,$first_model->id);
				$m->addCondition($this->second_field_in_association,$s);
				$m->tryLoadAny();
				if(!$m->loaded()) $m->save();
			}
			
		}
	}
}