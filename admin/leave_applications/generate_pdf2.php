<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `leave_applications` where id = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    }
}
if ($_settings->userdata('type') == 3) {
    $meta_qry = $conn->query("SELECT * FROM employee_meta where meta_field = 'leave_type_ids' and user_id = '{$_settings->userdata('id')}' ");
    $leave_type_ids = $meta_qry->num_rows > 0 ? $meta_qry->fetch_array()['meta_value'] : '';
}
?>

<?php
ob_clean();
require('fpdf185/fpdf.php');
class PDF extends FPDF
{
    function Header()
    {
        
        $this->Ln();
        $this->SetFont('helvetica', 'BI', 8);
        $this->Cell(0, 5, 'Civil Service form No.6', 0, 1, '');
        $this->Cell(0, 3, 'Revised 2020', 0, 1, '');
        $this->SetFont('helvetica', 'B', 9);
        //189 is the total width for A4 page, height, border, line,
        //Cell($w, $h=0, $txt='', $border=0 $ln=0, $align='', $fill=0, $link='', $stretched=0, $ignore_min_height=false, $calign='T', $valign='M')
        $this->Cell(0, 3, 'Republic of the Philippines', 0, 1, 'C');
        $this->SetFont('helvetica', 'BI', 9);
        $this->Cell(0, 3, 'Department of Education', 0, 1, 'C');
        $this->Cell(0, 3, 'Region I', 0, 1, 'C');
        $this->Cell(0, 3, 'SCHOOLS DIVISION OFFICE I PANGASINAN', 0, 1, 'C');
        $this->SetFont('helvetica', 'BI', 6);
        $this->Cell(0, 3, '', 0, 1, 'C');
        $this->SetFont('helvetica', 'B', 16);
        $this->Cell(0, 3, 'APPLICATION FOR LEAVE', 0, 1, 'C');
        $this->SetFont('helvetica', 'BI', 6);
        $this->Cell(0, 3, '', 0, 1, 'C');

        //adding the contents
        $this->SetFont('helvetica', '', 10);
        $this->Cell(202, 5, ' 1. OFFICE DEPARTMENT                      2. NAME:             (Last)                               (First)                             (Middle)', 'LTR', 1, '');
        $this->Cell(202, 8, '      ', 'LRB', 1, '');

        $this->Cell(202, 10, ' 3. DATE OF FILING________________       4. POSITION:_________________________      5. SALARY ________________', 1, 1, '');

        $this->SetFont('helvetica', '', 1);
        $this->Cell(202, 0, ' ', 1, 1, 'C');
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(202, 5, '6. DETAILS OF APPLICATION', 1, 1, 'C');
        $this->SetFont('helvetica', '', 1);
        $this->Cell(202, 0, ' ', 1, 1, 'C');

        $this->SetFont('helvetica', '', 10);
        $this->Cell(115, 8, " 6.A TYPE OF LEAVE TO BE AVAILED OF    ", 'TLR', );
        $this->Cell(87, 8, " 6.B DETAILS OF LEAVE", 'TLR');
        $this->Ln();

        $this->SetFont('DejaVuSans', '', 14);
        $this->Cell(6, 6, ' ☐', 'L');
        $this->SetFont('DejaVuSans', '', 10);
        $this->Cell(26, 6, ' Paternity Leave ', '');
        $this->SetFont('DejaVuSans', '', 6);
        $this->Cell(83, 6, ' (R.A. No. 8187 / CSC MC)', 'R');
        $this->SetFont('DejaVuSans', '', 14);
        $this->Cell(9, 6, '   ☐', 'L');
        $this->SetFont('DejaVuSans', '', 10);
        $this->Cell(78, 6, " In Hospital (Specify) _____________________", 'R');
        $this->Ln();
        

    }
}






$pdf = new PDF('p', 'mm', 'Legal');
$pdf->AddPage();

//add the dejavusans font type
$pdf->AddFont('DejaVuSans', '', 'DejaVuSans.php');
// $pdf->SetFont('helvetica', 'B', 16);
// $pdf->Cell(100, 20, 'Application for Leave Form', 1, 0, 'C');
$pdf->Output();
unset($pdf);
?>