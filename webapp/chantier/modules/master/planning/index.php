<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/chantier/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/chantier/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

            <?php include($this->rootPath("webapp/chantier/elements/templates/header.php")); ?>  

            <br>
            <div class="row m-b-lg">
                <div class="col-md-6">

                    <div class="profile-image">
                        <img src="img/a4.jpg" class="rounded-circle circle-border m-b-md" alt="profile">
                    </div>
                    <div class="profile-info">
                        <div class="">
                            <div>
                                <h2 class="no-margins"><?= $chantier->name() ?></h2>
                                <h4><?= $chantier->lieu ?></h4>
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="col-md-3">
                    <span><?= $chantier->comment ?></span>
                </div>
                <div class="col-md-3">
                    <table class="table small m-b-xs">
                        <tbody>
                            <tr>
                                <td>
                                    <strong>142</strong> Projects
                                </td>
                                <td>
                                    <strong>22</strong> Followers
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <strong>61</strong> Comments
                                </td>
                                <td>
                                    <strong>54</strong> Articles
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="ibox">
                <div class="ibox-title">
                    <h5>Diagramme d'etat d'avancement </h5>
                </div>
                <div class="">
                    <div class="scroll" id="container" style="height: 400px; width: 100%; overflow: scroll;"></div>
                </div>
            </div><br>

            <div class="row">
                <div class="col-lg-8">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Liste des travaux et plan de construction</h5>
                            <div class="ibox-tools">
                                <button data-toggle="modal" data-target="#modal-tache" class=" btn btn-sm btn-white" style="font-size: 12px;"><i class="fa fa-plus"></i> Ajouter Nouvelle tâche</button>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <p class="m-b-lg">
                                Each list you can customize by standard css styles. Each element is responsive so you can add to it any other element to improve functionality of list.
                            </p>

                            <div class="dd" id="nestable2">

                                <?php $chantier->affichageTaches() ?>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Historiques des taches</h5>
                            <div class="ibox-tools">
                                <span class="label label-warning-light float-right">10 Messages</span>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div>
                                <div class="feed-activity-list">
                                    <div>
                                        <h2 class="no-margins"><?= $chantier->name() ?> <i class="pull-right fa fa-pencil"></i></h2>
                                        <h4><?= $chantier->started ?> jours</h4>
                                        <h5><?= datecourt($chantier->started) ?> - <?= datecourt($chantier->started) ?></h5><br>
                                        <span><?= ($chantier->comment) ?></span>
                                    </div>

                                    <div class="feed-element">
                                        <a class="float-left" href="profile.html">
                                            <img alt="image" class="rounded-circle" src="img/profile.jpg">
                                        </a>
                                        <div class="media-body ">
                                            <small class="float-right">5m ago</small>
                                            <strong>Monica Smith</strong> posted a new blog. <br>
                                            <small class="text-muted">Today 5:60 pm - 12.06.2014</small>

                                        </div>
                                    </div>

                                </div><br>

                                <div class="row text-center">
                                    <div class="col-sm-6">
                                        <button class="btn btn-primary"><i class="fa fa-ban"></i> Interompre la tâche</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <button class="btn btn-primary"><i class="fa fa-check"></i> Terminer la tâche</button>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-block m-t"><i class="fa fa-flag"></i> Entamer cette tâche </button>
                                <button class="btn btn-primary btn-block m-t"><i class="fa fa-flag"></i> Annuler cette tâche </button>

                            </div>

                        </div>
                    </div>

                </div>

            </div>



            <?php include($this->rootPath("webapp/chantier/elements/templates/footer.php")); ?>


        </div>
    </div>


    <?php include($this->rootPath("webapp/chantier/elements/templates/script.php")); ?>

    <?php include($this->rootPath("composants/assets/modals/modal-tache.php")); ?>  



</body>

</html>
