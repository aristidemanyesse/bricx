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
                                <span class="text-muted text-xs block"><?= $chantier->name()  ?></span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="dropdown-item" href="<?= $this->url("main", "access", "locked") ?>">Vérouiller la session</a></li>
                                <li><a class="dropdown-item" href="#" id="btn-deconnexion">Déconnexion</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="logo-element">
                    BRICX
                </div>
            </li>

            <?php 

            $locations__ = $chantier->fourni("location", ["etat_id ="=>Home\ETAT::ENCOURS]);

            ?>
            <ul class="nav metismenu" id="side-menu">
                <li class="" id="dashboard">
                    <a href="<?= $this->url($this->section, "master", "dashboard", $chantier->id) ?>"><i class="fa fa-tachometer"></i> <span class="nav-label">Tableau de bord</span></a>
                </li>
                <li class="" id="planning">
                    <a href="<?= $this->url($this->section, "master", "planning") ?>"><i class="fa fa-sitemap"></i> <span class="nav-label">Planning construction</span></a>
                </li>
                <li style="margin: 3% auto"><hr class="mp0" style="background-color: #000; "></li>


                <?php if ($employe->isAutoriser("outils")) { ?>
                    <li class="" id="transfertstock">
                        <a href="<?= $this->url($this->section, "outils", "transfertstock") ?>"><i class="fa fa-refresh"></i> <span class="nav-label">Matériels engagés</span> </a>
                    </li>
                    <li class="" id="commandes">
                        <a href="<?= $this->url($this->section, "outils", "commandes") ?>"><i class="fa fa-handshake-o"></i> <span class="nav-label">Locations d'engins</span> <?php if (count($locations__) > 0) { ?> <span class="label label-warning float-right"><?= count($locations__) ?></span> <?php } ?></a>
                    </li>
                    <li style="margin: 3% auto"><hr class="mp0" style="background-color: #000; "></li>
                <?php } ?>
                

                <?php if ($employe->isAutoriser("production")) { ?>
                    <li class="groupe">
                        <a href="#"><i class="fa fa-cube"></i> <span class="nav-label">Suivi de briques</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li id="stockproduit"><a href="<?= $this->url($this->section, "stock", "stockproduit") ?>">Stock actuel</a></li>
                            <li id="productions"><a href="<?= $this->url($this->section, "production", "productions") ?>">Production de briques</a></li>
                            <li id="depotproduit"><a href="<?= $this->url($this->section, "production", "depotproduit") ?>">Dépôts de briques</a></li>
                            <li id="approproduit"><a href="<?= $this->url($this->section, "production", "approproduit") ?>">Achat de briques</a></li>
                            <li id="useproduit"><a href="<?= $this->url($this->section, "production", "useproduit") ?>">Utilisation de briques</a></li>
                            <li id="perteproduit"><a href="<?= $this->url($this->section, "stock", "perteproduit") ?>">les pertes</a></li>
                        </ul>
                    </li>


                    <li class="groupe">
                        <a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Suivi de ressources</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li id="stockressource"><a href="<?= $this->url($this->section, "stock", "stockressource") ?>">Stock actuel</a></li>
                            <li id="depotressource"><a href="<?= $this->url($this->section, "production", "depotressource") ?>">Dépôts de ressources</a></li>
                            <li id="approressource"><a href="<?= $this->url($this->section, "production", "approressource") ?>">Achat de ressources</a></li>
                            <li id="useressource"><a href="<?= $this->url($this->section, "production", "useressource") ?>">Utilis. de ressources</a></li>
                            <li id="perteressource"><a href="<?= $this->url($this->section, "stock", "perteressource") ?>">les pertes</a></li>
                        </ul>
                    </li>


                    <li class="groupe">
                        <a href="#"><i class="fa fa-stack-overflow"></i> <span class="nav-label">Suivi de Materiels</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li id="stockmateriel"><a href="<?= $this->url($this->section, "stock", "stockmateriel") ?>">Materiels engagés</a></li>
                            <li id="depotmateriel"><a href="<?= $this->url($this->section, "production", "depotmateriel") ?>">Dépôts de materiels</a></li>
                            <li id="appromateriel"><a href="<?= $this->url($this->section, "production", "appromateriel") ?>">Achat de materiels</a></li>
                            <li id="pertemateriel"><a href="<?= $this->url($this->section, "stock", "pertemateriel") ?>">les pertes</a></li>
                        </ul>
                    </li>
                     <li class="" id="fournisseurs">
                        <a href="<?= $this->url($this->section, "production", "fournisseurs") ?>"><i class="fa fa-user"></i> <span class="nav-label">Les fournisseurs</span> </a>
                    </li>
                    <li style="margin: 3% auto"><hr class="mp0" style="background-color: #000; "></li>

                    <li class="" id="location">
                        <a href="<?= $this->url($this->section, "location", "location") ?>"><i class="fa fa-truck"></i> <span class="nav-label">Locations d'engins</span> </a>
                    </li>
                    <li style="margin: 3% auto"><hr class="mp0" style="background-color: #000;* "></li>
                <?php } ?>


                <?php if ($employe->isAutoriser("files")) { ?>
                    <li class="" id="images">
                        <a href="<?= $this->url($this->section, "files", "images") ?>"><i class="fa fa-image"></i> <span class="nav-label">Images du chantier</span></a>
                    </li>
                    <li class="" id="documents">
                        <a href="<?= $this->url($this->section, "files", "documents") ?>"><i class="fa fa-file-pdf-o"></i> <span class="nav-label">Documents du chantier</span></a>
                    </li>
                    <li style="margin: 3% auto"><hr class="mp0" style="background-color: #000; "></li>
                <?php } ?>


                <?php if ($employe->isAutoriser("caisse")) { ?>
                    <li class="" id="caisse">
                        <a href="<?= $this->url($this->section, "caisse", "caisse") ?>"><i class="fa fa-money"></i> <span class="nav-label">Gestion du budget</span></a>
                    </li>
                    <li style="margin: 3% auto"><hr class="mp0" style="background-color: #000; "></li>
                <?php } ?>
            </ul>

        </ul>

    </div>
</nav>
