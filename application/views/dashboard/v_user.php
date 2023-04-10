<div class="content-wrapper">
   <div class="content-header">
      <div class="container">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0"></h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                  <li class="breadcrumb-item active">Users</li>
               </ol>
            </div>
         </div>
      </div>
   </div>

   <section class="content">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="card-header">
                     <h4 class="card-title"><a class="btn btn-success col-15 shadow-sm" data-toggle="modal" data-target="#modal_add">
                           <i class="fa fa-plus"></i>&nbsp; Add User</a>
                     </h4>
                     <div class="card-tools">
                        <button type="button" class="btn btn-xs btn-icon btn-circle" data-card-widget="collapse">
                           <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-xs btn-icon btn-circle" data-card-widget="maximize">
                           <i class="fas fa-expand"></i>
                        </button>
                        <button type="button" class="btn btn-xs btn-icon btn-circle" data-card-widget="remove">
                           <i class="fas fa-times"></i>
                        </button>
                     </div>
                  </div>
                  <div class="card-body">
                     <table id="index1" class="table table-hover table-sm">
                        <thead class="thead-light text-center">
                           <tr>
                              <th width="5%">No</th>
                              <th>Name</th>
                              <th>Username</th>
                              <th width="10%">Image</th>
                              <th>Status</th>
                              <th width="10%"><i class="fas fa-cogs"></i></th>
                           </tr>
                        </thead>
                        <?php foreach ($users as $u) {    ?>
                           <tr>
                              <td class="align-middle text-center"></td>
                              <td class="align-middle "><?= ucwords($u->name) ?></td>
                              <td class="align-middle "><?= $u->username ?></td>
                              <td class="align-middle text-center"><img width="50%" class="img-responsive" src="<?= base_url('assets/img/') . $u->image; ?>"></td>
                              <td class="align-middle text-center">
                                 <?php
                                 if ($u->status == "1") {
                                    echo "<span class='badge badge-success'>Aktif</span>";
                                 } else {
                                    echo "<span class='badge badge-danger'>Non-Aktif</span>";
                                 }
                                 ?>
                              </td>
                              <td class="align-middle text-center">
                                 <a class="btn btn-warning" data-toggle="modal" data-target="#modal_edit<?= $u->id; ?>" title="Edit">
                                    <i class="fa fa-pencil-alt"></i></a>
                                 <a class="btn btn-danger" data-toggle="modal" data-target="#modal_hapus<?= $u->id; ?>" title="Delete">
                                    <i class="fa fa-trash"></i></a>
                              </td>
                           </tr>
                        <?php } ?>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>


<!-- Bootstrap modal add -->
<div class="modal fade" id="modal_add" tabindex="-1" data-backdrop="static">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-light color-palette">
         <div class="modal-header">
            <h4 class="col-12 modal-title text-center">Add user
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </h4>
         </div>
         <form method="post" onsubmit="addbtn.disabled = true; return true;" action="<?= base_url('dashboard/add_user') ?>">
            <div class="card-body">
               <div class="form-group">
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <div class="input-group-text">
                           <span><i class="fas fa-user-tie"></i>&nbsp;&nbsp;</span>
                        </div>
                     </div>
                     <input type="text" name="nama" class="form-control" placeholder="Input nama .." required>
                  </div>
               </div>
               <div class="form-group">
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <div class="input-group-text">
                           <span><i class="fas fa-user"></i>&nbsp;&nbsp;</span>
                        </div>
                     </div>
                     <input type="text" name="username" class="form-control" placeholder="Input username .." required>
                  </div>
               </div>
               <div class="form-group">
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <div class="input-group-text">
                           <span toggle="#password-field" class="fa fa-fw fa-lock field-icon toggle-password"></span>
                        </div>
                     </div>
                     <input id="password-field" type="password" class="form-control" name="password" placeholder="Input password .." required>
                  </div>
               </div>
               <div class="form-group mb-0">
                  <div class="custom-file">
                     <input type="file" class="custom-file-input" id="image" name="foto" onchange="priviewImage()">
                     <label class="custom-file-label" for="image">Upload Image..</label>
                     <?php echo set_value('foto'); ?>
                  </div>
                  <img class="img-priview img-fluid col-sm-5 mb-1 mt-1">
               </div>
            </div>
            <div class="modal-footer justify-content-center">
               <button class="btn btn-info col-6" id="addbtn"><i class="fa fa-check"></i> Save</button>
            </div>
         </form>
      </div>
   </div>
</div>
<!--End Modals Add-->

<!-- Bootstrap modal edit & delete
<?php foreach ($users as $u) : ?>
   <div class="modal fade" id="modal_edit<?= $u->id_user ?>" tabindex="-1" data-backdrop="static">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content bg-light color-palette">
            <div class="modal-header">
               <h4 class="col-12 modal-title text-center">Edit User
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </h4>
            </div>
            <form method="post" onsubmit="editbtn.disabled = true; return true;" action="<?= base_url('dashboard/edit_user') ?>">
               <div class="card-body">
                  <div class="form-group">
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <div class="input-group-text">
                              <span><i class="fas fa-user-tie"></i>&nbsp;&nbsp;</span>
                           </div>
                        </div>
                        <input type="hidden" name="id" value="<?= $u->id_user ?>">
                        <input type="text" name="nama" class="form-control" value="<?= $u->nama ?>" required>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <div class="input-group-text">
                              <span><i class="fas fa-user"></i>&nbsp;&nbsp;</span>
                           </div>
                        </div>
                        <input type="text" name="username" class="form-control" value="<?= $u->username ?>" required>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <div class="input-group-text">
                              <span><i class="fas fa-phone"></i>&nbsp;&nbsp;</span>
                           </div>
                        </div>
                        <input type="text" name="no_hp" class="form-control" value="<?= $u->no_hp ?>" required>
                     </div>
                  </div>
                  <div class=" form-group">
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <div class="input-group-text">
                              <span class="fa fa-lock field-icon">&nbsp;&nbsp;</span>
                           </div>
                        </div>
                        <input type="password" class="form-control" name="password" placeholder="change password ..">
                     </div>
                     <small>Kosongkan jika tidak ingin mengubah password</small>
                  </div>
                  <div class="form-group">
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <div class="input-group-text">
                              <span><i class="fas fa-suitcase"></i>&nbsp;&nbsp;</span>
                           </div>
                        </div>
                        <select class="form-control" name="level" required>
                           <option value="">- Pilih level -</option>
                           <?php foreach ($level as $l) : ?>
                              <option value="<?= $l->id_level ?>" <?= $u->id_level == $l->id_level ? 'selected' : '' ?>><?= ucwords($l->nama_level) ?></option>
                           <?php endforeach ?>
                        </select>
                     </div>
                  </div>
                  <div class="form-group mb-0">
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <div class="input-group-text">
                              <span><i class="fas fa-house-user"></i>&nbsp;&nbsp;</span>
                           </div>
                        </div>
                        <textarea type="text" name="alamat" class="form-control" required><?= ucfirst($u->alamat) ?></textarea>
                     </div>
                  </div>
               </div>
               <div class="modal-footer justify-content-center">
                  <button class="btn btn-info col-6" id="editbtn"><i class="fa fa-check"></i> Update</button>
               </div>
            </form>
         </div>
      </div>
   </div>
   <div class="modal fade" id="modal_hapus<?= $u->id_user; ?>" tabindex="-1" data-backdrop="static">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content bg-danger">
            <div class="modal-header">
               <h4 class="col-12 modal-title text-center">Delete user
                  <button class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </h4>
            </div>
            <form onsubmit="delform.disabled = true; return true;" method="post" action="<?= base_url('dashboard/del_user') ?>">
               <div class="modal-body">
                  <input type="hidden" name="id" value="<?= $u->id_user ?>">
                  <input type="hidden" name="id_mgr" value="<?= $u->id_mgr ?>">
                  <input type="hidden" name="id_spv" value="<?= $u->id_spv ?>">
                  <input type="hidden" name="nama" value="<?= $u->nama ?>">
                  <span>Apakah kamu yakin hapus user <?= ucfirst($u->nama) ?> ?</span>
               </div>
               <div class="modal-footer justify-content-between">
                  <button class="btn btn-outline-light" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                  <button class="btn btn-outline-light" id="delform"><i class="fa fa-check"></i> Yes</button>
               </div>
            </form>
         </div>
      </div>
   </div>
<?php endforeach ?> -->
<!--End Modals Add-->

<script>
   function priviewImage() {
      const image = document.querySelector('#image');
      const imgPreview = document.querySelector('.img-priview');

      imgPreview.style.display = 'block';

      const oFReader = new FileReader();
      oFReader.readAsDataURL(image.files[0]);

      oFReader.onload = function(oFREvent) {
         imgPreview.src = oFREvent.target.result;
      }
   }
</script>