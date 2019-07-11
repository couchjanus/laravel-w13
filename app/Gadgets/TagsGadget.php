<?php 
namespace App\Gadgets;

use App\Gadgets\Contracts\GadgetContract;
use App\Tag;

class TagsGadget implements GadgetContract 
{
    public function execute() 
    {
        $data = Tag::all();
        return $data;
    }
}
