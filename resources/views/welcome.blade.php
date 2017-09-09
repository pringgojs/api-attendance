
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>API Documentation Attendance</title>
<!-- <link rel="shortcut icon" href="../style/images/favicon.png" /> -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.easing.js') }}"></script>
<script src="{{ asset('css/prism.css') }}"></script>
<style type="text/css">
body{ margin:0; padding:0; font-size:14px; font-family:Verdana, Geneva, sans-serif; background:url({{ asset('img//bg.jpg') }}); line-height:22px}
a{ color:#06F; text-decoration:none}
a:hover{ color:#F60}
#left_box{position:fixed; border:1px solid gray; padding:20px 0px 0px 0px; height:87.25%; width:20%; bottom:1.5%; left:1%; background:#FFFFFF}
#right_box{position:fixed; border:1px solid gray; height:87.1%; width:75%; padding:10px 10px 10px 10px;  background:#FFFFFF;bottom:1.6%; right:1%; overflow:auto}
label{ border-bottom:3px solid gray; font-weight:bold; display:block; font-size:18px; padding:5px 0px 5px 0px; margin:0px 0px 20px 0px}
.page{border:0px solid gray; padding:0px; margin:0;}
#left_box ul{ border:0px solid gray; margin:0px; padding:0px 0px 0px 35px;list-style:none}
#left_box ul li{ border:0px solid gray; padding:2px 0px 2px 0px; margin:0}
#right_box ol{ border:0px solid gray; margin:0px 0px 20px 0px; padding:0px 0px 0px 30px}
#right_box ol li{ border:0px solid gray; padding:4px 0px}
#print{ cursor:pointer;border:0px solid gray; background:url({{ asset('img/printer.png') }}) no-repeat 50% 20%; position:fixed; margin:0; padding:30px 2px 0px 2px; font-size:10px; top:1%; left:9.8%}
#print:hover{ opacity:0.5}
.plus{ cursor:pointer}
pre {
display: block;
padding: 13.5px;
margin: 0 0 14px;
font-size: 15px;
line-height: 1.75;
word-break: break-all;
word-wrap: break-word;
color: #333333;
background-color: #f5f5f5;
border: 1px solid #cccccc;
border-radius: 4px;
}
code {
    word-wrap: break-word;
}
</style>
</head>
<body>
    <a onclick="window.print()"><p id="print">Print</p></a>
    <div id="left_box">
        <ul>
            <li style="padding-left:16px;"><a href="#tentang">Tentang</a></li>
            <li style="padding-left:16px;"><a href="#installasi">Installasi</a></li>
            <li><span id="pel" class="plus">+</span> <a href="#retrive">Mengambil Data</a></li>
            <ul id="pelpel">
                <li><a href="#pegawai">Pegawai</a></li>
                <li><a href="#profile">Profile</a></li>
                <li><a href="#shift">Shift</a></li>
                <li><a href="#outlet">Outlet</a></li>
                <li><a href="#report">Report</a></li>
            </ul>
    <li><span id="pes" class="plus">+</span> <a href="#create">Tambah Data</a></li>
    <ul id="pespes">
        <li><a href="#tambah-pegawai">Pegawai</a></li>
        <li><a href="#tambah-shift">Shift</a></li>
        <li><a href="#tambah-outlet">Outlet</a></li>
    </ul>
</ul>
</div>
<div id="right_box">

<p id="tentang" class="page">
<label style="text-align:center; padding-bottom:20px; font-size:30px; border-bottom:7px solid gray;">API ATTENDANCE</label>
Aplikasi ini adalah suatu alat yang diciptakan untuk mempermudah dalam perekepan absensi kehadiran karyawan atau pegawai dalam suatu perusahaan. Aplikasi ini dibangun dengan Android dan terintegrasi dengan Cloud Database Firebase. Aplikasi ini juga menyediakan untuk API untuk dipakai pengembang untuk mendapatkan data laporan, karyawan dll.
<br /><br /><br />
<p id="instalasi" class="page">
<span style="display:block; font-size:18px; font-weight:bold" id="installasi">A. Instalasi</span><br />
Ketika anda mendaftar setelah sebelumnya mendownload di Playstore, Anda secara ototis akan mendapat Token yang mana itu sebagai API Key untuk mengakses aplikasi ini.
contoh API KEY <br>
<pre><code>Ek8Nky4rueVySMyvgtJN5tJqUGY2</code></pre>

<br /><br /><br />
<span style="display:block; font-size:18px; font-weight:bold" id="retrive">B. Mengambil Data</span><br />

<p class="page" id="pegawai">
<label>1. Karyawan</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Anda dapat mengambil data karyawan dengan menggunkan API seperti berikut.
<pre>
<code>URL : http://api.attendance.app/Ek8Nky4rueVySMyvgtJN5tJqUGY2/employees</code>
</pre>
Dan output dari itu adalah
<pre>
<code class="language-json">
[{"id":"HJjasJSKJAS9823","name":"rani"},{"id":"OJFAEj1pj5o31po1",name":"andi"}]
</code>
</pre>
Menampilkan pegawai berdasarkan nama
<pre>
<code>
Parameter: 
- name : berisi nama pegawai

URL: http://api.attendance.app/Ek8Nky4rueVySMyvgtJN5tJqUGY2/employee/lol
</code>
</pre>
Dan output
<pre>
<code>
{"-KtYou8HqiCwvvfl5Lmp":{"name":"lol","password":"lollol"}}
</code>
</pre>
</p>

<p class="page" id="profile">
<label>2. Profile</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Anda dapat mengambil data Profile dengan menggunkan API seperti berikut.
<pre>
<code>URL : http://api.attendance.app/Ek8Nky4rueVySMyvgtJN5tJqUGY2/profile</code>
</pre>
Dan output dari itu adalah
<pre>
<code>
{
    "email":"admin@gmail.com",
    "name":"administrator"
}</code>
</pre>
</p>
</p>

<p class="page" id="shift">
<label>3. Shift</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Anda dapat mengambil data shift dengan menggunkan API seperti berikut.
<pre>
<code>URL : http://api.attendance.app/Ek8Nky4rueVySMyvgtJN5tJqUGY2/shift</code>
</pre>
Dan output dari itu adalah
<pre>
<code>
[
    null,
    {
        "name":"Shift 1","shiftEnd":"10:00","shiftStart":"08:00"
    },
    {
        "name":"Shift 2","shiftEnd":"17:00","shiftStart":"12:00"
    },
    {
        "name":"Shift 3","shiftEnd":"20:00","shiftStart":"17:00"
    },
    {
        "name":"Shift 4","shiftEnd":"16:00","shiftStart":"08:00"
    }
]
</code>
</pre>
</p>

<p class="page" id="outlet">
<label>4. Outlet</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Anda dapat mengambil data Profile dengan menggunkan API seperti berikut.
<pre>
<code>URL : http://api.attendance.app/Ek8Nky4rueVySMyvgtJN5tJqUGY2/branch</code>
</pre>
Dan output dari itu adalah
<pre>
<code>
{
    "-KtYn1i-DIdBDJoeJ41y":{
        "address":"ooo","latitude":-7.2858033,"longitude":112.63146,"name":"ooo"
    }
}</code>
</pre>
</p>

<p class="page" id="report">
<label>5. report</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Anda dapat mengambil data Profile dengan menggunkan API seperti berikut.
<pre>
<code>URL : http://api.attendance.app/Ek8Nky4rueVySMyvgtJN5tJqUGY2/report</code>
</pre>
Dan output dari itu adalah
<pre>
<code>
[
    {
        "id":1,"employee_id":"HJjasJSKJAS9823","name":"rani","check_in":"06:56","check_out":"15:09","date":"01-09-2017","denda":20000,"selisih_jam_datang":"8 menit","selisih_jam_pulang":"9 menit","time_in":"06:34","time_out":"15:45","tunjangan_makan":1000,"tunjangan_parkir":1000,"tunjangan_pulsa":1000,"gaji":100000
    },
    {   
        "id":2,"employee_id":"OJFAEj1pj5o31po1","name":"andi","check_in":"06:55","check_out":"15:09","date":"01-09-2017","denda":20000,"selisih_jam_datang":"5 menit","selisih_jam_pulang":"9 menit","time_in":"07:00","time_out":"15:00","tunjangan_makan":1000,"tunjangan_parkir":1000,"tunjangan_pulsa":1000,"gaji":100000
    },
    {
        "id":3,"employee_id":"OJFAEj1pj5o31po1","name":"andi","check_in":"06:55","check_out":"15:10","date":"02-09-2017","denda":0,"selisih_jam_datang":"6 menit","selisih_jam_pulang":"10 menit","time_in":"07:00","time_out":"15:00","tunjangan_makan":1000,"tunjangan_parkir":1000,"tunjangan_pulsa":1000,"gaji":10000
    }
]</code>
</pre>
</p>


<br /><br /><br />
<span style="display:block; font-size:18px; font-weight:bold" id="create">C. Tambah Data</span><br />

<p class="page" id="tambah-pegawai">
<label>1. Pegawai</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Anda dapat menambah data karyawan dengan menggunkan API seperti berikut.
<pre>
<code>
Parameter: 
    - name : berisi nama pegawai
    - password : berisi password pegawai

    URL : http://api.attendance.app/Ek8Nky4rueVySMyvgtJN5tJqUGY2/insert/employee?name[PARAMETER_NAMA]&password=[PARAMETER_PASSWORD]</code>
</pre>
Dan output dari itu adalah
<pre>
<code class="language-json">
[{"id":"-KtYCoG4HKHo4Mj3oasw","name":"pringgojs","password":"aisdasns"}]
</code>
</pre>
</p>
<p class="page" id="tambah-shift">
<label>2. Shift</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Anda dapat menambah data shift dengan menggunkan API seperti berikut.
<pre>
<code>
Parameter: 
    - name : berisi nama pegawai
    - password : berisi password pegawai

    URL : http://api.attendance.app/Ek8Nky4rueVySMyvgtJN5tJqUGY2/insert/schedulle?name[PARAMETER_NAMA]&password=[PARAMETER_PASSWORD]</code>
</pre>
Dan output dari itu adalah
<pre>
<code class="language-json">
[{"id":"-KtYCoG4HKHo4Mj3oasw","name":"pringgojs","password":"aisdasns"}]
</code>
</pre>
</p>
<p class="page" id="tambah-outlet">
<label>3. Outlet</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Anda dapat menambah data outlet dengan menggunkan API seperti berikut.
<pre>
<code>
Parameter: 
    - name : berisi nama pegawai
    - password : berisi password pegawai

    URL : http://api.attendance.app/Ek8Nky4rueVySMyvgtJN5tJqUGY2/insert/outlet?name[PARAMETER_NAMA]&password=[PARAMETER_PASSWORD]</code>
</pre>
Dan output dari itu adalah
<pre>
<code class="language-json">
[{"id":"-KtYCoG4HKHo4Mj3oasw","name":"pringgojs","password":"aisdasns"}]
</code>
</pre>
</p>
</div>
</body>
</html>
<script src="{{ asset('js/prism.js') }}"></script>

<script type="text/javascript">
$("#pelpel").hide(0);$("#pespes").hide(0);$("#abab").hide(0);
$("#pel").click(function(){$("#pelpel").toggle();});
$("#pes").click(function(){$("#pespes").toggle();});
$("#ab").click(function(){$("#abab").toggle();});
</script>
