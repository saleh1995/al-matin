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
              <tr>
                <th scope="row">{{ __('translate.emp_id') }} : </th>
                <td>1</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.evaluation_score') }} : </th>
                <td>2</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.evaluation_manager_score') }} : </th>
                <td>3</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.evaluation_hr_score') }} : </th>
                <td>4</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.pros') }} : </th>
                <td>1</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.cons') }} : </th>
                <td>2</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.manager_recommendations') }} : </th>
                <td>3</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.hr_recommendations') }} : </th>
                <td>4</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="card mt-2">
        <div class="card-header bg-success text-white font-weight-bold" style="font-size: 17px">{{ __('translate.insurance_info') }}</div>

        <div class="card-body">
            <table class="table table-condensed table-hover">
                <tbody>
                  <tr>
                    <th scope="row">{{ __('translate.social_insurance_registration') }} : </th>
                    <td>1</td>
                  </tr>
                  <tr>
                    <th scope="row">{{ __('translate.social_insurance_salary') }} : </th>
                    <td>2</td>
                  </tr>
                  <tr>
                    <th scope="row">{{ __('translate.social_insurance_registration_date') }} : </th>
                    <td>3</td>
                  </tr>
                  <tr>
                    <th scope="row">{{ __('translate.remaining_advance_amount') }} : </th>
                    <td>3</td>
                  </tr>
                </tbody>
            </table>
        </div>
      </div>

      <div class="card mt-2">
        <div class="card-header bg-danger text-white font-weight-bold" style="font-size: 17px">{{ __('translate.punishment_info') }}</div>

        <div class="card-body">
            <table class="table table-condensed table-hover">
                <tbody>
                  <tr>
                    <th scope="row">{{ __('translate.punishment_cause') }} : </th>
                    <td>1</td>
                  </tr>
                  <tr>
                    <th scope="row">{{ __('translate.punishment_ammount') }} : </th>
                    <td>2</td>
                  </tr>
                  <tr>
                    <th scope="row">{{ __('translate.punishment_date') }} : </th>
                    <td>3</td>
                  </tr>
                </tbody>
            </table>
        </div>
      </div>

      <div class="card mt-2">
        <div class="card-header bg-warning text-dark font-weight-bold" style="font-size: 17px">{{ __('translate.missing_papers') }}</div>

        <div class="card-body">
          <table class="table table-condensed table-hover">
            <tbody>
              <tr>
                <th scope="row">{{ __('translate.papers_id_photo') }} : </th>
                <td>1</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.papers_residence_document') }} : </th>
                <td>2</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.papers_no_conviction') }} : </th>
                <td>3</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.papers_personal_photos') }} : </th>
                <td>4</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.papers_certificate_copy') }} : </th>
                <td>1</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.papers_medical_report') }} : </th>
                <td>2</td>
              </tr>
              <tr>
                <th scope="row">{{ __('translate.papers_military_notebook') }} : </th>
                <td>3</td>
              </tr>
            </tbody>
          </table>
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
  </div>
</div>
@endsection