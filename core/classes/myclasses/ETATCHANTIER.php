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
		const ENCOURS  = 2;
		const STOPPEE  = 3;
		const TERMINEE = 4;

		public $name;
		public $class;

		public function enregistre(){}


		public function sentenseCreate(){}
		public function sentenseUpdate(){}
		public function sentenseDelete(){}

	}
	?>