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
            class="lg:hidden fixed top-4 left-4 z-50 bg-gray-900 text-white p-2 rounded-lg">
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
                    <a href="/compte" class="flex items-center w-full px-6 py-3 text-white bg-gray-800">
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
                            class="flex items-center w-full text-white hover:bg-gray-800 rounded-lg p-2">
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
                                class="block px-4 py-2 text-sm text-red-400 hover:bg-gray-700 rounded-b-lg">
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
            <!-- Top Navigation existant -->
            <div class="bg-white shadow">
                <div class="px-8 py-4 flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800">Gestion des Comptes</h2>
                    <button
                        onclick="toggleAccountActionsModal()"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center">
                        <i data-lucide="plus-circle" class="w-5 h-5 mr-2"></i>
                        Nouveau Compte
                    </button>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8">
                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500">Total des comptes</p>
                                <p class="text-2xl font-bold text-gray-900">
                                    <?php echo number_format($statistics['total_accounts']); ?>
                                </p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-lg">
                                <i data-lucide="credit-card" class="w-6 h-6 text-blue-600"></i>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">Nombre total de comptes</p>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500">Comptes actifs</p>
                                <p class="text-2xl font-bold text-gray-900">
                                    <?php echo number_format($statistics['active_accounts']); ?>
                                </p>
                            </div>
                            <div class="bg-green-100 p-3 rounded-lg">
                                <i data-lucide="check-circle" class="w-6 h-6 text-green-600"></i>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">Comptes en service</p>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500">Comptes désactivés</p>
                                <p class="text-2xl font-bold text-gray-900">
                                    <?php echo number_format($statistics['Desactive_accounts']); ?>
                                </p>
                            </div>
                            <div class="bg-red-100 p-3 rounded-lg">
                                <i data-lucide="x-circle" class="w-6 h-6 text-red-600"></i>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">Comptes hors service</p>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500">Volume total</p>
                                <p class="text-2xl font-bold text-gray-900">
                                    <?php echo number_format($statistics['total_balance'], 2, ',', ' '); ?> €
                                </p>
                            </div>
                            <div class="bg-purple-100 p-3 rounded-lg">
                                <i data-lucide="wallet" class="w-6 h-6 text-purple-600"></i>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">Total des soldes</p>
                    </div>
                </div>

                <!-- Filters existant -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <!-- ... Filtres existants ... -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Rechercher</label>
                            <div class="relative">
                                <input
                                    type="text"
                                    placeholder="N° compte, nom client..."
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute left-3 top-2"></i>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Type de compte</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option>Tous les types</option>
                                <option>Compte Courant</option>
                                <option>Compte Épargne</option>
                                <option>Compte Joint</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option>Tous les statuts</option>
                                <option>Actif</option>
                                <option>En attente</option>
                                <option>Bloqué</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Solde</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option>Tous les soldes</option>
                                <option>Négatif</option>
                                <option>0 - 1000€</option>
                                <option>> 1000€</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Table existante -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <!-- ... Table existante ... -->
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Compte
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Client
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Type
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Solde
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Statut
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- <?php if (isset($accounts) && !empty($accounts)): ?> -->
                                <?php foreach ($accounts as $account): ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($account['id']); ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($account['user_name']); ?></div>
                                                    <div class="text-sm text-gray-500"><?php echo htmlspecialchars($account['user_email']); ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Compte <?php echo htmlspecialchars($account['account_type']); ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($account['balance']); ?></div>
                                        </td>
                                        <?php
                                        if($account['status'] == "active"){
                                            echo " 
                                            <td class=\"px-6 py-4 whitespace-nowrap\">
                                                <span class=\"px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800\">
                                                {$account['status']}
                                                </span>
                                            </td>
                                            <td class=\"px-6 py-4 whitespace-nowrap\">
                                                <div class=\"flex space-x-2\">
                                                <form action=\"/compte\" method=\"post\">
                                                    <input type=\"hidden\" name= \"id\" value = \"{$account['id']}\">
                                                    <button name= \"account_action\" value=\"desactive\" class=\"text-red-600 hover:text-red-900\">
                                                        desactive
                                                    </button>
                                                </form>
                                                </div>
                                            </td>";
                                        } else {
                                            echo " 
                                            <td class=\"px-6 py-4 whitespace-nowrap\">
                                                <span class=\"px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800\">
                                                {$account['status']}
                                                </span>
                                            </td>
                                            <td class=\"px-6 py-4 whitespace-nowrap\">
                                                <div class=\"flex space-x-2\">
                                                <form action=\"/compte\" method=\"post\">
                                                    <input type=\"hidden\" name= \"id\" value = \"{$account['id']}\">
                                                    <button name= \"account_action\" value=\"active\" class=\"text-blue-600 hover:text-blue-900\">
                                                        active
                                                    </button>
                                                </form>
                                                </div>
                                            </td>";
                                        }

                                        ?>
                                    </tr>
                                <?php endforeach; ?>
                                <!-- <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                            Aucun client trouvé
                                        </td>
                                    </tr>
                                <?php endif; ?> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ajout/Modification Compte -->
    <div id="accountActionsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-10 mx-auto p-5 w-full max-w-2xl">
            <div class="bg-white rounded-lg shadow-xl">
                <!-- Modal Header -->
                <div class="flex justify-between items-center p-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">Ajouter un nouveau compte</h3>
                    <button onclick="toggleAccountActionsModal()" class="text-gray-400 hover:text-gray-500">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-6">
                    <form id="accountForm" class="space-y-6">
                        <!-- Sélection du client -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Client titulaire *</label>
                            <select required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Sélectionner un client</option>
                                <option value="1">Thomas Robert - #CLT001</option>
                                <option value="2">Marie Dubois - #CLT002</option>
                            </select>
                        </div>

                        <!-- Type de compte -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Type de compte *</label>
                                <select required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    onchange="toggleSavingsFields(this.value)">
                                    <option value="">Sélectionner</option>
                                    <option value="courant">Compte Courant</option>
                                    <option value="epargne">Compte Épargne</option>
                                </select>
                            </div>
                        </div>

                        <!-- Paramètres du compte -->
                        <div class="space-y-4">
                            <h4 class="text-base font-medium text-gray-900">Paramètres du compte</h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Plafond de retrait *</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500">€</span>
                                        </div>
                                        <input
                                            type="number"
                                            required
                                            min="0"
                                            class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="1000">
                                    </div>
                                </div>

                                <div id="decouvertField">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Découvert autorisé</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500">€</span>
                                        </div>
                                        <input
                                            type="number"
                                            min="0"
                                            class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="500">
                                    </div>
                                </div>

                                <div id="tauxInteretField" class="hidden">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Taux d'intérêt annuel</label>
                                    <div class="relative">
                                        <input
                                            type="number"
                                            step="0.01"
                                            min="0"
                                            max="100"
                                            class="w-full pr-8 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="2.5">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Options -->
                        <div class="space-y-4">
                            <h4 class="text-base font-medium text-gray-900">Options du compte</h4>

                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" class="rounded text-blue-600" checked>
                                    <span class="ml-2 text-sm text-gray-700">Activer la carte bancaire</span>
                                </label>

                                <label class="flex items-center">
                                    <input type="checkbox" class="rounded text-blue-600" checked>
                                    <span class="ml-2 text-sm text-gray-700">Autoriser les paiements en ligne</span>
                                </label>

                                <label class="flex items-center">
                                    <input type="checkbox" class="rounded text-blue-600" checked>
                                    <span class="ml-2 text-sm text-gray-700">Activer les notifications SMS</span>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end space-x-3 p-6 border-t bg-gray-50">
                    <button
                        onclick="toggleAccountActionsModal()"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Annuler
                    </button>
                    <button
                        onclick="submitAccountForm()"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Créer le compte
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Overlay pour mobile -->
    <div
        id="sidebarOverlay"
        onclick="toggleSidebar()"
        class="fixed inset-0 bg-black bg-opacity-50 lg:hidden hidden z-20"></div>

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

        // Fonction pour afficher/masquer le modal
        function toggleAccountActionsModal() {
            const modal = document.getElementById('accountActionsModal');
            modal.classList.toggle('hidden');
        }

        // Fonction pour gérer l'affichage des champs selon le type de compte
        function toggleSavingsFields(accountType) {
            const decouvertField = document.getElementById('decouvertField');
            const tauxInteretField = document.getElementById('tauxInteretField');

            if (accountType === 'epargne') {
                decouvertField.classList.add('hidden');
                tauxInteretField.classList.remove('hidden');
            } else {
                decouvertField.classList.remove('hidden');
                tauxInteretField.classList.add('hidden');
            }
        }

        // Fonction pour soumettre le formulaire
        function submitAccountForm() {
            const form = document.getElementById('accountForm');
            if (form.checkValidity()) {
                // Traitement du formulaire ici
                alert('Compte créé avec succès !');
                toggleAccountActionsModal();
            } else {
                form.reportValidity();
            }
        }
    </script>
</body>

</html>