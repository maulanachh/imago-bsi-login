<div>
    <div class="row">

        <div class="col-xl-6">
            <div class="card card-height-100">
                <!-- card body -->
                <div class="col-lg-12">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Menu Penjualan Onsite</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <form wire:submit.prevent="create">
                            <div class="live-preview">
                                <div class="row gy-12">
                                    <div class="col-md-12">
                                        <div>
                                            <label for="produk_id" class="form-label">pilih produk</label>
                                            <select wire:model.live="produk_id" class="form-select mb-3"
                                                aria-label="Default select example">
                                                <option value="">-- Pilih Produk --</option>
                                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                            </select>
                                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['produk_id'];
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
                                            <label for="harga_satuan" class="form-label">harga satuan</label>
                                            <input wire:model="harga_satuan" type="text" class="form-control"
                                                disabled>
                                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['harga_satuan'];
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
                                            <label for="stok" class="form-label">stock barang</label>
                                            <input wire:model="stok" type="text" class="form-control" disabled>
                                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['stok'];
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
                                            <label for="qty" class="form-label">qty barang</label>
                                            <input wire:model.live="qty" type="number" class="form-control">
                                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['qty'];
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
                                            <label for="subtotal_harga_satuan" class="form-label">total harga</label>
                                            <input wire:model="subtotal_harga_satuan" type="number"
                                                class="form-control" disabled>
                                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['subtotal_harga_satuan'];
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
                                            <label for="tipediskon_id" class="form-label">pilih tipe diskon</label>
                                            <select wire:model="tipediskon_id" class="form-select mb-3"
                                                aria-label="Default select example">
                                                <option value="">-- Pilih Tipe Diskon --</option>
                                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $tipe_diskon; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
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
                                    <div class="col-md-6">
                                        <div>
                                            <label for="diskon" class="form-label">besaran diskon</label>
                                            <input wire:model="diskon" type="number" class="form-control">
                                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['diskon'];
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
                                                    class="btn btn-primary waves-effect waves-light">input data</button>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card card-height-100">
            <!-- card body -->
            <div class="col-lg-12">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">List Order</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-borderless align-middle mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                    <th style="width: 90px;" scope="col">Product</th>
                                    <th scope="col">Product Info</th>
                                    <th scope="col" class="text-end">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $data_cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <div class="avatar-md bg-light rounded p-1">
                                                <img src="<?php echo e(asset('storage/' . $data->produk_url)); ?>"
                                                    alt="<?php echo e($data->nama_produk); ?>" class="img-fluid d-block">
                                            </div>
                                        </td>
                                        <td>
                                            <h5 class="fs-14"><a href="apps-ecommerce-product-details.html"
                                                    class="text-dark"><?php echo e($data->produk_name); ?></a>
                                            </h5>
                                            <p class="text-muted mb-0">Rp.
                                                <?php echo e(number_format($data->harga_satuan, 0, ',', '.')); ?> x
                                                <?php echo e($data->qty); ?></p>
                                        </td>
                                        <td class="text-end">Rp.
                                            <?php echo e(number_format($data->subtotal_harga, 0, ',', '.')); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                <tr>
                                    <td class="fw-semibold" colspan="2">Sub Total :</td>
                                    <td class="fw-semibold text-end">Rp.
                                        <?php echo e(number_format($data_kolektif->total_subtotal, 0, ',', '.')); ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold" colspan="2">Total Discount: </td>
                                    <td class="text-end">Rp.
                                        <?php echo e(number_format($data_kolektif->total_diskon, 0, ',', '.')); ?></td>
                                </tr>
                                <tr class="table-active">
                                    <th colspan="2">Total :</th>
                                    <td class="text-end">
                                        <span class="fw-semibold">
                                            Rp.
                                            <?php echo e(number_format($data_kolektif->total_harga, 0, ',', '.')); ?>

                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="checkout">
                        <div class="col-md-6">
                            <div>
                                <label for="karyawan_id" class="form-label">referensi pembelian</label>
                                <select wire:model="karyawan_id" class="form-select mb-3"
                                    aria-label="Default select example">
                                    <option value="">-- Pilih referensi --</option>
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </select>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['karyawan_id'];
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
                                <label for="diskon_billing" class="form-label">diskon billing</label>
                                <input wire:model="diskon_billing" type="number" class="form-control">
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['diskon_billing'];
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
                                    <button type="submit" class="btn btn-success waves-effect waves-light">checkout
                                        barang</button>
                                    
                                </div>
                            </div>
                        </div>
                    </form>
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
                willClose: () => {
                    // Add additional logic here if needed
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>
</div>
<?php /**PATH C:\laragon\www\ecommerce\resources\views/livewire/transaksi/pembelian-langsung/pembelian-langsung-form.blade.php ENDPATH**/ ?>