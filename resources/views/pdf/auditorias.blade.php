<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Reporte de Auditoría</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 10px; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 18px; font-weight: bold; margin-bottom: 5px; }
        .subtitle { font-size: 14px; margin-bottom: 20px; color: #666; }
        .filters { margin-bottom: 20px; padding: 10px; background: #f5f5f5; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background-color: #f8f9fa; text-align: left; padding: 8px; border: 1px solid #dee2e6; }
        td { padding: 8px; border: 1px solid #dee2e6; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .badge { padding: 3px 6px; border-radius: 3px; font-size: 10px; font-weight: bold; }
        .badge-ingreso { background-color: #d4edda; color: #155724; }
        .badge-egreso { background-color: #f8d7da; color: #721c24; }
        .badge-transferencia { background-color: #cce5ff; color: #004085; }
        .footer { position: fixed; bottom: 0; left: 0; right: 0; text-align: center; font-size: 9px; color: #666; }
        .page-break { page-break-after: always; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Reporte de Auditoría</div>
        <div class="subtitle">Generado el: {{ now()->format('d/m/Y H:i:s') }}</div>
        
        @if($filtros['fecha_inicio'] || $filtros['fecha_fin'] || $filtros['tipo_movimiento'])
        <div class="filters">
            <strong>Filtros aplicados:</strong>
            @if($filtros['fecha_inicio'] || $filtros['fecha_fin'])
                <span>Fecha: {{ $filtros['fecha_inicio'] ? 'desde ' . \Carbon\Carbon::parse($filtros['fecha_inicio'])->format('d/m/Y') : '' }} 
                {{ $filtros['fecha_fin'] ? 'hasta ' . \Carbon\Carbon::parse($filtros['fecha_fin'])->format('d/m/Y') : '' }}</span>
            @endif
            @if($filtros['tipo_movimiento'])
                <span> | Tipo: {{ ucfirst($filtros['tipo_movimiento']) }}</span>
            @endif
        </div>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Monto</th>
                <th>Saldo Anterior</th>
                <th>Saldo Nuevo</th>
                <th>Usuario</th>
                <th>Banco Origen</th>
                <th>Banco Destino</th>
            </tr>
        </thead>
        <tbody>
            @foreach($auditorias as $auditoria)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($auditoria->fecha_registro)->format('d/m/Y H:i') }}</td>
                <td>
                    @php
                        $badgeClass = 'badge-' . ($auditoria->movimiento->tipo_movimiento ?? 'default');
                    @endphp
                    <span class="badge {{ $badgeClass }}">
                        {{ ucfirst($auditoria->movimiento->tipo_movimiento ?? 'N/A') }}
                    </span>
                </td>
                <td class="text-right">{{ number_format($auditoria->movimiento->monto ?? 0, 2) }}</td>
                <td class="text-right">{{ number_format($auditoria->saldo_anterior, 2) }}</td>
                <td class="text-right">{{ number_format($auditoria->saldo_nuevo, 2) }}</td>
                <td>{{ $auditoria->movimiento->user->name ?? 'N/A' }}</td>
                <td>{{ $auditoria->movimiento->bancoEmisor->nombre ?? 'N/A' }}</td>
                <td>{{ $auditoria->movimiento->bancoReceptor->nombre ?? 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Página <span class="page-number"></span> de <span class="page-count"></span>
    </div>

    <script type="text/php">
        if (isset($pdf)) {
            $text = "Página {PAGE_NUM} de {PAGE_COUNT}";
            $size = 9;
            $font = $fontMetrics->getFont("DejaVu Sans");
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = ($pdf->get_width() - $width) / 2;
            $y = $pdf->get_height() - 20;
            $pdf->page_text($x, $y, $text, $font, $size);
        }
    </script>
</body>
</html>
