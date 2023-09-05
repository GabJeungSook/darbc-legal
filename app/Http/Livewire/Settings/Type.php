<?php

namespace App\Http\Livewire\Settings;

use DB;
use Filament\Forms;
use Filament\Tables;
use App\Models\Branch;
use App\Models\Status;
use Livewire\Component;
use WireUi\Traits\Actions;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Models\TypeOfCase;

class Type extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Actions;

    protected function getTableQuery(): Builder
    {
        return TypeOfCase::query();
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
                TypeOfCase::create([
                    'name' => $data['name'],
                ]);
                $this->dialog()->success(
                    $title = 'Success',
                    $description = 'Saved successfully'
                );
                DB::commit();
            })
            ->form([
                Forms\Components\TextInput::make('name')->label("Name")->required(),
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
            ->mountUsing(fn (Forms\ComponentContainer $form, TypeOfCase $record) => $form->fill([
                 'name' => $record->name,
            ]))
            ->action(function (TypeOfCase $record, array $data): void {
                DB::beginTransaction();
                $record->name = $data['name'];
                $record->save();
                DB::commit();
                $this->dialog()->success(
                    $title = 'Success',
                    $description = 'Updated successfully'
                );
            })
            ->form([
                Forms\Components\TextInput::make('name')->label("Name")->required(),
            ])->visible(fn ($record) => $record->masterlists->count() === 0),
            Action::make('delete')
            ->icon('heroicon-o-trash')
            ->button()
            ->outlined()
            ->color('danger')
            ->action(fn ($record) => $record->delete())
            ->requiresConfirmation()
            ->visible(fn ($record) => $record->masterlists->count() === 0)
        ];
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
            ->label('NAME'),
        ];
    }


    public function render()
    {
        return view('livewire.settings.type');
    }
}
