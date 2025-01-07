<?php

// POST送信で送られてきた、ユーザーが入力した内容を変数に保存
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// サニタイジングでクロスサイドスクリプティングを防ぐ
$username = htmlspecialchars($username);
$email = htmlspecialchars($email);
$password = htmlspecialchars($password);

// ユーザーネームが空白だった場合の表示の切り替え
if($username === '') {
  print 'ユーザーネームが入力されていません。'.'<br>';
} else {
  print 'ユーザー名：'.$username.'<br>';
}
// メールアドレスが空白だった場合の表示の切り替え
if($email === '') {
  print 'メールアドレスが入力されていません。'.'<br>';
} else {
  print 'メールアドレス：'.$email.'<br>';
}
// パスワードが空白だった場合の表示の切り替え
if($password === '') {
  print 'パスワードが入力されていません。'.'<br>';
} else {
  print 'パスワード：'.$password.'<br>';
}

// 各項目のうちどれかが空白だった場合
if($username === '' || $email === '' || $password === '') {
  // 戻るボタンを表示する
  print '<form>';
  print '<input type="button" onclick="history.back()" value="戻る">';
  print '</form>';

// 各項目すべてが入兎力済みだった場合
} else {
  // データの送信先をthanks.phpに設定
  print '<form method="post" action="../Model/thanks.php">';
  // ユーザーが入力したデータを、ユーザーに見えない状態でvalue属性に格納して次のページに引き継ぐ
  print '<input type="hidden" name="username" value="'.$username.'">';
  print '<input type="hidden" name="email" value="'.$email.'">';
  print '<input type="hidden" name="password" value="'.$password.'">';
  // 戻るボタンと送信ボタンを表示する
  print '<input type="button" onclick="history.back()" value="戻る">';
  print '  ';
  print '<input type="submit" value="送信">';
  print '</form>';
}

?>