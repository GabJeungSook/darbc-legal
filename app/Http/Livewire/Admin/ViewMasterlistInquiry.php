<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class ViewMasterlistInquiry extends Component
{
    use WithFileUploads;
    public $record;

    public function mount($record)
    {
        $this->record = $record;
    }

    public function returnToInquiry()
    {
        return redirect()->route('inquiry');
    }

    public function getFileUrl($filename)
    {
        return Storage::url($filename);
    }

    public function render()
    {
        return view('livewire.admin.view-masterlist-inquiry');
    }
}
