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

    public function GenerateBillingReport($appointmentID)
{
    $pdf = new \FPDF('P', 'mm', 'A4');
    $pdf->AddPage();
    $billingReport = DB::table('appointments')
        ->join('patient_info', 'patient_info.id', '=', 'appointments.patient_id')
        ->join('patient_history', 'patient_history.patient_id', '=', 'patient_info.id')
        ->join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
        ->select(
            'patient_info.*',
            'patient_history.*',
            'doctors.FirstName as dfname', 
            'doctors.LastName as dlname', 
            'doctors.ProfessionalTitle', 
            'doctors.AreaOfExpertise', 
            'doctors.MDLink',
            'appointments.date as appt_date'
        )
        ->where('appointments.id', $appointmentID)
        ->first();

    if (!$billingReport) {
        return back()->with('error', 'No report data found.');
    }

    // Load FPDF
    $pdf = new \FPDF('P','mm','A4');
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(true, 15);

    // ====================================================================================
    // HEADER WITH LOGO + TITLE
    // ====================================================================================
    $logoPath = public_path('images/dclogo.png');
    if (file_exists($logoPath)) {
        $pdf->Image($logoPath, 10, 10, 28);
    }

    $pdf->SetFont('Arial','B',20);
    $pdf->SetTextColor(40,40,40);
    $pdf->Cell(0,10,'',0,1); // spacer
    $pdf->Cell(0,10,'DentalCare Patient Report',0,1,'C');

    $pdf->SetFont('Arial','',12);
    $pdf->SetTextColor(80,80,80);
    $pdf->Cell(0,6,'Comprehensive Medical & Dental Assessment',0,1,'C');
    $pdf->Ln(5);

    // Horizontal line
    $pdf->SetDrawColor(150,150,150);
    $pdf->Line(10, 35, 200, 35);
    $pdf->Ln(7);

    // Utility function to make section headers
    $makeSection = function($pdf, $text) {
        $pdf->SetFillColor(230, 235, 255);
        $pdf->SetDrawColor(180,180,180);
        $pdf->SetTextColor(30,30,30);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0,8,"  " . $text,1,1,'L',true);
        $pdf->Ln(2);
        $pdf->SetFont('Arial','',11);
        $pdf->SetTextColor(40,40,40);
    };

    // ====================================================================================
    // SECTION: PATIENT INFORMATION
    // ====================================================================================
    $makeSection($pdf, 'Patient Information');

    $fullName = trim($billingReport->FirstName.' '.$billingReport->MiddleName.' '.$billingReport->LastName);

    $pdf->Cell(50,7,'Full Name:',0,0);
    $pdf->Cell(0,7,$fullName,0,1);

    $pdf->Cell(50,7,'Birthdate:',0,0);
    $pdf->Cell(0,7,\Carbon\Carbon::parse($billingReport->BirthDate)->format('F j, Y'),0,1);

    $pdf->Cell(50,7,'Address:',0,1);
    $pdf->MultiCell(0,7,$billingReport->Address);

    $pdf->Cell(50,7,'Mobile:',0,0);
    $pdf->Cell(0,7,$billingReport->MobileNo,0,1);

    $pdf->Cell(50,7,'Email:',0,0);
    $pdf->Cell(0,7,$billingReport->Email,0,1);

    $pdf->Ln(3);

    // ====================================================================================
    // SECTION: DOCTOR INFORMATION
    // ====================================================================================
    $makeSection($pdf, 'Attending Doctor');

    $docName = $billingReport->dfname.' '.$billingReport->dlname;

    $pdf->Cell(50,7,'Doctor:',0,0);
    $pdf->Cell(0,7,$docName,0,1);

    $pdf->Cell(50,7,'Specialty:',0,0);
    $pdf->Cell(0,7,$billingReport->ProfessionalTitle . " / " . $billingReport->AreaOfExpertise,0,1);

    $pdf->Ln(3);

    // ====================================================================================
    // SECTION: DENTAL HISTORY
    // ====================================================================================
    $makeSection($pdf, 'Dental History');

    $pdf->Cell(50,7,'Previous Dentist:',0,0);
    $pdf->Cell(0,7,$billingReport->previous_dentist ?? 'N/A',0,1);

    $pdf->Cell(50,7,'Last Visit:',0,0);
    $pdf->Cell(0,7,$billingReport->last_visit ? \Carbon\Carbon::parse($billingReport->last_visit)->format('F j, Y') : 'N/A',0,1);

    $pdf->Ln(3);

    // ====================================================================================
    // SECTION: PHYSICIAN INFORMATION
    // ====================================================================================
    $makeSection($pdf, 'Physician Information');

    $fields = [
        'Physician Name' => $billingReport->physician_name,
        'Specialty' => $billingReport->physician_specialty,
        'Office Address' => $billingReport->physician_office_address,
        'Office Phone' => $billingReport->physician_office_no,
    ];

    foreach ($fields as $label => $value) {
        $pdf->Cell(50,7,$label.':',0,0);
        if (strlen($value) > 40) {
            $pdf->Ln(7);
            $pdf->MultiCell(0,6,$value);
        } else {
            $pdf->Cell(0,7,$value ?: 'N/A',0,1);
        }
    }

    $pdf->Ln(3);

    // ====================================================================================
    // SECTION: MEDICAL HISTORY
    // ====================================================================================
    $makeSection($pdf, 'Medical History');

    $medicalFields = [
        'General Health' => $billingReport->good_health,
        'Uses Drugs' => $billingReport->uses_drugs,
        'Under Medical Care' => $billingReport->under_medical_care,
        'Medical Condition Details' => $billingReport->medical_condition_text,
        'Had Surgery' => $billingReport->had_surgery,
        'Surgery Details' => $billingReport->surgery_text,
        'Pregnant' => $billingReport->pregnant,
        'Hospitalized' => $billingReport->hospitalized,
        'Hospitalization Details' => $billingReport->hospitalization_details,
        'Birth Control' => $billingReport->taking_birth_control,
        'Taking Medications' => $billingReport->taking_medications,
        'Medication Details' => $billingReport->medications_details,
        'Uses Tobacco' => $billingReport->using_tobacco,
        'Nursing' => $billingReport->nursing,
        'Blood Type' => $billingReport->blood_type,
        'Blood Pressure' => $billingReport->blood_pressure,
    ];

    foreach ($medicalFields as $label => $value) {
        if ($value !== null && $value !== '') {
            $pdf->Cell(60,7,$label.':',0,0);
            $pdf->MultiCell(0,7,$value);
        }
    }

    $pdf->Ln(3);

    // ====================================================================================
    // SECTION: KNOWN CONDITIONS
    // ====================================================================================
    $makeSection($pdf, 'Known Medical Conditions');

    $conditions = json_decode($billingReport->known_conditions, true);

    if ($conditions && count($conditions)) {
        foreach ($conditions as $c) {
            $pdf->Cell(5,6,'•',0,0);
            $pdf->Cell(0,6,$c,0,1);
        }
    } else {
        $pdf->Cell(0,7,'No known medical conditions.',0,1);
    }

    $pdf->Ln(3);

    // ====================================================================================
    // SECTION: ALLERGIES
    // ====================================================================================
    $makeSection($pdf, 'Allergies');

    $pdf->Cell(50,7,'Reported Allergies:',0,0);
    $pdf->Cell(0,7,$billingReport->allergy ?? 'None',0,1);

    if (!empty($billingReport->allergy_others)) {
        $pdf->Ln(2);
        $pdf->MultiCell(0,7,'Other Allergy Notes: '.$billingReport->allergy_others);
    }

    $pdf->Ln(10);

    // ====================================================================================
    // SIGNATURE SECTION
    // ====================================================================================
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(0,8,'Verification & Signature',0,1);

    $pdf->Ln(15);

    $pdf->SetFont('Arial','',11);
    $pdf->Cell(80,7,'_____________________________',0,1);
    $pdf->Cell(80,7,'Attending Dentist / Authorized Personnel',0,1);

    // ====================================================================================
    // OUTPUT PDF
    // ====================================================================================
    $pdf->Output('I','Patient_Report.pdf');
    exit;
}


public function AppointmentSummary(Request $request)
{
    $apptID = $request->query('apptID');

    $appointment = DB::table('appointments')
        ->where('appointments.id', $apptID)
        ->join('patient_info', 'patient_info.id','=','appointments.patient_id')
        ->join('doctors', 'doctors.id','=','appointments.doctor_id')
        ->join('sub_services', 'sub_services.id','=','appointments.service_id')
        ->join('users', 'users.id','=','appointments.mark_by')
        ->select(
            'appointments.*',
            'patient_info.FirstName as ptfname', 
            'patient_info.LastName as ptlname', 
            'patient_info.BirthDate as ptbdate', 
            'patient_info.Age as ptage', 
            'patient_info.Gender as ptgender',
            'doctors.FirstName as dtfname',
            'doctors.LastName as dtlname',
            'doctors.ProfessionalTitle as dcpt',
            'sub_services.Service as service_name',
            'sub_services.Price as service_price',
            'users.FirstName as staff_fname',
            'users.LastName as staff_lname'
        )
        ->first();

    if (!$appointment) abort(404, 'Appointment not found.');

    $pdf = new \FPDF('P','mm','A4');
    $pdf->AddPage();
    $pdf->SetMargins(15,15,15);

    // LOGO
    $logo = public_path('images/dclogo.png');
    if (file_exists($logo)) {
        $pdf->Image($logo, 80, 1, 50);
    }
    $pdf->Ln(30);

    // HEADER
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(0,8,'APPOINTMENT SUMMARY',0,1,'C');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(0,5,'Generated on: '.date('F j, Y - h:i A'),0,1,'C');
    $pdf->Ln(5);

    // FUNCTION FOR ROWS
    function rowItem($pdf,$label,$value){
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(40,6,$label.':');
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(0,6,$value,0,1);
    }

    // PATIENT INFO
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(0,6,'Patient Information',0,1);
    $pdf->Ln(2);

    rowItem($pdf,'Patient Name', $appointment->ptlname.', '.$appointment->ptfname);
    rowItem($pdf,'Birthdate', $appointment->ptbdate);
    rowItem($pdf,'Age', $appointment->ptage);
    rowItem($pdf,'Gender', $appointment->ptgender);

    $pdf->Ln(2);
    $pdf->Line(15,$pdf->GetY(),195,$pdf->GetY());
    $pdf->Ln(4);

    // APPOINTMENT DETAILS
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(0,6,'Appointment Details',0,1);
    $pdf->Ln(2);

    rowItem($pdf,'Service', $appointment->service_name);
    rowItem($pdf,'Service Price', ''.number_format($appointment->service_price,2));
    rowItem($pdf,'Appointment Date', $appointment->date);
    rowItem($pdf,'Appointment Time', $appointment->time);

    $pdf->Ln(2);
    $pdf->Line(15,$pdf->GetY(),195,$pdf->GetY());
    $pdf->Ln(4);

    // DOCTOR INFO
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(0,6,'Attending Doctor',0,1);
    $pdf->Ln(2);

    rowItem(
        $pdf,
        'Doctor',
        $appointment->dcpt.' '.$appointment->dtfname.' '.$appointment->dtlname
    );

    $pdf->Ln(2);
    $pdf->Line(15,$pdf->GetY(),195,$pdf->GetY());
    $pdf->Ln(4);

    // STAFF INFO
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(0,6,'Processed By',0,1);
    $pdf->Ln(2);

    rowItem(
        $pdf,
        'Staff',
        $appointment->staff_fname.' '.$appointment->staff_lname
    );

    $pdf->Ln(4);

    // PAYMENT SUMMARY
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(0,6,'Payment Summary',0,1);
    $pdf->Ln(2);

    $amountPaid = $appointment->amount_paid ?? 0;
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(130,6,'Amount Paid:');
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(0,6,''.number_format($amountPaid,2),0,1);

    $pdf->Ln(10);
// // Get billing items for this appointment
// $billingItems = DB::table('billings')
//     ->where('appointmentID', $appointment->id)
//     ->get();

// if ($billingItems->count() > 0) {
//     $pdf->SetFont('Arial','B',12);
//     $pdf->Cell(0,6,'Billing Items',0,1);
//     $pdf->Ln(2);

//     $pdf->SetFont('Arial','B',10);
//     $pdf->Cell(100,6,'Item',1);
//     $pdf->Cell(30,6,'Qty',1,0,'C');
//     $pdf->Cell(30,6,'Price',1,0,'C');
//     $pdf->Cell(30,6,'Subtotal',1,1,'C');

//     $pdf->SetFont('Arial','',10);
//     $totalBilling = 0;
//     foreach ($billingItems as $item) {
//         $subtotal = $item->quantity * $item->itemPrice;
//         $totalBilling += $subtotal;

//         $pdf->Cell(100,6,$item->itemName,1);
//         $pdf->Cell(30,6,$item->quantity,1,0,'C');
//         $pdf->Cell(30,6,'₱ '.number_format($item->itemPrice,2),1,0,'C');
//         $pdf->Cell(30,6,'₱ '.number_format($subtotal,2),1,1,'C');
//     }

//     // TOTAL
//     $pdf->SetFont('Arial','B',11);
//     $pdf->Cell(160,6,'Total Billing:',1);
//     $pdf->Cell(30,6,'₱ '.number_format($totalBilling,2),1,1,'C');
//     $pdf->Ln(5);
// }
    // SIGNATURES
    // $pdf->SetFont('Arial','B',12);
    // $pdf->Ln(8);

    // // Patient signature
    // $pdf->SetFont('Arial','',10);
    // $pdf->Cell(80,5,'',0,0,'C'); // Spacer
    // $pdf->Cell(80,5,'',0,1,'C'); // Centered line
    // $pdf->Line(25, $pdf->GetY(), 95, $pdf->GetY());
    // $pdf->Ln(3);
    // $pdf->Cell(70,5,'Patient Signature',0,0,'C');

    // // Staff signature
    // $pdf->Cell(60,5,'',0,0); // Spacer between lines
    // // $pdf->Line(115, $pdf->GetY(), 185, $pdf->GetY());
    // $pdf->Ln(3);
    // $pdf->Cell(125,5,'Confirmed By: '.$appointment->staff_fname.' '.$appointment->staff_lname,0,1,'C');

    $pdf->Output();
}









}

