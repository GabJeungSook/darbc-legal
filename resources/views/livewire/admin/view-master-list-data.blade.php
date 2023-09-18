<div>
        <div>
          <dl class="grid grid-cols-1 sm:grid-cols-2">
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Case Code</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->case_code}}</dd>
            </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Case Number</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->case_number}}</dd>
            </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Case Title</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->case_title}}</dd>
            </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Nature of Case</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->case_nature}}</dd>
            </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Type of Case</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->type_of_case->name}}</dd>
            </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                 <dt class="text-sm font-medium leading-6 text-gray-900">Legal Counsel</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->legal_counsel}}</dd>
            </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Counsel of Opposing Party</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->opposing_counsel}}</dd>
            </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Date Filed</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{\Carbon\Carbon::parse($record->date_filed)->format('F d, Y')}}</dd>
            </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Branch</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->branch->name}}</dd>
            </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Address</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->branch->address}}</dd>
            </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Status</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->status->name}}</dd>
            </div>
          </dl>


        </div>
            <div class="mt-5">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Cases</h1>
                      </div>
                    <div class="mt-8 flow-root">
                      <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block w-full py-2 align-middle sm:px-6 lg:px-8">
                          <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table class="w-full divide-y divide-gray-300">
                              <thead class="bg-gray-300">
                                <tr>
                                  <th scope="col" class="py-5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Subject</th>
                                  <th scope="col" class="px-3 py-5 text-left text-sm font-semibold text-gray-900">Date Time</th>
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
                                    $otherData = json_decode($existingCase->other_data, true);
                                    $rowCount = count($otherData);
                                @endphp
                                @foreach ($otherData as $key => $value)
                                    <tr>
                                        @if ($loop->first)
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6" rowspan="{{ $rowCount }}">{{ strtoupper($existingCase->subject) }}</td>
                                        @endif
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ Carbon\Carbon::parse($value['date_time'])->format('F d, Y') }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $value['subject_area'] }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $value['summary_of_case'] }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $value['petitioners_representative'] }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $value['executed_by'] }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $value['status'] }}</td>
                                        @foreach ($existingCase->attachments as $attachment)
                                        <td class="whitespace-nowrap px-3 py-4 text-sm">
                                          <div class="flex justify-between">
                                            <div class="text-blue-700 underline">
                                              <a href="{{ $this->getFileUrl($attachment->path) }}" target="_blank">{{ $value['attachment'] ?? '' }}
                                              </a>
                                            </div>
                                            <div class="">
                                              {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-red-600 cursor-pointer">
                                                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                              </svg> --}}
                                            </div>
                                          </div>

                                        </td>
                                        @endforeach
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
</div>
