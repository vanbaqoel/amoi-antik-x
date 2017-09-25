<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mbooking extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getCity()
    {
        $sql = "SELECT
                    a.kd_kota,
                    a.nm_kota,
                    b.kd_provinsi,
                    b.nm_provinsi
                FROM ref_kota a JOIN ref_provinsi b
                ON a.kd_provinsi = b.kd_provinsi
                WHERE 
                    a.deleted = 0 AND 
                    b.deleted = 0
                ORDER BY b.kd_provinsi, a.nm_kota";

        $query = $this->db->query($sql);

        return $query->result();
    }
    
    public function getKatTanggal($tanggal)
    {
        $sql =
        "SELECT kd_kat_kalender
        FROM ref_kalender
        WHERE tanggal = '$tanggal'";

        $query = $this->db->query($sql);

        return $query->row()->kd_kat_kalender;
    }

    public function getJadwal($tanggal, $dari, $ke, $jml_penumpang)
	{
		$kat = $this->getKatTanggal($tanggal);

		$query = $this->db->query("CALL filltempseats('$tanggal', '$dari', '$ke', 0, 1, 0)");
		// $query->next_result();
		// $query->free_result();

		$sql = "SELECT 
					l.kd_tiket, 
					l.nm_kota_asal, 
					l.bpoint_asal, 
					l.nm_kota_tujuan, 
					l.bpoint_tujuan, 
					l.via, 
					m.deskripsi kelas, 
					l.pergi, 
					l.lama_jalan, 
					l.harga, 
					m.seat, 
					m.fasilitas,
					l.kd_kelas
				FROM (
					SELECT 
						j.kd_tiket, 
						j.nm_kota_asal, 
						j.bpoint_asal, 
						j.nm_kota_tujuan, 
						k.deskripsi bpoint_tujuan, 
						j.via, 
						j.kd_kelas, 
						j.pergi, 
						j.lama_jalan, 
						j.harga 
					FROM (
						SELECT 
							h.kd_tiket, 
							h.nm_kota_asal, 
							i.deskripsi bpoint_asal, 
							h.nm_kota_tujuan, 
							h.kd_bpoint_tujuan, 
							h.via, 
							h.kd_kelas, 
							h.pergi, 
							h.lama_jalan, 
							h.harga 
						FROM (
							SELECT 
								f.kd_tiket, 
								f.nm_kota_asal, 
								f.kd_bpoint_asal, 
								g.nm_kota nm_kota_tujuan, 
								f.kd_bpoint_tujuan, 
								f.via, 
								f.kd_kelas, 
								f.pergi, 
								f.lama_jalan, 
								f.harga 
							FROM (
								SELECT 
									d.kd_tiket, 
									e.nm_kota nm_kota_asal, 
									d.kd_bpoint_asal, 
									d.kd_kota_tujuan, 
									d.kd_bpoint_tujuan, 
									d.via, 
									d.kd_kelas, 
									d.pergi, 
									d.lama_jalan, 
									d.harga 
								FROM (
									SELECT 
										b.kd_tiket, 
										c.kd_kota_asal, 
										c.kd_bpoint_asal, 
										c.kd_kota_tujuan, 
										c.kd_bpoint_tujuan, 
										c.via, 
                                        b.kd_kelas, 
										b.pergi, 
										b.lama_jalan, 
										b.harga 
									FROM (
										SELECT x.* 
										FROM (
											SELECT 
												a.kd_tiket, 
												a.kd_trayek, 
												a.kd_kelas, 
												a.pergi, 
												a.lama_jalan, 
												a.harga 
											FROM ref_tiket a
											JOIN (
												SELECT kd_kat_kalender
												FROM ref_kalender
												WHERE tanggal = '$tanggal'
											) b
											ON a.kd_kat_kalender = b.kd_kat_kalender
											WHERE
												a.deleted = 0 AND
												b.kd_kat_kalender = $kat AND
												(CASE WHEN b.kd_kat_kalender = 3
													THEN (a.aktif_dari <= '$tanggal' AND a.aktif_sampai >= '$tanggal')
													ELSE TRUE
												END) AND
												a.kd_trayek = (SELECT kd_trayek FROM ref_trayek WHERE kd_kota_asal = '$dari' AND kd_kota_tujuan = '$ke')
										) x 
										JOIN tmp_kursi_status y 
										ON x.kd_tiket = y.kd_tiket
										WHERE 
                                            y.kursi_avail >= $jml_penumpang AND
                                            y.tanggal = '$tanggal'
									) b 
									JOIN ref_trayek c 
									ON b.kd_trayek = c.kd_trayek
									WHERE 
										c.deleted = 0 AND 
										c.aktif = 1
								) d 
								JOIN ref_kota e 
								ON d.kd_kota_asal = e.kd_kota
							) f 
							JOIN ref_kota g 
							ON f.kd_kota_tujuan = g.kd_kota
						) h 
						JOIN ref_bpoint i 
						ON h.kd_bpoint_asal = i.kd_bpoint
					) j 
					JOIN ref_bpoint k 
					ON j.kd_bpoint_tujuan = k.kd_bpoint
				) l 
				JOIN ref_kelas m 
				ON l.kd_kelas = m.kd_kelas
                ORDER BY l.pergi, l.harga;";
		
		$query = $this->db->query($sql);
		
		return $query->result();
	}

	public function updateTempSeats($kd_tiket, $tanggal, $jml_penumpang)
	{
		$this->db->query("SELECT kd_tiket FROM tmp_kursi_status FOR UPDATE");
		$this->db->query("UPDATE tmp_kursi_status 
		SET 
			kursi_avail = kursi_avail - $jml_penumpang,
			kursi_booked = kursi_booked + $jml_penumpang
		WHERE
			kd_tiket = $kd_tiket AND
			tanggal = '$tanggal' AND
			kursi_avail >= $jml_penumpang;");

		$result = $this->db->affected_rows(); 
		// var_dump($result);
		// $query->next_result();
		// $query->free_result();

		return $result;
	}

    public function getKodeBooking()
    {
        $this->db->trans_start();

        // $this->db->free_result();
        $success = $this->db->query("CALL get_booking_code(@seq_out);");
        $success->next_result(); 
        $success->free_result(); 

        $query = $this->db->query('SELECT @seq_out as seqq;');

        $this->db->trans_complete();
        
        $seq = $query->row()->seqq;
        $booking_code = str_replace('-', '', date('Y-m-d')).str_pad($seq, 4, '0', STR_PAD_LEFT);

        return $booking_code;
    }    

    public function insertBooking($kd_tiket, $berangkat, $tiba, $jml_penumpang)
    {
        $b = htmlspecialchars_decode($berangkat);
        $t = htmlspecialchars_decode($tiba);        

    	$kd_booking = $this->getKodeBooking();
        $sql = "
            INSERT INTO trx_booking(kd_booking, kd_tiket, kd_kota_asal, kd_bpoint_asal, berangkat, kd_kota_tujuan, kd_bpoint_tujuan, tiba, jml_penumpang, harga_tiket, total_harga, expired)
            SELECT '$kd_booking', a.kd_tiket, b.kd_kota_asal, b.kd_bpoint_asal, '$b', b.kd_kota_tujuan, b.kd_bpoint_tujuan, '$t', $jml_penumpang, a.harga, a.harga * $jml_penumpang, ADDTIME(NOW(), '01:00:00')
            FROM ref_tiket a INNER JOIN ref_trayek b ON a.kd_trayek = b.kd_trayek
            WHERE kd_tiket = $kd_tiket";

        $this->db->query($sql);
        $sql = "SELECT kd_booking, expired, jml_penumpang FROM trx_booking WHERE kd_booking = $kd_booking";
        $query = $this->db->query($sql);

        return $query->row();        
    }

    public function getKelasSeats($id)
    {
    	$sql = "select kd_kelas, total_kursi, seat, col1, col2, col3, col4, col5, col6
from ref_kelas
where kd_kelas = $id";

		$query = $this->db->query($sql);

        return $query->result();
    }
}

/* End of file mbooking.php */
/* Location: ./application/models/mbooking.php */
?>