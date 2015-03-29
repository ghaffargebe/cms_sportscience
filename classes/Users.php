<?php
 
/**
 * Class to handle users
 */
 
class Users
{
 
  // Properties
 
  /**
  * @var int The users ID from the database
  */
  public $id = null;
 
  /**
  * @var string full name from the database
  */
  public $nama = null;
 
  /**
  * @var string username from the database
  */
  public $username = null;
 
  /**
  * @var string group from the database
  */
  public $group = null;

  public $password = null;
 
 
  /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */
 
  public function __construct( $data=array() ) {
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['nama'] ) ) $this->nama = $data['nama'];
    if ( isset( $data['username'] ) ) $this->username = $data['username'];
    if ( isset( $data['password'] ) ) $this->password = $data['password'];
    if ( isset( $data['group'] ) ) $this->group = $data['group'];
  }
 
 
  /**
  * Sets the object's properties using the edit form post values in the supplied array
  *
  * @param assoc The form post values
  */
 
  public function storeFormValues ( $params ) {
 
    // Store all the parameters
    $this->__construct( $params );
 
    // Parse and store the publication date
    if ( isset($params['password']) ) {
      $this->password = md5($params['password']);
    }
  }
 
 
  /**
  * Returns an Article object matching the given article ID
  *
  * @param int The article ID
  * @return Article|false The article object, or false if the record was not found or there was a problem
  */
 
  public static function getById( $id ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM users WHERE id = :id and status_delete = '0'";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ($row){
      return new Users($row);
    } 
  }
 
 
  /**
  * Returns all (or a range of) Article objects in the DB
  *
  * @param int Optional The number of rows to return (default=all)
  * @param string Optional column by which to order the articles (default="publicationDate DESC")
  * @return Array|false A two-element array : results => array, a list of Article objects; totalRows => Total number of articles
  */
 
  public static function getList( $numRows=1000000, $order="id DESC" ) {
    //$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM users where status_delete = 0
            ORDER BY ".$order." LIMIT $numRows";
    $query = mysql_query($sql);
    $list = array();
    
    while ( $row = mysql_fetch_object($query) ) {
      $list[] = $row;
    }
    $total = mysql_num_rows($query);
    return ( array ( "results" => $list, 
                      //"group" => $group ,
                      "total" => $total
            ) );
  }

  public static function getGroup() {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM user_group";
    $st = $conn->prepare ( $sql );
    $st->execute();
    while ($row = $st->fetch(PDO::FETCH_OBJ)) {
      $group[$row->id]=$row->nama_group;
    }
    $conn = null;
    return $group;
  }

  public function insert() {
 
    // Does the Article object already have an ID?
    //if ( !is_null( $this->id ) ) trigger_error ( "Article::insert(): Attempt to insert an Article object that already has its ID property set (to $this->id).", E_USER_ERROR );

    // Insert the Article
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "INSERT INTO users 
                    (nama,username,password,id_group,status) 
              VALUES
                    (:nama,:username,:password,:group,:status)";
    $status = '1';
    $st = $conn->prepare ( $sql );
    $st->bindParam( ":nama", $this->nama);
    $st->bindParam( ":username", $this->username);
    $st->bindParam( ":password", $this->password);
    $st->bindParam( ":group", $this->group);
    $st->bindParam( ":status", $status);
    $st->execute();
    $this->id = $conn->lastInsertId();

    // $activity = "Insert data to tabel : berita. Detail : ( tanggal = ".$this->tanggal.", judul = ".$this->judul.", isi = ".$this->isi.", id_kategori = ".$this->id_kategori.", username = ".$_SESSION['username'].", gambar = ".$filename.")";
    // $kategori_log = "Insert Berita";
    // $sql_log = "INSERT INTO log_history
    //                   (username, activity, kategori_log)
    //               VALUES
    //                   (:username, :activity, :kategori_log)";
    // $stlog = $conn->prepare($sql_log);
    // $stlog->bindParam(':username', $_SESSION['username']);
    // $stlog->bindParam(':activity', $activity);
    // $stlog->bindParam(':kategori_log', $kategori_log);
    // $stlog->execute();
    $conn = null;
  }

  public function activate($id) {
 
    // Does the User object have an ID?
    if ( is_null( $id ) ) trigger_error ( "Users::activate(): Attempt to delete an Users object that does not have its ID property set.", E_USER_ERROR );
 
    // Delete the User
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "UPDATE users SET status = '1' WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }

  public function deactivate($id) {
 
    // Does the User object have an ID?
    if ( is_null( $id ) ) trigger_error ( "Users::deactivate(): Attempt to delete an Users object that does not have its ID property set.", E_USER_ERROR );
 
    // Delete the User
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "UPDATE users SET status = '0' WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
 
  public function delete($id) {
 
    // Does the User object have an ID?
    if ( is_null( $id ) ) trigger_error ( "Users::delete(): Attempt to delete an Users object that does not have its ID property set.", E_USER_ERROR );
 
    // Delete the User
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "UPDATE users SET status_delete = '1' WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
 
}
 
?>