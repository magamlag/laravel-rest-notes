<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Github User area</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ elixir('css/github-dash.css') }}">
    <script src="{{ elixir('js/github-dash.js') }}"></script>
</head>
<body>
<div class="container">
    <!-- Page Header -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header text-center">Github User Area</h1>
        </div>
    </div><!-- /row -->
    <div class="row" id="area">
        <ul class="nav nav-pills" role="tablist">
            <li class="active">
                <a href="#repos" data-toggle="tab">My Repositories</a>
            </li>
            <li>
                <a href="#issues" data-toggle="tab">My Issues</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="repos" role="tabpanel">
                <h3>Content's background color is the same for the tab</h3>
                <?php $key = 1; ?>
                @if($repos)
                    @foreach(array_chunk($repos,3) as $items )
                        <div class="row same-size">
                        @foreach($items as $k => $repo)
                            <div class="col-md-4 col-sm-6 repo-col">
                                <div class="repo-item">
                                    <div class="pull-right stars">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        @php echo $repo->stargazers_count ? $repo->stargazers_count : ''  @endphp
                                    </div>
                                    <a href="{{$repo->html_url}}">to Github</a>
                                    <h3>
                                        <a href="#">{{$repo->name}}</a>
                                    </h3>
                                    <time>{{$repo->updated_at}}</time>
                                    <div class="last-commit">

                                    </div>
                                    <div class="repo-item-text">
                                        @if($k % 3 == 0)
                                        There are plenty of articles that explain what design patterns are, and how to implement them; the web doesn't need yet another one of those articles! Instead, in this article, we will more discuss the when and why, rather than the which and how.
                                        @else
                                        Use a Factory Pattern when you find yourself writing code to gather information necessary to create objects.
                                            @endif
                                    </div>

                                </div>
                            </div>
                        @endforeach
                        </div>
                    @endforeach
                @else
                    No repositories
                @endif
            </div><!-- /tab-pane -->
            <div class="tab-pane active" id="issues" role="tabpanel"></div><!-- /tab-pane -->
        </div><!-- /tab-content -->
    </div><!-- /row -->
</div>
</body>
<script></script>
</html>
