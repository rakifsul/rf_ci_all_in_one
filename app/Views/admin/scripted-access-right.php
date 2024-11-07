<?= $this->extend('layouts/admin') ?>

<!-- Styles -->
<?= $this->section("style") ?>
<style>

</style>
<?= $this->endSection() ?>

<!-- Contents -->
<?= $this->section("content") ?>

<!-- Main -->
<div class="row mt-2">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h2>Scripted Access</h2>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <form action="<?= site_url("/admin/scripted-access-right/do_add"); ?>" method="post" id="form-role-add">
            <div class="row">
                <div class="col-md-6" style="border-right: 1px solid #333;">
                    <div class="form-group">
                        <label for="tx-role-name">Role Name</label>
                        <input type="text" class="form-control" id="tx-role-name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="txa-role-script" class="col-form-label">Role Script</label>
                        <textarea name="script" id="txa-role-script" class="form-control" cols="30" rows="20"></textarea>
                    </div>
                    <button type="submit" class="btn btn-dark col-12">Save</button>
                </div>
                <div class="col-md-6" style="max-height: 74vh; overflow-y: scroll;">
                    <?php foreach($results as $result) {?>
                        <pre style="max-height: 20vh; overflow-y: scroll;">
                            <?php
                            echo "<br>"."// name: ".$result["name"]."<br>";
                            echo "<br>";
                            echo "// script: "."<br>";
                            echo $result["script"]."<br>";
                            echo "<br>";
                            echo "// output: "."<br>";
                            var_dump(eval($result["script"]));
                            ?>
                        </pre>
                        <a class="btn btn-danger btn-smaller w-100" href="<?= site_url("/admin/scripted-access-right/do_delete/".$result["id"]); ?>">Delete</a>
                    <?php } ?>
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