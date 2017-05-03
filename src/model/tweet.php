<?php

class tweet extends activeRecord {

  private $userId;
  private $text;
  private $creationDate;

  public function __construct(){
    parent::__construct();
    $this->userId = '';
    $this->text = '';
    $this->creationDate = '';
  }

  static public function loadById($id){
      self::connect();
      $sql = "SELECT * FROM tweets WHERE id=:id";
      $stmt = self::$db->conn->prepare($sql);
      $result = $stmt->execute([ 'id' => $id ]);
      if ($result && $stmt->rowCount() >= 1) {
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          $loadedTweet = new tweet();
          $loadedTweet->userId = $row['userId'];
          $loadedTweet->text = $row['text'];
          $loadedTweet->creationDate = $row['creationDate'];
          return $loadedTweet;
      }
      return null;
  }

  static public function loadAllTweetsByUserId($userId){
      self::connect();
      $sql = "SELECT * FROM tweets WHERE userId=:userId";
      $stmt = self::$db->conn->prepare($sql);
      $result = $stmt->execute([ 'userId' => $userId ]);
      $returnTable = [];
      if ($result !== false && $result->rowCount() > 0) {
          foreach ($result as $row){
            $loadedTweet = new tweet();
            $loadedTweet->id = $row['id'];
            $loadedTweet->text = $row['text'];
            $loadedTweet->creationDate = $row['creationDate'];
            $returnTable[] = $loadedTweet;
          }
      }
      return $returnTable;
  }

  static public function loadAll(){
      self::connect();
      $sql = "SELECT * FROM tweets";
      $result = self::$db->conn->query($sql);
      $returnTable = [];
      if ($result !== false && $result->rowCount() > 0) {
          foreach ($result as $row){
            $loadedTweet = new tweet();
            $loadedTweet->id = $row['id'];
            $loadedTweet->userId = $row['userId'];
            $loadedTweet->text = $row['text'];
            $loadedTweet->creationDate = $row['creationDate'];
            $returnTable[] = $loadedTweet;
          }
      }
      return $returnTable;
  }

  public function save(){
      self::connect();
      if (self::$db->conn != null) {
          if ($this->id == -1) {
              $sql = "INSERT INTO tweets (userId, text, creationDate) values (:userId, :text, :creationDate)";
              $stmt = self::$db->conn->prepare($sql);
              $result = $stmt->execute([
                  'userId' => $this->userId,
                  'text' => $this->text,
                  'creationDate' => $this->creationDate
              ]);

              if ($result == true) {
                  $this->id = self::$db->conn->lastInsertId();
                  return true;
              } else {
                  echo self::$db->conn->error;
              }
          } else {
              $sql = "UPDATE tweets SET userId = :userId, text = :text, creationDate = :creationDate WHERE id = :id";
              $stmt = self::$db->conn->prepare($sql);
              $result = $stmt->execute([
                  'userId' => $this->userId,
                  'text' => $this->text,
                  'creationDate' => $this->creationDate,
                  'id' => $this->id
              ]);

              if ($result == true) {
                  return true;
              }
          }
      } else {
          echo "Brak polaczenia\n";
      }
      return false;
  }

  public function delete(){
      self::connect();
      if($this->id != -1){
          $sql = "DELETE FROM tweets WHERE id=:id";
          $stmt = self::$db->conn->prepare($sql);
          $result = $stmt->execute([ 'id' => $this->id]);
          if ( $result == true ){
              $this->id = -1;
              return true;
          }
          return false;
      }
      return true;
  }

  public function getId()
    {
      return $this->id;
  }

  public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
  }

  public function getUserId()
    {
        return $this->userId;
  }

  public function setText($text)
    {
        $this->text = $text;

        return $this;
  }

  public function getText()
    {
        return $this->text;
  }

  public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
  }

  public function getCreationDate()
    {
        return $this->creationDate;
  }

}
