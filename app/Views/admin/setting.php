<?= $this->extend('layouts/admin') ?>

<!-- Styles -->
<?= $this->section("style") ?>
<style>

</style>
<?= $this->endSection() ?>

<!-- Contents -->
<?= $this->section("content") ?>
<?php
    use \App\Helpers\STAR;
?>
<!-- Main -->
<div class="row mt-2">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h2>Setting</h2>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <form action="<?= site_url('/admin/setting/do_apply'); ?>" method="POST">
            <div class="row">
                <div class="col-md-6" style="border-right: 1px solid #333;">
                    <div class="form-group">
                        <label for="sl-role">Select Static Role</label>
                        <select name="staticrole" id="sl-role" class="form-control">
                            <?php
                                $stars = STAR::staticRoles();
                            ?>
                            <?php foreach($stars as $key => $value) { ?>
                                <option value="<?= $key ?>" <?= $key == $staticrole ? "selected" : "" ?>><?= $value ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sl-role">Select Scripted Role</label>
                        <select name="scriptedrole" id="sl-role" class="form-control">
                            <?php foreach($scriptedroles as $scr) { ?>
                                <option value="<?= $scr["id"] ?>" <?= $scr["id"] == $scriptedrole ? "selected" : "" ?>><?= $scr["name"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-dark col-12">Save</button>
                </div>
                <div class="col-md-6">
                </div>
                
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<!-- Scripts -->
<?= $this->section("script") ?>
<script>

</script>
<?= $this->endSection() ?>