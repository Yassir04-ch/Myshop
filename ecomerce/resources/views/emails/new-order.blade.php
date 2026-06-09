<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f8fafc; padding: 20px; }
        .card { background: white; border-radius: 12px; padding: 30px; max-width: 500px; margin: auto; border: 1px solid #e2e8f0; }
        h2 { color: #4f46e5; }
        .badge { background: #ecfdf5; color: #059669; padding: 4px 12px; border-radius: 20px; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        td { padding: 8px 0; border-bottom: 1px solid #f1f5f9; font-size: 14px; }
        td:last-child { text-align: right; font-weight: bold; }
        .btn { display: inline-block; margin-top: 20px; background: #4f46e5; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-size: 14px; }
    </style>
</head>
<body>
    <div class="card">
        <h2>🛒 Nouvelle Commande</h2>
        <span class="badge">✓ En attente de traitement</span>

        <table>
            <tr>
                <td>👤 Client</td>
                <td>{{ $order->user->name }}</td>
            </tr>
            <tr>
                <td>📧 Email</td>
                <td>{{ $order->user->email }}</td>
            </tr>
            <tr>
                <td>💰 Total</td>
                <td>{{ number_format($order->total_amount, 2) }} DH</td>
            </tr>
            <tr>
                <td>💳 Paiement</td>
                <td>{{ $order->payment_method === 'livraison' ? '🚚 Livraison' : '💳 Carte' }}</td>
            </tr>
            <tr>
                <td>📅 Date</td>
                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
            </tr>
        </table>

        <a href="{{ url('/orders/'. $order->id) }}" class="btn">
            Voir la commande →
        </a>
    </div>
</body>
</html>