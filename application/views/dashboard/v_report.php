<div class="content-wrapper">
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Log Sensor</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Report</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container" style="text-align: center; margin-top: 30px">
      <div class="row" style="display: flex;">
        <div class="col-md-4">
          <div class="card card-info shadow-sm">
            <div class="card-header">
              <h4 class="card-title">Filter log sensor</h4>
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
              <form action="<?= base_url('dashboard/search') ?>" method="get">
                <div class="form-row">
                  <div class="col-md-6 mb-3">
                    <label>Start</label>
                    <input type="date" class="form-control" name="period_awal" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label>End</label>
                    <input type="date" class="form-control" name="period_akhir" required>
                  </div>
                </div>
                <div class="d-flex justify-content-center">
                  <button class="btn btn-outline-info col-6" type="submit"><i class="fas fa-search"></i> Priview</button>
                </div>
              </form>
            </div>
          </div>
          <div class="card shadow-0 border mb-2">
            <div class="card-body p-4">
              <h4 class="mb-1 sfw-normal"><b>Laporan Harian</b></h4>
              <span id="laporan-harian"></span>
            </div>
          </div>
          <div class="card shadow-0 border mb-2">
            <div class="card-body p-4">
              <h4 class="mb-1 sfw-normal"><b>Laporan Bulanan</b></h4>
              <span id="laporan-bulanan"></span>
            </div>
          </div>
        </div>
      </div>
  </section>
</div>