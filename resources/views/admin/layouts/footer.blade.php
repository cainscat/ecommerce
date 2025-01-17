
<footer class="app-footer">
    <div class="float-end d-none d-sm-inline">All rights reserved.</div>
    @php
        $getSettingFooter = App\Models\SystemSettingModel::getSingle();
    @endphp
    <strong>
        {{ date('Y') }}&nbsp; {{ $getSettingFooter->website_name }}.com
    </strong>
    {{-- Copyright &copy;  --}}
</footer>

