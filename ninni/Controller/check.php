<?php
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

if($username === '') {
  print 'ユーザーネームが入力されていません。'.'<br>';
} else {
  print 'ユーザー名：'.$username.'<br>';
}

if($email === '') {
  print 'メールアドレスが入力されていません。'.'<br>';
} else {
  print 'メールアドレス：'.$email.'<br>';
}

if($password === '') {
  print 'パスワードが入力されていません。'.'<br>';
} else {
  print 'パスワード：'.$password.'<br>';
}

if($username === '' || $email === '' || $password === '') {
  print '<form>';
  print '<input type="botton" onclick="history.back()" value="戻る">';
  print '</form>';

} else {
  print '<form method="post" action="../Model/thanks.php">';

  print '<input type="hidden" name="username" value="'.$username.'">';
  print '<input type="hidden" name="email" value="'.$email.'">';
  print '<input type="hidden" name="password" value="'.$password.'">';

  print '<input type="button" onclick="history.back()" value="戻る">';
  print '  ';
  print '<input type="submit" value="送信">';
  print '</form>';
}
?>