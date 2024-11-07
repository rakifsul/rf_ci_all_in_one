<?= $this->extend('layouts/admin') ?>

<!-- Styles Library -->
<?= $this->section("style-lib") ?>

<link rel="stylesheet" href="<?= base_url('/assets/library/quill2/quill.snow.css'); ?>">

<?= $this->endSection() ?>

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
        <h2>Editor Quill2</h2>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <form action="<?= site_url("/admin/editor-quill2/do_update"); ?>" method="post" id="form-article">
            <div class="row">
                <div class="col-md-6" style="border-right: 1px solid #333;">
                    <div class="form-group">
                        <label for="quill-content" class="col-form-label">Content</label>
                        <textarea name="content" id="txa-content" class="form-control" cols="30" rows="10" style="display: none;"></textarea>
                        <div id="quill-content">
                           
                           
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark col-12">Save</button>
                </div>
                <div class="col-md-6">
                    <pre>
                        <?= $content; ?>
                    </pre>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal-get-image" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">DblClick to Select Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="my-modal-body" class="row">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection() ?>

<!-- Scripts Library-->
<?= $this->section("script-lib") ?>

<script src="<?= base_url('/assets/library/quill2/quill.js'); ?>"></script>

<?= $this->endSection() ?>

<!-- Scripts -->
<?= $this->section("script") ?>
<script>
let quill = createQuill2Editor("quill-content");

$("#form-article").on("submit", function () {
    $("#txa-content").val(document.querySelector('#quill-content').children[0].innerHTML);
});
</script>
<?= $this->endSection() ?>