<?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout.default','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layout.default'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<div>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="<?php echo e(route('invoices.index')); ?>" class="text-primary hover:underline"> Invoices</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Edit</span>
        </li>
    </ul>
    <div class="pt-5" x-data="data">        
        <form class="space-y-5" action="<?php echo e(route('invoices.update', ['invoice'=>$invoice->id])); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Edit Invoices</h5>
                </div>               
                <div class="grid grid-cols-4 gap-4 mb-4">    
                    <div>     
                        <label>Invoice No:</label>
                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['class' => 'form-input disabled:bg-[#eee] cursor-not-allowed','name' => 'invoice_no','disabled' => true,'value' => ''.e($invoice->invoice_no).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'form-input disabled:bg-[#eee] cursor-not-allowed','name' => 'invoice_no','disabled' => true,'value' => ''.e($invoice->invoice_no).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>                       
                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('invoice_no'),'class' => 'mt-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('invoice_no')),'class' => 'mt-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                    </div> 
                    <div>
                        <label>Invoice Date:</label>
                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['class' => 'form-input','id' => 'invoice_date','name' => 'invoice_date','value' => ''.e($invoice->invoice_date).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'form-input','id' => 'invoice_date','name' => 'invoice_date','value' => ''.e($invoice->invoice_date).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>       
                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('invoice_date'),'class' => 'mt-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('invoice_date')),'class' => 'mt-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>       
                    </div>
                    <div>
                        <label>Client:</label>
                        <select class="form-select" name="client_id">
                            <option>Select Client</option>
                            <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($client->id); ?>"  
                                <?php echo e($client->id ? ($client->id == $invoice->client_id ? 'selected' : '') : ''); ?>> <?php echo e($client->client_name); ?> </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('client_id'),'class' => 'mt-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('client_id')),'class' => 'mt-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?> 
                    </div>
                    <div>
                        <label>Status:</label>
                        <select class="form-select" name="status">
                            <option selected disabled>Select Status</option>
                            <option value="draft" <?php if($invoice->status == 'draft'): ?> <?php echo e('Selected'); ?> <?php endif; ?>>Draft</option>
                            <option value="confirm" <?php if($invoice->status == 'confirm'): ?> <?php echo e('Selected'); ?> <?php endif; ?>>Confirm</option> 
                            <option value="cancel" <?php if($invoice->status == 'cancel'): ?> <?php echo e('Selected'); ?> <?php endif; ?>>Cancel</option>      
                        </select>
                    </div>
                </div>
            </div>
            <div class="panel table-responsive">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light"> Add Services</h5>
                </div>
                <div x-data="InvoiceDetails">
                    <div class="flex xl:flex-row flex-col gap-2.5">
                        <div class="panel px-0 flex-1 py-1 ltr:xl:mr-6 rtl:xl:ml-6">
                            <div class="mt-8">
                                <template x-if="invoiceDetails">
                                <div class="table-responsive">
                                        <table class="table-hover">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Service</th>
                                                    <th>Cost</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <template x-if="invoiceDetails.length <= 0">
                                                    <tr >
                                                        <td colspan="5" class="!text-center font-semibold">No Data Available
                                                        </td>
                                                    </tr>
                                                </template>
                                                <template x-for="(invoiceDetail, i) in invoiceDetails" :key="i">
                                                    <tr>
                                                        <td>
                                                            <button type="button" @click="removeItem(invoiceDetail)">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                    height="24px" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="w-5 h-5">
                                                                    <line x1="18" y1="6" x2="6"
                                                                        y2="18"></line>
                                                                    <line x1="6" y1="6" x2="18"
                                                                        y2="18"></line>
                                                                </svg>
                                                            </button>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" class="form-input min-w-[200px]" x-model="invoiceDetail.id" x-bind:name="`invoice_details[${invoiceDetail.i}][id]`"/>
                                                            <select class="form-input" id="service_id" name="service_id" x-model="invoiceDetail.service_id" x-bind:name="`invoice_details[${invoiceDetail.id}][service_id]`"  x-on:change="serviceChange()">
                                                                <option>Select Service</option>
                                                                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($service->id); ?>"
                                                                        <?php echo e($service->id ? ($service->id == $invoice->service_id ? 'selected' : '') : ''); ?>> <?php echo e($service->service); ?> </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.amount-input','data' => ['id' => 'cost','class' => 'form-input','xBind:name' => '`invoice_details[${invoiceDetail.id}][cost]`','xModel' => 'invoiceDetail.cost']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('amount-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'cost','class' => 'form-input','x-bind:name' => '`invoice_details[${invoiceDetail.id}][cost]`','x-model' => 'invoiceDetail.cost']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                                        </td>
                                                    </tr>
                                                </template>
                                                <tr>
                                                    <td>
                                                        <button type="button" class="btn btn-info" @click.prevent="addItem()">Add </button>
                                                    </td>
                                                </tr>
                                            </tbody>   
                                            <tfoot x-data="calc()" style="background-color: #FFFFF;">
                                                <tr>
                                                    <th colspan="2" style="text-align:right;">Total Cost: </th>
                                                    <td>
                                                        <!-- footer calculations -->
                                                        <!-- <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.amount-input','data' => ['@input' => 'update_igst','class' => 'form-input','xModel' => 'total_cost','id' => 'total_cost','name' => 'total_cost']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('amount-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['@input' => 'update_igst','class' => 'form-input','x-model' => 'total_cost','id' => 'total_cost','name' => 'total_cost']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?> -->
                                                        <!-- dynamically cost calculations -->
                                                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.amount-input','data' => ['@input' => 'update_igst','class' => 'form-input','xModel' => 'calculateTotal','id' => 'total_cost','name' => 'total_cost','readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('amount-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['@input' => 'update_igst','class' => 'form-input','x-model' => 'calculateTotal','id' => 'total_cost','name' => 'total_cost','readonly' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr >
                                                    <th colspan="2" style="text-align:right">Discount: </th>
                                                    <td><?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.amount-input','data' => ['@input' => 'update_igst','class' => 'form-input','xModel' => 'dis_amt','id' => 'dis_amt','name' => 'dis_amt']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('amount-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['@input' => 'update_igst','class' => 'form-input','x-model' => 'dis_amt','id' => 'dis_amt','name' => 'dis_amt']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?></td>
                                                </tr>                                                
                                                <tr>
                                                    <th colspan="2" style="text-align:right">IGST Amount (10%):</th>
                                                    <td><?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.amount-input','data' => ['class' => 'form-input','xText' => 'igst_amt','name' => 'igst_amt','xModel' => 'igst_amt']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('amount-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'form-input','x-text' => 'igst_amt','name' => 'igst_amt','x-model' => 'igst_amt']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="2" style="text-align:right">Total Amount: </th>
                                                    <td><?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.amount-input','data' => ['class' => 'form-input','xModel' => 'total_amt','xText' => 'total_amt','name' => 'total_amt']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('amount-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'form-input','x-model' => 'total_amt','x-text' => 'total_amt','name' => 'total_amt']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?></td>
                                                </tr>
                                            </tfoot>                                         
                                        </table>
                                    </div>
                                </template>                                                
                            </div>                            
                        </div>                    
                    </div>
                </div>                
            </div>  
            <div class="flex justify-end mt-4">
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.success-button','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('success-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                    <?php echo e(__('Submit')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                &nbsp;&nbsp;
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cancel-button','data' => ['link' => route('invoices.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cancel-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('invoices.index'))]); ?>
                    <?php echo e(__('Cancel')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            </div>
        </form> 
    </div>
</div> 
<script>
    //calculations of total amount
    function calc() {        
        return {            
            total_cost: '',
            dis_amt: '',
            igst_amt: '',
            total_amt: '',
            
            getTotalCost() {
             return (this.total_cost === "") ? 0 : parseFloat(this.total_cost);
            },
            
            getDiscountAmount() {
             return (this.dis_amt === "") ? 0 : parseFloat(this.dis_amt);
            },
            
            update_igst() { 
                this.igst_amt = ((this.getTotalCost() - this.getDiscountAmount()) * 10 / 100);
                this.total_amt = this.getTotalCost() + this.igst_amt;
            },            
        }
    }
    document.addEventListener("alpine:init", () => {
        Alpine.data('data', () => ({
            //for getting cost on selection of service
            service_id: '',
            cost: '',
            async serviceChange() {               
                this.invoiceDetail.cost = await (await fetch('/services/'+ this.invoiceDetail.service_id, {
                method: 'GET',
                headers: {
                    'Content-type': 'application/json;',
                },
                })).json();
                console.log(this.invoiceDetail.cost);
            },

            service_id: '',
            cost: '',            
            init() {
                this.open = false;
                flatpickr(document.getElementById('invoice_date'), {
                    dateFormat: 'd/m/Y',
                });

                <?php if($invoice->service_id): ?>
                this.service_id = <?php echo e($invoice->service_id); ?>;
                this.serviceChange();
                <?php endif; ?>

                <?php if($invoice->cost): ?>
                this.cost = <?php echo e($invoice->cost); ?>;
                <?php endif; ?>
            },
                        
        }));

        Alpine.data('InvoiceDetails', () => ({
            invoiceDetails: [],
            init() {                    
                let maxId = 0; 
                id='';
                <?php if($invoice['InvoiceDetails']): ?>
                <?php $__currentLoopData = $invoice['InvoiceDetails']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                this.invoiceDetails.push({
                    i: ++maxId,
                    id: '<?php echo e($details->id); ?>',
                    service_id: '<?php echo e($details->service_id); ?>',
                    cost: '<?php echo e($details->cost); ?>',
                });                    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            }, 
            addItem() {
                let maxId = 0;
                if (this.invoiceDetails && this.invoiceDetails.length) {
                    maxId = this.invoiceDetails.reduce((max, character) => (character.id > max ? character
                        .id : max), this.invoiceDetails[0].id);
                }
                this.invoiceDetails.push({
                    id: maxId + 1,
                    service_id: '',
                    cost: '',
                });
            }, 
            
            calculateTotal() {
                let total = 0;
                this.invoiceDetails.forEach(invoiceDetail => {
                    total += parseFloat(invoiceDetail.cost)
                })                
                return total.toFixed(2);
            },
                        
            removeItem(invoiceDetail) {
                this.invoiceDetails = this.invoiceDetails.filter((d) => d.id != invoiceDetail.id);
            }
        }));
    });
</script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
<?php /**PATH C:\Users\HP\Project\TeamPulse\resources\views/invoices/edit.blade.php ENDPATH**/ ?>