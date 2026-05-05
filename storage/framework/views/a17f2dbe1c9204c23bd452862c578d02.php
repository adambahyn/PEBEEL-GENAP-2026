<form
    <?php echo e($attributes
            ->merge([
                'id' => $getId(),
                'wire:submit' => $getLivewireSubmitHandler(),
            ], escape: false)
            ->merge($getExtraAttributes(), escape: false)
            ->class([
                'fi-sc-form',
                'fi-dense' => $isDense(),
            ])); ?>

>
    <?php echo e($getChildSchema($schemaComponent::HEADER_SCHEMA_KEY)); ?>


    <?php echo e($getChildSchema()); ?>


    <?php echo e($getChildSchema($schemaComponent::FOOTER_SCHEMA_KEY)); ?>

</form>
<?php /**PATH C:\Kuliah\Tingkat 2\PBL\PEBEEL-GENAP-2026\vendor\filament\schemas\resources\views/components/form.blade.php ENDPATH**/ ?>