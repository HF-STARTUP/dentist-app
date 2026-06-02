<?php

namespace App\Http\Controllers;

use App\Models\HospitalDepartment;
use App\Models\Invoice;
use App\Models\PatientAppointment;
use App\Models\PatientCaseStudy;
use App\Models\Payment;
use App\Models\Prescription;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * Class DashboardController
 *
 * @package App\Http\Controllers
 * @category Controller
 */
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @access public
     * @return mixed
     */
    public function index()
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return $this->adminDashboard();
        } elseif(auth()->user()->hasRole('Doctor')) {
            $doctorId = auth()->user()->id;
            $patientAppointment = PatientAppointment::with('user')->where('doctor_id', $doctorId)->where('company_id', session('company_id'))->get();
            return view('dashboards.common-dashboard', compact('patientAppointment'));
        } elseif(auth()->user()->hasRole('Patient')) {
            $patientId = auth()->user()->id;
            $appointments = PatientAppointment::with('user')->where('user_id', $patientId)->where('company_id', session('company_id'))->get();
            return view('dashboards.common-dashboard', compact('appointments'));
        } elseif(auth()->user()->hasRole('Receptionist')) {
            $receptionistAppointments = PatientAppointment::with('user')->where('company_id', session('company_id'))->get();
            return view('dashboards.common-dashboard', compact('receptionistAppointments'));
        } else {
            return view('dashboards.common-dashboard');
        }
    }

    /**
     * shows admin dashboard
     *
     * @return \Illuminate\Http\Response
     */
    private function adminDashboard()
    {
        $dashboardCounts = $this->dashboardCounts();
        $monthlyDebitCredit = $this->monthlyDebitCredit();
        $currentYearDebitCredit = $this->currentYearDebitCredit();
        $overallDebitCredit = $this->overallDebitCredit();

        return view('dashboardview', compact('dashboardCounts', 'monthlyDebitCredit', 'currentYearDebitCredit', 'overallDebitCredit'));
    }

    /**
     * shows admin char data
     *
     * @return \Illuminate\Http\Response
     */
    public function getChartData()
    {
        return response()->json([
            'monthlyDebitCredit' => $this->monthlyDebitCredit(),
            'currentYearDebitCredit' => $this->currentYearDebitCredit(),
            'overallDebitCredit' => $this->overallDebitCredit()
        ], 200);
    }

    /**
     * @return int|string|null
     */
    private function companyId()
    {
        return session('company_id');
    }

    /**
     * sums debit/credit monthly for bar chart
     *
     * @return array
     */
    private function monthlyDebitCredit()
    {
        $companyId = $this->companyId();
        $cacheKey = 'monthlyDebitCredit_' . ($companyId ?? 'all');

        return cache()->remember($cacheKey, 600, function () use ($companyId) {
            $credits = [];
            $debits = [];
            $labels = [];

            $invoiceQuery = Invoice::query()
                ->selectRaw('YEAR(invoice_date) as chart_year, MONTH(invoice_date) as chart_month')
                ->whereNotNull('invoice_date');

            if ($companyId) {
                $invoiceQuery->where('company_id', $companyId);
            }

            $results = $invoiceQuery
                ->groupBy('chart_year', 'chart_month')
                ->orderByDesc('chart_year')
                ->orderByDesc('chart_month')
                ->limit(12)
                ->get();

            foreach ($results as $result) {
                $year = (int) $result->chart_year;
                $month = (int) $result->chart_month;
                $labels[] = date('F', mktime(0, 0, 0, $month, 10)) . ' ' . $year;

                $paymentQuery = Payment::whereYear('payment_date', $year)
                    ->whereMonth('payment_date', $month);
                $monthInvoiceQuery = Invoice::whereYear('invoice_date', $year)
                    ->whereMonth('invoice_date', $month);

                if ($companyId) {
                    $paymentQuery->where('company_id', $companyId);
                    $monthInvoiceQuery->where('company_id', $companyId);
                }

                $credits[] = (float) $paymentQuery->sum('amount');
                $debits[] = (float) $monthInvoiceQuery->sum('grand_total');
            }

            return [
                'credits' => $credits,
                'debits' => $debits,
                'labels' => $labels,
            ];
        });
    }

    /**
     * sums debit/credit of current year for pie chart
     *
     * @return array
     */
    private function currentYearDebitCredit()
    {
        $companyId = $this->companyId();
        $cacheKey = 'currentYearDebitCredit_' . ($companyId ?? 'all');

        return cache()->remember($cacheKey, 600, function () use ($companyId) {
            $paymentQuery = Payment::whereYear('payment_date', date('Y'));
            $invoiceQuery = Invoice::whereYear('invoice_date', date('Y'));

            if ($companyId) {
                $paymentQuery->where('company_id', $companyId);
                $invoiceQuery->where('company_id', $companyId);
            }

            return [
                'credits' => (float) $paymentQuery->sum('amount'),
                'debits' => (float) $invoiceQuery->sum('grand_total'),
            ];
        });
    }

    /**
     * sums debit/credit of overall for pie chart
     *
     * @return array
     */
    private function overallDebitCredit()
    {
        $companyId = $this->companyId();
        $cacheKey = 'overallDebitCredit_' . ($companyId ?? 'all');

        return cache()->remember($cacheKey, 600, function () use ($companyId) {
            $paymentQuery = Payment::query();
            $invoiceQuery = Invoice::query();

            if ($companyId) {
                $paymentQuery->where('company_id', $companyId);
                $invoiceQuery->where('company_id', $companyId);
            }

            return [
                'credits' => (float) $paymentQuery->sum('amount'),
                'debits' => (float) $invoiceQuery->sum('grand_total'),
            ];
        });
    }

    private function dashboardCounts()
    {
        $companyId = $this->companyId();
        $cacheKey = 'dashboardCounts_' . ($companyId ?? 'all');

        return cache()->remember($cacheKey, 600, function () use ($companyId) {
            $departmentQuery = HospitalDepartment::query();
            $appointmentQuery = PatientAppointment::query();
            $invoiceQuery = Invoice::query();
            $paymentQuery = Payment::query();

            if ($companyId) {
                $departmentQuery->where('company_id', $companyId);
                $appointmentQuery->where('company_id', $companyId);
                $invoiceQuery->where('company_id', $companyId);
                $paymentQuery->where('company_id', $companyId);
            }

            return [
                'departments' => $departmentQuery->count(),
                'doctors' => User::role('Doctor')->count(),
                'patients' => User::role('Patient')->count(),
                'appointments' => $appointmentQuery->count(),
                'caseStudies' => PatientCaseStudy::count(),
                'prescriptions' => Prescription::count(),
                'invoices' => $invoiceQuery->count(),
                'payments' => $paymentQuery->count(),
            ];
        });
    }
}
