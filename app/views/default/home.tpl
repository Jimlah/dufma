<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cube</title>
    {css('styles')}
</head>
<body>
    <h1 class="title">
        {env('project_name')}
    </h1>
    <div class="cube-welcome">
        Welcome to PHP Cube.
    </div>
    <div class="cube-version">
        v{env('cube_version')}
    </div>
    <div class="cube-docs">
        <a target="_blank" href="https://bitbucket.org/brainex/php-cube/src/master/readme.md">Read the documentation</a>
    </div>
</body>
</html>