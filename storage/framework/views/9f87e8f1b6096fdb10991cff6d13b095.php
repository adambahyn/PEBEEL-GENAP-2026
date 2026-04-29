<div
    <?php echo e($attributes
            ->merge([
                'id' => $getId(),
            ], escape: false)
            ->merge($getExtraAttributes(), escape: false)); ?>

>
    <?php echo e($getChildSchema()); ?>

</div>
<?php /**PATH C:\laragon\www\PEBEEL-GENAP-2026\vendor\filament\schemas\resources\views/components/grid.blade.php ENDPATH**/ ?>