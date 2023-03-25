// mencari class button dengan nama 'btn-hapus dan menambahkan fungsi ketika tombol tersebut di klik'
        $('.btn-hapus').click(function() {

            // mengambil data id lowongan
            let id = $(this).attr('id-lowongan');

            // mengisi value atrribut 'action' pada tag form yang awalnya kosong menjadi berisi alamat lowongan yang akan di hapus
            $('#FormulirHapus').attr('action', '/lamaran/' + id);

            // mengambil data 'posisi' agar modal konfirmasi lebih dinamis
            let posisi = $(this).attr('posisi-lowongan');

            // mengisi modal-body yang ada pada file modal
            $("#isi-modal").text('Apakah lowongan ' + posisi + ' ingin di hapus ?');
        })

        // menambahkan attribut type yang bernilai 'submit' pada form di file modal untuk mengirim data ke controller
        $('#FormulirHapus [type="submit"]').click(function() {
            $('#FormulirHapus').submit();

        })