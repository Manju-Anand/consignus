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
  <!-- DataTables core CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">



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
  <div id="particles-js"></div>

  <style>
    #particles-js {
      position: fixed;
      width: 100%;
      height: 100%;
      z-index: 9999;

      pointer-events: none;

    }
  </style>
  <canvas id="scrollCanvas"></canvas>

  <style>
    #scrollCanvas {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: 9999;
    }
  </style>




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
          <a href="<?= base_url(); ?>lbmpanel/home">
            <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
            <span>Dashboard</span>
          </a>

        </li>
        <li class="sidebar-menu-group-title">Application</li>
       
        <li>
          <a href="<?= base_url(); ?>lbmpanel/property">
            <iconify-icon icon="hugeicons:invoice-03" class="menu-icon"></iconify-icon>
            <span>Properties</span>
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
            <!-- <form class="navbar-search">
              <input type="text" name="search" placeholder="Search">
              <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
            </form> -->
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
                    <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-danger d-flex align-items-center gap-3" href="<?= base_url(); ?>lbmpanel/logout">
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



  <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
  <script>
    const canvas = document.getElementById("scrollCanvas");
    const ctx = canvas.getContext("2d");
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    let particles = [];

    function createStarParticle(x, y) {
      const colors = ["#FF1461", "#18FF92", "#5A87FF", "#FBF38C"];
      return {
        x,
        y,
        radius: Math.random() * 3 + 2,
        color: colors[Math.floor(Math.random() * colors.length)],
        alpha: 1,
        dx: (Math.random() - 0.5) * 2,
        dy: (Math.random() - 0.5) * 2,
        rotation: Math.random() * Math.PI * 2,
        rotationSpeed: (Math.random() - 0.5) * 0.1
      };
    }

    function drawStar(x, y, radius, color, alpha, rotation) {
      const spikes = 5;
      const outerRadius = radius;
      const innerRadius = radius / 2;

      ctx.save();
      ctx.beginPath();
      ctx.translate(x, y);
      ctx.rotate(rotation);
      ctx.moveTo(0, -outerRadius);
      for (let i = 0; i < spikes; i++) {
        ctx.rotate(Math.PI / spikes);
        ctx.lineTo(0, -innerRadius);
        ctx.rotate(Math.PI / spikes);
        ctx.lineTo(0, -outerRadius);
      }
      ctx.closePath();
      ctx.globalAlpha = alpha;
      ctx.fillStyle = color;
      ctx.fill();
      ctx.restore();
      ctx.globalAlpha = 1;
    }

    function animate() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      particles.forEach((p, index) => {
        p.x += p.dx;
        p.y += p.dy;
        p.rotation += p.rotationSpeed;
        p.alpha -= 0.02;

        if (p.alpha <= 0) {
          particles.splice(index, 1);
          return;
        }

        drawStar(p.x, p.y, p.radius, p.color, p.alpha, p.rotation);
      });

      requestAnimationFrame(animate);
    }
    animate();

    // Trigger on scroll
    window.addEventListener("wheel", (e) => {
      const x = e.clientX || window.innerWidth / 2;
      const y = e.clientY || window.innerHeight / 2;
      for (let i = 0; i < 10; i++) {
        particles.push(createStarParticle(x, y));
      }
    });

    // Trigger on click
    window.addEventListener("click", (e) => {
      const x = e.clientX;
      const y = e.clientY;
      for (let i = 0; i < 15; i++) {
        particles.push(createStarParticle(x, y));
      }
    });

    // Optional: touch support
    window.addEventListener("touchmove", (e) => {
      const touch = e.touches[0];
      for (let i = 0; i < 8; i++) {
        particles.push(createStarParticle(touch.clientX, touch.clientY));
      }
    });

    // Resize canvas when screen size changes
    window.addEventListener("resize", () => {
      canvas.width = window.innerWidth;
      canvas.height = window.innerHeight;
    });
  </script>
  <script>
    particlesJS("particles-js", {
      "particles": {
        "number": {
          "value": 40,
          "density": {
            "enable": true,
            "value_area": 800
          }
        },
        "color": {
          "value": ["#FF1461", "#18FF92", "#5A87FF", "#FBF38C"]
        },
        "shape": {
          "type": "circle"
        },
        "opacity": {
          "value": 0.6,
          "random": true
        },
        "size": {
          "value": 4,
          "random": true
        },
        "move": {
          "enable": true,
          "speed": 2,
          "direction": "top-right",
          "random": false,
          "straight": false,
          "out_mode": "out"
        }
      },
      "interactivity": {
        "detect_on": "canvas",
        "events": {
          "onhover": {
            "enable": false
          },
          "onclick": {
            "enable": false
          },
          "onresize": {
            "enable": true
          },
          "onscroll": {
            "enable": true,
            "mode": "repulse"
          }
        }
      },
      "retina_detect": true
    });
  </script>
  <?= $this->renderSection("scripts"); ?>
</body>

</html>