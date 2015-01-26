<?php

abstract class Repository {

	protected $_pdo;
	protected $_table;
	protected $_entity;

	/**
	 * Constructeur de la classe Repository
	 *
	 * @param PDO $pdo
	 */
	public function __construct(PDO &$pdo, $table, $entity) {
		$this->_pdo = $pdo;
		$this->_table = $table;
		$this->_entity = $entity;
	}

	/**
	 * Renvoie l'entité correspondante à l'id
	 * ou null si aucun article à cet id
	 *
	 * @param int $id
	 * @return Entity or null
	 */
	public function get($id) {

		$sql = "SELECT * FROM ".$this->_table." WHERE id=".$id;
		// on passe la requete à PDO
		$query = $this->_pdo->query($sql);

		// on demande à PDO de nous retourner les résultats dans une classe Article
		$query->setFetchMode(PDO::FETCH_CLASS, $this->_entity);
		// on lui demande un resultat
		$result = $query->fetch();

		if ($result->id)
			return $result;

		return null;
	}

	/**
	 * Renvoie tous les articles
	 *
	 * Note: on pourra ajouter des critères de recherche ou de pagination
	 * @return array
	 */
	public function getAll() {

		$sql = "SELECT * FROM ".$this->_table;
		// on passe la requete à PDO
		$query = $this->_pdo->query($sql);

		// on demande à PDO de nous retourner les résultats dans une classe Article
		$query->setFetchMode(PDO::FETCH_CLASS, $this->_entity);
		// on lui demande un resultat
		$results = $query->fetchAll();

		return $results;
	}

	/**
	 * Insère ou met à jour un objet 
	 *
	 * TODO ajouter généricité pour gérer tous les champs
	 * @param stdObject $entity
	 * @return bool
	 * 
	 * @todo la requête préparée n'a plus aucun sens, il faudrait mieux forger le SQL complet
	 */
	public function persist($entity)
	{
		$fields = get_object_vars($entity); // on récupère l'objet dans un tableau associatif
		
		if ( isset($fields['id']) && $fields['id']>0 ) { // s'il existe en base un article avec cet id
			
			// alors on forge une requete UPDATE
			$sql = "UPDATE ".$this->_table." SET ";
			
			// on parcourt les champs de l'objet pour forger la requête
			$first = true;
			foreach ($fields as $key => $value) {
				if ($key!="id") {
					if (!$first)
						$sql .= ", "; // ajoute une virgule si ce n'est pas le premier champ
					
					$sql .= $key."=:".$key; // ajoute la clé (ex: titre=:titre)
					$first = false;
				}
			}

			$sql .= " WHERE id=".$fields['id'];
			
		} else { // sinon on en insert un
			$sql = "INSERT INTO ".$this->_table." (";
			
			// on parcourt les champs pour mentionner le libellé de la colonne
			$first = true;
			foreach ($fields as $key => $value) {
				if ($key!="id") {
					if (!$first)
						$sql .= ", "; // ajoute une virgule si ce n'est pas le premier champ

					$sql .= $key; // ajoute la clé (ex: titre)
					$first = false;	
				}
			}
			
			$sql .= ") VALUES(";
					
			// on parcourt les champs pour mentionner le libellé de la variable
			$first = true;
			foreach ($fields as $key => $value) {
				if ($key!="id") {
					if (!$first)
						$sql .= ", "; // ajoute une virgule si ce n'est pas le premier champ

					$sql .= ":".$key; // ajoute la clé (ex: :titre)
					$first = false;	
				}
			}
			
			$sql .= ")";
		}

		$query = $this->_pdo->prepare($sql);
		
		// supprime l'id du tableau - pour éviter que pdo bug en trouvant un param de trop
		unset($fields['id']);
		
		return $query->execute($fields);
	}

	/**
	 * Supprime un article de la base de données
	 *
	 * @param int $id
	 * @return bool
	 */
	public function remove($id) {

		if (!$id)
			return false; // renvoie faux si aucun article à cet id

		if ($entity = $this->get($id)) {

			$sql = "DELETE FROM ".$this->_table ." WHERE id=".$entity->id;

			// on l'execute
			$query = $this->_pdo->query($sql);

			return $query->execute();
				
		} else
			return false;
	}

}