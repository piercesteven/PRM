<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Payment::all();
        return view('pages.transactions', compact('transactions'));
    }

    public function generateSales(Request $request)
    {
        try {
            $data = $request->validate([
                'start' => 'required|date',
                'end' => 'required|date'
            ]);

            if ($data['start'] > $data['end']) {
                Alert::warning('Warning', 'Start date must not be greater than end date.');
                return redirect()->back();
            }

            // Query transactions within the date range and completed status
            $transactions = Payment::whereBetween('created_at', [$data['start'], $data['end']])
                ->where('status', 'Completed')
                ->get();

            // Pass transactions to a view or export logic as needed
            return view('pages.transactions-sales', compact('transactions', 'data'));
        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }
    }
}
