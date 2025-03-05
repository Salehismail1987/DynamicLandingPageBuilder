<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ActionButtons extends Component
{
    public $saveText;
    public $resetText;
    public $frontSections;
    public $customClass;
    public $buttonName;
    public $customForms;
    public $addresses;
    public $slug;
    public $allButtons;
    public $featureSlug;

    /**
     * Create a new component instance.
     *
     * @param string $saveText
     * @param string $resetText
     * @param string|null $customClass
     */
    public function __construct($saveText = 'Save', $featureSlug = null, $resetText = 'Reset', $frontSections = null, $buttonName = null, $customForms = null, $addresses = null, $slug = null, $allButtons = null, $customClass = null)
    {
        $this->saveText = $saveText;
        $this->resetText = $resetText;
        $this->frontSections = $frontSections;
        $this->customClass = $customClass;
        $this->buttonName = $buttonName;
        $this->customForms = $customForms;
        $this->addresses = $addresses;
        $this->slug = $slug;
        $this->allButtons = $allButtons;
        $this->featureSlug = $featureSlug;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.action-buttons');
    }
}
