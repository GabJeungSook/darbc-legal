<div x-data>
    <x-button label="PRINT" sm dark icon="printer" class="font-bold"
    @click="printOut($refs.printContainer.outerHTML);" />
    <div x-ref="printContainer">
        <div class="flex justify-center space-x-1">
            <div>
              <h1 class="text-md font-bold text-center text-gray-700">Republic of the Philippines</h1>
              <h1 class="text-md font-bold text-center text-gray-700">REGIONAL TRIAL COURT</h1>
              <h1 class="text-md font-bold text-center text-gray-700">Judicial Region</h1>
              <h1 class="text-sm uppercase font-semibold text-center text-gray-700">{{$record->branch->name}}</h1>
              <h1 class="text-sm font-semibold text-center text-gray-700">{{ucfirst($record->branch->address)}}</h1>
              <h1 class="text-sm font-semibold text-center text-gray-700">(083) 887-3941 or 0923-340-3278</h1>
              <h1 class="text-sm font-semibold text-center text-gray-700">rtcgeno23@judiciary.gov.ph</h1>
            </div>
          </div>

          <div class="">
              @php
              $plaintiffs = json_decode($record->plaintiffs);

              if (is_array($plaintiffs)) {
                  $plaintiffNames = [];

                  foreach ($plaintiffs as $plaintiff) {
                      if (isset($plaintiff->name)) {
                          $plaintiffNames[] = ucfirst($plaintiff->name);
                      }
                  }

                  $plaintiffNames = implode(",\n", $plaintiffNames); // Use "\n" for a new line
              } else {
                  $plaintiffNames = '';
              }
          @endphp
        <div class="mx-10 mt-14 flex justify-between">
            <p class="text-sm font-semibold text-left text-gray-700">
                {!! nl2br(e($plaintiffNames)) !!},
                <br>
                <span class="italic pl-5">Plaintiff/s</span>
            </p>
            <p class="text-sm font-semibold text-left text-gray-700">
                Type of Case : {{$record->type_of_case->name}}
                <br>
                Case No: {{$record->civil_case_number}}
            </p>
        </div>
        <div class="mx-10 mt-10 flex justify-between">
            @php
            $defendants = json_decode($record->defendants);

            if (is_array($defendants)) {
                $deffendantsNames = [];

                foreach ($defendants as $defendant) {
                    if (isset($defendant->name)) {
                        $deffendantsNames[] = ucfirst($defendant->name);
                    }
                }

                $deffendantsNames = implode(",\n", $deffendantsNames); // Use "\n" for a new line
            } else {
                $deffendantsNames = '';
            }
        @endphp
            <p class="text-sm font-semibold text-left text-gray-700">
                <span class="mt-5">-versus-</span>
                <br>
                <br>
                <span>{{$deffendantsNames}}</span>
                <br>
                <span class="italic pl-5">Defendants/s</span>
            </p>
            <p class="text-sm font-semibold text-left text-gray-700">
                For : {{$record->case_description}}
            </p>
        </div>
        <div class="mt-5">
          <p class="text-md font-bold text-left text-gray-700">
            Latest Order:
        </p>
        </div>
        <div class="mt-4 overflow-x-auto">
          <table class="w-full table-auto border border-gray-300">
              <thead>
                  <tr>
                      <th class="border border-gray-300 bg-gray-300 px-4 py-2">DATE</th>
                      <th class="border border-gray-300 bg-gray-300 px-4 py-2">TITLE</th>
                      <th class="border border-gray-300 bg-gray-300 px-4 py-2">REMARKS</th>
                  </tr>
              </thead>
              <tbody>
                @php
                  $latest_order = json_decode($record->latest_order, true);
                @endphp
                @foreach ($latest_order as $item)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ Carbon\Carbon::parse($item['date'])->format('F d, Y') }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $item['title'] }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $item['remarks'] }}</td>
                </tr>
            @endforeach
              </tbody>
          </table>
      </div>
      <div class="mt-16">
        <p class="text-md font-bold text-left text-gray-700">
          Note: {{$record->note}}
      </p>
      </div>
      <div class="mt-10 flex justify-between">
            <div class="mt-5">
                <h1>Prepared by:</h1>
                <span class="font-bold">{{$record->prepared_by}}</span>
                <div class="w-40 h-0.5 bg-gray-600">
                </div>

                {{-- <h1 class="text-sm">{{$item->position ?? ''}}</h1> --}}
            </div>
            <div class="mt-5">
              <h1>Approved by:</h1>
              <span class="font-bold">{{$record->approved_by}}</span>
              <div class="w-40 h-0.5 bg-gray-600">
              </div>
          </div>
    </div>
          </div>
    </div>

  </div>
