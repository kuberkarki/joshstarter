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
    </li> --><li {!! (Request::is('admin/ads') || Request::is('admin/ads/create') || Request::is('admin/ads/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="livicon" data-name="list-ul" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
        <span class="title">Ads</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/ads') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/ads') }}">
                <i class="fa fa-angle-double-right"></i>
                Ads
            </a>
        </li>
        <li {!! (Request::is('admin/ads/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/ads/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Ad
            </a>
        </li>
    </ul>
</li><li {!! (Request::is('admin/resources') || Request::is('admin/resources/create') || Request::is('admin/resources/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="livicon" data-name="list-ul" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
        <span class="title">Resources</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/resources') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/resources') }}">
                <i class="fa fa-angle-double-right"></i>
                Resources
            </a>
        </li>
        <li {!! (Request::is('admin/resources/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/resources/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Resource
            </a>
        </li>
    </ul>
</li><li {!! (Request::is('admin/pages') || Request::is('admin/pages/create') || Request::is('admin/pages/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="livicon" data-name="list-ul" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
        <span class="title">Pages</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/pages') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/pages') }}">
                <i class="fa fa-angle-double-right"></i>
                Pages
            </a>
        </li>
        <li {!! (Request::is('admin/pages/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/pages/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Page
            </a>
        </li>
    </ul>
</li><li {!! (Request::is('admin/bookings') || Request::is('admin/bookings/create') || Request::is('admin/bookings/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="livicon" data-name="list-ul" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
        <span class="title">Bookings</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/bookings') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/bookings') }}">
                <i class="fa fa-angle-double-right"></i>
                Bookings
            </a>
        </li>
        <li {!! (Request::is('admin/bookings/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/bookings/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Booking
            </a>
        </li>
    </ul>
</li><li {!! (Request::is('admin/ads_categories') || Request::is('admin/ads_categories/create') || Request::is('admin/ads_categories/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="livicon" data-name="list-ul" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
        <span class="title">Ads_categories</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/ads_categories') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/ads_categories') }}">
                <i class="fa fa-angle-double-right"></i>
                Ads_categories
            </a>
        </li>
        <li {!! (Request::is('admin/ads_categories/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/ads_categories/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Ads_category
            </a>
        </li>
    </ul>
</li><li {!! (Request::is('admin/exchanges') || Request::is('admin/exchanges/create') || Request::is('admin/exchanges/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="livicon" data-name="list-ul" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
        <span class="title">Exchanges</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/exchanges') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/exchanges') }}">
                <i class="fa fa-angle-double-right"></i>
                Exchanges
            </a>
        </li>
        <li {!! (Request::is('admin/exchanges/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/exchanges/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Exchange
            </a>
        </li>
    </ul>
</li>