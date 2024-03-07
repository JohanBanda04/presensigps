<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Satker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class DatasatkerController extends Controller
{
    public function index(Request $request)
    {
        $query = Satker::query();
//        $query->select('karyawan.*', 'nama_dept');
//        $query->join('departemen', 'karyawan.kode_dept', '=', 'departemen.kode_dept');
//        $query->orderBy('nama_lengkap');
        if (!empty($request->nama_satker)) {
            $query->where('name', 'like', '%' . $request->nama_satker . '%');
        }

//        if (!empty($request->kode_dept)) {
//            $query->where('karyawan.kode_dept', $request->kode_dept);
//        }
        $satker = $query->paginate(10);
        //


        /*CARA MENGGUNAKAN RAW QUERY LARAVEL*/
        $results = DB::select(DB::raw("SELECT MAX(right(kode_satker,2)) as kode FROM satker"));

        //dd($results[0]->kode);
        $kode_new = $results[0]->kode + 1;
        $kode_satker = "SAT-NTB-0" . $kode_new;
        //dd($kode_satker);
        //
        //$departemen = DB::table('departemen')->get();
        //$cabang = DB::table('cabang')->orderBy('kode_cabang')->get();
        return view('satker.index', compact('satker', 'kode_satker'));
    }

    public function store(Request $request)
    {
        $nama = strtoupper($request->nama_satker);
        $kode_satker = strtoupper($request->kode_satker);
        $email = $request->email;
        $no_hp = $request->no_hp;
        $roles = $request->role_satker;
        $password = Hash::make($request->password);

        $cek_satker = DB::table('satker')
            ->where('name', $nama)
            ->orWhere('kode_satker', $kode_satker)
            ->orWhere('email', $email);
        //dd(($cek_satker)->count());
        //dd($nama ."-".$email."-".$no_hp."-".$roles."-".$password);
        if (($cek_satker)->count() > 0) {
            return Redirect::back()->with(['warning' => 'Nama Satker Sudah Ada / Email Telah Terdaftar']);
        } else {
            try {
                $data = [
                    "name" => $nama,
                    "kode_satker" => $kode_satker,
                    "email" => $email,
                    "no_hp" => $no_hp,
                    "roles" => $roles,
                    "password" => $password,
                ];
                $simpan = DB::table('satker')->insert($data);
                if ($simpan) {
                    return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
                } else {
                    return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
                }
            } catch (\Exception $e) {
                return Redirect::back()->with(['warning' => 'Data Gagal Disimpan ']);
            }
        }

    }

    public function edit(Request $request)
    {

        //$nik = $request->nik;
        //$departemen = DB::table('departemen')->get();
        //$cabang = DB::table('cabang')->orderBy('kode_cabang')->get();
        //$karyawan = DB::table('karyawan')->where('nik',$nik)->first();
        //return view('karyawan.edit',compact('departemen','karyawan','cabang'));

        $id = $request->id_satker;
        //echo $id; die;
        $satker = DB::table('satker')->where('id', $id)->first();
        return view('satker.edit', compact('satker'));
    }

    public function update($id, Request $request)
    {

        $id = $request->id;
        $nama = strtoupper($request->nama_satker);
        $kode_satker = strtoupper($request->kode_satker);
        $email = $request->email;
        $no_hp = $request->no_hp;
        $roles = $request->role_satker;

        //dd($request);
        $old_pass = DB::table('satker')->where('id', $id)->first()->password;
        //dd($old_pass);

        if (!empty($request->password)) {
            $password = Hash::make($request->password);
        } else {
            $password = $old_pass;
        }

        try {
            $data = [

                "name" => $nama,
                "kode_satker" => $kode_satker,
                "email" => $email,
                "no_hp" => $no_hp,
                "roles" => $roles,
                "password" => $password,
            ];
            $update = DB::table('satker')->where('id', $id)->update($data);
            if ($update) {

                return Redirect::back()->with(['success' => 'Data Satker Berhasil di-Update']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Satker Gagal di-Update']);
            }
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Satker Gagal di-Update']);
        }

    }

    public function delete($id)
    {
        $satker = DB::table('satker')->where('id', $id)->first();
        $delete = DB::table('satker')->where('id', $id)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus!']);
        }


    }

    public function getberita($kode_satker, Request $request)
    {
        //dd($request->tanggal_awal);
        //var_dump($request->tanggal_awal) ;
        //die;
        //dd($request->tanggal_awal);
        $satker = DB::table('satker')->where('kode_satker', $kode_satker)->first();
        $query = DB::table('berita')->where('kode_satker', $kode_satker);
        if (!empty($request->dari) && !empty($request->sampai)) {
            $query->whereBetween('tgl_input', [$request->dari, $request->sampai]);
        }
        if (!empty($request->nama_berita)) {
            $query->where('nama_berita', 'like', '%' . $request->nama_berita . '%');
        }

        $query->orderBy("tgl_input", "desc");
        $berita_satker = $query->paginate(10);
        $berita_satker->appends($request->all());
        return view('beritasatker.index', compact('satker', 'berita_satker'));
    }

    public function storeberita(Request $request)
    {
        /*media lokal*/
        for ($a = 0; $a < count($request->jumlah); $a++) {
            //echo $request->jumlah[$a]."<br>";
        }

        /*media nasional*/
        for ($b = 0; $b < count($request->jumlah_nasional); $b++) {
            //echo $request->jumlah[$a]."<br>";
        }

        /*media lokal*/
        $count_if_exist = 0;

        /*media nasional*/
        $count_if_exist_nasional = 0;

        /*media lokal*/
        if (count($request->jumlah) <= 0) {

            $count = 0;
        } else if (count($request->jumlah) > 0) {
            for ($a = 0; $a < count($request->jumlah); $a++) {
                $count_if_exist += 1;
            }
            $count = $count_if_exist;
        }

        /*media nasional*/
        if (count($request->jumlah_nasional) <= 0) {

            $count_nasional = 0;
        } else if (count($request->jumlah_nasional) > 0) {
            for ($b = 0; $b < count($request->jumlah_nasional); $b++) {
                $count_if_exist_nasional += 1;
            }
            $count_nasional = $count_if_exist_nasional;
        }

        /*media lokal*/
        if ($count != 0) {

            for ($i = 0; $i < $count; $i++) {
                $url_gabung[$i] = $request->jumlah[$i];
            }
        } else {
            $url_gabung = [];
        }

        /*media nasional*/
        if ($count_nasional != 0) {

            for ($j = 0; $j < $count_nasional; $j++) {
                $url_gabung_nasional[$j] = $request->jumlah_nasional[$j];
            }
        } else {
            $url_gabung_nasional = [];
        }

        /*store link media nasional*/

        //echo json_encode($url_gabung)."<br>";
        //echo print_r(json_decode(json_encode($url_gabung)))."<br>" ;
        //die;

        //echo json_encode($url_gabung_nasional)."<br>";
        //echo print_r(json_decode(json_encode($url_gabung_nasional))) ;
        //die;
        try {
            $data = [
                "kode_satker" => $request->kode_satker,
                "tgl_input" => date('Y-m-d'),
                "nama_berita" => $request->judul_berita_satker,
                "facebook" => $request->facebook,
                "website" => $request->website,
                "instagram" => $request->instagram,
                "twitter" => $request->twitter,
                "tiktok" => $request->tiktok,
                "sippn" => $request->sippn,
                "youtube" => $request->youtube,
                "media_lokal" => json_encode($url_gabung),
                "media_nasional" => json_encode($url_gabung_nasional),
            ];
            $simpan = DB::table('berita')->insert($data);
            if ($simpan) {

                return redirect('/datasatker/' . $request->kode_satker . '/getberita')->with(['success' => 'Data Berhasil Disimpan']);
                //return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
            }
        } catch (\Exception $e) {
            return redirect('/datasatker/' . $request->kode_satker . '/getberita')->with(['warning' => 'Data Gagal Disimpan']);
            //return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }


    }

    public function tampilkandetailberita(Request $request)
    {
        $id_berita = $request->id_berita;

        //dd($id_berita);
        $databerita = DB::table('berita')->where('id_berita', $id_berita)->first();
        //dd($databerita->media_lokal);
        return view('beritasatker.detail', compact('databerita'));
    }

    public function deleteberita($id_berita, $kode_satker)
    {
        $kd_satker_saved = $kode_satker;
        $delete = DB::table('berita')->where('id_berita', $id_berita)->delete();
        if ($delete) {
            return redirect('/datasatker/' . $kd_satker_saved . '/getberita')->with(['success' => 'Data Berhasil Dihapus']);
            //return Redirect::back()->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return redirect('/datasatker/' . $kd_satker_saved . '/getberita')->with(['warning' => 'Data Gagal Dihapus']);
            //return Redirect::back()->with(['warning' => 'Data Gagal Dihapus!']);

        }
    }

    public function editberita(Request $request)
    {
        $id_berita = $request->id_berita;
        $berita = DB::table('berita')->where('id_berita', $id_berita)->first();
        return view('beritasatker.edit', compact('berita'));
    }

    public function hapuslink(Request $request)
    {
        //dd($request);
        $link = $request->link;
        $key = $request->key;
        $id_berita = $request->id_berita;
        $databerita = DB::table('berita')->where('id_berita', $id_berita)->first();
        //dd($databerita);
        //return "ini respon dari controller : ".$id_berita;
        //echo "<pre>"; print_r($databerita);
        //var_dump(json_decode($databerita->media_lokal));
        //return $key;
        //die;
        $links_media_lokal = json_decode($databerita->media_lokal);
        //return count($links_media_lokal);
        unset($links_media_lokal[$key]);
        //var_dump(json_decode($databerita->media_lokal));
        //echo count($links_media_lokal);
        //die;
        try {
            $data_to_update = [
                "nama_berita" => $databerita->nama_berita,
                "kode_satker" => $databerita->kode_satker,
                "facebook" => $databerita->facebook,
                "website" => $databerita->website,
                "instagram" => $databerita->instagram,
                "twitter" => $databerita->twitter,
                "tiktok" => $databerita->tiktok,
                "sippn" => $databerita->sippn,
                "youtube" => $databerita->youtube,
                "media_lokal" => json_encode(count($links_media_lokal) > 0 ? array_values($links_media_lokal) : null),
//            "media_nasional"=>$databerita->media_nasional,
            ];
            $update = DB::table('berita')->where('id_berita', $id_berita)->update($data_to_update);
            if ($update) {
                return Redirect::back()->with(['success' => 'Link Media Lokal Berhasil dihapus']);
            } else {
                return Redirect::back()->with(['warning' => 'Link Media Lokal Gagal dihapus']);
            }
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Link Media Lokal Gagal dihapus']);
        }

    }

    public function hapuslink_nasional(Request $request)
    {
        //dd($request);
        $link = $request->link_nasional;
        $key = $request->key_nasional;
        $id_berita = $request->id_berita_nasional;
        $databerita_nasional = DB::table('berita')->where('id_berita', $id_berita)->first();
        //dd($databerita);
        //return "ini respon dari controller : ".$id_berita;
        //echo "<pre>"; print_r($databerita);
        $links_media_nasional = json_decode($databerita_nasional->media_nasional);
        //return count($links_media_lokal);
        unset($links_media_nasional[$key]);

        try {
            $data_to_update = [
                "nama_berita" => $databerita_nasional->nama_berita,
                "kode_satker" => $databerita_nasional->kode_satker,
                "facebook" => $databerita_nasional->facebook,
                "website" => $databerita_nasional->website,
                "instagram" => $databerita_nasional->instagram,
                "twitter" => $databerita_nasional->twitter,
                "tiktok" => $databerita_nasional->tiktok,
                "sippn" => $databerita_nasional->sippn,
                "youtube" => $databerita_nasional->youtube,
                //"media_lokal"=>json_encode(count($links_media_lokal)>0?array_values($links_media_lokal):null),
                "media_nasional" => json_encode(count($links_media_nasional) > 0 ? array_values($links_media_nasional) : null),
            ];
            $update = DB::table('berita')->where('id_berita', $id_berita)->update($data_to_update);
            if ($update) {
                return Redirect::back()->with(['success' => 'Link Media Nasional Berhasil dihapus']);
            } else {
                return Redirect::back()->with(['warning' => 'Link Media Nasional Gagal dihapus']);
            }
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Link Media Nasional Gagal dihapus']);
        }

    }

    public function updateberita($id_berita, Request $request)
    {
        $id = $id_berita;

        /*media lokal*/
        if ($request->jumlah_edit != null) {
            $media_lokal = count($request->jumlah_edit);
        } else if ($request->jumlah_edit == null) {
            $media_lokal = 0;
        }

        //dd($media_lokal);
        //die;

        for ($a = 0; $a < $media_lokal; $a++) {
            //echo $request->jumlah[$a]."<br>";
        }

        /*media nasional*/
        if ($request->jumlah_edit_nasional != null) {
            $media_nasional = count($request->jumlah_edit_nasional);
        } else if ($request->jumlah_edit_nasional == null) {
            $media_nasional = 0;
        }


        for ($b = 0; $b < $media_nasional; $b++) {
            //echo $request->jumlah[$a]."<br>";
        }
        //dd($media_nasional);
        //die;

        $count_if_exist = 0;

        $count_if_exist_nasional = 0;

        /*media lokal*/
        if ($media_lokal <= 0) {
            $count = 0;
        } else if ($media_lokal > 0) {
            for ($a = 0; $a < $media_lokal; $a++) {
                $count_if_exist += 1;
            }
            $count = $count_if_exist;
        }

        //sampai sini oke
        //dd($count);
        //die;

        /*media nasional*/
        if ($media_nasional <= 0) {
            $count_nasional = 0;
        } else if ($media_nasional > 0) {
            for ($b = 0; $b < $media_nasional; $b++) {
                $count_if_exist_nasional += 1;
            }
            $count_nasional = $count_if_exist_nasional;
        }
        //dd($count_nasional);
        //die;

        $databerita = DB::table('berita')->where('id_berita', $id_berita)->first();
        $medialokal_old = $databerita->media_lokal;
        $medianasional_old = $databerita->media_nasional;
        //dd($medianasional_old);
        //die;

        /*media lokal*/
        if ($count > 0) {
            for ($i = 0; $i < $count; $i++) {
                $url_gabung[$i] = $request->jumlah_edit[$i];
            }
            //$url_media_lokal_lama = json_decode($medialokal_old=='null'?"[]":$medialokal_old);
            //$url_media_lokal_tosave =  json_encode(array_merge($url_media_lokal_lama,$url_gabung));
            $url_media_lokal_tosave = json_encode($url_gabung);

            //dd($url_media_lokal_tosave);
            //die;
        } else if ($count <= 0) {
            //$url_media_lokal_tosave = [];
            $url_media_lokal_tosave = $medialokal_old;
        }

        /*media nasional*/
        if ($count_nasional > 0) {

            for ($j = 0; $j < $count_nasional; $j++) {

                $url_gabung_nasional[$j] = $request->jumlah_edit_nasional[$j];
            }
            //$url_media_nasional_lama = json_decode($medianasional_old=='null'?"[]":$medianasional_old);
            //$url_media_nasional_tosave =  json_encode(array_merge($url_media_nasional_lama,$url_gabung_nasional));
            $url_media_nasional_tosave = json_encode($url_gabung_nasional);
            //dd($url_media_nasional_tosave);
            //die;
        } else if ($count_nasional <= 0) {
//            $url_media_nasional_tosave = [];
            $url_media_nasional_tosave = $medianasional_old;
        }

        //echo "<pre>";  print_r($url_media_nasional_tosave);
        //die;
        //dd($medialokal_old);
        //dd($medianasional_old);
        //die;

        try {
            $data_to_update = [
                "kode_satker" => $request->kode_satker,
                "tgl_update" => date('Y-m-d'),
                "nama_berita" => $request->judul_berita_satker,
                "facebook" => $request->facebook,
                "website" => $request->website,
                "instagram" => $request->instagram,
                "twitter" => $request->twitter,
                "tiktok" => $request->tiktok,
                "sippn" => $request->sippn,
                "youtube" => $request->youtube,
                "media_lokal" => $url_media_lokal_tosave,
                "media_nasional" => $url_media_nasional_tosave,
            ];
            $update = DB::table('berita')->where('id_berita', $id_berita)->update($data_to_update);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Diupdate']);
            }


        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Gagal Diupdate']);
        }


    }

    public function laporanberita()
    {
        $namabulan = [
            "",
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember",
        ];
        $satker = DB::table('satker')->orderBy('kode_satker')->get();
        //$karyawan = DB::table('karyawan')->orderBy('nama_lengkap')->get();
        return view('laporan.laporanberita', compact('namabulan', 'satker'));
    }

    public function getberitabytanggal($kode_satker, Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        dd($kode_satker);
        $presensi = DB::table('presensi')
            ->select('presensi.*', 'nama_lengkap', 'nama_dept')
            ->join('karyawan', 'presensi.nik', '=', 'karyawan.nik')
            ->join('departemen', 'karyawan.kode_dept', '=', 'departemen.kode_dept')
            ->where('tgl_presensi', $tanggal)
            ->get();

        return view('presensi.getpresensi', compact('presensi'));
    }

    public function cetaklaporanberita(Request $request)
    {

        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September",
            "Oktober","November","Desember",
        ];
        $dari = $request->dari;
        $explode_dari = explode('-', $dari);
        $tgl_dari = $explode_dari[2];
        $bulan_dari = $explode_dari[1];

        if(substr($bulan_dari,0,1)==0){
            $bulan_dari = substr($bulan_dari,1,1);
        } else if(substr($bulan_dari,0,1)==1){
            $bulan_dari = substr($bulan_dari,0,2);
        }
        //dd($bulan_dari);
        $tahun_dari = $explode_dari[0];
        $tes = substr($bulan_dari,1,1);
        /*dodot*/

        //dd($tes);
        //dd($tahun_dari);

        $sampai = $request->sampai;
        $explode_sampai = explode('-', $sampai);
        $tgl_sampai = $explode_sampai[2];
        $bulan_sampai = $explode_sampai[1];

        if(substr($bulan_sampai,0,1)==0){
            $bulan_sampai = substr($bulan_sampai,1,1);
        } else if(substr($bulan_dari,0,1)==1){
            $bulan_sampai = substr($bulan_sampai,0,2);
        }

        //dd($bulan_sampai);
        $tahun_sampai = $explode_sampai[0];

        $kode_satker = $request->kode_satker;
        $getberita = DB::table('berita')
            ->where('kode_satker', $kode_satker)
            ->whereBetween('tgl_input', [$dari, $sampai])
            ->get();


        /*disnet*/
        $total_website = DB::select(DB::raw("SELECT count(website) as jml_website from berita 
where kode_satker='$kode_satker' and website!='' AND tgl_input between '$dari' and '$sampai'"));
        $total_facebook = DB::select(DB::raw("SELECT count(facebook) as jml_facebook from berita 
where kode_satker='$kode_satker' and facebook!='' AND tgl_input between '$dari' and '$sampai'"));
        //dd($total_facebook[0]->jml_facebook);
        $total_instagram = DB::select(DB::raw("SELECT count(instagram) as jml_instagram from berita 
where kode_satker='$kode_satker' and instagram!='' AND tgl_input between '$dari' and '$sampai'"));
        $total_twitter = DB::select(DB::raw("SELECT count(twitter) as jml_twitter from berita 
where kode_satker='$kode_satker' and twitter!='' AND tgl_input between '$dari' and '$sampai'"));
        $total_tiktok = DB::select(DB::raw("SELECT count(tiktok) as jml_tiktok from berita 
where kode_satker='$kode_satker' and tiktok!='' AND tgl_input between '$dari' and '$sampai'"));
        $total_sippn = DB::select(DB::raw("SELECT count(sippn) as jml_sippn from berita 
where kode_satker='$kode_satker' and sippn!='' AND tgl_input between '$dari' and '$sampai'"));
        $total_youtube = DB::select(DB::raw("SELECT count(youtube) as jml_youtube from berita 
where kode_satker='$kode_satker' and youtube!='' AND tgl_input between '$dari' and '$sampai'"));

        //dd($total_website[0]->jml_website);
        //dd($getberita);
        $satker = DB::table('satker')->where('kode_satker', $kode_satker)->first();
        $satker_name = $satker->name;
        //dd($satker->name);
        //dd($getberita);

        if($request->jenis_media=="sosial_media"){
            if(isset($_POST['exportexcelberita'])){
                //dd($request);
                $time = date('d-M-Y H:i:s');

                header("Content-type: application/vnd-ms-excel");
                header("Content-Disposition: attachment; filename=RekapitulasiLinkBerita_$satker_name$time.xls");
                return view('laporan.cetaklaporanberita_excel',compact('getberita',
                    'namabulan', 'tgl_dari', 'bulan_dari', 'tahun_dari', 'tgl_sampai', 'bulan_sampai', 'tahun_sampai',
                    'satker_name','total_website','total_facebook','total_instagram','total_twitter','total_tiktok','total_sippn',
                    'total_youtube'));
            }

            return view('laporan.cetaklaporanberita', compact('getberita',
                'namabulan', 'tgl_dari', 'bulan_dari', 'tahun_dari', 'tgl_sampai', 'bulan_sampai', 'tahun_sampai',
                'satker_name','total_website','total_facebook','total_instagram','total_twitter','total_tiktok','total_sippn',
                'total_youtube'));
        } else if($request->jenis_media=="media_lokal"){
            /*disnit*/
//            $links_media_lokal = json_decode($databerita->media_lokal);
            //return count($links_media_lokal);
            if(isset($_POST['exportexcelberita'])){
                //dd($request);
                $time = date('d-M-Y H:i:s');
                header("Content-type: application/vnd-ms-excel");
                header("Content-Disposition: attachment; filename=RekapitulasiLinkBeritaMediaLokal_$satker_name$time.xls");
                return view('laporan.cetaklaporanberita_excel_medialokal',compact('getberita',
                    'namabulan', 'tgl_dari', 'bulan_dari', 'tahun_dari', 'tgl_sampai', 'bulan_sampai', 'tahun_sampai',
                    'satker_name','total_website','total_facebook','total_instagram','total_twitter','total_tiktok','total_sippn',
                    'total_youtube'));
            }
            return view('laporan.cetaklaporanberita_medialokal', compact('getberita',
                'namabulan', 'tgl_dari', 'bulan_dari', 'tahun_dari', 'tgl_sampai', 'bulan_sampai', 'tahun_sampai',
                'satker_name'));
        } else if($request->jenis_media=="media_nasional"){
            if(isset($_POST['exportexcelberita'])){
                //dd($request);
                $time = date('d-M-Y H:i:s');
                header("Content-type: application/vnd-ms-excel");
                header("Content-Disposition: attachment; filename=RekapitulasiLinkBeritaMediaNasional_$satker_name$time.xls");
                return view('laporan.cetaklaporanberita_excel_medianasional',compact('getberita',
                    'namabulan', 'tgl_dari', 'bulan_dari', 'tahun_dari', 'tgl_sampai', 'bulan_sampai', 'tahun_sampai',
                    'satker_name','total_website','total_facebook','total_instagram','total_twitter','total_tiktok','total_sippn',
                    'total_youtube'));
            }

            return view('laporan.cetaklaporanberita_medianasional', compact('getberita',
                'namabulan', 'tgl_dari', 'bulan_dari', 'tahun_dari', 'tgl_sampai', 'bulan_sampai', 'tahun_sampai',
                'satker_name'));
        }

    }

    public function rekapberita(){
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober",
            "November","Desember"];
        $satker = DB::table('satker')->orderBy('kode_satker')->get();
        return view('laporan.laporanberita_rekap',compact('namabulan','satker'));
    }

    public function cetaklaporanberita_rekap(Request $request)
    {
     //dd($request);
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September",
            "Oktober","November","Desember",
        ];
        $dari = $request->dari;
        $explode_dari = explode('-', $dari);
        $tgl_dari = $explode_dari[2];
        $bulan_dari = $explode_dari[1];
        if(substr($bulan_dari,0,1)==0){
            $bulan_dari = substr($bulan_dari,1,1);
        } else if(substr($bulan_dari,0,1)==1){
            $bulan_dari = substr($bulan_dari,0,2);
        }

        $tahun_dari = $explode_dari[0];
        /*didit*/
        $sampai = $request->sampai;
        $explode_sampai = explode('-', $sampai);
        $tgl_sampai = $explode_sampai[2];
        $bulan_sampai = $explode_sampai[1];

        if(substr($bulan_sampai,0,1)==0){
            $bulan_sampai = substr($bulan_sampai,1,1);
        } else if(substr($bulan_dari,0,1)==1){
            $bulan_sampai = substr($bulan_sampai,0,2);
        }
        $tahun_sampai = $explode_sampai[0];

        $getberita = DB::table('berita')
            ->whereBetween('tgl_input', [$dari, $sampai])
            ->get();
        $satkers = DB::table('satker')->get();
        //dd($satker);
        if($request->jenis_media=="sosial_media"){
            $query = DB::table('berita')->where('kode_satker', 'SAT-NTB-04')->get();
            //dd($query);
            if(isset($_POST['exportexcelberita_rekap'])){
                $time = date('d-M-Y H:i:s');
                //dd($time);
                header("Content-type: application/vnd-ms-excel");
                header("Content-Disposition: attachment; filename=RekapitulasiLinkBeritaAll_$time.xls");
                return view('laporan.cetaklaporanberita_rekapexcel',compact('getberita','namabulan','tgl_dari','bulan_dari',
                    'tahun_dari','tgl_sampai','bulan_sampai','tahun_sampai','satkers','dari','sampai'));
            }
            return view('laporan.cetaklaporanberita_rekap',compact('getberita','namabulan','tgl_dari','bulan_dari',
                'tahun_dari','tgl_sampai','bulan_sampai','tahun_sampai','satkers','dari','sampai'));
        } else if($request->jenis_media=="media_lokal"){

            if(isset($_POST['exportexcelberita_rekap'])){
                $time = date('d-M-Y H:i:s');
                //dd($time);
                header("Content-type: application/vnd-ms-excel");
                header("Content-Disposition: attachment; filename=RekapitulasiLinkBeritaAll_$time.xls");
                return view('laporan.cetaklaporanberita_rekap_medialokalexcel',compact('getberita','namabulan','tgl_dari','bulan_dari',
                    'tahun_dari','tgl_sampai','bulan_sampai','tahun_sampai','satkers','dari','sampai'));
            }
            return view('laporan.cetaklaporanberita_rekap_medialokal',compact('getberita','namabulan','tgl_dari','bulan_dari',
                'tahun_dari','tgl_sampai','bulan_sampai','tahun_sampai','satkers','dari','sampai'));
        } else if($request->jenis_media=="media_nasional"){

            if(isset($_POST['exportexcelberita_rekap'])){
                $time = date('d-M-Y H:i:s');
                //dd($time);
                header("Content-type: application/vnd-ms-excel");
                header("Content-Disposition: attachment; filename=RekapitulasiLinkBeritaAll_$time.xls");
                return view('laporan.cetaklaporanberita_rekap_medianasionalexcel',compact('getberita','namabulan','tgl_dari','bulan_dari',
                    'tahun_dari','tgl_sampai','bulan_sampai','tahun_sampai','satkers','dari','sampai'));
            }
            return view('laporan.cetaklaporanberita_rekap_medianasional',compact('getberita','namabulan','tgl_dari','bulan_dari',
                'tahun_dari','tgl_sampai','bulan_sampai','tahun_sampai','satkers','dari','sampai'));
        }
    }
}
