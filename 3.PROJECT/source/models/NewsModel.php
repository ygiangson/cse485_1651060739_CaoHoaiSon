<?php
require_once 'Model.php';
require_once 'configs/config.php';
class NewsModel extends Model
{
    public $connection;


    public function __construct()
    {
        $this->connection = $this->openConnect();
    }

    public function addNews($title, $content, $img, $category, $hot, $public, $userID)
    {
        $sql = "INSERT INTO `news` (`id`, `title`, `content`, `view`, `hot`, `image`, `published`, `create_at`, `update_at`, `idCategory`, `idUser`) 
            VALUES (NULL, '$title', '$content', '0', '$hot', '$img', '$public', NOW(), NOW(), '$category', '$userID')";
        $result = mysqli_query($this->connection, $sql);
        return $result;
    }
    public function getAllNews($userID)
    {
        $sql = "SELECT news.id, news.title,news.published, news.create_at, category.name, users.username FROM news INNER JOIN category ON news.idCategory = category.id 
                INNER JOIN users ON news.idUser =users.id 
                WHERE users.id = $userID";
        $result = mysqli_query($this->connection, $sql);
        return $result;
    }

    public function deleteNews($idNews)
    {
        $sql = "DELETE FROM `news` WHERE `news`.`id` = $idNews";
        $result = mysqli_query($this->connection, $sql);
        // echo $sql;
        return $result;
    }

    public function selectOneNews($idNews)
    {
        $sql = "SELECT * FROM news WHERE id = $idNews";
        $result = mysqli_query($this->connection, $sql);
        return $result;
    }

    public function editNews($idNews, $title, $content, $hot, $img, $public, $userID, $category)
    {
        $sql = "UPDATE `news` 
                SET `title` = '$title', `content` = '$content',  `hot` = '$hot', `image` = '$img', `published` = '$public',  `update_at` = NOW(), `idCategory` = '$category', `idUser` = '$userID' 
                WHERE `news`.`id` = $idNews";
        $result = mysqli_query($this -> connection, $sql);
        return $result;
    }
    // lay ngau nhien 5 thong bao chung
    public function getNewsRand()
    {
        $sql = "SELECT * FROM news WHERE published = 1 AND hot = 0 ORDER BY RAND() LIMIT 12";
        $result = mysqli_query($this -> connection, $sql);
        return $result;
    }

    //lay danh sách thông tin mới nhất
    public function getLatestNews()
    {
        $sql = "SELECT * FROM news WHERE published = 1 AND hot = 0 ORDER BY id DESC LIMIT 5";
        $result = mysqli_query($this -> connection, $sql);
        return $result;
    }
    public function getHotNews()
    {
        $sql = "SELECT * FROM news WHERE hot = 1 ORDER BY RAND() LIMIT 7";
        $result = mysqli_query($this -> connection, $sql);
        return $result;
    }
}
