<div class="max-w-7xl">
    <div class="flex justify-end">
        <div>
            <input type="query" name="query" id="query" class="block w-full rounded-md border-0 pl-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Search">
        </div>
        <div class="ml-2">
            <select id="per_page" name="per_page" class="block w-full h-9 rounded-md border-0 py-1.5 pl-2 pr-10 text-gray-900 text-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:leading-6">
                <option selected value="0">Per page</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="30">30</option>
                <option value="50">50</option>
            </select>
        </div>
        <div class="ml-2">
            <button type="button" onclick="search()" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white text-sm shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Search</button>
        </div>
    </div>
</div>