<?php
$title = "Login";
$error = "";
// Check if an error message exists
if (isset($_SESSION['error_message'])) {
    $error = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

ob_start();
?>

<div class="fixed flex h-screen w-screen items-center bg-center bg-cover" style="background-image: url('https://www.vsu.edu.ph/images/01_acadamics_campus2-01.jpg')">
    <div class="z-20 hidden w-full bg-[#4f4f4f] opacity-60 mix-blend-multiply lg:block">
        <div class="container mx-auto grid grid-cols-12 gap-10 px-10 py-8">
            <div class="lg:col-start-2 lg:col-end-6">
                <h1 class="mb-8 text-4xl text-transparent">
                    Pasalubong Center<br />Business Management System
                </h1>
                <p class="text-transparent">
                    A system for the Pasalubong Center.
                </p>
            </div>
        </div>
    </div>
</div>
<div class="z-10 flex h-screen w-full items-center">
    <main class="container z-30 mx-auto grid grid-cols-1 items-center gap-10 overflow-hidden px-10 sm:grid-cols-12">
        <div class="hidden lg:col-start-2 lg:col-end-6 lg:block">
            <h1 class="mb-8 text-4xl text-white">
                Pasalubong Center<br />Business Management System
            </h1>
            <p class="text-white opacity-100">
                A system for the Pasalubong Center.
            </p>
        </div>
        <section class="rounded-xl bg-white p-10 pt-8 shadow-md sm:col-start-3 sm:col-end-11 lg:col-start-8 lg:col-end-12">
            <div class="flex flex-col gap-6">
                <h1 class="text-4xl">Log in</h1>
                <form class="flex flex-col gap-3" action="/login" method="post">
                    <article class="flex flex-col">
                        <label for="username-login" class="text-xs font-medium text-accent">USERNAME</label>
                        <input type="username" name="username" class="border-b-2 border-gray-300 py-2 outline-0 focus:border-b-primary" placeholder="Enter email" id="email-login" />
                    </article>
                    <article class="flex flex-col">
                        <label for="password-login" class="text-xs font-medium text-accent">
                            PASSWORD
                        </label>
                        <input type="password" name="password" class="px-0 border-0 border-b-2 border-gray-300 py-2 outline-0 focus:border-b-primary" placeholder="Enter password" id="password-login" />
                    </article>
                    <select title="role" name="role" class="" required id="">
                        <option>manager</option>
                        <option>cashier</option>
                        <option>personnel</option>
                    </select>
                    <article class="flex">
                        <button type="submit" name="submit" value="login" class="mt-2 bg-accent text-white py-2 px-4 rounded-md">Log in</button>
                    </article>
                </form>
            </div>
        </section>
    </main>
</div>

<?php
$content = ob_get_clean();

include $_SERVER['DOCUMENT_ROOT'] . '/resources/layouts/auth_layout.php';
?>