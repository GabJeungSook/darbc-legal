<?php

namespace App\Http\Livewire\Settings;

use DB;
use Filament\Forms;
use Filament\Tables;
use App\Models\Status;
use Livewire\Component;
use WireUi\Traits\Actions;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Branch as BranchModel;

class Branch extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Actions;

    protected function getTableQuery(): Builder
    {
        return BranchModel::query();
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
                BranchModel::create([
                    'name' => $data['name'],
                    'address' => $data['address'],
                ]);
                $this->dialog()->success(
                    $title = 'Success',
                    $description = 'Saved successfully'
                );
                DB::commit();
            })
            ->form([
                Forms\Components\TextInput::make('name')->label("Name")->required(),
                Forms\Components\Textarea::make('address')->label("Address")->required(),
            ])
        ];
    }

    protected function getTableActions()
    {
        return [
            Action::make('edit')
            ->icon('heroicon-o-pencil')
            ->button()
            ->outlined()
            ->color('success')
            ->mountUsing(fn (Forms\ComponentContainer $form, BranchModel $record) => $form->fill([
                'name' => $record->name,
                'address' => $record->address,
            ]))
            ->action(function (BranchModel $record, array $data): void {
                DB::beginTransaction();
                $record->name = $data['name'];
                $record->address = $data['address'];
                $record->save();
                DB::commit();
                $this->dialog()->success(
                    $title = 'Success',
                    $description = 'Updated successfully'
                );
            })
            ->form([
                Forms\Components\TextInput::make('name')->label("Name")->required(),
                Forms\Components\Textarea::make('address')->label("Address")->required(),
            ]),
            Action::make('delete')
            ->icon('heroicon-o-trash')
            ->button()
            ->outlined()
            ->color('danger')
            ->action(fn ($record) => $record->delete())
            ->requiresConfirmation()
        ];
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
            ->label('NAME'),
            Tables\Columns\TextColumn::make('address')
            ->label('ADDRESS'),
        ];
    }

    public function render()
    {
        return view('livewire.settings.branch');
    }
}
