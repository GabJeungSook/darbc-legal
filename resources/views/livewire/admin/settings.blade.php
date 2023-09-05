<div>
    <div x-data="{ activeTab: 'Type' }">
        <div class="hidden sm:block">
            <nav class="flex space-x-4" aria-label="Tabs">
                <!-- Current: "bg-gray-200 text-gray-800", Default: "text-gray-600 hover:text-gray-800" -->
                <a href="#" class="text-gray-600 hover:text-gray-800 rounded-md px-3 py-2 text-sm font-medium"
                    :class="{ 'bg-indigo-200 text-gray-800 rounded-md px-3 py-2 text-sm font-medium': activeTab === 'Type',
                    'text-gray-600 hover:text-gray-800 rounded-md px-3 py-2 text-sm font-medium': activeTab !== 'Type' }"
                    @click.prevent="activeTab = 'Type'">Type of Case</a>
                <a href="#" class="text-gray-600 hover:text-gray-800 rounded-md px-3 py-2 text-sm font-medium"
                :class="{ 'bg-indigo-200 text-gray-800 rounded-md px-3 py-2 text-sm font-medium': activeTab === 'Branch',
                'text-gray-600 hover:text-gray-800 rounded-md px-3 py-2 text-sm font-medium': activeTab !== 'Branch' }"
                    @click.prevent="activeTab = 'Branch'">Branch</a>
                <a href="#" class="text-gray-600 hover:text-gray-800 rounded-md px-3 py-2 text-sm font-medium"
                :class="{ 'bg-indigo-200 text-gray-800 rounded-md px-3 py-2 text-sm font-medium': activeTab === 'Status',
                'text-gray-600 hover:text-gray-800 rounded-md px-3 py-2 text-sm font-medium': activeTab !== 'Status' }"
                    aria-current="page" @click.prevent="activeTab = 'Status'">Status</a>
            </nav>
        </div>

        <div x-show="activeTab === 'Type'">
            <div class="flex justify-center items-center">
                <div class="relative block mt-3 w-full rounded-lg text-center focus:outline-none">
                    <span class="mt-2 block text-gray-600">
                        <livewire:settings.type />
                    </span>
                </div>
            </div>
        </div>
        <div x-show="activeTab === 'Branch'">
            <div class="flex justify-center items-center">
                <div class="relative block mt-3 w-full rounded-lg text-center focus:outline-none">
                    <span class="mt-2 block text-gray-600">
                        <livewire:settings.branch />
                    </span>
                </div>
            </div>
        </div>
        <div x-show="activeTab === 'Status'">
            <div class="flex justify-center items-center">
                <div class="relative block mt-3 w-full rounded-lg text-center focus:outline-none">
                    <span class="mt-2 block text-gray-600">
                        <livewire:settings.status />
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
