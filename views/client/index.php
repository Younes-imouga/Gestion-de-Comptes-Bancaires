<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Banque - Tableau de bord</title>
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
                <a href="/"  class="flex items-center w-full p-4 space-x-3 bg-blue-50 text-blue-600 border-r-4 border-blue-600">
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

        <!-- Toggle Button for Mobile -->
        <button class="md:hidden p-4 text-gray-600 hover:text-blue-600" id="toggleSidebar">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>

        <!-- Add this button for desktop view -->
        <button class="hidden md:block p-4 text-gray-600 hover:text-blue-600" id="toggleSidebarDesktop">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>

        <!-- Main Content -->
        <div class="flex-1 p-4 md:p-8">
            <h2 class="text-2xl font-bold text-gray-800">Tableau de bord</h2>
            
            <!-- Account Summary Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
                <?php foreach ($accounts as $account): ?>
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold text-gray-700">
                            <?php echo $account['account_type'] === 'courant' ? 'Compte Courant' : 'Compte Épargne'; ?>
                        </h3>
                        <p class="text-3xl font-bold text-gray-900 mt-2">
                            <?php echo number_format($account['balance'], 2, ',', ' '); ?> €
                        </p>
                        <p class="text-sm text-gray-500 mt-1">ID: <?php echo $account['id']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mt-6">
                <a href="/virement" class="flex items-center justify-center space-x-2 p-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    <span>Nouveau virement</span>
                </a>
                <button onclick="toggleAlimenterModal()" class="flex items-center justify-center space-x-2 p-4 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    <span>Alimenter compte</span>
                </button>
                <a href="/historique" class="flex items-center justify-center space-x-2 p-4 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                    <span>Voir l'historique</span>
                </a>
                <button onclick="toggleRetraitModal()" class="flex items-center justify-center space-x-2 p-4 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    <span>Retrait</span>
                </button>
            </div>  

            <!-- Recent Transactions -->
            <div class="bg-white rounded-lg shadow mt-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-700">Transactions récentes</h3>
                    <div class="mt-4 space-y-4">
                        <?php foreach (array_slice($transactions, 0, 5) as $transaction): ?>
                            <div class="flex items-center justify-between p-4 border-b">
                                <div>
                                    <p class="font-medium">
                                        <?php 
                                        switch($transaction['transaction_type']) {
                                            case 'depot':
                                                echo 'Dépôt sur compte';
                                                break;
                                            case 'retrait':
                                                echo 'Retrait depuis compte';
                                                break;
                                            case 'transfert':
                                                if ($transaction['account_id'] === $transaction['beneficiary_account_id']) {
                                                    echo 'Virement entre vos comptes';
                                                } else {
                                                    echo $transaction['account_id'] === $_SESSION['user_logged_in_id'] ? 
                                                        'Virement émis' : 'Virement reçu';
                                                }
                                                break;
                                        }
                                        ?>
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        <?php echo date('d/m/Y', strtotime($transaction['created_at'])); ?>
                                        <?php if ($transaction['transaction_type'] === 'transfert'): ?>
                                            - <?php echo $transaction['beneficiary_account_type'] === 'courant' ? 'Compte Courant' : 'Compte Épargne'; ?>
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <p class="<?php 
                                    if ($transaction['transaction_type'] === 'depot') {
                                        echo 'text-green-600';
                                    } elseif ($transaction['transaction_type'] === 'retrait') {
                                        echo 'text-red-600';
                                    } elseif ($transaction['transaction_type'] === 'transfert') {
                                        // For transfers, check if user is sender or receiver
                                        echo $transaction['account_id'] === $_SESSION['user_logged_in_id'] ? 
                                            'text-red-600' : 'text-green-600';
                                    }
                                ?> font-medium">
                                    <?php 
                                    $prefix = '';
                                    if ($transaction['transaction_type'] === 'depot' || 
                                        ($transaction['transaction_type'] === 'transfert' && 
                                         $transaction['account_id'] !== $_SESSION['user_logged_in_id'])) {
                                        $prefix = '+';
                                    } else {
                                        $prefix = '-';
                                    }
                                    echo $prefix . number_format($transaction['amount'], 2, ',', ' '); 
                                    ?> €
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alimenter Modal -->
    <div id="alimenterModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 w-full max-w-md">
            <div class="bg-white rounded-lg shadow-xl">
                <div class="flex justify-between items-center p-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">Alimenter mon compte</h3>
                    <button onclick="toggleAlimenterModal()" class="text-gray-400 hover:text-gray-500">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>

                <form action="/alimenter" method="POST" class="p-6 space-y-6">
                    <!-- Account Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Compte à alimenter *</label>
                        <select name="account_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Sélectionnez un compte</option>
                            <?php foreach ($accounts as $account): ?>
                                <option value="<?php echo $account['id']; ?>">
                                    <?php echo $account['account_type'] === 'courant' ? 'Compte Courant' : 'Compte Épargne'; ?> 
                                    (<?php echo number_format($account['balance'], 2, ',', ' '); ?> €)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Amount -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Montant *</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">€</span>
                            </div>
                            <input 
                                type="number" 
                                name="amount"
                                required
                                min="0.01"
                                step="0.01"
                                class="w-full pl-8 pr-12 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="0.00"
                            >
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Méthode de paiement *</label>
                        <div class="space-y-3">
                            <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="paymentMethod" value="carte" required class="h-4 w-4 text-blue-600">
                                <span class="ml-3">Carte bancaire</span>
                            </label>
                            <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="paymentMethod" value="virement" required class="h-4 w-4 text-blue-600">
                                <span class="ml-3">Virement bancaire</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 pt-6 border-t">
                        <button type="button" 
                                onclick="toggleAlimenterModal()" 
                                class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Annuler
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Confirmer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Retrait Modal -->
    <div id="retraitModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 w-full max-w-md">
            <div class="bg-white rounded-lg shadow-xl">
                <div class="flex justify-between items-center p-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">Retrait d'argent</h3>
                    <button onclick="toggleRetraitModal()" class="text-gray-400 hover:text-gray-500">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>

                <form action="/retrait" method="POST" class="p-6 space-y-6">
                    <!-- Account Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Compte à débiter *</label>
                        <select name="account_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Sélectionnez un compte</option>
                            <?php foreach ($accounts as $account): ?>
                                <option value="<?php echo $account['id']; ?>">
                                    <?php echo $account['account_type'] === 'courant' ? 'Compte Courant' : 'Compte Épargne'; ?> 
                                    (<?php echo number_format($account['balance'], 2, ',', ' '); ?> €)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Amount -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Montant *</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">€</span>
                            </div>
                            <input 
                                type="number" 
                                name="amount"
                                required
                                min="0.01"
                                step="0.01"
                                class="w-full pl-8 pr-12 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="0.00"
                            >
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Montant minimum : 0.01 €</p>
                    </div>

                    <div class="flex justify-end space-x-3 pt-6 border-t">
                        <button type="button" 
                                onclick="toggleRetraitModal()" 
                                class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Annuler
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                            Confirmer le retrait
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
        
        function toggleAlimenterModal() {
            const modal = document.getElementById('alimenterModal');
            modal.classList.toggle('hidden');
        }

        function toggleRetraitModal() {
            const modal = document.getElementById('retraitModal');
            modal.classList.toggle('hidden');
        }
    </script>
</body>
</html>