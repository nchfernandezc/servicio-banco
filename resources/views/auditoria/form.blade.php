<div class="space-y-6">
    
    <div>
        <x-input-label for="movimiento_id" :value="__('Movimiento Id')"/>
        <x-text-input id="movimiento_id" name="movimiento_id" type="text" class="mt-1 block w-full" :value="old('movimiento_id', $auditoria?->movimiento_id)" autocomplete="movimiento_id" placeholder="Movimiento Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('movimiento_id')"/>
    </div>
    <div>
        <x-input-label for="saldo_anterior" :value="__('Saldo Anterior')"/>
        <x-text-input id="saldo_anterior" name="saldo_anterior" type="text" class="mt-1 block w-full" :value="old('saldo_anterior', $auditoria?->saldo_anterior)" autocomplete="saldo_anterior" placeholder="Saldo Anterior"/>
        <x-input-error class="mt-2" :messages="$errors->get('saldo_anterior')"/>
    </div>
    <div>
        <x-input-label for="saldo_nuevo" :value="__('Saldo Nuevo')"/>
        <x-text-input id="saldo_nuevo" name="saldo_nuevo" type="text" class="mt-1 block w-full" :value="old('saldo_nuevo', $auditoria?->saldo_nuevo)" autocomplete="saldo_nuevo" placeholder="Saldo Nuevo"/>
        <x-input-error class="mt-2" :messages="$errors->get('saldo_nuevo')"/>
    </div>
    <div>
        <x-input-label for="fecha_registro" :value="__('Fecha Registro')"/>
        <x-text-input id="fecha_registro" name="fecha_registro" type="text" class="mt-1 block w-full" :value="old('fecha_registro', $auditoria?->fecha_registro)" autocomplete="fecha_registro" placeholder="Fecha Registro"/>
        <x-input-error class="mt-2" :messages="$errors->get('fecha_registro')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>