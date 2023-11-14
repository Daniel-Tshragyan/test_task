<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('js/index.js')}}"></script>
    <title>Document</title>
</head>
<body>
<div class="container w-100 h-100 d-flex justify-content-center align-items-center">
    <div class="card col-4 mt-5" style="width: 18rem;">
        @csrf
        <div class="card-body">
            <div class="informationModal">
                <h5>
                    Всего: <span id="userCount">{{$usersCount}}</span>
                </h5>
                <h5>
                    Добавлено: <span id="userAddedCount">0</span>
                </h5>
                <h5>
                    Обнавлено: <span id="userUpdatedCount">0</span>
                </h5>
            </div>
            <button class="btn btn-primary getUsers">Импортировать пользователей</button>
        </div>
    </div>
</div>
</body>
</html>
