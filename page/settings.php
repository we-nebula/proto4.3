<?php


class page_settings extends Page {

	function init(){
		parent::init();

		$tabs = $this->add('Tabs');
			$mem_tab = $tabs->addTab('Member');

				$mem_tabs = $mem_tab->add('Tabs');
					$mem_type_tab = $mem_tabs->addTab('Member Types');
					$c= $mem_type_tab->add('CRUD');
					$c->setModel('MemberType');

			$prod_tab = $tabs->addTab('Products');
				$prod_tabs = $prod_tab->add('Tabs');
					$attrib_tab = $prod_tabs->addTab('Attributes');
						$c= $attrib_tab->add('CRUD');
						$c->setModel('Attribute');
					$attrib_set_tab = $prod_tabs->addTab('Attributes SET');
						$c= $attrib_set_tab->add('CRUD');
						$c->setModel('AttributeSET');
						$c->addRef('SETAttributes');
						// $c = $varient_set_tab->add('CRUD');
						// $c->setModel('VariantSET');

	}
	
}