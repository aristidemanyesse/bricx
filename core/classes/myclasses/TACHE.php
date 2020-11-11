<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;
use Native\FICHIER;
/**
 * 
 */
class TACHE extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $chantier_id;
	public $name;
	public $rang;
	public $tache_id_parent;
	public $duree;
	public $started;
	public $finished;
	public $etatchantier_id;
	public $comment;


	public function enregistre(){
		$data = new RESPONSE;
		if ($this->name != "") {
			if (is_null($this->chantier_id)) {
				$this->chantier_id = getSession("chantier_connecte_id");
			}
			$data = $this->save();
		}else{
			$data->status = false;
			$data->message = "Veuillez renseigner le nom du produit !";
		}
		return $data;
	}


	public function affichageTache(){
		$this->actualise();
		?>
		<li class="dd-item" data-id="<?= $this->id  ?>">
			<div class="dd-handle">
				<label class="float-right label label-<?= $this->etatchantier->class ?>"><?= $this->etatchantier->name  ?></label>
				<span class="float-right"> <?= $this->duree ?> <i class="fa fa-calendar"></i> &nbsp;&nbsp;&nbsp;</span>
				<?= $this->name() ?> 
			</div>
			<ol class="dd-list">
				<?php foreach ($this->getChildren() as $key => $tache) { 
					$tache->affichageTache(); 
				} ?>
			</ol>
		</li>
		<?php 
	}


	public function getChildren(){
		return TACHE::findBy(["tache_id_parent = "=> $this->id], [], ["rang"=>"ASC"]);
	}


	public static function getRang($id){
		return count(TACHE::findBy(["tache_id_parent = "=> $id, "rang > "=> 0])) + 1;
	}



	public function retourJson(){
		$this->actualStart = $this->started;
		$this->actualEnd = $this->finished;
		$this->children = $this->getChildren();
		foreach ($this->children as $key => $tache) { 
			$tableau = $tache->retourJson(); 
		}
		return $this;
	}


	public function sentenseCreate(){
		return $this->sentense = "Ajout d'une nouvelle ressource : $this->name dans les paramétrages";
	}
	public function sentenseUpdate(){
		return $this->sentense = "Modification des informations de la ressource $this->id : $this->name ";
	}
	public function sentenseDelete(){
		return $this->sentense = "Suppression definitive de la ressource $this->id : $this->name";
	}


}



?>