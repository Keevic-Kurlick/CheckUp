<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ShowError extends Component
{
    /** @var string */
    private string $fieldName;

    /**
     * @return void
     */
    public function __construct(string $fieldName)
    {
        $this->fieldName = $fieldName;
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.show-error',
            [
                'fieldName' => $this->fieldName,
            ]);
    }
}
