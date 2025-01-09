<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Banque - Virements</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lucide/0.263.1/umd/lucide.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar (même contenu que précédemment) -->
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
                <a href="/virement" class="flex items-center w-full p-4 space-x-3 bg-blue-50 text-blue-600 border-r-4 border-blue-600">
                    <i data-lucide="send"></i>
                    <span>Virements</span>
                </a>
                <a href="/historique" class="flex items-center w-full p-4 space-x-3 text-gray-600 hover:bg-gray-50">
                    <i data-lucide="history"></i>
                    <span>Historique</span>
                </a>
                <a href="/profile" class="flex items-center w-full p-4 space-x-3 text-gray-600 hover:bg-gray-50">
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
            <h2 class="text-2xl font-bold text-gray-800">Effectuer un virement</h2>
            
            <div class="bg-white p-6 rounded-lg shadow mt-6">
                <form class="space-y-4" action="/transfer" method="post">
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for = "  ">Compte à débiter</label>
                        <select class="mt-1 block w-full rounded-md border border-gray-300 p-2" name = "sender_account">
                            <?php foreach ($accounts as $account): ?>
                                <option value="<?php echo $account['id']; ?>">
                                    <?php echo $account['account_type'] . ' - ' . $account['balance'] . '€'; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700" for = "beneficiary_account">Bénéficiaire</label>
                        <select class="mt-1 block w-full rounded-md border border-gray-300 p-2" name = "beneficiary_account">
                            <?php foreach ($accounts as $account): ?>
                                <option value="<?php echo $account['id']; ?>">
                                    <?php echo $account['account_type'] . ' - ' . $account['balance'] . '€'; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700" for = "amount">Montant</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">€</span>
                            </div>
                            <input 
                                type="number" 
                                min="0.01" 
                                step="0.01"
                                class="pl-7 block w-full rounded-md border border-gray-300 p-2" 
                                placeholder="0.00"
                                name = "amount"
                            />
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" name="transfer" class="w-full bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700">
                            Valider le virement
                        </button>
                    </div>
                </form>
            </div>

            <!-- Derniers virements -->
            <div class="bg-white rounded-lg shadow mt-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-700">Derniers virements</h3>
                    <div class="mt-4 space-y-4">
                        <div class="flex items-center justify-between p-4 border-b">
                            <div>
                                <p class="font-medium">Virement à John Doe</p>
                                <p class="text-sm text-gray-500">12 janvier 2025</p>
                                <p class="text-sm text-gray-500">Motif : Remboursement déjeuner</p>
                            </div>
                            <p class="text-red-600 font-medium">-€125.00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        //lucide.createIcons();
    </script>
</body>
</html>