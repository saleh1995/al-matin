@extends('layouts.app')

@section('content')
<div class="container">
  <div class="form-row">
    <div class="col-xl-4 col-l-4 col-md-4 col-sm-12">
        <div class="card text-center mb-3">
            <div class="card-head p-2 badge badge-secondary">{{ __('translate.emp_no') }}</div>
            <div class="card-body h1 font-weight-light">{{ $employeeCount }}<span class="pr-1 h6 font-weight-light">{{ __('translate.employee') }}</span></div>
            <div class="card-footer badge badge-primary p-2">
                <a style="visibility: hidden;">{{ __('translate.emp_no') }}</a>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-l-4 col-md-4 col-sm-12 card-blk">
        <div class="card text-center mb-3">
            <div class="card-head p-2 badge badge-secondary">{{ __('translate.head_no') }}</div>
            <div class="card-body h1 font-weight-light">{{ $headCount }}<span class="pr-1 h6 font-weight-light">{{ __('translate.employee') }}</span></div>
            <div class="card-footer badge badge-primary p-2">
              <a style="visibility: hidden;">{{ __('translate.head_no') }}</a>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-l-4 col-md-4 col-sm-12 card-blk">
        <div class="card text-center mb-3">
            <div class="card-head p-2 badge badge-secondary">{{ __('translate.vacation_today_no') }}</div>
            <div class="card-body h1 font-weight-light">{{ $vacationCount }}<span class="pr-1 h6 font-weight-light">{{ __('translate.vacation_today') }}</span></div>
            <div class="card-footer badge badge-primary p-2">
            <a class="text-white">{{ __('translate.today_date') }} : {{ Carbon\Carbon::today()->toDateString() }}</a>
            <!-- <a>عرض الإجازات في تاريخ محدد</a> -->
            </div>
        </div>
    </div>
  </div>
  <form method="POST" action="{{ route('user.statisticsVacation') }}">
    @csrf
    <div class="form-row pt-3">
        <div class="col-12 text-right badge mb-4" style="white-space: normal;">
          <span class="text-danger ml-1" >{{ __('translate.note') }} :</span>{{ __('translate.note_content') }}
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-2">
            <input class="form-control" type="date" name="start_date" required="required" value="{{ $request->start_date ?? Carbon\Carbon::today()->toDateString() }}">
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-2">
            <input class="form-control" type="date" name="end_date" required="required" value="{{ $request->end_date ?? Carbon\Carbon::today()->toDateString() }}">
        </div>
        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 mb-2">
          <button class="btn btn-primary btn-block" type="submit" name="btndate" value="1">
            {{ __('translate.show') }}
          </button>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 mb-2">
          <button class="btn btn-success btn-block" type="submit" name="btndate" value="2">
            {{ __('translate.convert_to_excel') }}
          </button>
        </div>
    </div>
  </form>
  <div class="row">
    <div class="col-12 mt-3">
      <div class="card text-center">
        <div class="card-head p-2 badge badge-secondary">{{ __('translate.accepted_vacation') }}</div>
        <div class="card-body m-0 p-0 table-responsive">
        <table class="table table-borderless table-hover text-right small font-weight-bold text-center">
          <thead class="head-card">
            <tr>
                <td style="width: 20%;">{{ __('translate.emp_name') }}</td>
                <td style="width: 10%;">{{ __('translate.emp_place_of_job') }}</td>
                <td style="width: 15%;">{{ __('translate.start_date') }}</td>
                <td style="width: 15%;">{{ __('translate.end_date') }}</td>
                <td style="width: 10%;">{{ __('translate.emp_mobile') }}</td>
                <td>{{ __('translate.reasons') }}</td>
            </tr>
          </thead>
          <tbody class="font-weight-normal">
            @if (isset($vacations))
                @foreach ($vacations as $vacation)
                <tr>
                  <td>{{ $vacation->user->name }}</td>
                  <td>{{ $vacation->user->place_of_job }}</td>
                  <td>{{ $vacation->start_date }}</td>
                  <td>{{ $vacation->end_date }}</td>
                  <td>{{ $vacation->user->phone }}</td>
                  <td>{{ $vacation->reasons }}</td>
                </tr>
                @endforeach
            @endif
          </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12 mt-3">
      <div class="card text-center">
        <div class="card-head p-2 badge badge-danger">{{ __('translate.waiting_vacation') }}</div>
        <div class="card-body m-0 p-0 table-responsive">
        <table class="table table-borderless table-hover text-right small font-weight-bold text-center">
          <thead class="head-card">
            <tr>
                <td style="width: 20%;">{{ __('translate.emp_name') }}</td>
                <td style="width: 10%;">{{ __('translate.emp_place_of_job') }}</td>
                <td style="width: 15%;">{{ __('translate.start_date') }}</td>
                <td style="width: 15%;">{{ __('translate.end_date') }}</td>
                <td style="width: 10%;">{{ __('translate.emp_mobile') }}</td>
                <td>{{ __('translate.reasons') }}</td>
            </tr>
          </thead>
          <tbody class="font-weight-normal">
            @foreach ($waitingVacations as $waitingVacation )
              <tr>
                <td>{{ $waitingVacation->user->name }}</td>
                <td>{{ $waitingVacation->user->place_of_job }}</td>
                <td>{{ $waitingVacation->start_date }}</td>
                <td>{{ $waitingVacation->end_date }}</td>
                <td>{{ $waitingVacation->user->phone }}</td>
                <td>{{ $waitingVacation->reasons }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
