<?php
class PostController{
    public function __construct($link) {
    $this->database = $link;
    
  }
  public function showPosts($inicio,$final){
    $sql = "SELECT users.nickname, posts.title, contents.paragraph, changes.date  FROM posts 
    INNER join users on users.iduser = posts.iduser
    LEFT join contents on contents.idpost = posts.idpost
    LEFT join changes on changes.entityid = posts.idpost
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
}
?>