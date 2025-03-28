# Contact Form
## Contact Formとは
PHPで作成された、お問い合わせフォームです。
## 使い方
まず、以下のサイトからダウンロードします。  
[https://github.com/suzuki3932/Contact-Form-With-PHP/releases/tag/1.0](https://github.com/suzuki3932/Contact-Form-With-PHP/releases/tag/1.0)  
ダウンロードしたファイルを解凍し、項目を編集する必要がある場合は`class-form.php`ファイルを開きます。  
弄る行は3から61行目です。
```php
    public function createFormHTMLDOM($required = []) {
        $form_inputs = array('名前', 'メールアドレス', '題名'); // 項目を追加するには'項目名'、, で区切る
        $form_types = array('text', 'email', 'text'); // 項目を追加するには'項目のHTMLのtype属性'、, で区切る
        $form_slugs = array('name', 'email', 'subject'); // 項目を追加するには'項目の英語名(小文字)'、, で区切る、日本語はNG
        $form_inputs_number = count($form_inputs);
        for ($i = 0; $i < $form_inputs_number; $i++) {
            echo '<label for="' . $form_slugs[$i] . '">' . $form_inputs[$i] . '</label>';
            echo '<input type="' . $form_types[$i] . '" name="' . $form_slugs[$i] . '" id="' . $form_slugs[$i] . '"';
            if (in_array($form_slugs[$i], $required)) {
                echo ' required';
            }
            echo '><br>';
        }
    }

    public function createFormTextareaHTMLDOM($required = []) {
        $textarea_inputs = array('内容'); // 項目を追加するには'項目名'、, で区切る
        $textarea_slugs = array('content'); // 項目を追加するには'項目の英語名(小文字)'、, で区切る、日本語はNG
        $textarea_inputs_number = count($textarea_inputs);
        for ($i = 0; $i < $textarea_inputs_number; $i++) {
            echo '<label for="' . $textarea_slugs[$i] . '">' . $textarea_inputs[$i] . '</label>';
            echo '<textarea name="' . $textarea_slugs[$i] . '" id="' . $textarea_slugs[$i] . '"';
            if (in_array($textarea_slugs[$i], $required)) {
                echo ' required';
            }
            echo '></textarea><br>';
        }
    }

    public function processSubmisson() {
        if (isset($_GET['submit']) && $_GET['submit'] == 'true') {
            $form_inputs_submission = array('名前', 'メールアドレス', '題名', '内容'); // 項目を追加するには'項目名'、, で区切る
            /*
            $form_data_check
            書き方
            フォームデータ受信始まりからフォームデータ受信終わりまで編集します。
            , で区切ります。
            項目を追加するには以下のコードを追記してください。最後は区切らないでください。
            もし項目を追加したいなら区切ります。
            isset($_POST['$form_slugsまたは$textarea_slugs']) ? $_POST[''$form_slugsまたは$textarea_slugs'] : ''
            */
            // フォームデータ受信始まり
            $form_data_check = array(
                isset($_POST['name']) ? $_POST['name'] : '',
                isset($_POST['email']) ? $_POST['email'] : '',
                isset($_POST['subject']) ? $_POST['subject'] : '',
                isset($_POST['content']) ? $_POST['content'] : ''
            );
            // フォームデータ受信終わり
            $form_inputs_number_check = count($form_inputs_submission);
            echo '<h2>お問い合わせが送信されました</h2>';
            echo '<p>お問い合わせありがとうございます。</p>';
            echo '<h3>内容</h3>';
            for ($i = 0; $i < $form_inputs_number_check; $i++) {
                echo htmlspecialchars($form_inputs_submission[$i], ENT_QUOTES, 'UTF-8') . ':' . htmlspecialchars($form_data_check[$i], ENT_QUOTES, 'UTF-8') . '<br>';
            }
            $to = 'サイト管理者のメールアドレス';
            $subject = 'サイト名 - お問い合わせが送信されました';
            $message = "
            内容は次の通りです。\n
            ";
            for ($j = 0; $j < $form_inputs_number_check; $j++) {
                $message .= htmlspecialchars($form_inputs_submission[$j], ENT_QUOTES, 'UTF-8') . ':' . htmlspecialchars($form_data_check[$j], ENT_QUOTES, 'UTF-8')."\n";
            }
            $headers = 'From: サイト管理者のメールアドレス';
            mb_language('Japanese');
            mb_internal_encoding('UTF-8');
            mb_send_mail($to, $subject, $message, $headers);
        }
    }

```
