<div>
    <div class="col-xl-12">
        <div class="card card-height-100">
            <!-- card body -->
            <div wire:ignore>
                <div id="success_message" class="alert alert-borderless alert-success" role="alert" hidden>
                    <span id="success_message_text"></span>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Form Fitur</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <form wire:submit.prevent="createFeature">
                        <div class="live-preview">
                            <div class="row gy-12">
                                <div class="col-md-6">
                                    <div>
                                        <label for="feature_code" class="form-label">kode fitur</label>
                                        <input wire:model="feature_code" type="text" class="form-control">
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['feature_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-borderless alert-danger" role="alert"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="feature_name" class="form-label">nama fitur</label>
                                        <input wire:model="feature_name" type="text" class="form-control">
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['feature_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-borderless alert-danger" role="alert"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check mb-2" style="margin-top: 12px;">
                                        <input class="form-check-input" type="checkbox" id="is_parent" wire:model="is_parent" onchange="toggleParentFeatureDropdown()">
                                        <label class="form-check-label" for="is_parent">
                                            fitur utama
                                        </label>
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['is_parent'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-borderless alert-danger" role="alert"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div wire:ignore>
                                        <label for="feature_location" class="form-label">lokasi menu fitur</label>
                                        <select id="feature_location" class="js-example-basic-single" wire:model="feature_location_id" onchange="toggleParentFeatureDropdown()">
                                        </select>
                                    </div>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['feature_location_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="alert alert-borderless alert-danger mt-2" role="alert">
                                        <?php echo e($message); ?>

                                    </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                                <div class="col-md-6">
                                    <div wire:ignore>
                                        <label for="feature_side_bar" class="form-label">parent sidebar fitur</label>
                                        <select id="feature_side_bar" class="js-example-basic-single form-control" wire:model="feature_side_bar_id" onchange="toggleParentFeatureDropdown()">
                                        </select>
                                    </div>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['feature_side_bar_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="alert alert-borderless alert-danger mt-2" role="alert">
                                        <?php echo e($message); ?>

                                    </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                                <div class="col-md-6">
                                    <div wire:ignore>
                                        <label for="feature_parent" class="form-label">parent fitur</label>
                                        <select id="feature_parent" class="js-example-basic-single form-control" wire:model="feature_parent_id">
                                        </select>
                                    </div>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['feature_parent_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="alert alert-borderless alert-danger mt-2" role="alert">
                                        <?php echo e($message); ?>

                                    </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                                <div class="col-md-3">
                                    <div wire:ignore>
                                        <label for="level" class="form-label">level litur</label>
                                        <select id="level" class="js-example-basic-single form-control" wire:model="level">
                                        </select>
                                    </div>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['level'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="alert alert-borderless alert-danger mt-2" role="alert">
                                        <?php echo e($message); ?>

                                    </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="feature_route_link" class="form-label">URL fitur</label>
                                        <input wire:model="feature_route_link" type="text" class="form-control">
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['feature_route_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-borderless alert-danger" role="alert"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="feature_icon" class="form-label">ikon fitur</label>
                                        <input wire:model="feature_icon" type="text" class="form-control">
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['feature_icon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-borderless alert-danger" role="alert"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

                                    </div>
                                </div>

                            </div>
                            <br>
                            <div class="row gy-4">
                                <div class="col-md-12">
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">save</button>
                                        <button wire:click="goBack" type="button" class="btn btn-light waves-effect waves-light">back</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </from>
                </div>
            </div>
        </div>
    </div>
    <?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {

            $('#feature_location').select2({
                placeholder: 'Pilih lokasi fitur',
                allowClear: true,
                ajax: {
                    url: '/setting/developer/masterfitur/feature-locations',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response.data
                        };
                    },

                },
            })
            $('#feature_location').on('change', function(e) {
                var feature_location_id = $('#feature_location').val();
                window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('feature_location_id', feature_location_id);
            })
            //
            $('#feature_parent').on('change', function(e) {
                var feature_parent_id = $('#feature_parent').val();
                window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('feature_parent_id', feature_parent_id);
            })
            //
            $('#level').select2({
                placeholder: 'Pilih level fitur',
                allowClear: true,
                ajax: {
                    url: '/setting/developer/masterfitur/levelfeature',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response.data
                        };
                    },
                    cache: true
                },
            })
            $('#level').on('change', function(e) {
                var level_id = $('#level').val();
                window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('level', level_id);
            })
            //
            $('#feature_side_bar').select2({
                placeholder: 'Pilih parent sidebar menu',
                allowClear: true,
                ajax: {
                    url: '/setting/developer/masterfitur/parentfeaturesidebar',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response.data
                        };
                    },
                    cache: true
                },
            })
            $('#feature_side_bar').on('change', function(e) {
                var feature_side_bar_id = $('#feature_side_bar').val();
                window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('feature_side_bar_id', feature_side_bar_id);
            })

        });

        function toggleParentFeatureDropdown() {
            const isParentChecked = document.getElementById('is_parent').checked;
            const featureLocation = document.getElementById('feature_location').value;
            const parentSidebar = document.getElementById('feature_side_bar').value;
            const parentFeatureDropdown = document.getElementById('feature_parent');
            const parentSidebarDropdown = document.getElementById('feature_side_bar');
            const urlLink = document.getElementById('feature_side_bar');
            if (isParentChecked && featureLocation === "1") {
                parentFeatureDropdown.setAttribute('disabled', 'true');
                parentSidebarDropdown.setAttribute('disabled', 'true');
            } else if (isParentChecked && featureLocation === "2") {
                parentFeatureDropdown.setAttribute('disabled', 'true');
            } else {
                parentFeatureDropdown.removeAttribute('disabled');
                parentSidebarDropdown.removeAttribute('disabled');
                $('#feature_parent').select2({
                    placeholder: 'Pilih parent fitur',
                    allowClear: true,
                    ajax: {
                        url: '/setting/developer/masterfitur/parentfeature',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                search: params.term,
                                location_id: featureLocation,
                                parent_sidebar: parentSidebar
                            };
                        },
                        processResults: function(response) {
                            return {
                                results: response.data
                            };
                        },
                        cache: true
                    },
                })
            }
        }
        window.addEventListener('resetForm', event => {
            $('#success_message').removeAttr('hidden');
            $('#success_message').text(event.detail[0]);
            $('#feature_location').val(null).trigger('change');
            $('#feature_parent').val(null).trigger('change');
            $('#feature_side_bar').val(null).trigger('change');
            $('#level').val(null).trigger('change');
        });
        window.addEventListener('syncSelect2', event => {
            // Fungsi untuk sinkronisasi Select2
            const syncSelect2 = (selector, value, text) => {
                if (value) {
                    // Buat opsi baru jika belum ada
                    const option = new Option(text, value, true, true);
                    $(selector).append(option).trigger('change');
                }
            };

            // Sinkronisasi setiap elemen Select2
            syncSelect2('#feature_location', event.detail[0].feature_location_id, event.detail[0].feature_location_name);
            syncSelect2('#feature_side_bar', event.detail[0].feature_side_bar_id, event.detail[0].feature_side_bar_name);
            syncSelect2('#feature_parent', event.detail[0].feature_parent_id, event.detail[0].feature_parent_name);
            syncSelect2('#level', event.detail[0].level, event.detail[0].level);

            toggleParentFeatureDropdown();
        });
    </script>
    <?php $__env->stopPush(); ?>
</div><?php /**PATH /var/www/html/jkhomestay/resources/views/livewire/setting/developer/feature-form.blade.php ENDPATH**/ ?>