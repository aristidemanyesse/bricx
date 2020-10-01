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
                                <span class="text-muted text-xs block"><b class="caret"></b></span>
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
            $livraisons__ = Home\LIVRAISON::findBy(["etat_id ="=>Home\ETAT::ENCOURS]);
            $tricycles__ = Home\TRICYCLE::findBy(["etat_id !="=>Home\ETAT::VALIDEE], [], ["created"=>"DESC"]);

            $groupes__ = Home\GROUPECOMMANDE::encours();
            $livraisons__ = Home\LIVRAISON::encours();
            $approvisionnements__ = Home\APPROVISIONNEMENT::encours();
            $achatstock__ = Home\ACHATSTOCK::encours();

            ?>
            <ul class="nav metismenu" id="side-menu">
                <li class="" id="dashboard">
                    <a href="<?= $this->url($this->section, "master", "dashboard") ?>"><i class="fa fa-tachometer"></i> <span class="nav-label">Tableau de bord</span></a>
                </li>
                <li class="" id="clients">
                    <a href="<?= $this->url($this->section, "master", "clients") ?>"><i class="fa fa-users"></i> <span class="nav-label">Liste des clients</span></a>
                </li>
                <li class="" onclick="voirPrixParZone()">
                    <a href="#"><i class="fa fa-list"></i> <span class="nav-label">Voir Les prix par zone</span></a>
                </li>
                <li style="margin: 3% auto"><hr class="mp0" style="background-color: #000; "></li>


                <?php if ($employe->isAutoriser("ventes")) { ?>
                    <li class="" id="commandes">
                        <a href="<?= $this->url($this->section, "ventes", "commandes") ?>"><i class="fa fa-handshake-o"></i> <span class="nav-label">Commandes de clients</span> <?php if (count($groupes__) > 0) { ?> <span class="label label-warning float-right"><?= count($groupes__) ?></span> <?php } ?></a>
                    </li>
                    <li class="" id="livraisons">
                        <a href="<?= $this->url($this->section, "ventes", "livraisons") ?>"><i class="fa fa-truck"></i> <span class="nav-label">Livraisons en cours</span> <?php if (count($livraisons__) > 0) { ?> <span class="label label-warning float-right"><?= count($livraisons__) ?></span> <?php } ?></a>
                    </li>
                    <li style="margin: 3% auto"><hr class="mp0" style="background-color: #000; "></li>
                <?php } ?>

                <?php if ($employe->isAutoriser("production")) { ?>
                    <li class="" id="productions">
                        <a href="<?= $this->url($this->section, "production", "productions") ?>"><i class="fa fa-building-o"></i> <span class="nav-label">Les productions </span></a>
                    </li>
                <?php } ?>


                <?php if ($employe->isAutoriser("boutique") && $employe->isAutoriser("production")) { ?>
                    <li id="agences">
                        <a href="#"><i class="fa fa-home"></i> <span class="nav-label">Les Agences</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <?php foreach ($employe->fourni("acces_agence") as $key => $item) {
                                $item->actualise(); ?>
                                <li><a href="<?= $this->url($this->section, "production", "agences", $item->agence->id) ?>"><?= $item->agence->name() ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>

                <?php if ($employe->isAutoriser("rapports")) { ?>
                    <li style="margin: 3% auto"><hr class="mp0" style="background-color: #000; "></li>
                    <li class="" id="rapportproduction">
                        <a href="<?= $this->url($this->section, "rapports", "rapportproduction") ?>"><i class="fa fa-file-text-o"></i> <span class="nav-label">Rapport de production</span></a>
                    </li>
                    <li class="" id="coutproduction">
                        <a href="<?= $this->url($this->section, "rapports", "coutproduction") ?>"><i class="fa fa-file-text-o"></i> <span class="nav-label">Coût de production</span></a>
                    </li>
                    <li style="margin: 3% auto"><hr class="mp0" style="background-color: #000; "></li>
                <?php } ?>


                <?php if ($employe->isAutoriser("caisse")) { ?>
                   <!--  <li class="" id="caisse">
                        <a href="<?= $this->url($this->section, "caisse", "caisse") ?>"><i class="fa fa-money"></i> <span class="nav-label">La caisse</span></a>
                    </li> -->
                    <li class="" id="tresorerie">
                        <a href="<?= $this->url($this->section, "caisse", "tresorerie", $exercicecomptable->id) ?>"><i class="fa fa-money"></i> <span class="nav-label">Trésorerie générale</span></a>
                    </li>
                    <li style="margin: 3% auto"><hr class="mp0" style="background-color: #000; "></li>
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
