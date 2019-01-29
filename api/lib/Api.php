<?php

class Api extends App_REST {

    function init() {
        parent::init();
        
         $app_paths = array('vendor','shared/addons2','shared/addons');

         $this->api->pathfinder
            ->addLocation(array(
                'addons' => $app_paths,
                'css' => ['templates'],
            ))
            ->setBasePath($this->pathfinder->base_location->getPath().'/..');
        $this->dbConnect();

        $this->add('Controller_PatternRouter')
            ->link('v1/contact',array('id','method','arg1','arg2'))
            ->route();
    }

}