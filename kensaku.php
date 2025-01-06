<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHPの基本</title>
</head>
<body>
  <?php
  $code=$_POST['code'];
  $dsn='mysql:dbname=phpkiso;host=localhost;charset=utf8';
  $user='root';
  $password='';
  $dbh=new PDO($dsn,$user,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  $sql='select * from anketo where code=?';
  $stmt=$dbh->prepare($sql);
  $data[]=$code;
  $stmt->execute($data);

  while(1)
  {
    $rec=$stmt->fetch(PDO::FETCH_ASSOC);
    if($rec==false)
    {
      break;
    }
    print $rec['code'];
    print $rec['nickname'];
    print $rec['email'];
    print $rec['goiken'];
    print '<br>';
  }

  $dbh=null;
  ?>

  <br>
  <a href="kensaku.html">検索画面に戻る</a>
</body>
</html>