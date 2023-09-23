<?php

namespace App\Http\Livewire\Admin\Forms;

use App\Models\ExistingCase;
use App\Models\Masterlist;
use Livewire\Component;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;

class AddSubject extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;
    public $record;
    public $existing_cases;
    public $existing_case_datas;

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Repeater::make('existing_cases')
            ->createItemButtonLabel('Add Subject')
            ->schema([
                Forms\Components\TextInput::make('subject')->required(),
                TableRepeater::make('existing_case_datas')
                // ->relationship()
                ->label('')
                ->createItemButtonLabel('Add row')
                ->schema([
                    Forms\Components\DatePicker::make('date_time')
                    ->required()
                    ->disableLabel(),
                    TextInput::make('subject_area')
                    ->required()
                    ->disableLabel(),
                    TextInput::make('summary_of_case')
                    ->required()
                    ->disableLabel(),
                    TextInput::make('petitioners_representative')
                    ->label('Petitioners / Representatives')
                    ->required()
                    ->disableLabel(),
                    TextInput::make('executed_by')
                    ->required()
                    ->disableLabel(),
                    TextInput::make('status')
                    ->required()
                    ->disableLabel(),
                    FileUpload::make('attachment_path')
                    ->label('Attachment')
                    ->required()
                    ->preserveFilenames()
                    ->disableLabel(),
                ])
                ->columnSpan('full')
        ])
        ];
    }

    public function saveExistingCaseData()
    {
        foreach ($this->existing_cases as $key => $value) {
            $existing_case = ExistingCase::create([
                'masterlist_id' => $this->record->id,
                'subject' => $value['subject']
            ]);

            foreach ($value['existing_case_datas'] as $data_key => $data_value) {
                $attachmentArray = array_values($data_value['attachment_path']);
                $attachmentFile = reset($attachmentArray);

                $existing_case->existing_case_datas()->create([
                    'existing_case_id' => $existing_case->id,
                    'date_time' => $data_value['date_time'],
                    'subject_area' => $data_value['subject_area'],
                    'summary_of_case' => $data_value['summary_of_case'],
                    'petitioners_representative' => $data_value['petitioners_representative'],
                    'executed_by' => $data_value['executed_by'],
                    'status' => $data_value['status'],
                    'attachment_path' => $attachmentFile->getClientOriginalName(),
                ]);

            }
        }
        $this->emit('closeModal');
    }

    public function mount()
    {
        $record = Masterlist::find($this->record);
        $this->form->fill();
        // $this->existing_cases = $record->existing_cases;
    }

    public function render()
    {
        return view('livewire.admin.forms.add-subject');
    }
}
