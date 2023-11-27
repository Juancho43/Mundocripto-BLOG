<?php
class CommentController{
    public function __construct($link) {
        $this->database = $link;
    }
    
    public function CommentPagination($pagina,$idUser){
        $sql = "SELECT COUNT(*) as cantidad FROM comments WHERE iduser = $idUser;";
        $query = $this->database->query($sql);
        $data = array();
        if ($query->num_rows > 0) {
           
            while($row = $query->fetch_assoc()) {
                $data[]= $row;
            }
          }
        $inicio = ($pagina-1)  * constant("CANT_POSTS");
        $final = $pagina  * constant("CANT_POSTS");
        $totalPages = ceil($data[0]["cantidad"]/ constant("CANT_POSTS"));
        $data["inicio"] = $inicio;
        $data["final"] = $final;
        $data["totalPages"] = $totalPages;
        return $data;
      }
  

    public function publishComment($idPost, $comment) 
    {
        $sql = "INSERT INTO comments(iduser,idpost,comment) VALUES (?,?,?)";
        if($stmt = $this->database->prepare($sql)){
            $userId = intval($_SESSION["iduser"]);
            $idPost = intval($idPost);
            $stmt->bind_Param("iis", $userId,$idPost,$comment);
            $stmt->execute();
            $stmt->close();
            return $this->database->insert_id;
        }
      }

      public function showComments($idPost){
        $data = array();
        $sql = "SELECT comments.comment, users.nickname, users.iduser AS author ,changes.date, comments.idcomment FROM `comments` 
                INNER JOIN users on users.iduser = comments.iduser
                INNER join changes on changes.entityid = comments.idcomment and changes.entity = 'comment'
                WHERE comments.idpost = $idPost
                ORDER BY changes.date DESC
                ";
        $query = $this->database->query($sql);
        if ($query->num_rows > 0) 
        {       
            while($row = $query->fetch_assoc()) 
            {
                $data[] = $row;
            }
        }
        
        return $data;
      }

      public function deleteComment($idComment){
        $ok = false;
        $sql = "DELETE FROM comments WHERE idcomment = ?";
        if($stmt = $this->database->prepare($sql)){
            $stmt->bind_Param("i", $idComment);
            $stmt->execute();
            $stmt->close();
            $ok = true;
        }
        return $ok;
      }

      public function getComments($inicio,$final){
        $idUser = intval($_SESSION["iduser"]);
        $data = array();
        $sql = "SELECT comments.idcomment, comments.comment, changes.date, posts.title, posts.idpost
                FROM comments
                INNER JOIN changes on changes.entityid = comments.idcomment and changes.entity = 'comment'
                INNER join posts on posts.idpost = comments.idpost
                WHERE comments.iduser = $idUser
                ORDER BY changes.date DESC
                LIMIT $inicio,$final
                ";
        $query = $this->database->query($sql);
        if ($query->num_rows > 0) 
        {       
            while($row = $query->fetch_assoc()) 
            {
                $data[] = $row;
            }
        }
        
        return $data;
      }


}
?>