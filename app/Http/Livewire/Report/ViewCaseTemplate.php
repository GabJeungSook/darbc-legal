<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;

class ViewCaseTemplate extends Component
{
    public $record;

    public function returnToCaseTemplate()
    {
        return redirect()->route('reports');
    }
    public function render()
    {
        return view('livewire.report.view-case-template');
    }
}
