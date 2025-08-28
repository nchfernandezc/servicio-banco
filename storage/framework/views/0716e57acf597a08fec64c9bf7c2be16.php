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
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                <i class="fas fa-clipboard-check mr-2"></i><?php echo e(__('Detalles de Auditoría')); ?>

            </h2>
            <div class="flex space-x-2">
                <a href="<?php echo e(route('auditorias.index')); ?>" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-8">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900">Información General</h3>
                            <p class="mt-1 text-sm text-gray-600">Detalles del registro de auditoría.</p>
                        </div>
                    </div>

                    <div class="border-t border-gray-200">
                        <dl class="divide-y divide-gray-200">
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">ID de Movimiento</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    <span class="font-mono bg-gray-100 px-2 py-1 rounded">#<?php echo e($auditoria->movimiento_id); ?></span>
                                </dd>
                            </div>

                            <?php if($auditoria->movimiento): ?>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 bg-gray-50">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Tipo de Movimiento</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    <?php
                                        $typeClasses = [
                                            'ingreso' => 'bg-green-100 text-green-800',
                                            'egreso' => 'bg-red-100 text-red-800',
                                            'transferencia' => 'bg-blue-100 text-blue-800',
                                        ][$auditoria->movimiento->tipo_movimiento] ?? 'bg-gray-100 text-gray-800';
                                    ?>
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($typeClasses); ?>">
                                        <?php echo e(ucfirst($auditoria->movimiento->tipo_movimiento)); ?>

                                    </span>
                                </dd>
                            </div>

                            <?php if($auditoria->movimiento->bancoEmisor): ?>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Banco Origen</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    <div class="flex items-center">
                                        <i class="fas fa-university mr-2 text-indigo-500"></i>
                                        <span><?php echo e($auditoria->movimiento->bancoEmisor->nombre); ?></span>
                                        <span class="ml-2 text-xs text-gray-500">(<?php echo e($auditoria->movimiento->bancoEmisor->numero_cuenta); ?>)</span>
                                    </div>
                                </dd>
                            </div>
                            <?php endif; ?>

                            <?php if($auditoria->movimiento->bancoReceptor && $auditoria->movimiento->tipo_movimiento === 'transferencia'): ?>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 bg-gray-50">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Banco Destino</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    <div class="flex items-center">
                                        <i class="fas fa-university mr-2 text-green-500"></i>
                                        <span><?php echo e($auditoria->movimiento->bancoReceptor->nombre); ?></span>
                                        <span class="ml-2 text-xs text-gray-500">(<?php echo e($auditoria->movimiento->bancoReceptor->numero_cuenta); ?>)</span>
                                    </div>
                                </dd>
                            </div>
                            <?php endif; ?>
                            <?php endif; ?>

                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 bg-gray-50">
                                <dt class="text-sm font-medium text-gray-500 flex items-center">
                                    <i class="fas fa-wallet mr-2 text-blue-500"></i> Saldo Anterior
                                </dt>
                                <dd class="mt-1 flex items-center text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <span class="font-mono px-3 py-1 bg-blue-50 text-blue-900 rounded-md">
                                        <?php echo e(number_format($auditoria->saldo_anterior, 2)); ?>

                                    </span>
                                </dd>
                            </div>

                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500 flex items-center">
                                    <i class="fas fa-coins mr-2 text-green-500"></i> Nuevo Saldo
                                </dt>
                                <dd class="mt-1 flex items-center text-sm font-semibold text-green-700 sm:mt-0 sm:col-span-2">
                                    <span class="px-3 py-1 bg-green-50 text-green-900 rounded-md">
                                        <?php echo e(number_format($auditoria->saldo_nuevo, 2)); ?>

                                    </span>
                                    <?php
                                        $diferencia = $auditoria->saldo_nuevo - $auditoria->saldo_anterior;
                                        $esPositivo = $diferencia >= 0;
                                    ?>
                                    <span class="ml-3 px-2 py-1 text-xs font-medium rounded-full <?php echo e($esPositivo ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                                        <?php echo e($esPositivo ? '▲' : '▼'); ?> <?php echo e(number_format(abs($diferencia), 2)); ?>

                                    </span>
                                </dd>
                            </div>

                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 bg-gray-50 rounded-b-lg">
                                <dt class="text-sm font-medium text-gray-500 flex items-center">
                                    <i class="far fa-clock mr-2 text-purple-500"></i> Fecha de Registro
                                </dt>
                                <dd class="mt-1 flex items-center text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <i class="far fa-calendar-alt mr-2 text-purple-400"></i>
                                    <?php echo e(\Carbon\Carbon::parse($auditoria->fecha_registro)->format('d/m/Y H:i:s')); ?>

                                    <span class="ml-2 text-xs text-gray-500">
                                        (<?php echo e(\Carbon\Carbon::parse($auditoria->fecha_registro)->diffForHumans()); ?>)
                                    </span>
                                </dd>
                            </div>

                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 bg-gray-50">
                                <dt class="text-sm font-medium text-gray-500 flex items-center">
                                    <i class="fas fa-user mr-2 text-blue-500"></i> Realizado por
                                </dt>
                                <dd class="mt-1 flex items-center text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <span class="px-3 py-1 bg-yellow-50 text-yellow-900 font-bold rounded-md">
                                        <?php echo e($auditoria->movimiento->user->name ?? 'Usuario desconocido'); ?>

                                    </span>
                                </dd>
                            </div>

                        </dl>
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
<?php /**PATH C:\xampp\htdocs\aplicativo\new\app\resources\views/auditoria/show.blade.php ENDPATH**/ ?>