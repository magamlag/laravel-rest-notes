<html>
    <head>
        <title>My issues</title>
    </head>
    <body>
        <ul>
            @forelse ($issues as $issue)
                <ul>
                    <li>
                        <b>Title</b> :  {{$issue->title}}
                    </li>
                    <li>
                        <b>Body</b> : {{$issue->body}}
                    </li>
                    <li>
                        <b>State</b> : {{$issue->state}}
                    </li>
                </ul>
            @empty
                <b>No issues</b>
            @endforelse
        </ul>
    </body>
</html>