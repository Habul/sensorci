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
                  <li class="breadcrumb-item active">Profile</li>
               </ol>
            </div>
         </div>
      </div>
   </div>

   <section class="content">
      <div class="container">
         <div class="row">
            <div class="col-md-3">
               <div class="card card-info card-outline">
                  <div class="card-body box-profile">
                     <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/img/') . $this->session->userdata('image') ?>" alt="User profile picture">
                     </div>
                     <h3 class="profile-username text-center"><?= ucwords($this->session->userdata('name')) ?></h3>
                     <p class="text-muted text-center"><?= ucwords($this->session->userdata('username')) ?></p>
                  </div>
               </div>
            </div>

            <div class="col-md-9">
               <div class="card card-info card-outline card-outline-tabs">
                  <div class="card-header p-0 border-bottom-0">
                     <ul class="nav nav-tabs" role="tablist" id="myTab">
                        <li class="nav-item">
                           <a class="nav-link active" id="set_user" data-toggle="tab" href="#profile-settiing" role="tab" aria-controls="profile-settiing" aria-selected="true">Profile</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" id="set_pass" data-toggle="tab" href="#pass-setting" role="tab" aria-controls="pass-setting" aria-selected="false">Password</a>
                        </li>
                     </ul>
                  </div>

                  <div class="card-body">
                     <div class="tab-content">
                        <div class="tab-pane fade show active" id="profile-settiing" role="tabpanel" aria-labelledby="profile-settiing-tab">
                           <?php foreach ($profile as $p) { ?>
                              <form onsubmit="profil.disabled = true; return true;" method="post" action="<?= base_url('dashboard/profile_update') ?>" enctype="multipart/form-data">
                                 <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Nama </label>
                                    <div class="col-sm-10">
                                       <input type="text" name="name" id="inputName" class="form-control" value="<?= $p->name; ?>" required>
                                       <?= form_error('name'); ?>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email </label>
                                    <div class="col-sm-10">
                                       <input type="text" name="username" id="inputEmail" class="form-control" value="<?= $p->username; ?>" required>
                                       <?= form_error('username'); ?>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="control-label col-sm-2">Image </label>
                                    <div class="col-sm-10">
                                       <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="image" name="images" onchange="priviewImage()">
                                          <label class="custom-file-label" for="image">Choose file</label>
                                       </div>
                                       <img class="img-priview img-fluid col-sm-5 mt-3">
                                       <?= form_error('image'); ?>
                                    </div>
                                 </div>
                                 <div class="form-group text-center">
                                    <div class="offset-sm-2 col-sm-10">
                                       <input type="submit" class="btn btn-info col-3" id="profil" value="Update">
                                    </div>
                                 </div>
                              </form>
                           <?php } ?>
                        </div>

                        <div class="tab-pane fade" id="pass-setting" role="tabpanel" aria-labelledby="pass-setting-tab">
                           <form method="post" onsubmit="pass.disabled = true; return true;" action="<?= base_url('dashboard/change_password') ?>">
                              <div class="form-group">
                                 <label>Old Password *</label>
                                 <input type="password" name="password_lama" class="form-control" placeholder="Masukkan Password Lama Anda .." required>
                                 <?= form_error('password_lama'); ?>
                              </div>
                              <hr>
                              <div class="form-group">
                                 <label>New Password *</label>
                                 <input type="password" name="password_baru" class="form-control" placeholder="Masukkan Password Baru .." required>
                                 <?= form_error('password_baru'); ?>
                              </div>
                              <div class="form-group">
                                 <label>Confirm New Password *</label>
                                 <input type="password" name="konfirmasi_password" class="form-control" placeholder="Ulangi Password Baru .." required>
                                 <?= form_error('konfirmasi_password'); ?>
                              </div>
                              <div class="form-group text-center">
                                 <input type="submit" class="btn btn-info col-3" id="pass" value="Update">
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
   </section>
</div>

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