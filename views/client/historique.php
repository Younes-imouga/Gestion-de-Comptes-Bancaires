<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Banque - Historique des transactions</title>
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
                    <span>Virement</span>
                </a>
                <a href="/historique" class="flex items-center w-full p-4 space-x-3 bg-blue-50 text-blue-600 border-r-4 border-blue-600">
                    <i data-lucide="history"></i>
                    <span>Historique</span>
                </a>
                <a href="/profile" class="flex items-center w-full p-4 space-x-3 text-gray-600 hover:bg-gray-50">
                    <i data-lucide="user"></i>
                    <span>Profil</span>
                </a>
                <a href="/logout" class="flex items-center w-full p-4 space-x-3 text-red-600 hover:bg-red-50 mt-auto">
                    <i data-lucide="log-out"></i>
                    <span>Déconnexion</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Historique des transactions</h2>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <i data-lucide="arrow-down-circle"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">Total Dépôts</h3>
                            <p class="text-lg font-semibold text-gray-900">
                                <?php 
                                $totalDepots = array_reduce($transactions, function($carry, $item) {
                                    return $carry + ($item['transaction_type'] === 'depot' ? $item['amount'] : 0);
                                }, 0);
                                echo number_format($totalDepots, 2, ',', ' ') . ' €';
                                ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-100 text-red-600">
                            <i data-lucide="arrow-up-circle"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">Total Retraits</h3>
                            <p class="text-lg font-semibold text-gray-900">
                                <?php 
                                $totalRetraits = array_reduce($transactions, function($carry, $item) {
                                    return $carry + ($item['transaction_type'] === 'retrait' ? $item['amount'] : 0);
                                }, 0);
                                echo number_format($totalRetraits, 2, ',', ' ') . ' €';
                                ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                            <i data-lucide="repeat"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">Total Virements</h3>
                            <p class="text-lg font-semibold text-gray-900">
                                <?php 
                                $totalTransferts = array_reduce($transactions, function($carry, $item) {
                                    return $carry + ($item['transaction_type'] === 'transfert' ? $item['amount'] : 0);
                                }, 0);
                                echo number_format($totalTransferts, 2, ',', ' ') . ' €';
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transactions Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Montant</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Compte</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Détails</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (!empty($transactions)): ?>
                            <?php foreach ($transactions as $transaction): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?php echo date('d/m/Y H:i', strtotime($transaction['created_at'])); ?>
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
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <?php if ($transaction['transaction_type'] === 'transfert'): ?>
                                            <?php if ($transaction['sender_user_id'] === $_SESSION['user_logged_in_id']): ?>
                                                <span class="text-red-600">
                                                    -<?php echo number_format($transaction['amount'], 2, ',', ' '); ?> €
                                                </span>
                                            <?php else: ?>
                                                <span class="text-green-600">
                                                    +<?php echo number_format($transaction['amount'], 2, ',', ' '); ?> €
                                                </span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span class="<?php echo $transaction['transaction_type'] === 'depot' ? 'text-green-600' : 'text-red-600'; ?>">
                                                <?php echo ($transaction['transaction_type'] === 'depot' ? '+' : '-') . number_format($transaction['amount'], 2, ',', ' '); ?> €
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?php echo $transaction['sender_account_type'] === 'courant' ? 'Compte Courant' : 'Compte Épargne'; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php if ($transaction['transaction_type'] === 'transfert'): ?>
                                            <?php echo $transaction['beneficiary_account_type'] === 'courant' ? 'Vers Compte Courant' : 'Vers Compte Épargne'; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    Aucune transaction à afficher
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>