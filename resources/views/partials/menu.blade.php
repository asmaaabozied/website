

<a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
</a>
<nav id="sidebar" class="sidebar-wrapper" style="z-index: 100000;">
    <div class="sidebar-content">
        <div class="sidebar-brand">
            <a href="{{url('/')}}">{{ trans('panel.site_title') }}</a>
            {{--<div id="close-sidebar">--}}
            {{--<i class="fas fa-times"></i>--}}
            {{--</div>--}}
        </div>
        <div class="sidebar-header">
            <div class="user-pic">
                <img class="img-responsive img-rounded" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg"
                     alt="User picture">
            </div>
            <div class="user-info">
                  <span class="user-name">
                    <strong>{{auth()->user()->name}}</strong>
                  </span>
                <span class="user-status">
                    <i class="fa fa-circle"></i>
                    <span>Online</span>
                </span>
            </div>
        </div>
        <!-- sidebar-header  -->

        <!-- sidebar-search  -->
        <div class="sidebar-menu">
            <ul>
                <li class="header-menu">
                    <span>General</span>
                </li>
                <li class="{{ request()->is('admin') ? 'li_active':'' }}">
                    <a href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>{{ trans('global.dashboard') }}</span>
                    </a>
                </li>
                <?php
                $userManagement = request()->is('admin/permissions')||request()->is('admin/permissions/*')
                || request()->is('admin/roles')|| request()->is('admin/roles/*')
                || request()->is('admin/users')|| request()->is('admin/users/*')
                || request()->is('admin/audit-logs')|| request()->is('admin/audit-logs/*')
                    ? 'active' : '';
                ?>
                <li class="sidebar-dropdown {{ $userManagement == 'active' ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa-fw fas fa-users"></i>
                        <span>{{ trans('cruds.userManagement.title') }}</span>
                    </a>
                    <div style="display: {{ $userManagement == 'active' ? 'block' : '' }}" class="sidebar-submenu">
                        <ul>
                            @can('permission_access')
                                <li class="{{ request()->is('admin/permissions')||request()->is('admin/permissions/*') == 'active' ? 'li_active':'' }}">
                                    <a href="{{ route("admin.permissions.index") }}">
                                        {{ trans('cruds.permission.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="{{ request()->is('admin/roles')|| request()->is('admin/roles/*') == 'active' ? 'li_active':'' }}">
                                    <a href="{{ route("admin.roles.index") }}">
                                        {{ trans('cruds.role.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="{{ request()->is('admin/users')|| request()->is('admin/users/*') == 'active' ? 'li_active':'' }}">
                                    <a href="{{ route("admin.users.index") }}">
                                        {{ trans('cruds.user.title') }}
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </div>
                </li>

                <?php
                $message = request()->is('admin/notifications') || request()->is('admin/notifications/*')
                || request()->is('admin/advertising-spaces') || request()->is('admin/advertising-spaces/*')
                || request()->is('admin/contact-us-messages') || request()->is('admin/contact-us-messages/*')
                || request()->is('admin/audit-logs')|| request()->is('admin/audit-logs/*')
                    ? 'active' : '';
                ?>
                <li class="sidebar-dropdown {{ $message == 'active' ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa-fw fas fa-envelope"></i>
                        <span>{{ trans('cruds.message.title') }}</span>
                    </a>
                    <div style="display: {{ $message == 'active' ? 'block' : '' }}" class="sidebar-submenu">
                        <ul>
                            @can('contact_us_message_access')
                                <li class="{{ request()->is('admin/contact-us-messages') || request()->is('admin/contact-us-messages/*') == 'active' ? 'li_active':'' }}">
                                    <a href="{{ route("admin.contact-us-messages.index") }}">
                                        {{ trans('cruds.contactUsMessage.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('message_access')
                                <li class="{{ request()->is('admin/notifications') || request()->is('admin/notifications/*') == 'active' ? 'li_active':'' }}">
                                    <a href="{{ route("admin.notifications.create") }}">
                                        {{ trans('cruds.notification.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('advertising_space_access')
                                <li class="{{ request()->is('admin/advertising-spaces') || request()->is('admin/advertising-spaces/*') == 'active' ? 'li_active':'' }}">
                                    <a href="{{ route("admin.advertising-spaces.index") }}">
                                        {{ trans('cruds.advertisingSpace.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>

                @can('category_access')

                    <li class="{{ request()->is('admin/categories') || request()->is('admin/categories/*') ? 'li_active':'' }}">
                        <a href="{{ route("admin.categories.index") }}">
                            <i class="fas fa-fw fa-balance-scale"></i>
                            <span>{{ trans('cruds.category.title') }}</span>
                        </a>
                    </li>

                @endcan
                <?php
                $imagesManagement = request()->is('admin/images') || request()->is('admin/images/*')
                || request()->is('admin/image/comments') || request()->is('admin/image/comments/*')
                || request()->is('admin/image/likes') || request()->is('admin/image/likes/*')
                || request()->is('admin/image/favorites') || request()->is('admin/image/favorites/*')
                || request()->is('admin/image/dislikes') || request()->is('admin/image/dislikes/*')
                    ? 'active' : '';
                ?>
                @can('images_management_access')
                    <li class="sidebar-dropdown {{ $imagesManagement == 'active' ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa-fw fas fa-images"></i>
                        <span>{{ trans('cruds.image.title') }}</span>
                    </a>
                    <div style="display: {{ $imagesManagement == 'active' ? 'block' : '' }}" class="sidebar-submenu">
                        <ul>
                            @can('message_access')
                                <li class="{{ request()->is('admin/images') || request()->is('admin/images/*') == 'active' ? 'li_active':'' }}">
                                    <a href="{{ route("admin.images.index") }}">
                                        {{ trans('cruds.image.title') }}
                                    </a>
                                </li>
                            @endcan

                                <li class="{{ request()->is('admin/image/comments') || request()->is('admin/image/comments/*') == 'active' ? 'li_active':'' }}">
                                    <a href="{{ url("admin/image/comments") }}">
                                        تعليقات الصور
                                    </a>
                                </li>

                                <li class="{{ request()->is('admin/image/likes') || request()->is('admin/image/likes/*') == 'active' ? 'li_active':'' }}">
                                    <a href="{{ url("admin/image/likes") }}">
                                        اعجابات الصور
                                    </a>
                                </li>
                                <li class="{{ request()->is('admin/image/favorites') || request()->is('admin/image/favorites/*') == 'active' ? 'li_active':'' }}">
                                    <a href="{{ url("admin/image/favorites") }}">
                                        مفضلات الصور
                                    </a>
                                </li>
                                <li class="{{ request()->is('admin/image/dislikes') || request()->is('admin/image/dislikes/*') == 'active' ? 'li_active':'' }}">
                                    <a href="{{ url("admin/image/dislikes") }}">
                                        عدم اعجابات الصور
                                    </a>
                                </li>


                        </ul>
                    </div>
                </li>
                @endcan

                <?php
                $sound_access = request()->is('admin/sounds') || request()->is('admin/sounds/*')
                || request()->is('admin/sound/comments') || request()->is('admin/sound/sound/*')
                || request()->is('admin/sound/likes') || request()->is('admin/sound/likes/*')
                || request()->is('admin/sound/favorites') || request()->is('admin/sound/favorites/*')
                || request()->is('admin/sound/dislikes') || request()->is('admin/sound/dislikes/*')
                    ? 'active' : '';
                ?>
                @can('sound_access')
                    <li class="sidebar-dropdown {{ $sound_access == 'active' ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa-fw fas fa-volume-up"></i>
                            <span>{{ trans('cruds.sound.title') }}</span>
                        </a>
                        <div style="display: {{ $sound_access == 'active' ? 'block' : '' }}" class="sidebar-submenu">
                            <ul>
                                @can('sound_access')
                                    <li class="{{ request()->is('admin/sounds') || request()->is('admin/sounds/*') == 'active' ? 'li_active':'' }}">
                                        <a href="{{ route("admin.sounds.index") }}">
                                            {{ trans('cruds.sound.title') }}
                                        </a>
                                    </li>
                                @endcan

                                <li class="{{ request()->is('admin/sound/comments') || request()->is('admin/sound/comments/*') == 'active' ? 'li_active':'' }}">
                                    <a href="{{ url("admin/sound/comments") }}">
                                        تعليقات الصوت
                                    </a>
                                </li>

                                <li class="{{ request()->is('admin/sound/likes') || request()->is('admin/sound/likes/*') == 'active' ? 'li_active':'' }}">
                                    <a href="{{ url("admin/sound/likes") }}">
                                        اعجابات الصوت
                                    </a>
                                </li>
                                <li class="{{ request()->is('admin/sound/favorites') || request()->is('admin/sound/favorites/*') == 'active' ? 'li_active':'' }}">
                                    <a href="{{ url("admin/sound/favorites") }}">
                                        مفضلات الصوت
                                    </a>
                                </li>
                                <li class="{{ request()->is('admin/sound/dislikes') || request()->is('admin/sound/dislikes/*') == 'active' ? 'li_active':'' }}">
                                    <a href="{{ url("admin/sound/dislikes") }}">
                                        عدم اعجابات الصوت
                                    </a>
                                </li>


                            </ul>
                        </div>
                    </li>
                @endcan

                <?php
                $video = request()->is('admin/videos') || request()->is('admin/videos/*')
                || request()->is('admin/video/comments') || request()->is('admin/video/comments/*')
                || request()->is('admin/video/likes') || request()->is('admin/video/likes/*')
                || request()->is('admin/video/favorites') || request()->is('admin/video/favorites/*')
                || request()->is('admin/video/dislikes') || request()->is('admin/video/dislikes/*')
                    ? 'active' : '';
                ?>
                @can('video_access')
                    <li class="sidebar-dropdown {{ $video == 'active' ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa-fw fas fa-video"></i>
                            <span>{{ trans('cruds.video.title') }}</span>
                        </a>
                        <div style="display: {{ $video == 'active' ? 'block' : '' }}" class="sidebar-submenu">
                            <ul>
                                @can('video_access')
                                    <li class="{{ request()->is('admin/videos') || request()->is('admin/videos/*') == 'active' ? 'li_active':'' }}">
                                        <a href="{{ route("admin.videos.index") }}">
                                            {{ trans('cruds.video.title') }}
                                        </a>
                                    </li>
                                @endcan

                                <li class="{{ request()->is('admin/video/comments') || request()->is('admin/video/comments/*') == 'active' ? 'li_active':'' }}">
                                    <a href="{{ url("admin/video/comments") }}">
                                        تعليقات الفيديو
                                    </a>
                                </li>

                                <li class="{{ request()->is('admin/video/likes') || request()->is('admin/video/likes/*') == 'active' ? 'li_active':'' }}">
                                    <a href="{{ url("admin/video/likes") }}">
                                        اعجابات الفيديو
                                    </a>
                                </li>
                                <li class="{{ request()->is('admin/video/favorites') || request()->is('admin/video/favorites/*') == 'active' ? 'li_active':'' }}">
                                    <a href="{{ url("admin/video/favorites") }}">
                                        مفضلات الفيديو
                                    </a>
                                </li>
                                <li class="{{ request()->is('admin/video/dislikes') || request()->is('admin/video/dislikes/*') == 'active' ? 'li_active':'' }}">
                                    <a href="{{ url("admin/video/dislikes") }}">
                                        عدم اعجابات الفيديو
                                    </a>
                                </li>


                            </ul>
                        </div>
                    </li>
                @endcan

                @can('radio_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.radios.index") }}" class="nav-link {{ request()->is('admin/radios') || request()->is('admin/radios/*') ? 'li_active' : '' }}">
                            <i class="fa-fw fas fa-broadcast-tower nav-icon">

                            </i>
                            {{ trans('cruds.radio.title') }}
                        </a>
                    </li>
                @endcan
                @can('radio_access')
                    <li class="{{ request()->is('admin/settings') || request()->is('admin/settings/*') ? 'li_active':'' }}">
                        <a href="{{ route("admin.settings.index") }}">
                            <i class="fas fa-fw fa-cogs"></i>
                            <span>{{ trans('cruds.setting.title') }}</span>
                        </a>
                    </li>
                @endcan
                @can('setting_access')
                    <li class="{{ request()->is('admin/settings') || request()->is('admin/settings/*') ? 'li_active':'' }}">
                        <a href="{{ route("admin.settings.index") }}">
                            <i class="fas fa-fw fa-cogs"></i>
                            <span>{{ trans('cruds.setting.title') }}</span>
                        </a>
                    </li>
                @endcan

                    <li class="{{ request()->is('admin/adminmenus') || request()->is('admin/adminmenus/*') ? 'li_active':'' }}">
                        <a href="{{ route("admin.adminmenus.index") }}">
                            <i class="fas fa-fw fa-bars"></i>
                            <span>{{ trans('cruds.adminmenu.title') }}</span>
                        </a>
                    </li>


            </ul>
        </div>
        <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
</nav>