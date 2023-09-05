<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Masterlist as MasterlistModel;
use Filament\Tables\Actions\Action;
use WireUi\Traits\Actions;
use DB;
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
            ->label('Add Member')
            ->button()
            ->color('primary')
            ->icon('heroicon-o-plus')
            ->action(function (array $data): void {
                // MasterlistModel::create([
                //     'member_id' => $data['member_id'],
                //     'first_name' => $data['first_name'],
                //     'middle_name' => $data['middle_name'],
                //     'last_name' => $data['last_name'],
                //     'tin_number' => $data['tin_number'],
                //     'address' => $data['address'],
                //     'date_of_birth' => $data['date_of_birth'],
                //     'age' => $data['age'],
                //     'gender' => $data['gender'],
                //     'civil_status' => $data['civil_status'],
                //     'educational_attainment' => $data['educational_attainment'],
                //     'occupation' => $data['occupation'],
                //     'dependent_number' => $data['dependent_number'],
                //     'religion' => $data['religion'],
                //     'income' => $data['income'],
                //     'date_accepted' => $data['date_accepted'],
                //     'bod_number' => $data['bod_number'],
                //     'membership_type' => $data['membership_type'],
                //     'number_of_shares' => $data['number_of_shares'],
                //     'amount_subscribed' => $data['amount_subscribed'],
                //     'initial_paid_up' => $data['initial_paid_up'],
                //     'bod_resolution' => $data['bod_resolution'],
                //     'date_created' => $data['date_created'],
                //     'image_path' => $data['image_path'],
                // ]);
                $this->dialog()->success(
                    $title = 'Success',
                    $description = 'Saved successfully'
                );
            })
            ->form([

            ])
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
            ->label('DATE FILED'),
            Tables\Columns\TextColumn::make('branch.name')
            ->label('BRANCH'),
        ];
    }


    public function render()
    {
        return view('livewire.admin.masterlist');
    }
}
