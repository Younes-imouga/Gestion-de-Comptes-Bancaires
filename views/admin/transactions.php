<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lucide/0.263.1/umd/lucide.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen relative">
        <!-- Bouton Menu Mobile -->
        <button 
            onclick="toggleSidebar()"
            class="lg:hidden fixed top-4 left-4 z-50 bg-gray-900 text-white p-2 rounded-lg"
        >
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>

        <!-- Sidebar avec classe pour contrôler la visibilité -->
        <div id="sidebar" class="fixed inset-y-0 left-0 transform -translate-x-full lg:translate-x-0 lg:relative lg:flex w-64 bg-gray-900 transition-transform duration-200 ease-in-out z-30">
            <div class="flex flex-col h-full">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <h1 class="text-2xl font-bold text-white">Admin Panel</h1>
                        <button onclick="toggleSidebar()" class="lg:hidden text-white">
                            <i data-lucide="x" class="w-6 h-6"></i>
                        </button>
                    </div>
                    <p class="text-gray-400 text-sm">Gestion bancaire</p>
                </div>

                <!-- Navigation -->
                <nav class="mt-6 flex-grow">
                    <a href="/dashboardAdmin" class="flex items-center w-full px-6 py-3 text-gray-400 hover:text-white hover:bg-gray-800">
                        <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="/clients" class="flex items-center w-full px-6 py-3 text-gray-400 hover:text-white hover:bg-gray-800">
                        <i data-lucide="users" class="w-5 h-5 mr-3"></i>
                        <span>Clients</span>
                    </a>
                    <a href="/compte" class="flex items-center w-full px-6 py-3 text-gray-400 hover:text-white hover:bg-gray-800">
                        <i data-lucide="credit-card" class="w-5 h-5 mr-3"></i>
                        <span>Comptes</span>
                    </a>
                    <a href="/transactions" class="flex items-center w-full px-6 py-3 text-white bg-gray-800">
                        <i data-lucide="repeat" class="w-5 h-5 mr-3"></i>
                        <span>Transactions</span>
                    </a>
                </nav>

                <!-- Profil Admin avec Déconnexion -->
                <div class="border-t border-gray-800 p-6">
                    <div class="relative">
                        <button 
                            onclick="toggleProfileMenu()"
                            class="flex items-center w-full text-white hover:bg-gray-800 rounded-lg p-2"
                        >
                            <img src="/api/placeholder/32/32" alt="Admin" class="w-8 h-8 rounded-full">
                            <div class="ml-3 flex-grow">
                                <p class="text-sm font-medium">Admin</p>
                                <p class="text-xs text-gray-400">admin@banque.fr</p>
                            </div>
                            <i data-lucide="chevron-up" class="w-5 h-5 transform transition-transform duration-200" id="profileChevron"></i>
                        </button>

                        <!-- Menu Profil -->
                        <div id="profileMenu" class="absolute bottom-full left-0 w-full mb-2 bg-gray-800 rounded-lg shadow-lg hidden">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 rounded-t-lg">
                                <i data-lucide="user" class="w-4 h-4 inline-block mr-2"></i>
                                Mon profil
                            </a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">
                                <i data-lucide="settings" class="w-4 h-4 inline-block mr-2"></i>
                                Paramètres
                            </a>
                            <a 
                                href="/logout" 
                                class="block px-4 py-2 text-sm text-red-400 hover:bg-gray-700 rounded-b-lg"
                            >
                                <i data-lucide="log-out" class="w-4 h-4 inline-block mr-2"></i>
                                Déconnexion
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
   <!-- Main Content -->
   <div class="flex-1">
    <!-- Top Navigation -->
    <div class="bg-white shadow">
        <div class="px-8 py-4 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">Gestion des Transactions</h2>
            <div class="flex space-x-4">
                <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center">
                    <i data-lucide="download" class="w-5 h-5 mr-2"></i>
                    Exporter
                </button>
                <button onclick="toggleTransactionDetailsModal()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center">
                    <i data-lucide="search" class="w-5 h-5 mr-2"></i>
                    Détails transaction
                </button>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="p-8">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Nombre de transactions</p>
                        <p class="text-2xl font-bold text-gray-900"><?php echo number_format($statistics['total_count']); ?></p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-lg">
                        <i data-lucide="activity" class="w-6 h-6 text-blue-600"></i>
                    </div>
                </div>
                <p class="text-sm <?php echo $statistics['percentage_change'] >= 0 ? 'text-green-600' : 'text-red-600'; ?> mt-2">
                    <?php echo ($statistics['percentage_change'] >= 0 ? '+' : '') . number_format($statistics['percentage_change'], 1); ?>% vs hier
                </p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Volume total</p>
                        <p class="text-2xl font-bold text-gray-900">
                            <?php echo number_format($statistics['total_volume'], 2, ',', ' '); ?> €
                        </p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-lg">
                        <i data-lucide="trending-up" class="w-6 h-6 text-green-600"></i>
                    </div>
                </div>
                <p class="text-sm text-gray-500 mt-2">Total des soldes de tous les comptes</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Dépôts</p>
                        <p class="text-2xl font-bold text-gray-900">
                            <?php echo number_format($statistics['total_deposits'], 2, ',', ' '); ?> €
                        </p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-lg">
                        <i data-lucide="arrow-down-circle" class="w-6 h-6 text-purple-600"></i>
                    </div>
                </div>
                <p class="text-sm text-gray-500 mt-2">Montant total déposé</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Retraits</p>
                        <p class="text-2xl font-bold text-gray-900">
                            <?php echo number_format($statistics['total_withdrawals'], 2, ',', ' '); ?> €
                        </p>
                    </div>
                    <div class="bg-red-100 p-3 rounded-lg">
                        <i data-lucide="arrow-up-circle" class="w-6 h-6 text-red-600"></i>
                    </div>
                </div>
                <p class="text-sm text-gray-500 mt-2">Montant total retiré</p>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Rechercher</label>
                    <div class="relative">
                        <input 
                            type="text" 
                            placeholder="ID transaction, client..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                        <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute left-3 top-2"></i>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option>Tous les types</option>
                        <option>Virement</option>
                        <option>Prélèvement</option>
                        <option>Paiement CB</option>
                        <option>Retrait</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option>Tous les statuts</option>
                        <option>Validé</option>
                        <option>En attente</option>
                        <option>Refusé</option>
                        <option>Suspect</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date de</label>
                    <input 
                        type="date" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date à</label>
                    <input 
                        type="date" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>
            </div>
        </div>

        <!-- Transactions Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Transaction
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Client
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Type
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Montant
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (!empty($transactions)): ?>
                        <?php foreach ($transactions as $transaction): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900"><?php echo ucfirst($transaction['transaction_type']); ?></div>
                                    <div class="text-sm text-gray-500">ID-<?php echo $transaction['id']; ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($transaction['sender_name']); ?></div>
                                            <div class="text-sm text-gray-500">Compte: <?php echo $transaction['sender_account_type']; ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"><?php echo ucfirst($transaction['transaction_type']); ?></div>
                                    <?php if ($transaction['transaction_type'] === 'transfert'): ?>
                                        <div class="text-sm text-gray-500">Vers: <?php echo htmlspecialchars($transaction['beneficiary_name']); ?></div>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium <?php echo $transaction['transaction_type'] === 'depot' ? 'text-green-600' : 'text-red-600'; ?>">
                                        <?php echo ($transaction['transaction_type'] === 'depot' ? '+' : '-') . number_format($transaction['amount'], 2, ',', ' '); ?> €
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"><?php echo date('d M Y', strtotime($transaction['created_at'])); ?></div>
                                    <div class="text-sm text-gray-500"><?php echo date('H:i', strtotime($transaction['created_at'])); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        <?php echo match($transaction['transaction_type']) {
                                            'depot' => 'bg-green-100 text-green-800',
                                            'retrait' => 'bg-red-100 text-red-800',
                                            'transfert' => 'bg-blue-100 text-blue-800'
                                        }; ?>">
                                        <?php echo ucfirst($transaction['transaction_type']); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                Aucune transaction à afficher
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
    </div>

    <!-- Overlay pour mobile -->
    <div 
        id="sidebarOverlay"
        onclick="toggleSidebar()"
        class="fixed inset-0 bg-black bg-opacity-50 lg:hidden hidden z-20"
    ></div>

    <!-- Scripts -->
    <script>
        // Initialisation des icônes
        lucide.createIcons();

        // Toggle Sidebar Mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        // Toggle Profile Menu
        function toggleProfileMenu() {
            const menu = document.getElementById('profileMenu');
            const chevron = document.getElementById('profileChevron');
            
            menu.classList.toggle('hidden');
            chevron.classList.toggle('rotate-180');
        }

        // Fermer le menu profil si on clique ailleurs
        document.addEventListener('click', function(event) {
            const menu = document.getElementById('profileMenu');
            const profileButton = event.target.closest('button');
            
            if (!profileButton && !menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
                document.getElementById('profileChevron').classList.remove('rotate-180');
            }
        });
    </script>
</body>
</html>