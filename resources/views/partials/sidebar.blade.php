<div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading">{{ config('app.name', 'Laravel') }} </div>
    <div class="list-group list-group-flush">
    <a href="#" class="list-group-item list-group-item-action bg-light">@lang('admin.dashboard')</a>
    <a href="/users" class="list-group-item list-group-item-action bg-light">@lang('admin.users')</a>
    
    <a href="{{route('titles.index')}}" class="list-group-item list-group-item-action bg-light">@lang('admin.titles')</a>
    <a href="{{route('persons.index')}}" class="list-group-item list-group-item-action bg-light">@lang('persons.persons')</a>
    <!-- <a href="/seasons" class="list-group-item list-group-item-action bg-light">@lang('admin.seasons')</a>
    <a href="/episodes" class="list-group-item list-group-item-action bg-light">@lang('admin.episodes')</a> -->
    <a href="{{route('characters.index')}}" class="list-group-item list-group-item-action bg-light">@lang('characters.characters')</a>
    <a href="{{route('roles.index')}}" class="list-group-item list-group-item-action bg-light">@lang('roles.roles')</a>
    <!-- <a href="{{route('groups.index')}}" class="list-group-item list-group-item-action bg-light">@lang('groups.group')</a> -->
    <!-- <a href="{{route('casts.index')}}" class="list-group-item list-group-item-action bg-light">@lang('casts.casts')</a> -->
    <a href="/categories" class="list-group-item list-group-item-action bg-light">@lang('admin.categories')</a>
    <a href="/keywords" class="list-group-item list-group-item-action bg-light">@lang('admin.keywords')</a>
    </div>
    
</div>