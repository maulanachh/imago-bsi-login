<div>
    <!-- Content
  ============================================= -->
    <section id="content">
        <div class="content-wrap pb-0">

            <div class="container">

                <a href="demo-skincare-login.html"><img src="demos/skincare/images/banner.jpg" alt=".."
                        class="mb-3 mb-md-5 mb-xl-6 border border-color border-width-2"></a>

                <div class="row mb-3 mb-md-5 justify-content-md-between">

                    <div class="col-md-3 order-2 order-md-1">

                        <button type="button"
                            class="button-filter button button-border border-color m-0 color h-bg-color h-text-light w-100">
                            <span>Show Filter <i class="bi-arrow-down me-0 ms-2"></i> </span>
                            <span><i class="bi-arrow-up"></i> Hide Filter</span>
                        </button>

                    </div>

                    <div class="col-12 col-md-auto order-1 order-md-2 mb-2 mb-md-0">
                        <div id="shop-filter-sorting" class="dropdown border-0">
                            <button type="button" id="shop-filter-btn"
                                class="button button-border border-color m-0 color h-bg-color h-text-light dropdown-toggle px-5 w-100 text-center"
                                data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="true"
                                data-bs-offset="0, -1">
                                Sorting
                            </button>

                            <ul class="shop-sorting dropdown-menu dropdown-menu-end shadow-sm border-0 w-100 py-0 rounded-0"
                                aria-labelledby="shop-filter-btn">
                                <li><a href="#" class="dropdown-item" data-sort-by="name_az"><span>A - Z
                                            Alphabetically</span></a></li>
                                <li><a href="#" class="dropdown-item" data-sort-by="name_za"><span>Z - A
                                            Alphabetically</span></a></li>
                                <li><a href="#" class="dropdown-item" data-sort-by="price_lh"><span>Least
                                            Expensive</span></a></li>
                                <li><a href="#" class="dropdown-item" data-sort-by="price_hl"><span>Most
                                            Expensive</span></a></li>
                            </ul>
                        </div>

                    </div>

                </div>

                <div class="row">
                    <div class="col-md-3 skincare-filter sticky-sidebar-wrap">
                        <ul class="list-unstyled items-nav sticky-sidebar">
                            <li><a href="#" class="text-dark font-body">Men</a></li>
                            <li><a href="#" class="text-dark font-body">Women</a></li>
                        </ul>
                        <hr>
                        <ul class="pt-4 list-unstyled position-relative ist-unstyled items-nav shop-filter custom-filter font-body"
                            data-container="#shop" data-active-class="active-filter">
                            <li class="widget-filter-reset active-filter"><a href="#" class="text-danger"
                                    data-filter="*">Clear</a></li>
                            <li class="mb-1 d-flex justify-content-between align-items-center"><a href="#"
                                    data-filter=".sf-face">Face</a>
                                <div class="shop-filter-count"></div>
                            </li>
                            <li class="mb-1 d-flex justify-content-between align-items-center"><a href="#"
                                    data-filter=".sf-body">Body</a>
                                <div class="shop-filter-count"></div>
                            </li>
                            <li class="mb-1 d-flex justify-content-between align-items-center"><a href="#"
                                    data-filter=".sf-eyes">Eyes</a>
                                <div class="shop-filter-count"></div>
                            </li>
                            <li class="mb-1 d-flex justify-content-between align-items-center"><a href="#"
                                    data-filter=".sf-makeup">Makeup</a>
                                <div class="shop-filter-count"></div>
                            </li>
                            <li class="mb-1 d-flex justify-content-between align-items-center"><a href="#"
                                    data-filter=".sf-ayurvedic">Ayurvedic</a>
                                <div class="shop-filter-count"></div>
                            </li>
                            <li class="mb-1 d-flex justify-content-between align-items-center"><a href="#"
                                    data-filter=".sf-hair">Hair</a>
                                <div class="shop-filter-count"></div>
                            </li>
                            <li class="mb-1 d-flex justify-content-between align-items-center"><a href="#"
                                    data-filter=".sf-lotions">Moisturizers &amp; Lotions</a>
                                <div class="shop-filter-count"></div>
                            </li>
                            <li class="mb-1 d-flex justify-content-between align-items-center"><a href="#"
                                    data-filter=".sf-lips">Lips</a>
                                <div class="shop-filter-count"></div>
                            </li>
                        </ul>

                        <hr class="my-5">


                        <div class="d-flex align-items-center mt-5">
                            <h5 class="mb-0 h6 font-body fw-normal">Filter by Price:</h5>
                            <div class="d-flex text-smaller ms-auto op-07">
                                <div class="price-range-from"></div>
                                <span class="mx-1"> - </span>
                                <div class="price-range-to"></div>
                            </div>
                        </div>
                        <input class="price-range">

                    </div>

                    <div class="col-md-9">
                        <div id="shop" class="row shop grid-container" data-layout="fitRows">
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $produkList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-4 col-md-6 mb-4 product">
                                    <div class="grid-inner">
                                        <div class="product-image mb-2">
                                            <a href="" wire:click.prevent="showDetail(<?php echo e($produk->produk_id); ?>)">
                                                <img src="<?php echo e(asset('storage/' . $produk->produk_url)); ?>"
                                                    alt="<?php echo e($produk->produk_name); ?>" class="img-fluid"
                                                    style="th: 100%; height: 250px; object-fit: contain;wid">
                                            </a>
                                            <!--[if BLOCK]><![endif]--><?php if($produk->diskon): ?>
                                                <div class="sale-flash badge bg-color rounded-0 fw-normal p-2">
                                                    <?php echo e($produk->diskon); ?>% Off*
                                                </div>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            <div class="bg-overlay">
                                                <div class="bg-overlay-content align-items-end justify-content-end"
                                                    data-hover-animate="fadeIn">
                                                    <a href=""
                                                        wire:click.prevent="showDetail(<?php echo e($produk->produk_id); ?>)"
                                                        class="d-block position-absolute top-0 start-0 w-100 h-100 z-1">
                                                        <span class="visually-hidden">Product Link</span>
                                                    </a>
                                                    <a href="#"wire:click.prevent="showDetail(<?php echo e($produk->produk_id); ?>)"
                                                        wire:click.prevent="addToCart(<?php echo e($produk->id); ?>)"
                                                        class="btn bg-color bg-opacity-75 text-light me-2 z-2">
                                                        <i class="bi-basket"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-desc text-center">
                                            <div class="product-title">
                                                <h3><a href="" class="color"><?php echo e($produk->produk_name); ?></a>
                                                </h3>
                                            </div>
                                            <div class="product-price fw-normal mt-0 mb-2">
                                                <!--[if BLOCK]><![endif]--><?php if($produk->diskon): ?>
                                                    <del class="op-07">Rp
                                                        <?php echo e(number_format($produk->hargaProduk->first()->harga_jual, 0, ',', '.')); ?></del>
                                                    <ins>
                                                        Rp
                                                        <?php echo e(number_format($produk->hargaProduk->first()->harga_jual * (1 - $produk->diskon / 100), 0, ',', '.')); ?>

                                                    </ins>
                                                <?php else: ?>
                                                    <ins>Rp
                                                        <?php echo e(number_format($produk->hargaProduk->first()->harga_jual, 0, ',', '.')); ?></ins>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->

                        </div>
                    </div>
                </div>
            </div>

            <div class="section bg-color dark mb-0 py-0">
                <div class="container-fluid py-6">
                    <div class="row justify-content-center mx-auto mw-md gx-5">
                        <div class="col">
                            <p class="h6 mb-0 text-light">Conveniently network effective total linkage via
                                intermandated opportunities. Distinctively <a class="text-light fw-bold"
                                    href="mailto:noreply@canvas.com"><u>noreply@canvas.com</u></a> premium products.
                            </p>
                        </div>
                        <div class="col-auto mt-3 mt-md-0">
                            <h2 class="fw-bold mb-0 display-6 border-bottom border-white d-inline-block"><a
                                    class="text-white" href="tel:09876543211">(+0) 1234 567890</a></h2>
                        </div>
                    </div>
                </div>
                <div class="ticker-wrap pause-on-hover py-4"
                    style="--cnvs-ticker-duration: 450s; border-top: 1px solid rgba(255,255,255,0.1);">
                    <div class="ticker">
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3 text-white text-shadow-none">Shop
                            Now</a>
                        <a href="demo-skincare-single.html" class="ticker-item px-3"><span
                                class="text-white op-01">&#9670;</span></a>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- #content end -->
</div>
<?php /**PATH C:\laragon\www\ecommerce\resources\views/livewire/fe/product.blade.php ENDPATH**/ ?>