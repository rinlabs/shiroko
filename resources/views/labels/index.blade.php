@section('title', 'Labels')
<x-app-layout>
    <x-slot name="header">
        {{ __('Labels') }}
    </x-slot>
    <div class="container" id="app">
        <x-card class="border-0 mt-3">
            <a href="{{ route('labels.create') }}" class="btn btn-primary mb-3">Add a label</a>
            <x-response-alerts></x-response-alerts>
            <table class="table table-borderless" id="labels-table">
                <thead class="table-light">
                <tr>
                    <th class="text-nowrap">Name</th>
                    <th class="text-nowrap">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($labels))
                    @foreach($labels as $label)
                        <tr>
                            <td class="text-nowrap">{{ $label->label}}</td>
                            <td class="text-nowrap">
                                <form action="{{ route('labels.destroy', $label->id) }}" method="POST">
                                    <a href="{{ route('labels.show', $label->id) }}"
                                       class="text-body mx-1">
                                        <i class="fas fa-eye" title="view"></i></a>
                                    @csrf
                                    <i class="fas fa-trash text-danger ms-3" @click="confirmDeleteModal"
                                       id="{{$label->id}}" title="{{$label->label}}"></i>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="px-4 py-2 border text-red-500" colspan="3">No labels found.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </x-card>
        <x-details-footer></x-details-footer>
        <x-delete-confirm-modal></x-delete-confirm-modal>
    </div>
    <x-modal-delete-script>
        <x-slot name="uri">labels</x-slot>
    </x-modal-delete-script>
    @section('scripts')
        <script>
            window.addEventListener('load', function () {
                $('#labels-table').DataTable({
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
