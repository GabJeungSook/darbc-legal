<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Masterlist;
use App\Models\TypeOfCase;

class Inquiry extends Component
{
    public $masterlist;
    public $selected_type;
    public $selected_request;
    public $query;

    public function generateQuery()
    {
        if($this->selected_type)
        {
            if($this->selected_request)
            {
                switch($this->selected_request)
                {
                    case 'Branch':
                    $this->masterlist = Masterlist::where('type_of_case_id', $this->selected_type)->whereHas('branch', function($q){
                        $q->where('name', 'like', '%'.$this->query.'%');
                    })->get();
                    break;
                    case 'Address':
                    $this->masterlist = Masterlist::where('type_of_case_id', $this->selected_type)->where('address', 'like', '%'.$this->query.'%')->get();
                    break;
                    case 'Case Code':
                    $this->masterlist = Masterlist::where('type_of_case_id', $this->selected_type)->where('case_code', 'like', '%'.$this->query.'%')->get();
                    break;
                    case 'Case Number':
                    $this->masterlist = Masterlist::where('type_of_case_id', $this->selected_type)->where('case_number', 'like', '%'.$this->query.'%')->get();
                    break;
                    case 'Case Title':
                    $this->masterlist = Masterlist::where('type_of_case_id', $this->selected_type)->where('case_title', 'like', '%'.$this->query.'%')->get();
                    break;
                    case 'Nature of Case':
                    $this->masterlist = Masterlist::where('type_of_case_id', $this->selected_type)->where('case_nature', 'like', '%'.$this->query.'%')->get();
                    break;
                    case 'Legal Council':
                    $this->masterlist = Masterlist::where('type_of_case_id', $this->selected_type)->where('legal_counsel', 'like', '%'.$this->query.'%')->get();
                    break;
                }
            }else{
                $this->masterlist = Masterlist::where('type_of_case_id', $this->selected_type)->get();
            }
        }else{
            $this->masterlist = Masterlist::all();
        }
    }
    public function mount()
    {
        $this->masterlist = Masterlist::all();
    }
    public function render()
    {
        return view('livewire.admin.inquiry',
        [
            'types' => TypeOfCase::all(),
        ]);
    }
}
