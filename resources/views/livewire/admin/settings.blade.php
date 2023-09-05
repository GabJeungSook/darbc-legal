<div>
   <!--
  This example requires some changes to your config:

  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
<div>
    <div class="sm:hidden">
      <label for="tabs" class="sr-only">Select a tab</label>
      <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
      <select id="tabs" name="tabs" class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
        <option>My Account</option>
        <option>Company</option>
        <option selected>Team Members</option>
        <option>Billing</option>
      </select>
    </div>
    <div class="hidden sm:block">
      <nav class="flex space-x-4" aria-label="Tabs">
        <!-- Current: "bg-gray-200 text-gray-800", Default: "text-gray-600 hover:text-gray-800" -->
        <a href="#" class="text-gray-600 hover:text-gray-800 rounded-md px-3 py-2 text-sm font-medium">Type of Case</a>
        <a href="#" class="text-gray-600 hover:text-gray-800 rounded-md px-3 py-2 text-sm font-medium">Branch</a>
        <a href="#" class="bg-indigo-200 text-gray-800 rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Status</a>
      </nav>
    </div>
  </div>

</div>
