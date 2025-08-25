<div class="grid grid-cols-2 gap-6">
    <div>
        <x-input-label for="nombre" :value="__('Nombre')"/>
        <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" :value="old('nombre', $banco?->nombre)" autocomplete="nombre" placeholder="Nombre"/>
        <x-input-error class="mt-2" :messages="$errors->get('nombre')"/>
    </div>

    <div>
        <x-input-label for="tipo_cuenta" :value="__('Tipo de Cuenta')"/>
        <select id="tipo_cuenta" name="tipo_cuenta" class="mt-1 block w-full rounded border-gray-300" autocomplete="tipo_cuenta">
            <option value="">Seleccione</option>
            <option value="ahorro" {{  old('tipo_cuenta', $banco?->tipo_cuenta) == 'ahorro' ? 'selected' : '' }}>Ahorro</option>
            <option value="corriente" {{ old('tipo_cuenta', $banco?->tipo_cuenta) == 'corriente' ? 'selected' : '' }}>Corriente</option>
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('tipo_cuenta')"/>
    </div>

    <div>
        <x-input-label for="numero_cuenta" :value="__('Numero Cuenta')"/>
        <x-text-input id="numero_cuenta" name="numero_cuenta" type="text" class="mt-1 block w-full" :value="old('numero_cuenta', $banco?->numero_cuenta)" autocomplete="off" placeholder="Numero Cuenta" maxlength="20" pattern="\d{1,20}" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')"/>
        <x-input-error class="mt-2" :messages="$errors->get('numero_cuenta')"/>
    </div>

    <div>
        <x-input-label for="moneda" :value="__('Moneda')"/>
        <select id="moneda" name="moneda" class="mt-1 block w-full rounded border-gray-300" autocomplete="moneda">
            <option value="">Seleccione</option>
            <option value="dolares" {{ old('moneda', $banco?->moneda) == 'dolares' ? 'selected' : '' }}>Dolares</option>
            <option value="bolivares" {{ old('moneda', $banco->moneda) == 'bolivares' ? 'selected' : '' }}>Bolivares</option>
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('moneda')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Guardar</x-primary-button>
    </div>
</div>


