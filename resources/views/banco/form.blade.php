@php
    $bancosVenezuela = [
        '0102' => 'Banco de Venezuela',
        '0104' => 'Venezolano de Crédito',
        '0105' => 'Banco Mercantil',
        '0108' => 'Banco Provincial',
        '0114' => 'Bancaribe',
        '0115' => 'Banco Exterior',
        '0128' => 'Banco Caroní',
        '0134' => 'Banesco',
        '0137' => 'Banco Sofitasa',
        '0138' => 'Banco Plaza',
        '0146' => 'Banco de la Gente Emprendedora',
        '0151' => 'BFC Banco Fondo Común',
        '0156' => '100% Banco',
        '0157' => 'DelSur',
        '0163' => 'Banco del Tesoro',
        '0166' => 'Banco Agrícola de Venezuela',
        '0168' => 'Bancrecer',
        '0169' => 'Mi Banco',
        '0171' => 'Banco Activo',
        '0172' => 'Bancamiga',
        '0174' => 'Banplus',
        '0175' => 'Bicentenario Banco',
        '0177' => 'Banfanb',
        '0191' => 'BNC Nacional de Crédito',
        '0601' => 'Instituto Municipal de Crédito Popular',
    ];
@endphp

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
            <option value="bolivares" {{ old('moneda', $banco?->moneda) == 'bolivares' ? 'selected' : '' }}>Bolivares</option>
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('moneda')"/>
    </div>

    <div>
        <x-input-label for="cuenta_banco" :value="__('Banco')"/>
        <select id="cuenta_banco" name="cuenta_banco" class="mt-1 block w-full rounded border-gray-300" autocomplete="cuenta_banco">
            <option value="">Seleccione un banco</option>
            @foreach($bancosVenezuela as $codigo => $nombre)
                <option value="{{ $codigo }}" {{ old('cuenta_banco', $banco?->cuenta_banco) == $codigo ? 'selected' : '' }}>
                    {{ $nombre }}
                </option>
            @endforeach
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('cuenta_banco')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Guardar</x-primary-button>
    </div>
</div>


