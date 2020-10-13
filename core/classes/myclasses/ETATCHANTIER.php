<?php
namespace Home;
use Native\RESPONSE;/**
 * 
 */
class ETATCHANTIER extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	const ANNULEE  = 1;
	const START    = 2;
	const ENCOURS  = 3;
	const STOPPEE  = 4;
	const TERMINEE = 5;

	public $name;
	public $class;

	public function enregistre(){}


	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}

}
?>