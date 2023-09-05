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
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Fieldset;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Masterlist as MasterlistModel;

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
            Action::make('create')
            ->label('Add New')
            ->button()
            ->color('primary')
            ->icon('heroicon-o-plus')
            ->action(function (array $data): void {
                if(TypeOfCase::exists() || Branch::exists() || Status::exists())
                {
                    DB::beginTransaction();
                    MasterlistModel::create([
                        'type_of_case_id' => $data['type_of_case_id'],
                        'branch_id' => $data['branch_id'],
                        'status_id' => $data['status_id'],
                        'case_code' => $data['case_code'],
                        'case_number' => $data['case_number'],
                        'case_title' => $data['case_title'],
                        'case_nature' => $data['case_nature'],
                        'legal_counsel' => $data['legal_counsel'],
                        'opposing_counsel' => $data['opposing_counsel'],
                        'date_filed' => $data['date_filed'],
                    ]);
                    DB::commit();
                    $this->dialog()->success(
                        $title = 'Success',
                        $description = 'Saved successfully'
                    );
                }else{
                    $this->dialog()->error(
                        $title = 'Cannot Add Data',
                        $description = 'Some data are missing (Type of Case, Branch, Status). Please check the settings.'
                    );
                }
            })
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
                ]),
                Forms\Components\Select::make('type_of_case_id')->label("Type Of Case")
                ->options(TypeOfCase::pluck('name', 'id'))
                ->required(),
                Grid::make(2)
                ->schema([
                    Forms\Components\TextInput::make('legal_counsel')->label("Legal Counsel")
                    ->required(),
                    Forms\Components\TextInput::make('opposing_counsel')->label("Counsel of Opposing Party")
                    ->required(),
                ]),
                Grid::make(2)
                ->schema([
                    Forms\Components\Select::make('branch_id')->label("Branch")
                    ->options(Branch::pluck('name', 'id'))
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($set, $state) {
                        $address = Branch::find($state)->address;
                        $set('address', $address);
                    }),
                    Forms\Components\TextInput::make('address')->disabled(),
                ]),
                Grid::make(2)
                ->schema([
                    Forms\Components\Select::make('status_id')->label("Status")
                    ->options(Status::pluck('name', 'id'))
                    ->required(),
                    Forms\Components\DatePicker::make('date_filed')->label("Date Filed")
                    ->required(),
                ]),

            ])
        ];
    }

    protected function getTableActions()
    {
        return [
            Action::make('edit')
            ->icon('heroicon-o-pencil')
            ->label('Update')
            ->button()
            ->outlined()
            ->color('success')
            ->mountUsing(fn (Forms\ComponentContainer $form, MasterlistModel $record) => $form->fill([
                'type_of_case_id' => $record->type_of_case_id,
                'branch_id' => $record->branch_id,
                'address' => $record->branch->address,
                'status_id' => $record->status_id,
                'case_code' => $record->case_code,
                'case_number' => $record->case_number,
                'case_title' => $record->case_title,
                'case_nature' => $record->case_nature,
                'legal_counsel' => $record->legal_counsel,
                'opposing_counsel' => $record->opposing_counsel,
                'date_filed' => $record->date_filed,
            ]))
            ->action(function (MasterlistModel $record, array $data): void {
                DB::beginTransaction();
                $record->type_of_case_id = $data['type_of_case_id'];
                $record->branch_id = $data['branch_id'];
                $record->status_id = $data['status_id'];
                $record->case_code = $data['case_code'];
                $record->case_number = $data['case_number'];
                $record->case_title = $data['case_title'];
                $record->case_nature = $data['case_nature'];
                $record->legal_counsel = $data['legal_counsel'];
                $record->opposing_counsel = $data['opposing_counsel'];
                $record->date_filed = $data['date_filed'];
                $record->save();
                DB::commit();
                $this->dialog()->success(
                    $title = 'Success',
                    $description = 'Updated successfully'
                );
            })
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
                ]),
                Forms\Components\Select::make('type_of_case_id')->label("Type Of Case")
                ->options(TypeOfCase::pluck('name', 'id'))
                ->required(),
                Grid::make(2)
                ->schema([
                    Forms\Components\TextInput::make('legal_counsel')->label("Legal Counsel")
                    ->required(),
                    Forms\Components\TextInput::make('opposing_counsel')->label("Counsel of Opposing Party")
                    ->required(),
                ]),
                Grid::make(2)
                ->schema([
                    Forms\Components\Select::make('branch_id')->label("Branch")
                    ->options(Branch::pluck('name', 'id'))
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($set, $state) {
                        $address = Branch::find($state)->address;
                        $set('address', $address);
                    }),
                    Forms\Components\TextInput::make('address')->disabled(),
                ]),
                Grid::make(2)
                ->schema([
                    Forms\Components\Select::make('status_id')->label("Status")
                    ->options(Status::pluck('name', 'id'))
                    ->required(),
                    Forms\Components\DatePicker::make('date_filed')->label("Date Filed")
                    ->required(),
                ]),

            ]),
        ];
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('case_code')
            ->label('CASE CODE'),
            Tables\Columns\TextColumn::make('case_number')
            ->label('CASE NUMBER'),
            Tables\Columns\TextColumn::make('case_title')
            ->label('CASE TITLE'),
            Tables\Columns\TextColumn::make('case_nature')
            ->label('NATURE OF CASE'),
            Tables\Columns\TextColumn::make('type_of_case.name')
            ->label('TYPE OF CASE'),
            Tables\Columns\TextColumn::make('legal_counsel')
            ->label('LEGAL COUNSEL'),
            Tables\Columns\TextColumn::make('opposing_counsel')
            ->label('COUNSEL OF OPPOSING PARTY'),
            Tables\Columns\TextColumn::make('date_filed')
            ->label('DATE FILED')->date('F d, Y'),
            Tables\Columns\TextColumn::make('branch.name')
            ->label('BRANCH'),
        ];
    }


    public function render()
    {
        return view('livewire.admin.masterlist');
    }
}
