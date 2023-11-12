<?php
class UserController{
    public function __construct($link) {
      $this->database = $link;
    }

  public function recordChange($userId,$idEntity,$action,$entity){
    
    $sql = "INSERT iNTO changes(iduser,entityid,action,entity)VALUES(?,?,?,?)";
    
    $stmt = $this->database->prepare($sql);
    
    $entityId=intval($idEntity);
    $stmt->bind_param("iiss", $userId, $idEntity, $action,$entity);
    $stmt->execute();
    $stmt->close();
    
  }

  public function login($mail, $password){
    $ok = false;
    $sql = "SELECT password,iduser FROM users WHERE email='$mail'";
    $query = $this->database->query($sql);
    if ($query->num_rows > 0)
    {
      $data = $query->fetch_assoc();
      
      $hashedPassword = $data['password'];
      if(password_verify($password,$hashedPassword))
      {
        $iduser = $data['iduser'];
        $_SESSION["email"] = $mail;
        $_SESSION["online"] = true;
        $_SESSION["msg"] = "Bienvenido";
        $_SESSION["id"] = session_id();
        $_SESSION["iduser"] = $iduser;
        $ok=true;
      }else{
        $_SESSION["online"] = false;
        $_SESSION["msg"] = "Mail o contraseña incorrecta.";
      }
      
    }else{
      $_SESSION["online"] = false;
      $_SESSION["msg"] = "Se ha producido un error";
    }    
    echo $ok;
    return $ok;
  }
  
  public function logout(){

    session_unset();
    $_SESSION["online"] = false;
    $_SESSION["msg"] = "Sesión cerrada correctamente";
  }

  private function alreadyExist($variable,$param){
    $ok = false;
    $sql = "SELECT $param FROM users WHERE $param = ?";
    $stmt = $this->database->prepare($sql);
    $stmt->bind_param("s", $variable);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows() >= 1){
      $ok = true;
    }
    
    return $ok;
  }

  public function singin($nickname, $mail, $password){
    $ok = false;
    $mailOK = $this->alreadyExist($mail,"email");
    $nicknameOK = $this->alreadyExist($nickname,"nickname");
    if($mailOK == 0  and $nicknameOK == 0)
    {
      $sql = "INSERT INTO users(nickname,email,password) VALUES (?,?,?);";
      $stmt = $this->database->prepare($sql);
      $stmt->bind_param("sss", $nickname, $mail, $password);
      if($stmt->execute())
      {
        $ok = true;
        $_SESSION["msg"] = "Usuario correctamente registrado.";
      }else{
        $_SESSION["msg"] = "Error";
      }    
      $stmt->close();
    }else{
      $_SESSION["msg"] = "Error";
    }
    $lastUserId =$this->database->insert_id;
    $this->recordChange($lastUserId,$lastUserId,"new","user");
    return $ok;
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
      }
    
      return $data;
    
    
  }

  public function changePassword($newPassword){
    $sql = "UPDATE users SET password = ? WHERE iduser = $_SESSION[iduser]";
    $stmt = $this->database->prepare($sql);
    $stmt->bind_param("s",$newPassword);
    $stmt->execute();
    $stmt->close();
    $_SESSION["msg"] = "Nueva contraseña establecida.";
  }

}
?>