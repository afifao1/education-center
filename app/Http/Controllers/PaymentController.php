<?php
namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('student')->orderBy('payment_date', 'desc')->get();
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $students = Student::all();
        return view('payments.create', compact('students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'payment_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string'
        ]);

        Payment::create($validated);

        return redirect()->route('payments.index')->with('success', 'Payment successfully recorded!');
    }

    public function edit(Payment $payment)
    {
        $students = Student::all();
        return view('payments.edit', compact('payment', 'students'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'payment_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string'
        ]);

        $payment->update($validated);

        return redirect()->route('payments.index')->with('success', 'Payment successfully updated!');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Payment successfully deleted!');
    }
}
