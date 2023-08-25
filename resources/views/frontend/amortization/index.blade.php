@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{route('store-loan-amortization-calculator')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Loan Amount</label>
                <input type="number" class="form-control" name="loan_amount">
            </div>
            <div class="mb-3">
                <label class="form-label">Annual Interest</label>
                <input type="number" class="form-control" name="annual_interest_rate">
            </div>
            <div class="mb-3">
                <label class="form-label">Loan Term (In Years)</label>
                <input type="number" class="form-control" name="loan_term">
            </div>
            <button type="submit" class="btn btn-secondary mb-4">Calculate</button>
        </form>
        <table class="table">
            <thead class="table-dark">
            <tr>
                <th scope="col">Month Number</th>
                <th scope="col">Starting Balance</th>
                <th scope="col">Monthly Payment</th>
                <th scope="col">Principal Component</th>
                <th scope="col">Interest Component</th>
                <th scope="col">Ending Balance</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $row)
                <tr>
                    <td>{{$row->month_number}}</td>
                    <td>{{$row->starting_balance}}</td>
                    <td>{{$row->monthly_payment}}</td>
                    <td>{{$row->principal_component}}</td>
                    <td>{{$row->interest_component}}</td>
                    <td>{{$row->ending_balance}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection