@extends('panel.master')

@section('title')
Dashboard
@endsection

@section('content')
<div class="dd-content">

    @include('panel.partials.header')

    <section class="container-fluid">
      <div class="card">
        <div class="card-header mb-4">
          <h5 class="card-title">Employee List</h5>
          <select class="form-select" aria-label="Default select example">
            <option selected>Open this select</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </div>
        <div class="table-responsive">
          <table class="table table-hover table-">
            <thead>
              <tr>
                <th scope="col" style="width: 435px; min-width: 335px">
                  Task Name
                </th>
                <th scope="col">Task Type</th>
                <th scope="col">Date</th>
                <th scope="col">Priority</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  Lorem ipsum dolor lorem ipsum adit saja makan ikan sit
                  amet adispicing adispicing foler sudah makan belum
                </td>
                <td>Payroll</td>
                <td>22nd June, 2023</td>
                <td>
                  <p class="fw-bold text-danger">High</p>
                </td>
              </tr>
              <tr>
                <td>
                  Lorem ipsum dolor lorem ipsum adit saja makan ikan sit
                  amet adispicing adispicing foler sudah makan belum
                </td>
                <td>Payroll</td>
                <td>22nd June, 2023</td>
                <td>
                  <p class="fw-bold text-primary">Low</p>
                </td>
              </tr>
              <tr>
                <td>
                  Lorem ipsum dolor lorem ipsum adit saja makan ikan sit
                  amet adispicing adispicing foler sudah makan belum
                </td>
                <td>Payroll</td>
                <td>22nd June, 2023</td>
                <td>
                  <p class="fw-bold text-danger">High</p>
                </td>
              </tr>
              <tr>
                <td>
                  Lorem ipsum dolor lorem ipsum adit saja makan ikan sit
                  amet adispicing adispicing foler sudah makan belum
                </td>
                <td>Payroll</td>
                <td>22nd June, 2023</td>
                <td>
                  <p class="fw-bold text-success">Medium</p>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>
   </div>
@endsection
