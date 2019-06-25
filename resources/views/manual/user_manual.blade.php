<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('img/logo.ico') }}" type="image/x-icon">
        <title>Panduan Penggunaan Aplikasi File Manager RSIA - Puri Bunda</title>

        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
        {{-- <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet"> --}}
        <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800,900" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('manual/css/scribbler-global.css') }}">
        <link rel="stylesheet" href="{{ asset('manual/css/scribbler-doc.css') }}">
        <style>
            #to-top-button {
                display: none;
                position: fixed;
                bottom: 20px;
                right: 30px;
                z-index: 99;
                font-size: 18px;
                border: none;
                outline: none;
                background-color: rgb(53, 163, 236);
                color: white;
                cursor: pointer;
                padding: 15px;
                border-radius: 4px;
            }

            #to-top-button:hover {
                background-color: #555;
            }
            .red-text-color {
                color: red;
            }
            @media print {
                body * {
                    visibility: hidden;
                }
                #printableArea, #printableArea * {
                    visibility: visible;
                }
                #printableArea {
                    position: absolute;
                    left: 0;
                    top: 0;
                }
            }
        </style>
    </head>
    <body>
        <div class="doc__bg"></div>
        <nav class="header">
            <h1 class="logo">File Manager<span class="logo__thin"> Panduan</span></h1>
            <ul class="menu">
                <div class="menu__item toggle"><span></span></div>
                <li class="menu__item"><a href="{{ route('custom.login') }}" class="link link--dark"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                <li class="menu__item"><a href="javascript:" onclick="printPanduan()" class="link link--dark"><i class="fas fa-print"></i> Print Panduan</a></li>
            </ul>
        </nav>
        <div class="wrapper">
            <aside class="doc__nav">
                <ul>
                    <li class="js-btn selected">Persyaratan</li>
                    <li class="js-btn">Login</li>
                    <li class="js-btn">Pencarian</li>
                    <li class="js-btn">Folder Baru</li>
                    <li class="js-btn">Upload File</li>
                    <li class="js-btn">Status Folder & File</li>
                    <li class="js-btn">Tombol Option</li>
                    <li class="js-btn">Membuka File</li>
                    <li class="js-btn">Ganti Password</li>
                    <li class="js-btn">Lupa Password</li>
                </ul>
            </aside>
            <article class="doc__content" id="printableArea">
                {{-- Persyaratan --}}
                <section class="js-section">
                    <h3 class="section__title">Persyaratan Penggunaan Aplikasi</h3>
                    <p>Aplikasi File Manager menggunakan beberapa <b>tools tambahan</b> agar dapat berjalan secara maksimal.</p>
                    <h4 class="section__title">Syarat dibutuhkan :</h4>
                    <ul>
                        <li><p>Web Browser: Google Chrome</p></li>
                        <li><p>Plug-in: Office Editing for Docs, Sheets & Slides (Plug-in ini digunakan untuk akses file berbentuk dokumen pdf, word, excel, dan power point dan <b>hanya dapat berjalan pada Google Chrome</b>)</p></li>
                    </ul>
                    <h4 class="section__title">Cara menambahkan Plug-in: Office Editing for Docs, Sheets & Slides pada Google Chrome :</h4>
                    <ul>
                        <li><p>Buka Web Browser Google Chrome</p></li>
                        <li><p>Copy-paste link di bawah ini pada Google Chrome. Atau klik <a href="https://chrome.google.com/webstore/detail/office-editing-for-docs-s/gbkeegbaiigmenfmjfclcdgdpimamgkj" target="_blank"><b>disini</b></a></p></li>
                    </ul>
                    <div class="code__block code__block--notabs">
                        <pre class="code code--block">
                        <code>
                            https://chrome.google.com/webstore/detail/office-editing-for-docs-s/gbkeegbaiigmenfmjfclcdgdpimamgkj
                        </code>
                        </pre>
                    </div>

                    <ul>
                        <li><p>Klik tombol <b>Add to Chrome</b></p></li>
                    </ul>
                    <div class="image-center">
                        <img src="{{ asset('img/panduan/adding_doc_plugin.png') }}" class="atur-lebar" alt="">
                    </div>
                    <ul>
                        <li><p>Klik tombol <b>Add Extension</b> apabila muncul pesan konfirmasi</p></li>
                    </ul>
                    <div class="image-center">
                        <img src="{{ asset('img/panduan/konfirm_add_plugin.png') }}" class="atur-lebar" alt="" style="text-align: center">
                    </div>
                    <hr />
                </section>
                {{-- End Persyaratan --}}

                {{-- Login --}}
                <section class="js-section">
                    <h3 class="section__title">Login</h3>
                    <p>Halaman login merupakan halaman yang pertama kali muncul ketika aplikasi diakses. Ketik <b>NIK tanpa tanda titik (.)</b>  dan password pada kolom yang sudah disediakan. Apabila belum memiliki akun silahkan menghubungi Team IT RSIA Puri Bunda.</p>
                    <h4 class="section__title">Halaman Login</h4>
                    <div class="image-center">
                        <img src="{{ asset('img/panduan/halaman_login.png') }}" class="atur-lebar" alt="">
                    </div>
                    <hr />
                </section>
                {{-- End Login --}}

                {{-- Pencarian --}}
                <section class="js-section">
                    <h3 class="section__title">Pencarian</h3>
                    <p>Halaman pencarian muncul setelah anda berhasil login. Anda dapat melakukan pencarian terhadap file atau folder pada aplikasi ini. Hasil pencarian yang <b>muncul</b> adalah <b>file atau folder yang memiliki status "Shared".</b> Jika file atau folder yang dicari berada pada folder yang memiliki status <b>"Private"</b> maka hasil pencarian <b>tidak akan ditampilkan.</b></p>
                    <h4 class="section__title">Form & Hasil Pencarian</h4>
                    <div class="image-center">
                        <img src="{{ asset('img/panduan/search_form.png') }}" class="atur-lebar" alt="">
                    </div>
                    <h4 class="section__title">Panduan pencarian file atau folder :</h4>
                    <ul>
                        <li><p>Ketik nama file atau folder yang ingin dicari pada kolom pencarian</p></li>
                        <li><p>Tekan tombol <b>Enter</b> pada keyboard atau tombol <b>Cari</b> pada layar untuk memulai pencarian</p></li>
                    </ul>
                    <div class="image-center">
                        <img src="{{ asset('img/panduan/search_result.png') }}" class="atur-lebar" alt="">
                    </div>
                    <p>Apabila proses pencarian berhasil maka akan muncul tampilan seperti pada gambar di atas. Pada tampilan yang ditandai kotak merah dapat dilihat <b>jumlah hasil pencarian</b>. Anda dapat berpindah antara hasil pencarian file atau folder untuk melihat detail pencarian yang ditemukan.</p>
                    <h4 class="section__title">Keterangan Tombol Action :</h4>
                    <table>
                        <tr>
                            <th>Icon</th>
                            <th>Fungsi</th>
                        </tr>
                        <tr>
                            <td><i class="fas fa-download"></td>
                            <td>mendownload file (hanya berlaku untuk file).</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-location-arrow"></i></td>
                            <td>menuju lokasi file atau folder disimpan.</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-eye"></i></td>
                            <td>melihat detail file (hanya berlaku untuk file).</td>
                        </tr>
                    </table>
                    <hr />
                </section>
                {{-- End Pencarian --}}

                {{-- Folder Baru --}}
                <section class="js-section">
                    <h3 class="section__title">Menambahkan Folder Baru</h3>
                    <p>Anda dapat menambahkan folder baru ketika anda mengakses <b>Folder Unit</b> yang sesuai dengan Unit anda. Anda dapat mengakses folder milik unit anda melalui menu <b>Unit File</b> pada menu <b>sebelah kiri</b> layar anda.</p>
                    <div class="image-center">
                        <img src="{{ asset('img/panduan/unit_files_menu.png') }}" class="atur-lebar" alt="">
                    </div>
                    
                    <h4 class="section__title">Panduan Menambahkan Folder Baru :</h4>
                    <ul>
                        <li><p>Tekan tombol dengan Icon <i class="fas fa-folder-plus"></i> untuk membuka form tambah folder</p></li>
                        <li><p>Ketik nama folder baru yang akan dibuat pada kolom yang disediakan</p></li>
                        <li><p>Pilih status folder <b>"Shared"</b> agar dapat <b>dilihat oleh unit lain</b> atau <b>"Private"</b> agar folder hanya dapat <b>dilihat oleh unit anda sendiri</b></p></li>
                    </ul>
                    <div class="image-center">
                        <img src="{{ asset('img/panduan/folder_baru.png') }}" class="atur-lebar" alt="">
                    </div>
                    <hr />
                </section>
                {{-- End Folder Baru --}}

                {{-- Upload File --}}
                <section class="js-section">
                    <h3 class="section__title">Menambahkan File Baru</h3>
                    <p>Anda dapat menambahkan file baru ketika anda mengakses <b>Folder Unit</b> yang sesuai dengan unit anda. Dalam satu kali upload, jumlah file yang dapat diupload maksimal adalah sebanyak <b>10 buah</b>.</p>
                    <div class="image-center">
                        <img src="{{ asset('img/panduan/unit_files_menu_upload.png') }}" class="atur-lebar" alt="">
                    </div>
                    
                    <h4 class="section__title">Panduan Menambahkan File Baru :</h4>
                    <ul>
                        <li><p>Masuk terlebih dahulu ke dalam folder yang akan digunakan untuk menyimpan file</p></li>
                        <li><p>Tekan tombol dengan Icon <i class="fas fa-upload"></i> untuk membuka form upload file</p></li>
                    </ul>
                    <div class="image-center">
                        <img src="{{ asset('img/panduan/upload_step_1.png') }}" class="atur-lebar" alt="">
                    </div>
                    <ul>
                        <li><p>Pada form upload file ini, tekan tombol Browse untuk membuka File Explorer pada Komputer / Laptop anda.</p></li>
                    </ul>
                    <div class="image-center">
                        <img src="{{ asset('img/panduan/open_form_upload_file.png') }}" class="atur-lebar" alt="">
                    </div>
                    <ul>
                        <li><p>Pilih file yang akan diupload, kemudian tekan tombol Open di bagian pojok kanan bawah tampilan.</p></li>
                    </ul>
                    <div class="image-center">
                        <img src="{{ asset('img/panduan/select_files_to_upload.png') }}" class="atur-lebar" alt="">
                    </div>
                    <ul>
                        <li><p>Lengkapi status dan keterangan file pada kolom yang sudah disediakan. Pada kolom status wajib diisi "Shared" atau "Private" untuk masing-masing file. Pada kolom keterangan dapat dikosongkan atau diisi sesuai kebutuhan</p></li>
                    </ul>
                    <div class="image-center">
                        <img src="{{ asset('img/panduan/file_status_and_statement.png') }}" class="atur-lebar" alt="">
                    </div>
                    <hr />
                </section>
                {{-- End Upload File --}}

                {{-- Status File dan Folder --}}
                <section class="js-section">
                    <h3 class="section__title">Tentang Status "Shared" dan "Private"</h3>
                    <p>Pada saat membuat folder atau meng-upload file, anda selalu diminta untuk menambahkan status <b>"Shared"</b> atau <b>"Private"</b>. Status tersebut wajib diisi agar sistem mampu memberikan akses yang tepat sesuai dengan User yang sedang menggunakan sistem.</p>
                    <h4 class="section__title">Keterangan Status Folder dan File :</h4>
                    <table id="customers">
                        <tr>
                            <th>Status</th>
                            <th>Dampak</th>
                        </tr>
                        <tr>
                            <td>Shared</td>
                            <td>
                                <ul>
                                    <li>
                                        Folder & File :
                                    </li>
                                </ul>
                                <p>
                                    Folder dan File dapat diakses oleh semua Unit.
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>Private</td>
                            <td>
                                <ul>
                                    <li>
                                        Folder :
                                    </li>
                                </ul>
                                <p>
                                    Folder tidak dapat diakses oleh Unit lain. Seluruh folder dan file yang terdapat di dalamnya <b>Tidak akan muncul</b> baik pada <b>Tampilan list</b> maupun <b>Hasil Pencarian</b>.
                                </p>
                                <ul>
                                    <li>
                                        File :
                                    </li>
                                </ul>
                                <p>
                                    File tidak dapat diakses oleh Unit lain.
                                </p>
                            </td>
                        </tr>
                    </table>
                    <h4 class="section__title">Panduan Mengganti Status Folder dan File :</h4>
                    <ul>
                        <li>
                            <p>
                                Klik tombol pada kolom status pada setiap folder atau file yang ingin diganti statusnya untuk menampilkan pesan konfirmasi perubahan status. Tombol pada kolom status tersebut juga menjadi <b>penanda</b> status yang dimiliki oleh folder atau file tersebut.
                            </p>
                        </li>
                    </ul>
                    <div class="image-center">
                        <img src="{{ asset('img/panduan/status_change_step_1.png') }}" class="atur-lebar" alt="">
                    </div>
                    <ul>
                        <li>
                            <p>
                                Pada tampilan kofirmasi ini klik tombol <b>Ya</b> jika ingin mengganti status, atau <b>Tidak</b> untuk membatalkan perubahan status.
                            </p>
                        </li>
                    </ul>
                    <div class="image-center">
                        <img src="{{ asset('img/panduan/status_confirm_change.png') }}" class="atur-lebar" alt="">
                    </div>
                    <hr />
                </section>
                {{-- End Status File dan Folder --}}

                {{-- Tombol Option --}}
                <section class="js-section">
                    <h3 class="section__title">Tombol Options Pada Kolom Action</h3>
                    <p>Tombol <b>Options</b> menampilkan beberapa fitur yang tersedia untuk mengelola Folder dan File. Fitur yang terdapat pada tombol ini akan disesuaikan dengan <b>hak akses</b> yang diberikan oleh Administrator.</p>
                    <div class="image-center">
                        <img src="{{ asset('img/panduan/options_button.png') }}" class="atur-lebar" alt="">
                    </div>
                    <h4 class="section__title">Fitur Pada Tombol Options</h4>
                    <table>
                        <tr>
                            <th>Icon</th>
                            <th>Fungsi</th>
                        </tr>
                        <tr>
                            <td><i class="fas fa-download"></td>
                            <td>mendownload file (hanya berlaku untuk file).</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-eye"></i></td>
                            <td>melihat detail file (hanya berlaku untuk file).</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-pencil-alt"></i></td>
                            <td>mengubah nama folder atau file.</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-trash"></i></td>
                            <td>menghapus folder atau file.</td>
                        </tr>
                    </table>
                    <hr />
                </section>
                {{-- End Tombol Option --}}

                {{-- Membuka File --}}
                <section class="js-section">
                    <h3 class="section__title">Membuka File</h3>
                    <p>Anda dapat melihat konten atau detail yang terdapat dalam file dengan memilih menu <i class="fas fa-eye"></i> View pada Tombol Option.</p>
                    <img src="{{ asset('img/panduan/lihat_file_step_1.png') }}" class="atur-lebar" alt="">
                    {{-- <h4 class="section__title">Tipe File Yang Dapat Diupload dan Diakses</h4>
                    <table>
                        <tr>
                            <th>Tipe</th>
                            <th>Extensi</th>
                        </tr>
                        <tr>
                            <td>Dokumen</td>
                            <td>
                              <ul>
                                <li>.doc</li>
                                <li>.docx</li>
                                <li>.xls</li>
                                <li>.xlsx</li>
                                <li>.ppt</li>
                                <li>.pptx</li>
                                <li>.pdf</li>
                                <li>.txt</li>
                              </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Media</td>
                            <td>
                              <ul>
                                <li>
                                  Video
                                  <ul>
                                    <li>.mp4</li>
                                    <li>.avi</li>
                                  </ul>
                                </li>
                                <li>
                                  Audio
                                  <ul>
                                    <li>.mp3</li>
                                  </ul>
                                </li>
                                <li>
                                  Gambar
                                  <ul>
                                    <li>.bmp</li>
                                    <li>.jpg</li>
                                    <li>.jpeg</li>
                                    <li>.png</li>
                                    <li>.tiff</li>
                                  </ul>
                                </li>
                              </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Lain - lain</td>
                            <td>
                              <ul>
                                <li>.exe</li>
                                <li>.rar</li>
                                <li>.zip</li>
                              </ul>
                            </td>
                        </tr>
                    </table> --}}
                    <p>Berikut ini adalah contoh tampilan ketika anda membuka file dokumen.</p>
                    <img src="{{ asset('img/panduan/lihat_file_sample.png') }}" class="atur-lebar" alt="">
                    <h4 class="section__title">Ketentuan Dokumen Editor</h4>
                      <ul>
                        <li><p class="red-text-color">Tidak disarankan untuk mengubah/edit dokumen pada halaman ini</p></li>
                        <li><p class="red-text-color">Apabila dokumen di save, maka akan tersimpan atau terdownload ke Komputer / Laptop anda</p></li>
                        <li><p class="red-text-color">Pada beberapa kasus terdapat kemungkinan file yang ingin dibuka akan ter-download secara otomatis. Hal ini kemungkinan disebabkan oleh <b>Aplikasi Download Manager</b> yang ter-install di komputer/laptop anda (ex: IDM, XDM, dll).</p></li>
                        <li><p class="red-text-color">Anda dapat me-nonaktifkan <b>Aplikasi Download Manager</b> yang anda gunakan untuk melihat file atau tetap men-download file yang ingin dibuka.</li>
                      </ul>
                    <hr />
                </section>
                {{-- End Membuka File --}}

                {{-- Ganti Password --}}
                <section class="js-section">
                    <h3 class="section__title">Mengganti Password dan E-mail Anda</h3>
                    <p>Anda dapat mengganti <b>Password</b> dan <b>E-mail</b> secara berkala untuk keamanan akun anda. Mengganti Password dan E-mail dapat dilakukan pada satu menu secara bersamaan.</p>
                    <h4 class="section__title">Panduan Mengganti Password dan E-mail</h4>
                    <ul>
                        <li>
                            <p>Klik Menu User (menampilkan nama anda) di <b>pojok kanan atas</b> tampilan sistem dan pilih Settings</p>
                        </li>
                    </ul>
                    <div class="image-center">
                        <img src="{{ asset('img/panduan/change_password_step_1.png') }}" class="atur-lebar" alt="">
                    </div>
                    <ul>
                        <li>
                            <p>Ganti Password atau E-mail sesuai dengan keinginan anda pada kolom yang sudah disediakan.</p>
                        </li>
                    </ul>
                    <div class="image-center">
                        <img src="{{ asset('img/panduan/change_password_and_email.png') }}" class="atur-lebar" alt="">
                    </div>
                    <ul>
                        <li>
                            <p>Saat anda sudah yakin dengan perubahan yang dilakukan, tekan tombol <b>Perbarui</b> untuk memperbarui data anda.</p>
                        </li>
                    </ul>
                    <hr />
                </section>
                {{-- End Ganti Password --}}

                {{-- Lupa Password --}}
                <section class="js-section">
                    <h3 class="section__title">Reset Password Untuk Pemulihan Akun</h3>
                    <p>Fitur ini memungkinkan anda untuk me-reset password anda dengan menggunakan <b>E-mail</b> yang digunakan pada saat mendaftarkan akun. E-mail digunakan untuk validasi kebenaran akun maka dari itu anda harus tetap <b>mengingat</b> E-mail yang anda daftarkan. Fitur ini dapat anda akses melalui menu <b>Lupa Password?</b> pada halaman Login.</p>
                    <div class="image-center">
                        <img src="{{ asset('img/panduan/lupa_password_step_1.png') }}" class="atur-lebar" alt="">
                    </div>
                    <h4 class="section__title">Panduan Reset Password</h4>
                    <ul>
                        <li>
                            <p>Ketik <b>NIK tanpa tanda titik (.)</b> dan E-mail pada kolom yang sudah disediakan kemudian klik tombol <b>Submit</b></p>
                        </li>
                    </ul>
                    <div class="image-center">
                        <img src="{{ asset('img/panduan/lupa_password_validasi_dengan_email.png') }}" class="atur-lebar" alt="">
                    </div>
                    <ul>
                        <li>
                            <p>Apabila NIK dan E-mail yang anda input sesuai maka sistem akan menampilkan pesan validasi berhasil. Input <b>password baru</b> untuk me-reset password anda pada kolom yang sudah disediakan kemudian klik tombol Reset Password</p>
                        </li>
                    </ul>
                    <div class="image-center">
                        <img src="{{ asset('img/panduan/lupa_password_input_password_baru.png') }}" class="atur-lebar" alt="">
                    </div>
                    <ul>
                        <li>
                            <p>Anda dapat login kembali menggunakan NIK dan Password yang baru</p>
                        </li>
                    </ul>
                    <hr />
                </section>
                {{-- End Lupa Password --}}

            </article>
            <button onclick="topFunction()" id="to-top-button" title="Go to top">
                <i class="fas fa-chevron-circle-up"></i>
            </button>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
        {{-- <script src="{{ asset('manual/jshighlight.min.js/') }}"></script> --}}
        <script>hljs.initHighlightingOnLoad();</script>
        <script src="{{ asset('manual/js/scribbler.js') }}"></script>
        <script>
            function printPanduan() {
                window.print();
            }
            window.onscroll = function() {scrollFunction()};

            function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    document.getElementById("to-top-button").style.display = "block";
                } else {
                    document.getElementById("to-top-button").style.display = "none";
                }
            }
            function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }
        </script>
    </body>
</html>