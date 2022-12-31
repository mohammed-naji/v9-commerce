<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notifications Center</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>

    <div class="container mt-5">
        <h2>Notifications ({{ $user->unreadNotifications->count() }})</h2>
        <div class="list-group">
            @foreach ($user->notifications as $item)
            {{-- {{ $item->read_at }} --}}
            <a href="{{ route('read_notify', $item->id) }}" class="list-group-item list-group-item-action {{ $item->read_at ? 'active' : '' }}">
                {{ $item->data['msg'] }}
              </a>
            @endforeach

          </div>
    </div>

</body>
</html>
