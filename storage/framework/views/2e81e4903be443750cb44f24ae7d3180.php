<div>
    <!-- Hero Start -->
    <div class="container-fluid bg-primary hero-header mb-5">
        <div class="container text-center">
            <h1 class="display-4 text-white mb-3 animated slideInDown">Products</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0 animated slideInDown">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Products</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Product Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="text-primary mb-3">Our NASA Products</h1>
                <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet, erat non
                    malesuada consequat, nibh erat tempus risus.</p>
            </div>
            <div class="row g-4">
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $produkList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="<?php echo e(0.1 + $index * 0.2); ?>s">
                        <div class="product-item text-center border h-100 p-4">
                            <img class="product-img img-fluid mb-4" src="<?php echo e(asset('storage/' . $produk->produk_url)); ?>"
                                alt="<?php echo e($produk->produk_name); ?>"
                                style="height: 200px; width: auto; object-fit: contain;">
                            <div class="mb-2">
                                <!--[if BLOCK]><![endif]--><?php for($i = 0; $i < 5; $i++): ?>
                                    <small class="fa fa-star text-primary"></small>
                                <?php endfor; ?><!--[if ENDBLOCK]><![endif]-->
                                <small>(99)</small>
                            </div>
                            <a href="#" class="h6 d-inline-block mb-2"><?php echo e($produk->produk_name); ?></a>
                            <h5 class="text-primary mb-3">Rp
                                <?php echo e(number_format($produk->hargaProduk->first()->harga_jual, 0, ',', '.')); ?></h5>
                            <a href="#" class="btn btn-outline-primary px-3">Add To Cart</a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                
            </div>
        </div>
    </div>
    <!-- Product End -->


    <!-- Newsletter Start -->
    <div class="container-fluid newsletter bg-primary py-5 my-5">
        <div class="container py-5">
            <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="text-white mb-3"><span class="fw-light text-dark">Let's Subscribe</span> The Newsletter
                </h1>
                <p class="text-white mb-4">Subscribe now to get 30% discount on any of our products</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-7 wow fadeIn" data-wow-delay="0.5s">
                    <div class="position-relative w-100 mt-3 mb-2">
                        <input class="form-control w-100 py-4 ps-4 pe-5" type="text" placeholder="Enter Your Email"
                            style="height: 48px;">
                        <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2"><i
                                class="fa fa-paper-plane text-white fs-4"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Newsletter End -->

</div>
<?php /**PATH C:\laragon\www\ecommerce\resources\views/livewire/fe/view-produk.blade.php ENDPATH**/ ?>