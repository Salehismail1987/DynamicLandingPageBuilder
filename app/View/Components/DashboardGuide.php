<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DashboardGuide extends Component
{

    public $buttons;
    public $audio_div;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($buttons = null, $audio_div=null)
    {
        $this->buttons = $buttons;
        $this->audio_div = $audio_div;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard-guide');
    }
}
