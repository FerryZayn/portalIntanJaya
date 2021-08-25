-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2021 at 08:46 AM
-- Server version: 8.0.25
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal.intan_jaya`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `artikel_insert` (IN `jdl` VARCHAR(255), IN `file_g` VARCHAR(255), IN `path_g` VARCHAR(255), IN `isi` TEXT, IN `p_input_id` INT, IN `tipe` SMALLINT, IN `pengarang` VARCHAR(255))  begin
	declare usr varchar(100);
	declare a_id int;
	declare opd_id int;
	declare n int;

	
	select p.username into usr from pegawai p where p.id=p_input_id;

	
	select j.opd_hdr_id into opd_id from pegawai p
	right join jabatan j on p.jabatan_id = j.id
	where p.id=p_input_id;
	
	INSERT INTO `portal.intan_jaya`.artikel
	(judul, file_gambar, path_file_gambar, isi_artikel, created_date, last_modified_date, nama_pengarang, user_created, user_updated, notes, opd_hdr_id, is_active, tipe_artikel_id, status_sistem_id)
	VALUES(jdl, file_g, path_g, isi, now(), now(), pengarang, usr, usr, null, opd_id, 1, tipe, 1);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `berita_view` ()  begin
	select a.judul, a.file_gambar, a.path_file_gambar, a.isi_artikel, a.nama_pengarang, a.created_date from artikel a where a.tipe_artikel_id = 1 and a.is_active = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `bidang_delete` (IN `bidang_id` INT, IN `pegawai_id` INT)  begin
	declare username varchar(100);
	declare sub_bidang_id int;
	declare jabatan_id int;
	declare notif varchar(100);

	
	select p.username into username from pegawai p where p.id=pegawai_id;

	
	select count(sb.id) into sub_bidang_id from sub_bidang sb where sb.bidang_id=bidang_id;

	
	select count(j.id) into jabatan_id from jabatan j where j.bidang_id=bidang_id;

	
	if (sub_bidang_id > 0) or (jabatan_id > 0) then 
		set notif = 'tidak bisa hapus, masih ada jabatan dan sub bidang terhubung';
	else		
		UPDATE `portal.intan_jaya`.bidang
	 	SET user_updated=username, last_modified_date=now(), is_active=0
	 	WHERE id=bidang_id;
	 	set notif = 'data terhapus';
	end if;
	select notif;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `bidang_insert` (IN `pegawai_id` INT, IN `kd` VARCHAR(50), IN `nama_bidang` VARCHAR(100), IN `tipe_b_id` INT)  begin
	declare username varchar(100);
	declare bidang_id int;
	declare opd_id int;
	declare n int;

	
	select p.username into username from pegawai p where p.id=pegawai_id;

	
	select j.opd_hdr_id into opd_id from pegawai p
	right join jabatan j on p.jabatan_id = j.id
	where p.id=pegawai_id;
	
	
	select b.is_active into bidang_id from bidang b where b.kode like kd and b.opd_hdr_id=opd_id;

	if (bidang_id is not null) then 
		if (bidang_id = 1) then
			set n = 80;
		else
			UPDATE `portal.intan_jaya`.bidang
			SET kode=kd, nama_bidang=nama_bidang, last_modified_date=now(), is_active=1, user_updated=username, tipe_bidang_id = tipe_b_id
			WHERE kode like kd and opd_hdr_id=opd_id;
		
			set n = 81;
		end if;
	else 
		INSERT INTO `portal.intan_jaya`.bidang
		(opd_hdr_id, kode, nama_bidang, created_date, is_active, user_created, tipe_bidang_id, last_modified_date)
		VALUES(opd_id, kd, nama_bidang, now(), 1, username, tipe_b_id, now());
		
		set n = 81;
	end if;
	select n;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `bidang_insert_su` (IN `pegawai_id` INT, IN `kd` VARCHAR(50), IN `nama_bidang` VARCHAR(100), IN `tipe_b_id` INT, IN `opd_id` INT)  begin
	declare username varchar(100);
	declare bidang_id int;

	declare n int;

	
	select p.username into username from pegawai p where p.id=pegawai_id;

	


	
	
	select b.is_active into bidang_id from bidang b where b.kode like kd and b.opd_hdr_id=opd_id;

	if (bidang_id is not null) then 
		if (bidang_id = 1) then
			set n = 80;
		else
			UPDATE `portal.intan_jaya`.bidang
			SET kode=kd, nama_bidang=nama_bidang, last_modified_date=now(), is_active=1, user_updated=username, tipe_bidang_id = tipe_b_id
			WHERE kode like kd and opd_hdr_id=opd_id;
		
			set n = 81;
		end if;
	else 
		INSERT INTO `portal.intan_jaya`.bidang
		(opd_hdr_id, kode, nama_bidang, created_date, is_active, user_created, tipe_bidang_id, last_modified_date)
		VALUES(opd_id, kd, nama_bidang, now(), 1, username, tipe_b_id, now());
		
		set n = 81;
	end if;
	select n;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `bidang_update` (IN `bidang_id` INT, IN `pegawai_id` INT, IN `kode` VARCHAR(50), IN `nama_bidang` VARCHAR(100))  begin
	declare username varchar(100);

	
	select p.username into username from pegawai p where p.id=pegawai_id;

	UPDATE `portal.intan_jaya`.bidang
	SET nama_bidang=nama_bidang, kode=kode, last_modified_date=now(), user_updated=username
	WHERE id=bidang_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `bidang_view` (IN `pegawai_id` INT)  begin
	declare opd_id int;
	
	
	select j.opd_hdr_id into opd_id from pegawai p
	right join jabatan j on p.jabatan_id = j.id
	where p.id=pegawai_id;

	SELECT b.id, b.kode, b.nama_bidang, b.created_date, b.last_modified_date, b.user_created, b.user_updated FROM bidang b
	where b.opd_hdr_id=opd_id and b.is_active = 1 order by b.last_modified_date desc;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `bidang_view_dtl` (IN `b_id` INT)  begin
	SELECT b.id, b.kode, b.nama_bidang, b.created_date, b.last_modified_date, b.user_created, b.user_updated FROM bidang b
	where b.opd_hdr_id=opd_id and b.id = b_id and b.is_active = 1 order by b.last_modified_date desc;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `bidang_view_su` (IN `opd_id` INT)  begin
	SELECT b.id,b.opd_hdr_id, b.kode, b.nama_bidang, b.created_date, b.last_modified_date, b.user_created, b.user_updated FROM bidang b
	where b.opd_hdr_id=opd_id order by b.last_modified_date desc;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cek_hak_akses` (IN `p_input_id` INT)  begin
	select had.id, m.id as modul_id, m.nama_modul, had.is_insert, had.is_view, had.is_update, had.is_delete, p.is_pegawai from hak_akses_dtl had 
	join hak_akses_hdr hah on hah.id = had.hak_akses_hdr_id
	join jabatan j on j.hak_akses_hdr_id = hah.id 
	join pegawai p on p.jabatan_id = j.id
	join modul m on m.id = had.modul_id
	where p.id=p_input_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hak_akses_dtl_insert` (IN `hah_id` INT)  begin
	declare i int;
	declare count_modul_id int;
 	declare modul int;

	
	select count(m.id) into count_modul_id from modul m; 

	set i = 1;
	while count_modul_id >= i do
		
		select had.modul_id into modul from hak_akses_dtl had where had.modul_id=i and had.hak_akses_hdr_id=hah_id;
	
		if(modul = i) then 
			set i = i + 1;
		else 
			INSERT INTO `portal.intan_jaya`.hak_akses_dtl
			(hak_akses_hdr_id, modul_id, created_date, user_created, is_active, is_view, is_insert, is_update, is_delete)
			VALUES(hah_id, i, now(), 'analyst',1,1,1,1,1);
			set i = i + 1;
		end if;
	end while;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hak_akses_dtl_update` (IN `pegawai_id` INT, IN `modul_id` INT, IN `is_active` TINYINT, IN `hah_id` INT)  begin
	declare username varchar(100);

	
	select p.username into username from pegawai p where p.id=pegawai_id;

	update hak_akses_dtl had
	right join hak_akses_hdr hah on hah.id = had.hak_akses_hdr_id
	set had.is_active = is_active, had.user_updated = username, had.last_modified_date = now()
	where had.modul_id = modul_id and hah.id = hah_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hak_akses_dtl_view` (IN `hah_id` INT)  begin
	select had.id, had.modul_id, m.nama_modul, had.is_active, 
	had.is_view, had.is_insert, had.is_update, had.is_delete from hak_akses_dtl had	
	left join modul m on had.modul_id = m.id
	left join hak_akses_hdr hah on hah.id = had.hak_akses_hdr_id
	where hah.id=hah_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hak_akses_hdr_delete` (IN `hah_id` INT, IN `pegawai_id` INT)  begin
	declare username varchar(50);
	declare jabatan_id int;
	declare notif varchar(50);

	
	select p.username into username from pegawai p where p.id=pegawai_id;

	
	select count(j.id) into jabatan_id from jabatan j where j.hak_akses_hdr_id=hah_id;

	
	if (jabatan_id > 0) then 
		set notif = 'tidak bisa hapus, masih ada jabatan';
	else		
		UPDATE `portal.intan_jaya`.hak_akses_hdr
	 	SET user_updated=username, last_modified_date=now(), is_active=0
	 	WHERE id=hah_id;
	 	set notif = 'data terhapus';
	end if;
	select notif;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hak_akses_hdr_insert` (IN `pegawai_id` INT, IN `kd` VARCHAR(50), IN `nama_hah` VARCHAR(100))  begin
	declare username varchar(100);
	declare hah_id int;
	declare n int;

	
	select p.username into username from pegawai p where p.id=pegawai_id;

	
	select hah.is_active into hah_id from hak_akses_hdr hah where hah.kode like kd;

	if (hah_id is not null) then 
		if (hah_id = 1) then 
			set n = 80;
		else
			UPDATE `portal.intan_jaya`.hak_akses_hdr
			SET last_modified_date=now(), is_active=1, is_visible=1, user_updated=username, nama_hak_akses=nama_hah
			WHERE kode=kd;
			
			set n = 81;
		end if;
	else 
		INSERT INTO `portal.intan_jaya`.hak_akses_hdr (kode,created_date,is_active,is_visible,user_created,nama_hak_akses)
		VALUES (kd,now(),1,1,username,nama_hah);
		set n = 81;
	end if;
	select n;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hak_akses_hdr_update` (IN `pegawai_id` INT, IN `kode` VARCHAR(50), IN `nama_hah` VARCHAR(100), IN `hah_id` INT)  begin
	declare username varchar(100);

	
	select p.username into username from pegawai p where p.id=pegawai_id;

	UPDATE `portal.intan_jaya`.hak_akses_hdr
	SET last_modified_date=now(), user_updated=username, nama_hak_akses=nama_hah, kode=kode
	WHERE id=hah_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hak_akses_hdr_view` ()  begin
	select hah.id, hah.kode, hah.nama_hak_akses from hak_akses_hdr hah where hah.is_active = 1 and hah.is_visible = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hak_akses_hdr_view_dtl` (IN `hah_id` INT)  begin
	select hah.id, hah.kode, hah.nama_hak_akses from hak_akses_hdr hah where hah.is_active = 1 and hah.is_visible = 1 and hah.id = hah_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hak_akses_view` (IN `hah_id` INT)  begin
	select hah.nama_hak_akses,had.id as had_id, had.modul_id, m.nama_modul, had.is_active, 
	had.is_view, had.is_insert, had.is_update, had.is_delete from hak_akses_dtl had	
	left join modul m on had.modul_id = m.id

	left join hak_akses_hdr hah on hah.id = had.hak_akses_hdr_id
	where hah.id=hah_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `identivikasi_user` (IN `user_email` VARCHAR(100))  begin
	declare usr_mail varchar(100);
	declare n int;

	declare id int;

	
	select p.id into id from pegawai p where p.is_active = 1 and p.username like user_email or p.email like user_email;

	
	select p.email into usr_mail from pegawai p where p.is_active = 1 and p.username like user_email or p.email like user_email;

	if (usr_mail is not null) then 
		set n = 70;

	else
		set n = 71;
		set usr_mail = null;
		set id = null;
	end if;
	select n,usr_mail,id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `informasi_view` ()  begin
	select a.judul, a.file_gambar, a.path_file_gambar, a.isi_artikel, a.nama_pengarang, a.created_date from artikel a where a.tipe_artikel_id = 2 and a.is_active = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_nomor_surat` (`p_input_id` INT, `pks_id` INT, `nomor_urut` INT, `bulan_id` INT)  begin
	declare username varchar(100);
	declare opd_id int;
	declare nomor_id int;
	declare nomor_kode varchar(100);
	declare nomor_unit_kerja varchar(50);
	declare bulan_code varchar(50);
	declare notif varchar(100);

	
	select p.username into username from pegawai p where p.id=p_input_id;

	
	select j.opd_hdr_id into opd_id from pegawai p
	right join jabatan j on p.jabatan_id = j.id
	where p.id=p_input_id;

	
	select oh.nomor_unit_kerja into nomor_unit_kerja from opd_hdr oh
	where oh.id = opd_id;

	
	select bs.kode_bulan into bulan_code from bulan_surat bs
	where bs.id = bulan_id;
	
	
	select concat(pks.kode,'/', nomor_urut,'/', nomor_unit_kerja,'/', bulan_code,'/',year(now())) into nomor_kode from pola_klasifikasi_surat pks
	where id=pks_id;	

	
	select ns.id into nomor_id from nomor_surat ns
	where ns.nomor like nomor_kode;

	if (nomor_id is not null) then 
		set notif = 'Nomor Surat Pernah Dibuat';
	else 
		INSERT INTO `portal.intan_jaya`.nomor_surat
		(nomor, user_created, created_date, is_active, status_surat_id)
		VALUES(nomor_kode, username, now(), 1, 40);
		set notif = 'Nomor Berhasil Dibuat';
	end if;
	select notif;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_tabel_disposisi` (IN `srt_id` INT, IN `p_input_id` INT, IN `cttn` VARCHAR(255), IN `usr` VARCHAR(50), IN `tgl_selesai` DATE, IN `sft_srt_cepat_id` INT, IN `sft_srt_aman_id` INT)  begin
	INSERT INTO `portal.intan_jaya`.disposisi
	(surat_masuk_id, pegawai_id, catatan, tanggal_disposisi, user_created, created_date, is_active, tanggal_selesai, sifat_surat_kecepatan_id, sifat_surat_keamanan_id)
	VALUES(srt_id, p_input_id, cttn, now(), usr, now(), 1, tgl_selesai, sft_srt_cepat_id, sft_srt_aman_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_tabel_surat_keluar` (IN `usr` VARCHAR(50), IN `sft_srt_aman_id` INT, IN `sft_srt_cepat_id` INT, IN `pola_klsfks_srt_id` INT, IN `idx` VARCHAR(255), IN `n_agnd` INT, IN `prhal` VARCHAR(255), IN `isi_ringks` VARCHAR(255), IN `no_srt` VARCHAR(100), IN `tgl_srt` DATE, IN `file_srt` VARCHAR(255), IN `p_file` VARCHAR(255), IN `nts` VARCHAR(100), IN `opd_id` INT)  begin
	INSERT INTO `portal.intan_jaya`.surat_keluar
	(opd_hdr_id, sifat_surat_keamanan_id, sifat_surat_kecepatan_id, pola_klasifikasi_surat_id, indeks, perihal, no_agenda, pengolah, nomor_surat, tanggal_surat, isi_ringkas, file_surat, status_surat_id, user_created, user_updated, created_date, last_modified_date, is_active, notes, path_file)
	VALUES(opd_id, sft_srt_aman_id, sft_srt_cepat_id, pola_klsfks_srt_id, idx, prhal, n_agnd, null, no_srt, tgl_srt, isi_ringks, file_srt, 12, usr, usr, now(), now(), 1, nts, p_file);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `jabatan_delete` (IN `j_id` INT, IN `pegawai_id` INT)  begin
	declare username varchar(100);
	declare p_id int;
	declare notif varchar(100);

	
	select p.username into username from pegawai p where p.id=pegawai_id;

	
	select count(p.id) into p_id from pegawai p where p.jabatan_id=j_id;

	
	if (p_id > 0) then 
		set notif = 'tidak bisa hapus, masih ada pegawai terhubung';
	else		
		UPDATE `portal.intan_jaya`.jabatan
	 	SET user_updated=username, last_modified_date=now(), is_active=0
	 	WHERE id=j_id;
	 	set notif = 'data terhapus';
	end if;
	select notif;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `jabatan_insert` (IN `pegawai_id` INT, IN `kd` VARCHAR(50), IN `b_id` INT, IN `sb_id` INT, IN `lvl` SMALLINT, IN `nama_j` VARCHAR(100), IN `hah_id` INT, IN `notes` VARCHAR(100))  begin
	declare username varchar(100);
 	declare opd_id int;
	declare j_id int;
	declare n int;

	
	select p.username into username from pegawai p where p.id=pegawai_id;

	
	select j.opd_hdr_id into opd_id from pegawai p
	right join jabatan j on p.jabatan_id = j.id
	where p.id=pegawai_id;

	
	select j.is_active into j_id from jabatan j where j.kode like kd and j.opd_hdr_id = opd_id;

	if (j_id is not null) then 
		if (j_id = 1) then 
			set n = 80;
		else
			UPDATE `portal.intan_jaya`.jabatan
			SET bidang_id=b_id, sub_bidang_id=sb_id, kode=kd, `level`=lvl, nama_jabatan=nama_j, last_modified_date=now(), is_active=1, user_updated=username, notes=notes, opd_hdr_id=opd_id, hak_akses_hdr_id=hah_id
			WHERE kode like kd and opd_hdr_id = opd_id;
		
			set n = 81;
		end if;
	else 
		INSERT INTO `portal.intan_jaya`.jabatan
		(bidang_id, sub_bidang_id, kode, `level`, nama_jabatan, created_date, is_active, user_created, notes, opd_hdr_id, hak_akses_hdr_id,last_modified_date)
		VALUES(b_id, sb_id, kd, lvl, nama_j, now(), 1, username, notes, opd_id, hah_id, now());
	
		set n = 81;
	end if;
	select n;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `jabatan_insert_su` (IN `pegawai_id` INT, IN `kd` VARCHAR(50), IN `b_id` INT, IN `sb_id` INT, IN `lvl` SMALLINT, IN `nama_j` VARCHAR(100), IN `hah_id` INT, IN `notes` VARCHAR(100), IN `opd_id` INT)  begin
	declare username varchar(100);

	declare j_id int;
	declare n int;

	
	select p.username into username from pegawai p where p.id=pegawai_id;

	


	
	select j.is_active into j_id from jabatan j where j.kode like kd and j.opd_hdr_id = opd_id;

	if (j_id is not null) then 
		if (j_id = 1) then 
			set n = 80;
		else
			UPDATE `portal.intan_jaya`.jabatan
			SET bidang_id=b_id, sub_bidang_id=sb_id, kode=kd, `level`=lvl, nama_jabatan=nama_j, last_modified_date=now(), is_active=1, user_updated=username, notes=notes, opd_hdr_id=opd_id, hak_akses_hdr_id=hah_id
			WHERE kode like kd and opd_hdr_id = opd_id;
		
			set n = 81;
		end if;
	else 
		INSERT INTO `portal.intan_jaya`.jabatan
		(bidang_id, sub_bidang_id, kode, `level`, nama_jabatan, created_date, is_active, user_created, notes, opd_hdr_id, hak_akses_hdr_id,last_modified_date)
		VALUES(b_id, sb_id, kd, lvl, nama_j, now(), 1, username, notes, opd_id, hah_id, now());
	
		set n = 81;
	end if;
	select n;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `jabatan_update` (IN `pegawai_id` INT, IN `kode` VARCHAR(50), IN `b_id` INT, IN `sb_id` INT, IN `lvl` SMALLINT, IN `nama_j` VARCHAR(100), IN `hah_id` INT, IN `notes` VARCHAR(100), IN `j_id` INT)  begin
	declare username varchar(100);
	declare opd_id int;

	
	select p.username into username from pegawai p where p.id=pegawai_id;

	
	select j.opd_hdr_id into opd_id from pegawai p
	right join jabatan j on p.jabatan_id = j.id
	where p.id=pegawai_id;

	UPDATE `portal.intan_jaya`.jabatan
	SET bidang_id=b_id, sub_bidang_id=sb_id, kode=kode, `level`=lvl, nama_jabatan=nama_j, last_modified_date=now(), is_active=1, user_update=username, notes=notes, opd_hdr_id=opd_id, hak_akses_hdr_id=hah_id
	WHERE id=j_id and opd_hdr_id = opd_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `jabatan_view` (IN `p_input_id` INT)  begin
	declare opd_id int;
	
	
	select j.opd_hdr_id into opd_id from pegawai p
	right join jabatan j on p.jabatan_id = j.id
	where p.id=p_input_id;
	
	select j.id, j.kode, j.nama_jabatan, b.nama_bidang, sb.nama_sub_bidang, j.bidang_id, j.sub_bidang_id, j.hak_akses_hdr_id, 
	j.opd_hdr_id from  jabatan j
	left join bidang b on b.id = j.bidang_id
	left join sub_bidang sb on sb.id = j.sub_bidang_id 
	where j.opd_hdr_id = opd_id and j.is_active = 1 order by j.last_modified_date desc;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `jabatan_view_su` (IN `opd_id` INT)  begin
	select j.id, j.kode, j.nama_jabatan, b.nama_bidang, sb.nama_sub_bidang, j.bidang_id, j.sub_bidang_id, j.hak_akses_hdr_id,
	j.opd_hdr_id from  jabatan j
	left join bidang b on b.id = j.bidang_id
	left join sub_bidang sb on sb.id = j.sub_bidang_id 
	where j.opd_hdr_id = opd_id and j.is_active = 1 order by j.last_modified_date desc;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login` (IN `user_email` VARCHAR(100), IN `pass` VARCHAR(100), IN `ip` VARCHAR(100))  begin
	declare mail varchar(100);
	declare usr_name varchar(100);
	declare usr_name2 varchar(100);
	declare aktif int;
	declare notif varchar(100);
	declare pwd varchar(100);
	declare n int;
	declare pass1 varchar(255);
	declare pass2 varchar(255);
	
	
	select p.id into usr_name from pegawai p where p.email like user_email or p.username like user_email;
	select p.nama_pegawai into usr_name2 from pegawai p where p.id=usr_name;

	
	

	if (usr_name is not null) then 
		
		select p.is_active into aktif from pegawai p where p.id = usr_name;		
	
		if (aktif = 1) then 
			
			select p.passwd into pwd from pegawai p where p.id = usr_name;
		
			
			select concat(sc.variabel,pass) into pass1 from system_configuration sc
			where sc.`parameter`='sys_code';

			
			select sha2(pass1, 224) into pass2;

			if (pwd = pass2) then 
			
				
				INSERT INTO `portal.intan_jaya`.log_logins
				(ip_address, usr, pegawai_id, created_date, success)
				VALUES(ip, user_email, usr_name, now(), 1);
			
				set n = 50;

			else 
				
				INSERT INTO `portal.intan_jaya`.log_logins
				(ip_address, usr, pegawai_id, created_date, success)
				VALUES(ip, user_email, usr_name, now(), 0);
			
				set n = 51;

				set usr_name = '';
				set usr_name2 = '';
			end if;			
		else 
			set n = 52;

			set usr_name = '';
			set usr_name2 = '';
		end if;
	else 
		set n = 53;
		
		set usr_name = '';
		set usr_name2 = '';
	end if;
	select n, usr_name,usr_name2;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `misi_pemda_insert` (IN `isi` TEXT, IN `p_input_id` INT)  begin
	declare username varchar(100);
	declare n int;
	declare aktif tinyint;

	
	select p.username into username from pegawai p where p.id=p_input_id;

	
	select a.is_active into aktif from artikel a where a.tipe_artikel_id = 6 and a.is_active = 1;
	
	if (aktif is not null) then 
		UPDATE `portal.intan_jaya`.artikel
		SET isi_artikel=isi, last_modified_date=now(), user_updated=username, is_active=1, status_sistem_id=1
		WHERE tipe_artikel_id = 6;

	else 
		INSERT INTO `portal.intan_jaya`.artikel
		(judul, file_gambar, path_file_gambar, isi_artikel, created_date, last_modified_date, nama_pengarang, user_created, user_updated, notes, opd_hdr_id, is_active, tipe_artikel_id, status_sistem_id)
		VALUES('MISI', null, null, isi, now(), now(), username, username, username, null, 0, 1, 6, 1);
	end if;
	set n = 81;
	select n;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modul_insert` (IN `km_id` INT, IN `kd` VARCHAR(50), IN `nm_m` VARCHAR(100), IN `tipe_m` INT)  begin
	declare id_m int;
	declare n tinyint;
	declare hah_count int;
	declare i int;
	
	
	select m.is_active into id_m from modul m where m.kode = kd;

	if (id_m is not null) then 
		if (id_m = 1) then
			set n = 80;
		else 
			UPDATE `portal.intan_jaya`.modul
			SET kelompok_modul_id=km_id, nama_modul=nm_m, created_date=now(), last_modified_date=now(), user_created='superuser', is_active=1, tipe_modul_id=tipe_m
			WHERE kode=kd;
			
			set n = 81;
		end if;
	else
		INSERT INTO `portal.intan_jaya`.modul
		(kelompok_modul_id, kode, nama_modul, is_active, tipe_modul_id, created_date,user_created)
		VALUES(km_id, kd, nm_m, 1, tipe_m,now(), 'superuser');
		
		select count(id)-1 into hah_count from hak_akses_hdr;
		
		set i = 1;
	
		while hah_count >= i do
			call hak_akses_dtl_insert(i);
			set i = i + 1;
		end while;
		set n = 81;
	end if;
	select n;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `opd_delete` (IN `opd_hdr_id` INT, IN `pegawai_id` INT)  begin
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `opd_insert` (IN `pegawai_id` INT, IN `kd` VARCHAR(50), IN `nama_opd` VARCHAR(250), IN `alamat_opd` VARCHAR(250), IN `kode_pos` VARCHAR(100), IN `telepon` VARCHAR(100), IN `fax` VARCHAR(100), IN `email` VARCHAR(100), IN `website` VARCHAR(100), IN `lvl_opd_id` SMALLINT, IN `nomor_unit_kerja` VARCHAR(100))  begin
	declare username varchar(100);
	declare opd_id int;
	declare n int;
	declare nama_p varchar(100);
	declare nik_nip int;
	declare usr_p varchar(50);
	declare j_id int;

	
	select oh.is_active into opd_id from opd_hdr oh where oh.kode like kd;

	
	select p.username into username from pegawai p where p.id=pegawai_id;

	if (opd_id is not null) then  
		if (opd_id = 1) then 
			set n = 80;
		else
			UPDATE `portal.intan_jaya`.opd_hdr
			SET last_modified_date=now(), user_updated=username, nama_opd=nama_opd, alamat_opd=alamat_opd, kode_pos=kode_pos, telepon=telepon, fax=fax, email=email, website=website, `level`=lvl_opd_id, nomor_unit_kerja=nomor_unit_kerja, is_active=1, is_visible=1
			WHERE kode=kd;
		
			set n = 81;
		end if;	
	else 
		INSERT INTO `portal.intan_jaya`.opd_hdr 
		(kode, create_date, is_active, user_created, user_updated, notes, is_visible, nama_opd, alamat_opd, kode_pos, telepon, fax, email, website, `level`, nomor_unit_kerja, last_modified_date)
		VALUES(kd, now(), 1, username, null, null, 1, nama_opd, alamat_opd, kode_pos, telepon, fax, email, website, lvl_opd_id, nomor_unit_kerja, now());

		
		select oh.id into opd_id from opd_hdr oh where oh.kode like kd;
	
		
		select concat('ADMINISTRATOR ',oh.kode) into nama_p from opd_hdr oh where oh.id=opd_id;
	
		
		select concat('admin',lower(oh.kode)) into usr_p from opd_hdr oh where oh.id=opd_id;
	
		
		select max(nik + 1) into nik_nip from pegawai p where p.is_pegawai = 0;
	
		
		call jabatan_insert_su(pegawai_id, 'ADM', null, null, 0, 'ADMINISTRATOR', 1, null, opd_id); 
		
		
		select j.id into j_id from jabatan j where j.hak_akses_hdr_id = 1 and j.kode like 'ADM' and j.opd_hdr_id = opd_id;
		
		
		call pegawai_insert_su(pegawai_id, nama_p, nik_nip, nik_nip, 1, null, null, null, null, usr_p, usr_p, j_id, now(), opd_id, 0);
	
		set n = 81;
	end if;
	select n;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `opd_update` (IN `opd_hdr_id` INT, IN `pegawai_id` INT, IN `kode` VARCHAR(50), IN `nama_opd` VARCHAR(250), IN `alamat_opd` VARCHAR(250), IN `kode_pos` VARCHAR(100), IN `telepon` VARCHAR(100), IN `fax` VARCHAR(100), IN `email` VARCHAR(100), IN `website` VARCHAR(100), IN `level` SMALLINT, IN `nomor_unit_kerja` VARCHAR(100))  begin
	declare username varchar(100);
	
	
	select p.username into username from pegawai p where p.id=pegawai_id; 
	
	UPDATE `portal.intan_jaya`.opd_hdr
	SET last_modified_date=now(), user_updated=username, nama_opd=nama_opd, alamat_opd=alamat_opd, kode_pos=kode_pos, telepon=telepon, fax=fax, email=email, website=website, `level`=level, nomor_unit_kerja=nomor_unit_kerja
	WHERE id=opd_hdr_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `opd_view` ()  begin
	SELECT id, kode, nama_opd, alamat_opd, kode_pos, telepon, fax, email, website, `level`, nomor_unit_kerja
	FROM `portal.intan_jaya`.opd_hdr 
	where is_active = 1 order by last_modified_date desc;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `opd_view_dtl` (IN `opd_id` INT)  begin
	SELECT id, kode, nama_opd, alamat_opd, kode_pos, telepon, fax, email, website, `level`, nomor_unit_kerja
	FROM `portal.intan_jaya`.opd_hdr 
	where is_active = 1 and id=opd_id order by last_modified_date desc;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pegawai_delete` (IN `p_id_input` INT, IN `pegawai_id` INT)  begin
	declare username varchar(100);

	
	select p.username into username from pegawai p where p.id=p_id_input;

	
		UPDATE `portal.intan_jaya`.pegawai
		SET user_updated=username, last_modified_date=now(), is_active=0
		WHERE id=pegawai_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pegawai_insert` (IN `p_id_input` INT, IN `p_nama` VARCHAR(100), IN `p_nik` DECIMAL(20,0), IN `p_nip` DECIMAL(20,0), IN `p_kelamin_code` TINYINT, IN `p_no_hp` VARCHAR(100), IN `p_email` VARCHAR(100), IN `p_golongan_id` SMALLINT, IN `p_kode` VARCHAR(100), IN `p_username` VARCHAR(100), IN `p_passwd` VARCHAR(100), IN `p_jabatan` INT, IN `p_tanggal_lahir` DATE)  begin
	declare username varchar(100);
	declare opd_id int;
	declare pegawai_id int;
	declare pass1 varchar(255);
	declare pass2 varchar(255);
	declare n int;

	declare j_kadin int;


	
	select p.username into username from pegawai p where p.id=p_id_input;

	
	select concat(sc.variabel,p_passwd) into pass1 from system_configuration sc
	where sc.`parameter`='sys_code';

	
	select sha2(pass1, 224) into pass2;

	
	select j.opd_hdr_id into opd_id from pegawai p
	right join jabatan j on p.jabatan_id = j.id
	where p.id=p_id_input;

	
	select p.is_active into pegawai_id from pegawai p where p.nip like p_nip;

	
	select j.id into j_kadin from pegawai p 
	join jabatan j on j.id = p.jabatan_id
	where j.opd_hdr_id = opd_id and j.id = p_jabatan and p.is_active = 1 and j.`level` < 4 and j.`level` != 0;

	if (j_kadin is not null) then 
		set n = 54;
	else
		if (pegawai_id is not null) and (p_kelamin_code = 1) then 
			if (pegawai_id = 1) then
				set n = 80;
			else
				UPDATE `portal.intan_jaya`.pegawai
				SET jabatan_id=p_jabatan, nip=p_nip, last_modified_date=now(), user_updated=username, is_active=1, nama_pegawai=p_nama, nik=p_nik, passwd=pass2, golongan_id=p_golongan_id, kode=p_kode,
				jenis_kelamin='LAKI-LAKI', jenis_kelamin_code=p_kelamin_code, email=p_email, no_hp=p_no_hp, tanggal_lahir=p_tanggal_lahir, is_pegawai=is_p
				WHERE nip=p_nip;
		
				set n = 81;
			end if;	
	
		elseif (pegawai_id is not null) and (p_kelamin_code = 2) then
			if (pegawai_id = 1) then 
				set n = 80;
			else 
				UPDATE `portal.intan_jaya`.pegawai
				SET jabatan_id=p_jabatan, nip=p_nip, last_modified_date=now(), user_updated=username, is_active=1, nama_pegawai=p_nama, nik=p_nik, passwd=pass2, golongan_id=p_golongan_id, kode=p_kode,
				jenis_kelamin='PEREMPUAN', jenis_kelamin_code=p_kelamin_code, email=p_email, no_hp=p_no_hp, tanggal_lahir=p_tanggal_lahir, is_pegawai=p
				WHERE nip=p_nip;
		
				set n = 81;
			end if;

		elseif (pegawai_id is null) and (p_kelamin_code = 1) then
			INSERT INTO `portal.intan_jaya`.pegawai
			(jabatan_id, nip, created_date, user_created, is_active, nama_pegawai, nik, username, passwd, golongan_id, kode, jenis_kelamin, jenis_kelamin_code, email, no_hp, tanggal_lahir, last_modified_date,is_pegawai)
			VALUES(p_jabatan, p_nip, now(), username, 1, p_nama, p_nik, p_username, pass2, p_golongan_id, p_kode, 'LAKI-LAKI', p_kelamin_code, p_email, p_no_hp, p_tanggal_lahir,now(),1);
		
			set n = 81;
		else 
			INSERT INTO `portal.intan_jaya`.pegawai
			(jabatan_id, nip, created_date, user_created, is_active, nama_pegawai, nik, username, passwd, golongan_id, kode, jenis_kelamin, jenis_kelamin_code, email, no_hp, tanggal_lahir,last_modified_date,is_pegawai)
			VALUES(p_jabatan, p_nip, now(), username, 1, p_nama, p_nik, p_username, pass2, p_golongan_id, p_kode, 'PEREMPUAN', p_kelamin_code, p_email, p_no_hp, p_tanggal_lahir,now(),1);
	
			set n = 81;
		end if;
	end if; 
 	select n;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pegawai_insert_su` (IN `p_id_input` INT, IN `p_nama` VARCHAR(100), IN `p_nik` DECIMAL(20,0), IN `p_nip` DECIMAL(20,0), IN `p_kelamin_code` TINYINT, IN `p_no_hp` VARCHAR(100), IN `p_email` VARCHAR(100), IN `p_golongan_id` SMALLINT, IN `p_kode` VARCHAR(100), IN `p_username` VARCHAR(100), IN `p_passwd` VARCHAR(100), IN `p_jabatan` INT, IN `p_tanggal_lahir` DATE, IN `opd_id` INT, IN `is_p` TINYINT)  begin
	declare username varchar(100);

	declare pegawai_id int;
	declare pass1 varchar(255);
	declare pass2 varchar(255);
	declare n int;

	declare j_kadin int;


	
	select p.username into username from pegawai p where p.id=p_id_input;

	
	select concat(sc.variabel,p_passwd) into pass1 from system_configuration sc
	where sc.`parameter`='sys_code';

	
	select sha2(pass1, 224) into pass2;

	


	
	select p.is_active into pegawai_id from pegawai p where p.nip like p_nip;

	
	select j.id into j_kadin from pegawai p 
	join jabatan j on j.id = p.jabatan_id
	where j.opd_hdr_id = opd_id and j.id = p_jabatan and p.is_active = 1 and j.`level` < 4;

	if (j_kadin is not null) then 
		set n = 54;
	else
		if (pegawai_id is not null) and (p_kelamin_code = 1) then 
			if (pegawai_id = 1) then
				set n = 80;
			else
				UPDATE `portal.intan_jaya`.pegawai
				SET jabatan_id=p_jabatan, nip=p_nip, last_modified_date=now(), user_updated=username, is_active=1, nama_pegawai=p_nama, nik=p_nik, passwd=pass2, golongan_id=p_golongan_id, kode=p_kode, jenis_kelamin='LAKI-LAKI', jenis_kelamin_code=p_kelamin_code, email=p_email, no_hp=p_no_hp, tanggal_lahir=p_tanggal_lahir
				WHERE nip=p_nip;
		
				set n = 81;
			end if;	
	
		elseif (pegawai_id is not null) and (p_kelamin_code = 2) then
			if (pegawai_id = 1) then 
				set n = 80;
			else 
				UPDATE `portal.intan_jaya`.pegawai
				SET jabatan_id=p_jabatan, nip=p_nip, last_modified_date=now(), user_updated=username, is_active=1, nama_pegawai=p_nama, nik=p_nik, passwd=pass2, golongan_id=p_golongan_id, kode=p_kode, jenis_kelamin='PEREMPUAN', jenis_kelamin_code=p_kelamin_code, email=p_email, no_hp=p_no_hp, tanggal_lahir=p_tanggal_lahir
				WHERE nip=p_nip;
		
				set n = 81;
			end if;

		elseif (pegawai_id is null) and (p_kelamin_code = 1) then
			INSERT INTO `portal.intan_jaya`.pegawai
			(jabatan_id, nip, created_date, user_created, is_active, nama_pegawai, nik, username, passwd, golongan_id, kode, jenis_kelamin, jenis_kelamin_code, email, no_hp, tanggal_lahir, last_modified_date, is_pegawai)
			VALUES(p_jabatan, p_nip, now(), username, 1, p_nama, p_nik, p_username, pass2, p_golongan_id, p_kode, 'LAKI-LAKI', p_kelamin_code, p_email, p_no_hp, p_tanggal_lahir,now(), is_p);
		
			set n = 81;
		else 
			INSERT INTO `portal.intan_jaya`.pegawai
			(jabatan_id, nip, created_date, user_created, is_active, nama_pegawai, nik, username, passwd, golongan_id, kode, jenis_kelamin, jenis_kelamin_code, email, no_hp, tanggal_lahir,last_modified_date, is_pegawai)
			VALUES(p_jabatan, p_nip, now(), username, 1, p_nama, p_nik, p_username, pass2, p_golongan_id, p_kode, 'PEREMPUAN', p_kelamin_code, p_email, p_no_hp, p_tanggal_lahir,now(), is_p);
	
			set n = 81;
		end if;
	end if; 
 	select n;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pegawai_update` (IN `p_id_input` INT, IN `p_nama` VARCHAR(100), IN `p_nik` DECIMAL(20,0), IN `p_nip` DECIMAL(20,0), IN `p_kelamin_code` TINYINT, IN `p_no_hp` VARCHAR(100), IN `p_email` VARCHAR(100), IN `p_golongan_id` SMALLINT, IN `p_kode` VARCHAR(100), IN `p_username` VARCHAR(100), IN `p_passwd` VARCHAR(100), IN `p_jabatan` INT, IN `p_tanggal_lahir` DATE, IN `pegawai_id` INT)  begin
	declare username varchar(100);



	
	select p.username into username from pegawai p where p.id=p_id_input;

	
	

	if (p_kelamin_code = 1) then 
		UPDATE `portal.intan_jaya`.pegawai
		SET jabatan_id=p_jabatan, nip=p_nip, last_modified_date=now(), user_updated=username, is_active=1, nama_pegawai=p_nama, nik=p_nik, passwd=p_passwd, golongan=p_golongan_id, kode=p_kode, jenis_kelamin='LAKI-LAKI', jenis_kelamin_code=p_kelamin_code, email=p_email, no_hp=p_no_hp, tanggal_lahir=p_tanggal_lahir
		WHERE id=pegawai_id;
	
	else
		UPDATE `portal.intan_jaya`.pegawai
		SET jabatan_id=p_jabatan, nip=p_nip, last_modified_date=now(), user_updated=username, is_active=1, nama_pegawai=p_nama, nik=p_nik, passwd=p_passwd, golongan=p_golongan_id, kode=p_kode, jenis_kelamin='PEREMPUAN', jenis_kelamin_code=p_kelamin_code, email=p_email, no_hp=p_no_hp, tanggal_lahir=p_tanggal_lahir
		WHERE id=pegawai_id;
	end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pegawai_view` (IN `pegawai_id` INT)  begin
	declare opd_id int;

	
	select j.opd_hdr_id into opd_id from pegawai p
	right join jabatan j on p.jabatan_id = j.id
	where p.id=pegawai_id;

	select p.id, p.nip, p.nama_pegawai, j.nama_jabatan, b.nama_bidang, sb.nama_sub_bidang, p.jabatan_id, p.golongan_id, gp.kode as golongan from pegawai p
	left join jabatan j on j.id = p.jabatan_id 
	left join bidang b on b.id = j.bidang_id 
	left join sub_bidang sb on sb.id = j.sub_bidang_id
	left join golongan_pegawai gp on gp.id = p.golongan_id 
	where j.opd_hdr_id = opd_id and p.is_active = 1
	order by p.last_modified_date desc;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pegawai_view_su` ()  begin
	select p.id, p.nip, p.nama_pegawai, j.nama_jabatan, b.nama_bidang, sb.nama_sub_bidang, p.jabatan_id, p.golongan_id, gp.kode as golongan from pegawai p
	left join jabatan j on j.id = p.jabatan_id 
	left join bidang b on b.id = j.bidang_id 
	left join sub_bidang sb on sb.id = j.sub_bidang_id
	left join golongan_pegawai gp on gp.id = p.golongan_id 
	where p.is_active = 1 and p.id !=0
	order by p.last_modified_date desc;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `profil_pejabat_insert` (IN `p_input_id` INT, IN `p_id` INT, IN `f_foto` VARCHAR(255), IN `p_f_foto` VARCHAR(255))  begin
	declare usr varchar(100);
	declare n int;
	declare aktif tinyint;

	
	select p.username into usr from pegawai p where p.id=p_input_id;
	
	
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reset_password` (IN `p_id` INT, IN `validasi` INT, IN `new_pass1` VARCHAR(255), IN `new_pass2` VARCHAR(255))  begin
	declare n int;
	declare pass1 varchar(255);
	declare pass2 varchar(255);
	
	if (validasi = 74) then
		if (new_pass1 = new_pass2) then
			
			select concat(sc.variabel,new_pass1) into pass1 from system_configuration sc
			where sc.`parameter`='sys_code';
	
			
			select sha2(pass1, 224) into pass2;
		
			UPDATE `portal.intan_jaya`.pegawai
			set passwd = pass2
			WHERE id=p_id;
	
			INSERT INTO `portal.intan_jaya`.log_reset
			(pegawai_id, ip_address, notes, created_date)
			VALUES(p_id, '', '', now());
	
			set n = 75;
		else
			set n = 76;
		end if;
	else
		set n = 73;
	end if;
	select n;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sub_bidang_delete` (IN `pegawai_id` INT, IN `sub_bidang_id` INT)  begin
	declare username varchar(100);
	declare jabatan_id int;
	declare notif varchar(50);

	
	select p.username into username from pegawai p where p.id=pegawai_id;

	
	select count(j.id) into jabatan_id from jabatan j where j.sub_bidang_id=sub_bidang_id;

	
	if (jabatan_id > 0) then 
		set notif = 'tidak bisa hapus, masih ada jabatan terhubung';
	else		
		UPDATE `portal.intan_jaya`.sub_bidang
	 	SET user_updated=username, last_modified_date=now(), is_active=0
	 	WHERE id=sub_bidang_id;
	 	set notif = 'data terhapus';
	end if;
	select notif;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sub_bidang_insert` (IN `pegawai_id` INT, IN `kd` VARCHAR(50), IN `b_id` INT, IN `nama_sub_bidang` VARCHAR(100))  begin
	declare username varchar(100);
	declare sub_bidang_id int;
	declare n int;

	
	select p.username into username from pegawai p where p.id=pegawai_id;

	
	select sb.is_active into sub_bidang_id from sub_bidang sb where sb.kode like kd and sb.bidang_id=b_id;

	if (sub_bidang_id is not null) then 
		if (sub_bidang_id = 1) then 
			set n = 80;
		else
			UPDATE `portal.intan_jaya`.sub_bidang
			SET kode=kd, nama_sub_bidang=nama_sub_bidang, last_modified_date=now(), is_active=1, user_updated=username
			WHERE kode like kd and bidang_id=b_id;
		
			set n = 81;
		end if;
	else 
		 INSERT INTO `portal.intan_jaya`.sub_bidang
		(bidang_id, kode, nama_sub_bidang, created_date, is_active, user_created,last_modified_date)
		VALUES(b_id, kd, nama_sub_bidang, now(), 1, username,now());
	
		set n = 81;
	end if;
	select n;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sub_bidang_update` (IN `pegawai_id` INT, IN `kode` VARCHAR(50), IN `bidang_id` INT, IN `nama_sub_bidang` VARCHAR(100), IN `sub_bidang_id` INT)  begin
	declare username varchar(100);

	
	select p.username into username from pegawai p where p.id=pegawai_id;

	UPDATE `portal.intan_jaya`.sub_bidang
	SET bidang_id=bidang_id, kode=kode, nama_sub_bidang=nama_sub_bidang, last_modified_date=now(), user_updated=username 
	WHERE id=sub_bidang_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sub_bidang_view` (IN `b_id` INT)  begin
	SELECT sb.id, sb.bidang_id, sb.kode, sb.nama_sub_bidang, sb.created_date, sb.last_modified_date, sb.is_active, sb.user_created, sb.user_updated, sb.notes
	FROM sub_bidang sb where sb.bidang_id=b_id and sb.is_active=1 order by sb.last_modified_date desc;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sub_bidang_view_dtl` (IN `sb_id` INT)  begin
	SELECT sb.id, sb.bidang_id, sb.kode, sb.nama_sub_bidang, sb.created_date, sb.last_modified_date, sb.is_active, sb.user_created, sb.user_updated, sb.notes
	FROM sub_bidang sb where sb.id=sb_id and sb.is_active=1 order by sb.last_modified_date desc;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tembak_password_md5` ()  begin
	declare i int;

	declare x int;
	declare user_name varchar(100);
	declare pass1 varchar(255);
	declare pass2 varchar(255);
	



	select count(p.id) into x from pegawai p;

	set x = x-1;
	set i = 1;


	


	while x >= i do
		select p.username into user_name from pegawai p
		where p.id=i;
	
		
		select concat(sc.variabel,user_name) into pass1 from system_configuration sc
		where sc.`parameter`='sys_code';

		
		select sha2(pass1, 224) into pass2;
	
		UPDATE `portal.intan_jaya`.pegawai
		set passwd = pass2
		WHERE id=i;
		set i = i+1;
	end while;
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `token_insert` (IN `token` VARCHAR(100), IN `mail` VARCHAR(100), IN `p_id` INT)  begin
	declare id int;

	select t.pegawai_id into id from token t where t.pegawai_id=p_id;

	if (id=pegawai_id) then
		delete from token t where t.pegawai_id = p_id;
	
		INSERT INTO `portal.intan_jaya`.token
		(token, email, pegawai_id, expired, is_active)
		VALUES(token, mail,p_id , addtime(now(), "00:05:00"), 1);
	
	else 
		INSERT INTO `portal.intan_jaya`.token
		(token, email, pegawai_id, expired, is_active)
		VALUES(token, mail,p_id , addtime(now(), "00:05:00"), 1);
	end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ubah_password` (IN `p_input_id` INT, IN `old_pass` VARCHAR(255), IN `new_pass1` VARCHAR(255), IN `new_pass2` VARCHAR(255))  BEGIN
	declare notif varchar(255);
	declare n int;
	declare old_pass_sys varchar(255);
	declare pass1 varchar(255);
	declare pass2 varchar(255);
	declare old_pass1 varchar(255);
 	declare old_pass2 varchar(255);
	
	select p.passwd into old_pass_sys from pegawai p where p.id = p_input_id;

	
	select concat(sc.variabel,old_pass) into old_pass1 from system_configuration sc
	where sc.`parameter`='sys_code';

	
	select sha2(old_pass1, 224) into old_pass2;
	
	if (old_pass_sys = old_pass2) then 
		if (new_pass1 = new_pass2) then
		
			select concat(sc.variabel,new_pass1) into pass1 from system_configuration sc
			where sc.`parameter`='sys_code';

			
			select sha2(pass1, 224) into pass2;
		
			UPDATE `portal.intan_jaya`.pegawai
			set passwd = pass2
			WHERE id=p_input_id;

			set n = 60;
		else

			set n = 61;
		end if;
	else 
		set n = 62;
	end if;	
	select n;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_tabel_disposisi` (IN `cttn` VARCHAR(255), IN `usr` VARCHAR(50), IN `tgl_selesai` DATE, IN `sft_srt_cepat_id` INT, IN `sft_srt_aman_id` INT, IN `srt_id` INT, IN `p_input_id` INT)  begin
	UPDATE `portal.intan_jaya`.disposisi
	SET catatan=cttn, tanggal_disposisi=now(), user_updated =usr, last_modified_date =now(), is_active=1, tanggal_selesai=tgl_selesai,
	sifat_surat_kecepatan_id=sft_srt_cepat_id, sifat_surat_keamanan_id=sft_srt_aman_id
	WHERE surat_masuk_id=srt_id AND pegawai_id=p_input_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_tabel_surat_keluar` (IN `usr` VARCHAR(50), IN `sft_srt_aman_id` INT, IN `sft_srt_cepat_id` INT, IN `pola_klsfks_srt_id` INT, IN `idx` VARCHAR(255), IN `n_agnd` INT, IN `prhal` VARCHAR(255), IN `isi_ringks` VARCHAR(255), IN `no_srt` VARCHAR(100), IN `tgl_srt` DATE, IN `file_srt` VARCHAR(255), IN `p_file` VARCHAR(255), IN `nts` VARCHAR(100))  begin	
	UPDATE `portal.intan_jaya`.surat_keluar
	SET opd_hdr_id=opd_id, sifat_surat_keamanan_id=sft_srt_aman_id, sifat_surat_kecepatan_id=sft_srt_cepat_id, pola_klasifikasi_surat_id=pola_klsfks_srt_id,
	indeks=idx, perihal=prhal, no_agenda=n_agnd, pengolah=null, tanggal_surat=tgl_srt, isi_ringkas=isi_ringks, file_surat=file_srt, path_file=p_file,
	status_surat_id=12, user_updated=usr, last_modified_date=now(), notes=nts, nomor_surat=no_srt, is_active=1
	WHERE id=sk_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `validasi_token` (IN `sesion_mail` VARCHAR(100), IN `mail` VARCHAR(100), IN `token` VARCHAR(100), IN `sesion_token` VARCHAR(100))  begin
	declare n int;
	declare p_id int;

	
	select t.pegawai_id into p_id from token t where t.email = sesion_mail;

	if (p_id is not null) then 
		if (mail = sesion_mail) then 
			set n = 74;
			delete from token t where t.email = sesion_mail;
		else
			set n = 73;
		end if;
	else
		set n = 73;
	end if;	
	select n,p_id; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `visi_pemda_insert` (IN `isi` TEXT, IN `p_input_id` INT)  begin
	declare username varchar(100);
	declare n int;
	declare aktif tinyint;

	
	select p.username into username from pegawai p where p.id=p_input_id;

	
	select a.is_active into aktif from artikel a where a.tipe_artikel_id = 5 and a.is_active = 1;
	
	if (aktif is not null) then 
		UPDATE `portal.intan_jaya`.artikel
		SET isi_artikel=isi, last_modified_date=now(), user_updated=username, is_active=1, status_sistem_id=1
		WHERE tipe_artikel_id = 5;

	else 
		INSERT INTO `portal.intan_jaya`.artikel
		(judul, file_gambar, path_file_gambar, isi_artikel, created_date, last_modified_date, nama_pengarang, user_created, user_updated, notes, opd_hdr_id, is_active, tipe_artikel_id, status_sistem_id)
		VALUES('VISI', null, null, isi, now(), now(), username, username, username, null, 0, 1, 5, 1);
	end if;
	set n = 81;
	select n;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug_artikel` varchar(150) NOT NULL,
  `file_gambar` varchar(255) DEFAULT NULL,
  `path_file_gambar` varchar(255) DEFAULT NULL,
  `isi_artikel` text NOT NULL,
  `created_date` timestamp NOT NULL,
  `last_modified_date` timestamp NOT NULL,
  `nama_pengarang` varchar(255) NOT NULL,
  `user_created` varchar(100) NOT NULL,
  `user_updated` varchar(100) NOT NULL,
  `notes` varchar(100) DEFAULT NULL,
  `opd_hdr_id` int NOT NULL,
  `is_active` tinyint NOT NULL,
  `tipe_artikel_id` smallint NOT NULL,
  `status_sistem_id` smallint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `judul`, `slug_artikel`, `file_gambar`, `path_file_gambar`, `isi_artikel`, `created_date`, `last_modified_date`, `nama_pengarang`, `user_created`, `user_updated`, `notes`, `opd_hdr_id`, `is_active`, `tipe_artikel_id`, `status_sistem_id`) VALUES
(5, 'In Publishing and Graphic Design', 'in-publishing-and-graphic-design', '5.jpeg', '/templet/gambar-berita', '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\n<p>Sebenarnya, Apa yang Dimaksud dengan Tujuan Hidup?\nTujuan hidup adalah apa yang seseorang rencanakan untuk kehidupannya pada hari ini, esok hari, sebulan ke depan, setahun ke depan, bahkan beberapa tahun mendatang. Tujuan hidup orang akan berbeda satu sama lain. Tujuan hidup saya pasti akan berbeda dengan tujuan hidup yang rekan pembaca miliki. Pengertian tujuan hidup menurut para ahli adalah proses menetapkan identitas diri yang dimiliki seseorang. Dengan kata lain, kita bisa mengatakan bahwa seseorang yang memiliki tujuan hidup adalah mereka yang memiliki identitas diri yang kuat dalam menjalani kehidupan sehari-hari.\n\nDalam masyarakat modern seperti sekarang ini, individu yang telah mengetahui tujuan hidupnya secara jelas dianggap telah memenuhi kriteria utama dalam menuju kebahagiaan hidup. Nyatanya, tidak semua orang yang sudah mengenal tujuan hidupnya bisa mencapai kebahagiaan yang hakiki secara mudah. Bahkan, tidak sedikit orang yang pada akhirnya menekan hidup mereka hanya karena terlalu ambisius dengan tujuan hidup yang mereka miliki.\n<p>\nBanyak orang yang berbondong-bondong untuk membaca tujuan hidup quotes atau buku-buku yang dapat mengarahkan mereka pada tujuan hidup masing-masing yang mungkin selama ini mereka inginkan. Mereka mencoba mencari tahu tentang untuk apa manusia hidup? Apa tujuan hidup manusia? Apa tujuan hidup kita? Mungkin kita bisa mengambil satu contoh. Salah satu contoh tujuan hidup diri sendiri adalah saya ingin menjadi seorang Direktur Perusahaan dalam lima tahun ke depan.\n</p>\nItu bagus, hiduplah dengan tujuan yang terarah. Meskipun orang-orang yang memiliki tujuan hidup belum tentu akan merasakan kebahagiaan (bahkan, kebanyakan merasa tertekan). Namun, setidaknya tujuan hidup akan membuat hidup kita “semakin terbakar” dengan semangat. Kita perlu ingat bahwa “Tujuan hidup bukanlah suatu alat untuk membuat kita bahagia. Namun, tujuan hidup adalah sesuatu yang bermanfaat, terhormat, berbelas kasih, dan menjadikan suatu perbedaan apakah kita hanya sekedar hidup atau telah menjalani kehidupan dengan sebaik mungkin”.\n\n3 Langkah untuk Menemukan Tujuan Hidup dengan Tepat\nJika memang tujuan hidup dapat melatih kita untuk menjalani kehidupan dengan sebaik mungkin, lantas bagaimana cara agar kita bisa mencari tujuan hidup dengan tepat? Menurut website lifehack dot org, ada 3 langkah yang bisa kita terapkan untuk menemukan tujuan hidup, yaitu sebagai berikut.</p>', '2021-07-14 09:09:29', '2021-08-18 09:09:29', 'Agung', 'budi', 'budi', NULL, 1, 1, 1, 1),
(6, 'Pendidikan dan Filosofi pendidikan', 'pendidikan-dan-filosofi-pendidikan', '22.jpg', '/templet/gambar-berita', 'berbicara tentang filosofi maka hal yang pasti diingat adalah filsafat. Filosofi dan filsafat secara bahasa memang hampir, namun keduanya jelas berbeda. Filsafat merupakan sikap atau pandangan untuk memahami segala fenomena yang ada. intinya filsafat merupakan bidang studi yang membahas segala fenomena yang ada di dunia ini secara kritis, radikal, sistematis dan universal. sedangkan filosofi merupakan suatu kerangka berpikir atau hasil pemikiran secara keritis guna menyelesaikan suatu masalah. artinya solusi  yang dihasilkan merupakan suatu hasil atau buah dari proses berfikir secara kritis. Menurut KBBI filosofi merupakan pengetahuan dan penyelidikan dan penyelidikan dengan akal pikiran mengenai hakikat dari segala sesuatu yang ada.\n\nsedangkan filososfi pendidikan merupakan suatu landasan dalam pendidikan mengenai asumsi-asumsi yang didasarkan pada filsafat yang dijadikan titik tolak dalam pendidikan. filosofi pendidikan disini menurut hemat penulis merupakan sebuah pemikiran yang sangat mendasar mengenai hakikat dari pendidikan baik dari segi sebab akibatnya, pelaksanaannya, niilainya, maupun tujuannya.\n\nperlunya filosofi pendidikan ini, karena filosofi pendidikan bisa dijadikan sebagai suatu pendekatan guna menyelesaikan permasalahan-permasalahan yang muncul dalam pendidikan, karena filososfi pendidikan disini merupaan pemikiran paling dasar mengenai pendidikan. permasalahan-permasalahan dalam pendidikan sangatlah luas, mendalam dan kompleks, karena masalah-masalah tersebut muncul karena beragamnya tujuan hidup dari manusia.\n\nuntuk lebih lanjut mengenai pembahasan filososfi pendidikan, maka perlu kita ketahui 3 komponen dasar dari filsafat, yaitu ontologi, epistimologi, dan aksiologi. memahami filosofi pendidikan akan lebik efektif jika pembahasan filosofi pendidikan juga ditinjau dari segi ontologi pendidikan, epistimologi pendidikan dan aksiologi pendidikan.', '2021-10-14 09:18:40', '2021-08-18 09:18:40', 'Sandria', 'budi', 'budi', NULL, 1, 1, 1, 1),
(7, 'Filosofi pendidikan dan Fungsi pendidikan', 'filosofi-pendidikan-dan-fungsi-pendidikan', '2.jpeg', '/templet/gambar-berita', 'Ontologi Pendidikan, ontologi merupakan bagian adari komponen filsafat yang membahas tentang dasar atau hakikat dari suatu objek. maka dari itu, ontologi pendidikan merupakan pembahasan mengenai hakikat, kenyataan dan sebab-akibat dari pendidikan. pendidikan merupakan suatu usaha sadar untuk menciptakan generasi yang cerdas, berbudi pekerti, dan memiliki pengetahuan yang luas. maka dari itu, hemat penulis tentang hakikat pendidikan ini adalah sebagai berikut: pendidikan merupakan usaha sadar untuk menjadi manusia seutuhnya, artinya manusia yang bisa memanusiakan manusia. pendidikan merupakan proses timbal balik dari seorang pendidik dan peserta pendidik dengan harapan bisa menciptakan generasi yang gemilang.\n\nEpistimologi Pendidikan, dalam studi filsafat, epistimologi merupakan proses berpikir guna mengkajisecara mendalam mengenai asal-usul, struktur dan metode. pendapat lain mengatakan bahwa epistimologi ini kajiannya lebih pada metode, sarana, teknik dan cara yang digunakan. oleh karena itu, epistimologi pendidikan sewajarnya bisa menyatakan bahwa asal-usul pendidikan bukanlah dari manusia, melainkan dari Tuhan yang maha Esa. seperti halnya dalam islam, yang menyatakan bahwa ilmu itu merupakan pemberian tuhan, sedangkan manusia adalah penerima ilmu. lalu proses manusia memperoleh ilmu itu ada 2 macam, ada yang langsung dari tuhan (proses ilahiyah) dan melalui pemikiran manusia itu sendiri (proses insaniyah).\n\nAksiologi Pendidikan, Aksiologi dalam studi filsafat merupakan sebuah pemikiran yang kajiannya lebih fokus pada nilai dan tujuan. maka dari itu kajian aksiologi pendidikan meliputi nilai dan tujuan dari pendidikan. adapun nilai yang terkandung dalam pendidikan sangatlah banyak, tapi yang paling dasar dari nilai pendidikan ada 2 macam, yaitu etika dan estetika. etika merupakan bagian dari aksiologi yang membahas tentang moral, adat istiadat, kebiasaan dalam sebah komonitas. Pada intinya, etika merupakan sesuatu yang sangat fundamental jika dilihat dari aspek ontologi pendidikan dan hal ini sejalan dengan hakikat pendidikan itu sendiri. Sedangkan estetika merupakan bidang studi atau kajian yang membahas tentang keindahan. keindahan merupakan sesuatu tentang diri dari sesuatu yang didalamnya tersusun secara rapi dan tertib dalam suatu hubungan yang utuh. karena estetika merupakan sesuatu yang bisa terjadi pada apa saja, maka pendidikan juga memiliki nilai keindahan tersendiri. yang jelas keindahan dari pendidikan tidak terlepas dari aspek etikanya.', '2021-08-18 09:21:06', '2021-08-18 09:21:06', 'Simbad', 'budi', 'budi', NULL, 1, 1, 1, 1),
(8, 'Judul Lorem', 'judul-lorem', '3.jpg', '/templet/gambar-berita', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor.</p>\n\n<p>Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula. Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis.</p>\n\n<p>Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim. Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\n\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit.</p>\n\n<p>Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula.</p>\n\n<p>Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim. Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\n\n<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:500px\" summary=\"5\">\n	<caption>Nama-Nama Orang</caption>\n	<thead>\n		<tr>\n			<th scope=\"col\">Nama</th>\n			<th scope=\"col\">Alamat</th>\n			<th scope=\"col\">Tempat Lahir</th>\n			<th scope=\"col\">Jurusan</th>\n		</tr>\n	</thead>\n	<tbody>\n		<tr>\n			<td>Nama A</td>\n			<td>Alamat A</td>\n			<td>Tempat Lahir A</td>\n			<td>Jurusan A</td>\n		</tr>\n		<tr>\n			<td>Nama B</td>\n			<td>Alamat B</td>\n			<td>Tempat Lahir B</td>\n			<td>Jurusan C</td>\n		</tr>\n		<tr>\n			<td>Nama C</td>\n			<td>Alamat C</td>\n			<td>Tempat Lahir C</td>\n			<td>Jurusan D</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.</p>\n\n<p>Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci.</p>\n\n<p>Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula. Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim. Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\n\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit.</p>\n\n<h2><span style=\"color:#f39c12\"><q><span style=\"font-family:Tahoma,Geneva,sans-serif\">Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. </span></q></span></h2>\n\n<p>Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula. Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim. Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\n\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula. Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim. Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\n', '2021-12-16 09:39:45', '2021-08-18 09:39:45', 'budia', 'budi', 'budi', NULL, 1, 1, 1, 1),
(10, 'Informasi', 'informasi', '1.jpeg', '/templet/gambar-berita', '<p><strong>Informasi</strong> adalah pesan (ucapan atau ekspresi) atau kumpulan pesan yang terdiri dari order sekuens dari simbol, atau makna yang dapat ditafsirkan dari pesan atau kumpulan pesan. Informasi dapat direkam atau ditransmisikan. Hal ini dapat dicatat sebagai tanda-tanda, atau sebagai sinyal berdasarkan gelombang. Informasi adalah jenis acara yang mempengaruhi suatu negara dari sistem dinamis. Para konsep memiliki banyak arti lain dalam konteks yang berbeda.</p>\r\n\r\n<p>Informasi bisa dikatakan sebagai pengetahuan yang didapatkan dari pembelajaran, pengalaman, atau instruksi. Informasi telah digunakan untuk seluruh segi kehidupan manusia secara individual, kelompok maupun organisasi. Pada tingkat individu, informasi digunakan untuk pengetahuan tentang pendidikan, kesehatan, lapangan pekerjaan maupun jenis produk atau jasa. Kegunaan informasi ditentukan oleh tujuan pengguna, ketelitian pengolahan data, ruang dan waktu serta bentuk dan keadaan semantik.</p>\r\n', '2021-08-21 08:45:09', '2021-08-19 08:45:09', 'Wikipedia Ensiklopedia', 'budi', 'budi', NULL, 1, 1, 2, 1),
(11, 'Etimologi', 'etimologi', 'default.jpg', '/templet/gambar-berita', '<p>Kata informasi berasal dari kata Perancis kuno <em>informacion</em> (tahun 1387) yang diambil dari bahasa Latin <em>informationem</em> yang berarti &ldquo;garis besar, konsep, ide&rdquo;. Informasi merupakan kata benda dari <em>informare</em> yang berarti aktivitas dalam &ldquo;pengetahuan yang dikomunikasikan&rdquo;.</p>\r\n\r\n<p>Informasi merupakan fungsi penting untuk membantu mengurangi rasa cemas seseorang. Menurut Notoatmodjo (2008) bahwa semakin banyak informasi dapat memengaruhi atau menambah pengetahuan seseorang dan dengan pengetahuan menimbulkan kesadaran yang akhirnya seseorang akan berperilaku sesuai dengan pengetahuan yang dimilikinya.</p>\r\n\r\n<p>Para Yunani kuno kata untuk <em>form</em> adalah (<em>morphe</em>; cf. morph) dan juga (<em>eidos</em>) &quot;ide, bentuk, set&quot;, kata yang terakhir ini biasa digunakan dalam pengertian teknis filosofis oleh Plato (dan kemudian Aristoteles) untuk menunjukkan identitas yang ideal atau esensi dari sesuatu. &quot;Eidos&quot; juga dapat dikaitkan dengan pikiran, proposisi atau bahkan konsep.</p>\r\n\r\n<p>Namun, istilah ini memiliki banyak arti bergantung pada konteksnya, dan secara umum berhubungan erat dengan konsep seperti arti, pengetahuan, negentropy, Persepsi, Stimulus, komunikasi, kebenaran, representasi, dan rangsangan mental.</p>\r\n\r\n<p>Dalam beberapa hal pengetahuan tentang peristiwa-peristiwa tertentu atau situasi yang telah dikumpulkan atau diterima melalui proses komunikasi, pengumpulan intelejen, ataupun didapatkan dari berita juga dinamakan informasi. Informasi yang berupa koleksi data dan fakta sering kali dinamakan informasi statistik. Dalam bidang ilmu komputer, informasi adalah data yang disimpan, diproses, atau ditransmisikan. Penelitian ini memfokuskan pada definisi informasi sebagai pengetahuan yang didapatkan dari pembelajaran, pengalaman, atau instruksi dan alirannya.</p>\r\n\r\n<p>Informasi adalah data yang telah diberi makna melalui konteks. Sebagai contoh, dokumen berbentuk spreadsheet (semisal dari Microsoft Excel) sering kali digunakan untuk membuat informasi dari data yang ada di dalamnya. Laporan laba rugi dan neraca merupakan bentuk informasi, sementara angka-angka di dalamnya merupakan data yang telah diberi konteks sehingga menjadi punya makna dan manfaat.</p>\r\n\r\n<p>Informasi merupakan hasil dari pengolahan data sehingga menjadi bentuk yang penting bagi penerimanya dan mempunyai kegunaan sebagai dasar dalam pengambilan keputusan yang dapat dirasakan akibatnya secara langsung saat itu juga atau secara tidak langsung pada saat mendatang (Sutanta, 2011).&nbsp;Informasi adalah&nbsp; data yang telah di rangkum atau di manipulasi dalam bentuk lain untuk tujuan pengambilan keputusan (William, 2007).</p>\r\n\r\n<p>Sedangkan menurut (Fajri, 2014)&nbsp; informasi dapat diartikan suatu data yang telah diproses dan diubah menjadi konteks yang berarti sehingga memiliki makna dan nilai bagi penerimanya dan biasa digunakan untuk pengambilan keputusan.</p>\r\n', '2021-08-19 08:53:12', '2021-08-19 08:53:12', 'Wikipedia Ensiklopedia', 'budi', 'budi', NULL, 1, 1, 2, 1),
(15, 'Perbedaan Visi', 'perbedaan-visi', 'default.jpg', '/templet/gambar-berita', '<p><strong>Merdeka.com - </strong> Visi dan misi merupakan suatu kata yang mungkin tidak asing lagi bagi kita semua. Kita kerap mendengarnya entah di sekolah, di tempat kerja atau di instansi pemerintah.</p>\r\n\r\n<p>Kita juga pasti sering mendengar visi dan misi diucapkan oleh orang yang hendak mencalonkan diri dalam pemilu. Biasanya visi misi disampaikan untuk menggambarkan rencana yang akan menjadi tujuan instansi maupun kepentingan seseorang ke depannya.</p>\r\n\r\n<p>Meskipun sering mendengar visi misi, banyak dari kita yang masih sering tak bisa membedakan antara visi dan misi. Tak hanya itu barang kali sebenarnya kita pun tidak mengerti pengertian yang benar mengenai visi dan misi itu sendiri.</p>\r\n\r\n<p>Maka dari itu agar pemahaman mengenai visi dan misi tidak keliru baiknya kamu mengetahui tentang pengertian dan juga perbedaan antara visi dan Misi. Berikut ini perbedaan visi dan misi yang wajib diketahui telah dirangkum merdeka.com dari liputan6.com.</p>\r\n', '2021-08-20 07:21:28', '2021-08-20 07:21:28', 'Meriana', 'budi', 'budi', NULL, 1, 1, 5, 1),
(16, 'Perbedaan Misi', 'perbedaan-misi', 'default.jpg', '/templet/gambar-berita', '<p><strong>Merdeka.com - </strong> Visi dan misi merupakan suatu kata yang mungkin tidak asing lagi bagi kita semua. Kita kerap mendengarnya entah di sekolah, di tempat kerja atau di instansi pemerintah.</p>\r\n\r\n<p>Kita juga pasti sering mendengar visi dan misi diucapkan oleh orang yang hendak mencalonkan diri dalam pemilu. Biasanya visi misi disampaikan untuk menggambarkan rencana yang akan menjadi tujuan instansi maupun kepentingan seseorang ke depannya.</p>\r\n\r\n<p>Meskipun sering mendengar visi misi, banyak dari kita yang masih sering tak bisa membedakan antara visi dan misi. Tak hanya itu barang kali sebenarnya kita pun tidak mengerti pengertian yang benar mengenai visi dan misi itu sendiri.</p>\r\n\r\n<p>Maka dari itu agar pemahaman mengenai visi dan misi tidak keliru baiknya kamu mengetahui tentang pengertian dan juga perbedaan antara visi dan Misi. Berikut ini perbedaan visi dan misi yang wajib diketahui telah dirangkum merdeka.com dari liputan6.com.</p>\r\n', '2021-08-20 07:23:10', '2021-08-20 07:23:10', 'Agustin', 'budi', 'budi', NULL, 1, 1, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bidang`
--

CREATE TABLE `bidang` (
  `id` int NOT NULL,
  `opd_hdr_id` int NOT NULL,
  `kode` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_bidang` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tipe_bidang_id` int DEFAULT NULL,
  `created_date` timestamp NOT NULL,
  `last_modified_date` timestamp NULL DEFAULT NULL,
  `is_active` smallint NOT NULL,
  `user_created` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_updated` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `notess` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `bidang`
--

INSERT INTO `bidang` (`id`, `opd_hdr_id`, `kode`, `nama_bidang`, `tipe_bidang_id`, `created_date`, `last_modified_date`, `is_active`, `user_created`, `user_updated`, `notess`) VALUES
(1, 1, 'SEKRE', 'SEKRETARIAT', 1, '2021-06-10 07:35:03', '2021-06-10 07:35:03', 1, 'analyst', NULL, NULL),
(2, 1, 'BID-PK', 'BIDANG PENCEGAHAN DAN KESIAPSIAGAAN', 2, '2021-06-10 07:41:07', '2021-06-10 07:41:07', 1, 'analyst', NULL, NULL),
(3, 1, 'BID-KL', 'BIDANG KEDARURATAN DAN LOGISTIK', 2, '2021-06-29 01:20:17', '2021-06-29 01:20:17', 1, 'chelsea', 'isyana', NULL),
(4, 2, 'SEKRE', 'SEKRETARIAT', 1, '2021-07-02 02:08:20', '2021-07-02 02:08:20', 1, 'messigoat', NULL, NULL),
(5, 2, 'BID-PP', 'BIDANG PEMBINAAN DAN PENGOLAHAN DATA', 2, '2021-07-02 02:09:16', '2021-07-02 02:09:16', 1, 'messigoat', 'messigoat', NULL),
(6, 2, 'BID-SDM', 'BIDANG PERENCANAAN DAN PENGEMBANGAN SDM', 2, '2021-07-02 02:41:33', '2021-07-02 02:41:33', 1, 'messigoat', NULL, NULL),
(7, 2, 'BID-MP', 'BIDANG MUTASI PEGAWAI', 2, '2021-07-02 02:42:10', '2021-07-02 02:42:10', 1, 'messigoat', 'messigoat', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `golongan_pegawai`
--

CREATE TABLE `golongan_pegawai` (
  `id` smallint NOT NULL,
  `nama_golongan` varchar(100) DEFAULT NULL,
  `kode` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `golongan_pegawai`
--

INSERT INTO `golongan_pegawai` (`id`, `nama_golongan`, `kode`) VALUES
(1, 'JURU MUDA', 'I A'),
(2, 'JURU MUDA TINGKAT 1', 'I B'),
(3, 'JURU', 'I C'),
(4, 'JURU TINGKAT 1', 'I D'),
(5, 'PENGATUR MUDA', 'II A'),
(6, 'PENGATUR MUDA TINGKAT 1', 'II B'),
(7, 'PENGATUR', 'II C'),
(8, 'PENGATUR TINGKAT 1', 'II D'),
(9, 'PENATA MUDA', 'III A'),
(10, 'PENATA MUDA TINGKAT 1', 'III B'),
(11, 'PENATA', 'III C'),
(12, 'PENATA TINGKAT 1', 'III D'),
(13, 'PEMBINA', 'IV A'),
(14, 'PEMBINA TINGKAT 1', 'IV B'),
(15, 'PEMBINA UTAMA MUDA', 'IV C'),
(16, 'PEMBINA UTAMA MADYA', 'IV D'),
(17, 'PEMBINA UTAMA', 'IV E');

-- --------------------------------------------------------

--
-- Table structure for table `hak_akses_dtl`
--

CREATE TABLE `hak_akses_dtl` (
  `id` int NOT NULL,
  `hak_akses_hdr_id` int NOT NULL,
  `modul_id` int NOT NULL,
  `created_date` timestamp NOT NULL,
  `last_modified_date` timestamp NULL DEFAULT NULL,
  `user_created` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_updated` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `is_active` smallint NOT NULL,
  `notes` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `is_view` tinyint NOT NULL,
  `is_insert` tinyint NOT NULL,
  `is_update` tinyint NOT NULL,
  `is_delete` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `hak_akses_dtl`
--

INSERT INTO `hak_akses_dtl` (`id`, `hak_akses_hdr_id`, `modul_id`, `created_date`, `last_modified_date`, `user_created`, `user_updated`, `is_active`, `notes`, `is_view`, `is_insert`, `is_update`, `is_delete`) VALUES
(1, 1, 1, '2021-08-12 08:07:27', NULL, 'analyst', NULL, 1, NULL, 1, 1, 1, 1),
(2, 1, 2, '2021-08-12 08:07:27', NULL, 'analyst', NULL, 1, NULL, 1, 1, 1, 1),
(3, 1, 3, '2021-08-12 08:07:27', NULL, 'analyst', NULL, 1, NULL, 1, 1, 1, 1),
(4, 1, 4, '2021-08-12 08:07:27', NULL, 'analyst', NULL, 1, NULL, 1, 1, 1, 1),
(5, 1, 5, '2021-08-12 08:07:27', NULL, 'analyst', NULL, 1, NULL, 1, 1, 1, 1),
(6, 2, 1, '2021-08-12 08:08:20', NULL, 'analyst', NULL, 1, NULL, 1, 1, 1, 1),
(7, 2, 2, '2021-08-12 08:08:20', NULL, 'analyst', NULL, 1, NULL, 1, 1, 1, 1),
(8, 2, 3, '2021-08-12 08:08:20', NULL, 'analyst', NULL, 1, NULL, 1, 1, 1, 1),
(9, 2, 4, '2021-08-12 08:08:20', NULL, 'analyst', NULL, 1, NULL, 1, 1, 1, 1),
(10, 2, 5, '2021-08-12 08:08:20', NULL, 'analyst', NULL, 1, NULL, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hak_akses_hdr`
--

CREATE TABLE `hak_akses_hdr` (
  `id` int NOT NULL,
  `kode` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_date` timestamp NOT NULL,
  `last_modified_date` timestamp NULL DEFAULT NULL,
  `is_active` smallint NOT NULL,
  `is_visible` smallint NOT NULL,
  `user_created` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_updated` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `notes` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama_hak_akses` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `hak_akses_hdr`
--

INSERT INTO `hak_akses_hdr` (`id`, `kode`, `created_date`, `last_modified_date`, `is_active`, `is_visible`, `user_created`, `user_updated`, `notes`, `nama_hak_akses`) VALUES
(0, 'SU', '2021-06-12 00:44:03', NULL, 1, 0, 'analyst', NULL, NULL, 'SUPER USER'),
(1, 'ADM', '2021-06-12 00:41:38', NULL, 1, 1, 'analyst', NULL, NULL, 'ADMINISTRATOR'),
(2, 'USR', '2021-06-12 00:42:44', NULL, 1, 1, 'analyst', NULL, NULL, 'USER');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int NOT NULL,
  `bidang_id` int DEFAULT NULL,
  `sub_bidang_id` int DEFAULT NULL,
  `kode` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `level` smallint NOT NULL,
  `nama_jabatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_date` timestamp NOT NULL,
  `last_modified_date` timestamp NULL DEFAULT NULL,
  `is_active` smallint NOT NULL,
  `user_created` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_updated` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `notes` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `opd_hdr_id` int DEFAULT NULL,
  `hak_akses_hdr_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `bidang_id`, `sub_bidang_id`, `kode`, `level`, `nama_jabatan`, `created_date`, `last_modified_date`, `is_active`, `user_created`, `user_updated`, `notes`, `opd_hdr_id`, `hak_akses_hdr_id`) VALUES
(0, NULL, NULL, 'SU', 0, 'SUPER USER', '2021-06-29 07:01:41', '2021-06-29 07:01:41', 1, 'analyst', NULL, NULL, NULL, 0),
(1, 3, 5, 'KASI-KES', 3, 'KEPALA SEKSI KESIAPSIAGAAN', '2021-06-12 02:34:21', '2021-06-12 02:34:21', 1, 'analyst', 'uzumaki', '', 1, 2),
(2, 2, NULL, 'KABID-PK', 2, 'KEPALA BIDANG PENCEGAHAN DAN KESIAPSIAGAAN', '2021-06-12 01:08:54', '2021-06-12 01:08:54', 1, 'analyst', NULL, NULL, 1, 2),
(3, 1, NULL, 'SEKRE', 2, 'SEKRETARIS', '2021-06-12 01:39:21', '2021-06-12 01:39:21', 1, 'analyst', NULL, NULL, 1, 2),
(4, NULL, NULL, 'KABAN', 1, 'KEPALA BADAN PENANGGULANGAN BENCANA DAERAH', '2021-06-12 01:39:53', '2021-06-12 01:39:53', 1, 'analyst', NULL, NULL, 1, 2),
(5, 1, 1, 'KASUBAG-PER', 3, 'KEPALA SUBBAGIAN PERENCANAAN', '2021-06-12 02:05:32', '2021-06-12 02:05:32', 1, 'analyst', NULL, NULL, 1, 1),
(6, 1, 2, 'KASUBAG-KEU', 3, 'KEPALA SUBBAGIAN KEUANGAN', '2021-06-12 02:08:13', '2021-06-12 02:08:13', 1, 'analyst', NULL, NULL, 1, 2),
(7, 1, 3, 'KASUBAG-UK', 3, 'KEPALA SUBBAGIAN UMUM DAN KEPEGAWAIAN', '2021-06-12 02:09:14', '2021-06-12 02:09:14', 1, 'analyst', NULL, NULL, 1, 2),
(8, 2, 4, 'KASI-PEN', 3, 'KEPALA SEKSI PENCEGAHAN', '2021-06-12 02:32:09', '2021-06-12 02:32:09', 1, 'analyst', NULL, NULL, 1, 2),
(9, 2, 5, 'SI-KES', 4, 'STAF SEKSI KESIAPSIAGAAN', '2021-06-12 02:46:31', '2021-06-12 02:46:31', 1, 'analyst', NULL, NULL, 1, 2),
(10, 2, 4, 'SI-PEN', 4, 'STAF SEKSI PENCEGAHAN', '2021-06-12 07:15:16', '2021-06-12 07:15:16', 1, 'analyst', NULL, NULL, 1, 2),
(11, 1, 3, 'SUBBAG-UK', 4, 'STAF SUBBAGIAN UMUM DAN KEPEGAWAIAN', '2021-06-12 07:20:39', '2021-06-12 07:20:39', 1, 'analyst', NULL, NULL, 1, 2),
(12, 1, 2, 'SUBBAG-KEU', 4, 'STAF SUBBAGIAN KEUANGAN', '2021-06-12 07:23:14', '2021-06-12 07:23:14', 1, 'analyst', NULL, NULL, 1, 2),
(13, 1, 1, 'SUBBAG-PER', 4, 'STAF SUBBAGIAN PERENCANAAN', '2021-06-12 07:27:56', '2021-06-12 07:27:56', 1, 'analyst', NULL, NULL, 1, 2),
(14, NULL, NULL, 'ADM', 0, 'ADMINISTRATOR', '2021-06-28 08:12:38', '2021-06-28 08:12:38', 1, 'analyst', 'bunga', NULL, 1, 1),
(15, NULL, NULL, 'ADM', 0, 'ADMINISTRATOR', '2021-06-30 08:07:43', '2021-06-30 08:07:43', 1, 'analyst', 'budi', NULL, 2, 1),
(16, NULL, NULL, 'KABAN', 1, 'KEPALA BADAN KEPEGAWAIAN DAERAH', '2021-07-02 05:29:48', '2021-07-02 05:29:48', 1, 'messigoat', NULL, NULL, 2, 2),
(17, 4, NULL, 'SEKRE', 2, 'SEKRETARIS', '2021-07-02 05:29:50', '2021-07-02 05:29:50', 1, 'messigoat', NULL, NULL, 2, 2),
(18, 5, NULL, 'KABID-PP', 2, 'KEPALA BIDANG PEMBINAAN DAN PENGOLAHAN DATA', '2021-07-02 05:29:52', '2021-07-02 05:29:52', 1, 'messigoat', NULL, NULL, 2, 2),
(19, 6, NULL, 'KABID-SDM', 2, 'KEPALA BIDANG PERENCANAAN DAN PENGEMBANGAN SDM', '2021-07-02 05:29:53', '2021-07-02 05:29:53', 1, 'messigoat', NULL, NULL, 2, 2),
(20, 7, NULL, 'KABID-MP', 2, 'KEPALA BIDANG MUTASI PEGAWAI', '2021-07-02 05:29:54', '2021-07-02 05:29:54', 1, 'messigoat', NULL, NULL, 2, 2),
(21, 4, 8, 'KASUBAG-UK', 3, 'KEPALA SUBBAGIAN UMUM DAN KEPEGAWAIAN', '2021-07-02 05:29:55', '2021-07-02 05:29:55', 1, 'messigoat', NULL, NULL, 2, 2),
(22, 4, 9, 'KASUBAG-RK', 3, 'KEPALA SUBBAGIAN RENVAL DAN KEUANGAN', '2021-07-02 05:29:56', '2021-07-02 05:29:56', 1, 'messigoat', NULL, NULL, 2, 2),
(23, 5, 10, 'KASUBID-PI', 3, 'KEPALA SUBBIDANG PEMBINAAN DAN DISIPLIN PNS', '2021-07-02 05:29:58', '2021-07-02 05:29:58', 1, 'messigoat', NULL, NULL, 2, 2),
(24, 5, 11, 'KASUBID-PD', 3, 'KEPALA SUBBIDANG PENGOLAHAN DATA DAN INFORMASI APARATUR', '2021-07-02 05:29:59', '2021-07-02 05:29:59', 1, 'messigoat', NULL, NULL, 2, 2),
(25, 6, 12, 'KASUBID-PF', 3, 'KEPALA SUBBIDANG PERENCANAAN DAN FORMASI', '2021-07-02 05:30:00', '2021-07-02 05:30:00', 1, 'messigoat', NULL, NULL, 2, 2),
(26, 6, 13, 'KASUBID-PS', 3, 'KEPALA SUBBIDANG PENGEMBANGAN SDM', '2021-07-02 05:30:01', '2021-07-02 05:30:01', 1, 'messigoat', NULL, NULL, 2, 2),
(27, 7, 14, 'KASUBID-PP', 3, 'KEPALA SUBBIDANG PENGANGKATAN DAN KEPANGKATAN', '2021-07-02 05:30:02', '2021-07-02 05:30:02', 1, 'messigoat', NULL, NULL, 2, 2),
(28, 7, 15, 'KASUBID-PPP', 3, 'KEPALA SUBBIDANG PEMINDAHAN, PEMBERHENTIAN DAN PENSIUN', '2021-07-02 05:30:03', '2021-07-02 05:30:03', 1, 'messigoat', NULL, NULL, 2, 2),
(29, 4, 8, 'SUBBAG-UK', 4, 'STAF SUBBAGIAN UMUM DAN KEPEGAWAIAN', '2021-07-02 05:30:04', '2021-07-02 05:30:04', 1, 'messigoat', NULL, NULL, 2, 2),
(30, 4, 9, 'SUBBAG-RK', 4, 'STAF SUBBAGIAN RENVAL DAN KEUANGAN', '2021-07-02 05:30:05', '2021-07-02 05:30:05', 1, 'messigoat', NULL, NULL, 2, 2),
(31, 5, 10, 'SUBBID-PI', 4, 'STAF SUBBIDANG PEMBINAAN DAN DISIPLIN PNS', '2021-07-02 05:30:06', '2021-07-02 05:30:06', 1, 'messigoat', NULL, NULL, 2, 2),
(32, 5, 11, 'SUBBID-PD', 4, 'STAF SUBBIDANG PENGOLAHAN DATA DAN INFORMASI APARATUR', '2021-07-02 05:30:07', '2021-07-02 05:30:07', 1, 'messigoat', NULL, NULL, 2, 2),
(33, 6, 12, 'SUBBID-PF', 4, 'STAF SUBBIDANG PERENCANAAN DAN FORMASI', '2021-07-02 05:30:08', '2021-07-02 05:30:08', 1, 'messigoat', NULL, NULL, 2, 2),
(34, 6, 13, 'SUBBID-PS', 4, 'STAF SUBBIDANG PENGEMBANGAN SDM', '2021-07-02 05:30:09', '2021-07-02 05:30:09', 1, 'messigoat', NULL, NULL, 2, 2),
(35, 7, 14, 'SUBBID-PP', 4, 'STAF SUBBIDANG PENGANGKATAN DAN KEPANGKATAN', '2021-07-02 05:30:10', '2021-07-02 05:30:10', 1, 'messigoat', NULL, NULL, 2, 2),
(36, 7, 15, 'SUBBID-PPP', 4, 'STAF SUBBIDANG PEMINDAHAN, PEMBERHENTIAN DAN PENSIUN', '2021-07-02 05:30:11', '2021-07-02 05:30:11', 1, 'messigoat', NULL, NULL, 2, 2),
(38, NULL, NULL, 'ADM', 0, 'ADMINISTRATOR', '2021-07-26 13:25:56', '2021-07-26 13:25:56', 1, 'superuser', NULL, NULL, 3, 1),
(39, NULL, NULL, 'ADM', 0, 'ADMINISTRATOR', '2021-08-14 04:57:33', '2021-08-14 04:57:33', 1, 'superuser', NULL, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lampiran_artikel`
--

CREATE TABLE `lampiran_artikel` (
  `id` int NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `artikel_id` int NOT NULL,
  `status_sistem_id` smallint NOT NULL,
  `user_created` varchar(50) NOT NULL,
  `user_updated` varchar(50) NOT NULL,
  `created_date` timestamp NOT NULL,
  `last_modified_date` timestamp NOT NULL,
  `notes` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `level_jabatan`
--

CREATE TABLE `level_jabatan` (
  `id` smallint NOT NULL,
  `kode` varchar(100) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `level_jabatan`
--

INSERT INTO `level_jabatan` (`id`, `kode`, `notes`) VALUES
(0, '0', 'superuser/administrator'),
(1, '1', 'jabatan tertinggi dalam OPD (kepala Dinas/Bidang)'),
(2, '2', 'Kepala Bagian/Sekretaris'),
(3, '3', 'Kepala Subbagian/Seksi'),
(4, '4', 'Staf');

-- --------------------------------------------------------

--
-- Table structure for table `level_opd`
--

CREATE TABLE `level_opd` (
  `id` smallint NOT NULL,
  `nama_level` varchar(100) NOT NULL,
  `kode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `level_opd`
--

INSERT INTO `level_opd` (`id`, `nama_level`, `kode`) VALUES
(1, 'BUPATI', '1'),
(2, 'SETDA', '2'),
(3, 'OPD', '3');

-- --------------------------------------------------------

--
-- Table structure for table `log_logins`
--

CREATE TABLE `log_logins` (
  `id` int NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `usr` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `pegawai_id` int DEFAULT NULL,
  `created_date` timestamp NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `log_logins`
--

INSERT INTO `log_logins` (`id`, `ip_address`, `usr`, `pegawai_id`, `created_date`, `success`) VALUES
(1, '', 'budi46@gmail.com', 1, '2021-07-05 07:46:54', 1),
(2, '', 'budi46@gmail.com', 1, '2021-07-05 07:47:27', 0),
(3, '', NULL, 1, '2021-07-05 07:49:51', 0),
(4, '', NULL, 1, '2021-07-05 07:49:54', 1),
(5, '', 'budi46@gmail.com', 1, '2021-07-05 07:51:17', 1),
(6, '', 'budi', 1, '2021-07-05 07:51:23', 1),
(7, '', 'budi', 1, '2021-07-05 08:24:43', 0),
(8, '', 'budi46@gmail.com', 1, '2021-07-05 08:54:00', 0),
(9, '', 'budi46@gmail.com', 1, '2021-07-05 08:54:21', 1),
(10, '', 'budi46@gmail.com', 1, '2021-07-06 06:49:44', 1),
(11, '', 'budi', 1, '2021-07-06 06:51:08', 1),
(12, '', 'budi', 1, '2021-07-06 06:53:41', 0),
(13, '', 'budi', 1, '2021-07-06 06:54:11', 1),
(14, '', 'budi', 1, '2021-07-06 06:54:24', 1),
(15, '', 'budi', 1, '2021-07-07 02:43:04', 1),
(16, '', 'budi', 1, '2021-07-07 02:44:56', 1),
(17, '', 'budi', 1, '2021-07-07 02:48:22', 1),
(18, '', 'budi', 1, '2021-07-07 02:57:03', 1),
(19, '', 'budi', 1, '2021-07-07 02:57:06', 0),
(20, '', 'budi', 1, '2021-07-07 05:09:55', 0),
(21, '', 'budi', 1, '2021-07-07 05:10:02', 1),
(22, '', 'budi', 1, '2021-07-07 05:11:23', 1),
(23, '', 'budi', 1, '2021-07-07 05:11:31', 0),
(24, '', 'budi', 1, '2021-07-07 05:11:38', 1),
(25, '', 'budi', 1, '2021-07-07 05:11:42', 0),
(26, '', 'budi', 1, '2021-07-07 05:11:49', 1),
(27, '', 'budi', 1, '2021-07-07 07:49:40', 0),
(28, '', 'budi', 1, '2021-07-07 07:57:17', 1),
(29, '', 'superuser', 0, '2021-07-07 08:32:44', 1),
(30, '', 'budi', 1, '2021-07-07 08:36:01', 1),
(31, '', 'budi', 1, '2021-07-07 08:36:04', 0),
(32, '', 'budi', 1, '2021-07-07 08:45:46', 0),
(33, '', 'budi', 1, '2021-07-07 08:46:02', 1),
(34, '', 'budi', 1, '2021-07-07 08:46:23', 0),
(35, '', 'budi', 1, '2021-07-07 08:46:27', 1),
(36, '', 'budi', 1, '2021-07-08 02:18:18', 1),
(37, '', 'chelsea', 5, '2021-07-08 07:25:38', 1),
(38, '', 'chelsea', 5, '2021-07-08 07:28:12', 0),
(39, '', 'chelsea', 5, '2021-07-08 07:28:53', 0),
(40, '', 'chelsea', 5, '2021-07-08 07:29:10', 1),
(41, '', 'chelsea', 5, '2021-07-08 07:29:42', 1),
(42, '::1', 'budi46@gmail.com', 1, '2021-07-16 08:06:28', 1),
(43, '', 'budi', 1, '2021-07-16 08:07:10', 1),
(44, '', 'budi46@gmail.com', 1, '2021-07-16 08:07:40', 1),
(45, '', 'budi46@gmail.com', 1, '2021-07-16 08:07:41', 1),
(46, '', 'budi', 1, '2021-07-16 08:08:19', 1),
(47, '::1', 'budi', 1, '2021-07-16 08:14:53', 1),
(48, '', 'superuser', 0, '2021-07-20 00:43:40', 1),
(49, '', 'superuser', 0, '2021-07-20 01:23:06', 1),
(50, '::1', 'budi', 1, '2021-07-22 00:04:27', 1),
(51, '', 'budi', 1, '2021-07-26 06:06:22', 1),
(52, '::1', 'budi', 1, '2021-07-27 06:23:04', 1),
(53, '::1', 'luis', 2, '2021-07-27 06:24:05', 1),
(54, '::1', 'chelsea', 5, '2021-07-27 06:26:52', 1),
(55, '::1', 'superuser', 0, '2021-07-27 06:28:58', 1),
(56, '::1', 'bunga', 3, '2021-08-19 00:51:13', 1),
(57, '::1', 'budi46@gmail.com', 1, '2021-08-19 05:16:24', 0),
(58, '::1', 'budi46@gmail.com', 1, '2021-08-19 05:16:28', 1),
(59, '::1', 'budi46@gmail.com', 1, '2021-08-20 04:19:50', 1),
(60, '::1', 'budi46@gmail.com', 1, '2021-08-20 04:27:31', 1),
(61, '::1', 'budi46@gmail.com', 1, '2021-08-21 03:04:36', 1),
(62, '::1', 'budi46@gmail.com', 1, '2021-08-23 01:22:13', 1),
(63, '::1', 'budi46@gmail.com', 1, '2021-08-23 04:36:48', 1),
(64, '::1', 'budi46@gmail.com', 1, '2021-08-24 01:21:48', 1),
(65, '::1', 'budi46@gmail.com', 1, '2021-08-25 01:24:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `log_reset`
--

CREATE TABLE `log_reset` (
  `id` int UNSIGNED NOT NULL,
  `pegawai_id` int NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `notes` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_date` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `log_reset`
--

INSERT INTO `log_reset` (`id`, `pegawai_id`, `ip_address`, `notes`, `created_date`) VALUES
(4, 5, '', '', '2021-07-08 07:56:27'),
(5, 6, '', '', '2021-07-08 07:56:32'),
(6, 6, '', '', '2021-07-08 07:57:03'),
(7, 6, '', '', '2021-07-08 08:03:32');

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE `modul` (
  `id` int NOT NULL,
  `kode` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_modul` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `url` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_date` timestamp NOT NULL,
  `last_modified_date` timestamp NULL DEFAULT NULL,
  `user_created` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_updated` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `is_active` tinyint NOT NULL,
  `notes` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id`, `kode`, `nama_modul`, `url`, `created_date`, `last_modified_date`, `user_created`, `user_updated`, `is_active`, `notes`) VALUES
(1, 'MSTR', 'MASTER', NULL, '2021-07-22 11:21:58', NULL, 'superuser', NULL, 1, NULL),
(2, 'PEMDA', 'ADMIN PEMDA', NULL, '2021-07-18 09:23:00', '2021-07-18 09:23:00', 'analyst', 'analyst', 1, NULL),
(3, 'OPD', 'ADMIN OPD', NULL, '2021-07-18 09:23:00', '2021-07-18 09:23:00', 'analyst', 'analyst', 1, NULL),
(4, 'E-SURAT', 'E-SURAT', NULL, '2021-07-18 09:23:00', '2021-07-18 09:23:00', 'analyst', 'analyst', 1, NULL),
(5, 'E-SAKIP', 'E-SAKIP', NULL, '2021-07-18 09:23:00', '2021-07-18 09:23:00', 'analyst', 'analyst', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `opd_hdr`
--

CREATE TABLE `opd_hdr` (
  `id` int NOT NULL,
  `kode` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `create_date` timestamp NOT NULL,
  `last_modified_date` timestamp NULL DEFAULT NULL,
  `is_active` smallint NOT NULL,
  `user_created` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_updated` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `notes` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `is_visible` smallint NOT NULL,
  `nama_opd` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat_opd` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kode_pos` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `telepon` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fax` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `website` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `level` smallint NOT NULL,
  `nomor_unit_kerja` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `opd_hdr`
--

INSERT INTO `opd_hdr` (`id`, `kode`, `create_date`, `last_modified_date`, `is_active`, `user_created`, `user_updated`, `notes`, `is_visible`, `nama_opd`, `alamat_opd`, `kode_pos`, `telepon`, `fax`, `email`, `website`, `level`, `nomor_unit_kerja`) VALUES
(0, 'PEMDA', '2021-08-14 02:06:46', '2021-08-14 02:06:46', 1, 'analyst', 'analyst', NULL, 0, 'PEMERINTAH DAERAH KABUPATEN INTAN JAYA', 'Intan Jaya', NULL, NULL, NULL, NULL, NULL, 1, NULL),
(1, 'BPBD', '2021-06-10 06:50:26', '2021-06-10 06:50:26', 1, 'analyst', 'budi', NULL, 1, 'BADAN PENANGGULANGAN BENCANA DAERAH', 'Intan Jaya', '', '\'', '\'', '\'', '\'', 3, 'BPBD'),
(2, 'BKD', '2021-06-28 06:18:58', '2021-06-28 06:18:58', 1, 'decul', 'melina', NULL, 1, 'BADAN KEPEGAWAIAN DAERAH', 'Intan Jaya', NULL, NULL, NULL, NULL, NULL, 3, NULL),
(3, 'D', '2021-07-26 13:25:56', '2021-07-26 13:25:56', 1, 'superuser', NULL, NULL, 1, 'BADAN KEPEGAWAIAN DAERAH', 'Intan Jaya', NULL, NULL, NULL, NULL, NULL, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int NOT NULL,
  `jabatan_id` int NOT NULL,
  `nip` decimal(20,0) NOT NULL,
  `created_date` timestamp NOT NULL,
  `last_modified_date` timestamp NULL DEFAULT NULL,
  `user_created` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_updated` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `is_active` smallint NOT NULL,
  `notes` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama_pegawai` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nik` decimal(20,0) NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `passwd` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `golongan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `kode` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jenis_kelamin` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jenis_kelamin_code` int NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `no_hp` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `golongan_id` smallint DEFAULT NULL,
  `is_pegawai` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `jabatan_id`, `nip`, `created_date`, `last_modified_date`, `user_created`, `user_updated`, `is_active`, `notes`, `nama_pegawai`, `nik`, `username`, `passwd`, `golongan`, `kode`, `jenis_kelamin`, `jenis_kelamin_code`, `email`, `no_hp`, `tanggal_lahir`, `golongan_id`, `is_pegawai`) VALUES
(0, 0, '0', '2021-06-29 07:12:59', NULL, 'analyst', NULL, 1, NULL, 'SUPER USER', '0', 'superuser', '283d792d1448626ea8de8796465921d92ab479a0bfdd884b4f032c76', '0', NULL, '0', 0, '0', '0', '2021-06-29', 13, 0),
(1, 4, '197810031999061001', '2021-06-12 05:33:17', NULL, 'analyst', NULL, 1, NULL, 'Ir. BUDI DARMAWAN', '311210031019780030', 'budi', '96ddd27790046823e76ab137709b1c000d7f87e352c3de0f0a272b1f', '4D', NULL, 'LAKI-LAKI', 1, 'budi46@gmail.com', '081234569987', '1978-10-03', 13, 1),
(2, 3, '198023122000071051', '2021-06-12 06:36:00', NULL, 'analyst', NULL, 1, NULL, 'drs. LUIS SUARES', '311210310219800556', 'luis', 'd082511be2028cda2657210f72d3917c64327c94cb6ac515f753b2c6', '4C', NULL, 'LAKI-LAKI', 1, 'ls@gmail.com', '081234560001', '1980-02-28', 13, 1),
(3, 2, '198223122000071000', '2021-06-13 01:49:29', NULL, 'analyst', NULL, 1, NULL, 'BUNGA CITRA LESTARI', '311210031019780031', 'bunga', '8ad63d542b9ef0d08841c551e8b10e4bb0067d09f4d3e27103e88e4e', '4A', NULL, 'PEREMPUAN', 2, 'bunga02@gmail.com', '081209876512', '1985-03-02', 13, 1),
(4, 1, '197810031999061882', '2021-06-13 08:55:00', NULL, 'analyst', NULL, 1, NULL, 'ANASTASIA PUTRI', '311210031019780098', 'anas', '0dbbafb3b8916a739b6dd732639201fab8f3badeb7259b3719fa8b17', '3D', NULL, 'PEREMPUAN', 2, 'putri@gmail.com', '081345359800', '1985-03-03', 13, 1),
(5, 5, '198223122000071034', '2021-06-13 01:52:10', NULL, 'analyst', NULL, 1, NULL, 'CHELSEA ISLAND', '311210031019900012', 'chelsea', 'eb800850d70ff5d8f703ec8438ae77771f92e413d38d7033fa845fcd', '3D', NULL, 'PEREMPUAN', 2, 'ci234@gmail.com', '08128876252', '1985-03-04', 13, 1),
(6, 6, '198223122000071035', '2021-06-13 01:52:12', NULL, 'analyst', NULL, 1, NULL, 'ABRAHAM ALEX', '311210031019900232', 'alex', '47804e5af4e381b9cf44d48f64fefe2ca4c38b287cfb1affd7551780', '3C', NULL, 'LAKI-LAKI', 1, 'aalex@gmail.com', '085200998723', '1985-03-05', 13, 1),
(7, 7, '198223122000071036', '2021-06-13 01:52:18', NULL, 'analyst', NULL, 1, NULL, 'EDISON CAVANI', '311210031019903399', 'eca', '456462c6cbdb6c743426548334f8f745768d306c30b8434f47b25ad3', '3D', NULL, 'LAKI-LAKI', 1, 'edicav@gmail.com', '081200928762', '1985-03-06', 13, 1),
(8, 8, '198223122000071037', '2021-06-13 01:52:22', NULL, 'analyst', NULL, 1, NULL, 'MERIAM BELINA', '311210031019909083', 'melina', '28fb63af98d2751b725ec72193415e0be0fc6d226d0910a2ee7e7518', '3B', NULL, 'PEREMPUAN', 2, 'merimeri@gmail.com', '081300983713', '1985-03-07', 13, 1),
(9, 9, '198223122000071038', '2021-06-13 01:53:05', NULL, 'analyst', NULL, 1, NULL, 'ISYANA SARASWATI', '311210031019907788', 'isyana', '3698f438d9bd354bd48e7c76abc47a4accf24d3ad30a5a19f505c6ec', '3C', NULL, 'PEREMPUAN', 2, 'isyana@gmail.com', '085200837373', '1985-03-08', 13, 1),
(10, 10, '198223122000071039', '2021-06-13 01:53:10', NULL, 'analyst', NULL, 1, NULL, 'XAVI HERNANDES', '311210031019900909', 'decul', '44506eb907d79c6af0b943216a8dc856a2b3cecfc2e724856d1444dd', '2D', NULL, 'LAKI-LAKI', 1, 'decul@gmail.com', '081117367136', '1985-03-09', 13, 1),
(11, 11, '198223122000071040', '2021-06-13 01:53:12', NULL, 'analyst', NULL, 1, NULL, 'DIAN SASTRO', '311210031019900998', 'dian', '37daeb8d2c83a4a7feb8a5ca3c7df83d4710368e40662ca357d0c91c', '3B', NULL, 'PEREMPUAN', 2, 'dian@gmail.com', '081137673893', '1985-03-10', 13, 1),
(12, 12, '198223122000071041', '2021-06-13 01:53:15', NULL, 'analyst', NULL, 1, NULL, 'MAMAN SUHERMAN', '311210031019909876', 'maman', '0b5ae95072ae13d9d92ea3c84273982c8cc4175fad7b80d9ccc6b761', '2D', NULL, 'LAKI-LAKI', 1, 'maman.suhe@gmail.com', '082127467211', '1985-03-11', 13, 1),
(13, 13, '198223122000071042', '2021-06-13 01:53:17', NULL, 'analyst', NULL, 1, NULL, 'YUDISTIRA UZUMAKI', '311210031019902345', 'uzumaki', 'e2f2d47482c69256948a2d3be1947635a53b5c6ed173284d90ead75f', '3A', NULL, 'LAKI-LAKI', 1, 'hokage@gmail.com', '085294863883', '1985-03-12', 13, 1),
(14, 13, '213231231232131223', '2021-06-30 08:10:34', '2021-07-02 01:44:51', 'analyst', 'superuser', 0, NULL, 'HERY TEBAI', '234324123123123232', 'hery', '5e87a411947d124a161e8577b18a39c065eb234a33a46a0a84893be7', '3A', NULL, 'LAKI-LAKI', 1, 'hery@gmail.com', '085425313213', '2021-06-30', 13, 1),
(15, 34, '454354352343423', '2021-07-01 06:04:45', '2021-07-01 07:04:49', 'chelsea', 'anas', 1, NULL, 'LIONEL MESSI', '213213213213213213', 'messigoat', '739b8cff5b859bdd7f0a4f4ddfab951317d900b79c16b7a961e7dd3a', '3D', '', 'PEREMPUAN', 1, 'messi@gmail.com', '08987675456', '1990-10-05', 13, 1),
(16, 16, '874365874857438', '2021-07-02 06:29:21', NULL, 'messigoat', NULL, 1, NULL, 'DANIEL WAKEI', '65848794034874043', 'aabb1', '2a245e2ab2cf836a73d4ad7940387ff716373aa98341c9733bb01c0a', '4D', NULL, 'LAKI-LAKI', 1, '1@gmail.com', '090895849', '2021-07-02', 13, 1),
(17, 17, '874657346587439', '2021-07-02 06:29:23', NULL, 'messigoat', NULL, 1, NULL, 'VINSENSIUS ANSIGA', '65848794034874044', 'aabb2', 'b9fe9789e63e78b4b2a56d2aaf9d653b30bf74285a295f246fc2fbef', '4A', NULL, 'LAKI-LAKI', 1, '2@gmail.com', '093487435', '2021-07-02', 13, 1),
(18, 18, '874987685476854', '2021-07-02 06:29:25', NULL, 'messigoat', NULL, 1, NULL, 'VINSENSIA ALINDA', '65848794034874045', 'aabb3', '34d4e1f4243ebd17ad97c4ae97c4418e986565d39898951e0caac5f2', '4A', NULL, 'PEREMPUAN', 2, '3@gmail.com', '0987584375', '2021-07-02', 13, 1),
(19, 19, '746573465873478', '2021-07-02 06:29:26', NULL, 'messigoat', NULL, 1, NULL, 'ALBERTO POLISCO', '65848794034874046', 'aabb4', 'dfd29c839b19eb018734e6bb35815fa0bc1097b4ac35921bda9f4162', '4A', NULL, 'LAKI-LAKI', 1, '4@gmail.com', '0548495849', '2021-07-02', 13, 1),
(20, 20, '532667847834980', '2021-07-02 06:29:27', NULL, 'messigoat', NULL, 1, NULL, 'MARDIAN BUNGA', '65848794034874047', 'aabb5', '39a403017ee8b6eeeabacf6239cc5af3dc57550f822874aef46f5481', '4A', NULL, 'LAKI-LAKI', 1, '5@gmail.com', '0985974983', '2021-07-02', 13, 1),
(21, 21, '378465873468947', '2021-07-02 06:29:28', NULL, 'messigoat', NULL, 1, NULL, 'EDWARD ARUNG', '65848794034874048', 'aabb6', '6a0c88a7d72cecb910ed7275e8d075dbe3f7053c7eabee8082751135', '4A', NULL, 'LAKI-LAKI', 1, '6@gmail.com', '0843975847', '2021-07-02', 13, 1),
(22, 22, '872346587468754', '2021-07-02 06:29:29', NULL, 'messigoat', NULL, 1, NULL, 'BASTIAN TEBAI', '32897589459489892', 'aabb7', 'b49b9ac6f4ba51340ec23187fe4db34096274941b1695d3bf1e61ef0', '4A', NULL, 'LAKI-LAKI', 1, '7@gmail.com', '0847584545', '2021-07-02', 13, 1),
(23, 23, '287654873698429', '2021-07-02 06:29:30', NULL, 'messigoat', NULL, 1, NULL, 'PAULINA WEIYAI', '32432423423432524', 'aabb8', '5c19dba5b8732e5f4c6b419a6216a0aa5eafcd4fef819e00dea4c6bc', '4A', NULL, 'PEREMPUAN', 2, '8@gmail.com', '04504354435', '2021-07-02', 13, 1),
(24, 24, '873628763782498', '2021-07-02 06:29:31', NULL, 'messigoat', NULL, 1, NULL, 'PARNI SITINJAK', '87346587437564375', 'aabb9', '11745022db99260ba66adbf630e692cae8b5a8153c4ab286e65942cf', '4A', NULL, 'PEREMPUAN', 2, '9@gmail.com', '0435034543', '2021-07-02', 13, 1),
(25, 25, '876438764877893', '2021-07-02 06:29:32', NULL, 'messigoat', NULL, 1, NULL, 'AYU NELANG', '87367564756734534', 'aabb10', '06719473b2626aa29df0266fb40df1301b21314c5140e1d8b94722f9', '4A', NULL, 'PEREMPUAN', 2, '10@gmail.com', '0454056430', '2021-07-02', 13, 1),
(26, 26, '984375864758483', '2021-07-02 06:29:33', NULL, 'messigoat', NULL, 1, NULL, 'YOSUA TIPAGAU', '43543543534538757', 'aabb11', 'd105f094286aa645f3f198505b6ba1cfd2b4b2edbc1076ec2449e85c', '4A', NULL, 'LAKI-LAKI', 1, '11@gmail.com', '02304324234', '2021-07-02', 13, 1),
(27, 27, '987485743895794', '2021-07-02 06:29:34', NULL, 'messigoat', NULL, 1, NULL, 'RASMINTO MALISA', '94876854785784529', 'aabb12', '564b3ac493fe915d9b7f43483f6fb733cc17907f52abd03702b9388e', '4A', NULL, 'LAKI-LAKI', 1, '12@gmail.com', '0324304032', '2021-07-02', 13, 1),
(28, 28, '874365689547933', '2021-07-02 06:29:35', NULL, 'messigoat', NULL, 1, NULL, 'GERGORIUS IYAI', '87645743658732949', 'aabb13', '572dc78da3a9306bb7720495eebe0f7f347d4993b748be44661e2dd4', '3B', NULL, 'LAKI-LAKI', 1, '13@gmail.com', '0234032045', '2021-07-02', 13, 1),
(29, 29, '987648659847589', '2021-07-02 06:29:36', NULL, 'messigoat', NULL, 1, NULL, 'YOSEF GEOVANI', '7657458478479547', 'aabb14', '50fb188a1e26d3c0a38bc17e4097fe0cc5c0d1e5da90223da91c321e', '3C', NULL, 'LAKI-LAKI', 1, '14@gmail.com', '023402340', '2021-07-02', 13, 1),
(30, 30, '984756858974895', '2021-07-02 06:29:37', NULL, 'messigoat', NULL, 1, NULL, 'LUDOVIKUS DELANO', '87676478574937493', 'aabb15', '81ec9c3c5b53482c64aea150fe90c5f02417f1c68e4bdab1fee015e1', '3A', NULL, 'LAKI-LAKI', 1, '15@gmail.com', '0240234324', '2021-07-02', 13, 1),
(31, 31, '987685694794387', '2021-07-02 06:29:38', NULL, 'messigoat', NULL, 1, NULL, 'BAMBAG ABDULAH', '98347584758475943', 'aabb16', '9eb75f51f0b172a61a2adc2b8e963cb11ec267c3246d55974ecd5511', '3D', NULL, 'LAKI-LAKI', 1, '16@gmail.com', '0435040543', '2021-07-02', 13, 1),
(32, 32, '498768957897592', '2021-07-02 06:29:39', NULL, 'messigoat', NULL, 1, NULL, 'MELKI MADAI', '93475874895495899', 'aabb17', 'db5e268ad5cff000b8e1d7a69bf1d0d5da5300845ce37ee55633cd99', '3E', NULL, 'LAKI-LAKI', 1, '17@gmail.com', '04354354554', '2021-07-02', 13, 1),
(33, 33, '987897487489245', '2021-07-02 06:29:39', NULL, 'messigoat', NULL, 1, NULL, 'DHIO SANDA', '84687564857497943', 'aabb18', '9074338c283ea89bb8db7d97e894ae159aec642183f13cea54447fee', '3A', NULL, 'LAKI-LAKI', 1, '18@gmail.com', '0435043053', '2021-07-02', 13, 1),
(34, 34, '398645894789574', '2021-07-02 06:29:40', NULL, 'messigoat', NULL, 1, NULL, 'RICKY YAURI', '78463785487759834', 'aabb19', '399fbf6088cfa29cfc1663d9e840029cfdae7bfb34f7da7ae22d4a5f', '3A', NULL, 'LAKI-LAKI', 1, '19@gmail.com', '0345435430', '2021-07-02', 13, 1),
(35, 35, '947365897438594', '2021-07-02 06:29:41', NULL, 'messigoat', NULL, 1, NULL, 'RICKY JONAS', '98438574875894759', 'aabb20', '74046fca38e31bb746e2bf1b936d2814a7a8e36d85f7c078beb1c006', '3D', NULL, 'LAKI-LAKI', 1, '20@gmail.com', '0435345034', '2021-07-02', 13, 1),
(36, 36, '984758975897434', '2021-07-02 06:29:42', NULL, 'messigoat', NULL, 1, NULL, 'PIUS JUAN', '98437589478954989', 'aabb21', '51b77b47c81fd097a9ab52d315fc03979e98da0dc73c5566c1381d6d', '4A', NULL, 'LAKI-LAKI', 1, '21@gmail.com', '0435345053', '2021-07-02', 13, 1),
(37, 15, '1', '2021-07-02 07:59:43', '2021-07-10 02:46:16', 'messigoat', 'messigoat', 1, NULL, 'ADMINISTRATOR BKD', '1', 'adminbkd', '8df445ac027d4fe2d071afef1b60ed354a7e36a4419f063bf65c5f72', '0', 'ADM BKD', 'LAKI-LAKI', 1, 'mi@gmail.com', '089876754536', '1990-10-05', NULL, 0),
(38, 38, '2', '2021-07-26 13:25:56', '2021-07-26 13:25:56', 'superuser', NULL, 1, NULL, 'ADMINISTRATOR D', '2', 'admind', '97df7231bd25d3374d76cfd1fee29450fda586bef94ef94397585418', NULL, NULL, 'LAKI-LAKI', 1, '', '', '2021-07-26', NULL, 0),
(39, 39, '3', '2021-08-14 05:01:08', '2021-08-14 05:01:08', 'superuser', NULL, 1, NULL, 'ADMINISTRATOR PEMDA', '3', 'adminpemda', '2d4886a13b1d9b6dfb2fcb0a9fd5867531750370fc35dc1ff033c2c5', NULL, NULL, 'LAKI-LAKI', 1, NULL, NULL, '2021-08-14', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pola_klasifikasi_surat`
--

CREATE TABLE `pola_klasifikasi_surat` (
  `id` int NOT NULL,
  `kode` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `kode2` varchar(100) DEFAULT NULL,
  `nama_klasifikasi` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_date` timestamp NOT NULL,
  `last_modified_date` timestamp NULL DEFAULT NULL,
  `user_created` varchar(100) NOT NULL,
  `user_update` varchar(100) DEFAULT NULL,
  `is_active` tinyint NOT NULL,
  `notes` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `pola_klasifikasi_surat`
--

INSERT INTO `pola_klasifikasi_surat` (`id`, `kode`, `kode2`, `nama_klasifikasi`, `created_date`, `last_modified_date`, `user_created`, `user_update`, `is_active`, `notes`) VALUES
(1, '000', NULL, 'UMUM', '2021-06-23 06:44:40', NULL, 'analyst', NULL, 1, NULL),
(2, '100', NULL, 'PEMERINTAHAN', '2021-06-23 06:44:42', NULL, 'analyst', NULL, 1, NULL),
(3, '200', NULL, 'POLITIK', '2021-06-23 06:44:44', NULL, 'analyst', NULL, 1, NULL),
(4, '300', NULL, 'KEAMANAN DAN KETERTIBAN', '2021-06-23 06:44:46', NULL, 'analyst', NULL, 1, NULL),
(5, '400', NULL, 'KESEJAHTERAAN', '2021-06-23 06:44:48', NULL, 'analyst', NULL, 1, NULL),
(6, '500', NULL, 'PEREKONOMIAN', '2021-06-23 06:44:49', NULL, 'analyst', NULL, 1, NULL),
(7, '600', NULL, 'PEKERJAAN UMUM DAN KETENAGAAN', '2021-06-23 06:44:51', NULL, 'analyst', NULL, 1, NULL),
(8, '700', NULL, 'PENGAWASAN', '2021-06-23 06:44:52', NULL, 'analyst', NULL, 1, NULL),
(9, '800', NULL, 'KEPEGAWAIAN', '2021-06-23 06:44:54', NULL, 'analyst', NULL, 1, NULL),
(10, '900', NULL, 'KEUANGAN', '2021-06-23 06:44:56', NULL, 'analyst', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profil_pejabat`
--

CREATE TABLE `profil_pejabat` (
  `id` int NOT NULL,
  `pegawai_id` int NOT NULL,
  `file_foto` varchar(255) NOT NULL,
  `path_file_foto` varchar(255) NOT NULL,
  `user_created` varchar(100) NOT NULL,
  `user_updated` varchar(100) NOT NULL,
  `created_date` timestamp NOT NULL,
  `last_modified_date` timestamp NOT NULL,
  `is_active` tinyint NOT NULL,
  `status_sistem_id` smallint NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `status_sistem`
--

CREATE TABLE `status_sistem` (
  `id` smallint NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `kategori_id` int DEFAULT NULL,
  `nama_status` varchar(100) NOT NULL,
  `notes` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `status_sistem`
--

INSERT INTO `status_sistem` (`id`, `kategori`, `kategori_id`, `nama_status`, `notes`) VALUES
(1, 'Informasi Publik', 1, 'terupload', NULL),
(2, 'Informasi Publik', 1, 'publish', NULL),
(10, 'Lampiran Artikel', 2, 'video', NULL),
(11, 'Lampiran Artikel', 2, 'foto', NULL),
(12, 'Lampiran Artikel', 2, 'dokumen', NULL),
(50, 'Login', 6, 'berhasil login', NULL),
(51, 'Login', 6, 'user password tidak sesuai', NULL),
(52, 'Login', 6, 'user belum aktivasi', NULL),
(53, 'Login', 6, 'user/email tidak ditemukan', NULL),
(54, 'Login', 6, 'tidak dapat menduduki jabatan', NULL),
(60, 'Ubah Password', 7, 'berhasil', NULL),
(61, 'Ubah Password', 7, 'input ulang password baru tidak sama', NULL),
(62, 'Ubah Password', 7, 'password lama salah', NULL),
(70, 'Reset Password', 8, 'user atau email ditemukan', NULL),
(71, 'Reset Password', 8, 'user atau email tidak ditemukan', NULL),
(72, 'Reset Password', 8, 'reset password berhasil', NULL),
(73, 'Reset Password', 8, 'token tidak valid', NULL),
(74, 'Reset Password', 8, 'token valid', NULL),
(75, 'Reset Password', 8, 'reset password berhasil', NULL),
(76, 'Reset Password', 8, 'input ulang password baru tidak sama', NULL),
(80, 'Input Data', 9, 'data pernah dibuat', NULL),
(81, 'Input Data', 9, 'data berhasil ditambahkan', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_bidang`
--

CREATE TABLE `sub_bidang` (
  `id` int NOT NULL,
  `bidang_id` int NOT NULL,
  `kode` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_sub_bidang` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_date` timestamp NOT NULL,
  `last_modified_date` timestamp NULL DEFAULT NULL,
  `is_active` smallint NOT NULL,
  `user_created` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_updated` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `notes` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `sub_bidang`
--

INSERT INTO `sub_bidang` (`id`, `bidang_id`, `kode`, `nama_sub_bidang`, `created_date`, `last_modified_date`, `is_active`, `user_created`, `user_updated`, `notes`) VALUES
(1, 1, 'SUBBAG-PP', 'SUBBAGIAN PROGRAM DAN PELAPORAN', '2021-06-10 08:06:06', '2021-06-10 08:06:06', 1, 'analyst', 'budi', NULL),
(2, 1, 'SUBBAG-KEU', 'SUBBAGIAN KEUANGAN', '2021-06-10 08:12:55', '2021-06-10 08:12:55', 1, 'analyst', NULL, NULL),
(3, 1, 'SUBBAG-UK', 'SUBBAGIAN UMUM DAN KEPEGAWAIAN', '2021-06-10 08:14:34', '2021-06-10 08:14:34', 1, 'analyst', NULL, NULL),
(4, 2, 'SI-PEN', 'SEKSI PENCEGAHAN', '2021-06-10 08:17:12', '2021-06-10 08:17:12', 1, 'analyst', NULL, NULL),
(5, 2, 'SI-KES', 'SEKSI KESIAPSIAGAAN', '2021-06-10 08:17:43', '2021-06-10 08:17:43', 1, 'analyst', NULL, NULL),
(6, 3, 'SI-KED', 'SEKSI KEDARURATAN', '2021-06-29 05:00:40', '2021-06-29 05:00:40', 1, 'eca', 'melina', NULL),
(7, 3, 'SI-LOG', 'SEKSI LOGISTIK', '2021-06-29 05:03:45', '2021-06-29 05:03:45', 1, 'melina', 'budi', NULL),
(8, 4, 'SUBBAG-UK', 'SUBBAGIAN UMUM DAN KEPEGAWAIAN', '2021-07-02 02:47:32', '2021-07-02 02:47:32', 1, 'messigoat', NULL, NULL),
(9, 4, 'SUBBAG-RK', 'SUBBAGIAN RENVAL DAN KEUANGAN', '2021-07-02 02:48:26', '2021-07-02 02:48:26', 1, 'messigoat', NULL, NULL),
(10, 5, 'SUBBID-PI', 'SUBBIDANG PENGOLAHAN DATA DAN INFORMASI APARATUR', '2021-07-02 02:59:58', '2021-07-02 02:59:58', 1, 'messigoat', 'messigoat', NULL),
(11, 5, 'SUBBID-PD', 'SUBBIDANG PEMBINAAN DAN DISIPLIN PNS', '2021-07-02 03:03:20', '2021-07-02 03:03:20', 1, 'messigoat', NULL, NULL),
(12, 6, 'SUBBID-PF', 'SUBBIDANG PERENCANAAN DAN FORMASI', '2021-07-02 03:04:10', '2021-07-02 03:04:10', 1, 'messigoat', NULL, NULL),
(13, 6, 'SUBBID-PS', 'SUBBIDANG PENGEMBANGAN SDM', '2021-07-02 03:04:43', '2021-07-02 03:04:43', 1, 'messigoat', NULL, NULL),
(14, 7, 'SUBBID-PP', 'SUBBIDANG PENGANGKATAN DAN KEPANGKATAN', '2021-07-02 03:05:17', '2021-07-02 03:05:17', 1, 'messigoat', NULL, NULL),
(15, 7, 'SUBBID-PPP', 'SUBBIDANG PEMINDAHAN, PEMBERHENTIAN DAN PENSIUN', '2021-07-02 03:06:20', '2021-07-02 03:06:20', 1, 'messigoat', 'messigoat', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_configuration`
--

CREATE TABLE `system_configuration` (
  `id` int NOT NULL,
  `parameter` varchar(255) NOT NULL,
  `variabel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `system_configuration`
--

INSERT INTO `system_configuration` (`id`, `parameter`, `variabel`) VALUES
(1, 'nama_perusahaan', 'PEMERINTAHAN KABUPATEN INTAN JAYA'),
(2, 'sys_code', 'A00001');

-- --------------------------------------------------------

--
-- Table structure for table `tipe_artikel`
--

CREATE TABLE `tipe_artikel` (
  `id` smallint NOT NULL,
  `tipe` varchar(100) DEFAULT NULL,
  `notes` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tipe_artikel`
--

INSERT INTO `tipe_artikel` (`id`, `tipe`, `notes`) VALUES
(1, 'Berita', NULL),
(2, 'Informasi', NULL),
(3, 'Album Foto', NULL),
(4, 'Album Video', NULL),
(5, 'Visi', NULL),
(6, 'Misi', NULL),
(7, 'Slide Show', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tipe_bidang`
--

CREATE TABLE `tipe_bidang` (
  `id` int NOT NULL,
  `tipe` varchar(100) NOT NULL,
  `notes` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tipe_bidang`
--

INSERT INTO `tipe_bidang` (`id`, `tipe`, `notes`) VALUES
(1, 'SEKRETARIAT', NULL),
(2, 'UMUM', NULL),
(100, 'LAINNYA', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pegawai_id` int NOT NULL,
  `expired` timestamp NOT NULL,
  `is_active` smallint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artikel_FK` (`opd_hdr_id`),
  ADD KEY `artikel_FK_1` (`status_sistem_id`),
  ADD KEY `artikel_FK_2` (`tipe_artikel_id`);

--
-- Indexes for table `bidang`
--
ALTER TABLE `bidang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bidang_un` (`kode`,`opd_hdr_id`),
  ADD KEY `bidang_FK` (`opd_hdr_id`),
  ADD KEY `bidang_FK_1` (`tipe_bidang_id`);

--
-- Indexes for table `golongan_pegawai`
--
ALTER TABLE `golongan_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hak_akses_dtl`
--
ALTER TABLE `hak_akses_dtl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hak_akses_dtl_un` (`hak_akses_hdr_id`,`modul_id`),
  ADD KEY `hak_akses_dtl_FK_1` (`modul_id`);

--
-- Indexes for table `hak_akses_hdr`
--
ALTER TABLE `hak_akses_hdr`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hak_akses_hdr_un` (`kode`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jabatan_un` (`kode`,`opd_hdr_id`),
  ADD KEY `jabatan_FK_1` (`bidang_id`),
  ADD KEY `jabatan_FK_2` (`sub_bidang_id`),
  ADD KEY `jabatan_FK` (`opd_hdr_id`),
  ADD KEY `jabatan_FK_3` (`hak_akses_hdr_id`),
  ADD KEY `jabatan_FK_4` (`level`);

--
-- Indexes for table `lampiran_artikel`
--
ALTER TABLE `lampiran_artikel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lampiran_artikel_FK` (`artikel_id`),
  ADD KEY `lampiran_artikel_FK_1` (`status_sistem_id`);

--
-- Indexes for table `level_jabatan`
--
ALTER TABLE `level_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level_opd`
--
ALTER TABLE `level_opd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_logins`
--
ALTER TABLE `log_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`usr`),
  ADD KEY `user_id` (`pegawai_id`);

--
-- Indexes for table `log_reset`
--
ALTER TABLE `log_reset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_reset_attempts_FK` (`pegawai_id`);

--
-- Indexes for table `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `modul_un` (`kode`);

--
-- Indexes for table `opd_hdr`
--
ALTER TABLE `opd_hdr`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `opd_hdr_un` (`kode`),
  ADD KEY `opd_hdr_FK` (`level`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pegawai_hdr_un` (`nip`),
  ADD UNIQUE KEY `pegawai_hdr_un1` (`nik`),
  ADD UNIQUE KEY `pegawai_hdr_un2` (`username`),
  ADD UNIQUE KEY `pegawai_hdr_un3` (`email`),
  ADD UNIQUE KEY `pegawai_hdr_un4` (`no_hp`),
  ADD KEY `pegawai_hdr_FK_1` (`jabatan_id`),
  ADD KEY `pegawai_FK` (`golongan_id`);

--
-- Indexes for table `pola_klasifikasi_surat`
--
ALTER TABLE `pola_klasifikasi_surat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pola_klasifikasi_un` (`kode`);

--
-- Indexes for table `profil_pejabat`
--
ALTER TABLE `profil_pejabat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profil_pejabat_FK` (`pegawai_id`),
  ADD KEY `profil_pejabat_FK_1` (`status_sistem_id`);

--
-- Indexes for table `status_sistem`
--
ALTER TABLE `status_sistem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_bidang`
--
ALTER TABLE `sub_bidang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sub_bidang_un` (`kode`,`bidang_id`),
  ADD KEY `sub_bidang_FK` (`bidang_id`);

--
-- Indexes for table `system_configuration`
--
ALTER TABLE `system_configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipe_artikel`
--
ALTER TABLE `tipe_artikel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipe_bidang`
--
ALTER TABLE `tipe_bidang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token_un` (`token`),
  ADD UNIQUE KEY `token_un1` (`pegawai_id`),
  ADD KEY `auth_tokens_user_id_foreign` (`pegawai_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hak_akses_dtl`
--
ALTER TABLE `hak_akses_dtl`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hak_akses_hdr`
--
ALTER TABLE `hak_akses_hdr`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `log_logins`
--
ALTER TABLE `log_logins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `log_reset`
--
ALTER TABLE `log_reset`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `opd_hdr`
--
ALTER TABLE `opd_hdr`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `pola_klasifikasi_surat`
--
ALTER TABLE `pola_klasifikasi_surat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sub_bidang`
--
ALTER TABLE `sub_bidang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artikel`
--
ALTER TABLE `artikel`
  ADD CONSTRAINT `artikel_FK` FOREIGN KEY (`opd_hdr_id`) REFERENCES `opd_hdr` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `artikel_FK_1` FOREIGN KEY (`status_sistem_id`) REFERENCES `status_sistem` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `artikel_FK_2` FOREIGN KEY (`tipe_artikel_id`) REFERENCES `tipe_artikel` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `bidang`
--
ALTER TABLE `bidang`
  ADD CONSTRAINT `bidang_FK` FOREIGN KEY (`opd_hdr_id`) REFERENCES `opd_hdr` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `bidang_FK_1` FOREIGN KEY (`tipe_bidang_id`) REFERENCES `tipe_bidang` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `hak_akses_dtl`
--
ALTER TABLE `hak_akses_dtl`
  ADD CONSTRAINT `hak_akses_dtl_FK` FOREIGN KEY (`modul_id`) REFERENCES `modul` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `hak_akses_dtl_FK_2` FOREIGN KEY (`hak_akses_hdr_id`) REFERENCES `hak_akses_hdr` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD CONSTRAINT `jabatan_FK` FOREIGN KEY (`opd_hdr_id`) REFERENCES `opd_hdr` (`id`),
  ADD CONSTRAINT `jabatan_FK_1` FOREIGN KEY (`bidang_id`) REFERENCES `bidang` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `jabatan_FK_2` FOREIGN KEY (`sub_bidang_id`) REFERENCES `sub_bidang` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `jabatan_FK_3` FOREIGN KEY (`hak_akses_hdr_id`) REFERENCES `hak_akses_hdr` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `jabatan_FK_4` FOREIGN KEY (`level`) REFERENCES `level_jabatan` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `lampiran_artikel`
--
ALTER TABLE `lampiran_artikel`
  ADD CONSTRAINT `lampiran_artikel_FK` FOREIGN KEY (`artikel_id`) REFERENCES `artikel` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `lampiran_artikel_FK_1` FOREIGN KEY (`status_sistem_id`) REFERENCES `status_sistem` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `log_logins`
--
ALTER TABLE `log_logins`
  ADD CONSTRAINT `auth_logins_FK` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `log_reset`
--
ALTER TABLE `log_reset`
  ADD CONSTRAINT `auth_reset_attempts_FK` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `opd_hdr`
--
ALTER TABLE `opd_hdr`
  ADD CONSTRAINT `opd_hdr_FK` FOREIGN KEY (`level`) REFERENCES `level_opd` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_FK` FOREIGN KEY (`golongan_id`) REFERENCES `golongan_pegawai` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `pegawai_hdr_FK_1` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatan` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `profil_pejabat`
--
ALTER TABLE `profil_pejabat`
  ADD CONSTRAINT `profil_pejabat_FK` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `profil_pejabat_FK_1` FOREIGN KEY (`status_sistem_id`) REFERENCES `status_sistem` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `sub_bidang`
--
ALTER TABLE `sub_bidang`
  ADD CONSTRAINT `sub_bidang_FK` FOREIGN KEY (`bidang_id`) REFERENCES `bidang` (`id`);

--
-- Constraints for table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `auth_tokens_FK` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `token_expired` ON SCHEDULE EVERY 1 SECOND STARTS '2021-06-28 13:54:39' ON COMPLETION PRESERVE ENABLE DO begin
delete from token where expired < now();
end$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
