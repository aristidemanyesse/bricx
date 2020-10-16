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

                    <div class="row">
                        <div class="col-lg-8 animated fadeInRight">
                            <div class="ibox">
                                <div class="ibox-title">
                                    <h5>Documents du chantier</h5>
                                    <div class="ibox-tools">
                                        <button data-toggle="modal" data-target="#modal-document" class="btn btn-xs btn-default dim" style="margin-top: -5%"><i class="fa fa-plus"></i> AJouter nouveau document</button>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="row">
                                        <?php foreach ($documents as $key => $document) { ?>
                                            <div class=" col-sm-6 col-md-4">
                                                <div class="file-box">
                                                    <div class="file cursor" url="<?= $this->stockage("documents", "documentschantiers", $document->image) ?>">
                                                        <span class="corner"></span>
                                                        <div class="icon">
                                                            <i class="img-fluid fa fa-files-o"></i>
                                                        </div>
                                                        <div class="file-name">
                                                            <?= $document->name() ?>
                                                            <br/>
                                                            <small>Fichier <?= $document->image ?></small><br>
                                                            <small><?= datelong($document->created) ?></small>
                                                        </div>
                                                    </div>
                                                </div>                                    
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5><i class="fa fa-file-pdf-o"></i> Aperçu des fichiers au format pdf</h5>
                                </div>
                                <div class="ibox-content" >
                                    <div style="overflow-x: scroll;">
                                        <canvas id="the-canvas" class="pdfcanvas border-left-right border-top-bottom b-r-md"></canvas>
                                    </div>
                                    <div class="text-center pdf-toolbar">
                                        <div class="row">
                                            <div class="btn-group col-md-8">
                                                <button id="prev" class="btn btn-white btn-xs"><i class="fa fa-long-arrow-left"></i> <span class="d-none d-sm-inline"></span></button>

                                                <button id="zoomout" class="btn btn-white btn-xs"><i class="fa fa-search-minus"></i> <span class="d-none d-sm-inline"></span></button>
                                                <button id="zoomfit" class="btn btn-white btn-xs"> 100%</button>
                                                <button id="zoomin" class="btn btn-white btn-xs"><i class="fa fa-search-plus"></i> <span class="d-none d-sm-inline"></span> </button>

                                                <button id="next" class="btn btn-white btn-xs"><i class="fa fa-long-arrow-right"></i> <span class="d-none d-sm-inline"></span></button>
                                            </div>

                                            <div class="btn-group col-md-4">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="page_num">

                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-white btn-xs" id="page_count">/ 22</button>
                                                    </div>
                                                </div>
                                            </div>
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

    <?php include($this->rootPath("composants/assets/modals/modal-document.php")); ?>  


    <script id="script">
        //
        // If absolute URL from the remote server is provided, configure the CORS
        // header on that server.
        //
        var url = './pdf/example.pdf';


        var pdfDoc = null,
        pageNum = 1,
        pageRendering = false,
        pageNumPending = null,
        scale = 0.5,
        zoomRange = 0.25,
        canvas = document.getElementById('the-canvas'),
        ctx = canvas.getContext('2d');

        /**
         * Get page info from document, resize canvas accordingly, and render page.
         * @param num Page number.
         */
         function renderPage(num, scale) {
            pageRendering = true;
            // Using promise to fetch the page
            pdfDoc.getPage(num).then(function(page) {
                var viewport = page.getViewport(scale);
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render PDF page into canvas context
                var renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };
                var renderTask = page.render(renderContext);

                // Wait for rendering to finish
                renderTask.promise.then(function () {
                    pageRendering = false;
                    if (pageNumPending !== null) {
                        // New page rendering is pending
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }
                });
            });

            // Update page counters
            document.getElementById('page_num').value = num;
        }

        /**
         * If another page rendering in progress, waits until the rendering is
         * finised. Otherwise, executes rendering immediately.
         */
         function queueRenderPage(num) {
            if (pageRendering) {
                pageNumPending = num;
            } else {
                renderPage(num,scale);
            }
        }

        /**
         * Displays previous page.
         */
         function onPrevPage() {
            if (pageNum <= 1) {
                return;
            }
            pageNum--;
            var scale = pdfDoc.scale;
            queueRenderPage(pageNum, scale);
        }
        document.getElementById('prev').addEventListener('click', onPrevPage);

        /**
         * Displays next page.
         */
         function onNextPage() {
            if (pageNum >= pdfDoc.numPages) {
                return;
            }
            pageNum++;
            var scale = pdfDoc.scale;
            queueRenderPage(pageNum, scale);
        }
        document.getElementById('next').addEventListener('click', onNextPage);

        /**
         * Zoom in page.
         */
         function onZoomIn() {
            if (scale >= pdfDoc.scale) {
                return;
            }
            scale += zoomRange;
            var num = pageNum;
            renderPage(num, scale)
        }
        document.getElementById('zoomin').addEventListener('click', onZoomIn);

        /**
         * Zoom out page.
         */
         function onZoomOut() {
            if (scale >= pdfDoc.scale) {
                return;
            }
            scale -= zoomRange;
            var num = pageNum;
            queueRenderPage(num, scale);
        }
        document.getElementById('zoomout').addEventListener('click', onZoomOut);

        /**
         * Zoom fit page.
         */
         function onZoomFit() {
            if (scale >= pdfDoc.scale) {
                return;
            }
            scale = 1;
            var num = pageNum;
            queueRenderPage(num, scale);
        }
        document.getElementById('zoomfit').addEventListener('click', onZoomFit);


        $("div.file").click(function(){
            var url = $(this).attr("url");
            PDFJS.getDocument(url).then(function (pdfDoc_) {
                pdfDoc = pdfDoc_;
                var documentPagesNumber = pdfDoc.numPages;
                document.getElementById('page_count').textContent = '/ ' + documentPagesNumber;

                $('#page_num').on('change', function() {
                    var pageNumber = Number($(this).val());

                    if(pageNumber > 0 && pageNumber <= documentPagesNumber) {
                        queueRenderPage(pageNumber, scale);
                    }

                });

                // Initial/first page rendering
                renderPage(pageNum, scale);
            });
            return false;
        })
    </script>


</body>

</html>
