<?php

class comment extends activeRecord {
  private $userId;
  private $postId;
  private $creationDate;
  private $text;

    public function __construct()
    {
      $this->id = -1;
      $this->userId = '';
      $this->postId = '';
      $this->creationDate = '';
      $this->text = '';
    }

    static public function loadById($id)
    {
        self::connect();
        $sql = "SELECT * FROM comments WHERE id=:id";
        $stmt = self::$db->conn->prepare($sql);
        $result = $stmt->execute([ 'id' => $id ]);
        if ($result && $stmt->rowCount() >= 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $loadedComment = new comment();
            $loadedComment->userId = $row['userId'];
            $loadedComment->postId = $row['postId'];
            $loadedComment->creationDate = $row['creationDate'];
            $loadedComment->text = $row['text'];
            return $loadedComment;
        }
        return null;
    }

    static public function loadAllCommentsByPostId($postId){
        self::connect();
        $sql = "SELECT * FROM comments WHERE postId=:postId";
        $stmt = self::$db->conn->prepare($sql);
        $result = $stmt->execute([ 'postId' => $postId ]);
        $returnTable = [];
        if ($result !== false && $stmt->rowCount() > 0) {
            foreach ($stmt as $row){
              $loadedComment = new comment();
              $loadedComment->id = $row['id'];
              $loadedComment->userId = $row['userId'];
              $loadedComment->creationDate = $row['creationDate'];
              $loadedComment->text = $row['text'];
              $returnTable[] = $loadedComment;
            }
        }
        return $returnTable;
    }

    static public function loadAll(){
        self::connect();
        $sql = "SELECT * FROM comments";
        $result = self::$db->conn->query($sql);
        $returnTable = [];
        if ($result->rowCount() > 0) {
            foreach ($result as $row){
                $loadedComment = new comment();
                $loadedComment->id = $row['id'];
                $loadedComment->userId = $row['userId'];
                $loadedComment->text = $row['text'];
                $loadedComment->creationDate = $row['creationDate'];
                $returnTable[] = $loadedComment;
            }
        }
        return $returnTable;
    }

    public function save(){
        self::connect();
        if (self::$db->conn != null) {
            if ($this->id == -1) {
                $sql = "INSERT INTO comments (userId, postId, creationDate, text) values (:userId, :postId, :creationDate, :text)";
                $stmt = self::$db->conn->prepare($sql);
                $result = $stmt->execute([
                    'userId' => $this->userId,
                    'postId' => $this->postId,
                    'creationDate' => $this->creationDate,
                    'text' => $this->text
                ]);

                if ($result == true) {
                    $this->id = self::$db->conn->lastInsertId();
                    return true;
                } else {
                    echo self::$db->conn->error;
                }
            } else {
                $sql = "UPDATE comments SET userId = :userId, postId = :postId, creationDate = :creationDate, text = :text WHERE id = :id";
                $stmt = self::$db->conn->prepare($sql);
                $result = $stmt->execute([
                    'userId' => $this->userId,
                    'postId' => $this->postId,
                    'creationDate' => $this->creationDate,
                    'text' => $this->text,
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
            $sql = "DELETE FROM comments WHERE id=:id";
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

    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setPostId($postId)
    {
        $this->postId = $postId;

        return $this;
    }

    public function getPostId()
    {
        return $this->postId;
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

    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getId()
    {
        return $this->id;
    }
}
