<?php
                $no = '1';
                $this->db->select('*');
                $this->db->from('tb_log');
                $this->db->order_by('tanggal', 'desc');
				        $this->db->limit('10');
                $query = $this->db->get();
                foreach ($query->result() as $row) {
              ?>
              <tr>
                <th scope="row"><?=$no++?></th>
                <td><?=$row->suhu?></td>
                <td><?=$row->kelembaban?></td>
                <td><?=$row->tanggal?> <?=$row->waktu?></td>
              </tr>
<?php } ?>
