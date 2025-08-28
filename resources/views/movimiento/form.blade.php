
@php
    $opcionesMovimiento = [
        'movimiento uno' => 'Movimiento uno',
    ]
@endphp
<div class="grid grid-cols-2 gap-6">
    <div>
        <x-input-label for="tipo_movimiento" :value="__('Tipo Movimiento')" />
        <select id="tipo_movimiento" name="tipo_movimiento" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            <option value="ingreso" {{ old('tipo_movimiento', $movimiento?->tipo_movimiento) == 'ingreso' ? 'selected' : '' }}>Ingreso</option>
            <option value="egreso" {{ old('tipo_movimiento', $movimiento?->tipo_movimiento) == 'egreso' ? 'selected' : '' }}>Egreso</option>
            <option value="transferencia" {{ old('tipo_movimiento', $movimiento?->tipo_movimiento) == 'transferencia' ? 'selected' : '' }}>Transferencia</option>
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('tipo_movimiento')" />
    </div>
    <div>
        <x-input-label for="monto" :value="__('Monto')"/>
        <x-text-input id="monto" name="monto" type="text" class="mt-1 block w-full" :value="old('monto', $movimiento?->monto)" autocomplete="monto" placeholder="Monto"/>
        <x-input-error class="mt-2" :messages="$errors->get('monto')"/>
    </div>
    <div>
        <x-input-label for="banco_emisor_id" :value="__('Banco Emisor Id')"/>
        <select id="banco_emisor_id" name="banco_emisor_id" class="form-control select2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:bg-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full @error('banco_emisor_id') is-invalid @enderror" id="banco_emisor_id" style="height: 38px !important;">
            <option value="">{{ ('Seleccione un banco') }}</option>
            @foreach ($bancos as $banco)
                <option value="{{ $banco->id }}" {{ old('banco_emisor_id', $movimiento->banco_emisor_id) == $banco->id ? 'selected' : ''}}>
                    {{ $banco->nombre }} - {{ $banco->numero_cuenta }}
                </option>
            @endforeach
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('banco_emisor_id')"/>
    </div>
    <div>
        <x-input-label for="banco_receptor_id" :value="__('Banco Receptor Id')"/>
        <select id="banco_receptor_id" name="banco_receptor_id" class="form-control-select2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:bg-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full @error('banco_receptor_id') is-invalid @enderror" id="banco_receptor_id" style="height: 38px !important;">
            <option value="">{{ ('Seleccione un banco') }}</option>
            @foreach ($bancos as $banco)
                <option value="{{ $banco->id }}" {{ old('banco_receptor_id', $movimiento->banco_receptor_id) == $banco->id ? 'selected' : ''}}>
                    {{ $banco->nombre }} - {{ $banco->numero_cuenta }}
                </option>
            @endforeach
        </select>    
        <x-input-error class="mt-2" :messages="$errors->get('banco_receptor_id')"/>
    </div>
    <div>
        <x-input-label for="fecha" :value="__('Fecha')"/>
        <x-text-input id="fecha" name="fecha" type="datetime-local" class="mt-1 block w-full" :value="old('fecha', $movimiento && $movimiento->fecha ? $movimiento->fecha->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i'))" autocomplete="fecha" placeholder="Fecha"/>
        <x-input-error class="mt-2" :messages="$errors->get('fecha')"/>
    </div>
    <div>
        <x-input-label for="motivo" :value="__('Motivo')"/>
        <select id="motivo" name="motivo" class="mt-1 block w-full rounded border-gray-300" autocomplete="motivo">
            <option value="">Seleccione un motivo</option>
            @foreach ($opcionesMovimiento as $motivo => $nombre)
                <option value="{{ $motivo }}" {{ old('motivo', $movimiento?->motivo) == $motivo ? 'selected' : '' }}>
                    {{ $nombre }}
                </option>
            @endforeach
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('motivo')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Guardar</x-primary-button>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tipoSelect = document.getElementById('tipo_movimiento');
        const bancoEmisor = document.getElementById('banco_emisor_id');
        const bancoReceptor = document.getElementById('banco_receptor_id');

        function deshabilitarCampo(campo) {
            campo.value = '';
            campo.disabled = true;
            campo.classList.add('bg-gray-100', 'cursor-not-allowed');
            campo.classList.remove('bg-white', 'cursor-text');
        }

        function habilitarCampo(campo) {
            campo.disabled = false;
            campo.classList.remove('bg-gray-100', 'cursor-not-allowed');
            campo.classList.add('bg-white', 'cursor-text');
        }

        function actualizarCampos() {
            const tipo = tipoSelect.value;

            if (tipo === 'ingreso') {
                deshabilitarCampo(bancoEmisor);
                habilitarCampo(bancoReceptor);
            } else if (tipo === 'egreso') {
                habilitarCampo(bancoEmisor);
                deshabilitarCampo(bancoReceptor);
            } else if (tipo === 'transferencia') {
                habilitarCampo(bancoEmisor);
                habilitarCampo(bancoReceptor);
            } else {
                habilitarCampo(bancoEmisor);
                habilitarCampo(bancoReceptor);
            }
        }

        actualizarCampos();

        tipoSelect.addEventListener('change', actualizarCampos);
    });
</script>

