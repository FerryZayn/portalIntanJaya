-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2021 at 10:17 AM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `artikel_insert` (IN `jdl` VARCHAR(255), IN `file_g` VARCHAR(255), IN `path_g` VARCHAR(255), IN `isi` TEXT, IN `p_input_id` INT, IN `tipe` SMALLINT, IN `pengarang` VARCHAR(255), IN `slg` VARCHAR(255))  begin
	declare usr varchar(100);
	declare a_id int;
	declare opd_id int;
	declare n int;

	
	select p.username into usr from pegawai p where p.id=p_input_id;

	
	select j.opd_hdr_id into opd_id from pegawai p
	right join jabatan j on p.jabatan_id = j.id
	where p.id=p_input_id;
	
	INSERT INTO `portal.intan_jaya`.artikel
	(judul, file_gambar, path_file_gambar, isi_artikel, created_date, last_modified_date, nama_pengarang, user_created, user_updated, notes, opd_hdr_id, is_active, tipe_artikel_id, status_sistem_id, slug)
	VALUES(jdl, file_g, path_g, isi, now(), now(), pengarang, usr, usr, null, opd_id, 1, tipe, 1, slg);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `artikel_update` (IN `artkl_id` INT, IN `jdl` VARCHAR(255), IN `file_g` VARCHAR(255), IN `path_g` VARCHAR(255), IN `isi` TEXT, IN `p_input_id` INT, IN `pengarang` VARCHAR(255), IN `slg` VARCHAR(255))  begin
	declare usr varchar(100);
	declare a_id int;
	declare opd_id int;
	declare n int;

	
	select p.username into usr from pegawai p where p.id=p_input_id;

	UPDATE `portal.intan_jaya`.artikel
	SET judul=jdl, file_gambar=file_g, path_file_gambar=path_g, isi_artikel=isi, last_modified_date=now(), nama_pengarang=pengarang,
	user_updated=usr, notes=null, slug=slg
	WHERE id=artkl_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `berita_view_adm` (IN `p_input_id` INT)  begin
	declare opd_id int;

	
	select j.opd_hdr_id into opd_id from pegawai p
	right join jabatan j on p.jabatan_id = j.id
	where p.id=p_input_id;
	
	select a.id, a.judul, a.file_gambar, a.path_file_gambar, substring(a.isi_artikel,1,100), a.nama_pengarang, a.created_date from artikel a 
	where a.tipe_artikel_id = 1 and a.is_active = 1 and a.opd_hdr_id = opd_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `berita_view_adm_dtl` (IN `p_input_id` INT, IN `id_a` INT)  begin
	declare opd_id int;

	
	select j.opd_hdr_id into opd_id from pegawai p
	right join jabatan j on p.jabatan_id = j.id
	where p.id=p_input_id;
	
	select a.id, a.judul, a.file_gambar, a.path_file_gambar, a.isi_artikel,1,100, a.nama_pengarang, a.created_date from artikel a 
	where a.tipe_artikel_id = 1 and a.is_active = 1 and a.opd_hdr_id = opd_id and a.id = id_a;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `berita_view_portal` ()  begin
	select a.id, a.judul, a.file_gambar, a.path_file_gambar, substring(a.isi_artikel,1,100), a.nama_pengarang, a.created_date from artikel a 
	where a.tipe_artikel_id = 1 and a.is_active = 1 and a.opd_hdr_id = 0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `berita_view_portal_pemda` ()  begin
	select a.id, a.judul, a.file_gambar, a.path_file_gambar, substring(a.isi_artikel,1,100), a.nama_pengarang, a.created_date from artikel a 
	where a.tipe_artikel_id = 1 and a.is_active = 1 and a.opd_hdr_id = 0 and a.status_sistem_id = 2;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `informasi_view_adm` (IN `p_input_id` INT)  begin
	declare opd_id int;

	
	select j.opd_hdr_id into opd_id from pegawai p
	right join jabatan j on p.jabatan_id = j.id
	where p.id=p_input_id;
	
	select a.id, a.judul, a.file_gambar, a.path_file_gambar, substring(a.isi_artikel,1,100), a.nama_pengarang, a.created_date from artikel a 
	where a.tipe_artikel_id = 2 and a.is_active = 1 and a.opd_hdr_id = opd_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `informasi_view_adm_dtl` (IN `p_input_id` INT, IN `id_a` INT)  begin
	declare opd_id int;

	
	select j.opd_hdr_id into opd_id from pegawai p
	right join jabatan j on p.jabatan_id = j.id
	where p.id=p_input_id;
	
	select a.id, a.judul, a.file_gambar, a.path_file_gambar, a.isi_artikel,1,100, a.nama_pengarang, a.created_date from artikel a 
	where a.tipe_artikel_id = 2 and a.is_active = 1 and a.opd_hdr_id = opd_id and a.id = id_a;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `informasi_view_portal` ()  begin
	select a.id, a.judul, a.file_gambar, a.path_file_gambar, substring(a.isi_artikel,1,100), a.nama_pengarang, a.created_date from artikel a
	where a.tipe_artikel_id = 2 and a.is_active = 1 and a.opd_hdr_id = 0;
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
	declare opd_id int;

	
	select p.username into username from pegawai p where p.id=p_input_id;

	
	select j.opd_hdr_id into opd_id from pegawai p 
	join jabatan j on j.id = p.jabatan_id 
	where p.id = p_input_id;

	INSERT INTO `portal.intan_jaya`.artikel
	(judul, file_gambar, path_file_gambar, isi_artikel, created_date, last_modified_date, nama_pengarang, user_created, user_updated, notes, opd_hdr_id, is_active, tipe_artikel_id, status_sistem_id)
	VALUES('MISI', null, null, isi, now(), now(), username, username, username, null, opd_id, 1, 6, 1);

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `profil_pejabat_insert` (IN `p_input_id` INT, IN `p_id` INT, IN `f_foto` VARCHAR(255), IN `p_f_foto` VARCHAR(255), IN `dskrps` TEXT)  begin
	declare usr varchar(100);
	declare n int;
	declare aktif tinyint;

	
	select p.username into usr from pegawai p where p.id=p_input_id;
	
	
	select pp.is_active into aktif from profil_pejabat pp where pp.pegawai_id = p_id;

	if (aktif is not null) then 
		if (aktif = 1) then 
			set n = 80;
		else
			UPDATE `portal.intan_jaya`.profil_pejabat
			SET file_foto=f_foto, path_file_foto=p_f_foto,  user_updated=usr, last_modified_date=usr, status_sistem_id=1, deskripsi=dskrps
			WHERE pegawai_id = p.id;
set n = 81;
		end if;
	else
		INSERT INTO `portal.intan_jaya`.profil_pejabat
		(pegawai_id, file_foto, path_file_foto, user_created, user_updated, created_date, last_modified_date, is_active, status_sistem_id, deskripsi)
		VALUES(p_id, f_foto, p_f_foto, usr, usr, now(), now(), 1, 1, dskrps);
set n = 81;
	end if;
select n;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `profil_pejabat_view` (IN `p_input_id` INT)  begin
	declare opd_id int;

	
	select j.opd_hdr_id into opd_id from jabatan j 
	join pegawai p on j.id = p.jabatan_id 
	where p.id = p_input_id;
	
	select pp.* from profil_pejabat pp 
	join pegawai p on p.id = pp.pegawai_id 
	join jabatan j on j.id = p.jabatan_id 
	where j.opd_hdr_id = opd_id and pp.is_active = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `profil_pejabat_view_dtl` (IN `pejabat_id` INT)  begin
	select * from profil_pejabat pp where pp.pegawai_id = pejabat_id;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `visi_misi_admin_view` (IN `p_input_id` INT)  begin
	declare opd_id int;

	
	select j.opd_hdr_id into opd_id from pegawai p 
	join jabatan j on j.id = p.jabatan_id 
	where p.id = p_input_id;

 	select * from artikel a where a.tipe_artikel_id in (6,5) and a.is_active = 1 and a.opd_hdr_id = opd_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `visi_misi_portal_view` ()  BEGIN
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `visi_pemda_insert` (IN `isi` TEXT, IN `p_input_id` INT)  begin
	declare opd_id int;
	declare username varchar(100);
	declare n int;
	declare aktif tinyint;

	
	select p.username into username from pegawai p where p.id=p_input_id;

	
	select j.opd_hdr_id into opd_id from pegawai p 
	join jabatan j on j.id = p.jabatan_id 
	where p.id = p_input_id;

	INSERT INTO `portal.intan_jaya`.artikel
	(judul, file_gambar, path_file_gambar, isi_artikel, created_date, last_modified_date, nama_pengarang, user_created, user_updated, notes, opd_hdr_id, is_active, tipe_artikel_id, status_sistem_id)
	VALUES('VISI', null, null, isi, now(), now(), username, username, username, null, opd_id, 1, 5, 1);

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
  `status_sistem_id` smallint NOT NULL,
  `slug` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `judul`, `file_gambar`, `path_file_gambar`, `isi_artikel`, `created_date`, `last_modified_date`, `nama_pengarang`, `user_created`, `user_updated`, `notes`, `opd_hdr_id`, `is_active`, `tipe_artikel_id`, `status_sistem_id`, `slug`) VALUES
(1, 'VISI', 'default.jpg', '/templet/gambar-berita', 'Jaya di Darat, Laut, dan Udara', '2021-08-14 02:07:52', '2021-08-14 02:18:05', 'budi', 'budi', 'budi', NULL, 0, 1, 5, 1, NULL),
(2, 'MISI', 'default.jpg', '/templet/gambar-berita', 'Membangun Bangunan', '2021-08-14 02:16:32', '2021-08-14 02:16:32', 'luis', 'luis', 'luis', NULL, 0, 1, 6, 1, NULL),
(6, 'Manuver Dukung Jokowi saat Pilpres, Kini Jadi Komisaris', '1631328082_5e27d6bd45d4a749667a.jpg', '/templet/gambar-berita', '<p>Eks Gubernur NTB M Zainul Majdi atau Tuan Guru Bajang (TGB) ditunjuk sebagai Komisaris Bank Syariah Indonesia. Penunjukan itu disindir Partai Demokrat (PD) dengan mengungkit manuver politik TGB yang berbelot menjadi pendukung Presiden Joko Widodo (Jokowi) untuk melanjutkan kepemimpinannya di periode kedua. Bagaimana jejak manuver TGB saat mendukung Jokowi di Pilpres 2019?</p>\n\n<p>Dirangkum detikcom, Rabu (25/8/2021), sebelum menyeberang ke kubu Jokowi, TGB merupakan politikus PD sebagai anggota Majelis Tinggi PD. Saat itu, Demokrat sendiri belum bersikap untuk Pilpres 2019.</p>\n\n<p>&quot;Jadi keputusan apa pun itu harus mempertimbangkan kemaslahatan bangsa, umat, dan akal sehat. Keseluruhan dari 3 hal ini menurut saya, pantas dan fair kalau kita beri kesempatan kepada Bapak Presiden Jokowi untuk menyelesaikan tugas-tugas yang selama 4 tahun ini beliau mulai,&quot; kata TGB saat itu, Rabu (4/7/2018).<br />\nBaca juga: Sindiran Tajam PD soal TGB Jadi Komisaris Bank Syariah</p>\n\n<p>TGB menyoroti percepatan pembangunan di NTB, khususnya Kawasan Ekonomi Khusus (KEK) Mandalika. Dia khawatir pembangunan itu jadi mandek ketika ada pergantian kepemimpinan.</p>\n\n<p>Atas dasar itu, TGB menilai pemerintahan Jokowi perlu dilanjutkan hingga periode kedua di Pemilu 2019. Berdasarkan pengalamannya di NTB, gubernur yang sedang menjalani periode kedua kepemimpinannya ini juga menilai 2 periode dibutuhkan.</p>\n\n<p>&quot;Dua periode secara common sense dan empirik yang saya alami, waktu yang lumayan fair bagi seorang pemimpin,&quot; ucap TGB.</p>\n\n<p>&quot;Beliau layak dan pantas diberi kesempatan 2 periode,&quot; tegasnya.<br />\nBaca juga: Tuan Guru Bajang Jadi Komisaris Bank Syariah Indonesia</p>\n\n<p>PD Sebut Dukungan TGB Sikap Pribadi</p>\n\n<p>Sekretaris Majelis Tinggi Partai Demokrat Amir Syamsuddin mengatakan dukungan TGB itu merupakan dukungan pribadi dan bukan mewakili Demokrat. PD yang menaungi TGB saat itu berbicara soal sikap Ketum sebelumnya Susilo Bambang Yudhoyono (SBY) yang terbuka atas pilihan kader, termasuk soal genting, seperti pilpres.</p>\n\n<p>&quot;Sebagai sesama rekan anggota Majelis Tinggi Partai, saya tidak melihat adanya persoalan manakala TGB secara pribadi mengutarakan dukungannya kepada capres yang disukainya pada saat berbagai opsi masih terbuka dan Demokrat belum secara resmi mendukung calon mana pun,&quot; ujar Amir, Rabu (4/7/2018).</p>\n\n<p>Disambut Baik Parpol Koalisi Jokowi</p>\n\n<p>Pernyataan sikap dari TGB pun disambut baik parpol koalisi pengusung Jokowi. PDIP mengaku gembira atas dukungan dari TGB. Hendrawan Supratikno yang saat ini masih menjadi Ketua DPP PDIP menebak TGB terkesan oleh kinerja Jokowi.</p>\n\n<p><br />\nad</p>\n\n<p>&quot;Tentu dukungan tersebut diberikan karena ada bukti-bukti yang meyakinkan tentang kerja dan kinerja yang didukung,&quot; kata Hendrawan.</p>\n\n<p>Hal senada disampaikan Golkar, PPP, dan PKB. Ketiganya menilai dukungan TGB kian mempertegas bahwa Jokowi memiliki kedekatan dengan umat Islam.</p>\n\n<p>&quot;Dukungan ini makin menepis prasangka bahwa Pak Jokowi itu anti-Islam dan tidak memperhatikan kepentingan serta aspirasi umat Islam,&quot; tutur Sekjen PPP Arsul Sani, yang sekarang menjadi Waketum PPP.<br />\nBaca juga: TGB Jadi Wakomut Bank Syariah Indonesia</p>\n\n<p>TGB Hengkang dari Demokrat</p>\n\n<p>TGH Zainul Majdi atau Tuan Guru Bajang memutuskan mundur dari Partai Demokrat (PD). TGB telah menyerahkan surat pengunduran diri kepada Ketua Dewan Kehormatan PD Amir Syamsuddin. Dia tak mengungkap alasannya.</p>\n\n<p>&quot;Alasan pribadi,&quot; ujar TGB.</p>\n\n<p>Gabung ke Golkar</p>\n\n<p>Lama tak terdengar setelah keluar dari PD, TGB kembali bermanuver politik. TGB memutuskan untuk merapat ke Partai Golkar.</p>\n\n<p>Bergabungnya mantan Gubernur Nusa Tenggara Barat ke Golkar diputuskan setelah rapat yang dipimpin Ketum Airlangga Hartarto. Di Golkar, TGB mengemban dua jabatan sekaligus: Koordinator Bidang Keummatan dan Wakil Ketua Badan Pemenangan Pemilu Legislatif dan Presiden.</p>\n\n<p>&quot;Keluarga Partai Golkar bergembira berkat hadirnya Pak TGB. Kemarin saat rapat pleno Partai Golkar menyetujui bahwa TGB menjadi salah satu pengurus DPP dan kemarin sudah disepakati menjadi Ketua Korbid Keumatan sekaligus Wakil Ketua Bappilu legislatif dan presiden,&quot; ujar Airlangga di Hotel Dharmawangsa, Jalan Brawijaya Raya, Kebayoran Baru, Jakarta Selatan, Kamis (20/12/2018).<br />\nBaca juga: Kepada Mahfud Md, Ormas Islam Harap Pemerintah Aktif Ajak Dialog</p>\n\n<p>TGB mengaku bersyukur atas dua jabatan yang diberikan oleh Golkar. Ia berharap dirinya bisa menghasilkan sesuatu yang baik untuk Partai Golkar.</p>\n\n<p>&quot;Saya bersyukur dan penghikmatan itu saya akan ikhtiarkan tentu dengan arahan para tokoh Golkar, Pak Ketum, Mas Agus dan semua mudah-mudahan bisa menghasilkan sesuatu yang bermanfaat untuk Golkar tentu untuk Indonesia,&quot; kata TGB.</p>\n', '2021-09-10 16:22:35', '2021-09-10 17:41:22', 'budiasa', 'budi', 'budi', NULL, 1, 1, 1, 1, 'jejak-tgb-manuver-dukung-jokowi-saat-pilpres-kini-jadi-komisaris'),
(8, '3 Cara Membuat Bakso  yang Dijamin Mudah dan Rasanya Enak', '1631594048_eb410f34ece7ac863fbb.jpg', '/templet/gambar-berita', '<p>Jakarta Indonesia memiliki beragam kuliner lezat. Salah satunya yang paling terkenal adalah bakso. Makanan berupa bulatan daging yang disiram kuah gurih ini memiliki banyak penggemar.</p>\r\n\r\n<p>Mencontoh pada KBBI, bakso merupakan makanan yang terbuat dari daging sapi atau udang atau ikan yang dicincang dan dilumatkan bersama tepung kanji dan putih telur, lalu biasanya dibentuk bulat-bulat.</p>\r\n\r\n<p>Di Indonesia sendiri banyak macam bakso. Ada yang terbuat dari daging sapi, ayam, ikan, dan masih banyak lagi. Bahkan kini bakso tidak lagi hanya bulatan daging namun bisa diisi dengan macam-macam. Bisa diisi telur puyuh, telur ayam, cabai, sambal, sosis, hingga keju.</p>\r\n\r\n<p>Tidak hanya isinya saja, bahkan cara penyajian bakso pun beraneka ragam, ada yang menggunakan kuah seperti biasa, ada yang dibakar, ada pula yang dipenyet dengan sambal.</p>\r\n\r\n<p>Selain isi dan cara penyajian, bentuk dan ukuran bakso sangat bervariasi. Tidak hanya bulatan, banyak penjual bakso yang kemudian berinovasi ada yang kotak, berbentuk hati, hingga barbel. Memang benar ya kalau masyarakat Indonesia terlalu kreatif. Bakso bahkan menjadi makanan favorit mantan presiden Amerika, Barack Obama saat beliau tinggal di Indonesia semasa kecil.</p>\r\n\r\n<p>Seperti makanan pinggir jalan lainnya, sejarah bakso masih menjadi misteri. Ada yang bilang bahwa kuah dan mienya berasal dari Cina, namun pentol atau bulatan dagingnya berasal dari Belanda yang sempat menjajah Indonesia pada abad ke -19. Sementara isi baksonya sendiri tidak diketahui.</p>\r\n\r\n<p>Bakso pada umumnya terdiri dari kuah kaldu sapi, pentol, tahu, dan mie. Tapi berhubung semakin banyak inovasi bakso, banyak pula macam-macamnya. Cara membuat variasi bakso pun juga beraneka ragam dari cara membuat bakso urat hingga cara membuat bakso telur.</p>\r\n\r\n<p>Sering kita jumpai pedagang kaki lima yang menjajakan bakso.</p>\r\n\r\n<p>Dikarenakan semakin ketatnya persaingan di antara pedagang, maka mereka pun berlomba-lomba mendapatkan profit tinggi. Demi mendapatkan pendapatan lebih, tidak sedikit yang kemudian memakai cara nakal. Berikut hal-hal nakal yang dilakukan oleh pedagang bakso.<br />\r\nBahaya bakso dicampur boraks</p>\r\n\r\n<p>Sempat geger adanya bakso yang dicampur dengan boraks dengan dalih agar lebih awet. Padahal boraks sendiri dapat menyebabkan kanker hati. Cara mengenali bakso yang menggunakan boraks mudah saja :</p>\r\n\r\n<ol>\r\n	<li>Bakso boraks mempunyai tekstur yang lebih kenyal. Bahkan jika Anda melemparkannya bakso tersebut bisa memantul dan tidak menempel pada lantai.</li>\r\n	<li>Jika Anda membeli bakso, biarkan pada tempat terbuka selama 3 hari, maka bakso tersebut masih awet, bahkan tidak ada lalat atau serangga lainnya yang hinggap atau bahkan hanya lewat di atasnya.</li>\r\n	<li>Bakso boraks cenderung lebih putih.</li>\r\n	<li>Bakso boraks akan memiliki aroma yang tidak alami seperti bakso alami yang memiliki aroma daging yang khas.</li>\r\n</ol>\r\n', '2021-09-10 17:25:29', '2021-09-13 19:34:08', 'budiasa', 'budi', 'budi', NULL, 1, 1, 2, 1, '3-cara-membuat-bakso-yang-dijamin-mudah-dan-rasanya-enak'),
(9, 'Berbagi Informasi Terkini Seputar Obat dan Makanan', '1631777930_83963fb4cc13ddf5ec8c.jpg', '/templet/gambar-berita', '<p>Berbagi Informasi Terkini Seputar Obat dan Makanan Melalui Sistem Informasi Server WhatsApp Messenger. Komunikasi dan edukasi membutuhkan media untuk menyampaikan pesan kepada masyarakat. Media komunikasi dan edukasi yang sering dijumpai dalam kehidupan sehari-hari adalah media cetak dan elektronik, diantaranya penggunaan WhatsApp Messenger pada smartphone. WhatsApp Messenger merupakan aplikasi pesan lintas platform yang memungkinkan kita bertukar pesan tanpa pulsa, karena WhatsApp Messenger menggunakan paket data internet dengan koneksi 3G, 4G atau WiFi untuk komunikasi data. Melalui penggunaan WhatsApp, kita dapat melakukan obrolan secara daring, berbagi file, bertukar foto dan lain-lain. Media tersebut diharapkan mampu menyebarkan informasi dalam waktu yang singkat dan serempak kepada masyarakat.<br />\nInformasi tentang obat dan makanan sangat diperlukan oleh masyarakat, meliputi cara memilih produk yang aman, menghindari produk yang tidak aman dikonsumsi, cara pendaftaran produk obat dan makanan maupun layanan informasi dan pengaduan yang dilakukan oleh Loka Pengawas Obat dan Makanan (POM) di Kabupaten Banyumas. Agar masyarakat menjadi konsumen yang cerdas dalam menghadapi derasnya informasi serta iklan yang menarik dan meyakinkan maka Loka POM di Kabupaten Banyumas menyelenggarakan kegiatan Komunikasi, Informasi, dan Edukasi (KIE) tentang obat, obat tradisional, kosmetik, dan makanan melalui Sistem Informasi Server yang tersedia di aplikasi WhatsApp Messenger. Sistem Informasi Server WhatsApp Messenger ini dikelola oleh Info Banyumas, startup yang memberikan layanan publikasi dan Grup WhatsApp Seputar Banyumas.&nbsp; &nbsp;</p>\n\n<p>Informasi yang disampaikan melalui WhatsApp Messenger tersebut dapat diakses kapan dan dimana saja. Cukup dengan mengirim chat *BPOM_BMS ke nomor WhatsApp Info Banyumas (0823-1350-7224), pengguna akan mendapatkan informasi terkini seputar obat dan makanan. Admin akan memperbaharui informasi yang dibagikan setiap hari sesuai dengan informasi yang diberikan oleh Loka POM di Kabupaten Banyumas.</p>\n\n<p>Penyebaran informasi terkini seputar obat dan makanan melalui Sistem Informasi Server WhatsApp Messenger ini merupakan pelaksanaan inovasi pelayanan publik yg dikembangkankan oleh Loka POM di Kabupaten Banyumas, yang saat ini juga sedang diikutkan dalam lomba Inovasi Pelayanan Publik di lingkungan Badan Pengawas Obat dan Makanan (POM). Hadirnya inovasi ini diharapkan dapat memberikan informasi tentang obat, obat tradisional, kosmetik, dan makanan yang seluas-luasnya kepada seluruh lapisan masyarakat sehingga meningkatkan kepedulian masyarakat akan jaminan keamanan maupun mutu obat dan makanan sehingga terhindar dari produk yang tidak aman dikonsumsi dan mampu melindungi diri sendiri dari obat dan makanan yang berisiko terhadap kesehatan.&nbsp; &nbsp;</p>\n\n<p>Unit Layanan Pengaduan Konsumen (ULPK) Loka POM Banyumas</p>\n\n<p>Mal Pelayanan Publik (MPP) Kab. Banyumas</p>\n\n<p>Jl. Dr. Angka No. 45, Purwokerto Timur, Banyumas</p>\n\n<p>Layanan Masyarakat Semi-Elektronik Loka POM Banyumas</p>\n\n<p>Telepon : (0281) 631222</p>\n\n<p>WhatsApp : 0813 &ndash; 2988 &ndash; 6288</p>\n\n<p>E-mail : lokapombms@gmail.com</p>\n\n<p>Instagram : @lokapom_banyumas</p>\n\n<p>Youtube : Loka POM Banyumas</p>\n\n<p>Tik-tok : @lokapombanyumas</p>\n', '2021-09-10 17:30:03', '2021-09-15 22:38:50', 'Agustin', 'budi', 'budi', NULL, 1, 1, 1, 1, 'berbagi-informasi-terkini-seputar-obat-dan-makanan'),
(10, 'Surplus Neraca Perdagangan Terus Berlanjut', '1631327531_833bf056395319bbc04b.jpeg', '/templet/gambar-berita', '<p>No. 23/ 40 /DKom<br />\r\nMenurut data Badan Pusat Statistik (BPS), neraca perdagangan Indonesia Januari 2021 kembali mencatat surplus sebesar 1,96 miliar dolar AS, meskipun sedikit menurun dibandingkan dengan surplus bulan sebelumnya sebesar 2,1 miliar dolar AS. Dengan perkembangan tersebut, neraca perdagangan Indonesia telah berturut-turut mengalami surplus sejak Mei 2020. Bank Indonesia memandang surplus neraca perdagangan tersebut berkontribusi positif dalam menjaga ketahanan eksternal perekonomian Indonesia. Ke depan, Bank Indonesia terus memperkuat sinergi kebijakan dengan Pemerintah dan otoritas terkait untuk meningkatkan ketahanan eksternal, termasuk prospek kinerja neraca perdagangan.</p>\r\n\r\n<p><br />\r\nSurplus neraca perdagangan Januari 2021 dipengaruhi oleh surplus neraca perdagangan nonmigas yang berlanjut. Pada Januari 2021, surplus neraca perdagangan nonmigas meningkat menjadi 2,63 miliar dolar AS, lebih tinggi dari surplus Desember 2020 sebesar 2,56 miliar dolar AS. Perkembangan itu dipengaruhi oleh ekspor yang meningkat sebesar 15,30 miliar dolar AS, meskipun lebih rendah dari peningkatan ekspor bulan sebelumnya sebesar 16,54 miliar dolar AS. Ekspor komoditas berbasis sumber daya alam, seperti CPO, batubara, dan bijih logam tercatat membaik, di tengah penurunan ekspor sejumlah produk manufaktur. Sementara itu, impor nonmigas menurun pada seluruh komponen, terutama dipengaruhi permintaan domestik yang belum kuat. Adapun, defisit neraca perdagangan migas sedikit meningkat dari 0,46 miliar dolar AS pada Desember 2020 menjadi 0,67 miliar AS, dipengaruhi oleh penurunan ekspor migas di tengah impor migas yang meningkat.</p>\r\n\r\n<p>Jakarta, 15 Februari 2021<br />\r\nKepala Departemen Komunikasi<br />\r\nErwin Haryono<br />\r\nDirektur Eksekutif<br />\r\nInformasi tentang Bank Indonesia<br />\r\nTelp. 021-131, Email : bicara@bi.go.id</p>\r\n', '2021-09-10 17:32:11', '2021-09-10 17:32:11', 'Artikel Tokopedia', 'budi', 'budi', NULL, 1, 1, 1, 1, 'surplus-neraca-perdagangan-terus-berlanjut'),
(11, 'Loper Koran di Ujung-Ujung Senja', 'default.jpg', '/templet/gambar-berita', '<blockquote>\r\n<p>Selepas salat Subuh, Subur, 52 tahun, bergegas mengganti pakaiannya. Ia mengenakan kaus lengan panjang, celana kasual, dan rompi berwarna biru. Tak lupa sepatu kets, topi, dan masker juga dikenakannya. Begitu jarum jam menunjukkan pukul 05.00 WIB, Subur meninggalkan rumahnya di kawasan Tanah Tinggi, Johar Baru, Jakarta Pusat.Dengan langkah kaki yang mantap, Subur menyusuri jalan sepanjang 3 kilometer menuju Kramat, Jakarta Pusat. Saban hari, ia berangkat dari rumah menuju agen distributor koran di tempat itu. Ia mengambil beberapa koran terbitan terbaru untuk dijual kembali di Simpang Lima Senen, Jakarta Pusat. Rutinitas itu telah ia lakoni sejak tahun 2000.</p>\r\n</blockquote>\r\n\r\n<p>Dari agen, Subur melangkah ke Simpang Lima Senen, yang jaraknya sekitar 200 meter. Tepat pukul 06.00 WIB, Subur sudah mengasongkan koran dagangannya kepada orang yang mulai ramai berlalu lalang. Koran seperti Kompas, Media Indonesia, Warta Kota, Pos Kota, Rakyat Merdeka, Lampu Hijau, dan Super Ball diasongkannya kepada para pengguna sepeda motor dan mobil yang berhenti di lampu merah, tak jauh dari Plaza Atrium. Saya jualan di lampu merah Senen ini sampai pukul 12.00 WIB. Habis Zuhur pulang. Kadang kalau lagi bagus, pukul 10.00 WIB sudah pulang, ucap Subur saat ditemui <strong>detikX </strong>di perempatan Senen, Rabu, 23 Juni 2021.</p>\r\n\r\n<p>Subur adalah satu dari segelintir loper yang masih berjualan koran hingga saat ini. Belakangan ini, semakin sulit saja melihat loper koran di jalan-jalan Ibu Kota atau berkeliling ke perkampungan penduduk. Agen-agen koran, tabloid, dan majalah pun sama. Mereka juga semakin jarang dijumpai. Meredupnya loper dan agen itu tak lepas dari bergugurannya surat kabar dan majalah cetak sejak hadirnya era digital. Digitalisasi telah mengubah perilaku pembaca berita, dari sebelumnya media cetak ke media digital. Sejumlah koran dan majalah cetak terpaksa menutup operasionalnya karena pendapatan iklan terus merosot. Sebagian harus beralih ke platform digital untuk bertahan.</p>\r\n\r\n<p>Pada 2019, berdasarkan data Serikat Perusahaan Pers (SPS), terdapat penurunan pertumbuhan media cetak di Indonesia dibandingkan tahun 2014. Jumlah surat kabar harian menurun dari 418 ke 383, surat kabar mingguan turun dari 218 ke 77, majalah turun dari 449 ke 111, dan tabloid turun dari 236 ke 73. Secara total, jumlah media cetak turun dari 1.321 (2014) ke 644 (2019). Lantas, oplah media cetak tinggal 12,8 juta juta eksemplar pada tahun 2019. Jumlah itu turun sekitar 5 juta eksemplar dari 2014 sebesar 23,3 juta eksemplar. Ditanya apakah masih ada yang membeli korannya setiap kali berjualan, Subur menjawab pasti ada saja.</p>\r\n\r\n<p>Hanya, menurutnya, sebagian pembeli membeli korannya juga karena merasa iba, di samping mereka memang masih mengandalkan koran untuk mencari berita. &ldquo;Pasti ada, cuma sedikit. Karena orang kasihan saja, cetus Subur. Setiap hari Subur membawa 40-50 eksemplar koran dengan harga jual per koran Rp 2.000-5.000. Koran yang tak laku biasanya ia jual seharga Rp 1.000 per eksemplar kepada tetangga dan pedagang di pasar. Biasanya koran bekas dijadikan pembungkus barang-barang belanjaan. Sebagian lainnya untuk kebutuhan pengecatan mobil oleh bengkel cat kendaraan yang berjejer di seputar Jalan Salemba dan Jalan Kramat.</p>\r\n\r\n<p>Dulu ibaratnya tidur saja saya udah digaji. Iyalah, Rp 12 juta sebulan mah dapet itu, imbuh Nenah sambil duduk di depan koran-koran yang ia jual pada hari itu. Dulu koran masih banyak.Tahun 1985-2000 masih mendingan, cetus Nenah.</p>\r\n', '2021-09-10 17:34:58', '2021-09-15 22:48:31', 'Wikipedia Ensiklopedia', 'budi', 'budi', NULL, 1, 1, 2, 1, 'loper-koran-di-ujung-ujung-senja'),
(12, '30 wanita tercantik di pantai osaka', '1632125229_0d222b7624f20577177d.jpg', '/templet/gambar-berita', 'Osaka Betapa saya ingin melepaskan semua bajumu sekarang juga dan mendapatkan diri di sinar matahari dengan jentikan jari saja, berjemur di pasir hangat atau berenang di ombak biru, tanpa memikirkan pekerjaan dan rutin sehari-hari.\n', '2021-09-10 17:42:27', '2021-09-19 23:07:09', 'Mahmud', 'budi', 'budi', NULL, 1, 1, 7, 1, '30-wanita-tercantik-di-pantai-osaka'),
(13, 'Ayah Pevita Pearce Meninggal Dunia', '1631328217_bdde16193d23017bcbea.jpg', '/templet/gambar-berita', 'Puluhan kerabat dari 298 korban pesawat Malaysia Airlines nomor penerbangan MH 17 yang ditembak jatuh di wilayah Ukraina Timur yang dikuasai pemberontak pada 2014, mulai memberikan kesaksian pada hari Senin, 6 September 2021, pada persidangan kasus pembunuhan oleh empat buronan yang menjadi tersangka serangan itu.', '2021-09-10 17:43:37', '2021-09-10 17:43:37', 'Agustin', 'budi', 'budi', NULL, 1, 1, 7, 1, 'ayah-pevita-pearce-meninggal-dunia'),
(14, 'Kisah Pengusaha Kelor Raup Omzet Rp 4 Miliar, Awalnya Dianggap Gila', '1631328444_7700d22dbc0894823a1e.jpg', '/templet/gambar-berita', 'Kisah sukses kali ini datang dari seorang pengusaha kelor di Blora, Jawa Tengah, bernama Ai Dudi Krisnadi.\n', '2021-09-10 17:47:24', '2021-09-10 17:47:24', 'budia', 'budi', 'budi', NULL, 1, 1, 7, 1, 'kisah-pengusaha-kelor-raup-omzet-rp-4-miliar-awalnya-dianggap-gila'),
(15, 'Jalur Bandung-Lembang Mulai Dipadati Wisatawan', '1631338197_24fd3c050f83922d59d7.jpeg', '/templet/gambar-berita', 'Arus lalu lintas dari Bandung menuju Lembang terpantau padat pada Sabtu (11/9/2021), sekitar pukul 11.00 WIB. Polisi turun tangan untuk mengurai titik kepadatan di pertigaan kawasan Ledeng, Kota Bandung.\n', '2021-09-10 20:29:57', '2021-09-10 20:29:57', 'Agustin', 'budi', 'budi', NULL, 1, 1, 7, 1, 'jalur-bandung-lembang-mulai-dipadati-wisatawan'),
(16, 'Kepulauan Raja Ampat', '1631686889_1b1860ec82188f000b85.jpg', '/templet/gambar-berita', '<p>Raja Ampat seakan sudah menjadi ikon Papua Barat. Keindahannya tak kalah jika disandingkan dengan Maldives. Kekayaan alamnya masih cenderung alami dengan dipenuhi spesies satwa yang tak bisa ditemukan di perairan lainnya. Kamu bisa <em>snorkeling </em>atau <em>diving </em>di sini.&nbsp;</p>\r\n', '2021-09-14 21:21:29', '2021-09-14 21:21:29', 'Agustin', 'budi', 'budi', NULL, 1, 1, 3, 1, 'kepulauan-raja-ampat'),
(17, 'Taman Nasional Teluk Cenderawasih', '1631686967_ef589584529c862a1685.jpg', '/templet/gambar-berita', '<p>Taman Nasional Teluk Cenderawasih merupakan salah satu taman nasional laut terluas di Indonesia. Kalau kamu mau diving, kamu bisa merasakan sensasi berenang bareng hiu dan paus di sini. Tentunya dalam pengawasan dan jarak aman tertentu ya.</p>\n', '2021-09-14 21:22:47', '2021-09-14 21:22:47', 'Budia', 'budi', 'budi', NULL, 1, 1, 3, 1, 'taman-nasional-teluk-cenderawasih'),
(18, 'Danau Framu', '1631687031_5036da3f405667a2ffe9.jpg', '/templet/gambar-berita', '<p>Sebening cermin, begitulah kesan yang akan kamu dapatkan saat berkunjung ke Danau Framu. Airnya begitu jernih dan berwarna biru menyegarkan mata.</p>\r\n', '2021-09-14 21:23:51', '2021-09-14 21:23:51', 'Wikipedia Ensiklopedia', 'budi', 'budi', NULL, 1, 1, 3, 1, 'danau-framu'),
(19, 'Taman Wisata Alam Gunung Meja', '1631687084_0d30bfd590d0084512e4.jpg', '/templet/gambar-berita', '<p>Taman wisata alam ini berada di pusat Kota Manokwari. Selain dapat menikmati pemandangan alam yang indah, kamu bisa melakukan berbagai aktivitas yang menyenangkan, seperti <em>trekking, hiking</em>, hingga menikmati panorama Papua Barat dari ketinggian.</p>\r\n', '2021-09-14 21:24:44', '2021-09-14 21:24:44', 'Meriana', 'budi', 'budi', NULL, 1, 1, 3, 1, 'taman-wisata-alam-gunung-meja'),
(20, 'This is Raja Ampat - Papua Indonesia', '1631689687_02c602f6455f6b2da03c.jpg', '/templet/gambar-berita', '<p><span dir=\"auto\">A short film about a God&#39;s Masterpiece which became a pride of every Indonesian. This is RAJA AMPAT, a cluster of beautiful coral islands located in West Papua. Inhabited by thousands of species of marine animals and tropical creatures. Which became the primary scuba diving...</span></p>\n\n<iframe width=\"810\" height=\"515\" src=\"https://www.youtube.com/embed/feoRIr5MNHM\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\n', '2021-09-14 22:08:07', '2021-09-14 22:08:07', 'Agustin', 'budi', 'budi', NULL, 1, 1, 4, 1, 'this-is-raja-ampat-papua-indonesia'),
(21, 'Pesona Indonesia: Raja Ampat, Papua Barat, Papua', '1631691437_2f1c376c5f23aa86de63.jpg', '/templet/gambar-berita', 'Siapa yang tidak mengenal Raja Ampat ? Yap, raja ampat merupakan salah satu tempat wisata di Papua yang memiliki keindahan yang menarik perhatian wisatawan domestik dan mancanegara. Kawasan raja ampat ini terdiri dari empat pulau besar yaitu Waigeo, Misool, Salawati, Batanta dan Pulau-pulau kecil lainnya. Raja ampat memiliki beragam biota laut, menurut laporan dari The Nature Conservancy, ada sebanyak 75% spesies laut dunia ditemukan di perairan Raja Ampat ini. Selama kamu menyelam, kamu akan ditemani sekitar 1.511 jenis ikan dan juga penyu laut. Jika kamu ingin berkunjung kesini, sebaiknya kamu datang pada bulan Oktober dan November, karena bulan-bulan ini cuaca sedang bagus dan air sangat jernih sehingga jarak pandang saat menyelam sangat ideal.\n\n<iframe width=\"810\" height=\"515\" src=\"https://www.youtube.com/embed/Q-OWraAwJOE\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2021-09-14 22:37:17', '2021-09-14 22:37:17', 'Wikipedia Ensiklopedia', 'budi', 'budi', NULL, 1, 1, 4, 1, 'pesona-indonesia-raja-ampat-papua-barat-papua'),
(22, 'Taman Nasional Teluk Cenderawasih', '1631692135_2449a7219a91abf6df52.jpeg', '/templet/gambar-berita', '<p>Taman nasional dengan luas 1.453.500 hektar ini hampir 90% berupa perairan. Tak heran jika Taman Nasioanal Teluk Cenderawasih ini menjadi kawasan konservasi laut terbesar dan terluas di Indonesia. Di sini, terdapat 196 jenis moluska dan 209 jenis ikan yang bisa kamu lihat di alam bawah lautnya. Tak jarang kura-kura, penyu, hiu dan lumba-lumba juga ikut menemani kamu saat menyelam. Selain menikmati alam bawah lautnya, kamu juga bisa menjelajahi pulau-pulaunya. Pulau Mioswaar adalah salah satu pulau di Papua yang memiliki gua dengan sumber air panas dengan kandungan belerang yang layak kamu kunjungi. Selain Pulau Mioswaar, ada Pulau Yoop, Pulau Numfor, Pulau Nusrowi dan Pulau-pulau lainnya yang tak boleh kamu lewatkan.</p>\n\n<p><iframe frameborder=\"0\" height=\"515\" src=\"https://www.youtube.com/embed/gD-WOasucqc\" title=\"YouTube video player\" width=\"810\"></iframe></p>\n', '2021-09-14 22:48:55', '2021-09-14 22:48:55', 'MSI Nabire', 'budi', 'budi', NULL, 1, 1, 4, 1, 'taman-nasional-teluk-cenderawasih');

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
(1, 'ADMPEMDA', '2021-06-12 00:41:38', NULL, 1, 1, 'analyst', NULL, NULL, 'ADMINISTRATOR PEMDA'),
(2, 'USR', '2021-06-12 00:42:44', NULL, 1, 1, 'analyst', NULL, NULL, 'USER'),
(4, 'ADMOPD', '2021-09-07 07:58:42', NULL, 1, 1, 'superuser', NULL, NULL, 'ADMINISTRATOR OPD');

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
(39, NULL, NULL, 'ADM', 0, 'ADMINISTRATOR', '2021-08-14 04:57:33', '2021-08-14 04:57:33', 1, 'superuser', NULL, NULL, 0, 1),
(40, NULL, NULL, 'BUPATI', 1, 'BUPATI PEMERINTAH DAERAH KABUPATEN INTAN JAYA', '2021-08-31 07:39:40', '2021-08-31 07:39:40', 1, 'superuser', NULL, NULL, NULL, 1),
(41, NULL, NULL, 'BUPATI', 1, 'BUPATI PEMERINTAH DAERAH KABUPATEN INTAN JAYA', '2021-08-31 07:47:35', '2021-08-31 07:47:35', 1, 'superuser', NULL, NULL, NULL, 1),
(42, NULL, NULL, 'BUPATI', 1, 'BUPATI PEMERINTAH DAERAH KABUPATEN INTAN JAYA', '2021-08-31 07:49:05', '2021-08-31 07:49:05', 1, 'superuser', NULL, NULL, NULL, 1),
(43, NULL, NULL, 'BUPATI', 1, 'BUPATI PEMERINTAH DAERAH KABUPATEN INTAN JAYA', '2021-08-31 07:55:04', '2021-08-31 07:55:04', 1, 'superuser', NULL, NULL, NULL, 1),
(44, NULL, NULL, 'BUPATI', 1, 'BUPATI PEMERINTAH DAERAH KABUPATEN INTAN JAYA', '2021-08-31 07:55:26', '2021-08-31 07:55:26', 1, 'superuser', NULL, NULL, NULL, 1);

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
(56, '::1', 'budi', 1, '2021-09-21 02:42:49', 1),
(57, '::1', 'superuser', 0, '2021-09-21 02:53:13', 1),
(58, '::1', 'budi46@gmail.com', 1, '2021-09-22 01:28:01', 1),
(59, '::1', 'budi46@gmail.com', 1, '2021-09-22 07:05:40', 1),
(60, '::1', 'budi46@gmail.com', 1, '2021-09-23 01:41:23', 1),
(61, '::1', 'budi46@gmail.com', 1, '2021-09-24 01:15:13', 1),
(62, '::1', 'budi46@gmail.com', 1, '2021-09-24 05:05:30', 1),
(63, '::1', 'budi46@gmail.com', 1, '2021-09-25 02:03:57', 1),
(64, '::1', 'putri@gmail.com', 4, '2021-09-25 08:02:06', 1),
(65, '::1', 'budi46@gmail.com', 1, '2021-09-27 02:21:21', 1),
(66, '::1', 'budi46@gmail.com', 1, '2021-09-27 08:06:37', 1),
(67, '::1', 'budi46@gmail.com', 1, '2021-09-28 02:08:20', 1),
(68, '::1', 'budi46@gmail.com', 1, '2021-09-29 01:12:35', 1),
(69, '::1', 'budi46@gmail.com', 1, '2021-09-29 05:09:37', 1),
(70, '::1', 'budi46@gmail.com', 1, '2021-09-30 04:31:12', 1),
(71, '::1', 'budi46@gmail.com', 1, '2021-09-30 07:35:57', 1),
(72, '::1', 'budi46@gmail.com', 1, '2021-10-01 01:18:24', 1),
(73, '::1', 'budi46@gmail.com', 1, '2021-10-01 06:38:45', 1);

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
  `nomor_unit_kerja` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `file_logo` varchar(255) DEFAULT NULL,
  `path_file_logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `opd_hdr`
--

INSERT INTO `opd_hdr` (`id`, `kode`, `create_date`, `last_modified_date`, `is_active`, `user_created`, `user_updated`, `notes`, `is_visible`, `nama_opd`, `alamat_opd`, `kode_pos`, `telepon`, `fax`, `email`, `website`, `level`, `nomor_unit_kerja`, `file_logo`, `path_file_logo`) VALUES
(0, 'PEMDA', '2021-08-14 02:06:46', '2021-08-14 02:06:46', 1, 'analyst', 'analyst', NULL, 0, 'PEMERINTAH DAERAH KABUPATEN INTAN JAYA', 'Intan Jaya', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(1, 'BPBD', '2021-06-10 06:50:26', '2021-06-10 06:50:26', 1, 'analyst', 'budi', NULL, 1, 'BADAN PENANGGULANGAN BENCANA DAERAH', 'Intan Jaya', '', '\'', '\'', '\'', '\'', 3, 'BPBD', NULL, NULL),
(2, 'BKD', '2021-06-28 06:18:58', '2021-06-28 06:18:58', 1, 'decul', 'melina', NULL, 1, 'BADAN KEPEGAWAIAN DAERAH', 'Intan Jaya', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(3, 'D', '2021-07-26 13:25:56', '2021-07-26 13:25:56', 1, 'superuser', NULL, NULL, 1, 'BADAN KEPEGAWAIAN DAERAH', 'Intan Jaya', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL);

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

--
-- Dumping data for table `profil_pejabat`
--

INSERT INTO `profil_pejabat` (`id`, `pegawai_id`, `file_foto`, `path_file_foto`, `user_created`, `user_updated`, `created_date`, `last_modified_date`, `is_active`, `status_sistem_id`, `deskripsi`) VALUES
(1, 15, '1632894649_91585ac277868d39e47d.png', '/foto-pejabat', 'budi', 'budi', '2021-09-29 05:50:49', '2021-09-29 05:50:49', 1, 1, 'as fasdf asdf asd f'),
(2, 13, '1632976310_4acd4f7740731423e761.png', '/foto-pejabat', 'budi', 'budi', '2021-09-30 04:31:50', '2021-09-30 04:31:50', 1, 1, 'Akan ada pengalaman dalam menjadi pemimpin yang baik'),
(3, 3, '1632976438_e165a219dcb824c07c64.jpg', '/foto-pejabat', 'budi', 'budi', '2021-09-30 04:33:58', '2021-09-30 04:33:58', 1, 1, 'Garis bawahi kata ini');

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
(1, 'Artikel', 1, 'terupload', NULL),
(2, 'Artikel', 1, 'publish', NULL),
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
(7, 'Slide Show', NULL),
(8, 'Peta Intan Jaya', NULL);

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
  ADD UNIQUE KEY `profil_pejabat_un` (`pegawai_id`),
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `log_logins`
--
ALTER TABLE `log_logins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

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
-- AUTO_INCREMENT for table `profil_pejabat`
--
ALTER TABLE `profil_pejabat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
