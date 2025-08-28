<?php
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
    
    // Get bank information based on movement type
    if ($movimiento->tipo_movimiento === 'ingreso') {
        $banco = $movimiento->bancoReceptor;
        $bancoNombre = $banco->nombre ?? 'Banco no especificado';
        $bancoCodigo = $banco->cuenta_banco ?? null;
    } else {
        $banco = $movimiento->bancoEmisor;
        $bancoNombre = $banco->nombre ?? 'Banco no especificado';
        $bancoCodigo = $banco->cuenta_banco ?? null;
    }
    
    $bancoInfo = $bancoCodigo ? ($bancosVenezuela[$bancoCodigo] ?? $bancoNombre) : $bancoNombre;
    
    // Get currency symbol
    $symbol = match($banco->moneda ?? '') {
        'dolares' => '$',
        'euro' => '€',
        default => 'Bs.'
    };
    
    // Format date
    $fecha = \Carbon\Carbon::parse($movimiento->fecha)->format('d/m/Y');
    
    // Movement type display
    $tipoDisplay = [
        'ingreso' => 'Ingreso',
        'egreso' => 'Egreso',
        'transferencia' => 'Transferencia'
    ][$movimiento->tipo_movimiento] ?? ucfirst($movimiento->tipo_movimiento);
    
    $tipoColor = [
        'ingreso' => 'text-green-600 bg-green-100 dark:bg-green-900 dark:text-green-100',
        'egreso' => 'text-red-600 bg-red-100 dark:bg-red-900 dark:text-red-100',
        'transferencia' => 'text-blue-600 bg-blue-100 dark:bg-blue-900 dark:text-blue-100'
    ][$movimiento->tipo_movimiento] ?? 'bg-gray-100 dark:bg-gray-700';
?>

<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Detalles del Movimiento
            </h2>
            <div class="flex space-x-2">
                <a href="<?php echo e(route('movimientos.edit', $movimiento)); ?>" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <?php echo e(__('Editar')); ?>

                </a>
                <a href="<?php echo e(route('movimientos.index')); ?>" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('letsicon-back'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4 mr-1']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
                    <?php echo e(__('Volver')); ?>

                </a>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Resumen del Movimiento -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                Movimiento #<?php echo e($movimiento->id); ?>

                            </h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Registrado el <?php echo e($fecha); ?>

                            </p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium <?php echo e($tipoColor); ?>">
                            <?php echo e($tipoDisplay); ?>

                        </span>
                    </div>

                    
                    <div class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Monto -->
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Monto</p>
                                <p class="mt-1 text-2xl font-semibold <?php echo e($movimiento->tipo_movimiento === 'ingreso' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400'); ?>">
                                    <?php echo e($movimiento->tipo_movimiento === 'ingreso' ? '+' : '-'); ?><?php echo e($symbol); ?> <?php echo e(number_format($movimiento->monto, 2, ',', '.')); ?>

                                </p>
                            </div>

                            <!-- Banco -->
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                    <?php echo e($movimiento->tipo_movimiento === 'ingreso' ? 'Banco Receptor' : 'Banco Emisor'); ?>

                                </p>
                                <div class="mt-1 flex items-center">
                                    <div class="p-2 bg-indigo-100 dark:bg-indigo-900 rounded-lg mr-3">
                                        <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a2 2 0 002-2V8a2 2 0 00-2-2H6a2 2 0 00-2 2v9a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white"><?php echo e($bancoNombre); ?></p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400"><?php echo e($bancoInfo); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Detalles Adicionales -->
                        <div class="mt-6 space-y-4">
                            <?php if($movimiento->tipo_movimiento === 'transferencia'): ?>
                            <div class="flex justify-between py-3 border-b border-gray-200 dark:border-gray-700">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Banco Destino</p>
                                <p class="text-sm text-gray-900 dark:text-white">
                                    <?php echo e($movimiento->bancoReceptor->nombre ?? 'No especificado'); ?>

                                </p>
                            </div>
                            <?php endif; ?>

                            <?php if($movimiento->motivo): ?>
                            <div class="py-3 border-b border-gray-200 dark:border-gray-700">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Motivo</p>
                                <p class="text-gray-900 dark:text-white"><?php echo e($movimiento->motivo); ?></p>
                            </div>
                            <?php endif; ?>

                            <?php if($movimiento->descripcion): ?>
                            <div class="py-3">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Descripción</p>
                                <p class="text-gray-900 dark:text-white"><?php echo e($movimiento->descripcion); ?></p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\aplicativo\new\app\resources\views/movimiento/show.blade.php ENDPATH**/ ?>