<?php
include_once("../theme/header.php");
?>

<div class="container">
    <div class="line-green"></div>
    <div class="col-lg-12">
        <div class="main">
            <h3 class="text-center mt-5">Email Saving</h3>
            <button class="btn btn-green mt-2" data-bs-toggle="modal" data-bs-target="#inputdata"><i data-feather="plus"></i>ADD</button>
            <div class="col-lg-12 mt-4">
                <div class="card text-green">
                    <table id="emaildata" class="table table-bordered" style="width:100%;">
                        <thead class="text-uppercase">
                            <tr>
                                <th>#</th>
                                <th>situs</th>
                                <th>email</th>
                                <th>earning</th>
                                <th>SS Penting</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Input Data -->
<div class="modal fade mt-2" id="inputdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-lg-7">
            <form id="add-site" autocomplete="off" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Situs ADD</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <div class="form-group">
                                    <label>Situs</label>
                                    <input type="hidden" name="datasend" value="siteup">
                                    <input name="situs" type="text" id="siteInput" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" id="emailInput" type="text" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="form-group">
                                    <label>Earning (dolar)</label>
                                    <input name="earning" type="text" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="formFileSm" class="form-label">Upload SS Penting</label>
                                    <label class="custom-file-input">
                                        <span id="file-label">Choose File</span>
                                        <input type="file" id="file-input" name="file">
                                    </label>
                                </div>
                            </div>
                            <img id="image-preview" class="mb-2" src="" alt="Image Preview">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Note For Site</label>
                            <textarea name="note" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-green" data-bs-dismiss="modal">Close</button>
                    <input type="submit" id="loading" name="save" class="btn btn-green-full">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit DATA -->
<div class="modal fade mt-2" id="editmodal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-lg-7">
            <form id="edit-site" autocomplete="off" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Situs Edit</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <div class="form-group">
                                    <label>Situs</label>
                                    <input type="hidden" name="datasend" value="editsite">
                                    <input type="hidden" id="id-edit" name="id-edit">
                                    <input name="situs" type="text" id="modal_situs" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" type="text" id="modal_email" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="form-group">
                                    <label>Earning (dolar)</label>
                                    <input name="earning" type="text" id="modal_earning" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="formFileSm" class="form-label">Upload SS Penting</label>
                                <label class="custom-file-input">
                                    <span id="file-label-2">Choose File</span>
                                    <input type="file" id="file-input-2" name="file">
                                </label>
                            </div>
                            <input type="hidden" id="img-scr" name="img-scr">
                            <img id="image-preview-2" class="mb-2" src="" alt="Image Preview">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Note For Site</label>
                            <textarea name="note" class="form-control" id="modal_note" rows="3"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-green" data-bs-dismiss="modal">Close</button>
                    <input type="submit" id="loading-2" name="save" class="btn btn-green-full">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View DATA -->
<div class="modal fade " id="dataModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-lg-7">
            <form autocomplete="off">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Situs NOTE</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="text-center text-light" id="your_modal_date"></div>
                        <div id="your_modal_detail"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-green" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- View Gambar -->
<div class="modal fade mt-5" id="view_gambar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-lg-7">
            <form autocomplete="off">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Situs SS Browser</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div id="img_modal"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-green" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../assets/js/tabel-situs.js"></script>
<script src="../assets/js/curd_site.js"></script>
<?php
include_once("../theme/footer.php");
?>