<?= $this->extend('layouts/auth') ?>

<!-- Styles -->
<?= $this->section("style") ?>
<style>

</style>
<?= $this->endSection() ?>

<!-- Contents -->
<?= $this->section("content") ?>

<div class="row">
    <div class="col-md">
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalTitle">
                Login
                </h5>
            </div>
            
            <?php if(session()->getFlashdata("error")) { ?>
              <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata("error"); ?>
              </div>
            <?php } ?>
           
            <form action="<?= site_url('/auth/do_login'); ?>" method="POST">
                <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                </div>
                <div class="modal-footer">
                <a class="btn btn-dark" href="<?= site_url('/'); ?>">To Home</a>
                <a class="btn btn-dark" href="<?= site_url('/auth/register'); ?>">To Register</a>
                <button type="submit" class="btn btn-dark">Log In</button>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<!-- Scripts -->
<?= $this->section("script") ?>
<script>
  showAuthModal("loginModal");
</script>
<?= $this->endSection() ?>