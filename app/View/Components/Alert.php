<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * @var string
     */
    public $message;

    /**
     * @var string|null
     */
    public $type;

    /**
     * @var bool
     */
    public $dismissible;

    /**
     * @var bool
     */
    public $refreshable;

    /**
     * Alert constructor.
     * @param string $message
     * @param string|null $type
     * @param bool $refreshable
     * @param bool $dismissible
     */
    public function __construct(string $message, string $type = null, bool $refreshable = false, bool $dismissible = false)
    {
        $this->message = $message;
        $this->type = $type;
        $this->refreshable = $refreshable;
        $this->dismissible = $dismissible;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.alert', [
            'message'     => $this->message,
            'type'        => $this->type,
            'refreshable' => $this->refreshable,
            'dismissible' => $this->dismissible
        ]);
    }
}
