<?php

namespace App\Gadgets;

use App\Gadgets\Contracts\GadgetContract;
use App\Category;

class CategoriesGadget implements GadgetContract
{
    public function execute()
    {
        $categories = \App\Category::withCount(
            [
                'posts' => function($query) { 
                    $query->where('status', 2);
                }
            ])->find(\App\Post::where('status',2)->get('category_id'));

        return view('gadgets::categories', [
            'data' => $categories
            ]
        );
    }
}
