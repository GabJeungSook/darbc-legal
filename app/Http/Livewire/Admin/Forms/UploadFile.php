<?php

namespace App\Http\Livewire\Admin\Forms;

use Filament\Forms;
use Livewire\Component;
use App\Models\ExistingCaseData;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\FileUpload;

class UploadFile extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;
    public $record;
    public $data;

    protected function getFormSchema(): array
    {
        return [
            FileUpload::make('attachment_paths')
            ->label('Attachment')->preserveFilenames()
            ->afterStateUpdated(function (FileUpload $component) {
                $component->saveUploadedFiles($component);
                $this->saveFileUpload();
      })
            ->disableLabel(),

        ];
    }

    protected function getFormStatePath(): string
    {
        return 'data';
    }

    public function saveFileUpload()
    {
        $attachmentArray = array_values($this->data['attachment_paths']);
        $attachmentFile = reset($attachmentArray);
        // $livewireTmpPath = 'livewire-tmp/';

        // dd($attachmentFile);

        //  dd($this->data['attachment_path']);

        $this->record->update([
            'attachment_path' => $attachmentFile,
        ]);
        $this->emit('closeUploadFileModal');
    }

    public function mount($record)
    {
        $this->record = $record;
        $this->form->fill();
    }


    public function render()
    {
        return view('livewire.admin.forms.upload-file');
    }
}
