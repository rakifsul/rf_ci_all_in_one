<?= $this->extend('layouts/admin') ?>

<!-- Styles -->
<?= $this->section("style") ?>
<style>

</style>
<?= $this->endSection() ?>

<!-- Contents -->
<?= $this->section("content") ?>

<?php
    use \App\Helpers\G;
    // $sq="sdf";
?>

<!-- Main -->
<div class="row mt-2">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h2>Attachment2 List</h2>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="clearfix">
            <button id="btn-upload-file" class="btn btn-dark float-end">Upload File</button>
            <div class="form-inline">
                <input id="query" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="sq" value="<?= $sq ?>">
                <button id="btn-search" onclick="search();" class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
            </div>
        </div>
        <hr>
        <a href="<?= site_url("/admin/attachment2"); ?>"><span class="badge bg-dark">all</span></a>
        <?php foreach($resultTags as $item) { ?>
            <a href="<?= site_url("/admin/attachment2/?tag=".$item); ?>"><span class="bdg badge"><?= $item ?></span></a>
        <?php } ?>
        <hr>
        <div class="table-responsive mt-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Path</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($resultFiles as $item) { ?>
                    <tr>
                        <th scope="row"><?= $item["id"] ?></th>
                        <td><?= $item["title"] ?></td>
                        <td><?= $item["path"] ?></td>
                        <td>
                            <?php 
                                $iarr = explode(",", $item["tags"]); 
                                foreach($iarr as $i) { ?>
                                <a href="<?= site_url("/admin/attachment2/?tag=".$i); ?>"><span class="bdg badge"><?= $i ?></span></a>
                            <?php } ?>
                        </td>
                        <td>
                            <a class="btn btn-warning btn-smaller" href="<?= site_url("/admin/attachment2/do_download/".$item["id"]); ?>">DL</a>
                            <button class="btn-edit-file btn btn-success btn-smaller" data-id="<?= $item["id"] ?>" data-title="<?= $item["title"] ?>" data-tags="<?= $item["tags"] ?>">ED</button>
                            <a class="btn btn-danger btn-smaller" href="<?= site_url("/admin/attachment2/do_delete/".$item["id"]); ?>">DT</a>
                        </td>
                    </tr>    
                <?php } ?>
            </tbody>
        </table>
        </div>

        <!-- <pre>
            <?= $pagination["page"] ?>
            <?= $pagination["perPage"] ?>
            <?= $pagination["pageCount"] ?>
        </pre> -->
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <nav aria-label="Page navigation example">
            <?php $prevPGN = G::pgnPrevious($pagination["page"]); $nextPGN = G::pgnNext($pagination["page"], $pagination["pageCount"]); ?>
            <ul class="pagination">
                <li class="page-item <?php if ($prevPGN['disabled']) { ?>disabled<?php } ?>">
                    <a class="page-link" href="<?= site_url("/admin/attachment2/?page="); ?><?= $prevPGN['index'] ?><?= $tag != "" ? "&tag=".$tag : "" ?><?= $sq != "" ? "&sq=".$sq : "" ?>">Previous</a>
                </li>

                <?php for($i = 0; $i < $pagination['pageCount']; ++$i){ ?>
                    <li class="page-item <?php if($pagination['page'] == $i){ ?> active <?php } ?>">
                        <a class="page-link" href="<?= site_url("/admin/attachment2/?page="); ?><?= $i ?><?= $tag != "" ? "&tag=".$tag : "" ?><?= $sq != "" ? "&sq=".$sq : "" ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php } ?>

                <li class="page-item <?php if ($nextPGN['disabled']) { ?>disabled<?php } ?>">
                    <a class="page-link" href="<?= site_url("/admin/attachment2/?page="); ?><?= $nextPGN['index'] ?><?= $tag != "" ? "&tag=".$tag : "" ?><?= $sq != "" ? "&sq=".$sq : "" ?>">Next</a>
                </li>
            </ul>
            <!-- <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul> -->
        </nav>
    </div>
</div>

<!-- Modal Add-->
<div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= site_url("/admin/attachment2/do_upload"); ?>" method="post" onsubmit="return parseTagsInput('txa-tags', 'txa-div-tags')" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title-add">Title</label>
                        <input type="text" class="form-control" id="title-add" name="title">
                    </div>

                    <div class="form-group">
                        <label for="tx-tags" class="col-form-label">Tags</label>
                        <input type="text" value="" class="form-control mb-2" id="tx-tags" />

                        <textarea name="tags" style="display:none" id="txa-tags"></textarea>
                        <div id="txa-div-tags">
                        </div>
                    </div>

                    <div class="form-group">
                        <input id="fl-file" type="file" name="upload" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit-->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Uploaded File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= site_url("/admin/attachment2/do_upload"); ?>" method="post" onsubmit="return parseTagsInput('txa-edit-tags', 'txa-edit-div-tags')" enctype="multipart/form-data">
                <div class="modal-body">
                    <input id="hd-edit-id" type="hidden" name="editId">

                    <div class="form-group">
                        <label for="tx-edit-title">Title</label>
                        <input type="text" class="form-control" id="tx-edit-title" name="title">
                    </div>
                    <div class="form-group">
                        <label for="tx-edit-tags" class="col-form-label">Tags</label>
                        <input type="text" value="" class="form-control mb-2" id="tx-edit-tags" />

                        <textarea name="tags" style="display:none" id="txa-edit-tags"></textarea>
                        <div id="txa-edit-div-tags">
                        </div>
                    </div>
                    <div class="form-group">
                        <input id="fl-edit-file" type="file" name="upload" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<!-- Scripts -->
<?= $this->section("script") ?>
<script>
    // 
    registerShowUploadModalOnClick("btn-upload-file", "modal-add");

    // 
    registerTagEntryCharacter("tx-tags", "txa-div-tags", ",");

    //
    registerTagEntryRemoval("txa-div-tags");

    // registerShowUploadModalOnClick("btn-edit-file", "modal-edit");
    $(`.btn-edit-file`).click(function (e) {
        e.preventDefault();
        
        const dataId = $(this).attr("data-id");
        const dataTitle = $(this).attr("data-title");
        const dataTags = $(this).attr("data-tags").split(",");
        // console.log(dataId);

        let authModal = new bootstrap.Modal($(`#modal-edit`), { backdrop: "static", keyboard: false });

        $("#hd-edit-id").val(dataId);

        $("#tx-edit-title").val(dataTitle);

        $(`#txa-edit-div-tags`).empty();
        dataTags.forEach((item) => {
            $(`#txa-edit-div-tags`).append(`<span class="badge bg-${randomizeTagsColor()}">${item}</span> `);
        });
        authModal.show();
    });

    // 
    registerTagEntryCharacter("tx-edit-tags", "txa-edit-div-tags", ",");

    //
    registerTagEntryRemoval("txa-edit-div-tags");

    

    //
    
    let elms = $(".bdg");
    elms.each(function(){
        let rndColor = randomizeTagsColor();
        $(this).addClass(`bg-${rndColor}`)
    })

    function search() {
        window.location = "<?= site_url("/admin/attachment2/?sq="); ?>" + $("#query").val();
    }
</script>
<?= $this->endSection() ?>