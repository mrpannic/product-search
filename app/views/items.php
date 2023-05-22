<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <?php include 'mainscript.php' ?>
    <title>Item search</title>
</head>

<body>
    <div class="min-h-full">
        <?php include 'nav.php'; ?>
        <div class="py-10">
            <main clas="">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="px-4 sm:px-6 lg:px-8">
                        <div class="sm:flex sm:items-center">
                            <div class="sm:flex-auto">
                                <h1 class="text-base font-semibold leading-6 text-gray-900">Item search</h1>
                                <p class="mt-2 text-sm text-gray-700">Search items via external source</p>
                            </div>
                            <?php include 'filters.php'; ?>
                        </div>
                        <div class="mt-8 flow-root">
                            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                    <table id="items-table" style="display: none;" class="min-w-full divide-y divide-gray-300">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="py-3.5 text-left text-sm font-semibold text-gray-900">Name</th>
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Price</th>
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Short description</th>
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Type</th>
                                            </tr>
                                        </thead>
                                        <tbody id="items-tbody" class="divide-y divide-gray-200">
                                            <tr>
                                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">Lindsay Walton</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Front-end Developer</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">lindsay.walton@example.com</td>
                                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, Lindsay Walton</span></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include 'pagination.php' ?>
                </div>
            </main>
        </div>
    </div>

    <script>
        function search() {
            let data = {}
            const perPage = parseInt(document.getElementById('per_page').value)
            const query = document.getElementById('query').value
            if(!query) return

            let uri = `/items/search?query=${query}`

            if(perPage) uri += `&hitsPerPage=${perPage}`

            if(pageSwitched) {
                uri += `&page=${pageNum}`
                pageSwitched = false
            }

            fetch(uri, {
                method: "get",
            })
            .then((res) => res.json() )
            .then( (data) => updateTable(data[0]))
        }

        function updateTable(data) {
            const tbody = document.getElementById('items-tbody')
            const table = document.getElementById('items-table');
            const pagination = document.getElementById('pagination')
            const paginationDesc = document.getElementById('pagination-description')
            
            let tableData = '';

            for(let hit of data.hits) {
                console.log(hit)
                const shortDescription = hit.description.slice(0, 50) + "..."
                tableData += 
                `<tr>
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">${hit.name}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${hit.price}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${shortDescription}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${hit.type}</td>
                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                        <a href="/items/show?object_id=${hit.objectID}" target="_blank" class="text-indigo-600 hover:text-indigo-900">Show</a>
                    </td>
                </tr>`
            }
            nbPages = data.nbPages
            pageNum = data.page
            tbody.innerHTML = tableData
            table.style.display = ''
            if(data.nbHits) { 
                pagination.style.display = ''
                paginationDesc.innerHTML = `Page ${pageNum + 1}`
            }
            else {
                table.style.display = 'none'
            }
            paginationDesc.innerHTML = `Page ${pageNum + 1}`
        }
    </script>
</body>

</html>