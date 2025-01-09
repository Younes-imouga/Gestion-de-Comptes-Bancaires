<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Banque - Profil</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lucide/0.263.1/umd/lucide.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg hidden md:block" id="sidebar">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-blue-600">Ma Banque</h1>
            </div>
            <nav class="mt-6">
                <a href="/" class="flex items-center w-full p-4 space-x-3 text-gray-600 hover:bg-gray-50">
                    <i data-lucide="wallet"></i>
                    <span>Tableau de bord</span>
                </a>
                <a href="/compte" class="flex items-center w-full p-4 space-x-3 text-gray-600 hover:bg-gray-50">
                    <i data-lucide="credit-card"></i>
                    <span>Mes comptes</span>
                </a>
                <a href="/virement" class="flex items-center w-full p-4 space-x-3 text-gray-600 hover:bg-gray-50">
                    <i data-lucide="send"></i>
                    <span>Virements</span>
                </a>
                <a href="/historique" class="flex items-center w-full p-4 space-x-3 text-gray-600 hover:bg-gray-50">
                    <i data-lucide="history"></i>
                    <span>Historique</span>
                </a>
                <a href="/profile" class="flex items-center w-full p-4 space-x-3 bg-blue-50 text-blue-600 border-r-4 border-blue-600">
                    <i data-lucide="user"></i>
                    <span>Profile</span>
                </a>
                <a href="/logout" class="flex items-center w-full p-4 space-x-3 text-red-600 hover:bg-red-50 mt-auto">
                    <i data-lucide="log-out"></i>
                    <span>Déconnexion</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <h2 class="text-2xl font-bold text-gray-800">Mon Profil</h2>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
                <!-- Informations Personnelles -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">Informations personnelles</h3>
                            <form action="/update-profile" method="POST" class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nom</label>
                                        <input 
                                            name="name"
                                            type="text" 
                                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"
                                            value="<?php echo htmlspecialchars($user['name']); ?>"
                                            required
                                        />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Email</label>
                                        <input 
                                            name="email"
                                            type="email" 
                                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"
                                            value="<?php echo htmlspecialchars($user['email']); ?>"
                                            required
                                        />
                                    </div>
                                </div>

                                <div class="flex justify-end pt-4">
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                        Sauvegarder les modifications
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Sécurité -->
                    <div class="bg-white rounded-lg shadow mt-6">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">Modifier le mot de passe</h3>
                            <form action="/update-password" method="POST" class="space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Mot de passe actuel</label>
                                    <input 
                                        name="current_password"
                                        type="password" 
                                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"
                                        required
                                    />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
                                    <input 
                                        name="new_password"
                                        type="password" 
                                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"
                                        required
                                    />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Confirmer le nouveau mot de passe</label>
                                    <input 
                                        name="confirm_password"
                                        type="password" 
                                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"
                                        required
                                    />
                                </div>

                                <div class="flex justify-end pt-4">
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                        Modifier le mot de passe
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Paramètres et Préférences -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">Préférences</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-700">Notifications</h4>
                                    <div class="mt-2 space-y-2">
                                        <label class="flex items-center">
                                            <input type="checkbox" class="rounded text-blue-600" checked />
                                            <span class="ml-2 text-sm text-gray-700">Notifications par email</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" class="rounded text-blue-600" checked />
                                            <span class="ml-2 text-sm text-gray-700">Notifications SMS</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" class="rounded text-blue-600" checked />
                                            <span class="ml-2 text-sm text-gray-700">Alertes de sécurité</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="pt-4">
                                    <h4 class="text-sm font-medium text-gray-700">Confidentialité</h4>
                                    <div class="mt-2 space-y-2">
                                        <label class="flex items-center">
                                            <input type="checkbox" class="rounded text-blue-600" />
                                            <span class="ml-2 text-sm text-gray-700">Masquer le solde sur la page d'accueil</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" class="rounded text-blue-600" checked />
                                            <span class="ml-2 text-sm text-gray-700">Double authentification</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="pt-4">
                                    <h4 class="text-sm font-medium text-gray-700">Langue et région</h4>
                                    <div class="mt-2 space-y-4">
                                        <select class="block w-full rounded-md border border-gray-300 px-3 py-2">
                                            <option>Français</option>
                                            <option>English</option>
                                        </select>
                                        <select class="block w-full rounded-md border border-gray-300 px-3 py-2">
                                            <option>EUR (€)</option>
                                            <option>USD ($)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 pt-6 border-t">
                                <button 
                                    type="button"
                                    class="flex items-center text-red-600 hover:text-red-800"
                                >
                                    <i data-lucide="trash-2" class="w-4 h-4 mr-2"></i>
                                    Supprimer mon compte
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>