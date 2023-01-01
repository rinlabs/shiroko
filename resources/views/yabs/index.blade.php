@section('title', 'YABS results')
<x-app-layout>
    <x-slot name="header">
        {{ __('YABS') }}
    </x-slot>
    <div class="container" id="app">
        <x-delete-confirm-modal></x-delete-confirm-modal>
        <x-card class="border-0 mt-3">
            <a href="{{ route('yabs.compare-choose') }}" class="btn btn-success mb-3">Compare YABS</a>
            <x-response-alerts></x-response-alerts>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                    <tr class="bg-gray-100">
                        <th>Server</th>
                        <th>CPU</th>
                        <th>CPU FREQ</th>
                        <th>RAM</th>
                        <th>Disk</th>
                        <th>GB5 S</th>
                        <th>GB5 M</th>
                        <th>IPv6</th>
                        <th>4k</th>
                        <th>64k</th>
                        <th>512k</th>
                        <th>1m</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($yabs))
                        @foreach($yabs as $yab)
                            <tr>
                                <td><a href="servers/{{$yab->server_id}}"
                                       class="text-decoration-none">{{ $yab->server->hostname }}</a></td>
                                <td><span title="{{$yab->cpu_model}}">{{ $yab->cpu_cores }}</span></td>
                                <td><span title="{{$yab->cpu_model}}">{{ $yab->cpu_freq }}<small>Mhz</small></span></td>
                                <td>{{ $yab->ram }}<small>{{ $yab->ram_type }}</small></td>
                                <td>{{ $yab->disk }}<small>{{ $yab->disk_type }}</small></td>
                                <td><a href="https://browser.geekbench.com/v5/cpu/{{$yab->gb5_id}}"
                                       class="text-decoration-none">{{ $yab->gb5_single }}</a></td>
                                <td><a href="https://browser.geekbench.com/v5/cpu/{{$yab->gb5_id}}"
                                       class="text-decoration-none">{{ $yab->gb5_multi }}</a></td>
                                <td>@if($yab->has_ipv6 === 1)
                                        Yes
                                    @else
                                        No
                                    @endif
                                </td>
                                <td>{{ $yab->disk_speed->d_4k }}<small>{{ $yab->disk_speed->d_4k_type }}</small></td>
                                <td>{{ $yab->disk_speed->d_64k }}<small>{{ $yab->disk_speed->d_64k_type }}</small></td>
                                <td>{{ $yab->disk_speed->d_512k }}<small>{{ $yab->disk_speed->d_512k_type }}</small>
                                </td>
                                <td>{{ $yab->disk_speed->d_1m }}<small>{{ $yab->disk_speed->d_1m_type }}</small></td>
                                <td>{{ date_format(new DateTime($yab->output_date), 'Y-m-d g:i a') }}</small></td>
                                <td class="text-nowrap">
                                    <form action="{{ route('yabs.destroy', $yab->id) }}" method="POST">
                                        <a href="{{ route('yabs.show', $yab->id) }}"
                                           class="text-body mx-1">
                                            <i class="fas fa-eye" title="view"></i>
                                        </a>

                                        <i class="fas fa-trash text-danger ms-3" @click="confirmDeleteModal"
                                           id="{{$yab->id}}" title="{{$yab->server->hostname}}"></i>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="px-4 py-2 border text-red-500" colspan="3">No YABS found.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>

            </div>
        </x-card>
        <x-details-footer></x-details-footer>
    </div>
    <x-modal-delete-script>
        <x-slot name="uri">yabs</x-slot>
    </x-modal-delete-script>
</x-app-layout>
