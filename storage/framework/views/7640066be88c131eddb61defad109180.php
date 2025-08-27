<div>
    <div class="col-xl-12">
        <div class="card card-height-100">
            <!-- card body -->
            <div class="col-lg-12">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Form Karyawan</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <form wire:submit.prevent="createKaryawan">
                        <div class="live-preview">
                            <div class="row gy-12">
                                <div class="col-md-6">
                                    <div>
                                        <label for="karyawan_name" class="form-label">nama karyawan</label>
                                        <input wire:model="karyawan_name" type="text" class="form-control">
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['karyawan_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="tempat_lahir" class="form-label">tempat lahir</label>
                                        <input wire:model="tempat_lahir" type="text" class="form-control">
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['tempat_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div>
                                        <label for="tgl_lahir" class="form-label">tanggal lahir</label>
                                        <input wire:model="tgl_lahir" type="text" class="form-control"
                                            data-provider="flatpickr" data-date-format="d M, Y">
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['tgl_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div wire:ignore>
                                        <label for="provinsi" class="form-label">provinsi</label>
                                        <select id="provinsi" class="js-example-basic-single form-control"
                                            wire:model="id_prov" onchange="provDropdown()">
                                        </select>
                                    </div>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['id_prov'];
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
                                        <label for="kabupaten" class="form-label">kabupaten</label>
                                        <select id="kabupaten" class="js-example-basic-single form-control"
                                            wire:model="id_kab" onchange="kabDropdown()">
                                        </select>
                                    </div>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['id_kab'];
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
                                        <label for="kecamatan" class="form-label">kecamatan</label>
                                        <select id="kecamatan" class="js-example-basic-single form-control"
                                            wire:model="id_kec" onchange="kecDropdown()">
                                        </select>
                                    </div>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['id_kec'];
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
                                        <label for="kelurahan" class="form-label">kelurahan</label>
                                        <select id="kelurahan" class="js-example-basic-single form-control"
                                            wire:model="id_kel" onchange="">
                                        </select>
                                    </div>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['id_kel'];
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
                                <div class="col-md-8">
                                    <div>
                                        <label for="alamat" class="form-label">detail alamat</label>
                                        <input wire:model="alamat" type="text" class="form-control">
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="phone" class="form-label">no. telefon</label>
                                        <input wire:model="phone" type="number" class="form-control">
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="jenkel_id" class="form-label">jenis kelamin</label>
                                        <select wire:model="jenkel_id" class="form-select mb-3"
                                            aria-label="Default select example">
                                            <option value="">-- Pilih Jenis Kelamin --</option>
                                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $jenis_kelamin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                        </select>
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['jenkel_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="v" class="form-label">pendidikan terakhir</label>
                                        <select wire:model="pendidikan_id" class="form-select mb-3"
                                            aria-label="Default select example">
                                            <option value="">-- Pilih Pendidikan --</option>
                                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $pendidikan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                        </select>
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['pendidikan_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="pekerjaan_id" class="form-label">jenis pekerjaan</label>
                                        <select wire:model.live="pekerjaan_id" class="form-select mb-3"
                                            aria-label="Default select example">
                                            <option value="">-- Pilih Jenis Pekerjaan --</option>
                                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $jenis_pekerjaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                        </select>
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['pekerjaan_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="leader_id" class="form-label">pilih leader</label>
                                        <select wire:model="leader_id" class="form-select mb-3"
                                            aria-label="Default select example">
                                            <option value="">-- Pilih Leader --</option>
                                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $leader; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                        </select>
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['leader_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                </div>
                                <br>
                                <div class="row gy-4">
                                    <div class="col-md-12">
                                        <div class="d-flex gap-2">
                                            <button type="submit"
                                                class="btn btn-primary waves-effect waves-light">save</button>
                                            <button wire:click="goBack" type="button"
                                                class="btn btn-light waves-effect waves-light">back</button>
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
                    $('#provinsi').select2({
                        placeholder: 'Pilih provinsi',
                        allowClear: true,
                        ajax: {
                            url: '/master/sdm/masterkaryawan/searchProv',
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
                    $('#provinsi').on('change', function(e) {
                        var id_prov = $('#provinsi').val();
                        window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('id_prov', id_prov);
                    })

                    $('#kabupaten').select2({
                        placeholder: 'Pilih kabupaten',
                        allowClear: true,
                        ajax: {
                            url: '/master/sdm/masterkaryawan/searchKab',
                            dataType: 'json',
                            delay: 250,
                            data: function(params) {
                                return {
                                    search: params.term,
                                    id_prov: $('#provinsi').val()
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
                    $('#kabupaten').on('change', function(e) {
                        var id_kab = $('#kabupaten').val();
                        window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('id_kab', id_kab);
                    })

                    $('#kecamatan').select2({
                        placeholder: 'Pilih kecamatan',
                        allowClear: true,
                        ajax: {
                            url: '/master/sdm/masterkaryawan/searchKec',
                            dataType: 'json',
                            delay: 250,
                            data: function(params) {
                                return {
                                    search: params.term,
                                    id_kab: $('#kabupaten').val()
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
                    $('#kecamatan').on('change', function(e) {
                        var id_kec = $('#kecamatan').val();
                        window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('id_kec', id_kec);
                    })

                    $('#kelurahan').select2({
                        placeholder: 'Pilih kelurahan',
                        allowClear: true,
                        ajax: {
                            url: '/master/sdm/masterkaryawan/searchKel',
                            dataType: 'json',
                            delay: 250,
                            data: function(params) {
                                return {
                                    search: params.term,
                                    id_kec: $('#kecamatan').val()
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
                    $('#kelurahan').on('change', function(e) {
                        var id_kel = $('#kelurahan').val();
                        window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('id_kel', id_kel);
                    })
                });

                function provDropdown() {
                    $('#kabupaten').val(null).trigger('change');
                    $('#kecamatan').val(null).trigger('change');
                    $('#kelurahan').val(null).trigger('change');
                }

                function kabDropdown() {
                    $('#kecamatan').val(null).trigger('change');
                    $('#kelurahan').val(null).trigger('change');
                }

                function kecDropdown() {
                    $('#kelurahan').val(null).trigger('change');
                }





















                window.addEventListener('resetForm', event => {
                    const {
                        type,
                        message
                    } = event.detail[0];
                    Swal.fire({
                        title: type === 'success' ? 'Success' : 'Error',
                        position: 'top-end',
                        toast: true,
                        text: message,
                        icon: type,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                        willClose: () => {
                            // Add additional logic here if needed
                        }
                    });
                });
            </script>
        <?php $__env->stopPush(); ?>
    </div>
<?php /**PATH C:\laragon\www\ecommerce\resources\views/livewire/master/sdm/karyawan/master-karyawan-form.blade.php ENDPATH**/ ?>