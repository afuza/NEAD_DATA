<?php
include_once("../theme/header.php");
?>

<div class="container">
    <div class="line-green"></div>
    <div class="col-lg-12">
        <div class="main">
            <h3 class="text-center mt-5">Email Saving</h3>
            <button class="btn btn-green mt-2" data-bs-toggle="modal" data-bs-target="#inputdata"><i
                    data-feather="plus"></i>ADD</button>
            <div class="col-lg-12 mt-4">
                <div class="card text-green">
                    <table id="emaildata" class="table table-bordered" style="width:100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>EMAIL</th>
                                <th>PASSWORD</th>
                                <th>NO HP</th>
                                <th>STATUS</th>
                                <th>SS BROWSER</th>
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
<div class="modal fade mt-1" id="inputdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-lg-7">
            <form id="add-email" autocomplete="off" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Email ADD</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="hidden" name="datasend" value="mailup">
                                    <input name="email" id="emailInput" type="text" class="form-control form-control-sm"
                                        require>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="password" id="passInput" type="text"
                                        class="form-control form-control-sm" require>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="form-group">
                                    <label>Nomor HP</label>
                                    <input name="nope" type="number" id="nopeInput" class="form-control form-control-sm"
                                        require>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3 text-center">
                                <div class="form-group">
                                    <label>Status Email</label>
                                    <div class="from-control">
                                        <input id="checkbox-1" name="status" type="checkbox" checked
                                            data-toggle="toggle" data-onstyle="outline-success"
                                            data-offstyle="outline-danger" data-style="hacker-mail" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="formFileSm" class="form-label">Upload SS Penting</label>
                                <div class="mb-3">
                                    <label class="custom-file-input">
                                        <span>Choose File</span>
                                        <input type="file" id="file-input" name="file">
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="margeni">
                                    <div id="file-label"></div>
                                </div>
                            </div>
                            <img id="image-preview" class="mb-2" src="" alt="Image Preview">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Note For Email</label>
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
<div class="modal fade" id="editmodal" role="dialog" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-lg-7">
            <form id="edit-email" autocomplete="off" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Email EDIT</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="hidden" name="datasend" value="editmail">
                                    <input type="hidden" id="id-edit" name="id-edit">
                                    <input name="email" id="modal_email" type="text"
                                        class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="password" id="modal_password" type="text"
                                        class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="form-group">
                                    <label>Nomor HP</label>
                                    <input name="nope" type="number" id="modal_nohp"
                                        class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3 text-center">
                                <div class="form-group">
                                    <label>Status Email</label>
                                    <div class="from-control">
                                        <input name="status" type="checkbox" id="myCheckbox" data-toggle="toggle"
                                            data-onstyle="outline-success" data-offstyle="outline-danger"
                                            data-style="hacker-mail" checked />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="formFileSm" class="form-label">Upload SS Penting</label>
                                <div class="mb-3">
                                    <label class="custom-file-input">
                                        <span>Choose File</span>
                                        <input type="file" id="file-input-3" name="file">
                                    </label>
                                </div>
                                <input type="hidden" id="img-scr" name="img-scr">
                            </div>
                            <div class="col-lg-6">
                                <div class="margeni">
                                    <div id="file-label-3"></div>
                                </div>
                            </div>
                            <img id="image-preview-3" class="mb-2" src="" alt="Image Preview">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Note For Email</label>
                            <textarea name="note" id="modal_note" class="form-control" rows="3"></textarea>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Email NOTE</h1>
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
<div class="modal fade" id="view_gambar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-lg-7">
            <form autocomplete="off">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Email SS Browser</h1>
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

<script src="../assets/js/tabel-email.js"></script>

<?php
include_once("../theme/footer.php");
?>