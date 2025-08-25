<div class="grid grid-cols-3 gap-6">
    <div>
        <x-input-label for="banco_id" :value="__('Banco Id')"/>
        <select id="banco_id" name="banco_id" class="form-control select2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:bg-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full @error('banco_id') is-invalid @enderror" style="height: 38px !important;">
            <option value="">{{ __('Seleccione un banco') }}</option>
            @foreach ($bancos as $banco)
                <option value="{{ $banco->id }}" 
                    {{ old('banco_id', $banco_id ?? $balance->banco_id) == $banco->id ? 'selected' : '' }}>
                    {{ $banco->nombre }} - {{ $banco->numero_cuenta }}
                </option>
            @endforeach
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('banco_id')"/>
    </div>
    <div>
        <x-input-label for="monto_actual" :value="__('Monto Actual')"/>
        <x-text-input id="monto_actual" name="monto_actual" type="text" class="mt-1 block w-full" :value="old('monto_actual', $balance?->monto_actual)" autocomplete="monto_actual" placeholder="Monto Actual"/>
        <x-input-error class="mt-2" :messages="$errors->get('monto_actual')"/>
    </div>
    <div>
        <x-input-label for="ult_modificacion" :value="__('Ult Modificacion')"/>
        <x-text-input id="ult_modificacion" name="ult_modificacion" type="datetime-local" class="mt-1 block w-full" :value="old('ult_modificacion', $balance?->ult_modificacion)" autocomplete="ult_modificacion" placeholder="Ult Modificacion"/>
        <x-input-error class="mt-2" :messages="$errors->get('ult_modificacion')"/>
    </div>
    <div class="flex items-center gap-4">
        <x-primary-button>Guardar</x-primary-button>
    </div>
</div>
