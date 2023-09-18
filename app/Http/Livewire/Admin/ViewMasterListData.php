<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class ViewMasterListData extends Component
{
    use WithFileUploads;
    public $record;

    public function getFileUrl($filename)
    {
        return Storage::url($filename);
    }

    public function render()
    {
        return view('livewire.admin.view-master-list-data');
    }
}
