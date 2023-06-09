<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Ürün Yönetim Sayfası
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <?php if ($is_admin == 1) { ?>
                        <a class="btn btn-primary" href="<?php echo base_url(); ?>product/add"><i class="fa fa-plus"></i> Yeni Ürün Ekle</a>
                    <?php } ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                $this->load->helper('form');
                $error = $this->session->flashdata('error');
                if ($error) {
                ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php } ?>
                <?php
                $success = $this->session->flashdata('success');
                if ($success) {
                ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php } ?>

                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Ürünler</h3>
                        <div class="box-tools">
                            <form action="<?php echo base_url() ?>product/productListing" method="POST" id="searchList">
                                <div class="input-group">
                                    <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Ara" />
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>Ürün Adı</th>
                                <th>Açıklama</th>
                                <th>Fiyat</th>
                                <th>Fotoğraf</th>
                                <th>Oluşturulduğu Tarih</th>
                                <?php if ($is_admin == 1) { ?>
                                    <th class="text-center">İşlemler</th>
                                <?php } ?>
                            </tr>
                            <?php
                            if (!empty($records)) {
                                foreach ($records as $product) {
                            ?>
                                    <tr>
                                        <td><?php echo $product->productName ?></td>
                                        <td><?php echo $product->description ?></td>
                                        <td><?php echo $product->productPrice ?></td>
                                        <td>
                                            <?php if (!empty($product->productPhoto)) { ?>
                                                <img src="<?php echo base_url() . $product->productPhoto; ?>" alt="Ürün Fotoğrafı" width="100">
                                            <?php } ?>
                                        </td>
                                        <td><?php echo date("d-m-Y", strtotime($product->createdDtm)) ?></td>
                                        <?php if ($is_admin == 1) { ?>
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-info" href="<?php echo base_url() . 'product/edit/' . $product->productId; ?>" title="Düzenle"><i class="fa fa-pencil"></i></a>
                                                <a class="btn btn-sm btn-danger" href="<?php echo base_url() . 'product/delete/' . $product->productId; ?>" title="Sil"><i class="fa fa-trash"></i></a>
                                            </td>
                                        <?php } ?>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </table>

                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('ul.pagination li a').click(function(e) {
            e.preventDefault();
            var link = jQuery(this).get(0).href;
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "product/productListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>