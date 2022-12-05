@extends('default')
@push('style')
{{-- for a new css for this specific page --}}
@endpush

@section('pageContent')

<!-- Page Content -->
<div class="page-heading reward-heading header-text">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-content">
                    <h4>claim</h4>
                    <h2>your reward</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Show Type -->
<div id="showReward" name="showReward" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="showRewardLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="showRewardLabel"><b>List Reward yang belum anda gunakan</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="table table-striped border">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Keterangan</th>
                                <th>Isi</th>
                                <th>Harga</th>
                                <th>Tanggal Kadaluarsa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($number = 1)
                            @foreach($list_reward as $row)
                            <tr>
                                <td>{{ $number }}.</td>
                                <td>{{ !empty($row->rewards->desc) ? $row->rewards->desc:"" }}</td>
                                <td>@if($row->rewards->rewardtypes->reward_type == "Voucher")Rp @endif{{ !empty($row->rewards->value) ? $row->rewards->value:"" }}@if($row->rewards->rewardtypes->reward_type == "Diskon") %@endif</td>
                                <td>{{ !empty($row->rewards->prize_point) ? $row->rewards->prize_point:"" }}</td>
                                <td>{{ !empty($row->expired_at) ? date("j F Y", strtotime($row->expired_at)):"" }}</td>
                            </tr>
                            @php($number++)
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="team-members">
    <div class="container">
        <div class="row">
            <h2>Points yang anda miliki : {{ Auth::user()->userstatus->redeemable_points }}</h2>
            <h2>Rewards yang anda miliki :
                <button type="button" data-toggle="modal" data-target="#showReward" id="showReward" name="showReward">
                    <i class="fa fa-gears"></i>
                     List Rewards
                </button>
            </h2>
        </div>
    </div>
</div>
@foreach($tier as $row)
<div class="team-members">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Tier {{ $row->tier_level }} Rewards</h2>
                </div>
            </div>
            @foreach($reward[$row->tier_level] as $row1)
            <div class="col-md-4">
                <div class="team-member">
                    <div class="thumb-container">
                        <img src="{{ asset('images/random/'. $row1->rewardtypes->gambar) }}" alt="">
                        <div class="hover-effect">
                            <div class="hover-content">
                                <ul class="social-icons">
                                    <li><a href="{{ route('rewards.claim', ['user' => Auth::user()->username, 'id_reward' => $row1->id_reward]) }}">Reedem</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="down-content">
                        @if($row1->rewardtypes->reward_type == "Voucher")
                        <h4>Rp {{ number_format($row1->value, '2', ',', '.') }}</h4>
                        @elseif($row1->rewardtypes->reward_type == "Diskon")
                        <h4>{{ $row1->value.'%' }}</h4>
                        @endif
                        <span>{{ $row1->rewardtypes->reward_type }}</span>
                        <p>{{ $row1->desc }}</p>
                        <p>{{ $row1->prize_point }} Points</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endforeach

@endsection

@push('scripts')
{{-- if there is a new scripts for this specific page --}}
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
@if (session('status'))
<script>
    Swal.fire({
        position: 'center',
        icon: '{{ session("status") }}',
        title: '{{ session("msg") }}',
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endif

@endpush
