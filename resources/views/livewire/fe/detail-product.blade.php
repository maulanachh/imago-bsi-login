<div>
    <div class="container">
        <div class="row g-0 col-mb-50 swiper-container-vertical">
            <div class="col-md-6">
                <div class="row">


                    <div class="col scroll-container mt-5">
                        <div class="masonry-thumbs grid-container row row-cols-3 row-cols-md-1 masonry-gap-xl"
                            data-lightbox="gallery">
                            <a href="{{ asset('storage/' . $produk->produk_url) }}" id="item-1"
                                data-lightbox="gallery-item" title="#1 Image Caption">
                                <img src="{{ asset('storage/' . $produk->produk_url) }}"
                                    alt="#1 Image Caption"class="img-fluid"
                                    style="width: 100%; height: 600px; object-fit: contain; padding: 10px;">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="col-md-6 skincare-shop-desc">
                <div class="p-md-4 p-lg-5">

                    {{-- <div class="d-flex align-items-center justify-content-between">

                        <p class="color text-uppercase ls-2 mb-3 small">{{ $produk->produk_name }}</p>

                        <!-- Product Single - Rating
       ============================================= -->
                        <div class="product-rating">
                            <i class="bi-star-fill color"></i>
                            <i class="bi-star-fill color"></i>
                            <i class="bi-star-fill color"></i>
                            <i class="bi-star-fill color"></i>
                            <i class="bi-star-half color"></i>
                        </div><!-- Product Single - Rating End -->

                    </div> --}}

                    <h2 class="fs-1 lh-sm">{{ $produk->produk_name }}</h2>

                    <div class="line my-4" style="border-color: var(--cnvs-color);"></div>

                    <!-- Quantity & Cart Button
      ============================================= -->
                    <form
                        class="cart cart-border cart-border-2 mb-0 d-flex flex-column flex-lg-row align-items-lg-center"
                        method="post" enctype='multipart/form-data'>
                        <div class="quantity mb-2 mb-lg-0 me-2 me-lg-4  justify-content-between">
                            <button type="button" class="minus"><i class="uil uil-minus"></i></button>
                            <input type="number" step="1" min="1" name="quantity" value="1"
                                title="Qty" class="qty border-0">
                            <button type="button" class="plus"><i class="uil uil-plus"></i></button>
                        </div>
                        <button type="submit" class="add-to-cart button m-0 flex-fill text-white"
                            style="--cnvs-btn-padding-y: 0.75rem">Rp
                            {{ number_format($produk->hargaProduk->first()->harga_jual, 0, ',', '.') }}<i
                                class="bi-circle-fill small mx-3"></i>Add to
                            Cart</button>
                    </form><!-- Quantity & Cart Button End -->
                    <div class="lh-sm small mt-3 op-06">Free US shipping. International flat-rate. &middot; Skip or
                        cancel any time.</div>

                    <div class="line my-4" style="border-color: var(--cnvs-color);"></div>

                    <!-- Product Single - Short Description
      ============================================= -->
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero velit id eaque ex quae
                        laboriosam nulla optio doloribus! Perspiciatis, libero, neque, perferendis at nisi optio dolor!
                    </p>
                    <div class="row mb-2">
                        <span class="col-sm-3 fw-semibold">Skin Moisture:</span>
                        <span class="col-sm-9">Cleansed, Smooth, Refreshing</span>
                    </div>

                    <div class="row mb-2">
                        <span class="col-sm-3 fw-semibold">Ingredients:</span>
                        <span class="col-sm-9">Avobenzone, 3%, Homosalate 8%, Octisalate 5%, Octocrylene 4%</span>
                    </div>

                    <div class="row mb-4">
                        <span class="col-sm-3 fw-semibold">How to Apply:</span>
                        <span class="col-sm-9">Apply generously and evenly as the last step in your skincare routine
                            and before makeup.</span>
                    </div>
                    <p class="mb-0">Perspiciatis ad eveniet ea quasi debitis quos laborum eum reprehenderit eaque
                        explicabo assumenda rem modi.</p>
                </div>
            </nav>
        </div>
    </div>
</div>
