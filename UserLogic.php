<?php

require_once 'dbconnect.php';




class UserLogic
{
    /**
     * ユーザーを登録する
     * @param array $userData
     * @return bool $result
     */
    public static function createUser($userData)
    {
        $result = false; 

        $sql =  'INSERT INTO users (name, mail, password, favorite_ramen, exercise_goal,created_at,updated_at) VALUES (?,?,?,?,?,?,?)';


        //ユーザーデータを配列に入れる
        $arr = [];
        $arr[] =  $userData['username'];
        $arr[] =  $userData['email'];
        $arr[] =  password_hash($userData['password'],PASSWORD_DEFAULT);
        $arr[] =  $userData['favorite-ramen'];
        $arr[] =  $userData['exercise-goal'];
        $current_datetime = new DateTime('now');
        $arr[] = $current_datetime->format('Y-m-d');
        $arr[] = $current_datetime->format('Y-m-d');


        try{
            $stmt = connect()->prepare($sql);
            $result= $stmt->execute($arr);
            return $result;

        }catch(\Exception $e){
        return $result;
        } 
    }
    /**
     * ログイン処理
     * @param string $email
     * @param string $password
     * @return bool $result
     */
    public static function login($email,$password)
    {
        //結果
        $result =  false;
        //ユーザをemailから検索して取得
        $user =  self::getUserByEmail($email);

        if(!$user){
            $_SESSION['msg'] =  'メールアドレスが一致しません';
            return $result;
        }

       //パスワードの照会
       if (password_verify($password,$user['password'])){
           //ログイン成功
           session_regenerate_id(true);
           $_SESSION['login_user'] = $user;
           $result = true;
           return $result;

       }
       
        $_SESSION['msg'] =  'パスワードが一致しません';
        return $result;


    }

     /**
     * emailからユーザーを取得
     * @param string $email
     * @return array|bool $user|false
     */
    public static function getUserByEmail($email)
    {
        //SQLの準備
        //SQLの実行
        //SQLの結果を返す
        $sql =  'SELECT * FROM users WHERE mail = ?';


        //emailを配列に入れる
        $arr = [];
        $arr[] = $email;


        try{
            $stmt = connect()->prepare($sql);
            $stmt->execute($arr);
            //SQLの結果を返す
            $user =  $stmt->fetch();
            return $user;
        }catch(\Exception $e){
        return false;
        } 

    }
     /**
     * tmp_keyからユーザーを取得
     * @param string $tmp_key
     * @return array|bool $user|false
     */
    public static function getUserByTmpKey($tmp_key)
    {
        //SQLの準備
        //SQLの実行
        //SQLの結果を返す
        $sql =  'SELECT * FROM users WHERE tmp_key = ?';


        //tmp_keyを配列に入れる
        $arr = [];
        $arr[] = $tmp_key;


        try{
            $stmt = connect()->prepare($sql);
            $stmt->execute($arr);
            //SQLの結果を返す
            $user =  $stmt->fetch();
            return $user;
        }catch(\Exception $e){
        return false;
        } 

    }

    
    /**
     * ログインチェック
     * @param void
     * @return bool $result
     */
     public static function checkLogin()
     {
     $result = false;

    //セッションにログインユーザが入っていなかったらfalse
    if (isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] > 0) {
      return $result =  true;
     }
     return $result;
     }

     /**
      * ログアウト処理
      */
      public static function logout()
      {
        $_SESSION = array();
        session_destroy();
      }
}

function getallramen(){
        $dbh= connect();
        //SQLの準備
        $sql = 'SELECT * FROM ramens';
        //SQLの実行
        $stmt =  $dbh->query($sql);
        //SQLの結果を受け取る
        $result =  $stmt->fetchall(PDO::FETCH_ASSOC);
        return $result;
        $dbh =  null;

}

function getMyRamen($myUserId)
{
    $dbh= connect();
    
    //SQLの実行
    $stmt =  $dbh->query("SELECT * FROM ramens WHERE user_id = '" . $myUserId . "'");
    //SQLの結果を受け取る
    $result =  $stmt->fetchall(PDO::FETCH_ASSOC);
    return $result;
    $dbh =  null;
}



function getselectramen(){
    $dbh= connect();
    //SQLの準備
    $sql = 'SELECT * FROM ramens Where recommends = :recommends';
    //SQLの実行
    $stmt =  $dbh->query($sql);
    //SQLの結果を受け取る
    $result =  $stmt->fetchall(PDO::FETCH_ASSOC);
    return $result;
    $dbh =  null;

}







function userUpdate($users){

$sql =  'UPDATE users SET
   name = :name, favorite_ramen = :favorite_ramen, exercise_goal = :exercise_goal
WHERE
   id = :id';

$dbh = connect();
$dbh->beginTransaction();

try{
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':name',$users['username'], PDO::PARAM_STR);
//$stmt->bindValue(':mail',$users['email'], PDO::PARAM_STR);
//$stmt->bindValue(':password',password_hash($users['password'],PASSWORD_DEFAULT), PDO::PARAM_STR);
$stmt->bindValue(':favorite_ramen',$users['favoriteramen'], PDO::PARAM_STR);
$stmt->bindValue(':exercise_goal',$users['exercisegoal'], PDO::PARAM_STR);
$stmt->bindValue(':id',$users['id'], PDO::PARAM_INT);
$stmt->execute();
$dbh->commit();
//echo 'アカウントを編集しました';
}catch(PDOException $e){
$dbh->rollBack();
exit($e);
}


}




