<?php
class modeleRSA extends modele{
	/**
	 * Récupère la clé publique RSA
	 * @param integer $num : le numéro du couple de clé RSA
	 * @return string : la clé publique du couple de clés RSA dont le numéro est passé en paramètre 
	 */
	public function getPublicKeyRsa($num){
		$sql = "SELECT publicKeyRsa FROM rsa WHERE numKeyRsa = " . $num;
		$pdoStat = $this->executerRequete($sql);
		$publicRSA = $pdoStat->fetchObject();
		return $publicRSA->publicKeyRsa;
	}
	public function getPrivateKeyRsa($num){
		$sql = "SELECT privateKeyRsa FROM rsa WHERE numKeyRsa=" . $num;
		$pdoStat = $this->executerRequete($sql);
		$privateRSA = $pdoStat->fetchObject();
		return $privateRSA->privateKeyRsa;
	}
}

?>