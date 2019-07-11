<?php

namespace App\Gadgets;

class Gadget
{
    protected $gadgets;

	public function __construct($gadgets)
	{
		$this->gadgets = $gadgets;
    }

	public function show($obj, $data =[])
	{
		if(isset($this->gadgets[$obj])){
			$obj = new $this->gadgets[$obj]($data);
			return $obj->execute();
		}
	}

}
