<h1> PA WEB B1'20 KELOMPOK 7 </h1>
<h1> Indro Dwi Saputro 2009106099 </h1>

<h1>Website Tagihan PLN </h1>

<h3>Asisten Lab<h3>
<b>Kandika Prima Putra(1915016015)    & Delfan Rynaldo Laden(1915016069)</b>

-
<h3>Kebutuhan Fungsional Sistem<h3>

<ul>
<li>Pelanggan dapat melihat Tagihan dan Penggunaan</li>
<li>Petugas Dapat Melakukan Login</li>
<li>Petugas dibagi menggunakan level(Multiuser)</li>
<li>Petugas bisa CRUD Tarif</li>
<li>Petugas dapat melihat data petugas lainnya</li>
<li>Petugas dengan level tertentu bisa menambahkan atau menonaktifkan petugas lainnya</li>
<li>Petugas dapat CRUD data pelanggan dan dapat melihat data pelanggan yang No Meter nya Mati</li>
<li>Petugas dengan level tertentu dapat melihat data penggunaan pelanggan dan menambahkan meter akhir pelanggan</li>
<li>Petugas dengan level tertentu dapat mengelola data pembayaran pelanggan dan melihat history pembayaran</li>
<li>Petugas dengan level tertentu dapat melihat data tagihan dari pelanggan</li>
<li>Petugas bisa logout</li></ul>

<h3>Kebutuhan Non Fungsional</h3>

<ul>
<li>Sistem berbasis Web</li>
<li>Dapat dijalankan pada OS minimal ram 1 GB</li>
<li>Minimum perangkat menggunakan windows 7</li>
<li>Google Chrome sebagai browser</li>
<li>Pelatihan Petugas agar memahami fitur yang ada melalui manual book</li>
</ul>

<h3>Perancangan</h3>
<h5>ERD</h5>
<img src="database/ERD.jpeg" alt="Alt text" title="Optional title">

<h3>Tentang Website</h3>
<p>Website tagihan PLN ini merupakan sebuah website untuk mengelola dan melakukan transaksi pembayaran tagihan PLN.
Website ini mampu melihat data tagihan dan penggunaan bagi pelanggan dan mengelola data tarif, petugas, pelanggan,
penggunaan, pembayaran dan tagihan.</p>

<h3>Cara Penggunaan Website</h3>
<p>Berikut cara penggunaan aplikasi website tagihan PLN, mulai dari pemakaian untuk pelanggan dan petugas.</p>

<h4>Fitur-fitur yang ada untuk pelanggan</h4>
<ul>
<li>Tampilan Untuk Pelanggan</li>
<p> Pelanggan dapat melihat data tagihan dan penggunaan dengan menginputkan no meter, lalu ada info tentang PLN, Kotak Saran
dan Kontak Kami</p>
<img src="SS/pelanggan/cek meter.jpeg" alt="Alt text" title="Optional title">
<li>Cek Tagihan Dan Penggunaan</li>
<p>Pelanggan menginputkan no meter, lalu tekan cari dan website akan menampilkan data tagihan dan penggunaan pelanggan sesuai dengan
no meter yang di input
<img src="SS/pelanggan/input meter.jpeg" alt="Alt text" title="Optional title">
<img src="SS/pelanggan/hasil cm.jpeg" alt="Alt text" title="Optional title">
<li>Info</li>
<p>Pelanggan dapat melihat informasi tentang PLN
<img src="SS/pelanggan/info.jpeg" alt="Alt text" title="Optional title">
<li>Saran</li>
<p>Pelanggan dapat memberikan saran terhadap petugas Website
<img src="SS/pelanggan/saran.jpeg" alt="Alt text" title="Optional title">
<li>Kontak</li>
<p>Pelanggan dapat melihat Kontak dari Admin Website
<img src="SS/pelanggan/kontak.jpeg" alt="Alt text" title="Optional title">
</ul>

<h4>Fitur-fitur Petugas</h4>
<ul>
<li>Login</li>
<p> Sebelum dapat megakses fitur-fitur untuk mengelola data, petugas diharuskan untuk login terlebih dahulu,
fitur yang dapat diakses oleh petugas dibatasi dengan level dari setiap petugas
<img src="SS/petugas/login.jpeg" alt="Alt text" title="Optional title">
<li>Halaman Petugas</li>
<p>Disini menampilkan fitur-fitur apa saja yang dapat diakses oleh petugas yang di batasi oleh level dari petugas
<img src="SS/petugas/tampilan petugas.jpeg" alt="Alt text" title="Optional title">
<li>Menu Tarif</li>
<p>Disini Menampilkan data tarif dan terdapat fitur untuk menambah, mengubah dan menghapus data tarif
<img src="SS/petugas/tarif.jpeg" alt="Alt text" title="Optional title">
<li>Tambah Tarif</li>
<p>Ini adalah form untuk menambahkan tarif baru dengan memasukkan daya dan tarif baru
<img src="SS/petugas/Ttarif.jpeg" alt="Alt text" title="Optional title">
<li>Update Tarif</li>
<p>Ini adalah form untuk megubah data tarif yang telah di input, dengan memasukkan daya atau tarif terbaru yang ingin kita ubah maka tarif akan terubah
<img src="SS/petugas/Utarif.jpeg" alt="Alt text" title="Optional title">
<li>Hapus Tarif</li>
<p>Ini adalah tampilan ketika kita ingin menghapus data tarif, konfirmasi dahulu apakah benar kita ingin menghapus data tarif
<img src="SS/petugas/Dtarif.jpeg" alt="Alt text" title="Optional title">
<li>Menu Petugas</li>
<p>Disini Menampilkan data petugas dan terdapat fitur untuk menambah, mengubah dan menon/aktifkan data petugas
<img src="SS/petugas/petugas.jpeg" alt="Alt text" title="Optional title">
<li>Tambah Petugas</li>
<p>Ini adalah form untuk menambahkan petugas baru dengan memasukkan Username, Password, Nama File(gambar), File gambar(foto petugas), Tugas
<img src="SS/petugas/Tpetugas.jpeg" alt="Alt text" title="Optional title">
<li>Update Petugas</li>
<p>Ini adalah form untuk menambahkan petugas baru dengan memasukkan Username, Password, Nama File(gambar), File gambar(foto petugas), Tugas baru yang ingin di update
<img src="SS/petugas/Upetugas.jpeg" alt="Alt text" title="Optional title">
<li>Non/Aktifkan Petugas</li>
<p>Ini adalah tampilan ketika kita ingin menon/aktifkan data petugas, konfirmasi dahulu apakah benar kita ingin menon/aktifkan data petugas
<img src="SS/petugas/Npetugas.jpeg" alt="Alt text" title="Optional title">
<li>Menu Pelanggan</li>
<p>Disini Menampilkan data pelanggan dan terdapat fitur untuk menambah, mengubah, menghapus dan melihat nomor meter yang mati
<img src="SS/petugas/pelanggan.jpeg" alt="Alt text" title="Optional title">
<li>Tambah pelanggan</li>
<p>Ini adalah form untuk menambahkan pelanggan baru dengan memasukkan nama, alamat, nomor telpon dan tarif
<img src="SS/petugas/Tpelanggan.jpeg" alt="Alt text" title="Optional title">
<li>Update pelanggan</li>
<p>Ini adalah form untuk menambahkan pelanggan baru dengan memasukkan nama, alamat, nomor telpon dan tarif baru yang ingin di update
<img src="SS/petugas/Upelanggan.jpeg" alt="Alt text" title="Optional title">
<li>Hapus pelanggan</li>
<p>Ini adalah tampilan ketika kita ingin Menghapus data pelanggan, konfirmasi dahulu apakah benar kita ingin menon/aktifkan data pelanggan
<img src="SS/petugas/Dpelanggan.jpeg" alt="Alt text" title="Optional title">
<li>Menu Penggunaan</li>
<p>Disini Menampilkan data penggunaan dengan memasukkan nomor meter yang ingin di cari, dan disini terdapat fitur untuk menambahkan meter akhir untuk memasukkan data penggunaan
<img src="SS/petugas/penggunaan.jpeg" alt="Alt text" title="Optional title">
<li>Tambah Meter Akhir</li>
<p>Ini adalah form untuk menambahkan penggunaan baru dengan memasukkan meter akhir
<img src="SS/petugas/Tpenggunaan.jpeg" alt="Alt text" title="Optional title">
<li>Update Meter Akhir</li>
<p>Ini adalah form untuk menambahkan penggunaan baru dengan memasukkan meter akhir yang baru
<img src="SS/petugas/Upenggunaan.jpeg" alt="Alt text" title="Optional title">
<li>Menu Pembayaran</li>
<p>Disini Menampilkan data pembayaran yang belum dibayar dengan memasukkan no meter yang ingin di cari serta dapat melakukan pembayaran dan print struk pembayaran
<img src="SS/petugas/pembayaran.jpeg" alt="Alt text" title="Optional title">
<li>Detail Pembayaran</li>
<p>Ini adalah form untuk melakukan pembayaran, hanya admin dengan level tertentu dapat melakukan aksi ini, setelah menekan button bayar petugas akan di arahkan ke table history pembayaran dan dapat melakukan print
<img src="SS/petugas/Dbayar.jpeg" alt="Alt text" title="Optional title">
<li>History Pembayaran</li>
<p>Ini adalah table yang menampilkan history pembayaran yang telah dilakukan</p>
<img src="SS/petugas/Hbayar.jpeg" alt="Alt text" title="Optional title">
<li>Print</li>
<p>Button prin dilakukan untuk aksi print struk pembayaran</p>
<img src="SS/petugas/print.jpeg" alt="Alt text" title="Optional title">
<li>Menu Tagihan</li>
<p>Ini adalah menu yang menampilkan data tagihan dari semua nomor meter yang berisikan no meter, nama, bulan, tahun, penggunaan dan status pembayaran</p>
<img src="SS/petugas/tagihan.jpeg" alt="Alt text" title="Optional title">
<li><h4>Menu logout</h4></li>
<p>Jika menekan menu logout maka petugas akan langsung diarahkan kembali ke menu login
</ul>