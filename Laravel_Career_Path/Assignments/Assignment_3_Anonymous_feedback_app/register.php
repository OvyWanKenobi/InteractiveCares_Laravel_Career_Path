<?php

session_start();

require "helper.php";

if (isset($_SESSION['user_email'])) {
    header('location:dashboard.php');
}

$errorBag = [];

$name = $email = $password = $unique_id = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST['name'])) {
        $errorBag['name'] = 'Please provide a name';
    } else {
        $name = sanitize($_POST['name']);
    }


    if (empty($_POST['email'])) {
        $errorBag['email'] = 'Please provide an email';
    } else {
        $email = sanitize($_POST['email']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorBag['email'] = "Please provide a valid email address.";
        }
    }


    if (empty($_POST['password'])) {
        $errorBag['password'] = 'Please provide a password';
    } elseif (strlen($_POST['password']) < 8) {
        $errorBag['password'] = 'Password should be longer than 8 characters';
    } elseif (empty($_POST['confirm_password'])) {
        $errorBag['confirm_password'] = 'Please confirm the password too';
    } elseif ($_POST['confirm_password'] !== $_POST['password']) {
        $errorBag['confirm_password'] = 'Passwords do not match';
    } else {
        $password = sanitize($_POST['password']);

        $password = password_hash($password, PASSWORD_DEFAULT);
    }



    $file_path = __DIR__ . '/files/users.json';
    if (file_exists($file_path) && filesize($file_path) > 0) {

        $users = json_decode(file_get_contents($file_path), true);

        $email_exists = false;
        foreach ($users as $user) {
            if ($user['email'] === $email) {
                $email_exists = true;
                break;
            }
        }

        if ($email_exists) {
            $errorBag['email'] = "Email already taken. ";
        } else {
            $existingIds = array_column($users, 'unique_id');
            $unique_id = generate_unique_id($existingIds);
        }
    } else {
        $users = [];
        $unique_id = generate_unique_id();
    }

    if (empty($errorBag)) {

        $users[] = ['unique_id' => $unique_id, 'name' => $name, 'email' => $email, 'password' => $password];
        file_put_contents($file_path, json_encode($users));

        flash('success', 'Account Created Successfully. Please login.');

        header('location:login.php');
        exit;
    }
}

function generate_unique_id($existingIds = [])
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $charactersLength = strlen($characters);
    $uniqueid = '';

    do {
        $uniqueid = '';
        for ($i = 0; $i < 7; $i++) {
            $uniqueid .= $characters[rand(0, $charactersLength - 1)];
        }
    } while (in_array($uniqueid, $existingIds));

    return $uniqueid;
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TruthWhisper - Anonymous Feedback App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <header class="bg-white">
        <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <a href="./index.php" class="-m-1.5 p-1.5">
                    <span class="sr-only">TruthWhisper</span>
                    <span class="block font-bold text-lg bg-gradient-to-r from-blue-600 via-green-500 to-indigo-400 inline-block text-transparent bg-clip-text">TruthWhisper</span>
                </a>
            </div>
            <div class="flex lg:hidden">
                <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
            <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                <a href="./login.php" class="text-sm font-semibold leading-6 text-gray-900">Log in <span aria-hidden="true">&rarr;</span></a>
            </div>
        </nav>
        <!-- Mobile menu, show/hide based on menu open state. -->
        <div class="lg:hidden" role="dialog" aria-modal="true">
            <!-- Background backdrop, show/hide based on slide-over state. -->
            <div class="fixed inset-0 z-10"></div>
            <div class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                <div class="flex items-center justify-between">
                    <a href="./index.php" class="-m-1.5 p-1.5">
                        <span class="sr-only">TruthWhisper</span>
                        <span class="block font-bold text-xl bg-gradient-to-r from-blue-600 via-green-500 to-indigo-400 inline-block text-transparent bg-clip-text">TruthWhisper</span>
                    </a>
                    <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                        <span class="sr-only">Close menu</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="mt-6 flow-root">
                    <div class="-my-6 divide-y divide-gray-500/10">
                        <div class="py-6">
                            <a href="./login.php" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Log in</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="">
        <div class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
            <img src="./images/beams.jpg" alt="" class="absolute top-1/2 left-1/2 max-w-none -translate-x-1/2 -translate-y-1/2" width="1308" />
            <div class="absolute inset-0 bg-[url(./images/grid.svg)] bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]"></div>
            <div class="relative bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-10">
                <div class="mx-auto max-w-xl">
                    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
                        <div class="mx-auto w-full max-w-xl text-center px-24">
                            <h1 class="block text-center font-bold text-2xl bg-gradient-to-r from-blue-600 via-green-500 to-indigo-400 inline-block text-transparent bg-clip-text">TruthWhisper</h1>
                        </div>

                        <div class="mt-10 mx-auto w-full max-w-xl">
                            <form class="space-y-6" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" novalidate>
                                <div>
                                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                                    <div class="mt-2">
                                        <input id="name" name="name" type="text" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>

                                    <?php if (isset($errorBag['name'])) : ?>
                                        <p class="text-xs text-red-600 mt-1"> * <?= $errorBag['name'] ?></p>
                                    <?php endif; ?>
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                                    <div class="mt-2">
                                        <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                    <?php if (isset($errorBag['email'])) : ?>
                                        <p class="text-xs text-red-600 mt-1"> * <?= $errorBag['email'] ?></p>
                                    <?php endif; ?>
                                </div>

                                <div>
                                    <div class="flex items-center justify-between">
                                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                                    </div>
                                    <div class="mt-2">
                                        <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                    <?php if (isset($errorBag['password'])) : ?>
                                        <p class="text-xs text-red-600 mt-1"> * <?= $errorBag['password'] ?></p>
                                    <?php endif; ?>
                                </div>

                                <div>
                                    <div class="flex items-center justify-between">
                                        <label for="confirm_password" class="block text-sm font-medium leading-6 text-gray-900">Confirm Password</label>
                                    </div>
                                    <div class="mt-2">
                                        <input id="confirm_password" name="confirm_password" type="password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                    <?php if (isset($errorBag['confirm_password'])) : ?>
                                        <p class="text-xs text-red-600 mt-1"> * <?= $errorBag['confirm_password'] ?></p>
                                    <?php endif; ?>
                                </div>

                                <div>
                                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Register</button>
                                </div>
                            </form>

                            <p class="mt-10 text-center text-sm text-gray-500">
                                Already have an account?
                                <a href="./login.php" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Login!</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white">
        <div class="mx-auto max-w-7xl px-6 py-12 md:flex md:items-center justify-center lg:px-8">
            <p class="text-center text-xs leading-5 text-gray-500">&copy; 2024 TruthWhisper, Inc. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>