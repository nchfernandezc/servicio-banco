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
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <?php echo e(__('Panel de Administración')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Tarjetas con modales para acciones rápidas -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <button type="button" id="btn-open-modal-mov" 
                        class="md:col-span-2 bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow duration-200 flex flex-col items-center justify-center text-center w-full">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600 dark:bg-blue-800 dark:text-blue-200 mb-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Nueva Transacción</span>
                </button>
                <button type="button" id="btn-open-modal-reporte" 
                        class="md:col-span-2 bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow duration-200 flex flex-col items-center justify-center text-center w-full">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600 dark:bg-purple-800 dark:text-purple-200 mb-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Generar Reporte</span>
                </button>
            </div>

            <!-- Estadísticas de algunos datos del sistema -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Usuarios -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600 dark:bg-blue-800 dark:text-blue-200">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Usuarios</p>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-white"><?php echo e($totalUsers); ?></p>
                                <p class="text-xs <?php echo e($usersChange >= 0 ? 'text-green-500' : 'text-red-500'); ?> mt-1">
                                    <?php echo e($usersChange >= 0 ? '+' : ''); ?><?php echo e($usersChange); ?>% desde el mes pasado
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transacciones -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600 dark:bg-green-800 dark:text-green-200">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Transacciones</p>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-white"><?php echo e($totalTransactions); ?></p>
                                <p class="text-xs <?php echo e($transactionsChange >= 0 ? 'text-green-500' : 'text-red-500'); ?> mt-1">
                                    <?php echo e($transactionsChange >= 0 ? '+' : ''); ?><?php echo e($transactionsChange); ?>% desde el mes pasado
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Saldo Total -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 dark:bg-yellow-800 dark:text-yellow-200">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Saldo Total</p>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-white"><?php echo e(number_format($totalBalance, 2)); ?></p>
                                <p class="text-xs <?php echo e($balanceChange >= 0 ? 'text-green-500' : 'text-red-500'); ?> mt-1">
                                    <?php echo e($balanceChange >= 0 ? '+' : ''); ?><?php echo e($balanceChange); ?>% desde el mes pasado
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Bancos -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-indigo-100 text-indigo-600 dark:bg-indigo-800 dark:text-indigo-200">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0 0V4m0 3l-6-2m6 2v2m0 0h6m-6 0h-6" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Bancos</p>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-white"><?php echo e($totalBanks ?? '0'); ?></p>
                                <p class="text-xs <?php echo e($banksChange >= 0 ? 'text-green-500' : 'text-red-500'); ?> mt-1">
                                    <?php echo e($banksChange >= 0 ? '+' : ''); ?><?php echo e($banksChange); ?>% desde el mes pasado
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de gráficos -->
            <div class="grid grid-cols-1 gap-8 mb-8">
                <!-- Gráfico de Transacciones -->
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Transacciones Recientes</h3>
                    <div class="h-96">
                        <canvas id="transactionsChart"></canvas>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Gráfico de Saldos por Banco -->
                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Saldos por Banco</h3>
                        <div class="h-80">
                            <canvas id="banksChart"></canvas>
                        </div>
                    </div>

                    <!-- Gráfico de Distribución por Categoría -->
                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Distribución por Categoría</h3>
                        <div class="h-80">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla de movimientos recientes -->
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Actividad Reciente</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Usuario</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actividad</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Estado</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fecha</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                <?php $__currentLoopData = $recentMovements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300"><?php echo e($movement->user->email ?? 'Usuario desconocido'); ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                        <?php echo e($movement->motivo ?? 'Movimiento'); ?>

                                        <?php if($movement->tipo_movimiento === 'transferencia' && $movement->bancoEmisor && $movement->bancoReceptor): ?>
                                            <div class="mt-1 text-xs text-gray-400">
                                                <?php echo e($movement->bancoEmisor->nombre ?? 'Banco origen'); ?> → 
                                                <?php echo e($movement->bancoReceptor->nombre ?? 'Banco destino'); ?>

                                            </div>
                                        <?php elseif($movement->tipo_movimiento === 'ingreso' && $movement->bancoReceptor): ?>
                                            <div class="mt-1 text-xs text-gray-400">
                                                <?php echo e($movement->bancoReceptor->nombre ?? 'Cuenta destino'); ?>

                                            </div>
                                        <?php elseif($movement->bancoEmisor): ?>
                                            <div class="mt-1 text-xs text-gray-400">
                                                <?php echo e($movement->bancoEmisor->nombre ?? 'Cuenta origen'); ?>

                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            <?php if($movement->tipo_movimiento === 'ingreso'): ?>
                                                bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100
                                            <?php elseif($movement->tipo_movimiento === 'egreso'): ?>
                                                bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100
                                            <?php elseif($movement->tipo_movimiento === 'transferencia'): ?>
                                                bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100
                                            <?php else: ?>
                                                bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200
                                            <?php endif; ?>">
                                            <?php echo e(ucfirst($movement->tipo_movimiento)); ?>

                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400"><?php echo e($movement->created_at->diffForHumans()); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Nueva Transacción -->
    <div id="modal-mov" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/50" id="overlay-mov"></div>
        <div class="relative mx-auto mt-16 w-full max-w-2xl p-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Crear Movimiento</h3>
                    <button type="button" id="btn-close-modal-mov" class="text-gray-500 hover:text-gray-700 dark:text-gray-300">✕</button>
                </div>
                <form method="POST" action="<?php echo e(route('movimientos.store')); ?>" class="p-6 space-y-4">
                    <?php echo csrf_field(); ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipo de movimiento</label>
                            <select name="tipo_movimiento" id="tipo_movimiento" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="ingreso">Ingreso</option>
                                <option value="egreso">Egreso</option>
                                <option value="transferencia">Transferencia</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Monto</label>
                            <input type="number" step="0.01" min="0.01" name="monto" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                        </div>

                        <!-- Campo fecha con datetime-local para fecha y hora -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha y hora</label>
                            <input type="datetime-local" name="fecha" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Motivo (opcional)</label>
                            <input type="text" name="motivo" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" placeholder="Descripción o categoría">
                        </div>

                        <div id="field-banco-emisor" class="hidden">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Banco Emisor</label>
                            <select name="banco_emisor_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">Seleccione</option>
                                <?php $__currentLoopData = $bancos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($b->id); ?>"><?php echo e($b->nombre); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div id="field-banco-receptor" class="hidden">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Banco Receptor</label>
                            <select name="banco_receptor_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">Seleccione</option>
                                <?php $__currentLoopData = $bancos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($b->id); ?>"><?php echo e($b->nombre); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <button type="button" id="btn-cancel-mov" class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">Cancelar</button>
                        <button type="submit" class="px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal: Generar Reporte (Auditoría) -->
    <div id="modal-reporte" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/50" id="overlay-reporte"></div>
        <div class="relative mx-auto mt-16 w-full max-w-2xl p-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Generar Reporte de Auditoría</h3>
                    <button type="button" id="btn-close-modal-reporte" class="text-gray-500 hover:text-gray-700 dark:text-gray-300">✕</button>
                </div>
                <form id="form-reporte" method="GET" class="p-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Desde</label>
                            <input type="date" name="fecha_inicio" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Hasta</label>
                            <input type="date" name="fecha_fin" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipo de movimiento</label>
                            <select name="tipo_movimiento" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">Todos</option>
                                <option value="ingreso">Ingreso</option>
                                <option value="egreso">Egreso</option>
                                <option value="transferencia">Transferencia</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center justify-between gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <div class="text-xs text-gray-500 dark:text-gray-400">Usa los filtros para ver o descargar el reporte.</div>
                        <div class="flex gap-3">
                            <a id="btn-ver-reporte" href="<?php echo e(route('auditorias.reportes')); ?>" class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">Ver en pantalla</a>
                            <a id="btn-descargar-pdf" href="<?php echo e(route('auditorias.generar-reporte-pdf')); ?>" target="_blank" class="px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">Descargar PDF</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script>
        // Configuración global de gráficos
        Chart.defaults.font.family = 'Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif';
        Chart.defaults.plugins.legend.display = false;
        Chart.defaults.plugins.tooltip.backgroundColor = 'rgba(0, 0, 0, 0.8)';
        Chart.defaults.plugins.tooltip.padding = 10;
        Chart.defaults.plugins.tooltip.cornerRadius = 4;
        
        // Gráfico de Transacciones
        const transactionsChartEl = document.getElementById('transactionsChart');
        if (transactionsChartEl) {
            const transactionsCtx = transactionsChartEl.getContext('2d');
            const transactionsChart = new Chart(transactionsCtx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($transactionsData['labels'] ?? []); ?>,
                    datasets: [{
                        label: 'Transacciones',
                        data: <?php echo json_encode($transactionsData['data'] ?? []); ?>,
                        backgroundColor: 'rgba(79, 70, 229, 0.1)',
                        borderColor: 'rgba(79, 70, 229, 1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }

        // Gráfico de Distribución por Categoría
        const categoriesChartEl = document.getElementById('categoryChart');
        if (categoriesChartEl) {
            const categoriesCtx = categoriesChartEl.getContext('2d');
            const categoryData = <?php echo json_encode($categoryData ?? [], JSON_PRETTY_PRINT); ?>;
            
            if (categoryData.labels && categoryData.labels.length > 0) {
                new Chart(categoriesCtx, {
                    type: 'doughnut',
                    data: {
                        labels: categoryData.labels,
                        datasets: [{
                            data: categoryData.data,
                            backgroundColor: categoryData.colors || [
                                'rgba(99, 102, 241, 0.8)',
                                'rgba(16, 185, 129, 0.8)',
                                'rgba(245, 158, 11, 0.8)',
                                'rgba(239, 68, 68, 0.8)',
                                'rgba(139, 92, 246, 0.8)'
                            ],
                            borderWidth: 0,
                            cutout: '70%',
                            radius: '90%',
                            spacing: 5
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'right',
                                labels: {
                                    padding: 20,
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                    color: window.matchMedia('(prefers-color-scheme: dark)').matches ? '#E5E7EB' : '#4B5563'
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.raw || 0;
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = Math.round((value / total) * 100);
                                        return `${label}: ${categoryData.simbolo || ''}${value.toLocaleString()} (${percentage}%)`;
                                    }
                                }
                            }
                        }
                    }
                });
            } else {
                // Mostrar mensaje si no hay datos
                categoriesChartEl.parentElement.innerHTML = `
                    <div class="flex items-center justify-center h-full p-4 text-gray-500 dark:text-gray-400">
                        No hay datos de categorías disponibles
                    </div>
                `;
            }
        }

        // Gráfico de Saldos por Banco
        const banksChartEl = document.getElementById('banksChart');
        if (banksChartEl) {
            const banksCtx = banksChartEl.getContext('2d');
            const banksData = <?php echo json_encode($banksData ?? [], JSON_PRETTY_PRINT); ?>;
            
            if (Array.isArray(banksData) && banksData.length > 0) {
                new Chart(banksCtx, {
                    type: 'bar',
                    data: {
                        labels: banksData.map(bank => bank.nombre),
                        datasets: [{
                            label: 'Saldo',
                            data: banksData.map(bank => bank.saldo || 0),
                            backgroundColor: [
                                'rgba(79, 70, 229, 0.8)',
                                'rgba(99, 102, 241, 0.8)',
                                'rgba(129, 140, 248, 0.8)',
                                'rgba(165, 180, 252, 0.8)',
                                'rgba(199, 210, 254, 0.8)'
                            ],
                            borderColor: [
                                'rgba(79, 70, 229, 1)',
                                'rgba(99, 102, 241, 1)',
                                'rgba(129, 140, 248, 1)',
                                'rgba(165, 180, 252, 1)',
                                'rgba(199, 210, 254, 1)'
                            ],
                            borderWidth: 1,
                            borderRadius: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const bank = banksData[context.dataIndex];
                                        const symbol = bank?.simbolo || '';
                                        const saldo = bank?.saldo || 0;
                                        return `${bank?.nombre || 'Banco'}: ${symbol}${saldo.toLocaleString()}`;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    borderDash: [5, 5],
                                    drawBorder: false
                                },
                                ticks: {
                                    callback: function(value) {
                                        const symbol = banksData[0]?.simbolo || '';
                                        return `${symbol}${value.toLocaleString()}`;
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            } else {
                // Mostrar mensaje si no hay datos
                banksChartEl.parentElement.innerHTML = `
                    <div class="flex items-center justify-center h-full p-4 text-gray-500 dark:text-gray-400">
                        No hay datos de bancos disponibles
                    </div>
                `;
            }
        }
    
    </script>

    <script>
        
        document.addEventListener('DOMContentLoaded', function() {
            // --- Modal: Nueva Transacción ---
            const modalMov = document.getElementById('modal-mov');
            const btnOpenMov = document.getElementById('btn-open-modal-mov');
            const btnCloseMov = document.getElementById('btn-close-modal-mov');
            const btnCancelMov = document.getElementById('btn-cancel-mov');
            const overlayMov = document.getElementById('overlay-mov');

            const tipoMovimiento = document.getElementById('tipo_movimiento');
            const fieldEmisor = document.getElementById('field-banco-emisor');
            const fieldReceptor = document.getElementById('field-banco-receptor');

            function openModal(el) { el.classList.remove('hidden'); }
            function closeModal(el) { el.classList.add('hidden'); }

            if (btnOpenMov) btnOpenMov.addEventListener('click', () => openModal(modalMov));
            if (btnCloseMov) btnCloseMov.addEventListener('click', () => closeModal(modalMov));
            if (btnCancelMov) btnCancelMov.addEventListener('click', () => closeModal(modalMov));
            if (overlayMov) overlayMov.addEventListener('click', () => closeModal(modalMov));

            function toggleBankFields() {
                if (!tipoMovimiento) return;
                const v = tipoMovimiento.value;
                if (v === 'ingreso') {
                    fieldEmisor?.classList.add('hidden');
                    fieldReceptor?.classList.remove('hidden');
                } else if (v === 'egreso') {
                    fieldEmisor?.classList.remove('hidden');
                    fieldReceptor?.classList.add('hidden');
                } else if (v === 'transferencia') {
                    fieldEmisor?.classList.remove('hidden');
                    fieldReceptor?.classList.remove('hidden');
                }
            }
            if (tipoMovimiento) {
                tipoMovimiento.addEventListener('change', toggleBankFields);
                toggleBankFields();
            }

            // --- Modal: Reporte ---
            const modalRep = document.getElementById('modal-reporte');
            const btnOpenRep = document.getElementById('btn-open-modal-reporte');
            const btnCloseRep = document.getElementById('btn-close-modal-reporte');
            const overlayRep = document.getElementById('overlay-reporte');
            const btnVerReporte = document.getElementById('btn-ver-reporte');
            const btnDescargarPdf = document.getElementById('btn-descargar-pdf');
            const formReporte = document.getElementById('form-reporte');

            if (btnOpenRep) btnOpenRep.addEventListener('click', () => openModal(modalRep));
            if (btnCloseRep) btnCloseRep.addEventListener('click', () => closeModal(modalRep));
            if (overlayRep) overlayRep.addEventListener('click', () => closeModal(modalRep));

            function buildQueryFromForm() {
                const params = new URLSearchParams();
                const fi = formReporte?.querySelector('input[name="fecha_inicio"]')?.value;
                const ff = formReporte?.querySelector('input[name="fecha_fin"]')?.value;
                const tm = formReporte?.querySelector('select[name="tipo_movimiento"]')?.value;
                if (fi) params.append('fecha_inicio', fi);
                if (ff) params.append('fecha_fin', ff);
                if (tm) params.append('tipo_movimiento', tm);
                return params.toString();
            }

            if (btnVerReporte) {
                btnVerReporte.addEventListener('click', function(e) {
                    e.preventDefault();
                    const base = this.getAttribute('href');
                    const qs = buildQueryFromForm();
                    window.location.href = qs ? `${base}?${qs}` : base;
                });
            }

            if (btnDescargarPdf) {
                btnDescargarPdf.addEventListener('click', function(e) {
                    e.preventDefault();
                    const base = this.getAttribute('href');
                    const qs = buildQueryFromForm();
                    const url = qs ? `${base}?${qs}` : base;
                    window.open(url, '_blank');
                });
            }
        });

        $(document).ready(function(){
            $('#modal-mov form').on('submit', function(e){
                e.preventDefault();
                
                let form = $(this);
                let url = form.attr('action');
                let data = form.serialize();

                $.post(url, data)
                    .done(function(response) {
                        Swal.fire({
                            title: 'Dato guardado con exito',
                            confirmButtonText: 'Gracias!',
                        })
                        $('#modal-mov').addClass('hidden');
                        form.trigger('reset');
                        
                    })
                    .fail(function(xhr) {
                        alert('Error al crear movimiento. Revisa los datos.');
                    });
            });
        });

    </script>
    <?php $__env->stopPush(); ?>
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
<?php /**PATH C:\xampp\htdocs\aplicativo\new\app\resources\views/dashboard.blade.php ENDPATH**/ ?>