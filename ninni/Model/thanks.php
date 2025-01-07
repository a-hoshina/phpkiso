    <?php

    try {
        // データベース接続情報を設定し、PDOを使ってデータベースに接続する
        $dsn = 'mysql:dbname=phpkiso;host=localhost;charset=utf8';
        $user = 'root';
        $password = '';
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        // POST送信で送られてきた、ユーザーが入力したデータを変数に保存
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // サニタイジングでクロスサイドスクリプティングを防ぐ
        $username = htmlspecialchars($username);
        $email = htmlspecialchars($email);
        $goiken = htmlspecialchars($password);

        // メールアドレスが既に登録されているかチェック
        // データベースから、ユーザーが入力したメールアドレスと同じメールアドレスをSELECT文で取得しようとする
        // SQL文を作成・準備・実行
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        // データベースにすでに同じメールアドレスがある場合、SELECT文でのメールアドレスの取得に成功しているため、$recには取得したメールアドレスが格納される
        // データベースにまだ同じメールアドレスが存在しない場合、SELECT文でのメールアドレスの取得に失敗しているため、$recにはfalseが格納される
        // fetchで取得されたデータを翻訳し、PHPで使用できるようにして、$recにそのデータを格納している
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        // var_dump($rec);
        // exit();

        // まだ同じメールアドレスがデータベースに存在していない場合の処理
        if ($rec === false) {
          // userテーブルにユーザーが入力したデータを保存する
          // createdは作成日時、modifiedは更新日時を記載する欄
          // SQL文を作成・準備・実行・接続を閉じる
            $sql = "INSERT INTO users (username, email, password, created, modified) VALUES('$username', '$email', '$password', now(), now())";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $dbh = null;
            print 'ユーザー登録完了<br>';
            print '<a href="../View/index.html">ユーザー登録画面へ戻る</a>';

        // すでに同じメールアドレスがデータベースに存在している場合の処理
        } else {
            $dbh = null;
            print '既に登録されているメールアドレスです。<br>';
            print '<a href="../View/index.html">ユーザー登録画面へ戻る</a>';
        }

    // ExceptionはPHP側で準備されている、エラーに関する機能
    } catch (Exception $e) {
        // エラー発生時のメッセージ
        print 'ただいま障害によりご迷惑おかけしております。';
    }

?>