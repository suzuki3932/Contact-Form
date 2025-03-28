<?php require_once 'class-form.php'; ?>
<!DOCTYPE html>
<html lang="<?php echo $form_language; ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title><?php echo $form_page_title; ?> - <?php echo $site_name; ?></title>
</head>
<body>
<h1><?php echo $form_page_title; ?> - <?php echo $site_name; ?></h1>
<?php $forminit->processSubmisson(); ?>
<form method="post" action="?submit=true">
    <?php $forminit->createFormHTMLDOM(['name', 'email']); ?>
    <?php $forminit->createFormTextareaHTMLDOM(['content']); ?>
    <button type="submit"><?php echo $submitbutton_title; ?></button>
</form>
</body>
</html>