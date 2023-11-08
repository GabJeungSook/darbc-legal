<div>
    <x-button positive icon="arrow-left" label="Back" wire:click="returnToInquiry"/>
    <p class="mt-3 tracking-wide font-semibold text-gray-700">Masterlist of Legal Cases</p>
    <p class="tracking-wide font-semibold text-gray-700">DOLEFIL AGRARIAN REFORM BENEFICIARIES COOPERATIVE</p>
    <div class="mt-2">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="px-4 py-3 text-gray-900 text-xs bg-blue-500 text-left">No.</th>
                    <th class="px-4 py-3 text-gray-900 text-xs bg-blue-500 text-left">CASE TITLE</th>
                    <th class="px-4 py-3 text-gray-900 text-xs bg-blue-500 text-left">NATURE OF CASE</th>
                    <th class="px-4 py-3 text-gray-900 text-xs bg-blue-500 text-left">TYPE OF CASE</th>
                    <th class="px-4 py-3 text-gray-900 text-xs bg-blue-500 text-left">CASE NUMBER</th>
                    <th class="px-4 py-3 text-gray-900 text-xs bg-blue-500 text-left">CASE CODE</th>
                    <th class="px-4 py-3 text-gray-900 text-xs bg-blue-500 text-left">LEGAL COUNSELS</th>
                    <th class="px-4 py-3 text-gray-900 text-xs bg-blue-500 text-left">COUNSEL OF OPPOSING PARTY</th>
                    <th class="px-4 py-3 text-gray-900 text-xs bg-blue-500 text-left">DATE FILED STARTED</th>
                    <th class="px-4 py-3 text-gray-900 text-xs bg-blue-500 text-left">BRANCH</th>
                    <th class="px-4 py-3 text-gray-900 text-xs bg-blue-500 text-left">ADDRESS</th>
                    <th class="px-4 py-3 text-gray-900 text-xs bg-blue-500 text-left">STATUS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-4 text-gray-900 text-sm py-3">{{$record->id}}</td>
                    <td class="px-4 text-gray-900 text-sm py-3">{{$record->case_title}}</td>
                    <td class="px-4 text-gray-900 text-sm py-3">{{$record->case_nature}}</td>
                    <td class="px-4 text-gray-900 text-sm py-3">{{$record->type_of_case->name}}</td>
                    <td class="px-4 text-gray-900 text-sm py-3">{{$record->case_number}}</td>
                    <td class="px-4 text-gray-900 text-sm py-3">{{$record->case_code}}</td>
                    <td class="px-4 text-gray-900 text-sm py-3">{{$record->legal_counsel}}</td>
                    <td class="px-4 text-gray-900 text-sm py-3">{{$record->opposing_counsel}}</td>
                    <td class="px-4 text-gray-900 text-sm py-3">{{\Carbon\Carbon::parse($record->date_filed)->format('F d, Y')}}</td>
                    <td class="px-4 text-gray-900 text-sm py-3">{{$record->branch->name}}</td>
                    <td class="px-4 text-gray-900 text-sm py-3">{{$record->branch->address}}</td>
                    <td class="px-4 text-gray-900 text-sm py-3">{{$record->status->name}}</td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
    <div class="mt-8">
        <p class="tracking-wide font-semibold text-gray-700">Supporting Documents</p>
        <div class="mt-2">
            <table class="w-full divide-y divide-gray-300">
                <thead class="bg-green-400">
                  <tr>
                    <th scope="col" class="py-5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Subject</th>
                    <th scope="col" class="px-3 py-5 text-left text-sm font-semibold text-gray-900"></th>
                    <th scope="col" class="px-3 py-5 text-left text-sm font-semibold text-gray-900">Date</th>
                    <th scope="col" class="px-3 py-5 text-left text-sm font-semibold text-gray-900">Subject Area</th>
                    <th scope="col" class="px-3 py-5 text-left text-sm font-semibold text-gray-900">Summary of Case</th>
                    <th scope="col" class="px-3 py-5 text-left text-sm font-semibold text-gray-900">Petitioners / Representative</th>
                    <th scope="col" class="px-3 py-5 text-left text-sm font-semibold text-gray-900">Executed By</th>
                    <th scope="col" class="px-3 py-5 text-left text-sm font-semibold text-gray-900">Status</th>
                    <th scope="col" class="px-3 py-5 text-left text-sm font-semibold text-gray-900"> Attachment </th>
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
                                  {{-- <x-button.circle class="mr-4" info xs label="+" wire:click="addExistingCaseData({{$existingCase->id}})"/> --}}
                                  {{ strtoupper($existingCase->subject) }}
                                  </div>
                              </td>
                          @endif
                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                              {{-- <button class="p-0 flex justify-center align-middle" wire:click="showExistingCaseData({{$value->id}})">
                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="currentColor" class="w-5 h-5 text-green-600 cursor-pointer">
                                      <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                                      <path d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                                    </svg>
                                  </button> --}}
                          </td>
                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ Carbon\Carbon::parse($value->date_time)->format('F d, Y') }}</td>
                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $value->subject_area }}</td>
                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $value->summary_of_case }}</td>
                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $value->petitioners_representative }}</td>
                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $value->executed_by }}</td>
                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $value->status }}</td>
                          <td class="whitespace-nowrap px-3 py-4 text-sm">
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
