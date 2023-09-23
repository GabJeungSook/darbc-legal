<?php

namespace App\Http\Livewire\Admin\Forms;

use Livewire\Component;

class AddExistingCaseData extends Component
{
    public $record;


    public function render()
    {
        return view('livewire.admin.forms.add-existing-case-data');
    }
}
