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
class ArticleRepository extends Repository {

	/**
	 * Constructeur de la class ArticleRepository
	 * 
	 * @param PDO $pdo
	 */
	public function __construct(PDO &$pdo) {
		parent::__construct($pdo, "article", "Article");
	}
}