<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <?php include 'mainscript.php' ?>
    <title>Users</title>
</head>
<body>
<div class="min-h-full">
    <?php include 'nav.php'; ?>
    <div class="py-10">
        <main>
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-gray-900">Users</h1>
                            <p class="mt-2 text-sm text-gray-700">A list of all users</p>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <button type="button" onclick="document.location.href='users/create';" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add user</button>
                        </div>
                    </div>
                    <div class="mt-8 flow-root">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="py-3.5 text-left text-sm font-semibold text-gray-900">Username</th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">First Name</th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Last Name</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        <?php foreach($data['users'] as $user) {
                                                print '<tr><td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">' . $user['username'] . '</td>' .
                                                '<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">' . $user['first_name'] .'</td>' .
                                                '<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">' . $user['last_name'] .'</td>' .
                                                '<td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                                    <a href="/users/edit?id='. $user['id'] .'" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                    <a onclick="deleteUser('. $user['id'] . ')" class="pl-4 cursor-pointer text-indigo-600 hover:text-indigo-900">Delete</a>
                                                </td></tr>';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>
<script>
    function deleteUser(id) {
        console.log(id)
        fetch(`/users/delete?id=${id}`, {
            method: "delete"
        }).then(() => {
            document.location.reload()
        })
    }
</script>
</body>

</html>