<!--[if BLOCK]><![endif]--><?php if(data_get($setUp, 'header.showMessageSoftDeletes') &&
        ($softDeletes === 'withTrashed' || $softDeletes === 'onlyTrashed')): ?>
    <div
        class="alert alert-warning my-1"
        role="alert"
    >
        <!--[if BLOCK]><![endif]--><?php if($softDeletes === 'withTrashed'): ?>
            <?php echo app('translator')->get('livewire-powergrid::datatable.soft_deletes.message_with_trashed'); ?>
        <?php else: ?>
            <?php echo app('translator')->get('livewire-powergrid::datatable.soft_deletes.message_only_trashed'); ?>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>
<?php endif; ?><!--[if ENDBLOCK]><![endif]-->
<?php /**PATH /var/www/html/jkhomestay/vendor/power-components/livewire-powergrid/src/Providers/../../resources/views/components/frameworks/bootstrap5/header/message-soft-deletes.blade.php ENDPATH**/ ?>