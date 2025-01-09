<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Banque - Mes Comptes</title>
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
                <a href="/compte" class="flex items-center w-full p-4 space-x-3 bg-blue-50 text-blue-600 border-r-4 border-blue-600">
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
            <h2 class="text-2xl font-bold text-gray-800">Mes Comptes</h2>

            <?php foreach ($accounts as $account): ?>
                <div class="mt-6 bg-white rounded-lg shadow">
                    <div class="p-6">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800">
                                    <?php echo $account['account_type'] === 'courant' ? 'Compte Courant' : 'Compte Épargne'; ?>
                                </h3>
                                <p class="text-sm text-gray-500">
                                    ID: <?php echo $account['id']; ?>
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-gray-900">
                                    <?php echo number_format($account['balance'], 2, ',', ' '); ?> €
                                </p>
                            </div>
                        </div>
                        
                        <div class="mt-6 grid grid-cols-2 gap-4">
                            <a href="/virement" 
                               class="flex items-center justify-center p-3 text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-50">
                                <i data-lucide="send" class="w-5 h-5 mr-2"></i>
                                Virement
                            </a>
                            <a href="/historique" 
                               class="flex items-center justify-center p-3 text-purple-600 border border-purple-600 rounded-lg hover:bg-purple-50">
                                <i data-lucide="history" class="w-5 h-5 mr-2"></i>
                                Historique
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Initialize Lucide icons -->
            <script>
                lucide.createIcons();
            </script>
        </div>
    </div>
</body>
</html>