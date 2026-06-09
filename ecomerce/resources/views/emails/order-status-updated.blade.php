<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f8fafc; padding: 20px; margin: 0; }
        .card { background: white; border-radius: 16px; padding: 32px; max-width: 520px; margin: auto; border: 1px solid #e2e8f0; }
        .header { text-align: center; margin-bottom: 24px; }
        .logo { font-size: 24px; font-weight: 900; color: #1e293b; }
        .logo span { color: #4f46e5; }
        .status-badge { display: inline-block; padding: 8px 20px; border-radius: 50px; font-weight: bold; font-size: 15px; margin: 16px 0; }
        .pending    { background: #fffbeb; color: #b45309; }
        .processing { background: #eff6ff; color: #1d4ed8; }
        .shipped    { background: #eef2ff; color: #4338ca; }
        .delivered  { background: #ecfdf5; color: #059669; }
        .cancelled  { background: #fef2f2; color: #dc2626; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td { padding: 10px 0; border-bottom: 1px solid #f1f5f9; font-size: 14px; color: #475569; }
        td:last-child { text-align: right; font-weight: bold; color: #1e293b; }
        .btn { display: block; text-align: center; margin-top: 24px; background: #4f46e5; color: white; padding: 14px; border-radius: 10px; text-decoration: none; font-weight: bold; font-size: 14px; }
        .footer { text-align: center; margin-top: 24px; font-size: 11px; color: #94a3b8; }
    </style>
</head>
<body>
    <div class="card">

        <div class="header">
            <div class="logo">⚡ Electro<span>Pro</span></div>
            <p style="color:#94a3b8; font-size:13px; margin-top:4px;">Mise à jour de votre commande</p>
        </div>

        <p style="font-size:15px; color:#1e293b;">
            Bonjour <strong>{{ $order->user->firstname }} {{ $order->user->lastname }}</strong>,
        </p>
        <p style="font-size:14px; color:#475569;">
            Le statut de votre commande <strong>#{{ $order->id }}</strong> a été mis à jour :
        </p>

        <div style="text-align:center;">
            @php
                $statusMap = [
                    'pending'    => ['pending',    '⏳ En attente'],
                    'processing' => ['processing', '🔄 En traitement'],
                    'shipped'    => ['shipped',    '🚚 Expédiée'],
                    'delivered'  => ['delivered',  '✅ Livrée'],
                    'cancelled'  => ['cancelled',  '❌ Annulée'],
                ];
                [$cls, $label] = $statusMap[$order->status] ?? ['pending', $order->status];
            @endphp
            <span class="status-badge {{ $cls }}">{{ $label }}</span>
        </div>

        <table>
            <tr>
                <td>📦 Commande</td>
                <td>#{{ $order->id }}</td>
            </tr>
            <tr>
                <td>💰 Total</td>
                <td>{{ number_format($order->total_amount, 2) }} DH</td>
            </tr>
            <tr>
                <td>📍 Ville</td>
                <td>{{ $order->city }}</td>
            </tr>
            <tr>
                <td>📅 Date</td>
                <td>{{ $order->created_at?->format('d/m/Y') }}</td>
            </tr>
        </table>

        <a href="{{ url('/orders/' . $order->id) }}" class="btn">
            Voir ma commande →
        </a>

        <div class="footer">
            ElectroPro — Cet email a été envoyé automatiquement, merci de ne pas y répondre.
        </div>

    </div>
</body>
</html>