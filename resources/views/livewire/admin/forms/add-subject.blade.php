<div>
   {{$this->form}}
   <div class="flex justify-end gap-x-4">
    <div class="flex">
        <x-button flat label="Cancel" x-on:click="close" />
        <x-button primary label="Save" wire:click="saveExistingCaseData" />
    </div>
</div>
</div>
