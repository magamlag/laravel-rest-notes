<html>
    <head>
        <title>Repos</title>
    </head>
    <body>

        <ul>
            @forelse($repos as $repo)
                <li>
                    <ul>
                        <li><b>Name</b> : {{$repo->full_name}}</li>
                        <li><b>Description</b> : {{$repo->description}}</li>
                        <li><b>Stars</b> : {{$repo->stargazers_count}}</li>
                    </ul>
                </li>
            @empty
                <b>No repos</b>
            @endforelse
        </ul>
    </body>
</html>