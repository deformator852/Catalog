<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login</title>
    @vite(['resources/sass/app.sass','resources/js/app.js'])
</head>

<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 d-flex justify-content-center align-items-center form-container">
            <form action="" method="POST">
                @csrf
                <div>
                    <input class="form-control form-control-lg mb-3 border border-primary form-container__input"
                           type="text"
                           name="name"
                           id="name"
                           placeholder="username">
                </div>
                <div>
                    <input class="form-control form-control-lg mb-3 border border-primary form-container__input"
                           type="password"
                           name="password" id="password"
                           placeholder="**************">
                </div>
                <div>
                    <button class="btn btn-outline-secondary text-uppercase" type="submit">login</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

</html>
