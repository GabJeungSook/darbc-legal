<?php

namespace App\Http\Livewire\Report;

use DB;
use Filament\Forms;
use Filament\Tables;
use App\Models\Branch;
use Livewire\Component;
use App\Models\TypeOfCase;
use WireUi\Traits\Actions;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Fieldset;
use Illuminate\Database\Eloquent\Builder;
use App\Models\CaseTemplate as CaseTemplateModel;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;

class CaseTemplate extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Actions;

    protected function getTableQuery(): Builder
    {
        return CaseTemplateModel::query();
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
                DB::beginTransaction();
                $template = CaseTemplateModel::create([
                'branch_id' => $data['branch_id'],
                'address' => $data['address'],
                'type_of_case_id' => $data['type_of_case_id'],
                'civil_case_number' => $data['civil_case_number'],
                'type_of_case_id' => $data['type_of_case_id'],
                'plaintiffs' => json_encode($data['plaintiffs']),
                'defendants' => json_encode($data['defendants']),
                'case_description' => $data['case_description'],
                'latest_order' => json_encode($data['latest_order']),
                'note' => $data['note'],
                'prepared_by' => $data['prepared_by'],
                'approved_by' => $data['approved_by'],

                ]);
                DB::commit();
                $this->dialog()->success(
                    $title = 'Success',
                    $description = 'Saved successfully'
                );
            })
            ->form([
                Grid::make(2)
                ->schema([
                        Forms\Components\Select::make('branch_id')->label("Branch")
                        ->options(Branch::pluck('name', 'id'))
                        ->reactive()
                        ->afterStateUpdated(function ($set, $state) {
                            $address = Branch::find($state)->address;
                            $set('address', $address);
                        })->required(),
                        Forms\Components\TextInput::make('address')->hint('You may edit this')->required(),
                        Forms\Components\Select::make('type_of_case_id')->label("Type Of Case")
                        ->options(TypeOfCase::pluck('name', 'id'))
                        ->required(),
                        Forms\Components\TextInput::make('civil_case_number')
                        ->label('Civil Case Number')
                        ->required(),
                        Forms\Components\Repeater::make('plaintiffs')
                        ->schema([
                            Forms\Components\TextInput::make('name')->required(),
                        ]),
                        Forms\Components\Repeater::make('defendants')
                        ->schema([
                            Forms\Components\TextInput::make('name')->required(),
                        ]),
                ]),
                  Forms\Components\TextInput::make('case_description')->label('Case Description')
                  ->required(),
                  Forms\Components\Textarea::make('note'),
                  TableRepeater::make('latest_order')
                  ->label('')
                  ->createItemButtonLabel('Add row')
                  ->schema([
                    Forms\Components\DatePicker::make('date')
                    ->required()
                    ->disableLabel(),
                    Forms\Components\TextInput::make('title')
                    ->disableLabel()
                    ->required(),
                    Forms\Components\Textarea::make('remarks')
                    ->disableLabel(),
                  ]),
                  Grid::make(2)
                  ->schema([
                    Forms\Components\TextInput::make('prepared_by')->hint('You may edit this')->required()
                    ->default('Default'),
                    Forms\Components\TextInput::make('approved_by')
                    ->default('Default ')->hint('You may edit this')->required(),
                  ]),
            ])
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
            ->url(fn (CaseTemplateModel $record): string => route('view-case-template', $record)),
            Action::make('update')
            ->button()
            ->outlined()
            ->icon('heroicon-o-pencil')
            ->color('success')->visible(false),
        ];
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('branch.name')
            ->label('BRANCH')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('type_of_case.name')
            ->label('TYPE OF CASE')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('civil_case_number')
            ->label('CIVIL CASE NUMBER')->sortable()->searchable(),
        ];
    }

    public function render()
    {
        return view('livewire.report.case-template');
    }
}
