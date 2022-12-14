@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 mb-3">
      <div class="card text-center">
        <div class="card-header bg-light font-weight-bold">{{ __('translate.net') }}</div>

        <div class="card-body">
          <h2>
            <strong style="font-size: 46px">{{ number_format((int)$salary->net_salary) }} </strong> {{ __('translate.syrian_pounds') }}
          </h2>
        </div>

        <div class="card-footer text-muted">
          {{ __('translate.updated_at') }} : {{ $salary->created_at->toDateString() }}
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header bg-success text-white font-weight-bold text-center">{{ __('translate.salary_info') }}</div>
        <div class="card-body">
          <table class="table table-hover">
            <tbody>
              <tr>
                <th scope="row">{{ __('translate.emp_id') }} : </th>
                <td>
                  <span class="badge badge-secondary p-1">{{ $salary->job_id }}</span>
                </td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.base_salary') }} : </th>
                <td>{{ number_format((int)$salary->base_salary) }}</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.motivations') }} : </th>
                <td>{{ number_format((int)$salary->motivations) }}</td>
              </tr>
              {{-- <tr>
                <th scope="row">{{ __('translate.living_compensation') }} : </th>
                <td>{{ number_format((int)$salary->base_salary) }}</td>
              </tr> --}}
              <tr>
                <th scope="row">{{ __('translate.additional') }} : </th>
                <td>{{ number_format((int)$salary->additional) }}</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.food_allowance') }} : </th>
                <td>{{ number_format((int)$salary->food_allowance) }}</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.productivity_motivations') }} : </th>
                <td>{{ number_format((int)$salary->productivity_motivations) }}</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.nature_work') }} : </th>
                <td>{{ number_format((int)$salary->nature_work) }}</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.variable_compensation') }} : </th>
                <td>{{ number_format((int)$salary->variable_compensation) }}</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.fixed_compensation') }} : </th>
                <td>{{ number_format((int)$salary->fixed_compensation) }}</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.total_benefit') }} : </th>
                <td>{{ number_format((int)$salary->total_benefit) }}</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.absence') }} : </th>
                <td>{{ number_format((int)$salary->absence) }}</td>
              </tr>
              <tr style="visibility: hidden;">
                <th scope="row">{{ __('translate.absence') }} : </th>
                <td>{{ number_format((int)$salary->base_salary) }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-6 mt-3 mt-md-0">
      <div class="card">
        <div class="card-header bg-danger text-white font-weight-bold  text-center">{{ __('translate.deduction_info') }}</div>

        <div class="card-body">
          <table class="table table-hover">
            <tbody>
              <tr>
                <th scope="row">{{ __('translate.absence_cut') }} : </th>
                <td>{{ number_format((int)$salary->absence_cut) }}</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.without_salary') }} : </th>
                <td>{{ number_format((int)$salary->without_salary) }}</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.without_salary_cut') }} : </th>
                <td>{{ number_format((int)$salary->without_salary_cut) }}</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.late_cut') }} : </th>
                <td>{{ number_format((int)$salary->late_cut) }}</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.mobile_bill') }} : </th>
                <td>{{ number_format((int)$salary->mobile_bill) }}</td>
              </tr>
              <tr  class="text-danger">
                <th scope="row">{{ __('translate.punishments') }} : </th>
                <td>{{ number_format((int)$salary->punishments) }}</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.ordinary_advance') }} : </th>
                <td>{{ number_format((int)$salary->ordinary_advance) }}</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.jop') }} : </th>
                <td>{{ number_format((int)$salary->jop) }}</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.social_insurance') }} : </th>
                <td>{{ number_format((int)$salary->social_insurance) }}</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.income_tax') }} : </th>
                <td>{{ number_format((int)$salary->income_tax)}}</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.cooperat_box') }} : </th>
                <td>{{ number_format((int)$salary->cooperat_box) }}</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.severance_pay') }} : </th>
                <td>{{ number_format((int)$salary->severance_pay) }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
  </div>

  <div class="card mt-4 ">
    <div class="card-header bg-secondary text-white font-weight-bold" style="font-size: 17px">{{ __('translate.other_options') }}</div>

    <div class="card-body">
      <div class="row text-center">
        <div class="col-lg-4">
          <a class="btn btn-primary btn-block mb-1 mb-lg-0">{{ __('translate.back') }}</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
