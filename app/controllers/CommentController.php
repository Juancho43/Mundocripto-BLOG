<?php
class CommentController{
    public function __construct($link) {
        $this->database = $link;
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
        $sql = "SELECT comments.comment, users.nickname, changes.date FROM `comments` 
                INNER JOIN users on users.iduser = comments.iduser
                INNER join changes on changes.entityid = comments.idcomment
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


}
?>