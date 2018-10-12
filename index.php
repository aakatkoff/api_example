<!doctype html>
<html class="no-js" lang="ru">
<head>
    <meta charset="utf-8"/>
    <title>Лэндинг</title>
</head>
<body>
    <h1>Лэндинг</h1>

    <form  action="order.php" method="post">
        <div>
            <label for="name">Ф.И.О.</label>
        </div>
        <div>
            <input name="name" id="name" type="text" required />
        </div>
        <div>
            <label for="phone">Телефон</label>
        </div>
        <div>
            <input name="phone" id="phone" type="text" required />
        </div>
        <div>
            <input type="hidden" name="sub1" value="<?php echo htmlspecialchars($_GET['sub1']) ?>" />
            <input type="hidden" name="sub2" value="<?php echo htmlspecialchars($_GET['sub2']) ?>" />
            <input type="hidden" name="sub3" value="<?php echo htmlspecialchars($_GET['sub3']) ?>" />
            <input type="hidden" name="sub4" value="<?php echo htmlspecialchars($_GET['sub4']) ?>" />
            <input type="hidden" name="sub5" value="<?php echo htmlspecialchars($_GET['sub5']) ?>" />
            <input type="submit" value="Заказать">
        </div>
    </form>

</body>
</html>