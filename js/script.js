$(document).ready(function () {

    //hilangkan tombol cari
    $('#tombol-cari').hide();



    //event ketika keyword ditulis 
    $('#keyword').on('keyup', function () {

        //munculkan icon loading
        $('.loader').show();

        //ajak menggunkan load
        // $('#container').load('koding/mahasiswa.php?keyword=' + $('#keyword').val());

        $.get('koding/mahasiswa.php?keyword=' + $('#keyword').val(), function (data) {

            $('#container').html(data);

            //hilangkan icon loading
            $('.loader').hide();
        });
    });

});