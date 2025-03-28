<?php
class Form {
    public function createFormHTMLDOM($required = []) {
        $form_inputs = array('名前', 'メールアドレス', '題名');
        $form_types = array('text', 'email', 'text');
        $form_slugs = array('name', 'email', 'subject');
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
        $textarea_inputs = array('内容');
        $textarea_slugs = array('content');
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
            $form_inputs_submission = array('名前', 'メールアドレス', '題名', '内容');
            $form_data_check = array(
                isset($_POST['name']) ? $_POST['name'] : '',
                isset($_POST['email']) ? $_POST['email'] : '',
                isset($_POST['subject']) ? $_POST['subject'] : '',
                isset($_POST['content']) ? $_POST['content'] : ''
            );
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

    public function loadcss($css_path) {
        echo '<link rel="stylesheet" href="' . htmlspecialchars($css_path, ENT_QUOTES, 'UTF-8') . '">';
    }

    public function configurereCAPTCHA($site_key) {
        echo '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
        echo '<div class="g-recaptcha" data-sitekey="' . htmlspecialchars($site_key, ENT_QUOTES, 'UTF-8') . '"></div>';
    }
}

$form_page_title = 'お問い合わせ';
$site_name = 'テスト用サイト';
$form_language = 'ja';
$submitbutton_title = '送信';
$forminit = new Form();
?>
