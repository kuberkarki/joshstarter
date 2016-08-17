<li {!! (Request::is('admin/events') || Request::is('admin/events/create') || Request::is('admin/events/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="livicon" data-name="list-ul" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
        <span class="title">Events</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/events') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/events') }}">
                <i class="fa fa-angle-double-right"></i>
                Events
            </a>
        </li>
        <li {!! (Request::is('admin/events/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/events/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Event
            </a>
        </li>
    </ul>
</li>

<li {!! ((Request::is('admin/newscategory') || Request::is('admin/newscategory/create') || Request::is('admin/news') ||  Request::is('admin/news/create')) || Request::is('admin/news/*') || Request::is('admin/newscategory/*') ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="comment" data-c="#F89A14" data-hc="#F89A14" data-size="18"
               data-loop="true"></i>
            <span class="title">News</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/newscategory') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/newscategory') }}">
                    <i class="fa fa-angle-double-right"></i>
                    News Category List
                </a>
            </li>
            <li {!! (Request::is('admin/news') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/news') }}">
                    <i class="fa fa-angle-double-right"></i>
                    News List
                </a>
            </li>
            <li {!! (Request::is('admin/news/create') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/news/create') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Add New News
                </a>
            </li>
        </ul>
    </li>
   <!--  <li {!! (Request::is('admin/news') || Request::is('admin/news_item')  ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="move" data-c="#ef6f6c" data-hc="#ef6f6c" data-size="18"
               data-loop="true"></i>
            <span class="title">News</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/news') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/news') }}">
                    <i class="fa fa-angle-double-right"></i>
                    News
                </a>
            </li>
            <li {!! (Request::is('admin/news_item') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/news_item') }}">
                    <i class="fa fa-angle-double-right"></i>
                    News Details
                </a>
            </li>
        </ul>
    </li> -->