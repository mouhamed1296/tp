<?php include_once "./components/head.php"; 
include_once "../repositories/UserRepository.php";
$repo = new UserRepository();
?>

<body>
    <div class="md:flex md:items-center md:justify-center md:h-screen p-4">
        <div class="">
            <div class="flex flex-col md:flex md:flex-row md:items-center md:gap-12">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <img src="./images/login.svg" alt="illustration inscription">
                    </div>
                </div>
                <div class="mt-5 md:col-span-2 md:mt-0">
                    <h1 class="text-emerald-700 text-center font-bold text-xl mb-4">Connexion</h1>
                    <form action="#" method="POST" class="md:mt-16">
                        <div class="overflow-hidden shadow sm:rounded-md">
                            <div class="bg-white flex flex-col gap-10 px-4 py-10 sm:p-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="mail" class="block text-md font-medium text-gray-700">Email</label>
                                    <input type="email" name="mail" id="mail" aria-describedby="mail-format"
                                        autocomplete="off"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-md">
                                    <p class="mt-2 hidden text-sm text-gray-500" id="mail-format">
                                        Exemple: mouhamed845@gmail.com
                                    </p>
                                    <span id="error-mail" class="hidden mt-2 text-red-500"></span>
                                    <span id="email-ok" class="hidden mt-2 text-emerald-500 ">ok</span>
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="last-name" class="block text-md font-medium text-gray-700">Mot de
                                        passe</label>
                                    <input type="password" name="password" id="password"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-md">
                                    <span id="error-password" class="hidden mt-2 text-red-500"></span>
                                    <span id="password-ok" class="hidden mt-2 text-emerald-500 ">ok</span>
                                </div>
                                <div class="px-0 py-3 text-right sm:px-0 flex md:gap-20 justify-between items-center">
                                    <div class="flex flex-col gap-2 items-start">
                                        <span class="text-md">Pas encore de compte</span>
                                        <span class="text-emerald-700 no-underline hover:underline">S'inscrire</span>
                                    </div>
                                    <button type="submit" id="connexion"
                                        class="inline-flex justify-center rounded-md border border-transparent bg-emerald-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">Se
                                        connecter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="js/connexion.js"></script>
</body>

</html>