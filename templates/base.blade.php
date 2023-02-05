<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{$title ?? 'CFM'}}</title>
    {{ html_entity_decode($assets)  }}
</head>
<body class="h-100" style="overflow-x: hidden">
    <div id="notifications"></div>
    <div id="tools"></div>
    <div class="container h-100">
        <div>
            @foreach($notifications as $notification)
                <div class="alert alter-{{$notification->level}}" role="alert">
                    {{$notification->message}}
                </div>
            @endforeach
        </div>
        @yield('content')
    </div>
</body>
</html>
