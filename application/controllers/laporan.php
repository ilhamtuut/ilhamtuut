<?php
class Laporan extends CI_Controller{
	function __construct() {
        parent::__construct();
        /* tarik library Cfpdf supaya aktif, bisa juga diletakkan di dalam fungsi
        yang menjalankan pembuatan file PDF, atau kalau nggak mau repot sering menarik
        librarynya masukkan saja ke dalam autoload */
        $this->load->library('cfpdf');
		$this->load->model('Report_model');
    }
 
function cetak($id){
	$session=$this->session->userdata('logged_in');
	if($session!=""){
		//$id = "T1310";
		// ambil data dengan memanggil fungsi di model
		
		$temp_rec = $this->Report_model->transaksi($id);
		$num_rows = $temp_rec->num_rows();

		if($num_rows > 0) // jika data ada di database
		{
		  
			$pdf=new FPDF('P','cm','A4');
			$pdf->Open(); 
			$pdf->AliasNbPages();		 
			$pdf->AddPage();		 
			$pdf->SetMargins(1,1,1);		 
			$pdf->SetFont('Arial','B',12);
			//header
			$pdf->Ln(1);	 
			$pdf->SetFont('Arial','B',16);
			$pdf->Cell(0,0.75,'UD SARI ALAM',0,0,'C');
			$pdf->Ln();
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(0,0.5,'Alamat : Desa Raji, Kecamatan/Kabupaten Demak Telp 081219517100',0,0,'C'); 
			$pdf->Ln();
			$pdf->Line(1, 3.5, 20, 3.5);
			$pdf->Ln();
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(0,0.75,'Bukti Pemesanan',0,0,'C');
			$pdf->Ln();
		  // ambil data dari database
			$data=$temp_rec->row();

			$pdf->Ln(); // spasi enter
			$pdf->SetFont('Courier','B',12); // set font,size,dan properti (B=Bold)
			$pdf->Cell(5,0.5,'Nama Penerima  : '.$data->nama,0,1,'L');
			$pdf->Cell(5,0.5,'Alamat         : '.$data->alamat,0,1,'L');
			$pdf->Cell(5,0.5,'Alamat Kirim   : '.$data->alamat_kirim,0,1,'L');
			$pdf->Cell(5,0.5,'Email          : '.$data->email,0,1,'L');
			$pdf->Cell(5,0.5,'No. Telp       : '.$data->telp,0,1,'L');
			$pdf->Ln();

			$pdf->SetFont('Courier','B',12);
		  // set nama header tabel transaksi
			$pdf->Cell(1,0.5,'NO',1,0,'L');
			$pdf->Cell(4,0.5,'NO TRANSAKSI',1,0,'L');
			$pdf->Cell(4,0.5,'NAMA BARANG',1,0,'L');
			$pdf->Cell(2,0.5,'JUMLAH',1,0,'C');
			$pdf->Cell(4,0.5,'HARGA',1,0,'R');
			$pdf->Cell(4,0.5,'SUB TOTAL',1,0,'R');

			$rec = $temp_rec->result();
			$n=0;
			$total=0;
			foreach($rec as $r){
				$n++;
				$pdf->SetFont('Courier','B',10);
				$pdf->ln();
				$pdf->Cell(1,0.5,$n,1,0,'L');
				$pdf->Cell(4,0.5,$r->id_transaksi,1,0,'L');
				$pdf->Cell(4,0.5,$r->nama_produk,1,0,'L');
				$pdf->Cell(2,0.5,$r->jumlah,1,0,'C');
				$pdf->Cell(4,0.5,$r->harga.'.00',1,0,'R');
				$pdf->Cell(4,0.5,$r->tot_harga,1,0,'R');
				$total=$total+$r->tot_harga;
			}
			
			$pdf->ln();
			$pdf->Cell(15,0.5,'ONGKOS KIRIM ('.$data->kota.')',1,0,'L');
			$pdf->Cell(4,0.5,$data->biaya,1,0,'R');
			$pdf->ln();
			$pdf->Cell(15,0.5,'TOTAL',1,0,'L');
			$pdf->Cell(4,0.5,$total+$data->biaya.'.00',1,0,'R');

			//footer
			$pdf->SetY(-2.6);
			$pdf->SetFont("Courier","B","10");
			$pdf->Cell(9.5,0.5,'Printed on: '.date('d/m/Y H:i').'/'.$data->username,0,'LR','L');
			$pdf->Cell(9.5,0.5,'Page'.$pdf->PageNo().'/{nb}',0,0,'R');
			$pdf->Output();
		}
		else // jika data kosong
		{
		  redirect('users/belanja');
		}
	} else {
			//Set error
			redirect('produks');
		}
  }
}