<div>
    <div class="pb-4 flex space-x-5">
        <x-native-select label="Type of Case" wire:model.defer="selected_type">
            <option value="">All</option>
            @foreach ($types as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach

        </x-native-select>
        <x-native-select label="Request" wire:model.defer="selected_request">
            <option value="">Select one</option>
            <option>Branch</option>
            <option>Address</option>
            <option>Case Code</option>
            <option>Case Number</option>
            <option>Case Title</option>
            <option>Nature of Case</option>
            <option>Legal Council</option>
        </x-native-select>
        <x-input label="Search" placeholder="" wire:model.defer="query"/>
        <div class="flex items-end">
            <x-button indigo label="Search" wire:click="generateQuery"/>
        </div>
    </div>
    <div class="">
        <ul role="list" class="divide-y divide-gray-400 h-96 px-2 overflow-y-auto">
            @forelse ($masterlist as $item)
            <li class="flex items-center justify-between gap-x-6 py-5">
                <div class="min-w-0">
                  <div class="flex items-start gap-x-3">
                    <p class="text-sm font-semibold leading-6 text-gray-900">{{$item->case_title}}</p>
                    <p class="rounded-md whitespace-nowrap mt-0.5 px-1.5 py-0.5 text-xs font-medium ring-1 ring-inset text-green-700 bg-green-50 ring-green-600/20">{{$item->status->name}}</p>
                  </div>
                  <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
                    <p class="whitespace-nowrap">{{$item->case_number}}</p>
                    <svg viewBox="0 0 2 2" class="h-0.5 w-0.5 fill-current">
                      <circle cx="1" cy="1" r="1" />
                    </svg>
                    <p class="truncate">{{\Carbon\Carbon::parse($item->created_at)->format('F d, Y')}}</p>
                  </div>
                </div>
                <div class="flex flex-none items-center gap-x-4">
                  <a href="{{route('view-masterlist-inquiry', $item)}}" class="hidden rounded-md bg-indigo-600 px-4 py-1.5 text-sm font-semibold text-white shadow-md ring-1 ring-indigo-100 hover:bg-indigo-400 sm:block">
                      View<span class="sr-only"></a>
                </div>
              </li>
            @empty
            <p class="text-center text-lg italic mt-10">No Records Found</p>
            @endforelse
          </ul>
    </div>

</div>
