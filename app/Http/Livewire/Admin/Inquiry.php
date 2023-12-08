<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Masterlist;
use App\Models\TypeOfCase;
use App\Models\Branch;

class Inquiry extends Component
{
    public $masterlist;
    public $selected_type;
    public $selected_branch;
    public $selected_date;
    public $selected_request;
    public $query;
    public $is_branch = false;
    public $is_date = false;

    public function updatedSelectedRequest()
    {
        if($this->selected_request == 'Branch')
        {
            $this->is_branch = true;
            $this->is_date = false;
        }elseif($this->selected_request == 'Date Filed')
        {
            $this->is_branch = false;
            $this->is_date = true;
        }
        else{
            $this->is_branch = false;
            $this->is_date = false;
        }
    }

    public function generateQuery()
    {
        if($this->selected_type)
        {
            if($this->selected_request)
            {
                switch($this->selected_request)
                {
                    case 'Branch':
                    $this->masterlist = Masterlist::where('branch_id', $this->selected_branch)->get();
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
                    case 'Council of Opposing Party':
                    $this->masterlist = Masterlist::where('type_of_case_id', $this->selected_type)->where('opposing_counsel', 'like', '%'.$this->query.'%')->get();
                    break;
                    case 'Date Filed':
                    $this->masterlist = Masterlist::where('type_of_case_id', $this->selected_type)->whereRaw("DATE(date_filed) = ?", $this->selected_date)->get();
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
            'branches' => Branch::all(),
        ]);
    }
}
