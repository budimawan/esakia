<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_riwayat extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		is_logged_in();
        $this->load->model("Skp_model"); 
        $this->load->model("User_model"); 
        $this->load->model("Rincian_model"); 
    }

	public function index()
	{
		$id = $this->session->userdata('id');
		$data2['title'] = "Riwayat SKP";
        $data['skp'] = $this->Skp_model->getAllById($id);
		$data['user'] = $this->User_model->getById($id);

		$this->load->view('template/topbar_', $data2);
		$this->load->view('template/sidebar');
		$this->load->view('user/v_riwayatskp_', $data);

		$this->load->view('template/footer_', $data);
	}
	
	public function lihat_skp($id_skp)
	{
		$data['skp'] = $this->Skp_model->getById($id_skp);

		$data['penilai'] = $this->User_model->getById($data['skp']['penilai_id']);
		$data['pegawai'] = $this->User_model->getById($data['skp']['pegawai_id']);
		$data['atasan'] = $this->User_model->getById($data['skp']['atasan_id']);

		$data2['title'] = "SKP Telah Disetujui";

		$this->db->where('rinci_skp_id', $id_skp);
		$data['rincian'] = $this->db->get('rincian')->result_array(); 

		$this->load->view('template/topbar_', $data2);
		$this->load->view('template/sidebar', $data2);
		$this->load->view('user/v_lihatskp_', $data);
			
	
	}

	public function export_excel_1($id_skp)
	{
		$data['skp'] = $this->Skp_model->getById($id_skp);
		
		$data_penilai = $this->User_model->getById($data['skp']['penilai_id']);
		$data_pegawai = $this->User_model->getById($data['skp']['pegawai_id']);
		$data_atasan = $this->User_model->getById($data['skp']['atasan_id']);
		
		$this->db->where('rinci_skp_id', $id_skp);
		$data = $this->db->get('rincian')->result_array();
		
		$this->db->where('id', $id_skp);
		$data_prilaku = $this->db->get('skp')->row_array();
		
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		$excel = new PHPExcel();
		$excel->getProperties()->setCreator('Budi Dharmawan')
					->setLastModifiedBy('Budi Dharmawan')
					->setTitle("Data SKP")
					->setSubject("SKP1")
					->setDescription("Lembar1 Pengajuan SKP ")
					->setKeywords("Lembar SKP");
		
		$style_col = array(
		'font' => array('bold' => true), 
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER 
		),
		'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
		)
		);
		
		$style_row = array(
			'alignment' => array('vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER ),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN))
		);
		
		$excel->setActiveSheetIndex(0)->setCellValue('A7', "PENILAIAN PRESTASI KERJA"); 
			$excel->getActiveSheet()->mergeCells('A7:J7'); 
			$excel->getActiveSheet()->getStyle('A7')->getFont()->setBold(TRUE); 
			$excel->getActiveSheet()->getStyle('A7')->getFont()->setSize(12); 
			$excel->getActiveSheet()->getStyle('A7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		$excel->setActiveSheetIndex(0)->setCellValue('A8', "PEGAWAI NEGERI SIPIL"); 
			$excel->getActiveSheet()->mergeCells('A8:J8'); 
			$excel->getActiveSheet()->getStyle('A8')->getFont()->setBold(TRUE); 
			$excel->getActiveSheet()->getStyle('A8')->getFont()->setSize(12); 
			$excel->getActiveSheet()->getStyle('A8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		$excel->setActiveSheetIndex(0)->setCellValue('A11', "PEMERINTAH KABUPATEN MOROWALI"); 
			$excel->getActiveSheet()->mergeCells('A11:G11');

		$excel->setActiveSheetIndex(0)->setCellValue('H11', "JANGKA WAKTU PENILAIAN"); 
			$excel->getActiveSheet()->mergeCells('H5:J5');

		$excel->setActiveSheetIndex(0)->setCellValue('H12', "Juli s/d Desember 2021"); 
			$excel->getActiveSheet()->mergeCells('H12:J12');

		//no 1
		$excel->setActiveSheetIndex(0)->setCellValue('A15', "1. ")->getStyle('A15:A20')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('B15', "YANG DINILAI");
			$excel->getActiveSheet()->mergeCells('B15:J15')->getStyle('B15:J15')->applyFromArray($style_row);

		$excel->setActiveSheetIndex(0)->setCellValue('B16', "a."); 
		$excel->setActiveSheetIndex(0)->setCellValue('C16', "N A M A"); 
			$excel->getActiveSheet()->mergeCells('C16:F16')->getStyle('B16:F16')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('G16', $data_pegawai['nama']); 
			$excel->getActiveSheet()->mergeCells('G16:J16')->getStyle('G16:J16')->applyFromArray($style_row);

		$excel->setActiveSheetIndex(0)->setCellValue('B17', "b.");
		$excel->setActiveSheetIndex(0)->setCellValue('C17', "N I P"); 
			$excel->getActiveSheet()->mergeCells('C17:F17')->getStyle('B17:F17')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('G17', "'".$data_pegawai['nip']); 
			$excel->getActiveSheet()->mergeCells('G17:J17')->getStyle('G17:J17')->applyFromArray($style_row);
		
		$excel->setActiveSheetIndex(0)->setCellValue('B18', "c.");
		$excel->setActiveSheetIndex(0)->setCellValue('C18', "Pangkat, golongan ruang"); 
			$excel->getActiveSheet()->mergeCells('C18:F18')->getStyle('B18:F18')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('G18', $data_pegawai['pangkat_golongan']); 
			$excel->getActiveSheet()->mergeCells('G18:J18')->getStyle('G18:J18')->applyFromArray($style_row);	

		$excel->setActiveSheetIndex(0)->setCellValue('B19', "d.");
		$excel->setActiveSheetIndex(0)->setCellValue('C19', "Jabatan/Pekerjaan"); 
			$excel->getActiveSheet()->mergeCells('C19:F19')->getStyle('B19:F19')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('G19', $data_pegawai['jabatan']); 
			$excel->getActiveSheet()->mergeCells('G19:J19')->getStyle('G19:J19')->applyFromArray($style_row);

		$excel->setActiveSheetIndex(0)->setCellValue('B20', "e.");
		$excel->setActiveSheetIndex(0)->setCellValue('C20', "Unit Organisasi"); 
			$excel->getActiveSheet()->mergeCells('C20:F20')->getStyle('B20:F20')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('G20', $data_pegawai['unit_kerja']); 
			$excel->getActiveSheet()->mergeCells('G20:J20')->getStyle('G20:J20')->applyFromArray($style_row);
			
		//no 2
		$excel->setActiveSheetIndex(0)->setCellValue('A21', "2. ")->getStyle('A21:A26')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('B21', "PEJABAT PENILAI");
			$excel->getActiveSheet()->mergeCells('B21:J21')->getStyle('B21:J21')->applyFromArray($style_row);

		$excel->setActiveSheetIndex(0)->setCellValue('B22', "a."); 
		$excel->setActiveSheetIndex(0)->setCellValue('C22', "N A M A"); 
			$excel->getActiveSheet()->mergeCells('C22:F22')->getStyle('B22:F22')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('G22', $data_penilai['nama']); 
			$excel->getActiveSheet()->mergeCells('G22:J22')->getStyle('G22:J22')->applyFromArray($style_row);

		$excel->setActiveSheetIndex(0)->setCellValue('B23', "b.");
		$excel->setActiveSheetIndex(0)->setCellValue('C23', "N I P"); 
			$excel->getActiveSheet()->mergeCells('C23:F23')->getStyle('B23:F23')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('G23', "'".$data_penilai['nip']); 
			$excel->getActiveSheet()->mergeCells('G23:J23')->getStyle('G23:J23')->applyFromArray($style_row);
		
		$excel->setActiveSheetIndex(0)->setCellValue('B24', "c.");
		$excel->setActiveSheetIndex(0)->setCellValue('C24', "Pangkat, golongan ruang"); 
			$excel->getActiveSheet()->mergeCells('C24:F24')->getStyle('B24:F24')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('G24', $data_penilai['pangkat_golongan']); 
			$excel->getActiveSheet()->mergeCells('G24:J24')->getStyle('G24:J24')->applyFromArray($style_row);	

		$excel->setActiveSheetIndex(0)->setCellValue('B25', "d.");
		$excel->setActiveSheetIndex(0)->setCellValue('C25', "Jabatan/Pekerjaan"); 
			$excel->getActiveSheet()->mergeCells('C25:F25')->getStyle('B25:F25')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('G25', $data_penilai['jabatan']); 
			$excel->getActiveSheet()->mergeCells('G25:J25')->getStyle('G25:J25')->applyFromArray($style_row);

		$excel->setActiveSheetIndex(0)->setCellValue('B26', "e.");
		$excel->setActiveSheetIndex(0)->setCellValue('C26', "Unit Organisasi"); 
			$excel->getActiveSheet()->mergeCells('C26:F26')->getStyle('B26:F26')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('G26', $data_penilai['unit_kerja']); 
			$excel->getActiveSheet()->mergeCells('G26:J26')->getStyle('G26:J26')->applyFromArray($style_row);

		//no 3
		$excel->setActiveSheetIndex(0)->setCellValue('A27', "3. ")->getStyle('A27:A32')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('B27', "ATASAN PEJABAT PNILAI");
			$excel->getActiveSheet()->mergeCells('B27:J27')->getStyle('B27:J27')->applyFromArray($style_row);

		$excel->setActiveSheetIndex(0)->setCellValue('B28', "a."); 
		$excel->setActiveSheetIndex(0)->setCellValue('C28', "N A M A"); 
			$excel->getActiveSheet()->mergeCells('C28:F28')->getStyle('B28:F28')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('G28', $data_atasan['nama']); 
			$excel->getActiveSheet()->mergeCells('G28:J28')->getStyle('G28:J28')->applyFromArray($style_row);

		$excel->setActiveSheetIndex(0)->setCellValue('B29', "b.");
		$excel->setActiveSheetIndex(0)->setCellValue('C29', "N I P"); 
			$excel->getActiveSheet()->mergeCells('C29:F29')->getStyle('B29:F29')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('G29', "'".$data_atasan['nip']); 
			$excel->getActiveSheet()->mergeCells('G29:J29')->getStyle('G29:J29')->applyFromArray($style_row);
		
		$excel->setActiveSheetIndex(0)->setCellValue('B30', "c.");
		$excel->setActiveSheetIndex(0)->setCellValue('C30', "Pangkat, golongan ruang"); 
			$excel->getActiveSheet()->mergeCells('C30:F30')->getStyle('B30:F30')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('G30', $data_atasan['pangkat_golongan']); 
			$excel->getActiveSheet()->mergeCells('G30:J30')->getStyle('G30:J30')->applyFromArray($style_row);	

		$excel->setActiveSheetIndex(0)->setCellValue('B31', "d.");
		$excel->setActiveSheetIndex(0)->setCellValue('C31', "Jabatan/Pekerjaan"); 
			$excel->getActiveSheet()->mergeCells('C31:F31')->getStyle('B31:F31')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('G31', $data_atasan['jabatan']); 
			$excel->getActiveSheet()->mergeCells('G31:J31')->getStyle('G31:J31')->applyFromArray($style_row);

		$excel->setActiveSheetIndex(0)->setCellValue('B32', "e.");
		$excel->setActiveSheetIndex(0)->setCellValue('C32', "Unit Organisasi"); 
			$excel->getActiveSheet()->mergeCells('C32:F32')->getStyle('B32:F32')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('G32', $data_atasan['unit_kerja']); 
			$excel->getActiveSheet()->mergeCells('G32:J32')->getStyle('G32:J32')->applyFromArray($style_row);

		//no 4
		$nskp = 0;
		$jml = 0;
		foreach($data as $nilai_total){
			$nskp = $nskp + $nilai_total['rinci_jumlah'];
			$jml++;
		}
		$nskp = $nskp/$jml;
		// $nilai_ = round($nilai*0.6, 2);

		$excel->setActiveSheetIndex(0)->setCellValue('A33', "4. ")->getStyle('A33:A44')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('B33', "UNSUR YANG DINILAI");
			$excel->getActiveSheet()->mergeCells('B33:I33')->getStyle('B33:I33')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('J33', "JUMLAH")->getStyle('J33')->applyFromArray($style_row);

		$excel->setActiveSheetIndex(0)->setCellValue('B34', "a.");
			$excel->getActiveSheet()->mergeCells('B34:B35')->getStyle('B34:I35')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('C34', "Sasaran Kerja Pegawai (SKP)"); 
			$excel->getActiveSheet()->mergeCells('C34:G35');
		$excel->setActiveSheetIndex(0)->setCellValue('H34', $nskp); 
			$excel->getActiveSheet()->mergeCells('H34:H35');
		$excel->setActiveSheetIndex(0)->setCellValue('I34', "x 60%"); 
			$excel->getActiveSheet()->mergeCells('I34:I35');
		$excel->setActiveSheetIndex(0)->setCellValue('J34', round($nskp*0.6, 2));
			$excel->getActiveSheet()->mergeCells('J34:J35')->getStyle('J34:J35')->applyFromArray($style_row);

		$excel->setActiveSheetIndex(0)->setCellValue('B36', "b.");
			$excel->getActiveSheet()->mergeCells('B36:B44')->getStyle('B36:B44')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('C36', "Prilaku Kerja"); 
			$excel->getActiveSheet()->mergeCells('C36:D44')->getStyle('C36:D44')->applyFromArray($style_row);
		
		if($data_prilaku['orientasi'] <= 50){
			$orientasi = "(Buruk)";
		} else if($data_prilaku['orientasi'] <= 60 && $data_prilaku['orientasi'] >= 50){
			$orientasi = "(Sedang)";
		} else if($data_prilaku['orientasi'] <= 75 && $data_prilaku['orientasi'] >= 60){
			$orientasi = "(Cukup)";
		} else if($data_prilaku['orientasi'] <= 90.99 && $data_prilaku['orientasi'] >= 75){
			$orientasi = "(Baik)";
		} else if($data_prilaku['orientasi'] <= 100 && $data_prilaku['orientasi'] >= 90.99){
			$orientasi = "(Sangat Baik)";
		}
		$excel->setActiveSheetIndex(0)->setCellValue('E36', "1.")->getStyle('E36:G36')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('F36', "Orientasi Pelayanan"); 
			$excel->getActiveSheet()->mergeCells('F36:G36');
		$excel->setActiveSheetIndex(0)->setCellValue('H36', $data_prilaku['orientasi'])->getStyle('H36')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('I36', $orientasi)->getStyle('I36')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->getStyle('J36:J43')->applyFromArray($style_row);

		if($data_prilaku['integritas'] <= 50){
			$integritas = "(Buruk)";
		} else if($data_prilaku['integritas'] <= 60 && $data_prilaku['integritas'] >= 50){
			$integritas = "(Sedang)";
		} else if($data_prilaku['integritas'] <= 75 && $data_prilaku['integritas'] >= 60){
			$integritas = "(Cukup)";
		} else if($data_prilaku['integritas'] <= 90.99 && $data_prilaku['integritas'] >= 75){
			$integritas = "(Baik)";
		} else if($data_prilaku['integritas'] <= 100 && $data_prilaku['integritas'] >= 90.99){
			$integritas = "(Sangat Baik)";
		}
		$excel->setActiveSheetIndex(0)->setCellValue('E37', "2.")->getStyle('E37:G37')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('F37', "Integritas"); 
			$excel->getActiveSheet()->mergeCells('F37:G37');
		$excel->setActiveSheetIndex(0)->setCellValue('H37', $data_prilaku['integritas'])->getStyle('H37')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('I37', $integritas)->getStyle('I37')->applyFromArray($style_row);

		if($data_prilaku['komitmen'] <= 50){
			$komitmen = "(Buruk)";
		} else if($data_prilaku['komitmen'] <= 60 && $data_prilaku['komitmen'] >= 50){
			$komitmen = "(Sedang)";
		} else if($data_prilaku['komitmen'] <= 75 && $data_prilaku['komitmen'] >= 60){
			$komitmen = "(Cukup)";
		} else if($data_prilaku['komitmen'] <= 90.99 && $data_prilaku['komitmen'] >= 75){
			$komitmen = "(Baik)";
		} else if($data_prilaku['komitmen'] <= 100 && $data_prilaku['komitmen'] >= 90.99){
			$komitmen = "(Sangat Baik)";
		}
		$excel->setActiveSheetIndex(0)->setCellValue('E38', "3.")->getStyle('E38:G38')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('F38', "Komitmen"); 
			$excel->getActiveSheet()->mergeCells('F38:G38');
		$excel->setActiveSheetIndex(0)->setCellValue('H38', $data_prilaku['komitmen'])->getStyle('H38')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('I38', $komitmen)->getStyle('I38')->applyFromArray($style_row);

		if($data_prilaku['disiplin'] <= 50){
			$disiplin = "(Buruk)";
		} else if($data_prilaku['disiplin'] <= 60 && $data_prilaku['disiplin'] >= 50){
			$disiplin = "(Sedang)";
		} else if($data_prilaku['disiplin'] <= 75 && $data_prilaku['disiplin'] >= 60){
			$disiplin = "(Cukup)";
		} else if($data_prilaku['disiplin'] <= 90.99 && $data_prilaku['disiplin'] >= 75){
			$disiplin = "(Baik)";
		} else if($data_prilaku['disiplin'] <= 100 && $data_prilaku['disiplin'] >= 90.99){
			$disiplin = "(Sangat Baik)";
		}
		$excel->setActiveSheetIndex(0)->setCellValue('E39', "4.")->getStyle('E39:G39')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('F39', "Disiplin"); 
			$excel->getActiveSheet()->mergeCells('F39:G39');
		$excel->setActiveSheetIndex(0)->setCellValue('H39', $data_prilaku['disiplin'])->getStyle('H39')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('I39', $disiplin)->getStyle('I39')->applyFromArray($style_row);

		if($data_prilaku['kerjasama'] <= 50){
			$kerjasama = "(Buruk)";
		} else if($data_prilaku['kerjasama'] <= 60 && $data_prilaku['kerjasama'] >= 50){
			$kerjasama = "(Sedang)";
		} else if($data_prilaku['kerjasama'] <= 75 && $data_prilaku['kerjasama'] >= 60){
			$kerjasama = "(Cukup)";
		} else if($data_prilaku['kerjasama'] <= 90.99 && $data_prilaku['kerjasama'] >= 75){
			$kerjasama = "(Baik)";
		} else if($data_prilaku['kerjasama'] <= 100 && $data_prilaku['kerjasama'] >= 90.99){
			$kerjasama = "(Sangat Baik)";
		}
		$excel->setActiveSheetIndex(0)->setCellValue('E40', "5.")->getStyle('E40:G40')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('F40', "Kerjasama"); 
			$excel->getActiveSheet()->mergeCells('F40:G40');
		$excel->setActiveSheetIndex(0)->setCellValue('H40', $data_prilaku['kerjasama'])->getStyle('H40')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('I40', $kerjasama)->getStyle('I40')->applyFromArray($style_row);


		if($data_prilaku['kepemimpinan'] <= 50){
			$orientasi = "(Buruk)";
		} else if($data_prilaku['kepemimpinan'] <= 60 && $data_prilaku['kepemimpinan'] >= 50){
			$kepemimpinan = "(Sedang)";
		} else if($data_prilaku['kepemimpinan'] <= 75 && $data_prilaku['kepemimpinan'] >= 60){
			$kepemimpinan = "(Cukup)";
		} else if($data_prilaku['kepemimpinan'] <= 90.99 && $data_prilaku['kepemimpinan'] >= 75){
			$kepemimpinan = "(Baik)";
		} else if($data_prilaku['kepemimpinan'] <= 100 && $data_prilaku['kepemimpinan'] >= 90.99){
			$kepemimpinan = "(Sangat Baik)";
		}
		$excel->setActiveSheetIndex(0)->setCellValue('E41', "6.")->getStyle('E41:G41')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('F41', "Kepemimpinan"); 
			$excel->getActiveSheet()->mergeCells('F41:G41');
		$excel->setActiveSheetIndex(0)->setCellValue('H41', $data_prilaku['kepemimpinan'])->getStyle('H41')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('I41', $kepemimpinan)->getStyle('I41')->applyFromArray($style_row);

		$jumlah = $data_prilaku['orientasi'] + $data_prilaku['integritas'] + $data_prilaku['komitmen'] + $data_prilaku['disiplin'] + $data_prilaku['kerjasama'] + $data_prilaku['kepemimpinan'];
		$excel->setActiveSheetIndex(0)->setCellValue('E42', "Jumlah")->getStyle('E42:G42')->applyFromArray($style_row);
			$excel->getActiveSheet()->mergeCells('E42:G42');
		$excel->setActiveSheetIndex(0)->setCellValue('H42', $jumlah)->getStyle('H42')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('I42', "-")->getStyle('I42')->applyFromArray($style_row);

		$rt = $jumlah / 6;
		if($rt <= 50){
			$rt_d = "(Buruk)";
		} else if($rt <= 60 && $rt >= 50){
			$rt_d = "(Sedang)";
		} else if($rt <= 75 && $rt >= 60){
			$rt_d = "(Cukup)";
		} else if($rt <= 90.99 && $rt >= 75){
			$rt_d = "(Baik)";
		} else if($rt <= 100 && $rt >= 90.99){
			$rt_d = "(Sangat Baik)";
		}
		$excel->setActiveSheetIndex(0)->setCellValue('E43', "Nilai Rata-rata")->getStyle('E43:G43')->applyFromArray($style_row);
			$excel->getActiveSheet()->mergeCells('E43:G43');
		$excel->setActiveSheetIndex(0)->setCellValue('H43', round($rt, 2))->getStyle('H43')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('I43', $rt_d)->getStyle('I43')->applyFromArray($style_row);

		$np = $rt * 0.4;
		$excel->setActiveSheetIndex(0)->setCellValue('E44', "Nilai Prilaku Kerja")->getStyle('E44:I44')->applyFromArray($style_row);
			$excel->getActiveSheet()->mergeCells('E44:G44');
		$excel->setActiveSheetIndex(0)->setCellValue('H44', round($rt, 2));
		$excel->setActiveSheetIndex(0)->setCellValue('I44', "x 40%");
		$excel->setActiveSheetIndex(0)->setCellValue('J44', round($np, 2))->getStyle('J44')->applyFromArray($style_row);


		$n_akhir = ($nskp * 0.6) + $np;
		if($n_akhir <= 50){
			$n_akhir_d = "(Buruk)";
		} else if($n_akhir <= 60 && $n_akhir >= 50){
			$n_akhir_d = "(Sedang)";
		} else if($n_akhir <= 75 && $n_akhir >= 60){
			$n_akhir_d = "(Cukup)";
		} else if($n_akhir <= 90.99 && $n_akhir >= 75){
			$n_akhir_d = "(Baik)";
		} else if($n_akhir <= 100 && $n_akhir >= 90.99){
			$n_akhir_d = "(Sangat Baik)";
		}
		$excel->setActiveSheetIndex(0)->setCellValue('A45', "Nilai Prestasi Kerja")->getStyle('A44:I47')->applyFromArray($style_row);
			$excel->getActiveSheet()->mergeCells('A45:I47');
		$excel->setActiveSheetIndex(0)->setCellValue('J45', round($n_akhir, 2));
			$excel->getActiveSheet()->mergeCells('J45:J46');
		$excel->setActiveSheetIndex(0)->setCellValue('J47', $n_akhir_d)->getStyle('J45:J47')->applyFromArray($style_row);

		$excel->setActiveSheetIndex(0)->setCellValue('A48', "5. ");
		$excel->setActiveSheetIndex(0)->setCellValue('B48', "KEBERATAN DARI PEGAWAI NEGERI SIPIL")->getStyle('A48:J54')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('B49', "YANG DINILAI (APABILA ADA)");
		$excel->setActiveSheetIndex(0)->setCellValue('I53', "Tanggal ....................................");
		
		$excel->setActiveSheetIndex(0)->setCellValue('A55', "6. ");
		$excel->setActiveSheetIndex(0)->setCellValue('B55', "TANGGAPAN PEJABAT PENILAI ATAS KEBERATAN")->getStyle('A55:J68')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('I67', "Tanggal ....................................");
		
		$excel->setActiveSheetIndex(0)->setCellValue('A69', "7. ");
		$excel->setActiveSheetIndex(0)->setCellValue('B69', "KEPUTUSAN ATASAN PEJABAT PENILAI")->getStyle('A69:J79')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('B70', "ATAS KEBERATAN");
		$excel->setActiveSheetIndex(0)->setCellValue('I78', "Tanggal ....................................");

		$excel->setActiveSheetIndex(0)->setCellValue('A80', "8. ");
		$excel->setActiveSheetIndex(0)->setCellValue('B80', "REKOMENDASI")->getStyle('A80:J89')->applyFromArray($style_row);

		$waktu_ajuan = explode("-", $data_prilaku['tgl_ajuan']);
		
		// var_dump($waktu_ajuan); die();
		if($waktu_ajuan[1] == 01){
			$bulan = "Januari";
		}else if($waktu_ajuan[1] == 02)  {
			$bulan = "Februari";
		}else if($waktu_ajuan[1] == 03){
			$bulan = "Maret";
		}else if($waktu_ajuan[1] == 12){
			$bulan = "Desember";
		}else if($waktu_ajuan[1] == 11){
			$bulan = "November";
		}else if($waktu_ajuan[1] == 10){
			$bulan = "Oktober";
		}else if($waktu_ajuan[1] == 9){
			$bulan = "September";
		} else {
			$bulan = "unknown mount";
		}
		
		$waktu_ajuan_tanggal = substr($waktu_ajuan[2],0,-9);

		$excel->setActiveSheetIndex(0)->setCellValue('G90', "9. ");
		$excel->setActiveSheetIndex(0)->setCellValue('H90', " DIBUAT TANGGAL,  ".$waktu_ajuan_tanggal." ".$bulan." ".$waktu_ajuan[0])->getStyle('A90:J117')->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('H91', "PEJABAT PENILAI");
			$excel->getActiveSheet()->mergeCells('H91:J91');
		$excel->setActiveSheetIndex(0)->setCellValue('H96', $data_penilai['nama']);
			$excel->getActiveSheet()->mergeCells('H96:J96');
		$excel->setActiveSheetIndex(0)->setCellValue('H97', "'".$data_penilai['nip']);
			$excel->getActiveSheet()->mergeCells('H97:J97');

		$excel->setActiveSheetIndex(0)->setCellValue('A99', "10. ");
		$excel->setActiveSheetIndex(0)->setCellValue('B99', " DITERIMA TANGGAL,  ".$waktu_ajuan_tanggal." ".$bulan." ".$waktu_ajuan[0]);
			$excel->getActiveSheet()->mergeCells('B99:F99');
		$excel->setActiveSheetIndex(0)->setCellValue('B100', "PEGAWAI NEGERI SIPIL YANG DINILAI,");
			$excel->getActiveSheet()->mergeCells('B100:F100');
		$excel->setActiveSheetIndex(0)->setCellValue('B105', $data_pegawai['nama']);
			$excel->getActiveSheet()->mergeCells('B105:F105');
		$excel->setActiveSheetIndex(0)->setCellValue('B106', "'".$data_pegawai['nip']);
			$excel->getActiveSheet()->mergeCells('B106:F106');
			
		$tahun_terima = date("Y");
		$bulan_terima = date("m");
			if($bulan_terima == 01){
				$bulan_terima = "Januari";
			}else if($bulan_terima == 02)  {
				$bulan_terima = "Februari";
			}else if($bulan_terima == 03){
				$bulan_terima = "Maret";
			}else if($bulan_terima == 12){
				$bulan_terima = "Desember";
			}else if($bulan_terima == 11){
				$bulan_terima = "November";
			}else if($bulan_terima == 10){
				$bulan_terima = "Oktober";
			}else if($bulan_terima == 9){
				$bulan_terima = "September";
			} else {
				$bulan_terima = "unknown mount";
			}
		$tanggal_terima = date("d");

		$excel->setActiveSheetIndex(0)->setCellValue('G108', "11. ");
		$excel->setActiveSheetIndex(0)->setCellValue('H108', " DITERIMA TANGGAL,  ".$tanggal_terima." ".$bulan_terima." ".$tahun_terima);
		$excel->setActiveSheetIndex(0)->setCellValue('H109', "ATASAN PEJABAT YANG MENILAI");
			$excel->getActiveSheet()->mergeCells('H109:J109');
		$excel->setActiveSheetIndex(0)->setCellValue('H114', $data_atasan['nama']);
			$excel->getActiveSheet()->mergeCells('H114:J114');
		$excel->setActiveSheetIndex(0)->setCellValue('H115', "'".$data_atasan['nip']);
			$excel->getActiveSheet()->mergeCells('H115:J115');

		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(4); 
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(3); 
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(6); 
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(4); 
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(3); 
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(21); 
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(9);
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(17);
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(12);

		$excel->getActiveSheet()->getRowDimension('15')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('16')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('17')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('18')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('19')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('20')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('21')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('22')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('23')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('24')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('25')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('26')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('27')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('28')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('29')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('30')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('31')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('32')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('33')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('36')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('37')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('38')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('39')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('40')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('41')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('42')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('43')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('44')->setRowHeight(30);
		
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		
		$excel->getActiveSheet(0)->setTitle("Data SKP");
		$excel->setActiveSheetIndex(0);
		
		$filename="DATA_SKP.xls";
		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
		ob_end_clean();
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$filename);
		$objWriter->save('php://output');

	}

	public function export_excel_2($id_skp)
	{
		$data['skp'] = $this->Skp_model->getById($id_skp);
		$data_penilai = $this->User_model->getById($data['skp']['penilai_id']);
		$data_pegawai = $this->User_model->getById($data['skp']['pegawai_id']);
		$this->db->where('rinci_skp_id', $id_skp);
		$data_rinci = $this->db->get('rincian')->result();

		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		$excel = new PHPExcel();
		$excel->getProperties()->setCreator('Budi Dharmawan')
					->setLastModifiedBy('Budi Dharmawan')
					->setTitle("SASARAN KERJA")
					->setSubject("SKP2")
					->setDescription("Lembar2 Pengajuan SKP ")
					->setKeywords("Lembar SKP");
		
		$style_col = array(
		'font' => array('bold' => true), 
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER 
		),
		'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
		)
		);
		
		$style_row = array(
			'alignment' => array('vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER ),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN))
		);
		
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "FORMULIR SASARAN KERJA"); 
			$excel->getActiveSheet()->mergeCells('A1:K1'); 
			$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); 
			$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12); 
			$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			// $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);
		
		$excel->setActiveSheetIndex(0)->setCellValue('A2', "PEGAWAI NEGERI SIPIL"); 
			$excel->getActiveSheet()->mergeCells('A2:K2'); 
			$excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); 
			$excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12); 
			$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		
		//identitas pegawai dan penilai
		$excel->getActiveSheet()->getStyle('A4:K4')->getFont()->setBold(TRUE); 
		$excel->getActiveSheet()->getStyle('A4:K4')->getFont()->setSize(11);
		$excel->getActiveSheet()->getStyle('A4')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('B4:D4')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('E4')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('F4:K4')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('A5:A9')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('B5:B9')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('C5:D9')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('E5:E9')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('F5:G9')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('H5:K9')->applyFromArray($style_row);

		$excel->setActiveSheetIndex(0)->setCellValue('A4', "NO"); 
		$excel->setActiveSheetIndex(0)->setCellValue('B4', "I. PEJABAT PENILAI"); 
			$excel->getActiveSheet()->mergeCells('B4:D4');
		$excel->setActiveSheetIndex(0)->setCellValue('E4', "NO"); 
		$excel->setActiveSheetIndex(0)->setCellValue('F4', "II. PEGAWAI NEGERI SIPIL YANG DINILAI"); 
			$excel->getActiveSheet()->mergeCells('F4:K4');

		$excel->setActiveSheetIndex(0)->setCellValue('A5', " 1.");
		$excel->setActiveSheetIndex(0)->setCellValue('B5', "Nama");
		$excel->setActiveSheetIndex(0)->setCellValue('C5', $data_pegawai['nama']);
			$excel->getActiveSheet()->mergeCells('C5:D5');
		$excel->setActiveSheetIndex(0)->setCellValue('E5', " 1.");
		$excel->setActiveSheetIndex(0)->setCellValue('F5', "Nama");
			$excel->getActiveSheet()->mergeCells('F5:G5'); 
		$excel->setActiveSheetIndex(0)->setCellValue('H5', $data_penilai['nama']);
			$excel->getActiveSheet()->mergeCells('H5:K5'); 

		$excel->setActiveSheetIndex(0)->setCellValue('A6', " 2.");
		$excel->setActiveSheetIndex(0)->setCellValue('B6', "NIP");
		$excel->setActiveSheetIndex(0)->setCellValue('C6', "'".$data_pegawai['nip']);
			$excel->getActiveSheet()->mergeCells('C6:D6');
		$excel->setActiveSheetIndex(0)->setCellValue('E6', " 2.");
		$excel->setActiveSheetIndex(0)->setCellValue('F6', "NIP");
			$excel->getActiveSheet()->mergeCells('F6:G6'); 
		$excel->setActiveSheetIndex(0)->setCellValue('H6', "'".$data_penilai['nip']);
			$excel->getActiveSheet()->mergeCells('H6:K6'); 

		$excel->setActiveSheetIndex(0)->setCellValue('A7', " 3.");
		$excel->setActiveSheetIndex(0)->setCellValue('B7', "Pangkat/Gol.Ruang");
		$excel->setActiveSheetIndex(0)->setCellValue('C7', $data_pegawai['pangkat_golongan']);
			$excel->getActiveSheet()->mergeCells('C7:D7');
		$excel->setActiveSheetIndex(0)->setCellValue('E7', " 3.");
		$excel->setActiveSheetIndex(0)->setCellValue('F7', "Pangkat/Gol.Ruang");
			$excel->getActiveSheet()->mergeCells('F7:G7'); 
		$excel->setActiveSheetIndex(0)->setCellValue('H7', $data_penilai['pangkat_golongan']);
			$excel->getActiveSheet()->mergeCells('H7:K7'); 

		$excel->setActiveSheetIndex(0)->setCellValue('A8', " 4.");
		$excel->setActiveSheetIndex(0)->setCellValue('B8', "Jabatan");
		$excel->setActiveSheetIndex(0)->setCellValue('C8', $data_pegawai['jabatan']);
			$excel->getActiveSheet()->mergeCells('C8:D8');
		$excel->setActiveSheetIndex(0)->setCellValue('E8', " 4.");
		$excel->setActiveSheetIndex(0)->setCellValue('F8', "Jabatan");
			$excel->getActiveSheet()->mergeCells('F8:G8'); 
		$excel->setActiveSheetIndex(0)->setCellValue('H8', $data_penilai['jabatan']);
			$excel->getActiveSheet()->mergeCells('H8:K8'); 

		$excel->setActiveSheetIndex(0)->setCellValue('A9', " 5.");
		$excel->setActiveSheetIndex(0)->setCellValue('B9', "Unit Kerja");
		$excel->setActiveSheetIndex(0)->setCellValue('C9', $data_pegawai['unit_kerja']);
			$excel->getActiveSheet()->mergeCells('C9:D9');
		$excel->setActiveSheetIndex(0)->setCellValue('E9', " 5.");
		$excel->setActiveSheetIndex(0)->setCellValue('F9', "Unit Kerja");
			$excel->getActiveSheet()->mergeCells('F9:G9');
		$excel->setActiveSheetIndex(0)->setCellValue('H9', $data_penilai['unit_kerja']);
			$excel->getActiveSheet()->mergeCells('H9:K9'); 

		//data rinci skp
		$excel->getActiveSheet()->getStyle('A10:K11')->getFont()->setBold(TRUE); 
		$excel->getActiveSheet()->getStyle('A10:K11')->getFont()->setSize(11);
		$excel->getActiveSheet()->getStyle('A10:A11')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('B10:D11')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('E10:E11')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('F10:K10')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('F11:G11')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('H11')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('I11:J11')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('K11')->applyFromArray($style_row);

		$excel->setActiveSheetIndex(0)->setCellValue('A10', "NO"); 
			$excel->getActiveSheet()->mergeCells('A10:A11');
		$excel->setActiveSheetIndex(0)->setCellValue('B10', "III. KEGIATAN TUGAS JABATAN"); 
			$excel->getActiveSheet()->mergeCells('B10:D11');
		$excel->setActiveSheetIndex(0)->setCellValue('E10', "AK"); 
			$excel->getActiveSheet()->mergeCells('E10:E11');
		$excel->setActiveSheetIndex(0)->setCellValue('F10', "TARGET"); 
			$excel->getActiveSheet()->mergeCells('F10:K10');
			$excel->getActiveSheet()->getStyle('F10:K11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$excel->setActiveSheetIndex(0)->setCellValue('F11', "KUANTITAS/OUTPUT"); 
			$excel->getActiveSheet()->mergeCells('F11:G11');	
		$excel->setActiveSheetIndex(0)->setCellValue('H11', "KUALITAS/MUTU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('I11', "WAKTU"); 
			$excel->getActiveSheet()->mergeCells('I11:J11');	
		$excel->setActiveSheetIndex(0)->setCellValue('K11', "BIAYA");

		$no = 1; 
		$numrow = 12; 
		foreach($data_rinci as $data){ 
		$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, " ".$no.".");
		$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->rinci_kegiatan);
			$excel->getActiveSheet()->mergeCells('B'.$numrow.':'.'D'.$numrow);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->getAlignment()->setWrapText(true);
		$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, "   0");
		$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->rinci_target);
		$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->rinci_satuan);
		$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, "'100");
		$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, "'12");
		$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, "bulan");
		$excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, "  -");

		$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('B'.$numrow.':'.'D'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('F'.$numrow.':'.'G'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('I'.$numrow.':'.'J'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);

		$excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(31);
		
		$no++; 
		$numrow++; 
		}

		$this->db->where('id', $id_skp);
		$data_skp = $this->db->get('skp')->row_array();

		$waktu_ajuan = explode("-", $data_skp['tgl_ajuan']);
		if($waktu_ajuan[1] == 01){
			$bulan = "Januari";
		}else if($waktu_ajuan[1] == 02)  {
			$bulan = "Februari";
		}else if($waktu_ajuan[1] == 03){
			$bulan = "Maret";
		}else if($waktu_ajuan[1] == 12){
			$bulan = "Desember";
		}else if($waktu_ajuan[1] == 11){
			$bulan = "November";
		}else if($waktu_ajuan[1] == 10){
			$bulan = "Oktober";
		}else if($waktu_ajuan[1] == 9){
			$bulan = "September";
		} else {
			$bulan = "unknown mount";
		}
		
		$waktu_ajuan_tanggal = substr($waktu_ajuan[2],0,-9);

		$row = $numrow + 2;
		$excel->setActiveSheetIndex(0)->setCellValue('G'.$row, "Bungku, ".$waktu_ajuan_tanggal." ".$bulan." ".$waktu_ajuan[0]); 
			$excel->getActiveSheet()->mergeCells('G'.$row.':'.'K'.$row);
			$excel->getActiveSheet()->getStyle('G'.$row.':'.'K'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$row = $numrow + 3;
		$excel->setActiveSheetIndex(0)->setCellValue('A'.$row, "Pejabat Penilai,"); 
			$excel->getActiveSheet()->mergeCells('A'.$row.':'.'C'.$row);
			$excel->getActiveSheet()->getStyle('A'.$row.':'.'C'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$excel->setActiveSheetIndex(0)->setCellValue('G'.$row, "Pegawai Negeri Sipil Yang Dinilai"); 
			$excel->getActiveSheet()->mergeCells('G'.$row.':'.'K'.$row);
			$excel->getActiveSheet()->getStyle('G'.$row.':'.'K'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$row = $numrow + 8;
		$excel->setActiveSheetIndex(0)->setCellValue('A'.$row, $data_penilai['nama']); 
			$excel->getActiveSheet()->mergeCells('A'.$row.':'.'C'.$row);
			$excel->getActiveSheet()->getStyle('A'.$row.':'.'C'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$excel->setActiveSheetIndex(0)->setCellValue('G'.$row, $data_pegawai['nama']); 
			$excel->getActiveSheet()->mergeCells('G'.$row.':'.'K'.$row);
			$excel->getActiveSheet()->getStyle('G'.$row.':'.'K'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$row = $numrow + 9;
		$excel->setActiveSheetIndex(0)->setCellValue('A'.$row, " ".$data_penilai['nip']); 
			$excel->getActiveSheet()->mergeCells('A'.$row.':'.'C'.$row);
			$excel->getActiveSheet()->getStyle('A'.$row.':'.'C'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$excel->setActiveSheetIndex(0)->setCellValue('G'.$row, " ".$data_pegawai['nip']); 
			$excel->getActiveSheet()->mergeCells('G'.$row.':'.'K'.$row);
			$excel->getActiveSheet()->getStyle('G'.$row.':'.'K'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		$row = $numrow + 11;
		$excel->setActiveSheetIndex(0)->setCellValue('A'.$row, "Catatan :");
		$row = $numrow + 12;
		$excel->setActiveSheetIndex(0)->setCellValue('A'.$row, "* AK Bagi PNS yang memangku jabatan fungsional tertentu");

		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(17); 
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(45); 
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(4); 
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(5); 
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(9); 
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(16);
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(5);
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(8);
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(13);

		$excel->getActiveSheet()->getRowDimension('4')->setRowHeight(19);
		$excel->getActiveSheet()->getRowDimension('5')->setRowHeight(19);
		$excel->getActiveSheet()->getRowDimension('6')->setRowHeight(19);
		$excel->getActiveSheet()->getRowDimension('7')->setRowHeight(19);
		$excel->getActiveSheet()->getRowDimension('8')->setRowHeight(19);
		$excel->getActiveSheet()->getRowDimension('9')->setRowHeight(19);
		$excel->getActiveSheet()->getRowDimension('10')->setRowHeight(19);
		$excel->getActiveSheet()->getRowDimension('11')->setRowHeight(19);
		
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-2);
		
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		
		$excel->getActiveSheet(0)->setTitle("Sasaran Kerja");
		$excel->setActiveSheetIndex(0);
		
		$filename="SASARAN_KERJA.xls";
		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
		ob_end_clean();
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$filename);
		$objWriter->save('php://output');

	}

	public function export_excel_3($id_skp)
	{
		$data['skp'] = $this->Skp_model->getById($id_skp);
		$data_penilai = $this->User_model->getById($data['skp']['penilai_id']);
		$data_pegawai = $this->User_model->getById($data['skp']['pegawai_id']);
		$this->db->where('rinci_skp_id', $id_skp);
		$data_rinci = $this->db->get('rincian')->result();

		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		$excel = new PHPExcel();
		$excel->getProperties()->setCreator('Budi Dharmawan')
					->setLastModifiedBy('Budi Dharmawan')
					->setTitle("Capaian KERJA")
					->setSubject("SKP3")
					->setDescription("Lembar3 Pengajuan SKP ")
					->setKeywords("Lembar SKP");
		
		$style_col = array(
		'font' => array('bold' => true), 
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER 
		),
		'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
		)
		);
		
		$style_row = array(
			'alignment' => array('vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER ),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN))
		);
		
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "PENILAIAN CAPAIAN SASARAN KERJA"); 
			$excel->getActiveSheet()->mergeCells('A1:T1'); 
			$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); 
			$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12); 
			$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		$excel->setActiveSheetIndex(0)->setCellValue('A2', "PEGAWAI NEGERI SIPIL"); 
			$excel->getActiveSheet()->mergeCells('A2:T2'); 
			$excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); 
			$excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12); 
			$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		$excel->setActiveSheetIndex(0)->setCellValue('A4', "Jangka Waktu Penilaian"); 
		$excel->setActiveSheetIndex(0)->setCellValue('A5', "Januari  s/d Desember 2020"); 
		
		$excel->getActiveSheet()->getStyle('A6:A7')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('B6:B7')->applyFromArray($style_row);
		
		$excel->getActiveSheet()->getStyle('C6:C7')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('D6:I6')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('D7:E7')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('F7')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('G7:H7')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('I7')->applyFromArray($style_row);
		
		$excel->getActiveSheet()->getStyle('J6:J7')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('K6:P6')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('K7:L7')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('M7')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('N7:O7')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('P7')->applyFromArray($style_row);

		$excel->getActiveSheet()->getStyle('Q6:Q7')->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('R6:R7')->applyFromArray($style_row);

		$excel->setActiveSheetIndex(0)->setCellValue('A6', "NO"); 
			$excel->getActiveSheet()->mergeCells('A6:A7');
		$excel->setActiveSheetIndex(0)->setCellValue('B6', "I. KEGIATAN TUGAS TAMABAHAN"); 
			$excel->getActiveSheet()->mergeCells('B6:B7');

		$excel->setActiveSheetIndex(0)->setCellValue('C6', "AK"); 
			$excel->getActiveSheet()->mergeCells('C6:C7');
		$excel->setActiveSheetIndex(0)->setCellValue('D6', "TARGET"); 
			$excel->getActiveSheet()->mergeCells('D6:I6');
		$excel->setActiveSheetIndex(0)->setCellValue('D7', "Kuantitas/Output"); 
			$excel->getActiveSheet()->mergeCells('D7:E7');
		$excel->setActiveSheetIndex(0)->setCellValue('F7', "Kualitas/Mutu"); 
		$excel->setActiveSheetIndex(0)->setCellValue('G7', "Waktu");
			$excel->getActiveSheet()->mergeCells('G7:H7');
		$excel->setActiveSheetIndex(0)->setCellValue('I7', "Biaya");

		$excel->setActiveSheetIndex(0)->setCellValue('J6', "AK"); 
			$excel->getActiveSheet()->mergeCells('J6:J7');
		$excel->setActiveSheetIndex(0)->setCellValue('K6', "REALISASI"); 
			$excel->getActiveSheet()->mergeCells('K6:P6');
		$excel->setActiveSheetIndex(0)->setCellValue('K7', "Kuantitas/Output"); 
			$excel->getActiveSheet()->mergeCells('K7:L7');
		$excel->setActiveSheetIndex(0)->setCellValue('M7', "Kualitas/Mutu"); 
		$excel->setActiveSheetIndex(0)->setCellValue('N7', "Waktu");
			$excel->getActiveSheet()->mergeCells('N7:O7');
		$excel->setActiveSheetIndex(0)->setCellValue('P7', "Biaya");

		$excel->setActiveSheetIndex(0)->setCellValue('Q6', "PENGHITUNGAN"); 
			$excel->getActiveSheet()->mergeCells('Q6:Q7');
		$excel->setActiveSheetIndex(0)->setCellValue('R6', "NILAI CAPAIAN SKP"); 
			$excel->getActiveSheet()->mergeCells('R6:R7');

		$excel->getActiveSheet()->getStyle('A6:R6')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('A6:R7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$excel->getActiveSheet()->getStyle('A6:R6')->getFont()->setSize(11);
		$excel->getActiveSheet()->getStyle('D7:I7')->getFont()->setSize(9);
		$excel->getActiveSheet()->getStyle('K7:P7')->getFont()->setSize(9);
		$excel->getActiveSheet()->getStyle('A6:R7')->getAlignment()->setWrapText(true);

		
		$excel->setActiveSheetIndex(0)->setCellValue('A8', "1")->getStyle('A8')->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('B8', "2")->getStyle('B8')->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('C8', "3")->getStyle('C8')->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('D8', "4")->getStyle('D8:E8')->applyFromArray($style_col);
			$excel->getActiveSheet()->mergeCells('D8:E8');
		$excel->setActiveSheetIndex(0)->setCellValue('F8', "5")->getStyle('F8')->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('G8', "6")->getStyle('G8:H8')->applyFromArray($style_col);
			$excel->getActiveSheet()->mergeCells('G8:H8');
		$excel->setActiveSheetIndex(0)->setCellValue('I8', "7")->getStyle('I8')->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('J8', "8")->getStyle('J8')->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('K8', "9")->getStyle('K8:L8')->applyFromArray($style_col);
			$excel->getActiveSheet()->mergeCells('K8:L8');
		$excel->setActiveSheetIndex(0)->setCellValue('M8', "10")->getStyle('M8')->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('N8', "11")->getStyle('N8:O8')->applyFromArray($style_col);
			$excel->getActiveSheet()->mergeCells('N8:O8');
		$excel->setActiveSheetIndex(0)->setCellValue('P8', "12")->getStyle('P8')->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('Q8', "13")->getStyle('Q8')->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('R8', "14")->getStyle('R8')->applyFromArray($style_col);

		$excel->getSheet(0)->getStyle('A8:R8')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$excel->getSheet(0)->getStyle('A8:R8')->getFill()->getStartColor()->setRGB('AEAEAE');
		$excel->getActiveSheet()->getStyle('A8:R8')->getFont()->setSize(8);

		$no = 1; 
		$numrow = 9;
		$total = 0;
		foreach($data_rinci as $data){ 
		$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, " ".$no.".");
		$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->rinci_kegiatan)->getStyle('B'.$numrow)->getAlignment()->setWrapText(true);
		$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, "  0");
		$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->rinci_target);
		$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->rinci_satuan);
		$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, "  100");
		$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, "12");
		$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, "bulan");
		$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, "   -");
		$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, "  0");
		$excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->rinci_target);
		$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data->rinci_satuan);
		$excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, "  100");
		$excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, "12");
		$excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, "bulan");
		$excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, "   -");
		
		$a = $data->rinci_realisasi / $data->rinci_target * 100;
		$b = $data->rinci_mutu;
		$c = 76;
		$jumlah = $a+$b+$c;
		$rata_rata = round($jumlah/3, 2);
		$total = $total+$rata_rata;
		$excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, "      ".$jumlah);
		$excel->setActiveSheetIndex(0)->setCellValue('R'.$numrow, "      ".$rata_rata);

		$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('D'.$numrow.':'.'E'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('G'.$numrow.':'.'H'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('K'.$numrow.':'.'L'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('N'.$numrow.':'.'O'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('P'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('Q'.$numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('R'.$numrow)->applyFromArray($style_row);
		
		$excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(41);

		$no++; 
		$numrow++; 
		}


		$excel->getActiveSheet()->getStyle('A6:R7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$excel->getActiveSheet()->getStyle('A6:R6')->getFont()->setSize(11);
		$excel->getActiveSheet()->getStyle('D7:I7')->getFont()->setSize(9);
		$excel->getActiveSheet()->getStyle('K7:P7')->getFont()->setSize(9);
		$excel->getActiveSheet()->getStyle('A6:R7')->getAlignment()->setWrapText(true);

		$row = $numrow;
		$total = ($total/($no-1));
		if($total <= 50){
			$total_d = "(Buruk)";
		} else if($total <= 60 && $total >= 50){
			$total_d = "(Sedang)";
		} else if($total <= 75 && $total >= 60){
			$total_d = "(Cukup)";
		} else if($total <= 90.99 && $total >= 75){
			$total_d = "(Baik)";
		} else if($total <= 100 && $total >= 90.99){
			$total_d = "(Sangat Baik)";
		}
		$excel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('B'.$row, "II. TUGAS TAMBAHAN DAN KREATIFITAS :")->getStyle('B'.$row.':'.'R'.$row)->applyFromArray($style_row);
			$excel->getActiveSheet()->mergeCells('B'.$row.':'.'R'.$row);
		$excel->getActiveSheet()->getRowDimension($row)->setRowHeight(26);
		$excel->getActiveSheet()->getStyle('B'.$row)->getFont()->setBold(TRUE);

		$row = $row+1;
		$excel->setActiveSheetIndex(0)->setCellValue('A'.$row, "  1. ")->getStyle('A'.$row)->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('B'.$row, " (tugas tambahan) ")->getStyle('B'.$row)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('D'.$row.':'.'I'.$row)->applyFromArray($style_row);
			$excel->getActiveSheet()->mergeCells('D'.$row.':'.'I'.$row);
		$excel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('K'.$row.':'.'P'.$row)->applyFromArray($style_row);
			$excel->getActiveSheet()->mergeCells('K'.$row.':'.'P'.$row);
		$excel->getActiveSheet()->getStyle('Q'.$row)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('R'.$row)->applyFromArray($style_row);
		$excel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);

		$row = $row+1;
		$excel->setActiveSheetIndex(0)->setCellValue('A'.$row, "  2. ")->getStyle('A'.$row)->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('B'.$row, " (kreatifitas) ")->getStyle('B'.$row)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('D'.$row.':'.'I'.$row)->applyFromArray($style_row);
			$excel->getActiveSheet()->mergeCells('D'.$row.':'.'I'.$row);
		$excel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('K'.$row.':'.'P'.$row)->applyFromArray($style_row);
			$excel->getActiveSheet()->mergeCells('K'.$row.':'.'P'.$row);
		$excel->getActiveSheet()->getStyle('Q'.$row)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('R'.$row)->applyFromArray($style_row);
		$excel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);

		$row = $row+1;
		$excel->getActiveSheet()->getStyle('A'.$row.':'.'Q'.$row)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('R'.$row)->applyFromArray($style_row);
		
		$row = $row+1;
		$row_b = $row+1;
		$excel->setActiveSheetIndex(0)->setCellValue('A'.$row, "Nilai Capaian SKP");
		$excel->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('A'.$row.':'.'Q'.$row_b)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$excel->getActiveSheet()->getStyle('A'.$row.':'.'Q'.$row_b)->applyFromArray($style_col);
			$excel->getActiveSheet()->mergeCells('A'.$row.':'.'Q'.$row_b);
		$excel->setActiveSheetIndex(0)->setCellValue('R'.$row, round($total, 2));
		$excel->getActiveSheet()->getStyle('R'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$excel->getActiveSheet()->getStyle('R'.$row)->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('R'.$row)->applyFromArray($style_row);
		$excel->setActiveSheetIndex(0)->setCellValue('R'.$row_b, $total_d);
		$excel->getActiveSheet()->getStyle('R'.$row_b)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$excel->getActiveSheet()->getStyle('R'.$row_b)->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('R'.$row_b)->applyFromArray($style_row);
		
		$row = $row+3;
		$this->db->where('id', $id_skp);
		$data_skp = $this->db->get('skp')->row_array();
		$waktu_ajuan = explode("-", $data_skp['tgl_ajuan']);
		if($waktu_ajuan[1] == 01){
			$bulan = "Januari";
		}else if($waktu_ajuan[1] == 02)  {
			$bulan = "Februari";
		}else if($waktu_ajuan[1] == 03){
			$bulan = "Maret";
		}else if($waktu_ajuan[1] == 12){
			$bulan = "Desember";
		}else if($waktu_ajuan[1] == 11){
			$bulan = "November";
		}else if($waktu_ajuan[1] == 10){
			$bulan = "Oktober";
		}else if($waktu_ajuan[1] == 9){
			$bulan = "September";
		} else {
			$bulan = "unknown mount";
		}
		
		$waktu_ajuan_tanggal = substr($waktu_ajuan[2],0,-9);
		$excel->setActiveSheetIndex(0)->setCellValue('M'.$row, "Bungku, ".$waktu_ajuan_tanggal." ".$bulan." ".$waktu_ajuan[0]); 
			$excel->getActiveSheet()->mergeCells('M'.$row.':'.'R'.$row);
			$excel->getActiveSheet()->getStyle('M'.$row.':'.'R'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		$row = $row+1;
		$excel->setActiveSheetIndex(0)->setCellValue('M'.$row, "Pejabat Penilai,");
			$excel->getActiveSheet()->mergeCells('M'.$row.':'.'R'.$row);
			$excel->getActiveSheet()->getStyle('M'.$row.':'.'R'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$row = $row+4;
		$excel->setActiveSheetIndex(0)->setCellValue('M'.$row, " ".$data_penilai['nama']); 
			$excel->getActiveSheet()->mergeCells('M'.$row.':'.'R'.$row);
			$excel->getActiveSheet()->getStyle('M'.$row.':'.'R'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$excel->getActiveSheet()->getStyle('M'.$row)->getFont()->setBold(TRUE);
		$row = $row+1;
		$excel->setActiveSheetIndex(0)->setCellValue('M'.$row, " ".$data_penilai['nip']); 
			$excel->getActiveSheet()->mergeCells('M'.$row.':'.'R'.$row);
			$excel->getActiveSheet()->getStyle('M'.$row.':'.'R'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(50); 
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(4); 
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(5); 
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(9); 
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(6); 
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(4);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(6);
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(6);
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(4); 
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(5); 
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(9); 
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(6); 
		$excel->getActiveSheet()->getColumnDimension('N')->setWidth(4);
		$excel->getActiveSheet()->getColumnDimension('O')->setWidth(6);
		$excel->getActiveSheet()->getColumnDimension('P')->setWidth(6);
		$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('R')->setWidth(11);

		$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(15);
		$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(15);
		$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(15);
		$excel->getActiveSheet()->getRowDimension('4')->setRowHeight(15);
		$excel->getActiveSheet()->getRowDimension('5')->setRowHeight(15);
		$excel->getActiveSheet()->getRowDimension('6')->setRowHeight(17);
		$excel->getActiveSheet()->getRowDimension('7')->setRowHeight(28);
		$excel->getActiveSheet()->getRowDimension('8')->setRowHeight(10);
		
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-2);
		
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		
		$excel->getActiveSheet(0)->setTitle("Capaian Kerja");
		$excel->setActiveSheetIndex(0);
		
		$filename="CAPAIAN_KERJA.xls";
		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
		ob_end_clean();
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$filename);
		$objWriter->save('php://output');
	}

}
