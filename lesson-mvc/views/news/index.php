<!doctype html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>All News</title>
    <style>
        body {
            font-family:sans-serif;
            color: #596775;
        }
        a {
            color: blue;
            font-size: 14px;
            font-weight: bold;
        }
        img {
            width: 250px;
            float: left;
            margin-right: 15px;
        }
        .news-block {
            display: table;
            border-bottom: 1px solid #789;
            margin-bottom: 30px;
            padding-bottom: 20px;
        }
        .date {
            color: coral;
            font-size: 14px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<?php foreach ($news_list as $value): ?>
    <div class="news-block">
        <h2><?= $value['h1'] ?></h2>
        <img src="/assets/images/<?= $value['preview'] ?>" alt="">
        <p class="date"><?= $value['date'] ?></p>
        <p>
            <?= $value['short_content'] ?>
            <a href="/news/<?= $value['id'] ?>">Read more</a>
        </p>
    </div>
<?php endforeach; ?>


</body>
</html>