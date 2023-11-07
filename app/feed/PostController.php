<?php
class PostController{
    public function __construct($link) {
    $this->database = $link;
    
  }
  public function showOwnPost($inicio,$final){
    $userId = intval($_SESSION["iduser"]);
    $sql = "SELECT DISTINCT posts.title, users.nickname, posts.publish,
    (SELECT contents.paragraph FROM contents WHERE contents.idpost = posts.idpost LIMIT 1) AS paragraph
    FROM posts
    INNER JOIN users ON users.iduser = posts.iduser
    WHERE users.iduser = $userId
    
    LIMIT $inicio,$final;
  
    ";
    $query = $this->database->query($sql);
    $data =array();
    if ($query->num_rows > 0) {
       
        while($row = $query->fetch_assoc()) {
            $data[] = $row;
        }
      } else {
            $data = "0 results";
      }
      $this->database->close();
      return $data;
  }

  public function showPosts($inicio,$final){
    $sql = "SELECT DISTINCT  posts.title,users.nickname,  (SELECT contents.paragraph FROM contents WHERE contents.idpost = posts.idpost LIMIT 1) AS paragraph FROM posts 
    INNER join users on users.iduser = posts.iduser
 
    WHERE posts.publish = 1
    LIMIT $inicio,$final;
    ";
    $query = $this->database->query($sql);
    $data =array();
    if ($query->num_rows > 0) {
       
        while($row = $query->fetch_assoc()) {
            $data[] = $row;
        }
      } else {
            $data = "0 results";
      }
      $this->database->close();
      return $data;
  }

  public function publishPost($idPost){
    $sql = "UPDATE posts SET publish = 1 WHERE idpost = '$idPost'";
    $query = $this->database->query($sql);
    
    $this->recordChange($idPost,"publish","post");
    
  }

  public function createParagraph($idPost,$paragraphs){
    $sql = "INSERT INTO contents(idpost, paragraph) VALUES (?,?)";
    $stmt = $this->database->prepare($sql);
    
    for($i=0;$i<count($paragraphs);$i++){

      $stmt->bind_param("is", $idPost, $paragraphs[$i]);
      $stmt->execute();
      $lastParagraphId =$this->database->insert_id;
      $this->recordChange($lastParagraphId,"new","content");
    }
    
    $stmt->close();
    
    $_SESSION["msg"] = "Operación ejecutada.";

  }

  public function createPost($title){
    $sql = "INSERT INTO posts(iduser, title, publish) VALUES (?,?,?)";
    $stmt = $this->database->prepare($sql);
    $userId = intval($_SESSION["iduser"]);
    $publicado = 0;
    $stmt->bind_param("isi", $userId, $title, $publicado);
    $stmt->execute();
    $lastPostId =$this->database->insert_id;
    $stmt->close();
    
    $_SESSION["msg"] = "Operación ejecutada.";
    $this->recordChange($lastPostId,"new","post");
    return $lastPostId;
  }

  public function recordChange($idEntity,$action,$entity){
    
    $sql = "INSERT iNTO changes(iduser,entityid,action,entity)VALUES(?,?,?,?)";
    
    $stmt = $this->database->prepare($sql);
    $userId = intval($_SESSION["iduser"]);
    $entityId=intval($idEntity);
    $stmt->bind_param("iiss", $userId, $idEntity, $action,$entity);
    $stmt->execute();
    $stmt->close();
    
  }

}
?>