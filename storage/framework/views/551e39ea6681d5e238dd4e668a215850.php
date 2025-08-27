<div>
    <div class="col-xl-12">
        <div class="card card-height-100">
            <!-- card body -->
            <div wire:ignore>
                <div id="success_message" class="alert alert-borderless alert-success" role="alert" hidden>
                    <span id="success_message_text"></span>
                </div>
            </div>
            <div wire:ignore>
                <div id="error_message" class="alert alert-borderless alert-danger" role="alert" hidden>
                    <span id="error_message_text"></span>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Form Booking</h4>
                    <button wire:click="goBack" type="button" class="btn btn-danger waves-effect waves-light"><i
                            class="bx bx-arrow-back"></i>
                    </button>
                </div><!-- end card header -->
                <div class="card-body mb-3">
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills nav-primary mb-3" role="tablist">
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link <?php echo e($activeTab === 'data_reservasi' ? 'active' : ''); ?>"
                                wire:click="setActiveTab('data_reservasi')" data-bs-toggle="tab" href="#data_reservasi"
                                role="tab">data reservasi</a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link <?php echo e($activeTab === 'data_fasilitas' ? 'active' : ''); ?>"
                                wire:click="setActiveTab('data_fasilitas')" data-bs-toggle="tab" href="#data_fasilitas"
                                role="tab">tambah fasilitas & F n B</a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link <?php echo e($activeTab === 'data_pembayaran' ? 'active' : ''); ?>"
                                wire:click="setActiveTab('data_pembayaran')" data-bs-toggle="tab"
                                href="#data_pembayaran" role="tab">data pembayaran</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content text-muted">
                        <div class="tab-pane <?php echo e($activeTab === 'data_reservasi' ? 'active' : ''); ?>" id="data_reservasi"
                            role="tabpanel">
                            <form onsubmit="return false;">
                                <div class="live-preview">
                                    <div class="row gy-12">
                                        <div class="col-md-12 mb-3">
                                            <div class=" bg-light">
                                                <h5 class=" p-2 rounded">Data Pribadi Customer</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div wire:ignore>
                                                <label for="select_cus_id" class="form-label">pilih data
                                                    costumer</label>
                                                <select id="select_cus" class="js-example-basic-single form-control"
                                                    wire:model="select_cus_id">
                                                </select>
                                            </div>
                                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['cus_id'];
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
                                        <div class="col-md-2" style="display: flex; align-items: center;">
                                            <button wire:click="ambilDataCus" type="button"
                                                class="btn btn-primary waves-effect waves-light"
                                                style="margin-top: 1.75rem;">ambil data</button>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <label for="cus_name" class="form-label">nama customer</label>
                                                <input id= "cus_name" wire:model="cus_name" type="text"
                                                    class="form-control">
                                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['cus_name'];
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
                                                <label for="cus_address" class="form-label">alamat</label>
                                                <input id= "cus_address" wire:model="cus_address" type="text"
                                                    class="form-control">
                                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['cus_address'];
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
                                                <label for="cus_phone" class="form-label">no. telefon</label>
                                                <input id= "cus_phone" wire:model="cus_phone" type="text"
                                                    class="form-control">
                                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['cus_phone'];
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
                                                <label for="cus_email" class="form-label">email</label>
                                                <input id= "cus_email" wire:model="cus_email" type="email"
                                                    class="form-control">
                                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['cus_email'];
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
                                                <label for="jnsidentity_id" class="form-label">jenis identitas</label>
                                                <select id= "jnsidentity_id" wire:model="jnsidentity_id"
                                                    class="form-select mb-3" aria-label="Default select example">
                                                    <option value="">-- Pilih Jenis Identitas --</option>
                                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $jenis_identitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($id); ?>"><?php echo e($name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                </select>
                                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['jnsidentity_id'];
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
                                                <label for="cus_identity_number" class="form-label">no
                                                    identitas</label>
                                                <input id= "cus_identity_number" wire:model="cus_identity_number"
                                                    type="text" class="form-control">
                                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['cus_identity_number'];
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
                                                <label for="rekanan_id" class="form-label">penjamin</label>
                                                <select wire:model="rekanan_id" class="form-select mb-3"
                                                    aria-label="Default select example">
                                                    <option value="">-- Pilih Penjamin --</option>
                                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $rekanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($id); ?>"><?php echo e($name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                </select>
                                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['rekanan_id'];
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
                                        <div class="col-md-12 mb-3">
                                            <div class=" bg-light">
                                                <h5 class=" p-2 rounded">Data Penginapan</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <label for="aslbooking_id" class="form-label">asal booking</label>
                                                <select id= "aslbooking_id" wire:model="aslbooking_id"
                                                    class="form-select mb-3" aria-label="Default select example">
                                                    <option value="">-- Pilih Asal Booking --</option>
                                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $asal_booking; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($id); ?>"><?php echo e($name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                </select>
                                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['aslbooking_id'];
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
                                        <div class="col-md-2">
                                            <div>
                                                <label for="no_referensi" class="form-label">no referensi
                                                    booking</label>
                                                <input wire:model="no_referensi" type="text" class="form-control">
                                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['no_referensi'];
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
                                        <div class="col-md-2">
                                            <div>
                                                <label for="jumlah_tamu" class="form-label">jumlah tamu</label>
                                                <input wire:model="jumlah_tamu" type="text" class="form-control">
                                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['jumlah_tamu'];
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
                                        <div class="col-md-3">
                                            <div>
                                                <label for="tanggal_checkin" class="form-label">tanggal
                                                    check-in</label>
                                                <input wire:model="tanggal_checkin" type="text"
                                                    class="form-control" data-provider="flatpickr"
                                                    data-date-format="d M, Y">
                                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['tanggal_checkin'];
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
                                        <div class="col-md-3 mb-3">
                                            <div>
                                                <label for="tanggal_checkout" class="form-label">tanggal
                                                    check-out</label>
                                                <input wire:model="tanggal_checkout" type="text"
                                                    class="form-control" data-provider="flatpickr"
                                                    data-date-format="d M, Y">
                                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['tanggal_checkout'];
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
                                        <div class="col-md-12 mb-3">
                                            <div class=" bg-light">
                                                <h5 class=" p-2 rounded">Pilihan Kamar</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <label for="tipeinap_id" class="form-label">pilih tipe
                                                    menginap</label>
                                                <select wire:model.live="tipeinap_id" class="form-select mb-3"
                                                    aria-label="Default select example">
                                                    <option value="">-- Pilih tipe menginap --</option>
                                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $tipe_inaps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($id); ?>"><?php echo e($name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                </select>
                                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['tipeinap_id'];
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
                                                <label for="klskmr_id" class="form-label">pilih kelas kamar</label>
                                                <select wire:model.live="klskmr_id" class="form-select mb-3"
                                                    aria-label="Default select example">
                                                    <option value="">-- Pilih Kelas Kamar --</option>
                                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $kelas_kamars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($id); ?>"><?php echo e($name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                </select>
                                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['klskmr_id'];
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
                                                <label for="kamar_id" class="form-label">pilih kamar</label>
                                                <select wire:model.live="kamar_id" class="form-select mb-3"
                                                    aria-label="Default select example">
                                                    <option value="">-- Pilih Kamar --</option>
                                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $kamars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($id); ?>"><?php echo e($name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                </select>
                                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['kamar_id'];
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
                                        <div class="col-md-2">
                                            <div>
                                                <label for="tarif_kamar" class="form-label">tarif kamar
                                                    permalam</label>
                                                <input wire:model="tarif_kamar" type="number" class="form-control"
                                                    readonly>
                                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['tarif_kamar'];
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
                                        <div class="col-md-2">
                                            <div>
                                                <label for="asal_tarif" class="form-label">asal tarif</label>
                                                <input wire:model="asal_tarif" type="text" class="form-control"
                                                    readonly>
                                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['asal_tarif'];
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
                                        <div class="col-md-2">
                                            <div>
                                                <label for="total_malam" class="form-label">total malam/hari
                                                    menginap</label>
                                                <input wire:model="total_malam" type="number" class="form-control"
                                                    readonly>
                                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['total_malam'];
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
                                        <div class="col-md-2">
                                            <div>
                                                <label for="total_tarif_kamar" class="form-label">total tarif dasar
                                                    kamar</label>
                                                <input wire:model="total_tarif_kamar" type="number"
                                                    class="form-control" readonly>
                                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['total_tarif_kamar'];
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
                                                    <button wire:click="createRSV" type="button"
                                                        class="btn btn-primary waves-effect waves-light">create
                                                        reservasi</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </from>
                        </div>
                        <div class="tab-pane <?php echo e($activeTab === 'data_fasilitas' ? 'active' : ''); ?>"
                            id="data_fasilitas" role="tabpanel">
                            <div class="card-body">
                                <form onsubmit="return false;">
                                    <div class="live-preview">
                                        <div class="row gy-12 ">
                                            <div class="col-md-12 mb-3">
                                                <div class=" bg-light">
                                                    <h5 class=" p-2 rounded">Penambahan fasilitas</h5>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div>
                                                    <label for="faskmr_id" class="form-label">pilih fasilitas</label>
                                                    <select wire:model.live="faskmr_id" class="form-select mb-3"
                                                        aria-label="Default select example">
                                                        <option value="">-- Pilih Fasilitas --</option>
                                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $fasilitas_kamars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($id); ?>"><?php echo e($name); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                    </select>
                                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['faskmr_id'];
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
                                            <div class="col-md-2">
                                                <div>
                                                    <label for="tarif_exc" class="form-label">tarif satuan</label>
                                                    <input wire:model="tarif_exc" type="number" class="form-control"
                                                        readonly>
                                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['tarif_exc'];
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
                                            <div class="col-md-1">
                                                <div>
                                                    <label for="qty_fasilitas" class="form-label">qty</label>
                                                    <input wire:model.lazy="qty_fasilitas" type="number"
                                                        class="form-control" min="0">
                                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['qty_fasilitas'];
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
                                            <div class="col-md-2">
                                                <div>
                                                    <label for="total_fasilitas" class="form-label">total</label>
                                                    <input wire:model="total_fasilitas" type="number"
                                                        class="form-control" readonly>
                                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['total_fasilitas'];
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
                                            <div class="col-md-2 form-group"
                                                style="display: flex; align-items: center;">
                                                <button wire:click="createBillFasilitaskamar" type="button"
                                                    class="btn btn-primary waves-effect waves-light"
                                                    style="margin-top: 0.75rem;">add</button>
                                            </div>
                                        </div>
                                    </div>
                                    </from>
                                    <div class="col-12">
                                        <table class="table table-nowrap">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">nama fasilitas</th>
                                                    <th scope="col">harga satuan</th>
                                                    <th scope="col">qty</th>
                                                    <th scope="col">harga total</th>
                                                    <th scope="col">action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $data_bill_fasilitaskmr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <th scope="row"><a href="#"
                                                                class="fw-semibold"><?php echo e($bill->billfaskmr_id); ?></a>
                                                        </th>
                                                        <td><?php echo e($bill->nama_fasilitas); ?></td>
                                                        <td>Rp. <?php echo e(number_format($bill->tarif_satuan, 0, ',', '.')); ?>

                                                        </td> <!-- Format tanpa desimal -->
                                                        <td><?php echo e($bill->qty); ?></td>
                                                        <td>Rp. <?php echo e(number_format($bill->tarif_total, 0, ',', '.')); ?>

                                                        </td>
                                                        <td>
                                                            <button type="button"
                                                                wire:click="askDelete(<?php echo e($bill->billfaskmr_id); ?>)"
                                                                class="btn btn-ghost-danger waves-effect waves-light"><i
                                                                    class="bx bx-trash-alt"></i>delete</button>
                                                        </td> <!-- Format tanpa desimal -->
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                            </tbody>
                                        </table>
                                    </div>
                                    <form onsubmit="return false;">
                                        <div class="live-preview">
                                            <div class="row gy-12 ">
                                                <div class="col-md-12 mb-3">
                                                    <div class=" bg-light">
                                                        <h5 class=" p-2 rounded">Penambahan F & B</h5>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div>
                                                        <label for="fnb_id" class="form-label">pilih menu F &
                                                            B</label>
                                                        <select wire:model.live="fnb_id" class="form-select mb-3"
                                                            aria-label="Default select example">
                                                            <option value="">-- Pilih menu F & B --</option>
                                                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($id); ?>">
                                                                    <?php echo e($name); ?>

                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                        </select>
                                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['fnb_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="alert alert-borderless alert-danger"
                                                                role="alert">
                                                                <?php echo e($message); ?></div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div>
                                                        <label for="harga_fnb" class="form-label">tarif satuan</label>
                                                        <input wire:model="harga_fnb" type="number"
                                                            class="form-control" readonly>
                                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['harga_fnb'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="alert alert-borderless alert-danger"
                                                                role="alert">
                                                                <?php echo e($message); ?></div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div>
                                                        <label for="qty_fnb" class="form-label">qty</label>
                                                        <input wire:model.lazy="qty_fnb" type="number"
                                                            class="form-control" min="0">
                                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['qty_fnb'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="alert alert-borderless alert-danger"
                                                                role="alert">
                                                                <?php echo e($message); ?></div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div>
                                                        <label for="total_harga_fnb" class="form-label">total</label>
                                                        <input wire:model="total_harga_fnb" type="number"
                                                            class="form-control" readonly>
                                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['total_harga_fnb'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="alert alert-borderless alert-danger"
                                                                role="alert">
                                                                <?php echo e($message); ?></div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                                    </div>
                                                </div>
                                                <div class="col-md-2 form-group"
                                                    style="display: flex; align-items: center;">
                                                    <button wire:click="createBillFNB" type="button"
                                                        class="btn btn-primary waves-effect waves-light"
                                                        style="margin-top: 0.75rem;">add</button>
                                                </div>
                                            </div>
                                        </div>
                                        </from>
                                        <div class="col-12">
                                            <table class="table table-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">nama item</th>
                                                        <th scope="col">harga satuan</th>
                                                        <th scope="col">qty</th>
                                                        <th scope="col">harga total</th>
                                                        <th scope="col">action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $data_bill_fnb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <th scope="row"><a href="#"
                                                                    class="fw-semibold"><?php echo e($bill->billfnb_id); ?></a>
                                                            </th>
                                                            <td><?php echo e($bill->nama_fasilitas); ?></td>
                                                            <td>Rp.
                                                                <?php echo e(number_format($bill->tarif_satuan, 0, ',', '.')); ?>

                                                            </td> <!-- Format tanpa desimal -->
                                                            <td><?php echo e($bill->qty); ?></td>
                                                            <td>Rp.
                                                                <?php echo e(number_format($bill->tarif_total, 0, ',', '.')); ?>

                                                            </td>
                                                            <td>
                                                                <button type="button"
                                                                    wire:click="askDeleteFNB(<?php echo e($bill->billfnb_id); ?>)"
                                                                    class="btn btn-ghost-danger waves-effect waves-light"><i
                                                                        class="bx bx-trash-alt"></i>delete</button>
                                                            </td> <!-- Format tanpa desimal -->
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                </tbody>
                                            </table>
                                        </div>
                            </div>
                        </div>
                        <div class="tab-pane <?php echo e($activeTab === 'data_pembayaran' ? 'active' : ''); ?>"
                            id="data_pembayaran" role="tabpanel">
                            <div class="card-body">
                                <div class="live-preview">
                                    <div class="row gy-12 ">
                                        <div class="col-md-2">
                                            <div>
                                                <label for="tipediskon_id" class="form-label">pilih tipe
                                                    diskon</label>
                                                <select wire:model="tipediskon_id" class="form-select mb-3"
                                                    aria-label="Default select example">
                                                    <option value="">-- Pilih tipe diskon --</option>
                                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $tipe_diskons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($id); ?>"><?php echo e($name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                </select>
                                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['tipediskon_id'];
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
                                                <label for="nilai_diskon" class="form-label">nominal diskon</label>
                                                <input wire:model="nilai_diskon" type="number" class="form-control">
                                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['nilai_diskon'];
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
                                        <div class="col-md-2 form-group" style="display: flex; align-items: center;">
                                            <button wire:click="hitungDiskon" type="button"
                                                class="btn btn-primary waves-effect waves-light"
                                                style="margin-top: 0.75rem;">add diskon</button>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class=" bg-light">
                                                <h5 class=" p-2 rounded"><b>Total Tarif Kamar</b> : Rp.
                                                    <?php echo e(number_format($data_pembayaran_total_bill_kamar, 0, ',', '.')); ?>

                                                </h5>
                                            </div>
                                        </div>
                                        <!--[if BLOCK]><![endif]--><?php if($data_pembayaran_total_fasilitas !== null): ?>
                                            <div class="col-md-12 mb-3">
                                                <div class=" bg-light">
                                                    <h5 class=" p-2 rounded"><b>Total Tarif Fasilitas/Layanan</b> : Rp.
                                                        <?php echo e(number_format($data_pembayaran_total_fasilitas, 0, ',', '.')); ?>

                                                    </h5>
                                                </div>
                                            </div>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        <!--[if BLOCK]><![endif]--><?php if($data_pembayaran_total_fnb !== null): ?>
                                            <div class="col-md-12 mb-3">
                                                <div class=" bg-light">
                                                    <h5 class=" p-2 rounded"><b>Total Tarif Menu F & B</b> : Rp.
                                                        <?php echo e(number_format($data_pembayaran_total_fnb, 0, ',', '.')); ?>

                                                    </h5>
                                                </div>
                                            </div>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        <div class="col-md-12 mb-3">
                                            <div class=" bg-light">
                                                <h5 class=" p-2 rounded"><b>Sub Total Billing</b> : Rp.
                                                    <?php echo e(number_format($data_pembayaran_subtotal, 0, ',', '.')); ?></h5>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class=" bg-light">
                                                <h5 class=" p-2 rounded"><b>Diskon</b> : Rp.
                                                    <?php echo e(number_format($nominal_diskon, 0, ',', '.')); ?></h5>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class=" bg-light">
                                                <h5 class=" p-2 rounded"><b>Diskon Rekanan</b> : Rp.
                                                    <?php echo e(number_format($nominal_diskon_rekanan, 0, ',', '.')); ?></h5>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class=" bg-light">
                                                <h5 class=" p-2 rounded"><b>Tax Service</b> <small>(pengali dari harga
                                                        kamar + harga fasilitas tambahan)</small> : <?php echo e($data_pajak); ?>

                                                    %
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class=" bg-light">
                                                <h5 class=" p-2 rounded"><b>Grand Total</b> : Rp.
                                                    <?php echo e(number_format($data_pembayaran_grandtotal, 0, ',', '.')); ?></h5>
                                            </div>
                                        </div>
                                        <!--[if BLOCK]><![endif]--><?php if($stts_bill != 4 && $stts_bill != 1): ?>
                                            <div class="col-md-2">
                                                <div>
                                                    <label for="bayar_id" class="form-label">pilih jenis
                                                        pembayaran</label>
                                                    <select wire:model.live="bayar_id" class="form-select mb-3"
                                                        aria-label="Default select example">
                                                        <option value="">-- Pilih jenis pembayaran --</option>
                                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $jenis_bayar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($id); ?>"><?php echo e($name); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                    </select>
                                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['bayar_id'];
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
                                            <div class="col-md-2">
                                                <div>
                                                    <label for="bank_id" class="form-label">pilih bank</label>
                                                    <select wire:model="bank_id" class="form-select mb-3"
                                                        aria-label="Default select example">
                                                        <option value="">-- Pilih Bank --</option>
                                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $nama_bank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($id); ?>"><?php echo e($name); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                    </select>
                                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['bank_id'];
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
                                            <div class="col-md-2">
                                                <div>
                                                    <label for="nominal_pembayaran" class="form-label">nominal
                                                        pembayaran</label>
                                                    <input wire:model="nominal_pembayaran" type="number"
                                                        class="form-control" min="0">
                                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['nominal_pembayaran'];
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
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        <div class="row gy-4">
                                            <div class="col-md-12">
                                                <div class="d-flex gap-2">
                                                    <!--[if BLOCK]><![endif]--><?php if($stts_bill != 4 && $stts_bill != 1 && $stts_bill != 3): ?>
                                                        <button wire:click="checkoutBill" type="button"
                                                            class="btn btn-success waves-effect waves-light"><i
                                                                class="bx bx-money-withdraw"></i>
                                                            Pembayaran
                                                        </button>
                                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                    <!--[if BLOCK]><![endif]--><?php if($stts_bill == 4 || $stts_bill == 1): ?>
                                                        <button wire:click="batalReservasiAsk" type="button"
                                                            class="btn btn-danger waves-effect waves-light"><i
                                                                class="bx bx-power-off"></i>
                                                            Batal Reservasi
                                                        </button>
                                                        
                                                        <button wire:click="checkIn" type="button"
                                                            class="btn btn-primary waves-effect waves-light"><i
                                                                class="bx bx-printer"></i>
                                                            Check In
                                                        </button>
                                                        
                                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                    <!--[if BLOCK]><![endif]--><?php if($stts_bill == 4 || $stts_bill == 1 || $stts_bill == 3): ?>
                                                        <button wire:click="createInvoice" type="button"
                                                            class="btn btn-success waves-effect waves-light"><i
                                                                class="bx bx-printer"></i>
                                                            Cetak Invoice
                                                        </button>
                                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end card-body -->

            </div>

        </div>
    </div>
    <div>
        <!-- Modal Delete -->
        <div x-data="{
            showModal: false,
            rowId: null,
            initModal() {
                const modal = new bootstrap.Modal(document.getElementById('deleteModalBillFasilitas'));
                window.addEventListener('openDeleteModal', (event) => {
                    this.rowId = event.detail[0].rowId;
                    // Show modal
                    modal.show();
                });
            }
        }" x-init="initModal()">
            <!-- Modal -->
            <div id="deleteModalBillFasilitas" class="modal fade" tabindex="-1" aria-labelledby="deleteModalLabel"
                aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button wire:click="confirmDeleteBillFasilitas(rowId)" type="button"
                                class="btn btn-danger"
                                @click="
                            const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModalBillFasilitas'));
                            modal.hide();">
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <!-- Modal Delete -->
        <div x-data="{
            showModal: false,
            rowId: null,
            initModal() {
                const modal = new bootstrap.Modal(document.getElementById('deleteModalBillFnb'));
                window.addEventListener('openDeleteModalFNB', (event) => {
                    this.rowId = event.detail[0].rowId;
                    // Show modal
                    modal.show();
                });
            }
        }" x-init="initModal()">
            <!-- Modal -->
            <div id="deleteModalBillFnb" class="modal fade" tabindex="-1" aria-labelledby="deleteModalLabel"
                aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button wire:click="confirmDeleteBillFNB(rowId)" type="button" class="btn btn-danger"
                                @click="
                            const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModalBillFnb'));
                            modal.hide();">
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <!-- Modal Delete -->
        <div x-data="{
            showModal: false,
            rowId: null,
            initModal() {
                const modal = new bootstrap.Modal(document.getElementById('deleteModalExtracharge'));
                window.addEventListener('openDeleteModalExtracharge', (event) => {
                    this.rowId = event.detail[0].rowId;
                    // Show modal
                    modal.show();
                });
            }
        }" x-init="initModal()">
            <!-- Modal -->
            <div id="deleteModalExtracharge" class="modal fade" tabindex="-1" aria-labelledby="deleteModalLabel"
                aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button wire:click="confirmDeleteExtracharge(rowId)" type="button"
                                class="btn btn-danger"
                                @click="
                            const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModalExtracharge'));
                            modal.hide();">
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <!-- Modal Delete -->
        <div x-data="{
            showModal: false,
            rowId: null,
            initModal() {
                const modal = new bootstrap.Modal(document.getElementById('deleteModalExtrachargeManual'));
                window.addEventListener('openDeleteModalExtrachargeManual', (event) => {
                    this.rowId = event.detail[0].rowId;
                    // Show modal
                    modal.show();
                });
            }
        }" x-init="initModal()">
            <!-- Modal -->
            <div id="deleteModalExtrachargeManual" class="modal fade" tabindex="-1"
                aria-labelledby="deleteModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button wire:click="confirmDeleteExtrachargeManual(rowId)" type="button"
                                class="btn btn-danger"
                                @click="
                            const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModalExtrachargeManual'));
                            modal.hide();">
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <!-- Modal Delete -->
        <div x-data="{
            showModal: false,
            rowId: null,
            initModal() {
                const modal = new bootstrap.Modal(document.getElementById('batalReservasiForm'));
                window.addEventListener('openBatalReservasiModal', (event) => {
                    this.rowId = event.detail[0].rowId;
                    console.log(this.rowId)
                    modal.show();
                });
            }
        }" x-init="initModal()">
            <!-- Modal -->
            <div id="batalReservasiForm" class="modal fade" tabindex="-1" aria-labelledby="deleteModalLabel"
                aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">konfirmasi pembatalan reservasi dan retur
                                pembayaran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-6">
                                <div>
                                    <label for="nominal_bayar" class="form-label">jumlah yang sudah dibayar</label>
                                    <input id= "nominal_bayar" wire:model="nominal_bayar" type="number"
                                        class="form-control" readonly>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['nominal_bayar'];
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
                                    <label for="nominal_retur" class="form-label">nominal retur</label>
                                    <input id= "nominal_retur" wire:model="nominal_retur" type="number"
                                        class="form-control">
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['nominal_retur'];
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
                                    <label for="bayar_id" class="form-label">pilih asal dana retur</label>
                                    <select wire:model="bayar_id" class="form-select mb-3"
                                        aria-label="Default select example">
                                        <option value="">-- Pilih jenis pembayaran --</option>
                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $jenis_bayar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($id); ?>"><?php echo e($name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                    </select>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['bayar_id'];
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
                                    <label for="bank_id" class="form-label">pilih bank</label>
                                    <select wire:model="bank_id" class="form-select mb-3"
                                        aria-label="Default select example">
                                        <option value="">-- Pilih Bank --</option>
                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $nama_bank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($id); ?>"><?php echo e($name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                    </select>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['bank_id'];
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
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button wire:click="ConfirmbatalReservasi(rowId)" type="button" class="btn btn-danger"
                                @click="
                            const modal = bootstrap.Modal.getInstance(document.getElementById('batalReservasiForm'));
                            modal.hide();">
                                batal reservasi
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $__env->startPush('scripts'); ?>
        <script>
            window.addEventListener('notifikasi', event => {
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
                    willClose: () => {}
                });
            });
            window.addEventListener('openInvoice', event => {
                console.log(event)
                const invoiceUrl = event.detail[0].url
                window.open(invoiceUrl, '_blank');
            });
            window.addEventListener('openInvoiceDasar', event => {
                console.log(event)
                const invoiceUrl = event.detail[0].url
                window.open(invoiceUrl, '_blank');
            });
            window.addEventListener('openInvoiceExtra', event => {
                console.log(event)
                const invoiceUrl = event.detail[0].url
                window.open(invoiceUrl, '_blank');
            });

            $(document).ready(function() {

                $('#select_cus').select2({
                    placeholder: 'cari nama/nomer identitas/nomer telefon customer',
                    allowClear: true,
                    ajax: {
                        url: '/transaksi/reservasi/booking/datacustomer',
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
                $('#select_cus').on('change', function(e) {
                    var select_cus_id = $('#select_cus').val();
                    window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('select_cus_id', select_cus_id);
                    if (select_cus_id == null) {
                        $('#cus_name').val(null);
                        $('#cus_address').val(null);
                        $('#cus_phone').val(null);
                        $('#cus_email').val(null);
                        window.Livewire.find('<?php echo e($_instance->getId()); ?>').jnsidentity_id = '';
                        $('#cus_identity_number').val(null);

                    }
                })
            });
        </script>
    <?php $__env->stopPush(); ?>
</div>
<?php /**PATH /var/www/html/jkhomestay/resources/views/livewire/transaksi/booking/booking-form.blade.php ENDPATH**/ ?>