<?php
class UserController{
    public function __construct($link) {
      $this->database = $link;
    }

  public function recordChange($userId,$idEntity,$action,$entity){
    
    $sql = "INSERT iNTO changes(iduser,entityid,action,entity,date)VALUES(?,?,?,?,?)";
    
    $stmt = $this->database->prepare($sql);
    $iduser=intval($userId);
    $entityId=intval($idEntity);
    $date = date('Y/m/d H:i:s');
    $stmt->bind_param("iisss", $iduser, $entityId, $action,$entity,$date);
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

  public function alreadyExist($variable,$param){
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
    
    
      $sql = "INSERT INTO users(nickname,email,password) VALUES (?,?,?);";
      $stmt = $this->database->prepare($sql);
      $stmt->bind_param("sss", $nickname, $mail, $password);
      $stmt->execute();
      $stmt->close();
      $lastUserId =$this->database->insert_id;
      return $lastUserId;
  }

  public function searchUserId($mail){

    $sql = "SELECT iduser FROM users WHERE email='$mail'";
    $query = $this->database->query($sql);
    $iduser = $query->fetchColumn();
    return $iduser;
  }

  public function showUser($mail){
    $sql = "SELECT changes.date, nickname FROM users 
    INNER JOIN changes on changes.entityid = users.iduser and changes.entity = 'user'
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
    $sql = "UPDATE users SET password = ? WHERE iduser = ?";
    $stmt = $this->database->prepare($sql);
    $stmt->bind_param("si",$newPassword,$_SESSION["iduser"]);
    $stmt->execute();
    $stmt->close();
  }

  public function changeNickname($newNickname){
    $sql = "UPDATE users SET nickname = ? WHERE iduser = ?";
    $stmt = $this->database->prepare($sql);
    $stmt->bind_param("si",$newNickname,$_SESSION["iduser"]);
    $stmt->execute();
    $stmt->close();
    
    
  }
  public function deleteUser($id){
    $sql = "DELETE FROM users WHERE iduser = ?";
    $stmt = $this->database->prepare($sql);
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $stmt->close();
    
  }


}
?>