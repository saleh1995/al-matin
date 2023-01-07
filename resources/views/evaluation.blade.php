@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header bg-info text-white font-weight-bold" style="font-size: 17px">{{ __('translate.evaluation_info') }}</div>

        <div class="card-body">
          <table class="table table-condensed table-hover text-right">
            <tbody>
              @if ($evaluation == null)
              <tr>{{ __('translate.no_evaluation_info') }}</tr>
              @else
              <tr>
                <th scope="row">{{ __('translate.emp_id') }}: </th>
                <td>{{ $evaluation->job_id }}</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.evaluation_score') }}: </th>
                <td>{{ $evaluation->latest_evaluation }}</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.evaluation_manager_score') }}: </th>
                <td>{{ $evaluation->manager_evaluation }}</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.evaluation_hr_score') }}: </th>
                <td>{{ $evaluation->hr_evaluation }}</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.pros') }}: </th>
                <td>{{ $evaluation->pros }}</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.cons') }}: </th>
                <td>{{ $evaluation->cons }}</td>
              </tr>
              {{-- <tr>
                <th scope="row">{{ __('translate.manager_recommendations') }}: </th>
                <td>{{ $evaluation->manager_recommendations }}</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.hr_recommendations') }}: </th>
                <td>{{ $evaluation->hr_recommendations }}</td>
              </tr> --}}
              @endif
              
            </tbody>
          </table>
        </div>
      </div>

      <div class="card mt-2">
        <div class="card-header bg-success text-white font-weight-bold" style="font-size: 17px">{{ __('translate.insurance_info') }}</div>

        <div class="card-body">
            <table class="table table-condensed table-hover">
                <tbody>
                  @if ($insurance == null)
                  <tr>{{ __('translate.no_insurance_info') }}</tr>
                  @else
                  <tr>
                    <th scope="row">{{ __('translate.social_insurance_registration') }}: </th>
                    <td>
                      <i class="fas {{ $insurance->social_insurance == 1 ? 'fa-check text-success': 'fa-times text-danger' }} "></i>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">{{ __('translate.social_insurance_salary') }}: </th>
                    <td>{{ $insurance->insurance_salary }}</td>
                  </tr>
                  <tr>
                    <th scope="row">{{ __('translate.social_insurance_registration_date') }}: </th>
                    <td>{{ $insurance->date_registration }}</td>
                  </tr>
                  <tr>
                    <th scope="row">{{ __('translate.social_insurance_number') }}: </th>
                    <td>{{ $insurance->social_insurance_number }}</td>
                  </tr>
                  @endif
                </tbody>
            </table>
        </div>
      </div>

      <div class="card mt-2">
        <div class="card-header bg-danger text-white font-weight-bold" style="font-size: 17px">{{ __('translate.punishment_info') }}</div>

        <div class="card-body">
            <table class="table table-condensed table-hover">
                <tbody>
                  @if ($penalty == null)
                  <tr>{{ __('translate.no_penalty_info') }}</tr>
                  @else
                  <tr>
                    <th scope="row">{{ __('translate.punishment_cause') }}: </th>
                    <td>{{ $penalty->penalties }}</td>
                  </tr>
                  <tr>
                    <th scope="row">{{ __('translate.punishment_ammount') }}: </th>
                    <td>{{ $penalty->final_ammount }}</td>
                  </tr>
                  <tr>
                    <th scope="row">{{ __('translate.punishment_date') }}: </th>
                    <td>{{ $penalty->penalties_date }}</td>
                  </tr>
                  @endif
                </tbody>
            </table>
        </div>
      </div>

      <div class="card mt-2">
        <div class="card-header bg-warning text-dark font-weight-bold" style="font-size: 17px">{{ __('translate.missing_papers') }}</div>

        <div class="card-body">
          <table class="table table-condensed table-hover">
            <tbody>
              @if ($followUp == null)
              <tr>{{ __('translate.no_followUp_info') }}</tr>
              @else
              <tr>
                <th scope="row">{{ __('translate.papers_id_photo') }}: </th>
                <td>
                  <i class="fas {{ $followUp->id_photo == 1 ? 'fa-check text-success': 'fa-times text-danger' }} "></i>
                </td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.papers_residence_document') }}: </th>
                <td>
                  <i class="fas {{ $followUp->residence_document == 1 ? 'fa-check text-success': 'fa-times text-danger' }} "></i>
                </td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.papers_no_conviction') }}: </th>
                <td>
                  <i class="fas {{ $followUp->no_conviction == 1 ? 'fa-check text-success': 'fa-times text-danger' }} "></i>
                </td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.papers_individual_civil_record') }}: </th>
                <td>
                  <i class="fas {{ $followUp->individual_civil_record == 1 ? 'fa-check text-success': 'fa-times text-danger' }} "></i>
                </td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.papers_personal_photos') }}: </th>
                <td>
                  <i class="fas {{ $followUp->personal_photos == 1 ? 'fa-check text-success': 'fa-times text-danger' }} "></i>
                </td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.papers_certificate_copy') }}: </th>
                <td>
                  <i class="fas {{ $followUp->certificate_copy == 1 ? 'fa-check text-success': 'fa-times text-danger' }} "></i>
                </td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.papers_medical_report') }}: </th>
                <td>
                  <i class="fas {{ $followUp->medical_report == 1 ? 'fa-check text-success': 'fa-times text-danger' }} "></i>
                </td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.papers_military_notebook') }}: </th>
                <td>
                  <i class="fas {{ $followUp->military_notebook == 1 ? 'fa-check text-success': 'fa-times text-danger' }} "></i>
                </td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>

      <div class="card mt-4 ">
        <div class="card-header bg-secondary text-white font-weight-bold" style="font-size: 17px">{{ __('translate.other_options') }}</div>
    
        <div class="card-body">
          <div class="row text-center">
            <div class="col-lg-4">
              <a class="btn btn-primary btn-block mb-1 mb-lg-0" href="{{ url('/') }}">{{ __('translate.back') }}</a>
            </div>
          </div>
        </div>
      </div>
        
    </div>
  </div>
</div>
@endsection