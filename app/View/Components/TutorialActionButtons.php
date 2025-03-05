<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TutorialActionButtons extends Component
{

    public $title;
    public $buttons;
    public $url;
    public $status;
    public $popup;
    public $midnightCrossedSinceUpdate;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = null, $buttons = null, $url = null, $status = null, $popup = null, $midnightCrossedSinceUpdate = null)
    {
        $this->title = $title;
        $this->buttons = $buttons;
        $this->url = $url;
        $this->status = $status;
        $this->popup = $popup;
        $this->midnightCrossedSinceUpdate = $midnightCrossedSinceUpdate;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tutorial-action-buttons');
    }
}
