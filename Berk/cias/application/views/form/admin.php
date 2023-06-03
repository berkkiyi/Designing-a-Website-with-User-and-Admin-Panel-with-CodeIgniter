<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    <section class="content">
        <!-- Diğer içerikler burada yer alır -->

        <!-- Admin için Form Listesi -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Admin Mesaj Talepleri</h3>
                        <a href="<?php echo base_url(); ?>dashboard" style="text-align: center">
                            <i class="fa fa-dashboard"></i> <span>Ana Sayfa</span>
                        </a>

                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Ad</th>
                                    <th>Soyad</th>
                                    <th>Email</th>
                                    <th>Telefon</th>
                                    <th>Mesaj</th>
                                    <th>Zaman</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($forms as $form) { ?>
                                    <tr>
                                        <td><?php echo $form['ad']; ?></td>
                                        <td><?php echo $form['soyad']; ?></td>
                                        <td><?php echo $form['email']; ?></td>
                                        <td><?php echo $form['telefon']; ?></td>
                                        <td><?php echo $form['mesaj']; ?></td>
                                        <td><?php echo $form['time']; ?></td>

                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<style>
    /* Tablo Stilleri */
    .content-wrapper {
        padding: 20px;
    }

    .box-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .box-title {
        margin-bottom: 0;
    }

    .box-header a {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: #333;
    }

    .box-header a i {
        margin-right: 5px;
    }

    .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        border-collapse: collapse;
        border-spacing: 0;
    }

    .table thead th {
        vertical-align: middle;
        border-top: 1px solid #ddd;
    }

    .table tbody td {
        vertical-align: middle;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    .table tbody tr:hover {
        background-color: #f5f5f5;
    }

    .table thead th,
    .table tbody td {
        padding: 10px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: #fff;
    }

    .table-responsive {
        min-height: .01%;
        overflow-x: auto;
    }

    @media screen and (max-width: 767px) {
        .table-responsive {
            width: 100%;
            margin-bottom: 15px;
            overflow-y: hidden;
            -ms-overflow-style: -ms-autohiding-scrollbar;
            border: 1px solid #ddd;
        }

        .table-responsive>.table {
            margin-bottom: 0;
        }

        .table-responsive>.table>thead>tr>th,
        .table-responsive>.table>tbody>tr>th,
        .table-responsive>.table>tfoot>tr>th,
        .table-responsive>.table>thead>tr>td,
        .table-responsive>.table>tbody>tr>td,
        .table-responsive>.table>tfoot>tr>td {
            white-space: nowrap;
        }
    }
</style>