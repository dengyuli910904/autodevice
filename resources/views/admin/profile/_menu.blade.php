<aside class="Hui-aside">
    
    <div class="menu_dropdown bk_2">
        <dl id="menu-brand">
            <dt><i class="Hui-iconfont">&#xe613;</i>品牌管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li id="brand-list"><a href="{{ url('brand/list')}}" title="品牌列表">品牌列表</a></li>
                    <li id="brand-create"><a href="{{ url('brand/create')}}" title="品牌添加">品牌添加</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-news">
            <dt><i class="Hui-iconfont">&#xe616;</i> 产品管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li id="news-article"><a href="{{ url('admin/news/article/')}}" title="文章新闻">产品列表</a></li>
                    <li id="news-pictures"><a href="{{ url('admin/news/pictures/')}}" title="图片新闻">产品添加</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-topics">
            <dt><i class="Hui-iconfont">&#xe620;</i> 类型管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li id="topics-index"><a href="{{ url('type/list')}}" title="分类管理">类型列表</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-news">
            <dt><i class="Hui-iconfont">&#xe620;</i> 新闻管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li id="news-list"><a href="{{ url('news/list')}}" title="banner管理">新闻列表</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-category">
            <dt><i class="Hui-iconfont">&#xe620;</i> 首页管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a id="category-index" href="{{ url('homepage/list') }}" title="分类管理">首页列表</a></li>
                </ul>
            </dd>
        </dl>

        <dl id="menu-jobs">
            <dt><i class="Hui-iconfont">&#xe622;</i> 招聘管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a id="jobs-list" href="{{ url('jobs/list') }}" title="评论列表">职位列表</a></li>
                </ul>
            </dd>
        </dl>

    </div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<script type="text/javascript">
    var route = '{{Request::path()}}';
    var arr = route.split('/');
    $('.menu_dropdown').find('#menu-'+arr[0]+' dt').addClass('selected');
    $('.menu_dropdown').find('#menu-'+arr[0]).find('dd').css('display','block');
    $('.menu_dropdown').find('#menu-'+arr[0]).find('dd ul li#'+arr[0]+'-'+arr[1]).addClass('current');
</script>