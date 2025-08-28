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
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Movimientos')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="w-full">
                <div class="sm:flex sm:items-center justify-between">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900"><?php echo e(__('Movimientos')); ?></h1>
                        <p class="mt-2 text-sm text-gray-700">Lista de <?php echo e(__('Movimientos')); ?>.</p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <a href="<?php echo e(route('movimientos.create')); ?>" 
                           class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm 
                                  hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                                  focus-visible:outline-indigo-600">
                            <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('typ-plus'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4 m-1 inline-block']); ?>
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
                            Agregar nuevo
                        </a>
                    </div>
                </div>

                <div class="py-12 bg-white shadow sm:rounded-lg p-8 max-w-full">
                    <div class="mb-6 flex space-x-4">
                        <button id="btn-ingresos" class="px-4 py-2 bg-indigo-600 text-white rounded font-semibold">Ingresos</button>
                        <button id="btn-egresos" class="px-4 py-2 bg-gray-300 text-gray-700 rounded font-semibold">Egresos</button>
                        <button id="btn-transferencias" class="px-4 py-2 bg-gray-300 text-gray-700 rounded font-semibold">Transferencias</button>
                    </div>

                    <!-- Tabla Ingresos -->
                    <div id="tabla-ingresos">
                        <h1 class="text-lg font-semibold mb-4">Ingresos</h1>
                        <div class="overflow-x-auto">
                            <table class="w-full divide-y divide-gray-300 table-auto">
                                <thead>
                                    <tr>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">No</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Tipo Movimiento</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Monto</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Banco Receptor</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Fecha</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Motivo</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                <?php $i = ($ingresos->currentPage() - 1) * $ingresos->perPage(); ?>
                                <?php $__currentLoopData = $ingresos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movimiento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="even:bg-gray-50">
                                        <td class="px-3 py-2 text-sm font-semibold text-gray-900"><?php echo e(++$i); ?></td>
                                        <td class="px-3 py-2 text-sm text-gray-500"><?php echo e(ucfirst($movimiento->tipo_movimiento)); ?></td>
                                        <td class="px-3 py-2 text-sm text-gray-500"><?php echo e($movimiento->monto); ?></td>
                                        <td class="px-3 py-2 text-sm text-gray-500"><?php echo e($movimiento->bancoReceptor->nombre); ?></td>
                                        <td class="px-3 py-2 text-sm text-gray-500"><?php echo e($movimiento->fecha); ?></td>
                                        <td class="px-3 py-2 text-sm text-gray-500"><?php echo e($movimiento->motivo); ?></td>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900">
                                            <a href="<?php echo e(route('movimientos.show', $movimiento->id)); ?>" class="text-gray-600 font-bold hover:text-gray-900 mr-2">
                                                <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('bx-show'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4 mr-1 inline-block']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?> <?php echo e(__('Show')); ?>

                                            </a>
                                            <a href="<?php echo e(route('movimientos.edit', $movimiento->id)); ?>" class="text-indigo-600 font-bold hover:text-indigo-900 mr-2">
                                                <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('feathericon-edit'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4 mr-1 inline-block']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?> <?php echo e(__('Edit')); ?>

                                            </a>
                                            <form action="<?php echo e(route('movimientos.destroy', $movimiento->id)); ?>" method="POST" class="form-delete" style="display:inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="text-red-600 font-bold hover:text-red-900 mr-2">
                                                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('monoicon-delete'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4 mr-1 inline-block']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?> <?php echo e(__('Delete')); ?>

                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4"><?php echo e($ingresos->links()); ?></div>
                    </div>

                    <!-- Tabla Egresos -->
                    <div id="tabla-egresos" class="hidden">
                        <h1 class="text-lg font-semibold mb-4">Egresos</h1>
                        <div class="overflow-x-auto">
                            <table class="w-full divide-y divide-gray-300 table-auto">
                                <thead>
                                    <tr>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">No</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Tipo Movimiento</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Monto</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Banco Emisor</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Fecha</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Motivo</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                <?php $i = ($egresos->currentPage() - 1) * $egresos->perPage(); ?>
                                <?php $__currentLoopData = $egresos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movimiento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="even:bg-gray-50">
                                        <td class="px-3 py-2 text-sm font-semibold text-gray-900"><?php echo e(++$i); ?></td>
                                        <td class="px-3 py-2 text-sm text-gray-500"><?php echo e(ucfirst($movimiento->tipo_movimiento)); ?></td>
                                        <td class="px-3 py-2 text-sm text-gray-500"><?php echo e($movimiento->monto); ?></td>
                                        <td class="px-3 py-2 text-sm text-gray-500"><?php echo e($movimiento->bancoEmisor->nombre); ?></td>
                                        <td class="px-3 py-2 text-sm text-gray-500"><?php echo e($movimiento->fecha); ?></td>
                                        <td class="px-3 py-2 text-sm text-gray-500"><?php echo e($movimiento->motivo); ?></td>
                                        <td class="px-3 py-2 text-sm font-medium text-gray-900">
                                            <a href="<?php echo e(route('movimientos.show', $movimiento->id)); ?>" class="text-gray-600 hover:text-gray-900 mr-2"><?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('bx-show'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4 m-1 inline-block']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>Show</a>
                                            <a href="<?php echo e(route('movimientos.edit', $movimiento->id)); ?>" class="text-indigo-600 hover:text-indigo-900 mr-2"><?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('feathericon-edit'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4 m-1 inline-block']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>Edit</a>
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <form action="<?php echo e(route('movimientos.destroy', $movimiento->id)); ?>" method="POST" class="form-delete" style="display:inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="text-red-600 font-bold hover:text-red-900 mr-2">
                                                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('monoicon-delete'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4 mr-1 inline-block']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?> <?php echo e(__('Delete')); ?>

                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4"><?php echo e($egresos->links()); ?></div>
                    </div>

                    <!-- Tabla Transferencias -->
                    <div id="tabla-transferencias" class="hidden">
                        <h1 class="text-lg font-semibold mb-4">Transferencias</h1>
                        <div class="overflow-x-auto">
                            <table class="w-full divide-y divide-gray-300 table-auto">
                                <thead>
                                    <tr>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">No</th>
                                        <!--<th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Tipo Movimiento</th> !-->
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Monto</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Banco Emisor</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Banco Receptor</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Fecha</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Motivo</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                <?php $i = ($transferencias->currentPage() - 1) * $transferencias->perPage(); ?>
                                <?php $__currentLoopData = $transferencias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movimiento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="even:bg-gray-50">
                                        <td class="px-3 py-2 text-sm font-semibold text-gray-900"><?php echo e(++$i); ?></td>
                                        <!-- <td class="px-3 py-2 text-sm text-gray-500"><?php echo e(ucfirst($movimiento->tipo_movimiento)); ?></td> !-->
                                        <td class="px-3 py-2 text-sm text-gray-500"><?php echo e($movimiento->monto); ?></td>
                                        <td class="px-3 py-2 text-sm text-gray-500"><?php echo e($movimiento->bancoEmisor->nombre); ?></td>
                                        <td class="px-3 py-2 text-sm text-gray-500"><?php echo e($movimiento->bancoReceptor->nombre); ?></td>
                                        <td class="px-3 py-2 text-sm text-gray-500"><?php echo e($movimiento->fecha); ?></td>
                                        <td class="px-3 py-2 text-sm text-gray-500"><?php echo e($movimiento->motivo); ?></td>
                                        <td class="px-3 py-2 text-sm font-medium text-gray-900">
                                            <a href="<?php echo e(route('movimientos.show', $movimiento->id)); ?>" class="text-gray-600 hover:text-gray-900 mr-2"><?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('bx-show'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4 m-1 inline-block']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>Show</a>
                                            <a href="<?php echo e(route('movimientos.edit', $movimiento->id)); ?>" class="text-indigo-600 hover:text-indigo-900 mr-2"><?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('feathericon-edit'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4 m-1 inline-block']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>Edit</a>
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <form action="<?php echo e(route('movimientos.destroy', $movimiento->id)); ?>" method="POST" class="form-delete" style="display:inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="text-red-600 font-bold hover:text-red-900 mr-2">
                                                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('monoicon-delete'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4 mr-1 inline-block']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?> <?php echo e(__('Delete')); ?>

                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4"><?php echo e($transferencias->links()); ?></div>
                    </div>
                </div>
            </div>
        </div> 
    </div> 

    <script>
        const btnIngresos = document.getElementById('btn-ingresos');
        const btnEgresos = document.getElementById('btn-egresos');
        const btnTransferencias = document.getElementById('btn-transferencias');
        const tablaIngresos = document.getElementById('tabla-ingresos');
        const tablaEgresos = document.getElementById('tabla-egresos');
        const tablaTransferencias = document.getElementById('tabla-transferencias');

        function resetButtons() {
            btnIngresos.classList.remove('bg-indigo-600', 'text-white');
            btnIngresos.classList.add('bg-gray-300', 'text-gray-700');
            btnEgresos.classList.remove('bg-indigo-600', 'text-white');
            btnEgresos.classList.add('bg-gray-300', 'text-gray-700');
            btnTransferencias.classList.remove('bg-indigo-600', 'text-white');
            btnTransferencias.classList.add('bg-gray-300', 'text-gray-700');
        }

        btnIngresos.addEventListener('click', () => {
            tablaIngresos.classList.remove('hidden');
            tablaEgresos.classList.add('hidden');
            tablaTransferencias.classList.add('hidden');
            resetButtons();
            btnIngresos.classList.remove('bg-gray-300', 'text-gray-700');
            btnIngresos.classList.add('bg-indigo-600', 'text-white');
        });

        btnEgresos.addEventListener('click', () => {
            tablaIngresos.classList.add('hidden');
            tablaEgresos.classList.remove('hidden');
            tablaTransferencias.classList.add('hidden');
            resetButtons();
            btnEgresos.classList.remove('bg-gray-300', 'text-gray-700');
            btnEgresos.classList.add('bg-indigo-600', 'text-white');
        });

        btnTransferencias.addEventListener('click', () => {
            tablaIngresos.classList.add('hidden');
            tablaEgresos.classList.add('hidden');
            tablaTransferencias.classList.remove('hidden');
            resetButtons();
            btnTransferencias.classList.remove('bg-gray-300', 'text-gray-700');
            btnTransferencias.classList.add('bg-indigo-600', 'text-white');
        });
    </script>
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
<?php /**PATH C:\xampp\htdocs\aplicativo\new\app\resources\views/movimiento/index.blade.php ENDPATH**/ ?>