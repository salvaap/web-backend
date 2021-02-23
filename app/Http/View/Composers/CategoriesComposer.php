<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Category;

class CategoriesComposer {
    public $categories = [];

    public function __construct() {
        $this->categories = Category::where('parent_id', null)->get()->toArray();
    }

    public function compose(View $view) {
        $view->with('categories', $this->categories);
    }
}