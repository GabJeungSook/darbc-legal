<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class ViewMasterListData extends Component
{
    public $record;
    public function render()
    {
        return view('livewire.admin.view-master-list-data');
    }
}
