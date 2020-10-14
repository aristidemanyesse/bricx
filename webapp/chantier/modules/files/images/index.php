<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/chantier/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/chantier/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

            <?php include($this->rootPath("webapp/chantier/elements/templates/header.php")); ?>  

            <div class="wrapper wrapper-content">
                <div class="animated fadeInRightBig">

                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Images du chantier</h5>
                            <div class="ibox-tools">
                                <button data-toggle="modal" data-target="#modal-image" class="btn btn-xs btn-default dim" style="margin-top: -5%"><i class="fa fa-plus"></i> AJouter nouvelle image</button>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="lightBoxGallery row">
                                <?php foreach ($images as $key => $image) { ?>
                                    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                        <a href="<?= $this->stockage("images", "imageschantiers", $image->image);  ?>" title="<?= $image->name() ?>" data-gallery=""><img class="img-thumbnail" style="width: 100%" src="<?= $this->stockage("images", "imageschantiers", $image->image);  ?>"></a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
            <div id="blueimp-gallery" class="blueimp-gallery">
                <div class="slides"></div>
                <h3 class="title"></h3>
                <a class="prev">‹</a>
                <a class="next">›</a>
                <a class="close">×</a>
                <a class="play-pause"></a>
                <ol class="indicator"></ol>
            </div>


            <?php include($this->rootPath("webapp/chantier/elements/templates/footer.php")); ?>


        </div>
    </div>


    <?php include($this->rootPath("webapp/chantier/elements/templates/script.php")); ?>

    <?php include($this->rootPath("composants/assets/modals/modal-image.php")); ?>  

</body>

</html>
