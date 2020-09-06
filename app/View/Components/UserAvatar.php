<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserAvatar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type;
    public $nameTag;
    public $color;
    public $roleID;

    public function __construct($type,$nameTag,$roleID, $color)
    {
        $this->type = $type;
        $this->nameTag = $nameTag;
        $this->color = $color;
        $this->roleID = $roleID;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.user-avatar');
    }
}
