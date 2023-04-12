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
          <div class="d-flex justify-content-between">
            <a class="btn btn-info col-5" href="#"><i class="fas fa-file-excel"></i> Export to excel</a>
            <a class="btn btn-secondary col-5" href="#"><i class="fas fa-file-pdf"></i> Export to PDF</a>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card">
            <table class="table">
              <thead class="thead-light">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Suhu</th>
                  <th scope="col">Kelembaban</th>
                  <th scope="col">Waktu</th>
                </tr>
              </thead>
              <tbody id="laporan">
              </tbody>
            </table>
          </div>
        </div>
      </div>
  </section>
</div>