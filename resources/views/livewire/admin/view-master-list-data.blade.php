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
                                @foreach ($record->existing_cases->sortByDesc('date_time') as $existingCase)
                                @php
                                    $otherData = $existingCase->existing_case_datas->sortByDesc('date_time');
                                    // $otherData = json_decode($existingCase->other_data, true);
                                    $rowCount = count($otherData);
                                @endphp
                                @foreach ($otherData as $key => $value)
                                    <tr>
                                        @if ($loop->first)
                                            <td class="whitespace-nowrap py-4 pr-3 text-sm font-medium text-gray-900 pl-2" rowspan="{{ $rowCount }}">
                                                <div class="flex">

                                                    <button class="mr-4 p-0 flex justify-center align-middle" wire:click="deleteSubject({{$existingCase->id}})">
                                                        <div class="flex flex-col items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-600">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                              </svg>
                                                          {{-- <small class="text-red-600">Delete</small> --}}
                                                      </div>
                                                      </button>
                                                {{-- <x-button class="mr-4" negative xs icon="trash" wire:click="deleteSubject({{$existingCase->id}})"/> --}}
                                                {{-- <x-button class="mr-4" info xs icon="plus" wire:click="addExistingCaseData({{$existingCase->id}})"/> --}}
                                                    <button class="mr-4 p-0 flex justify-center align-middle" wire:click="addExistingCaseData({{$existingCase->id}})">
                                                          <div class="flex flex-col items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-blue-600">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                              </svg>
                                                            {{-- <small class="text-blue-600">Add Data</small> --}}
                                                        </div>
                                                        </button>
                                                {{ strtoupper($existingCase->subject) }}
                                                </div>
                                            </td>
                                        @endif
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div class="flex space-x-5">

                                                @if($otherData->count() > 1)
                                                <button class="p-0 flex justify-center align-middle" wire:click="deleteExistingCaseData({{$value->id}})">
                                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-red-600">
                                                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                                      </svg> --}}
                                                      <div class="flex flex-col items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-600">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                          </svg>
                                                        <small class="text-red-600">Delete Row</small>
                                                    </div>


                                                    </button>
                                                @endif
                                                <button class="p-0 flex justify-center align-middle" wire:click="showExistingCaseData({{$value->id}})">
                                                    <div class="flex flex-col items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-600">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                          </svg>
                                                        <small class="text-green-600">Edit Row</small>
                                                    </div>
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
                                            <div class="flex justify-center space-x-4">
                                                    @if ($value->attachment_path === null)
                                                    <div>
                                                        <button wire:click="uploadFileModal('{{$value->id}}')">
                                                            <div class="flex flex-col items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-600">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15" />
                                                                </svg>
                                                                <small class="text-blue-600">Upload</small>
                                                            </div>
                                                        </button>
                                                    </div>
                                                    @endif
                                              {{-- <div class="text-blue-700 underline">
                                                <a href="{{ $this->getFileUrl($value->attachment_path) }}" target="_blank">{{ $value->attachment_path ?? '' }}
                                                </a>
                                              </div> --}}
                                              @if ($value->attachment_path !== null)
                                              <div>
                                                <button wire:click="uploadFileModal('{{$value->id}}')">
                                                    <div class="flex flex-col items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-600">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                          </svg>
                                                        <small class="text-green-600">Edit File</small>
                                                    </div>
                                                </button>
                                            </div>
                                              <div class="">
                                                <a href="{{ $this->getFileUrl($value->attachment_path) }}" target="_blank" class="text-center">
                                                    <div class="flex flex-col items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-yellow-600">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                      </svg>
                                                      <small class="text-yellow-600">View</small>
                                                    </div>
                                                </a>

                                              </div>
                                              <div>
                                                <div class="flex flex-col items-center">
                                                <button wire:click="download('{{ $value->attachment_path }}')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-600">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                                    </svg>
                                                </button>
                                                <small class="text-blue-600">Download</small>
                                                </div>
                                              </div>
                                              @endif
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

            {{-- Upload File --}}
            <x-modal.card title="Upload File" max-width="6xl" align="center" blur wire:model.defer="upload_file">
                <div>
                    @if ($existing_case_data_upload)
                    <livewire:admin.forms.upload-file :record="$existing_case_data_upload" />
                    @endif
                </div>
            </x-modal.card>
</div>
