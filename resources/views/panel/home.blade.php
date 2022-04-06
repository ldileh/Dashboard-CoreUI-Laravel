@extends('layouts.app')

@section('title', 'Beranda')


@section('extra-js')
<script src="{{ asset('js/Chart.min.js') }}"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Dashboard</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                You are logged in!
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Member Count</div>

            <div class="card-body">
                <canvas id="member-count" width="100"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('member-count').getContext('2d');

    axios.get("{{ route('chart.member') }}")
        .then(function (response) {
            const data = response.data.data;

            if(data != null){
                const itemLabels = getLabels(data);
                const itemValues = getValues(data);

                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: itemLabels,
                        datasets: [{
                            label: 'Members',
                            data: itemValues,
                            backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            ],
                            hoverOffset: 4
                        }]
                    },
                });
            }
        })
        .catch(function (error) { });

    function getLabels(data) {
        let result = [];
        data.forEach(item => {
            result.push(item.name);
        });
        return result;
    }

    function getValues(data) {
        let result = [];
        data.forEach(item => {
            result.push(item.number_member);
        });
        return result;
    }
</script>
@endpush
