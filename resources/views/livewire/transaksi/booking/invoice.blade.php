<!doctype html>
<html lang="en" data-layout="horizontal" data-topbar="dark" data-sidebar-size="lg" data-sidebar="light"
    data-sidebar-image="none" data-preloader="disable">

<head>
    <base href="{{ url('/') }}">
    <meta charset="utf-8" />
    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <style>
        @media print {
            body {
                margin: 0;
                /* Menghapus margin saat mencetak */
                padding: 0;
                /* Menghapus padding saat mencetak */
            }

            .card-header {
                padding: 0;
                /* Menghapus padding pada header saat mencetak */
            }

            .card-logo {
                margin-top: 0;
                /* Menghapus margin atas pada logo saat mencetak */
            }
        }
    </style>
</head>

<body>
    <!-- Begin page -->

    <div class="card" id="demo">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-header border-bottom-dashed p-4">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <img src="assets/images/invoice.png" class="card-logo card-logo-dark" alt="logo dark"
                                height="70">
                        </div>
                    </div>
                </div>
                <!--end card-header-->
            </div><!--end col-->
            <div class="col-lg-12">
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-lg-3 col-6">
                            <p class="text-muted mb-2 text-uppercase fw-semibold"> No Invoice :
                                {{ $data_invoice['no_invoice'] }}</p>
                        </div>
                        <!--end col-->
                        <div class="col-lg-3 col-6">
                            <p class="text-muted mb-2 text-uppercase fw-semibold">Tanggal Cetak Invoice :
                                {{ $data_invoice['tgl_invoice'] }}</p>
                        </div>
                    </div>
                    <!--end row-->
                </div>
                <!--end card-body-->
            </div><!--end col-->
            <div class="col-lg-12">
                <div class="card-body p-4 border-top border-top-dashed">
                    <div class="row g-3">
                        <div class="col-6">
                            <h6 class="text-muted text-uppercase fw-semibold mb-3">Data Customer</h6>
                            <p class="text-muted mb-1"><span>Nama Customer : </span><span
                                    id="shipping-phone-no">{{ $data_invoice['cus_name'] }}</span></p>
                            <p class="text-muted mb-1"><span>Alamat Customer : </span><span
                                    id="shipping-phone-no">{{ $data_invoice['cus_address'] }}</span></p>
                            <p class="text-muted mb-1"><span>Telp Customer : </span><span
                                    id="shipping-phone-no">{{ $data_invoice['cus_phone'] }}</span></p>
                        </div>
                        <!--end col-->
                        <div class="col-6">
                            <h6 class="text-muted text-uppercase fw-semibold mb-3">Data Reservasi</h6>
                            <p class="text-muted mb-1"><span>Nama Kamar : </span><span
                                    id="shipping-phone-no">{{ $data_invoice['kamar_name'] }}</span></p>
                            <p class="text-muted mb-1"><span>Kelas Kamar : </span><span
                                    id="shipping-phone-no">{{ $data_invoice['klskmr_name'] }}</span></p>
                            <p class="text-muted mb-1"><span>Tanggal Check-In : </span><span
                                    id="shipping-phone-no">{{ $data_invoice['tanggal_checkin'] }}</span></p>
                            <p class="text-muted mb-1"><span>Tanggal Check-Out : </span><span
                                    id="shipping-phone-no">{{ $data_invoice['tanggal_checkout'] }}</span></p>
                            <p class="text-muted mb-1"><span>Jumlah Tamu : </span><span
                                    id="shipping-phone-no">{{ $data_invoice['jumlah_tamu'] }}</span></p>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <!--end card-body-->
            </div><!--end col-->
            <div class="col-lg-12">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                            <thead>
                                <tr class="table-active">
                                    <th scope="col" style="width: 50px;">#</th>
                                    <th scope="col">Nama Item</th>
                                    <th scope="col">Harga</th>
                                </tr>
                            </thead>
                            <tbody id="products-list">
                                <tr>
                                    <th scope="row">*</th>
                                    <td class="text-start">
                                        <span class="fw-medium">Biaya Kamar</span>
                                    </td>
                                    <td>Rp. {{ number_format($data_invoice['total_bill_kmr'], 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">*</th>
                                    <td class="text-start">
                                        <span class="fw-medium">Biaya Tambahan Fasilitas</span>
                                    </td>
                                    <td>Rp. {{ number_format($data_invoice['total_bill_fasilitas'], 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">*</th>
                                    <td class="text-start">
                                        <span class="fw-medium">Biaya Tambahan F & B</span>
                                    </td>
                                    <td>Rp. {{ number_format($data_invoice['total_bill_fnb'], 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table><!--end table-->
                    </div>
                    <div class="border-top border-top-dashed mt-2">
                        <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto"
                            style="width:250px">
                            <tbody>
                                <tr>
                                    <td>Sub Total</td>
                                    <td class="text-end">Rp.
                                        {{ number_format($data_invoice['subtotal'], 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Tax {{ $data_invoice['pajak'] }}% <small>*biaya kamar + fasilitas
                                            tambahan</small></td>
                                    <td class="text-end">Rp.
                                        {{ number_format($data_invoice['nominal_pajak'], 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Discount</td>
                                    <td class="text-end">Rp.
                                        {{ number_format($data_invoice['nominal_diskon'], 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Discount Rekanan</td>
                                    <td class="text-end">Rp.
                                        {{ number_format($data_invoice['nominal_diskon_rekanan'], 0, ',', '.') }}</td>
                                </tr>
                                <tr class="border-top border-top-dashed fs-15">
                                    <th scope="row">Total</th>
                                    <th class="text-end">Rp.
                                        {{ number_format($data_invoice['grand_total'], 0, ',', '.') }}</th>
                                </tr>
                                @if ($data_invoice['bayar_id'] != 5)
                                    <tr class="border-top border-top-dashed fs-15">
                                        <th scope="row">Terbayar</th>
                                        <th class="text-end">Rp.
                                            {{ number_format($data_invoice['nominal_bayar'], 0, ',', '.') }}</th>
                                    </tr>
                                @endif
                                @if ($data_invoice['bayar_id'] == 5)
                                    <tr class="border-top border-top-dashed fs-15">
                                        <th scope="row">Piutang Ke : </th>
                                        <th class="text-end">
                                            {{ $data_invoice['rekanan_name'] }}</th>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <!--end table-->
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                            <tbody id="products-list">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Terima kasih telah menginap di JK Homestay</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        {{ $data_invoice['karyawan_name'] }}
                                        <hr style="border: none; border-top: 1px solid black; width: 100%; margin: 0;">
                                        Petugas
                                    </td>
                                    <td></td>
                                    <td colspan="2" style="text-align: center;">
                                        {{ $data_invoice['cus_name'] }}
                                        <hr style="border: none; border-top: 1px solid black; width: 100%; margin: 0;">
                                        Tamu
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                </tr>
                            </tbody>

                        </table><!--end table-->
                    </div>
                </div><!-- container-fluid -->
            </div><!-- End Page-content -->
        </div><!-- end main content-->
    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <script>
        window.addEventListener('load', () => {
            requestAnimationFrame(() => {
                window.print();
            });
        });
    </script>
    <!-- JAVASCRIPT -->
</body>


</html>
