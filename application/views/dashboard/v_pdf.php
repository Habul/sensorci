<!DOCTYPE html>

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Internet Of Things | Log Monitor Print</title>
   <link rel="stylesheet" href="<?= base_url('assets/dist/css/pdf.css') ?>">
</head>

<body>
   <div>
      <section>
         <div class="row">
            <div>
               <table id="table_hide">
                  <tr>
                     <td style="text-align:center"><img src="<?= base_url('assets/img/unpam.png'); ?>" style="width:80px;"></td>
                  </tr>
                  <tr>
                     <td style="text-align:center">
                        <h1><b>Monitoring Log Sensor</b></h1>
                     </td>
                  </tr>
               </table>
            </div>
         </div>
         <br />
         <div class="row">
            <div>
               <table id="table">
                  <thead>
                     <tr style="text-align:center">
                        <th style="text-align:center"><b>No</b></th>
                        <th style="text-align:center"><b>Suhu</b></th>
                        <th style="text-align:center"><b>Kelembaban</b></th>
                        <th style="text-align:center"><b>Tanggal</b></th>
                        <th style="text-align:center"><b>Waktu</b></th>
                     </tr>
                  </thead>
                  <?php $no = 1;
                  foreach ($report as $h) : ?>
                     <tbody>
                        <tr>
                           <td style="text-align:center"><?= $no++; ?></td>
                           <td style="text-align:center"><?= $h->suhu; ?></td>
                           <td style="text-align:center"><?= $h->kelembaban; ?></td>
                           <td style="text-align:center"><?= $h->tanggal; ?></td>
                           <td style="text-align:center"><?= $h->waktu; ?></td>
                        </tr>
                     </tbody>
                  <?php endforeach; ?>
               </table>
            </div>
         </div>
      </section>
   </div>
</body>

</html>