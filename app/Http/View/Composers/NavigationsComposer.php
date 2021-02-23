<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Category;
use App\Models\Action;

class NavigationsComposer {
    public $toolbar = [];
    public $sidebar = [];

    public function __construct() {
        if(auth()->user()) {
            $user = auth()->user();
            $this->toolbar = Action::where('location', 'toolbar')
                ->where('is_visible', true)
                ->where('is_component', false)
                ->whereHas('profiles', function($query) use ($user) {
                    $query->where('action_profile.profile_id', $user->profile_id);
                })
                ->orderBy('order', 'ASC')
                ->get();

            $this->sidebar = Action::where('location', 'sidebar')
                ->where('is_visible', true)
                ->where('is_component', false)
                ->whereHas('profiles', function($query) use ($user) {
                    $query->where('action_profile.profile_id', $user->profile_id);
                })
                ->orderBy('order', 'ASC')
                ->get();
        }
    }

    public function compose(View $view) {
        $view->with('toolbar', $this->toolbar)->with('sidebar', $this->sidebar);
    }
}