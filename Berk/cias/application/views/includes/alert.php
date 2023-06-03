<?php

$alert = $this->session->userdata("alert");

if ($alert) {
    if ($alert["type"] === "success") { ?>
        <div class="modal fade" id="modalsuccess">
            <div class="modal-dialog modal-dialog-centered text-center " role="document">
                <div class="modal-content tx-size-sm">
                    <div class="modal-body text-center p-4 pb-5">
                        <button aria-label="Close" class="btn-close position-absolute" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                        <i class="icon icon-check fs-70 text-success lh-1 my-5 d-inline-block"></i>
                        <h4 class="text-success tx-semibold"><?php echo $alert["title"]; ?></h4>
                        <p class="mg-b-20 mg-x-20"><?php echo $alert["text"]; ?></p><button aria-label="Close" class="btn btn-success pd-x-25" data-bs-dismiss="modal">Tamam</button>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#modalsuccess').modal('show');
            });
        </script>

    <?php } else if ($alert["type"] === "error") { ?>
        <div class="modal fade" id="modalerror">
            <div class="modal-dialog modal-dialog-centered text-center" role="document">
                <div class="modal-content tx-size-sm">
                    <div class="modal-body text-center p-4 pb-5">
                        <button aria-label="Close" class="btn-close position-absolute" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                        <i class="icon icon-close fs-70 text-danger lh-1 my-5 d-inline-block"></i>
                        <h4 class="text-danger"><?php echo $alert["title"]; ?></h4>
                        <p class="mg-b-20 mg-x-20"><?php echo $alert["text"]; ?></p><button aria-label="Close" class="btn btn-danger pd-x-25" data-bs-dismiss="modal">Tamam</button>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#modalerror').modal('show');
            });
        </script>

    <?php } else if ($alert["type"] === "info") { ?>
        <div class="modal fade" id="modalinfo">
            <div class="modal-dialog modal-dialog-centered text-center" role="document">
                <div class="modal-content tx-size-sm">
                    <div class="modal-body text-center p-4 pb-5">
                        <button aria-label="Close" class="btn-close position-absolute" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                        <i class="icon icon-info fs-70 text-info lh-1 my-5 d-inline-block"></i>
                        <h4 class="text-info"><?php echo $alert["title"]; ?></h4>
                        <p class="mg-b-20 mg-x-20"><?php echo $alert["text"]; ?></p><button aria-label="Close" class="btn btn-info pd-x-25" data-bs-dismiss="modal">Tamam</button>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#modalinfo').modal('show');
            });
        </script>
<?php }


    unset($_SESSION["alert"]); # Session'ı unset etmezsek her sayfa yenilendiğinde bize alert verecektir

} ?>