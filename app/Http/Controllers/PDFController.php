<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;

class PDFController extends Controller
{
    public function InventoryReportPDF()
{
    $inventoryItems = Inventory::where('isVisible', true)->get();

    // Initialize FPDF
    $pdf = new \FPDF();
    $pdf->AddPage();

    // Add Logo (adjust path as needed)
    $logoPath = public_path('images/dclogo.png'); // or .jpg
    if (file_exists($logoPath)) {
        $pdf->Image($logoPath, 10, 8, 25); // (x, y, width)
    }

    // Move cursor to the right for title
    $pdf->SetXY(40, 10);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'Inventory Report', 0, 1, 'L');

    // Date (Philippines timezone)
    $pdf->SetFont('Arial', '', 9);
    $pdf->SetXY(40, 18);
    $pdf->Cell(0, 8, 'Generated on: ' . now('Asia/Manila')->format('F d, Y h:i A'), 0, 1, 'L');
    $pdf->Ln(15);

    // Table Header
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(240, 240, 240); // Light gray
    $pdf->Cell(15, 8, 'ID', 1, 0, 'C', true);
    $pdf->Cell(90, 8, 'Item Name', 1, 0, 'C', true);
    $pdf->Cell(45, 8, 'Category', 1, 0, 'C', true);
    $pdf->Cell(30, 8, 'Quantity', 1, 1, 'C', true);

    // Table Content
    $pdf->SetFont('Arial', '', 9);
    foreach ($inventoryItems as $item) {
        $pdf->Cell(15, 8, $item->id, 1, 0, 'C');
        $pdf->Cell(90, 8, utf8_decode($item->item_name), 1, 0, 'L');
        $pdf->Cell(45, 8, utf8_decode($item->category ?? '-'), 1, 0, 'C');
        $pdf->Cell(30, 8, $item->on_hand ?? '-', 1, 1, 'C');
    }

    // Footer
    $pdf->Ln(8);
    $pdf->SetFont('Arial', 'I', 8);
    $pdf->Cell(0, 8, 'End of Report', 0, 1, 'C');

    // Output PDF
    $pdf->Output();
    exit;
}

    public function ServicesReportPDF()
{
    $services = DB::table('services')
        ->join('sub_services', 'sub_services.parent_service', '=', 'services.id')
        ->select('services.id', 'services.Service', 'sub_services.Service as subService', 'sub_services.Price')
        ->get()
        ->groupBy('Service');

    $pdf = new \FPDF();
    $pdf->AddPage();

    // --- HEADER ---
    $logoPath = public_path('images/dclogo.png');
    if (file_exists($logoPath)) {
        $pdf->Image($logoPath, 10, 8, 25);
    }

    $pdf->SetXY(40, 10);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'Services Report', 0, 1, 'L');

    $pdf->SetFont('Arial', '', 9);
    $pdf->SetXY(40, 18);
    $pdf->Cell(0, 8, 'Generated on: ' . now('Asia/Manila')->format('F d, Y h:i A'), 0, 1, 'L');

    $pdf->Ln(20);

    // --- MAIN TABLE BOX ---
    $boxX = 10;
    $boxWidth = 190;
    $startY = $pdf->GetY();
    $pdf->SetFont('Arial', '', 11);

    // Table header (gray background)
    $pdf->SetFillColor(230, 230, 230);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(70, 8, 'Service', 1, 0, 'C', true);
    $pdf->Cell(80, 8, 'Sub-Service', 1, 0, 'C', true);
    $pdf->Cell(40, 8, 'Price', 1, 1, 'C', true);

    // Table body
    $pdf->SetFont('Arial', '', 11);
    $pdf->SetFillColor(255, 255, 255);

    foreach ($services as $serviceName => $items) {
        $first = true;
        foreach ($items as $item) {
            $price = 'PHP ' . number_format($item->Price, 2);

            // Service name shown once per group
            if ($first) {
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(70, 8, utf8_decode($serviceName), 1, 0, 'L');
                $first = false;
    $pdf->SetFont('Arial', '', 10);
            } else {
                $pdf->Cell(70, 8, '', 1, 0); // empty cell for grouped service
            }

            // Sub-service + price
            $pdf->Cell(80, 8, utf8_decode($item->subService), 1, 0, 'L');
            $pdf->Cell(40, 8, $price, 1, 1, 'R');
        }
    }

    // Draw neat border around entire table
    $endY = $pdf->GetY();
    $pdf->Rect($boxX, $startY, $boxWidth, $endY - $startY);


    // --- FOOTER ---
    // $pdf->Ln(10);
    // $pdf->SetFont('Arial', 'I', 9);
    // $pdf->Cell(0, 8, 'Generated on: ' . now('Asia/Manila')->format('F d, Y h:i A'), 0, 1, 'C');
    $pdf->Cell(0, 8, 'End of Report', 0, 1, 'C');

    $pdf->Output('I', 'Services_Report.pdf');
    exit;
}

public function AppointmentsReportPDF() {
    $appointments = DB::table('appointments')
        ->join('patient_info', 'patient_info.id', '=', 'appointments.patient_id')
        ->leftJoin('users', 'users.id', '=', 'appointments.patient_id')
        ->join('sub_services', 'sub_services.id', '=', 'appointments.service_id')
        ->join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
        ->leftJoin('opt_notes','opt_notes.appointment','=', 'appointments.id')
        ->select(
            'doctors.ProfessionalTitle as title', 
            'doctors.Firstname as dfName', 
            'doctors.LastName as dlname',
            'users.id as refID',
            'patient_info.FirstName',
            'patient_info.LastName',
            'patient_info.Email',
            'appointments.date as Date',
            'appointments.time as Time',
            'appointments.status',
            'sub_services.Service as service',
            'appointments.id',
            'opt_notes.Date as note_date', 
            'opt_notes.Tooth',
            'opt_notes.Procedure',
            'opt_notes.AmountCharge',
            'opt_notes.AmountPaid',
            'opt_notes.Balance', 
            'PostOpNotes', 
            'ImportantNotes', 
            'opt_notes.id as note_id'
        )
        ->get();

    $pdf = new \FPDF('P','mm','A4');
    $pdf->AddPage();

    // Logo
    $logoPath = public_path('images/dclogo.png'); // path to your logo
    if (file_exists($logoPath)) {
        $pdf->Image($logoPath, 10, 8, 25); // (x, y, width)
    }

    // Title and generated date/time
    $pdf->SetXY(40, 10);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'Appointments Report', 0, 1, 'L');

    $pdf->SetFont('Arial', '', 9);
    $pdf->SetXY(40, 18);
    $pdf->Cell(0, 8, 'Generated on: ' . now('Asia/Manila')->format('F d, Y h:i A'), 0, 1, 'L');

    $pdf->Ln(20); // Space before table

    // Table header
    $pdf->SetFont('Arial','B',11);
    $pdf->SetFillColor(200, 200, 200); // Light gray background
    $pdf->Cell(50,10,'Patient',1,0,'C', true);
    $pdf->Cell(30,10,'Date',1,0,'C', true);
    $pdf->Cell(25,10,'Time',1,0,'C', true);
    $pdf->Cell(55,10,'Service',1,0,'C', true);
    $pdf->Cell(30,10,'Status',1,1,'C', true);

    // Table body
    $pdf->SetFont('Arial','',10);
    $fill = false; // For alternating row colors
    foreach ($appointments as $appt) {
        $patient = $appt->FirstName . ' ' . $appt->LastName;
        $date = date('M d, Y', strtotime($appt->Date));
        $time = date('h:i A', strtotime($appt->Time));
        $service = $appt->service;
        $status = ucfirst($appt->status);

        if($fill) $pdf->SetFillColor(245, 245, 245); // Light gray
        else $pdf->SetFillColor(255, 255, 255); // White

        $pdf->Cell(50,10,$patient,1,0,'L',true);
        $pdf->Cell(30,10,$date,1,0,'C',true);
        $pdf->Cell(25,10,$time,1,0,'C',true);
        $pdf->Cell(55,10,$service,1,0,'L',true);
        $pdf->Cell(30,10,$status,1,1,'C',true);

        $fill = !$fill;
    }
    $pdf->Ln(10); // Space before table
    $pdf->SetFont('Arial','I',10);
$pdf->Cell(0, 8, 'End of Report', 0, 1, 'C','', '');
    $pdf->Output('I', 'appointments_report.pdf'); // Show in browser
    exit;
}

public function PayslipPDF() {
    $pdf = new \FPDF('P', 'mm', 'A4');
    $pdf->AddPage();

    // Title
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'Pay Slip', 0, 1, 'C');
    $pdf->Ln(5);

    // Employee Details - Labels bold & italic
    $pdf->SetFont('Arial', 'BI', 10); // Bold + Italic for labels
    $labelWidth = 40;
    $valueWidth = 60;

    // First Row
    $pdf->Cell($labelWidth, 6, 'Company:', 0, 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell($valueWidth, 6, 'JungleFun HK', 0, 0);
    $pdf->SetFont('Arial', 'BI', 10);
    $pdf->Cell($labelWidth, 6, 'Payroll Period:', 0, 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 6, '2025-09-01 - 2025-10-01', 0, 1);

    // Second Row
    $pdf->SetFont('Arial', 'BI', 10);
    $pdf->Cell($labelWidth, 6, 'Employee:', 0, 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell($valueWidth, 6, 'Lagrosa Mirasol Gosila', 0, 0);
    $pdf->SetFont('Arial', 'BI', 10);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 6, '', 0, 1);

    // Third Row
    $pdf->SetFont('Arial', 'BI', 10);
    $pdf->Cell($labelWidth, 6, 'Position:', 0, 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell($valueWidth, 6, 'Activity Coordinator', 0, 0);
    $pdf->SetFont('Arial', 'BI', 10);

    // $pdf->SetFont('Arial', 'BI', 10);
    // $pdf->Cell($labelWidth, 6, 'Department:', 0, 0);
    // $pdf->SetFont('Arial', '', 10);
    // $pdf->Cell($valueWidth, 6, 'Retail Sales Department', 0, 0);
    // $pdf->SetFont('Arial', 'BI', 10);

    // Fourth Row
    $pdf->SetFont('Arial', 'BI', 10);
    $pdf->SetFont('Arial', 'BI', 10);
    $pdf->Cell($labelWidth, 6, 'MPF Date:', 0, 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 6, '2025-10-10', 0, 1);

    $pdf->Ln(8);

    // Payment Table
    $pdf->SetFont('Times', 'B', 10);
$pdf->Cell(70, 7, 'Payment Type', 0, 0, 'L');
$pdf->Cell(70, 7, 'Method', 0, 0, 'L'); // wider to fit bank info
$pdf->Cell(50, 7, 'Amount (HKS)', 0, 1, 'R');
$pdf->Ln(2);

// Data row
$pdf->SetFont('Times', '', 10);

// First line: Payment row
$pdf->Cell(70, 7, 'Basic Salary', 0, 0, 'L');
$pdf->Cell(70, 7, 'Auto Pay', 0, 0, 'L');
$pdf->Cell(50, 7, '23,100 ', 0, 1, 'R');
$pdf->Ln(0);

// Second line: Bank/account info under “Method”
$pdf->SetFont('Times', 'I', 9);
$pdf->Cell(70, 7, '', 0, 0); // blank under Payment Type
$pdf->Cell(70, 7, 'HSBC 055889612833', 0, 0, 'L');
$pdf->Cell(50, 7, '', 0, 1); // leave Amount column blank
$pdf->Ln(2);

// Total row aligned under Method column
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(70, 7, '', 0, 0); // blank under Payment Type
$pdf->Cell(70, 7, 'Total:', 0, 0, 'L'); // under Method column
$pdf->Cell(50, 7, '23,100 ', 0, 1, 'R');
$pdf->Ln(2);

// Draw bottom line
$pdf->Ln(20);


   // MPF Contribution Detail Table
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(30, 7, '', 1, 0, 'C');
$pdf->Cell(60, 7, 'Mandatory Contribution', 1, 0, 'C');
$pdf->Cell(60, 7, 'Voluntary Contribution', 1, 0, 'C');
$pdf->Cell(30, 7, 'Total Contribution', 1, 1, 'C');

// Second row headers (no blank under Relevant Income)
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(30, 7, 'Relevant Income', 1, 0, 'C'); // keep border for alignment
$pdf->Cell(30, 7, 'Employer', 1, 0, 'C');
$pdf->Cell(30, 7, 'Employee', 1, 0, 'C');
$pdf->Cell(30, 7, 'Employer', 1, 0, 'C');
$pdf->Cell(30, 7, 'Employee', 1, 0, 'C');
$pdf->Cell(15, 7, 'Employer', 1, 0, 'C');
$pdf->Cell(15, 7, 'Employee', 1, 1, 'C');

// Example data row
$pdf->Cell(30, 7, '23,100', 1, 0, 'C');
$pdf->Cell(30, 7, '0.00', 1, 0, 'C');
$pdf->Cell(30, 7, '0.00', 1, 0, 'C');
$pdf->Cell(30, 7, '0.00', 1, 0, 'C');
$pdf->Cell(30, 7, '0.00', 1, 0, 'C');
$pdf->Cell(15, 7, '0.00', 1, 0, 'C');
$pdf->Cell(15, 7, '0.00', 1, 1, 'C');

$pdf->Ln(10);
$pdf->SetFont('Arial', 'I', 9);
$pdf->Cell(0, 7, '*** End Of Report ***', 0, 1, 'C');


    $pdf->Output('I', 'pay_slip.pdf');
    exit;
}



}

