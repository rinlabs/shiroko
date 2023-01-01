@section("title", "Add an IP address")
<x-app-layout>
    <x-slot name="header">
        {{ __('Insert a new IP') }}
    </x-slot>
    <div class="container">
        <x-card class="border-0 mt-3">
            <h4 class="mb-3">IP information</h4>
            <x-back-button>
                <x-slot name="href">{{ route('IPs.index') }}</x-slot>
                Go back
            </x-back-button>
            <x-response-alerts></x-response-alerts>
            <form action="{{ route('IPs.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-6 mb-4">
                        <x-text-input title="IP address" name="address"></x-text-input>
                    </div>
                    <div class="col-12 col-lg-4 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Type</span></div>
                            <select class="form-control" name="ip_type">
                                <option value="ipv4" selected>IPv4</option>
                                <option value="ipv6">IPv6</option>
                            </select></div>
                    </div>
                </div>
                <div class="row">
                    <p>Attached to:</p>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Service</span></div>
                            <select class="form-control" name="service_id">
                                @foreach ($servers as $server)
                                    <option value="{{ $server['id'] }}">
                                        {{ $server['hostname'] }} (Server)
                                    </option>
                                @endforeach
                                @foreach ($shareds as $shared)
                                    <option value="{{ $shared['id'] }}">
                                        {{ $shared['main_domain'] }} (Shared)
                                    </option>
                                @endforeach
                                @foreach ($resellers as $reseller)
                                    <option value="{{ $reseller['id'] }}">
                                        {{ $reseller['main_domain'] }} (Reseller)
                                    </option>
                                @endforeach
                                @foreach ($seed_boxes as $seed_box)
                                    <option value="{{ $seed_box['id'] }}">
                                        {{ $seed_box['title'] }} (Seed box)
                                    </option>
                                @endforeach
                            </select></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <x-submit-button>Insert IP</x-submit-button>
                    </div>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
