<!-- meta tags and other links -->
<?php
$page_session = \Config\Services::session();
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consignus | Login</title>
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
</head>

<body>

    <section class="auth bg-base d-flex flex-wrap">
        <div class="auth-left d-lg-block d-none">
            <!-- h-100 -->
            <div class="d-flex align-items-center flex-column  justify-content-center">
                <img src="<?= base_url(); ?>public/assets/images/auth/lbmpanel1.jpg" alt="">
            </div>
        </div>
        <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">

            <div class="max-w-464-px mx-auto w-100">
                <div>
                    <a href="index.html" class="mb-40 max-w-290-px">
                        <img src="<?= base_url(); ?>public/assets/images/consignlogo.svg" alt="">
                    </a>
                    <h5 class="mb-12">Sign In to your Account</h5>
                    <p class="mb-32 text-secondary-light text-lg">Welcome back! please enter your detail</p>
                </div>
              
                <?= form_open('lbmlogin-form'); ?>
                <div class="icon-field">
                    <span class="icon top-50 translate-middle-y">
                        <iconify-icon icon="mage:email"></iconify-icon>
                    </span>
                    <input type="email" class="form-control h-56-px bg-neutral-50 radius-12" placeholder="Email" name="email" id="email" value="<?= set_value('email'); ?>">
                 
                </div>
   <span class="text-danger"><?= display_errors($validation ?? null, 'email'); ?></span>
                <div class="position-relative mb-15">
                    <div class="icon-field">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                        </span>
                        <input type="password" class="form-control h-56-px bg-neutral-50 radius-12" value="<?= set_value('password'); ?>" name="password" id="password" placeholder="Password">
                    </div>
                    <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#password"></span>
                   
                </div>
 <span class="text-danger"><?= display_errors($validation ?? null, 'password'); ?></span>
                <!-- <div class=""> -->
                <!-- <div class="d-flex justify-content-between gap-2">
                        <div class="form-check style-check d-flex align-items-center">
                            <input class="form-check-input border border-neutral-300" type="checkbox" value="" id="remeber">
                            <label class="form-check-label" for="remeber">Remember me </label>
                        </div>
                        <a href="javascript:void(0)" class="text-primary-600 fw-medium">Forgot Password?</a>
                    </div> -->
                <!-- </div> -->

                <button type="submit" name="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32"> Sign In</button>

                <!-- <div class="mt-32 center-border-horizontal text-center">
                    <span class="bg-base z-1 px-4">Or sign in with</span>
                </div> -->
                <!-- <div class="mt-32 d-flex align-items-center gap-3">
                    <button type="button" class="fw-semibold text-primary-light py-16 px-24 w-50 border radius-12 text-md d-flex align-items-center justify-content-center gap-12 line-height-1 bg-hover-primary-50">
                        <iconify-icon icon="ic:baseline-facebook" class="text-primary-600 text-xl line-height-1"></iconify-icon>
                        Google
                    </button>
                    <button type="button" class="fw-semibold text-primary-light py-16 px-24 w-50 border radius-12 text-md d-flex align-items-center justify-content-center gap-12 line-height-1 bg-hover-primary-50">
                        <iconify-icon icon="logos:google-icon" class="text-primary-600 text-xl line-height-1"></iconify-icon>
                        Google
                    </button>
                </div> -->
                <div class="mt-32 text-center text-sm">
                    <p class="mb-0">Don’t have an account? <a href="<?= base_url('registration'); ?>" class="text-primary-600 fw-semibold">Sign Up</a></p>
                </div>

                <?= form_close(); ?>
            </div>
        </div>
    </section>

    <!-- jQuery library js -->
    <script src="<?= base_url(); ?>public/assets/js/lib/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap js -->
    <script src="<?= base_url(); ?>public/assets/js/lib/bootstrap.bundle.min.js"></script>
    <!-- Apex Chart js -->
    <script src="<?= base_url(); ?>public/assets/js/lib/apexcharts.min.js"></script>
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
        // ================== Password Show Hide Js Start ==========
        function initializePasswordToggle(toggleSelector) {
            $(toggleSelector).on('click', function() {
                $(this).toggleClass("ri-eye-off-line");
                var input = $($(this).attr("data-toggle"));
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        }
        // Call the function
        initializePasswordToggle('.toggle-password');
        // ========================= Password Show Hide Js End ===========================
    </script>

</body>

</html>