<div>
    <div>
        <div class="mt-5 flex space-x-2 ">
            <x-button label="Back" sm slate icon="arrow-left" class="font-bold" wire:click="returnToDashboard"/>
            <x-button label="Update" sm emerald icon="pencil" class="font-bold" wire:click="showMasterlistData"/>
          </div>
          <div class="mt-5 col-span-1 divide-y divide-gray-200 rounded-lg shadow p-4 bg-gray-200">
            <div class="grid grid-cols-3">
                <div class="col-span-1 space-y-2">
                    <div class="flex space-x-3">
                        <dt class="text-sm font-semibold leading-6 text-gray-900">Date Filed:</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{\Carbon\Carbon::parse($record->date_filed)->format('F d, Y')}}</dd>
                    </div>
                    <div class="flex space-x-3">
                        <dt class="text-sm font-semibold leading-6 text-gray-900">Case Code:</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->case_code}}</dd>
                    </div>
                    <div class="flex space-x-3">
                        <dt class="text-sm font-semibold leading-6 text-gray-900">Case Number:</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->case_number}}</dd>
                    </div>
                    <div class="flex space-x-3">
                        <dt class="text-sm font-semibold leading-6 text-gray-900">Case Title:</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->case_title}}</dd>
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="col-span-1 space-y-2">
                        <div class="flex space-x-3">
                            <dt class="text-sm font-semibold leading-6 text-gray-900">Nature of Case:</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->case_nature}}</dd>
                        </div>
                        <div class="flex space-x-3">
                            <dt class="text-sm font-semibold leading-6 text-gray-900">Type of Case:</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->type_of_case->name}}</dd>
                        </div>
                        <div class="flex space-x-3">
                            <dt class="text-sm font-semibold leading-6 text-gray-900">Legal Counsel:</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->legal_counsel}}</dd>
                        </div>
                        <div class="flex space-x-3">
                            <dt class="text-sm font-semibold leading-6 text-gray-900">Counsel of Opposing Party:</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->opposing_counsel}}</dd>
                        </div>
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="col-span-1 space-y-2">
                        <div class="flex space-x-3">
                            <dt class="text-sm font-semibold leading-6 text-gray-900">Branch:</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->branch?->name}}</dd>
                        </div>
                        <div class="flex space-x-3">
                            <dt class="text-sm font-semibold leading-6 text-gray-900">Address:</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->branch?->address}}</dd>
                        </div>
                        <div class="flex space-x-3">
                            <dt class="text-sm font-semibold leading-6 text-gray-900">Status:</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->status->name}}</dd>
                        </div>
                    </div>
                </div>
            </div>
          </div>
            <div class="mt-10">
                <div class="p">
                    <div class="sm:flex-auto">
                        <h1 class="font-semibold text-lg text-center uppercase leading-6 text-gray-900">Cases</h1>
                      </div>
                    <div class="mt-3 flow-root">
                        <div class="flex space-x-2 ">
                            <x-button label="Add Subject" sm emerald icon="plus" class="font-bold" wire:click="$set('add_subject', true)"/>
                          </div>
                      <div class="mt-4 -mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block w-full py-2 align-middle sm:px-6 lg:px-8">
                          <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table class="w-full divide-y divide-gray-300">
                              <thead class="bg-gray-200">
                                <tr>
                                  <th scope="col" class="whitespace-nowrap  py-5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Subject</th>
                                  <th scope="col" class="whitespace-nowrap  px-3 py-5 text-left text-sm font-semibold text-gray-900"></th>
                                  <th scope="col" class="whitespace-nowrap  px-3 py-5 text-left text-sm font-semibold text-gray-900">Date</th>
                                  <th scope="col" class="whitespace-nowrap  px-3 py-5 text-left text-sm font-semibold text-gray-900">Subject Area</th>
                                  <th scope="col" class="whitespace-nowrap  px-3 py-5 text-left text-sm font-semibold text-gray-900">Summary of Case</th>
                                  <th scope="col" class="whitespace-nowrap  px-3 py-5 text-left text-sm font-semibold text-gray-900">Petitioners / Representative</th>
                                  <th scope="col" class="whitespace-nowrap  px-3 py-5 text-left text-sm font-semibold text-gray-900">Executed By</th>
                                  <th scope="col" class="whitespace-nowrap  px-3 py-5 text-left text-sm font-semibold text-gray-900">Status</th>
                                  <th scope="col" class="whitespace-nowrap  px-3 py-5 text-left text-sm font-semibold text-gray-900"> Attachment </th>
                                </tr>
                              </thead>
                              <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($record->existing_cases as $existingCase)
                                @php
                                    $otherData = $existingCase->existing_case_datas;
                                    // $otherData = json_decode($existingCase->other_data, true);
                                    $rowCount = count($otherData);
                                @endphp
                                @foreach ($otherData as $key => $value)
                                    <tr>
                                        @if ($loop->first)
                                            <td class="whitespace-nowrap py-4 pr-3 text-sm font-medium text-gray-900 pl-2" rowspan="{{ $rowCount }}">
                                                <div>
                                                <x-button.circle class="mr-4" negative xs icon="trash" wire:click="deleteSubject({{$existingCase->id}})"/>
                                                <x-button.circle class="mr-4" info xs label="+" wire:click="addExistingCaseData({{$existingCase->id}})"/>
                                                {{ strtoupper($existingCase->subject) }}
                                                </div>
                                            </td>
                                        @endif
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div class="flex space-x-2">

                                                @if($otherData->count() > 1)
                                                <button class="p-0 flex justify-center align-middle" wire:click="deleteExistingCaseData({{$value->id}})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-red-600">
                                                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                                      </svg>
                                                    </button>
                                                @endif
                                                <button class="p-0 flex justify-center align-middle" wire:click="showExistingCaseData({{$value->id}})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="currentColor" class="w-5 h-5 text-green-600 cursor-pointer">
                                                        <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                                                        <path d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                                                      </svg>
                                                    </button>
                                            </div>

                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ Carbon\Carbon::parse($value->date_time)->format('F d, Y') }}</td>
                                        <td class="break-words px-3 py-4 text-sm text-gray-500">{{ $value->subject_area }}</td>
                                        <td class="break-words px-3 py-4 text-sm text-gray-500">{{ $value->summary_of_case }}</td>
                                        <td class="break-words px-3 py-4 text-sm text-gray-500">{{ $value->petitioners_representative }}</td>
                                        <td class="break-words px-3 py-4 text-sm text-gray-500">{{ $value->executed_by }}</td>
                                        <td class="break-words px-3 py-4 text-sm text-gray-500">{{ $value->status }}</td>
                                        <td class="break-words px-3 py-4 text-sm">
                                            <div class="flex justify-between">
                                              <div class="text-blue-700 underline">
                                                <a href="{{ $this->getFileUrl($value->attachment_path) }}" target="_blank">{{ $value->attachment_path ?? '' }}
                                                </a>
                                              </div>
                                              <div class="">
                                                {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-red-600 cursor-pointer">
                                                  <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                                </svg> --}}
                                              </div>
                                            </div>
                                          </td>
                                    </tr>
                                @endforeach
                            @endforeach
                                <!-- More people... -->
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              {{-- Modal --}}
              <x-modal.card title="Update Data" max-width="6xl" blur wire:model.defer="update_masterlist">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-input label="Case Code" wire:model.defer="case_code"/>
                    <x-input label="Case Number" wire:model.defer="case_number"/>
                    <x-input label="Case Title" wire:model.defer="case_title"/>
                    <x-input label="Nature Of Case" wire:model.defer="nature_of_case"/>
                    <x-native-select label="Type of Case" wire:model="type_of_case_id">
                        @foreach ($type_of_cases as $item)
                        <x-select.option label="{{$item->name}}" value="{{$item->id}}" />
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </x-native-select>
                    <x-input label="Legal Counsel" wire:model.defer="legal_counsel"/>
                    <x-input label="Counsel of Opposing Party" wire:model.defer="opposing_counsel"/>
                    <x-datetime-picker label="Date Filed" without-time wire:model.defer="date_filed"/>
                    <x-native-select label="Branch" wire:model="branch_id">
                        @foreach ($branches as $item)
                        <x-select.option label="{{$item->name}}" value="{{$item->id}}" />
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </x-native-select>
                    <x-input label="Address" disabled wire:model.defer="address"/>

                    <div class="col-span-1 sm:col-span-2">
                        <x-native-select label="Status" wire:model="status_id">
                            @foreach ($statuses as $item)
                            <x-select.option label="{{$item->name}}" value="{{$item->id}}" />
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </x-native-select>
                    </div>
                </div>

                <x-slot name="footer">
                    <div class="flex justify-end gap-x-4">
                        <div class="flex">
                            <x-button flat label="Cancel" x-on:click="close" />
                            <x-button primary label="Save" wire:click="updateMasterlistData" />
                        </div>
                    </div>
                </x-slot>
            </x-modal.card>

            <x-modal.card title="Add Subject" blur max-width="6xl" wire:model.defer="add_subject">
                <div>
                    <livewire:admin.forms.add-subject :record="$record" />
                </div>
            </x-modal.card>

            <x-modal.card title="Add Data" blur align="center" max-width="6xl" wire:model.defer="add_existing_case_data">
                <div>
                    {{$this->form}}
                    {{-- @if ($existing_case_data)
                    <livewire:admin.forms.add-existing-case-data :record="$existing_case_data" />
                    @endif --}}
                </div>
                <x-slot name="footer">
                    <div class="flex justify-end gap-x-4">
                        <div class="flex">
                            <x-button flat label="Cancel" x-on:click="close" />
                            <x-button primary label="Save" wire:click="saveExistingCaseData" />
                        </div>
                    </div>
                </x-slot>
            </x-modal.card>

            <x-modal.card title="Update Existing Case Data" max-width="6xl" align="center" blur wire:model.defer="update_existing_case_datas">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-datetime-picker label="Date" without-time wire:model.defer="date_time"/>
                    <x-input label="Subject Area" wire:model.defer="subject_area"/>
                    <x-input label="Summary of Case" wire:model.defer="summary_of_case"/>
                    <x-input label="Petitioners / Representative" wire:model.defer="petitioners_representative"/>
                    <x-input label="Executed By" wire:model.defer="executed_by"/>
                    <x-input label="Status" wire:model.defer="status"/>
                </div>

                <x-slot name="footer">
                    <div class="flex justify-end gap-x-4">
                        <div class="flex">
                            <x-button flat label="Cancel" x-on:click="close" />
                            <x-button primary label="Save" wire:click="updateExistingCaseData" />
                        </div>
                    </div>
                </x-slot>
            </x-modal.card>
</div>
