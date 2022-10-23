<?php include_once "./components/head.php"; ?>

<body>
    <div class="md:flex md:items-center md:justify-center md:h-screen p-4">
        <div class="">
            <div class="flex flex-col md:flex md:flex-row md:items-end md:gap-12">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <img src="./images/signup.svg" alt="illustration inscription">
                    </div>
                </div>
                <div class="mt-5 md:col-span-2 md:mt-0">
                    <h1 class="text-emerald-700 text-center font-bold text-xl mb-4">Inscription</h1>
                    <form action="#" method="POST">
                        <div class="overflow-hidden shadow sm:rounded-md">
                            <div class="bg-white px-4 py-5 sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="first-name"
                                            class="block text-sm font-medium text-gray-700">Nom</label>
                                        <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="last-name"
                                            class="block text-sm font-medium text-gray-700">Prenom</label>
                                        <input type="text" name="last-name" id="last-name" autocomplete="family-name"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="email-address"
                                            class="block text-sm font-medium text-gray-700">Adresse email</label>
                                        <input type="email" name="email-address" id="email-address" autocomplete="email"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="country"
                                            class="block text-sm font-medium text-gray-700">Role</label>
                                        <select id="country" name="country" autocomplete="country-name"
                                            class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-emerald-500 focus:outline-none focus:ring-emerald-500 sm:text-sm">
                                            <option></option>
                                            <option>Admin</option>
                                            <option>User</option>
                                        </select>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="first-name" class="block text-sm font-medium text-gray-700">Mot de
                                            passe</label>
                                        <input type="password" name="first-name" id="first-name"
                                            autocomplete="given-name"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="last-name" class="block text-sm font-medium text-gray-700">Confirmer
                                            mot de passe</label>
                                        <input type="password" name="last-name" id="last-name"
                                            autocomplete="family-name"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="last-name"
                                            class="block text-sm font-medium text-gray-700">Photo</label>
                                        <input type="file">
                                    </div>

                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6 flex justify-between items-center">
                                <div class="flex flex-col gap-2 items-start">
                                    <span>Déjà un compte</span>
                                    <span class="text-emerald-700 no-underline hover:underline">Connexion</span>
                                </div>
                                <button type="submit"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-emerald-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">S'inscrire</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>