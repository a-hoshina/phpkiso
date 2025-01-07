<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン</title>
</head>
<body>

<?php
try {
// データベース接続情報を設定し、PDOを利用してデータベースに接続する
  $dsn = 'mysql:dbname=phpkiso;host=localhost;charset=utf8';
  $user = 'root';
  $password = '';
  $dbh = new PDO($dsn,$user,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  // POST送信で送られてきた、ユーザーが入力したデータを変数に格納する
  $email = $_POST['email'];
  $password = $_POST['password'];
  // サニタイジングを行い、クロスサイトスクリプティングを防ぐ
  $email = htmlspecialchars($email);
  $password = htmlspecialchars($password);

  /* --- 未入力項目がある場合の処理 --- */
  if ($email === '' || $password === '') {
    // メールアドレスについて
    if ($email === '') {
      print 'メールアドレスを入力してください。'.'<br>';
    } else {
      print $email.'<br>';
    }
    // パスワードについて
    if ($password === '') {
      print 'パスワードを入力してください。'.'<br>';
    } else {
      print $password.'<br>';
    }
    // 戻るボタンを表示する
    print '<form>';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '</form>';

  /* --- データベースと連携する処理 --- */
  } else {
  // SELECT文で、データベースにユーザーが入力したもの同じメールアドレスを取得する
  $sql = "SELECT * FROM users WHERE email = '$email'";
  $stmt = $dbh->prepare($sql);
  $stmt->execute();
  // 一致するメールアドレスがあれば$recにそのメールアドレスを格納
  // 一致するメールアドレスがなければ$recにfalseを格納
  $rec = $stmt->fetch(PDO::FETCH_ASSOC);

  // 一致するメールアドレスがなかった場合の処理
  if ($rec === false) {
    $dbh = null;
    print 'メールアドレスが間違っています。'.'<br>';
    print '<a href = "../View/login.html">ログイン画面へ戻る</a>';
  // 一致するメールアドレスがあった場合
  // パスワードが一致するかどうかを調べる
  } else if ($rec['password'] === $password) {
    print 'ログイン成功'.'<br>';
    print '<a href="../View/login.html">ログイン画面に戻る</a>';
    $dbh = null;
  //ユーザーが入力したパスワードと取得したパスワードが一致しなかったとき
  } else if ($rec['password'] !== $password) {
    print 'パスワードが間違っています'.'<br>';
    print '<a href="../View/login.html">ログイン画面に戻る</a>';
    $dbh = null;
  }
}

} catch (Exception $e) {
  // エラー発生時のメッセージ
  print 'ただいま障害によりご迷惑おかけしております。';
}

?>
</body>
</html>

