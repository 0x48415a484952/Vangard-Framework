<?php

namespace Septillion\Classes;
use PDO;
use Septillion\Classes\View;

class Post
{
    private $conn;
    private const INSERT_POST_INTO_DATABASE = "INSERT INTO posts (title, article, uri) VALUES(:title, :article, :uri)";
    private const GET_POST_BY_ID_OR_URI = "SELECT * FROM posts WHERE id = :id OR uri = :uri";
    protected $title;
    protected $article;
    protected $uri;
    protected $id;

    // public function __construct(PDO $conn)
    // {
    //     $this->conn = $conn;
    // }

    protected function setId($id)
    {
        $this->id = $id;
    }

    protected function getid()
    {
        return $this->id;
    }

    protected function setTitle($title)
    {
        $this->title = $title;
    }

    protected function getTitle()
    {
        return $this->title;
    }

    protected function setArticle($article)
    {
        $this->article = $article;
    }

    protected function getArticle()
    {
        return $this->article;
    }
    
    protected function setUri($uri)
    {
        $this->uri = preg_replace('/\s+/', '', $uri);
    }

    protected function getUri()
    {
        return $this->uri;
    }

    public function writePost($title, $article, $uri)
    {
        $this->setTitle($title);
        $this->setArticle($article);
        $this->setUri($uri);
        $this->conn = DatabaseConnection::getInstance()->getConnection();
        $statement = $this->conn->prepare(self::INSERT_POST_INTO_DATABASE);
        $statement->execute([$this->title, $this->article, $this->uri]);

    }

    public function renderPostByIdOrUri($id = null, $uri = null)
    {
        $this->conn = DatabaseConnection::getInstance()->getConnection();
        $statement = $this->conn->prepare(self::GET_POST_BY_ID_OR_URI);
        $statement->bindParam(':id', $this->id);
        $statement->bindParam(':uri', $this->uri);
        $statement->execute();
    }
}