<nav aria-label="breadcrumb">
    <ol class="breadcrumb custom-breadcrumb">
        @foreach($items as $item)
            <li class="breadcrumb-item {{ Request::url() == url($item['url']) ? 'active' : '' }}">
                <a href="{{ $item['url'] }}" class="{{ Request::url() == url($item['url']) ? 'text-primary font-weight-bold' : 'text-secondary' }}">
                    {{ $item['label'] }}
                </a>
            </li>
        @endforeach
    </ol>
</nav>