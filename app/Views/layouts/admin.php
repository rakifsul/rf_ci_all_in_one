<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?= $title; ?>
    </title>

    <link rel="stylesheet" href="<?= base_url('/assets/library/bootstrap/css/bootstrap.css'); ?>" />

    <?= $this->renderSection("style-lib") ?>

    <link rel="stylesheet" href="<?= base_url('/assets/css/admin.css'); ?>" />

    <?= $this->renderSection("style") ?>
</head>

<body>
    <div id="sidebar" class="sidebar bg-dark">
        <div class="sidebar-brand">
            <!-- <img class="img-fluid sidebar-brand-img mx-auto d-block" src="/public/img/icon.png" alt="icon" width="200" height="200"> -->
            <h3 class="text-white text-center">CI CRUD</h3>
        </div>
        <!-- <hr class="bg-light"> -->
        <ul class="sidebar-ul">
            <li class="sidebar-li">
                <a class="btn btn-outline-light w-100 btn-mobile" data-url="<?= site_url(" /admin");?>" href="<?= site_url(" /admin");?>"><span class="elm-visible-mobile">DS</span><span class="elm-visible-desktop">Dashboard</span></a>
            </li>
            <li class="sidebar-li">
                <a class="btn btn-outline-light w-100 btn-mobile" data-url="<?= site_url(" /admin/setting");?>" href="<?= site_url(" /admin/setting");?>"><span class="elm-visible-mobile">ST</span><span class="elm-visible-desktop">Setting</span></a>
            </li>
            <p class="text-success text-center mb-0 mt-2">Dynamic Access Rights</p>
            <li class="sidebar-li">
                <a class="btn btn-outline-light w-100 btn-mobile" data-url="<?= site_url(" /admin/scripted-access-right");?>" href="<?= site_url(" /admin/scripted-access-right");?>"><span class="elm-visible-mobile">SR</span><span class="elm-visible-desktop">Scripted Access Right</span></a>
            </li>
            <p class="text-success text-center mb-0 mt-2">CRUD Basics</p>
            <li class="sidebar-li">
                <a class="btn btn-outline-light w-100 btn-mobile" data-url="<?= site_url(" /admin/attachment");?>" href="<?= site_url(" /admin/attachment");?>"><span class="elm-visible-mobile">AC</span><span class="elm-visible-desktop">Attachments</span></a>
            </li>
            <li class="sidebar-li">
                <a class="btn btn-outline-light w-100 btn-mobile" data-url="<?= site_url(" /admin/attachment2");?>" href="<?= site_url(" /admin/attachment2");?>"><span class="elm-visible-mobile">AC</span><span class="elm-visible-desktop">Attachments2</span></a>
            </li>
            <p class="text-success text-center mb-0 mt-2">Editor Integrations</p>
            <li class="sidebar-li">
                <a class="btn btn-outline-light w-100 btn-mobile" data-url="<?= site_url(" /admin/editor-quill");?>" href="<?= site_url(" /admin/editor-quill");?>"><span class="elm-visible-mobile">EQ</span><span class="elm-visible-desktop">Editor Quill</span></a>
            </li>
            <li class="sidebar-li">
                <a class="btn btn-outline-light w-100 btn-mobile" data-url="<?= site_url(" /admin/editor-quill2");?>" href="<?= site_url(" /admin/editor-quill2");?>"><span class="elm-visible-mobile">EQ2</span><span class="elm-visible-desktop">Editor Quill2</span></a>
            </li>
            <p class="text-success text-center mb-0 mt-2">Access Rights Test</p>
            <li class="sidebar-li">
                <a class="btn btn-outline-light w-100 btn-mobile" data-url="<?= site_url(" /admin/user-access");?>" href="<?= site_url(" /admin/user-access");?>"><span class="elm-visible-mobile">UA</span><span class="elm-visible-desktop">User Access</span></a>
            </li>
            <li class="sidebar-li">
                <a class="btn btn-outline-light w-100 btn-mobile" data-url="<?= site_url("/admin/superuser-access");?>" href="<?= site_url("/admin/superuser-access");?>"><span class="elm-visible-mobile">SA</span><span class="elm-visible-desktop">SuperUser Access</span></a>
            </li>
        </ul>
    </div>

    <div class="main">
        <!-- Top Nav -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-url="<?= site_url("/admin") ?>" href="<?= site_url("/admin");?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-url="<?= site_url("/admin/settings") ?>" href="<?= site_url("/admin/settings") ?>">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-url="<?= site_url("/auth/do_logout") ?>" href="<?= site_url("/auth/do_logout");?>">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Content -->
        <div class="container-fluid">
            <?= $this->renderSection("content") ?>
        </div>
    </div>

    <!-- Footer -->
    <!-- <footer class="footer">
        <nav class="navbar fixed-bottom navbar-expand-lg navbar-dark bg-success">
            <a class="navbar-brand" href="javascript:void(0);">By RAKIFSUL</a>
        </nav>
    </footer> -->

    <!-- 3rd Party Scripts -->
    <script src="<?= base_url('/assets/library/jquery/jquery.js'); ?>"></script>
    <script src="<?= base_url('/assets/library/bootstrap/js/bootstrap.bundle.js'); ?>"></script>

    <?= $this->renderSection("script-lib") ?>

    <!-- Primary Scripts -->
    <script src="<?= base_url('/assets/js/admin.js'); ?>"></script>

    <!-- Primary Scripts Implementation -->
     <script>
        // highlight active sidebar item
        $("ul.sidebar-ul li a").each(function() {
            const dataUrl = $(this).attr("data-url");
            if(dataUrl === window.location.href){
                $(this).addClass("active");
            }
        });

        // highlight active topbar item
        $("ul.navbar-nav li a").each(function() {
            const dataUrl = $(this).attr("data-url");
            if(dataUrl === window.location.href){
                $(this).addClass("active");
            }
        });
     </script>

    <!-- Local Scripts -->
    <?= $this->renderSection("script") ?>
</body>

</html>