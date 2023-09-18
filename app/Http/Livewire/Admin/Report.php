<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Report extends Component
{
    public $report_get;
    public function render()
    {
        return view('livewire.admin.report');
    }
}
