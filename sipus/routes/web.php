<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// metode nya get lalu masukkan namespace AuthController 
// attribute name merupakan penamaan dari route yang kita buat
// kita tinggal panggil fungsi route(name) pada layout atau controller
Route::get('login', [AuthController::class,'index'])->name('login');
Route::get('register', [AuthController::class,'register'])->name('register');
Route::post('proses_login', [AuthController::class,'proses_login'])->name('proses_login');
Route::get('logout', [AuthController::class,'logout'])->name('logout');

Route::post('proses_register',[AuthController::class,'proses_register'])->name('proses_register');

// kita atur juga untuk middleware menggunakan group pada routing
// didalamnya terdapat group untuk mengecek kondisi login
// jika user yang login merupakan admin maka akan diarahkan ke AdminController
// jika user yang login merupakan user biasa maka akan diarahkan ke UserController
Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cek_login:admin']], function () {
        Route::resource('admin', AdminController::class);
    });
    Route::group(['middleware' => ['cek_login:user']], function () {
        Route::resource('user', UserController::class);
    });
});

Route::get('/', function () {
    return view('welcome');
});

//Buat rutes ke halaman profil
Route::get('/profil',function () {
    return view("profil");
});

//route dengan parameter
Route::get("/Mahasiswa2/{nama?}",function($nama = "wawan"){
    echo "<h1>Halo Nama Saya $nama</h2>";
});

//Route dengan parameter > 1
Route::get("/profil/{nama?}/{pekerjaan?}",function($nama = "wawan",$pekerjaan ="Mahasiswa"){
    echo "<h1>Hallo Nama Saya $nama, Saya Adalah $pekerjaan</h2>";
});

//Redirect dan named route
Route::get("/hubungi",function(){
    echo "<h1>hubungi Kami<h1>";
})->name("call"); //named route

Route::redirect("/contact","/hubungi");

Route::get("/halo",function(){
    echo "<a href= '".route('call') . "'>".route('call')."<a>";
});

Route::prefix("/dosen")->group(function(){
    Route::get("/jadwal",function(){
        echo "<h1>Jadwal Dosen </h1>";
    });
    Route::get("/materi",function(){
        echo "<h1>Materi Perkuliahan </h1>";
    });
    //dan lain lain
    
Route::get('/dosen', function(){
    return view('dosen');
});

Route::get('/fakultas', function(){
     // return view('fakultas.index', ["ilkom" => "Fakultas Ilmu Komputer dan Rekayasa"]);
     //return view('fakultas.index', ["fakultas" =>["Fakultas Ilmu Komputer dan Rekayasa","Fakultas Ilmu Ekonomi"]]);
    //  return view('fakultas.index')->with("fakultas", ["Fakultas Ilmu Komputer dan Rekayasa","Fakultas Ilmu Ekonomi"]);

        $kampus = "Universitas Multi Data Palembang";
        //$fakultas = [];
        $fakultas = ["Fakultas Ilmu Komputer dan Rekayasa", "Fakultas Ilmu Ekonomi"];
        return view('fakultas.index', compact('fakultas', 'kampus'));
});

Route::get('/mahasiswa/insert',[MahasiswaController::class,'insert']);
Route::get('/mahasiswa/update',[MahasiswaController::class,'update']);
Route::get('/mahasiswa/delete',[MahasiswaController::class,'delete']);
Route::get('/mahasiswa/select',[MahasiswaController::class,'select']);

Route::get('/mahasiswa/insert-qb',[MahasiswaController::class,'insertQb']);
Route::get('/mahasiswa/update-qb',[MahasiswaController::class,'updateQb']);
Route::get('/mahasiswa/delete-qb',[MahasiswaController::class,'deleteQb']);
Route::get('/mahasiswa/select-qb',[MahasiswaController::class,'selectQb']);

Route::get('/mahasiswa/insert-elq',[MahasiswaController::class,'insertQb']);
Route::get('/mahasiswa/update-elq',[MahasiswaController::class,'updateQb']);
Route::get('/mahasiswa/delete-elq',[MahasiswaController::class,'deleteQb']);
Route::get('/mahasiswa/select-elq',[MahasiswaController::class,'selectQb']);

Route::get('/prodi/all-join-facade',[ProdiController::class, 'allJoinFacades']);

Route::get('/prodi/all-join-elq',[ProdiController::class, 'allJoinElq']);
Route::get('/mahasiswa/all-join-elq', [MahasiswaController::class, 'allJoinElq']);

Route::get('/prodi/create',[ProdiController::class, 'create']);

Route::get('prodi/store', [ProdiController::class, 'store']);

Route::get('/prodi', [ProdiController::class,
'index'])->name('prodi.index');

Route::get('/prodi/{id}', [ProdiController::class,'show'
])->name('prodi.show');

Route::get('/prodi', [ProdiController::class,'index'])->name('prodi.index');
Route::get('/prodi/{prodi}', [ProdiController::class, 'show'])->name('prodi.show');


