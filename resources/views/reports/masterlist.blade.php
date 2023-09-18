<div>
    <div class="flex space-x-1">
      <div class="grid place-content-center">
        <img src="{{ asset('images/darbc.png') }}" class="h-10" alt="">
      </div>
      <div>
        <h1 class="text-xl font-bold text-gray-700"> DOLEFIL AGRARIAN REFORM BENEFICIARIES COOP.</h1>
        <h1>DARBC Complex, Brgy. Cannery Site, Polomolok, South Cotabato</h1>
      </div>
    </div>

    <h1 class="text-xl mt-5 text-center font-bold text-gray-700">Masterlist</h1>
    <div class="mt-5 overflow-x-auto">
      <table id="example" class="table-auto mt-5" style="width:100%">
        <thead class="font-normal">
          <tr>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">CASE CODE
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">CASE NUMBER
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">CASE TITLE
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">NATURE OF CASE
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">TYPE OF CASE
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">LEGAL COUNSEL
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">CONSEL OF OPPOSING PARTY
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DATE FILED
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">BRANCH
            </th>

          </tr>
        </thead>
        <tbody class="">
          @foreach ($masterlists as $item)
            <tr>
              <td class="border text-gray-600 text-sm whitespace-nowrap px-3 py-1">{{ strtoupper($item->case_code) }}</td>
              <td class="border text-gray-600 text-sm whitespace-nowrap px-3  py-1">{{ strtoupper($item->case_number) }}</td>
              <td class="border text-gray-600 text-sm whitespace-nowrap px-3  py-1">{{ strtoupper($item->case_title) }}</td>
              <td class="border text-gray-600 text-sm whitespace-nowrap px-3  py-1">{{ strtoupper($item->case_nature) }}</td>
              <td class="border text-gray-600 text-sm whitespace-nowrap px-3  py-1">{{ strtoupper($item->type_of_case->name) }}</td>
              <td class="border text-gray-600 text-sm whitespace-nowrap px-3  py-1">{{ strtoupper($item->legal_counsel) }}</td>
              <td class="border text-gray-600 text-sm whitespace-nowrap px-3  py-1">{{ strtoupper($item->opposing_counsel) }}</td>
              <td class="border text-gray-600 text-sm whitespace-nowrap px-3  py-1">{{ Carbon\Carbon::parse($item->date_filed)->format('F d, Y') }}</td>
              <td class="border text-gray-600 text-sm whitespace-nowrap px-3  py-1">{{ strtoupper($item->branch->name) }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="mt-10 flex justify-around">
        {{-- @foreach ($fourth_signatories as $item)
            <div class="mt-5">
                <h1>{{$item->description}}:</h1>
                @if ($item->name == null || $item->name == '')
                <div class="mt-6 w-36 h-0.5 bg-gray-600">
                </div>
                @else
                <span class="font-bold">{{$item->name}}</span>
                @endif
                <h1 class="text-sm">{{$item->position ?? ''}}</h1>
            </div>
        @endforeach --}}

    </div>
    </div>
  </div>
