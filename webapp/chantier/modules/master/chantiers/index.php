<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/chantier/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/chantier/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

            <?php include($this->rootPath("webapp/chantier/elements/templates/header.php")); ?>  


            <div class="wrapper wrapper-content">
                <div class="text-center animated fadeInRightBig">

                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="ibox">
                                <div class="ibox-content product-box">

                                    <div class="product-imitation">
                                        [ image chantier ]
                                    </div>
                                    <div class="product-desc">
                                        <small class="text-muted">Autorisation N°sdbfklbsbkjb</small>
                                        <h3>Titre du chantier</h3>
                                        <div class="small m-t-xs">le lieu du chantier</div>
                                        <div class="m-t text-righ">

                                            <a href="<?php $this->url("chantier", "master", "chantier") ?>" class="btn btn-xs btn-outline btn-primary">Aller au chantier <i class="fa fa-long-arrow-right"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="ibox">
                                <div class="ibox-content product-box">

                                    <div class="product-imitation">
                                        [ INFO ]
                                    </div>
                                    <div class="product-desc">
                                        <span class="product-price">
                                            $10
                                        </span>
                                        <small class="text-muted">Category</small>
                                        <a href="#" class="product-name"> Product</a>



                                        <div class="small m-t-xs">
                                            Many desktop publishing packages and web page editors now.
                                        </div>
                                        <div class="m-t text-righ">

                                            <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="ibox">
                                <div class="ibox-content product-box active">

                                    <div class="product-imitation">
                                        [ INFO ]
                                    </div>
                                    <div class="product-desc">
                                        <span class="product-price">
                                            $10
                                        </span>
                                        <small class="text-muted">Category</small>
                                        <a href="#" class="product-name"> Product</a>
                                        <div class="small m-t-xs">
                                            Many desktop publishing packages and web page editors now.
                                        </div>
                                        <div class="m-t text-righ">

                                            <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="ibox">
                                <div class="ibox-content product-box">

                                    <div class="product-imitation">
                                        [ INFO ]
                                    </div>
                                    <div class="product-desc">
                                        <span class="product-price">
                                            $10
                                        </span>
                                        <small class="text-muted">Category</small>
                                        <a href="#" class="product-name"> Product</a>



                                        <div class="small m-t-xs">
                                            Many desktop publishing packages and web page editors now.
                                        </div>
                                        <div class="m-t text-righ">

                                            <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>


            <?php include($this->rootPath("webapp/chantier/elements/templates/footer.php")); ?>


        </div>
    </div>


    <?php include($this->rootPath("webapp/chantier/elements/templates/script.php")); ?>


</body>

</html>
