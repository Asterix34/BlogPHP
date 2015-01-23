<?php

/**
 * Entité Article
 * 
 * @author humanbooster
 */
class Article {

	/**
	 * Id de l'article
	 * 
	 * @var int
	 */
	public $id;
	
	/**
	 * Titre de l'article
	 * 
	 * @var string
	 */
	public $titre;
	
	/**
	 * Contenu de l'article
	 * 
	 * @var string
	 */
	public $contenu;

}

/**
 * Permet de gérer les articles en BDD
 * 
 * @author humanbooster
 */
class ArticleRepository {
	
	private $_pdo;

	/**
	 * Constructeur de la class ArticleRepository
	 * 
	 * @param PDO $pdo
	 */
	public function __construct(PDO &$pdo) {
		$this->_pdo = $pdo;
	}
	
	/**
	 * Renvoie l'article correspondant à l'id
	 * ou null si aucun article à cet id
	 * 
	 * @param int $id
	 * @return Article or null
	 */
	public function get($id) {

		$sql = "SELECT * FROM article WHERE id=".$id;
		// on passe la requete à PDO
		$query = $this->_pdo->query($sql);

		// on demande à PDO de nous retourner les résultats dans une classe Article
		$query->setFetchMode(PDO::FETCH_CLASS, "Article");
		// on lui demande un resultat
		$article = $query->fetch();

		if ($article->id)
			return $article;

		return null;
	}

	/**
	 * Renvoie tous les articles
	 *
	 * Note: on pourra ajouter des critères de recherche ou de pagination
	 * @return array
	 */
	public function getAll() {

		$sql = "SELECT * FROM article";
		// on passe la requete à PDO
		$query = $this->_pdo->query($sql);

		// on demande à PDO de nous retourner les résultats dans une classe Article
		$query->setFetchMode(PDO::FETCH_CLASS, "Article");
		// on lui demande un resultat
		$articles = $query->fetchAll();

		return $articles;
	}

	/**
	 * Insère ou met à jour un objet Article
	 *
	 * TODO ajouter généricité pour gérer tous les champs
	 * @param Article $article
	 * @return bool
	 */
	public function persist(Article $article) {

		if ($this->get($article->id)) { // s'il existe en base un article avec cet id
			$sql = "UPDATE article SET titre=:titre, contenu=:contenu WHERE id=".$article->id;
		} else { // sinon on en insert un
			$sql = "INSERT INTO article (titre, contenu) VALUES(:titre, :contenu)";
		}

		$query = $this->_pdo->prepare($sql);

		$params = array( "titre" => $article->titre,
						 "contenu" => $article->contenu );

		return $query->execute($params);
	}

	/**
	 * Supprime un article de la base de données
	 *
	 * @param Article $article
	 * @return bool
	 */
	public function remove($id) {

		if (!$id)
			return false; // renvoie faux si aucun article à cet id
		
		if ($article = $this->get($id)) {
	
			$sql = "DELETE FROM article WHERE id=".$article->id;
	
			// on l'execute
			$query = $this->_pdo->query($sql);
	
			return $query->execute();
			
		} else 
			return false;
	}

}