<?php
class UserController{
    public function __construct($link) {
    $this->database = $link;
  }

  private function setChange(){

  }

  public function login($mail, $password){
    $sql = "SELECT * FROM users WHERE email='$mail' AND password = '$password' ";
    $query = $this->database->query($sql);
    $ok = false;
    if ($query->num_rows > 0){
      $iduser = $query->fetch_assoc()['iduser'];
      $_SESSION["email"] = $mail;
      $_SESSION["online"] = true;
      $_SESSION["msg"] = "Bienvenido";
      $_SESSION["id"] = session_id();
      $_SESSION["iduser"] = $iduser;
      $ok=true;
    }else{
      $_SESSION["online"] = false;
      $_SESSION["msg"] = "Se ha producido un error";
    }    
    $this->database->close();
    return $ok;
  }
  
  public function logout(){

    session_unset();
    $_SESSION["online"] = false;
    $_SESSION["msg"] = "Sesión cerrada correctamente";
  }

  private function alreadyExist($param){
    $ok=false;
    
    return $ok;
  }

  public function signin($nickname, $mail, $password){
    $sql = "INSERT INTO users(nickname,email,password) VALUES (?,?,?);";
    $stmt = $this->database->prepare($sql);
    $stmt->bind_param("sss", $nickname, $mail, $password);
    $stmt->execute();
    $stmt->close();
    $this->database->close();
    $_SESSION["msg"] = "Usuario correctamente registrado.";
    $this->login($mail,$password);
  }

  public function searchUserId($mail){

    $sql = "SELECT iduser FROM users WHERE email='$mail'";
    $query = $this->database->query($sql);
    $iduser = $query->fetchColumn();
    return $iduser;
  }

  public function showUser($mail){
    $sql = "SELECT changes.date, nickname FROM users 
    INNER JOIN changes on changes.entityid = users.iduser
    WHERE email='$mail'";
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
    
    $this->database->close();
  }

  public function changePassword(){
    return 0;
  }

}
?>