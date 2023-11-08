<?php

namespace App\Http\Livewire\Admin;

use DB;
use Filament\Forms;
use Filament\Tables;
use App\Models\Branch;
use App\Models\Status;
use Livewire\Component;
use App\Models\TypeOfCase;
use WireUi\Traits\Actions;
use App\Models\ExistingCase;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Fieldset;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\CreateAction;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Masterlist as MasterlistModel;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;

class Masterlist extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Actions;


    protected function getTableQuery(): Builder
    {
        return MasterlistModel::query();
    }

    protected function getTableHeaderActions(): array
    {
        return [
            CreateAction::make('save')
            ->disableCreateAnother()
            ->modalHeading('Add new')
            ->modalButton('Save')
            ->before(function (array $data, CreateAction $action) {

                //dd($data);
                $caseCodeExists = MasterlistModel::where('case_code', $data['case_code'])->exists();
                $caseNumberExists = MasterlistModel::where('case_number', $data['case_number'])->exists();
                if ($caseCodeExists || $caseNumberExists) {
                    $this->dialog()->warning(
                        $title = 'Warning',
                        $description = 'Case Code or Case Number already exists'
                    );
                    return $action->halt();
                }
            })
            ->after(function () {
                //refresh page
                return redirect()->route('masterlist');
                Notification::make()
                ->title('Saved successfully')
                ->success()
                ->send();
            })
            ->label('Add New')
            ->button()
            ->color('primary')
            ->icon('heroicon-o-plus')
            ->form([
                Grid::make(2)
                ->schema([
                    Forms\Components\TextInput::make('case_code')->label("Case Code")
                    ->required(),
                    Forms\Components\TextInput::make('case_number')->label("Case Number")
                    ->required(),
                    Forms\Components\TextInput::make('case_title')->label("Case Title")
                    ->required(),
                    Forms\Components\TextInput::make('case_nature')->label("Nature Of Case")
                    ->required(),
                    Forms\Components\Select::make('branch_id')->label("Branch")
                        ->options(Branch::pluck('name', 'id'))
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(function ($set, $state) {
                            $address = Branch::find($state)->address;
                            $set('address', $address);
                        }),
                        Forms\Components\TextInput::make('address')->disabled(),
                        Forms\Components\Select::make('type_of_case_id')->label("Type Of Case")
                        ->options(TypeOfCase::pluck('name', 'id'))
                        ->required(),
                        Forms\Components\Select::make('status_id')->label("Status")
                        ->options(Status::pluck('name', 'id'))
                        ->required(),
                        Forms\Components\TextInput::make('legal_counsel')->label("Legal Counsel")
                        ->required(),
                        Forms\Components\TextInput::make('opposing_counsel')->label("Counsel of Opposing Party")
                        ->required(),

                    ]),
                    Forms\Components\DatePicker::make('date_filed')->label("Date Filed")
                    ->required(),
                    Forms\Components\Repeater::make('existing_cases')
                    ->relationship()
                    ->schema([
                        Forms\Components\TextInput::make('subject')->required(),
                        TableRepeater::make('existing_case_datas')
                        ->relationship()
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
                // Forms\Components\Select::make('type_of_case_id')->label("Type Of Case")
                // ->options(TypeOfCase::pluck('name', 'id'))
                // ->required(),
                // Grid::make(2)
                // ->schema([
                //     Forms\Components\TextInput::make('legal_counsel')->label("Legal Counsel")
                //     ->required(),
                //     Forms\Components\TextInput::make('opposing_counsel')->label("Counsel of Opposing Party")
                //     ->required(),
                // ]),
                // Grid::make(2)
                // ->schema([
                //     Forms\Components\Select::make('branch_id')->label("Branch")
                //     ->options(Branch::pluck('name', 'id'))
                //     ->required()
                //     ->reactive()
                //     ->afterStateUpdated(function ($set, $state) {
                //         $address = Branch::find($state)->address;
                //         $set('address', $address);
                //     }),
                //     Forms\Components\TextInput::make('address')->disabled(),
                // ]),
                // Grid::make(2)
                // ->schema([
                //     Forms\Components\Select::make('status_id')->label("Status")
                //     ->options(Status::pluck('name', 'id'))
                //     ->required(),
                //     Forms\Components\DatePicker::make('date_filed')->label("Date Filed")
                //     ->required(),
                // ]),
                // Forms\Components\Repeater::make('existing_cases')
                // ->relationship()
                // ->schema([
                //     Forms\Components\TextInput::make('subject')->required(),
                //     // TableRepeater::make('other_data')
                //     // ->label('')
                //     // ->createItemButtonLabel('Add row')
                //     // ->schema([
                //     //     Forms\Components\DatePicker::make('date_time')
                //     //     ->required()
                //     //     ->disableLabel(),
                //     //     TextInput::make('subject_area')
                //     //     ->required()
                //     //     ->disableLabel(),
                //     //     TextInput::make('summary_of_case')
                //     //     ->required()
                //     //     ->disableLabel(),
                //     //     TextInput::make('petitioners_representative')
                //     //     ->required()
                //     //     ->disableLabel(),
                //     //     TextInput::make('executed_by')
                //     //     ->required()
                //     //     ->disableLabel(),
                //     //     TextInput::make('status')
                //     //     ->required()
                //     //     ->disableLabel(),
                //     //     FileUpload::make('attachment')
                //     //     ->required()
                //     //     ->preserveFilenames()
                //     //     ->disableLabel(),
                //     // ])
                //     // ->columnSpan('full')
                // ])

            ])->modalWidth('7xl')
        ];
    }

    protected function getTableActions()
    {
        return [
            Action::make('view')
            ->button()
            ->outlined()
            ->icon('heroicon-o-eye')
            ->color('primary')
            ->url(fn (MasterListModel $record): string => route('view-masterlist-data', $record)),
            EditAction::make('edit')
            ->icon('heroicon-o-pencil')
            ->label('Update')
            ->button()
            ->outlined()
            ->color('success')
            ->visible(false)
            // ->mountUsing(fn (Forms\ComponentContainer $form, MasterlistModel $record) => $form->fill([
            //     'type_of_case_id' => $record->type_of_case_id,
            //     'branch_id' => $record->branch_id,
            //     'address' => $record->branch->address,
            //     'status_id' => $record->status_id,
            //     'case_code' => $record->case_code,
            //     'case_number' => $record->case_number,
            //     'case_title' => $record->case_title,
            //     'case_nature' => $record->case_nature,
            //     'legal_counsel' => $record->legal_counsel,
            //     'opposing_counsel' => $record->opposing_counsel,
            //     'date_filed' => $record->date_filed,
            //     'case' => $record->existing_cases->map(function (ExistingCase $case) {
            //         return [
            //             'subject' => $case->subject,
            //             'other_data' => json_decode($case->other_data, true),
            //         ];
            //     })->toArray(),
            // ]))
            // ->action(function (MasterlistModel $record, array $data): void {
            //     DB::beginTransaction();
            //     $record->type_of_case_id = $data['type_of_case_id'];
            //     $record->branch_id = $data['branch_id'];
            //     $record->status_id = $data['status_id'];
            //     $record->case_code = $data['case_code'];
            //     $record->case_number = $data['case_number'];
            //     $record->case_title = $data['case_title'];
            //     $record->case_nature = $data['case_nature'];
            //     $record->legal_counsel = $data['legal_counsel'];
            //     $record->opposing_counsel = $data['opposing_counsel'];
            //     $record->date_filed = $data['date_filed'];
            //     $record->save();

            //     $existingSubjects = ExistingCase::where('masterlist_id', $record->id)
            //     ->pluck('subject')
            //     ->toArray();

            // foreach ($data['case'] as $item) {
            //     $existingCase = ExistingCase::where('masterlist_id', $record->id)
            //         ->where('subject', $item['subject'])
            //         ->first();

            //     if ($existingCase) {
            //         // Check if subject or other_data has changed
            //         $subjectChanged = $existingCase->subject !== $item['subject'];
            //         $otherDataChanged = $existingCase->other_data !== json_encode($item['other_data']);

            //         if ($subjectChanged || $otherDataChanged) {
            //             $existingCase->subject = $item['subject'];
            //             $existingCase->other_data = json_encode($item['other_data']);
            //             $existingCase->save();
            //         }
            //     } else {
            //         // Create a new record for a new subject
            //         ExistingCase::create([
            //             'masterlist_id' => $record->id,
            //             'subject' => $item['subject'],
            //             'other_data' => json_encode($item['other_data']),
            //         ]);
            //     }
            // }

            // // Delete ExistingCase records for removed subjects
            // ExistingCase::where('masterlist_id', $record->id)
            //     ->whereNotIn('subject', collect($data['case'])->pluck('subject')->toArray())
            //     ->delete();



            //     DB::commit();
            //     $this->dialog()->success(
            //         $title = 'Success',
            //         $description = 'Updated successfully'
            //     );
            // })
            ->form([
                Grid::make(2)
                ->schema([
                    Forms\Components\TextInput::make('case_code')->label("Case Code")
                    ->required(),
                    Forms\Components\TextInput::make('case_number')->label("Case Number")
                    ->required(),
                    Forms\Components\TextInput::make('case_title')->label("Case Title")
                    ->required(),
                    Forms\Components\TextInput::make('case_nature')->label("Nature Of Case")
                    ->required(),
                      Forms\Components\Select::make('type_of_case_id')->label("Type Of Case")
                ->options(TypeOfCase::pluck('name', 'id'))
                ->required(),

                Forms\Components\Select::make('branch_id')->label("Branch")
                    ->options(Branch::pluck('name', 'id'))
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($set, $state) {
                        $address = Branch::find($state)->address;
                        $set('address', $address);
                    }),
                ]),
                Forms\Components\Select::make('status_id')->label("Status")
                    ->options(Status::pluck('name', 'id'))
                    ->required(),
                    Forms\Components\TextInput::make('legal_counsel')->label("Legal Counsel")
                        ->required(),
                        Forms\Components\TextInput::make('opposing_counsel')->label("Counsel of Opposing Party")
                        ->required(),
                    Forms\Components\DatePicker::make('date_filed')->label("Date Filed")
                    ->required(),
                     Forms\Components\Repeater::make('existing_cases')
                ->relationship()
                ->schema([
                    Forms\Components\TextInput::make('subject')->required(),
                     TableRepeater::make('existing_case_datas')
                     ->relationship()
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
                        ->required()
                        ->disableLabel(),
                        TextInput::make('executed_by')
                        ->required()
                        ->disableLabel(),
                        TextInput::make('status')
                        ->required()
                        ->disableLabel(),
                        // FileUpload::make('attachment_path')
                        // ->required()
                        // ->preserveFilenames()
                        // ->disableLabel(),
                    ])
                    ->columnSpan('full')
                ])
                // Forms\Components\Select::make('type_of_case_id')->label("Type Of Case")
                // ->options(TypeOfCase::pluck('name', 'id'))
                // ->required(),
                // Grid::make(2)
                // ->schema([
                //     Forms\Components\TextInput::make('legal_counsel')->label("Legal Counsel")
                //     ->required(),
                //     Forms\Components\TextInput::make('opposing_counsel')->label("Counsel of Opposing Party")
                //     ->required(),
                // ]),
                // Grid::make(2)
                // ->schema([
                //     Forms\Components\Select::make('branch_id')->label("Branch")
                //     ->options(Branch::pluck('name', 'id'))
                //     ->required()
                //     ->reactive()
                //     ->afterStateUpdated(function ($set, $state) {
                //         $address = Branch::find($state)->address;
                //         $set('address', $address);
                //     }),
                //     Forms\Components\TextInput::make('address')->disabled(),
                // ]),
                // Grid::make(2)
                // ->schema([
                //     Forms\Components\Select::make('status_id')->label("Status")
                //     ->options(Status::pluck('name', 'id'))
                //     ->required(),
                //     Forms\Components\DatePicker::make('date_filed')->label("Date Filed")
                //     ->required(),
                // ]),
                // Forms\Components\Repeater::make('existing_cases')
                // ->relationship()
                // ->schema([
                //     Forms\Components\TextInput::make('subject')->required(),
                //     // TableRepeater::make('other_data')
                //     // ->label('')
                //     // ->createItemButtonLabel('Add row')
                //     // ->schema([
                //     //     Forms\Components\DatePicker::make('date_time')
                //     //     ->required()
                //     //     ->disableLabel(),
                //     //     TextInput::make('subject_area')
                //     //     ->required()
                //     //     ->disableLabel(),
                //     //     TextInput::make('summary_of_case')
                //     //     ->required()
                //     //     ->disableLabel(),
                //     //     TextInput::make('petitioners_representative')
                //     //     ->required()
                //     //     ->disableLabel(),
                //     //     TextInput::make('executed_by')
                //     //     ->required()
                //     //     ->disableLabel(),
                //     //     TextInput::make('status')
                //     //     ->required()
                //     //     ->disableLabel(),
                //     //     FileUpload::make('attachment')
                //     //     ->required()
                //     //     ->preserveFilenames()
                //     //     ->disableLabel(),
                //     // ])
                //     // ->columnSpan('full')
                // ])

            ])->modalWidth('7xl'),
            Action::make('delete')
            ->button()
            ->outlined()
            ->icon('heroicon-o-trash')
            ->color('danger')
            ->action(function ($record) {
                $record->delete();
                $this->dialog()->success(
                    $title = 'Success',
                    $description = 'Deleted successfully'
                );
            })
            ->requiresConfirmation()
        ];
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('case_code')
            ->label('CASE CODE')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('case_number')
            ->label('CASE NUMBER')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('case_title')
            ->label('CASE TITLE')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('case_nature')
            ->label('NATURE OF CASE')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('type_of_case.name')
            ->label('TYPE OF CASE')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('legal_counsel')
            ->label('LEGAL COUNSEL')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('opposing_counsel')
            ->label('COUNSEL OF OPPOSING PARTY')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('date_filed')
            ->label('DATE FILED')->date('F d, Y')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('branch.name')
            ->label('BRANCH')->sortable()->searchable(),
        ];
    }

    public function render()
    {
        return view('livewire.admin.masterlist');
    }
}
