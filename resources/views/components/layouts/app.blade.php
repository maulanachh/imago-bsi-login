  <x-layouts.base>
      <!-- awalan wrapper page -->
      <div id="layout-wrapper">

          @include('components.layouts.top-bar')

          <!-- removeNotificationModal -->
          <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
                      </div>
                      <div class="modal-body">
                          <div class="mt-2 text-center">
                              <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                              <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                  <h4>Are you sure ?</h4>
                                  <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                              </div>
                          </div>
                          <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                              <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                              <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                          </div>
                      </div>

                  </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
          <!-- ========== App Menu ========== -->
          @livewire('SideNavbar')
          <!-- Vertical Overlay-->
          <div class="vertical-overlay"></div>

          <!-- ============================================================== -->
          <!-- Start right Content here -->
          <!-- ============================================================== -->
          <div class="main-content">

              <div class="page-content">
                  <div class="container-fluid">
                      <!-- start page title -->
                      @livewire('TopBarMenu')
                      @livewire('Breadcrumb')
                      {{ $slot }}
                      <!-- end page title -->

                  </div>
                  <!-- container-fluid -->
              </div>
              <!-- End Page-content -->

              <footer class="footer">
                  <div class="container-fluid">
                      <div class="row">
                          <div class="col-sm-6">
                              2024 © Quote N Code
                          </div>
                      </div>
                  </div>
              </footer>
          </div>
          <!-- end main content-->

      </div>
      <!-- akhiran wrapper page -->
  </x-layouts.base>