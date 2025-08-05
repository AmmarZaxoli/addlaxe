<div>
    <h5>تعديل الفاتورة رقم: <?php echo e($invoice->num_invoice); ?></h5>

    <!--[if BLOCK]><![endif]--><?php if(session()->has('success')): ?>
        <div class="alert alert-success my-2"><?php echo e(session('success')); ?></div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>الاسم</th>
                <th>الباركود</th>
                <th>الكمية</th>
                <th>سعر الشراء</th>
                <th>سعر البيع</th>
                <th>الربح</th>
                <th>تاريخ الانتهاء</th>
            </tr>
        </thead>
        <tbody>
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><input type="text" readonly class="form-control" value="<?php echo e($product['name']); ?>"></td>
                    <td><?php echo e($product['barcode']); ?></td>
                    <td><input type="number" min="1" wire:model.live="products.<?php echo e($index); ?>.quantity" class="form-control"></td>
                    <td><input type="number" step="0.01" wire:model.live="products.<?php echo e($index); ?>.buy_price" class="form-control"></td>
                    <td><input type="number" step="0.01" wire:model.live="products.<?php echo e($index); ?>.sell_price" class="form-control"></td>
                    <td><input type="date" wire:model.live="products.<?php echo e($index); ?>.dateex" class="form-control"></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        </tbody>
    </table>

    <div class="row mt-3">
        <div class="col-md-3">
            <label>السعر الكلي</label>
            <input type="text" readonly class="form-control" value="<?php echo e(number_format($this->totalPrice)); ?>">
        </div>
        <div class="col-md-3">
            <label>الخصم (%)</label>
            <input type="number" wire:model.live="discount" min="0" max="100" class="form-control">
        </div>
        <div class="col-md-3">
            <label>السعر بعد الخصم</label>
            <input type="text" readonly class="form-control" value="<?php echo e(number_format($this->afterDiscountTotalPrice)); ?>">
        </div>
        <div class="col-md-3">
            <label>الدفع النقدي</label>
            <input type="number" wire:model.live="cash" min="0" step="0.01" class="form-control">
        </div>
        <div class="col-md-3 mt-2">
            <label>المتبقي</label>
            <input type="text" readonly class="form-control" value="<?php echo e(number_format($this->residual)); ?>">
        </div>
    </div>

    <div class="mt-3">
        <label>ملاحظة</label>
        <textarea wire:model="note" class="form-control" rows="3"></textarea>
    </div>

    <button wire:click="updateInvoice" class="btn btn-primary mt-3">تحديث الفاتورة</button>
</div>
<?php /**PATH C:\Users\Malta Computer\Desktop\forhost\resources\views/livewire/add-invoices/edit.blade.php ENDPATH**/ ?>