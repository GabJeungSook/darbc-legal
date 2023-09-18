<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Masterlist;

class Report extends Component
{
    public $report_get;
    public function render()
    {
        return view('livewire.admin.report', [
            'masterlists' => Masterlist::get(),
        ]);
    }
}
