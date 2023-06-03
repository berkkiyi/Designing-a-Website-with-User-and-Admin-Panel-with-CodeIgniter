<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Ürün Yönetim Sayfası
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Ürünü Güncelle</h3>
                    </div>
                    <form role="form" action="<?php echo base_url() ?>product/editProduct" method="post" id="updateProduct" role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="productName">Ürün Adı</label>
                                <input type="text" class="form-control required" value="<?php echo $product->productName; ?>" id="productName" name="productName" maxlength="256" />
                                <input type="hidden" value="<?php echo $product->productId; ?>" name="productId" id="productId" />
                            </div>
                            <div class="form-group">
                                <label for="description">Açıklama</label>
                                <textarea class="form-control required" id="description" name="description"><?php echo $product->description; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="productPrice">Fiyat</label>
                                <input type="text" class="form-control required" value="<?php echo $product->productPrice; ?>" id="productPrice" name="productPrice" maxlength="10" />
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Güncelle" />
                            <input type="reset" class="btn btn-default" value="Sıfırla" />
                        </div>
                    </form>

                </div>
            </div>

            <div class="col-md-4">
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
    </section>
</div>