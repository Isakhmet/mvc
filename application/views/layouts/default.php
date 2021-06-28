<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/application/views/js/main.js" type="text/javascript"></script>
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <?php if(!$is_admin): ?>
            <div class="sign-in"><input type="submit" value="Sign in"></div>
            <?php endif;?>
            <?php if($is_admin): ?>
            <div class="sign-out"><input type="submit" value="Sign out"></div>
            <?php endif;?>
        </nav>
    </header>
    <?php echo $content; ?>
</body>
</html>