<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <?php include 'mainscript.php' ?>
    <title>Edit User</title>
</head>

<body>
    <div class="min-h-full">
        <?php include 'nav.php'; ?>
        <?php $user = $data['user']; ?>
        <div class="py-10">
            <main>
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

                    <div class="pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Edit user</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">Update user's fields</p>
                        <form method="post" action="/users/update">
                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                                <div class="sm:col-span-3">
                                    <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                                    <div class="mt-2">
                                        <input type="text" name="username" id="username" class="pl-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required value="<?php echo $user['username']; ?>">
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                                    <div class="mt-2">
                                        <input type="password" name="password" id="password" class="pl-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required >
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="first_name" class="block text-sm font-medium leading-6 text-gray-900">First name</label>
                                    <div class="mt-2">
                                        <input type="text" name="first_name" id="first_name" class="pl-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required value="<?php echo $user['first_name']; ?>" >
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="last_name" class="block text-sm font-medium leading-6 text-gray-900">Last name</label>
                                    <div class="mt-2">
                                        <input type="text" name="last_name" id="last_name" class="pl-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required value="<?php echo $user['last_name']; ?>" >
                                    </div>
                                </div>

                            </div>
                            <div class="mt-5 pb-3">
                                <button type="button" onclick="submitUpdate()" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update user</button>
                            </div>

                        </from>
                    </div>
                </div>
            </main>
        </div>
    <script> 
        let userId = <?php echo $data['user']['id']; ?>

        function submitUpdate() {
            let form = document.forms[0]
            let formData = []
            let encodedId = encodeURIComponent('id') + "=" + encodeURIComponent(userId)
            formData.push(encodedId)
            for(let property of form.elements) {
                let encodedKey = encodeURIComponent(property.name)
                let encodedValue = encodeURIComponent(property.value)
                formData.push(encodedKey + "=" + encodedValue)
            }
            formData = formData.join('&')
            fetch('/users/update', {
                method: 'put',
                headers: {
                    'Content-Type' : 'application/x-www-form-urlencoded;charset=UTF-8'
                },
                body: formData
            }).then(() => {
                document.location.href="/users"
            })
            
        }   
    </script>
</body>

</html>