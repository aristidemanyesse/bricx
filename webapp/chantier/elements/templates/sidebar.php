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
                                <span class="text-muted text-xs block"><?= $agence->name()  ?></span>
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
            $livraisons__ = $agence->fourni("livraison", ["agence_id ="=>$agence->id, "etat_id ="=>Home\ETAT::ENCOURS]);
            $tricycles__ = $agence->fourni("tricycle", ["etat_id !="=>Home\ETAT::VALIDEE], [], ["created"=>"DESC"]);

            ?>
            <ul class="nav metismenu" id="side-menu">
                <li class="" id="dashboard">
                    <a href="<?= $this->url($this->section, "master", "dashboard") ?>"><i class="fa fa-tachometer"></i> <span class="nav-label">Tableau de bord</span></a>
                </li>
                <li class="" id="clients">
                    <a href="<?= $this->url($this->section, "master", "clients") ?>"><i class="fa fa-users"></i> <span class="nav-label">Planning construction</span></a>
                </li>
                <li style="margin: 3% auto"><hr class="mp0" style="background-color: #000; "></li>


                <?php if ($employe->isAutoriser("outils")) { ?>
                    <li class="" id="transfertstock">
                        <a href="<?= $this->url($this->section, "outils", "transfertstock") ?>"><i class="fa fa-refresh"></i> <span class="nav-label">Matériels engagés</span> </a>
                    </li>
                    <li class="" id="commandes">
                        <a href="<?= $this->url($this->section, "outils", "commandes") ?>"><i class="fa fa-handshake-o"></i> <span class="nav-label">Locations d'engins</span> <?php if (count($groupes__) > 0) { ?> <span class="label label-warning float-right"><?= count($groupes__) ?></span> <?php } ?></a>
                    </li>
                    <li style="margin: 3% auto"><hr class="mp0" style="background-color: #000; "></li>
                <?php } ?>
                

                <?php if ($employe->isAutoriser("production")) { ?>
                    <li class="groupe">
                        <a href="#"><i class="fa fa-file-text-o"></i> <span class="nav-label">Dépôts</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li id="approressource"><a href="<?= $this->url($this->section, "stock", "approressource") ?>">Dépôts de ressources</a></li>
                            <li id="approemballage"><a href="<?= $this->url($this->section, "stock", "approemballage") ?>">Dépôts de briques</a></li>
                        </ul>
                    </li>
                    <li class="groupe">
                        <a href="#"><i class="fa fa-file-text-o"></i> <span class="nav-label">Approvisionnements</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li id="approressource"><a href="<?= $this->url($this->section, "stock", "approressource") ?>">Appro de ressources</a></li>
                            <li id="approemballage"><a href="<?= $this->url($this->section, "stock", "approemballage") ?>">Appro de briques</a></li>
                        </ul>
                    </li>
                    <li class="groupe">
                        <a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Stocks actuels</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li id="ressources"><a href="<?= $this->url($this->section, "stock", "ressources") ?>">Stock de ressources</a></li>
                            <li id="emballages"><a href="<?= $this->url($this->section, "stock", "emballages") ?>">Stock d'emballages</a></li>
                        </ul>
                    </li>
                    <li class="groupe">
                        <a href="#"><i class="fa fa-file-text-o"></i> <span class="nav-label">Sorties</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li id="approressource"><a href="<?= $this->url($this->section, "stock", "approressource") ?>">Sorties de ressources</a></li>
                            <li id="approemballage"><a href="<?= $this->url($this->section, "stock", "approemballage") ?>">Sorties de briques</a></li>
                        </ul>
                    </li>
                    <li class="groupe">
                        <a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Pertes enregistrées</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li id="ressources"><a href="<?= $this->url($this->section, "stock", "ressources") ?>">perte de ressources</a></li>
                            <li id="emballages"><a href="<?= $this->url($this->section, "stock", "emballages") ?>">perte de briques</a></li>
                            <li id="emballages"><a href="<?= $this->url($this->section, "stock", "emballages") ?>">perte de materiels</a></li>
                        </ul>
                    </li>
                    <li style="margin: 3% auto"><hr class="mp0" style="background-color: #000; "></li>
                <?php } ?>


                <?php if ($employe->isAutoriser("files")) { ?>
                    <li class="" id="rapportjour">
                        <a href="<?= $this->url($this->section, "rapports", "rapportjour") ?>"><i class="fa fa-calendar"></i> <span class="nav-label">Images du chantier</span></a>
                    </li>
                    <li class="" id="rapportjour">
                        <a href="<?= $this->url($this->section, "rapports", "rapportjour") ?>"><i class="fa fa-calendar"></i> <span class="nav-label">Documents du chantier</span></a>
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
