<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Gestion des Clients</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lucide/0.263.1/umd/lucide.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
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
        <div class="flex-1">
            <!-- Top Navigation -->
            <div class="bg-white shadow">
                <div class="px-8 py-4 flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800">Gestion des Clients</h2>
                    <button 
                        onclick="toggleAddClientModal()"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center"
                    >
                        <i data-lucide="user-plus" class="w-5 h-5 mr-2"></i>
                        Nouveau Client
                    </button>
                </div>
            </div>

            <!-- Filters -->
            <div class="p-8">
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Search -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Rechercher</label>
                            <div class="relative">
                                <input 
                                    type="text" 
                                    placeholder="Nom, email..."
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                >
                                <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute left-3 top-2"></i>
                            </div>
                        </div>

                        <!-- Sort -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Trier par</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="name">Nom</option>
                                <option value="date">Date d'inscription</option>
                                <option value="balance">Solde total</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Clients Table -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Comptes</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (isset($users) && !empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($user['name']); ?></div>
                                                    <div class="text-sm text-gray-500">ID: <?php echo htmlspecialchars($user['id']); ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900"><?php echo htmlspecialchars($user['email']); ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">compte(s)
                                                <?php
                                                    foreach ($user['accounts'] as $account) {
                                                        echo '<div class="text-sm text-gray-500">' . $account['account_type'] . " ID: " . $account['id'] . '</div>';
                                                    }
                                                ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <button onclick="deleteClient(<?php echo $user['id']; ?>)" class="text-red-600 hover:text-red-900">
                                                    EDIT
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                        Aucun client trouvé
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
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
        function toggleAddClientModal() {
    const modal = document.getElementById('addClientModal');
    modal.classList.toggle('hidden');
}

function submitAddClientForm() {
    const form = document.getElementById('addClientForm');
    if (form.checkValidity()) {
        // Traitement du formulaire ici
        alert('Client ajouté avec succès !');
        toggleAddClientModal();
    } else {
        form.reportValidity();
    }
}
    </script>
</body>
</html>


