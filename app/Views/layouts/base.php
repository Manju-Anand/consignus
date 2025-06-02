<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $meta_title; ?></title>
  <meta name="description" content="<?= $meta_description; ?>">

  <link rel="icon" type="image/png" href="<?= base_url(); ?>public/assets/images/favicon.png" sizes="16x16">
  <!-- remix icon font css  -->
  <link rel="stylesheet" href="<?= base_url(); ?>public/assets/css/remixicon.css">
  <!-- BootStrap css -->
  <link rel="stylesheet" href="<?= base_url(); ?>public/assets/css/lib/bootstrap.min.css">
  <!-- Apex Chart css -->
  <link rel="stylesheet" href="<?= base_url(); ?>public/assets/css/lib/apexcharts.css">
  <!-- Data Table css -->
  <link rel="stylesheet" href="<?= base_url(); ?>public/assets/css/lib/dataTables.min.css">
  <!-- Text Editor css -->
  <link rel="stylesheet" href="<?= base_url(); ?>public/assets/css/lib/editor-katex.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>public/assets/css/lib/editor.atom-one-dark.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>public/assets/css/lib/editor.quill.snow.css">
  <!-- Date picker css -->
  <link rel="stylesheet" href="<?= base_url(); ?>public/assets/css/lib/flatpickr.min.css">
  <!-- Calendar css -->
  <link rel="stylesheet" href="<?= base_url(); ?>public/assets/css/lib/full-calendar.css">
  <!-- Vector Map css -->
  <link rel="stylesheet" href="<?= base_url(); ?>public/assets/css/lib/jquery-jvectormap-2.0.5.css">
  <!-- Popup css -->
  <link rel="stylesheet" href="<?= base_url(); ?>public/assets/css/lib/magnific-popup.css">
  <!-- Slick Slider css -->
  <link rel="stylesheet" href="<?= base_url(); ?>public/assets/css/lib/slick.css">
  <!-- prism css -->
  <link rel="stylesheet" href="<?= base_url(); ?>public/assets/css/lib/prism.css">
  <!-- file upload css -->
  <link rel="stylesheet" href="<?= base_url(); ?>public/assets/css/lib/file-upload.css">

  <link rel="stylesheet" href="<?= base_url(); ?>public/assets/css/lib/audioplayer.css">
  <!-- main css -->
  <link rel="stylesheet" href="<?= base_url(); ?>public/assets/css/style.css">
  <!-- Include this in the <head> or before your script -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Include in your <head> or just before </body> -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <?= $this->renderSection('styles') ?>
</head>

<body>
  <aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
      <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
      <a href="index.html" class="sidebar-logo">
        <img src="<?= base_url(); ?>public/assets/images/consignlogo.svg" alt="site logo" class="light-logo">
        <img src="<?= base_url(); ?>public/assets/images/consignlogo.svg" alt="site logo" class="dark-logo" style="filter: invert(1) grayscale(1);">
        <img src="<?= base_url(); ?>public/assets/images/consignlogo.svg" alt="site logo" class="logo-icon">
      </a>
    </div>
    <div class="sidebar-menu-area">
      <ul class="sidebar-menu" id="sidebar-menu">
        <li>
          <a href="<?= base_url(); ?>home">
            <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
            <span>Dashboard</span>
          </a>

        </li>
        <li class="sidebar-menu-group-title">Application</li>
        <li>
          <a href="<?= base_url(); ?>leads">
            <iconify-icon icon="mage:email" class="menu-icon"></iconify-icon>
            <span>Leads</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url(); ?>customers">
            <iconify-icon icon="mage:email" class="menu-icon"></iconify-icon>
            <span>Customers</span>
          </a>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0)">
            <iconify-icon icon="hugeicons:invoice-03" class="menu-icon"></iconify-icon>
            <span>Properties</span>
          </a>
          <ul class="sidebar-submenu">
            <li>
              <a href="<?= base_url(); ?>add-property"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>Add Property</a>
            </li>
            <li>
              <a href="<?= base_url(); ?>property"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i>
                Property View</a>
            </li>


          </ul>
        </li>

        <li class="dropdown">
          <a href="javascript:void(0)">
            <iconify-icon icon="material-symbols:map-outline" class="menu-icon"></iconify-icon>
            <span>Services</span>
          </a>
          <ul class="sidebar-submenu">

            <li>
              <a href="<?= base_url(); ?>add-service">
                <iconify-icon icon="bi:chat-dots" class="menu-icon"></iconify-icon>
                <span>Add Service</span>
              </a>
            </li>
            <li>
              <a href="<?= base_url(); ?>services">
                <iconify-icon icon="material-symbols:map-outline" class="menu-icon"></iconify-icon>
                <span>Service List</span>
              </a>
            </li>

          </ul>
        </li>

        <li class="dropdown">
          <a href="javascript:void(0)">
            <iconify-icon icon="fe:vector" class="menu-icon"></iconify-icon>
            <span>Leadership Team Tasks</span>
          </a>
          <ul class="sidebar-submenu">
            <li>
              <a href="<?= base_url(); ?>team-assignment"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>Assign Task</a>
            </li>
            <li>
              <a href="<?= base_url(); ?>team-work-update"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i>
                Work Updates</a>
            </li>
            <!-- <li>
              <a href="invoice-add.html"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i>Task Overview</a>
            </li> -->

          </ul>
        </li>

        <li class="dropdown">
          <a href="javascript:void(0)">
            <iconify-icon icon="solar:calendar-outline" class="menu-icon"></iconify-icon>
            <span>Shares Transactions</span>
          </a>
          <ul class="sidebar-submenu">
            <li> <a href="<?= base_url(); ?>share-purchase-list"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>Share Purchase</a>
            </li>
            <li>
              <a href="<?= base_url(); ?>share-sale-list"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i>
                Share Sale</a>
            </li>

          </ul>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0)">
            <iconify-icon icon="hugeicons:money-send-square" class="menu-icon"></iconify-icon>
            <span>Account Transactions</span>
          </a>
          <ul class="sidebar-submenu">
            <li> <a href="<?= base_url(); ?>transactions-list"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>Transactions</a>
            </li>
            <li>
              <a href="<?= base_url(); ?>income-and-expenditure"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i>
              Income & Expenditure</a>
            </li>

          </ul>
        </li>
        <!-- 
        

        <li>
          <a href="<?= base_url(); ?>quotations">
            <iconify-icon icon="solar:calendar-outline" class="menu-icon"></iconify-icon>
            <span>Quotation</span>
          </a>
        </li> -->

        <!-- -->
        <li class="sidebar-menu-group-title">Analysis</li>
        <li>
          <a href="<?= base_url(); ?>lbm-contribution">
            <iconify-icon icon="solar:calendar-outline" class="menu-icon"></iconify-icon>
            <span>LBM Contribution</span>
          </a>
          
        </li>
         <li>
          <a href="<?= base_url(); ?>company-liability-list">
            <iconify-icon icon="solar:calendar-outline" class="menu-icon"></iconify-icon>
            <span>Company Liability List</span>
          </a>
          
        </li>


        <li class="sidebar-menu-group-title">Masters</li>
        <li class="dropdown">
          <a href="javascript:void(0)">
            <iconify-icon icon="icon-park-outline:setting-two" class="menu-icon"></iconify-icon>
            <span>Accounts</span>
          </a>
          <ul class="sidebar-submenu">
            <li>
              <a href="<?= base_url(); ?>account-heads"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Account Head</a>
            </li>
            <li>
              <a href="<?= base_url(); ?>payment-modes"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Payment Modes</a>
            </li>

          </ul>
        </li>


        <li class="dropdown">
          <a href="javascript:void(0)">
            <iconify-icon icon="solar:calendar-outline" class="menu-icon"></iconify-icon>
            <span>Shares Masters</span>
          </a>
          <ul class="sidebar-submenu">
            <li>
              <a href="<?= base_url(); ?>company-valuation"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>Company Valuation</a>
            </li>
            <li>
              <a href="<?= base_url(); ?>shareholder-master"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i>
                Shareholder Master</a>
            </li>


          </ul>
        </li>

        <li>
          <a href="<?= base_url(); ?>staff">
            <iconify-icon icon="solar:document-text-outline" class="menu-icon"></iconify-icon>
            <span>Staff</span>
          </a>

        </li>
        <li>
          <a href="<?= base_url(); ?>property-type">
            <iconify-icon icon="heroicons:document" class="menu-icon"></iconify-icon>
            <span>Property Type</span>
          </a>

        </li>
        <li>
          <a href="<?= base_url(); ?>lbm">
            <iconify-icon icon="solar:pie-chart-outline" class="menu-icon"></iconify-icon>
            <span>Leadership Board Members</span>
          </a>

        </li>




      </ul>
    </div>
  </aside>

  <main class="dashboard-main">
    <div class="navbar-header">
      <div class="row align-items-center justify-content-between">
        <div class="col-auto">
          <div class="d-flex flex-wrap align-items-center gap-4">
            <button type="button" class="sidebar-toggle">
              <iconify-icon icon="heroicons:bars-3-solid" class="icon text-2xl non-active"></iconify-icon>
              <iconify-icon icon="iconoir:arrow-right" class="icon text-2xl active"></iconify-icon>
            </button>
            <button type="button" class="sidebar-mobile-toggle">
              <iconify-icon icon="heroicons:bars-3-solid" class="icon"></iconify-icon>
            </button>
            <form class="navbar-search">
              <input type="text" name="search" placeholder="Search">
              <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
            </form>
          </div>
        </div>
        <div class="col-auto">
          <div class="d-flex flex-wrap align-items-center gap-3">
            <button type="button" data-theme-toggle class="w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"></button>


            <div class="dropdown">
              <button class="d-flex justify-content-center align-items-center rounded-circle" type="button" data-bs-toggle="dropdown">
                <img src="<?= base_url(); ?>public/assets/images/avatars.jpg" alt="image" class="w-40-px h-40-px object-fit-cover rounded-circle">
              </button>
              <div class="dropdown-menu to-top dropdown-menu-sm">
                <div class="py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                  <div>
                    <?php if ($userdata): ?>
                      <h6 class="text-lg text-primary-light fw-semibold mb-2"><?= $userdata->username ?></h6>
                    <?php else: ?>
                      <p>Guest User</p>
                    <?php endif; ?>
                    <span class="text-secondary-light fw-medium text-sm">Admin</span>
                  </div>
                  <button type="button" class="hover-text-danger">
                    <iconify-icon icon="radix-icons:cross-1" class="icon text-xl"></iconify-icon>
                  </button>
                </div>
                <ul class="to-top-list">
                  <!-- <li>
                    <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3" href="view-profile.html">
                      <iconify-icon icon="solar:user-linear" class="icon text-xl"></iconify-icon> My Profile</a>
                  </li>
                  <li>
                    <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3" href="email.html">
                      <iconify-icon icon="tabler:message-check" class="icon text-xl"></iconify-icon> Inbox</a>
                  </li>
                  <li>
                    <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3" href="company.html">
                      <iconify-icon icon="icon-park-outline:setting-two" class="icon text-xl"></iconify-icon> Setting</a>
                  </li> -->
                  <li>
                    <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-danger d-flex align-items-center gap-3" href="<?= base_url(); ?>logout">
                      <iconify-icon icon="lucide:power" class="icon text-xl"></iconify-icon> Log Out</a>
                  </li>
                </ul>
              </div>
            </div><!-- Profile dropdown end -->
          </div>
        </div>
      </div>
    </div>

    <?= $this->renderSection("content"); ?>


    <footer class="d-footer">
      <div class="row align-items-center justify-content-between">
        <div class="col-auto">
          <p class="mb-0">© <?= date('Y'); ?> Consignus. All Rights Reserved.</p>
        </div>
        <div class="col-auto">
          <p class="mb-0">Made by <span class="text-primary-600">Signefo</span></p>
        </div>
      </div>
    </footer>
  </main>


  <?= $this->renderSection("scripts"); ?>

  <!-- jQuery library js -->
  <script src="<?= base_url(); ?>public/assets/js/lib/jquery-3.7.1.min.js"></script>
  <!-- Bootstrap js -->
  <script src="<?= base_url(); ?>public/assets/js/lib/bootstrap.bundle.min.js"></script>

  <!-- Data Table js -->
  <script src="<?= base_url(); ?>public/assets/js/lib/dataTables.min.js"></script>
  <!-- Iconify Font js -->
  <script src="<?= base_url(); ?>public/assets/js/lib/iconify-icon.min.js"></script>
  <!-- jQuery UI js -->
  <script src="<?= base_url(); ?>public/assets/js/lib/jquery-ui.min.js"></script>
  <!-- Vector Map js -->
  <script src="<?= base_url(); ?>public/assets/js/lib/jquery-jvectormap-2.0.5.min.js"></script>
  <script src="<?= base_url(); ?>public/assets/js/lib/jquery-jvectormap-world-mill-en.js"></script>
  <!-- Popup js -->
  <script src="<?= base_url(); ?>public/assets/js/lib/magnifc-popup.min.js"></script>
   <!-- Popup js -->

  <!-- Slick Slider js -->
  <script src="<?= base_url(); ?>public/assets/js/lib/slick.min.js"></script>
  <!-- prism js -->
  <script src="<?= base_url(); ?>public/assets/js/lib/prism.js"></script>
  <!-- file upload js -->
  <script src="<?= base_url(); ?>public/assets/js/lib/file-upload.js"></script>
  <!-- audioplayer -->
  <script src="<?= base_url(); ?>public/assets/js/lib/audioplayer.js"></script>

  <!-- main js -->
  <script src="<?= base_url(); ?>public/assets/js/app.js"></script>
  





  <script>
    let table = new DataTable('#dataTable');
  </script>


</body>

</html>