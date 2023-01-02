@section('title', 'Operating systems')
<x-app-layout>
    <x-slot name="header">
        {{ __('Operating systems') }}
    </x-slot>
    <div class="container" id="app">
        <x-card class="border-0 mt-3">
            <a href="{{ route('os.create') }}" class="btn btn-primary mb-3">Add an OS</a>
            <x-response-alerts></x-response-alerts>
            <table class="table table-borderless" id="os-table">
                <thead >
                <tr class="bg-gray-100">
                    <th>Operating system</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($os))
                    @foreach($os as $o)
                        <tr>
                            <td class="text-nowrap">{{ $o->name }}</td>
                            <td class="text-nowrap">
                                <form action="{{ route('locations.destroy', $o->id) }}" method="POST">
                                    <i class="fas fa-trash text-danger ms-3" @click="confirmDeleteModal"
                                       id="{{$o->id}}" title="{{$o->name}}"></i>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="px-4 py-2 text-red" colspan="3">No Operating systems found.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </x-card>
        <x-details-footer></x-details-footer>
        <x-delete-confirm-modal></x-delete-confirm-modal>
    </div>
    <x-modal-delete-script>
        <x-slot name="uri">os</x-slot>
    </x-modal-delete-script>
    @section('scripts')
        <script>
            window.addEventListener('load', function () {
                $('#os-table').DataTable({
                    "pageLength": 15,
                    "lengthMenu": [5, 10, 15, 25, 30, 50, 75, 100],
                    "columnDefs": [
                        {"orderable": false, "targets": 1}
                    ],
                    "initComplete": function () {
                        $('.dataTables_length,.dataTables_filter').addClass('mb-2');
                        $('.dataTables_paginate').addClass('mt-2');
                        $('.dataTables_info').addClass('mt-2 text-muted ');
                    }
                });
            })
        </script>
    @endsection
</x-app-layout>
