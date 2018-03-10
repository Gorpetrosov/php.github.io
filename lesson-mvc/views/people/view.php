<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View People</title>
    <style>
        body {
            font-family:sans-serif;
            color: #596775;
        }
        .people-block {
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
 <div class="people-block">
     <h2><?= $PeopleItem['name'] ?></h2>
     <hr>
     <img src="/assets/images/<?= $PeopleItem['images'] ?>" alt="">
     <p class="date"><?= $PeopleItem['position'] ?></p>
     <hr>
     <p><?= $PeopleItem['text'] ?></p>
     <p><?= $PeopleItem['created_at'] ?></p>

 </div>
</body>
</html>