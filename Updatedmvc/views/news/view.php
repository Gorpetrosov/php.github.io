<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View News</title>
    <style>
        body {
            font-family:sans-serif;
            color: #596775;
        }
        .news-block {
            width: 80%;
            margin: auto;
        }
        img {
            width: 100%;
            max-height: 450px;
        }
        .date {
            color: coral;
            font-size: 14px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="news-block">
        <h2><?= $newsItem['h1'] ?></h2>
        <hr>
        <img src="/assets/images/<?= $newsItem['preview'] ?>" alt="">
        <p class="date"><?= $newsItem['date'] ?></p>
        <hr>
        <p><?= $newsItem['short_content'] ?></p>
        <p><?= $newsItem['content'] ?></p>
    </div>


</body>
</html>
