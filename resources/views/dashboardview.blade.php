@extends('layouts.layout')

@section('one_page_css')
    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet">
@endsection
@section('one_page_js')
    <!-- ChartJS -->
    <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>@lang('Dashboard')</h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">@lang('Dashboard')</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="row">
        <div class="col-md-3 col-sm-6 col-12 rounded-2xl">
            <div class="info-box bg-gradient-to-br from-amber-100/50 to-purple-300/20 hover:scale-105 cursor-pointer transition-all duration-300 rounded-2xl">
                <span class="info-box-icon shrink-0 rounded-2xl bg-info"><i class="fas fa-bezier-curve"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text line-clamp-2 truncate max-w-full text-sm font-medium text-gray-500">@lang('Department')</span>
                    <span class="info-box-number text-lg mt-1">{{ $dashboardCounts['departments'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12 rounded-2xl">
            <div class="info-box bg-gradient-to-br from-amber-100/50 to-purple-300/20 hover:scale-105 cursor-pointer transition-all duration-300 rounded-2xl">
                <span class="info-box-icon shrink-0 rounded-2xl bg-success"><i class="fas fa-user-md"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text line-clamp-2 truncate max-w-full text-sm font-medium text-gray-500">@lang('Doctor')</span>
                    <span class="info-box-number text-lg mt-1">{{ $dashboardCounts['doctors'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12 rounded-2xl">
            <div class="info-box bg-gradient-to-br from-amber-100/50 to-purple-300/20 hover:scale-105 cursor-pointer transition-all duration-300 rounded-2xl">
                <span class="info-box-icon shrink-0 rounded-2xl bg-warning !text-white"><i class="fas fa-user-injured"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text line-clamp-2 truncate max-w-full text-sm font-medium text-gray-500">@lang('Patient')</span>
                    <span class="info-box-number text-lg mt-1">{{ $dashboardCounts['patients'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12 rounded-2xl">
            <div class="info-box bg-gradient-to-br from-amber-100/50 to-purple-300/20 hover:scale-105 cursor-pointer transition-all duration-300 rounded-2xl">
                <span class="info-box-icon shrink-0 rounded-2xl bg-danger shrink-0"><i class="fas fa-calendar-check"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text line-clamp-2 truncate max-w-full text-sm font-medium text-gray-500">@lang('Patient Appointment')</span>
                    <span class="info-box-number text-lg mt-1">{{ $dashboardCounts['appointments'] }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-sm-6 col-12 rounded-2xl">
            <div class="info-box bg-gradient-to-br from-amber-100/50 to-purple-300/20 hover:scale-105 cursor-pointer transition-all duration-300 rounded-2xl">
                <span class="info-box-icon shrink-0 rounded-2xl bg-success"><i class="fas fa-file-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text line-clamp-2 truncate max-w-full text-sm font-medium text-gray-500">@lang('Patient Case Studies')</span>
                    <span class="info-box-number text-lg mt-1">{{ $dashboardCounts['caseStudies'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12 rounded-2xl">
            <div class="info-box bg-gradient-to-br from-amber-100/50 to-purple-300/20 hover:scale-105 cursor-pointer transition-all duration-300 rounded-2xl">
                <span class="info-box-icon shrink-0 rounded-2xl bg-info"><i class="fas fa-pills"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text line-clamp-2 truncate max-w-full text-sm font-medium text-gray-500">@lang('Prescription')</span>
                    <span class="info-box-number text-lg mt-1">{{ $dashboardCounts['prescriptions'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12 rounded-2xl">
            <div class="info-box bg-gradient-to-br from-amber-100/50 to-purple-300/20 hover:scale-105 cursor-pointer transition-all duration-300 rounded-2xl">
                <span class="info-box-icon shrink-0 rounded-2xl bg-danger"><i class="fas fa-file-invoice-dollar"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text line-clamp-2 truncate max-w-full text-sm font-medium text-gray-500">@lang('Invoice')</span>
                    <span class="info-box-number text-lg mt-1">{{ $dashboardCounts['invoices'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12 rounded-2xl">
            <div class="info-box bg-gradient-to-br from-amber-100/50 to-purple-300/20 hover:scale-105 cursor-pointer transition-all duration-300 rounded-2xl">
                <span class="info-box-icon shrink-0 rounded-2xl bg-warning !text-white"><i class="fas fa-money-check"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text line-clamp-2 truncate max-w-full text-sm font-medium text-gray-500">@lang('Payment')</span>
                    <span class="info-box-number text-lg mt-1">{{ $dashboardCounts['payments'] }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- BAR CHART -->
            <div class="card card-info  rounded-2xl overflow-hidden">
                <div class="card-header">
                    <h3 class="card-title custom-color-white">@lang('Monthly Debit/Credit')</h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="barChart" class="custom-dashbord-mix"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <!-- BAR CHART -->
            <div class="card card-info  rounded-2xl overflow-hidden">
                <div class="card-header">
                    <h3 class="card-title custom-color-white">{{ date('Y') }} @lang('Debit/Credit') </h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="donutChart1" class="custom-dashbord-mix"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <!-- BAR CHART -->
            <div class="card card-info  rounded-2xl overflow-hidden">
                <div class="card-header">
                    <h3 class="card-title custom-color-white">@lang('Overall Debit/Credit')</h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="donutChart2" class="custom-dashbord-mix"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('footer')
    <script src="{{ asset('assets/js/custom/dashboard/view.js') }}"></script>
@endpush
