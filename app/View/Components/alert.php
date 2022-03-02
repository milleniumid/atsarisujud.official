<?php

namespace App\View\Components;

use Illuminate\View\Component;
use View;

class alert extends Component
{
    /**
     * Tittle of the alert.
     * 
     * @param string $title
     */
    public $title;

    /**
     * The priority alert type is "info".
     * 
     * @var string
     */
    public $type;

    /**
     * The icon of the alert.
     * 
     * @var string
     */
    public $icon;

    /**
     * The message or an array of messages to present to the user.
     * 
     * @var string
     */
    public $message;

    /**
     * Create a new component instance.
     *
     * @return void
     * @param string $type
     *  - success
     *  - danger
     *  - warning
     *  - info
     * @param mixed $message
     */
    public function __construct($title = 'Upsy', $type = 'warning', $icon = '', $message = '')
    {
        
        // Default icon path
        $this->title = $title;
        $this->type = ($type != '') ? $type : 'warning';
        $this->icon = $this->setIcon($type, $icon);
        $this->message = $message;
    }

    /**
     * Set the icon of the alert.
     */
    public function setIcon($type, $icon)
    {
        $defaultIconPath = 'icons/duotune/general/gen046.svg';

        switch ($type) {
            case 'success':
                $this->icon = 'icons/duotune/general/gen043.svg';
                break;
            case 'error':
                $this->icon = 'icons/duotune/general/gen040.svg';
                break;
            case 'warning':
                $this->icon = 'icons/duotune/general/gen044.svg';
                break;
            case 'info':
                $this->icon = 'icons/duotune/general/gen007.svg';
                break;
            default:
                $this->icon = $defaultIconPath;
                break;
        }
        return $this->icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
