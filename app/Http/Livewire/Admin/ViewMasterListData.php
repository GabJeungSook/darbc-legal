<?php

namespace App\Http\Livewire\Admin;

use App\Models\Branch;
use App\Models\ExistingCase;
use App\Models\ExistingCaseData;
use Filament\Forms;
use App\Models\Status;
use Livewire\Component;
use App\Models\TypeOfCase;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use WireUi\Traits\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;


class ViewMasterListData extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;
    use WithFileUploads;
    use Actions;
    protected $listeners = [
        'refreshComponent' => '$refresh',
        'closeModal' => 'savedExistingCase',
        'closeUploadFileModal' => 'savedUploadFile'
    ];
    public $record;
    public $update_masterlist = false;
    public $add_subject = false;
    public $add_existing_case_data = false;
    public $update_existing_case_datas = false;
    public $upload_file = false;

    //select
    public $type_of_cases;
    public $branches;
    public $statuses;
    //variables for update
    public $case_code;
    public $case_number;
    public $case_title;
    public $nature_of_case;
    public $type_of_case_id;
    public $legal_counsel;
    public $opposing_counsel;
    public $date_filed;
    public $branch_id;
    public $address;
    public $status_id;
    //update existing case data
    public $case_data;
    public $date_time;
    public $subject_area;
    public $summary_of_case;
    public $petitioners_representative;
    public $executed_by;
    public $status;

    //subject
    public $existing_case;
    //existing case data
    public $existing_case_data;
    public $existing_case_datas;
    public $existing_case_data_delete;
    public $existing_case_data_upload;
    public $subject_delete;



    public function getFileUrl($filename)
    {
        return Storage::url($filename);
    }

    public function download($filePath)
    {
        $path = storage_path("app/public/{$filePath}");

        return response()->download($path);
    }

    public function updatedBranchId()
    {
        $record = Branch::where('id', $this->branch_id)->first();
        $this->address = $record->address;
    }

    public function addExistingCaseData($id)
    {
        $this->existing_case_data = $id;
        $this->add_existing_case_data = true;

    }

    public function savedExistingCase()
    {
        $this->add_subject = false;
        $this->emit('refreshComponent');
        $this->dialog()->success(
            $title = 'Success',
            $description = 'Data successfully saved'
        );
        return redirect()->route('view-masterlist-data', $this->record);
    }

    public function savedUploadFile()
    {
        $this->upload_file = false;
        $this->dialog()->success(
            $title = 'Success',
            $description = 'File successfully uploaded'
        );

        $this->emit('refreshComponent');
        return redirect()->route('view-masterlist-data', $this->record);
    }

    public function showMasterlistData()
    {
        $this->update_masterlist = true;
        $this->case_code = $this->record->case_code;
        $this->case_number = $this->record->case_number;
        $this->case_title = $this->record->case_title;
        $this->nature_of_case = $this->record->case_nature;
        $this->type_of_case_id = $this->record->type_of_case_id;
        $this->legal_counsel = $this->record->legal_counsel;
        $this->opposing_counsel = $this->record->opposing_counsel;
        $this->date_filed = $this->record->date_filed;
        $this->branch_id = $this->record->branch_id;
        $this->address = $this->record->branch->address;
        $this->status_id = $this->record->status_id;
    }

    public function updateMasterlistData()
    {
        DB::beginTransaction();
        $this->record->case_code = $this->case_code;
        $this->record->case_number = $this->case_number;
        $this->record->case_title = $this->case_title;
        $this->record->case_nature = $this->nature_of_case;
        $this->record->type_of_case_id = $this->type_of_case_id;
        $this->record->legal_counsel = $this->legal_counsel;
        $this->record->opposing_counsel = $this->opposing_counsel;
        $this->record->date_filed = $this->date_filed;
        $this->record->branch_id = $this->branch_id;
        $this->record->status_id = $this->status_id;
        $this->record->save();
        DB::commit();
        $this->update_masterlist = false;
        $this->emit('refreshComponent');
        $this->dialog()->success(
            $title = 'Success',
            $description = 'Data successfully updated'
        );
    }

    public function showExistingCaseData($id)
    {

        $data = ExistingCaseData::where('id', $id)->first();
        $this->case_data = $data;
        $this->date_time = $data->date_time;
        $this->subject_area = $data->subject_area;
        $this->summary_of_case = $data->summary_of_case;
        $this->petitioners_representative = $data->petitioners_representative;
        $this->executed_by = $data->executed_by;
        $this->status = $data->status;
        $this->update_existing_case_datas = true;
    }

    public function deleteSubject($id)
    {
        $this->subject_delete = ExistingCase::where('id', $id)->first();
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'icon'        => 'error',
            'description' => 'Delete this subject?',
            'acceptLabel' => 'Yes, delete it',
            'method'      => 'confirmDeleteSubject',
        ]);
    }

    public function confirmDeleteSubject()
    {
        $existing_case_data = ExistingCaseData::where('existing_case_id', $this->subject_delete->id)->get();
        foreach ($existing_case_data as $key => $value) {
            $value->delete();
        }
        $this->subject_delete->delete();
        $this->emit('refreshComponent');
        $this->dialog()->success(
            $title = 'Success',
            $description = 'Subject successfully deleted'
        );
    }

    public function deleteExistingCaseData($id)
    {
        $this->existing_case_data_delete = ExistingCaseData::where('id', $id)->first();
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'icon'        => 'error',
            'description' => 'Delete this data?',
            'acceptLabel' => 'Yes, delete it',
            'method'      => 'confirmDeleteExistingCaseData',
        ]);
    }

    public function confirmDeleteExistingCaseData()
    {
        $this->existing_case_data_delete->delete();
        $this->emit('refreshComponent');
        $this->dialog()->success(
            $title = 'Success',
            $description = 'Data successfully deleted'
        );
    }

    public function updateExistingCaseData()
    {
        DB::beginTransaction();
        $this->case_data->date_time = $this->date_time;
        $this->case_data->subject_area = $this->subject_area;
        $this->case_data->summary_of_case = $this->summary_of_case;
        $this->case_data->petitioners_representative = $this->petitioners_representative;
        $this->case_data->executed_by = $this->executed_by;
        $this->case_data->status = $this->status;
        $this->case_data->save();
        DB::commit();

        $this->update_existing_case_datas = false;
        $this->emit('refreshComponent');
        $this->dialog()->success(
            $title = 'Success',
            $description = 'Data successfully updated'
        );
    }

    public function saveExistingCaseData()
    {
       $existing_case = ExistingCase::where('id', $this->existing_case_data)->first();
       DB::beginTransaction();
       foreach ($this->existing_case_datas as $data_key => $data_value) {
        // $attachmentArray = array_values($data_value['attachment_path']);
        // $attachmentFile = reset($attachmentArray);


        $existing_case->existing_case_datas()->create([
            'existing_case_id' => $existing_case->id,
            'date_time' => $data_value['date_time'],
            'subject_area' => $data_value['subject_area'],
            'summary_of_case' => $data_value['summary_of_case'],
            'petitioners_representative' => $data_value['petitioners_representative'],
            'executed_by' => $data_value['executed_by'],
            'status' => $data_value['status'],

        ]);


    //     if (is_object($attachmentFile) && method_exists($attachmentFile, 'getClientOriginalName')) {
    //     $existing_case->existing_case_datas()->create([
    //         'existing_case_id' => $existing_case->id,
    //         'date_time' => $data_value['date_time'],
    //         'subject_area' => $data_value['subject_area'],
    //         'summary_of_case' => $data_value['summary_of_case'],
    //         'petitioners_representative' => $data_value['petitioners_representative'],
    //         'executed_by' => $data_value['executed_by'],
    //         'status' => $data_value['status'],
    //         'attachment_path' => $attachmentFile->getClientOriginalName(),
    //     ]);
    // }else{
    //     $existing_case->existing_case_datas()->create([
    //         'existing_case_id' => $existing_case->id,
    //         'date_time' => $data_value['date_time'],
    //         'subject_area' => $data_value['subject_area'],
    //         'summary_of_case' => $data_value['summary_of_case'],
    //         'petitioners_representative' => $data_value['petitioners_representative'],
    //         'executed_by' => $data_value['executed_by'],
    //         'status' => $data_value['status'],

    //     ]);
    // }
        DB::commit();
        $this->add_existing_case_data = false;
        $this->emit('refreshComponent');
        $this->dialog()->success(
            $title = 'Success',
            $description = 'Data successfully saved'
        );
    }
    }

    public function returnToDashboard()
    {
        return redirect()->route('masterlist');
    }

    public function uploadFileModal($id)
    {
        $this->existing_case_data_upload = ExistingCaseData::where('id', $id)->first();
        $this->upload_file = true;
    }

    protected function getFormSchema(): array
    {
        return [
            TableRepeater::make('existing_case_datas')
            ->label('')
            ->createItemButtonLabel('Add row')
            ->schema([
                Forms\Components\DatePicker::make('date_time')
                ->required()
                ->disableLabel(),
                TextInput::make('subject_area')
               // ->required()
                ->disableLabel(),
                TextInput::make('summary_of_case')
                //->required()
                ->disableLabel(),
                TextInput::make('petitioners_representative')
                ->label('Petitioners / Representatives')
               // ->required()
                ->disableLabel(),
                TextInput::make('executed_by')
               // ->required()
                ->disableLabel(),
                TextInput::make('status')
              //  ->required()
                ->disableLabel(),
                // FileUpload::make('attachment_path')
                // ->label('Attachment')
                // ->preserveFilenames()
                // ->disableLabel(),
            ])
            ->columnSpan('full')
        ];
    }

    public function mount()
    {
        $this->form->fill();
        $this->type_of_cases = TypeOfCase::get();
        $this->branches = Branch::get();
        $this->statuses = Status::get();
    }

    public function render()
    {
        return view('livewire.admin.view-master-list-data');
    }
}
