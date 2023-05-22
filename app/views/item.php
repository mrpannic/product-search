<!DOCTYPE html>
<html lang="en">
<?php $item = $data['item']; ?>
<?php $hiddenFields = ['name', 'objectID', 'ikea_id', 'image']; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <?php include 'mainscript.php' ?>
    <title><?php echo $item['name'] ?></title>
</head>

<body>
    <div class="min-h-full">
        <?php include 'nav.php'; ?>
        <div class="py-10">
            <main>
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="px-4 sm:px-6 lg:px-8">
                        <div class="sm:flex sm:items-center">
                            <div class="bg-white">
                                <div class="pt-6">

                                    <!-- Product info -->
                                    <div class="mx-auto max-w-2xl px-4 pb-16 pt-2 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8">
                                        <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                                            <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl"><?php echo $item['name'] ?></h1>
                                        </div>

                                        <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pb-16 lg:pr-8 lg:pt-6">

                                        <?php foreach ($item as $key => $value) { 
                                            
                                            if(in_array($key, $hiddenFields) || !$value) continue;
                                            if(is_array($value)) $value = implode(", ", $value);

                                            echo 
                                                "<div class='mt-5'>
                                                    <h3 class='text-sm font-medium text-gray-900'>". implode(' ', explode('_', ucwords($key))). "</h3>
    
                                                    <div class='space-y-6'>
                                                        <p class='text-base text-gray-900'>$value</p>
                                                    </div>
                                                </div>";
                                        }?>
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>