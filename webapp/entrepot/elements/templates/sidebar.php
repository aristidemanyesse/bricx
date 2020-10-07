<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <h1 class="logo-name text-center" style="font-size: 50px; letter-spacing: 5px; margin: 0% auto !important; padding: 0% !important;">BRICX</h1>
            <li class="nav-header" style="padding: 15px 10px !important; background-color: orange">
                <div class="dropdown profile-element">                        
                    <div class="row">
                        <div class="col-3">
                            <img alt="image" class="rounded-circle" style="width: 35px" src="<?= $this->stockage("images", "employes", $employe->image) ?>"/>
                        </div>
                        <div class="col-9">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold"><?= $employe->name(); ?></span>
                                <span class="text-muted text-xs block"><?= $agence->name(); ?></span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="dropdown-item" href="<?= $this->url("main", "access", "locked") ?>">Vérouiller la session</a></li>
                                <li><a class="dropdown-item" href="#" id="btn-deconnexion" >Déconnexion</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="logo-element">
                    BRICX
                </div>
            </li>

            <?php 
            $groupes__ = Home\GROUPECOMMANDE::encours();
            $livraisons__ = Home\LIVRAISON::encours();
            $approvisionnements__ = Home\APPROVISIONNEMENT::encours();
            $achatstock__ = Home\ACHATSTOCK::encours();
            ?>
            <ul class="nav metismenu" id="side-menu">
                <li class="" id="dashboard">
                    <a href="<?= $this->url($this->section, "master", "dashboard") ?>"><i class="fa fa-tachometer"></i> <span class="nav-label">Tableau de bord</span></a>
                </li>

                <?php if ($employe->isAutoriser("stock")) { ?>
                    <li class="" id="stock">
                        <a href="<?= $this->url($this->section, "stock", "stock") ?>"><i class="fa fa-cube"></i> <span class="nav-label">Stock de briques</span></a>
                    </li>
                    <li class="" id="ressources">
                        <a href="<?= $this->url($this->section, "stock", "ressources") ?>"><i class="fa fa-cubes"></i> <span class="nav-label">Stock de ressources </span></a>
                    </li>
                    <li style="margin: 3% auto"><hr class="mp0" style="background-color: #aaa; "></li>
                <?php } ?>


                <?php if ($employe->isAutoriser("production")) { ?>
                    <li class="" id="productions">
                        <a href="<?= $this->url($this->section, "production", "productions") ?>"><i class="fa fa-building-o"></i> <span class="nav-label">Les productions </span></a>
                    </li>
                    <li class="" id="achatstock">
                        <a href="<?= $this->url($this->section, "production", "achatstock") ?>"><i class="fa fa-handshake-o"></i> <span class="nav-label">Achat de stocks </span> <?php if (count($achatstock__) > 0) { ?> <span class="label label-warning float-right"><?= count($achatstock__) ?></span> <?php } ?></a>
                    </li>
                    <li >
                        <a href="#"><i class="fa fa-share"></i> <span class="nav-label">Envois sur chantier</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li id="envoiproduits"><a href="<?= $this->url($this->section, "production", "envoiproduits") ?>">Envoi de briques</a></li>
                            <li id="envoiressources"><a href="<?= $this->url($this->section, "production", "envoiressources") ?>">Envoi de ressources</a></li>
                        </ul>
                    </li>
                    <li >
                        <a href="#"><i class="fa fa-trash"></i> <span class="nav-label">Les pertes</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li id="perteproduits"><a href="<?= $this->url($this->section, "production", "perteproduits") ?>">Perte de briques</a></li>
                            <li id="perteressources"><a href="<?= $this->url($this->section, "production", "perteressources") ?>">Perte de ressources</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-divider"></li>

                    <li class="" id="fournisseurs">
                        <a href="<?= $this->url($this->section, "production", "fournisseurs") ?>"><i class="fa fa-address-book-o"></i> <span class="nav-label">Liste des Fournisseurs</span></a>
                    </li>
                    <li class="" id="approvisionnements">
                        <a href="<?= $this->url($this->section, "production", "approvisionnements") ?>"><i class="fa fa-bus"></i> <span class="nav-label">Approvisionnements </span> <?php if (count($approvisionnements__) > 0) { ?> <span class="label label-warning float-right"><?= count($approvisionnements__) ?></span> <?php } ?></a>
                    </li>
                    <li class="dropdown-divider"></li>
                <?php } ?>


                <?php if ($employe->isAutoriser("rapports")) { ?>
                    <li class="" id="rapportjour">
                        <a href="<?= $this->url($this->section, "rapports", "rapportjour") ?>"><i class="fa fa-calendar"></i> <span class="nav-label">Rapport du Jour</span></a>
                    </li>
                    <li class="" id="rapportproduction">
                        <a href="<?= $this->url($this->section, "rapports", "rapportproduction") ?>"><i class="fa fa-file-text-o"></i> <span class="nav-label">Rapport de production</span></a>
                    </li>
                    <li style="margin: 3% auto"><hr class="mp0" style="background-color: #aaa; "></li>
                <?php } ?>


            </ul>

        </ul>

    </div>
</nav>

<style type="text/css">
    li.dropdown-divider{
       !important;
   }
</style>