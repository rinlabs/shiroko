@section("title", "DNS")
@section('style')
    <x-modal-style></x-modal-style>
@endsection
@section('scripts')
    <script src="{{ asset('js/vue.min.js') }}"></script>
@endsection
<x-app-layout>
    <x-slot name="header">
        {{ __('DNS') }}
    </x-slot>
    <div class="container" id="app">
        <x-delete-confirm-modal></x-delete-confirm-modal>
        <x-card class="border-0 mt-3">
            <a href="{{ route('dns.create') }}" class="btn btn-primary mb-3">Add DNS</a>
            <x-response-alerts></x-response-alerts>
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead >
                    <tr>
                        <th class="text-nowrap">Type</th>
                        <th class="text-nowrap">Hostname</th>
                        <th class="text-nowrap">Address</th>
                        <th class="text-nowrap">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($dn[0]))
                        @foreach($dn as $dns)
                            <tr>
                                <td class="text-nowrap">{{ $dns->dns_type}}</td>
                                <td class="text-nowrap">{{ $dns->hostname}}</td>
                                <td class="text-nowrap">{{ $dns->address}}</td>
                                <td class="text-nowrap">
                                    <form action="{{ route('dns.destroy', $dns->id) }}" method="POST">
                                        <a href="{{ route('dns.show', $dns->id) }}"
                                           class="text-body mx-1">
                                            <i class="fas fa-eye" title="view"></i></a>
                                        <a href="{{ route('dns.edit', $dns->id) }}"
                                           class="text-body mx-1">
                                            <i class="fas fa-pen" title="edit"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <i class="fas fa-trash text-danger ms-3" @click="confirmDeleteModal"
                                           id="{{$dns->id}}" title="{{$dns->hostname}}"></i>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="px-4 py-2 text-red" colspan="3">No DNS entries found.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </x-card>
              <x-details-footer></x-details-footer>
    </div>
    <x-modal-delete-script>
        <x-slot name="uri">dns</x-slot>
    </x-modal-delete-script>
</x-app-layout>
