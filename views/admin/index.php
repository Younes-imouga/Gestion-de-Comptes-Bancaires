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
            
            <button 
                onclick="toggleSidebar()"
                class="lg:hidden fixed top-4 left-4 z-50 bg-gray-900 text-white p-2 rounded-lg"
            >
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>

            
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

                    
                    <nav class="mt-6 flex-grow">
                        <a href="/dashboardAdmin" class="flex items-center w-full px-6 py-3 text-white bg-gray-800">
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
                        <a href="/transactions" class="flex items-center w-full px-6 py-3 text-gray-400 hover:text-white hover:bg-gray-800">
                            <i data-lucide="repeat" class="w-5 h-5 mr-3"></i>
                            <span>Transactions</span>
                        </a>
                    </nav>

                            
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

            
            <div class="flex-1 flex flex-col">
                
                <div class="bg-white shadow">
                    <div class="px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-800">Dashboard</h2>
                        <div class="flex items-center space-x-4">
                            <button class="p-2 text-gray-400 hover:text-gray-600">
                                <i data-lucide="search" class="w-5 h-5"></i>
                            </button>
                            <button class="p-2 text-gray-400 hover:text-gray-600 relative">
                                <i data-lucide="bell" class="w-5 h-5"></i>
                                <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                            </button>
                        </div>
                    </div>
                </div>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        
        
        <div class="flex-1 p-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Tableau de bord</h1>

            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Utilisateurs totaux</p>
                            <p class="text-2xl font-bold text-gray-900"><?php echo number_format($statistics['total_users']); ?></p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <i data-lucide="users" class="w-6 h-6 text-blue-600"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">Nombre total d'utilisateurs</p>
                </div>

                
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Comptes actifs</p>
                            <p class="text-2xl font-bold text-gray-900"><?php echo number_format($statistics['active_accounts']); ?></p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-lg">
                            <i data-lucide="credit-card" class="w-6 h-6 text-green-600"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">Sur <?php echo number_format($statistics['total_accounts']); ?> comptes</p>
                </div>

                
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Volume total</p>
                            <p class="text-2xl font-bold text-gray-900"><?php echo number_format($statistics['total_balance'], 2, ',', ' '); ?> €</p>
                        </div>
                        <div class="bg-purple-100 p-3 rounded-lg">
                            <i data-lucide="wallet" class="w-6 h-6 text-purple-600"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">Balance totale des comptes</p>
                </div>

                
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Transactions</p>
                            <p class="text-2xl font-bold text-gray-900"><?php echo number_format($statistics['transactions']); ?></p>
                        </div>
                        <div class="bg-yellow-100 p-3 rounded-lg">
                            <i data-lucide="activity" class="w-6 h-6 text-yellow-600"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">Volume: <?php echo number_format($statistics['deposits'] - $statistics['withdrawals'], 2, ',', ' '); ?> €</p>
                </div>
            </div>

            
            <div class="bg-white rounded-lg shadow">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Transactions récentes</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Montant</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($statistics['recent_transactions'] as $transaction): ?>
                                <tr>
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
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900"><?php echo htmlspecialchars($transaction['sender_name']); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium <?php echo $transaction['transaction_type'] === 'depot' ? 'text-green-600' : 'text-red-600'; ?>">
                                            <?php echo ($transaction['transaction_type'] === 'depot' ? '+' : '-') . number_format($transaction['amount'], 2, ',', ' '); ?> €
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo date('d/m/Y H:i', strtotime($transaction['created_at'])); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        lucide.createIcons();
    </script>
</body>
</html> 
            </div>
        </div>

        
        <div 
        id="sidebarOverlay"
        onclick="toggleSidebar()"
        class="fixed inset-0 bg-black bg-opacity-50 lg:hidden hidden z-20"
    ></div>

    
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