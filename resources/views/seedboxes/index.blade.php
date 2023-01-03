@section('title', 'Seedboxes')
<x-app-layout>
    <x-slot name="header">
        {{ __('Seedboxes') }}
    </x-slot>
    <div class="container" id="app">
        <div class="card border-0 mt-3">
            <div class="card-body">
                <a href="{{ route('seedboxes.create') }}" class="btn btn-primary mb-3">Add a seedbox</a>
                <x-response-alerts></x-response-alerts>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead >
                        <tr class="bg-gray-100">
                            <th>Title</th>
                            <th>Type</th>
                            <th>Location</th>
                            <th>Provider</th>
                            <th>Disk</th>
                            <th>BWidth</th>
                            <th>Port</th>
                            <th>Price</th>
                            <th>Due</th>
                            <th>Had since</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($seedboxes[0]))
                            @foreach($seedboxes as $row)
                                <tr>
                                    <td>{{ $row->title }}</td>
                                    <td>{{ $row->seed_box_type }}</td>
                                    <td class="text-nowrap">{{ $row->location->name }}</td>
                                    <td class="text-nowrap">{{ $row->provider->name }}</td>
                                    <td>
                                        @if($row->disk_as_gb >= 1000)
                                            {{ number_format($row->disk_as_gb / 1000,1) }} <small>TB</small>
                                        @else
                                            {{ $row->disk_as_gb }} <small>GB</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($row->bandwidth >= 1000)
                                            {{ number_format($row->bandwidth / 1000,1) }} <small>TB</small>
                                        @else
                                            {{ $row->bandwidth }} <small>GB</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($row->port_speed >= 1000)
                                            {{ number_format($row->port_speed / 1000,1) }} <small>Gbps</small>
                                        @else
                                            {{ $row->port_speed }} <small>Mbps</small>
                                        @endif
                                    </td>
                                    <td>{{ $row->price->price }} {{$row->price->currency}} {{\App\Process::paymentTermIntToString($row->price->term)}}</td>
                                    <td>{{Carbon\Carbon::parse($row->price->next_due_date)->diffForHumans()}}</td>
                                    <td class="text-nowrap">{{ $row->owned_since }}</td>
                                    <td class="text-nowrap">
                                        <form action="{{ route('seedboxes.destroy', $row->id) }}" method="POST">
                                            @csrf
                                            <a href="{{ route('seedboxes.show', $row->id) }}"
                                               class="text-body mx-1">
                                                <i class="fas fa-eye" title="view"></i>
                                            </a>
                                            <a href="{{ route('seedboxes.edit', $row->id) }}"
                                               class="text-body mx-1">
                                                <i class="fas fa-pen" title="edit"></i>
                                            </a>
                                            <i class="fas fa-trash text-danger ms-3" @click="confirmDeleteModal"
                                               id="{{$row->id}}" title="{{$row->title}}"></i>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="px-4 py-2 text-red" colspan="3">No seedboxes found.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <x-details-footer></x-details-footer>
        <x-delete-confirm-modal></x-delete-confirm-modal>
    </div>
    <x-modal-delete-script>
        <x-slot name="uri">seedboxes</x-slot>
    </x-modal-delete-script>
</x-app-layout>
