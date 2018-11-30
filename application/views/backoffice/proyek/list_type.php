                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Tipe (LB/LT)</th>
                        <th>Jml lt</th>
                        <th>KT/KM</th>
                        <th>Unit</th>
                        <th>Harga</th>
                        <th>DP</th>
                        <th>Angsuran</th>
                        <th>Tenor</th>
                        <th colspan="2" class="text-center">Jml Kredit</th>
                        <!-- <th>Action Kredit</th> -->
                        <?php if($is_devteam): ?>
                        <!-- <th>Action Type</th> -->
                        <?php endif; ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=0; ?>
                      <?php foreach($unit_types as $unit_type): ?>
                        <tr>
                          <?php $rowspan_type = count($unit_type['price_choices']); ?>
                          <td rowspan="<?php echo $rowspan_type; ?>"><?php $no++;echo $no; ?></td>
                          <td rowspan="<?php echo $rowspan_type; ?>">
                            <?php echo $unit_type['lb'].'/'.$unit_type['lt']; ?>
                            <?php if($is_devteam){ 
                              include 'edit_tipe.php';
                              include 'hapus_tipe.php';
                            ?>
<!--                             <a href="">
                              <span class="fa fa-pencil fa-fw" data-toggle="tooltip" data-placement="bottom" title="Edit Tipe"></span>
                            </a>
                            <a href="">
                              <span class="fa fa-trash fa-fw" data-toggle="tooltip" data-placement="bottom" title="Hapus Tipe"></span>
                            </a> -->
                            <?php } ?>
                          </td>
                          <td rowspan="<?php echo $rowspan_type; ?>"><?php echo $unit_type['floor']; ?> lantai</td>
                          <td rowspan="<?php echo $rowspan_type; ?>">
                            <a><?php echo $unit_type['kt']; ?> <span class="fa fa-bed fa-fw"></span></a><br>
                            <a><?php echo $unit_type['km']; ?> <span class="fa fa-bath fa-fw"></span></a>
                          </td>
                          <?php $unit_s = array_column($unit_type['units'], 'unit_name'); ?>
                          <td rowspan="<?php echo $rowspan_type; ?>"><?php echo implode(', ', $unit_s); ?></td>
                          <td rowspan="<?php echo $rowspan_type; ?>" class="text-right">
                            <?php echo rupiah($unit_type['price']); ?>
                            <?php if($is_devteam){ ?>
                            <a href="<?php echo base_url('harga/tambah/' . $unit_type['unit_type_id']); ?>">
                              <span class="fa fa-money fa-fw" data-toggle="tooltip" data-placement="bottom" title="Tambah Pilihan Harga Kredit"></span>
                            </a>
                            <?php } ?>
                          </td>
                          <?php 
                          ?>
                          <td class="text-right"><?php echo rupiah($unit_type['price_choices'][0]['dp']); ?></td>
                          <td class="text-right"><?php echo rupiah($unit_type['price_choices'][0]['installment']); ?></td>
                          <td><?php echo $unit_type['price_choices'][0]['tenor']/12 . ' tahun'; ?></td>
                          <td class="text-right"><?php echo rupiah($unit_type['price_choices'][0]['total']); ?></td>
                          <?php if($is_devteam): ?>
                          <td>
                            <a href="<?php echo base_url('harga/edit/' . $unit_type['price_choices'][0]['price_choice_id']); ?>">
                              <span class="fa fa-pencil fa-fw" data-toggle="tooltip" data-placement="bottom" title="Edit"></span>
                            </a>
                            <?php include 'hapus_kredit0.php'; ?>
                          </td>
                          <!-- <td rowspan="<?php //echo $rowspan_type; ?>"></td> -->
                          <?php endif; ?>
                        </tr>
                        <?php if($rowspan_type > 1): for ($k = 1; $k < $rowspan_type; $k++): ?>
                          <tr>
                            <td class="text-right"><?php echo rupiah($unit_type['price_choices'][$k]['dp']); ?></td>
                            <td class="text-right"><?php echo rupiah($unit_type['price_choices'][$k]['installment']); ?></td>
                            <td><?php echo $unit_type['price_choices'][$k]['tenor']/12 . ' tahun'; ?></td>
                            <td class="text-right"><?php echo rupiah($unit_type['price_choices'][$k]['total']); ?></td>
                            <?php if($is_devteam): ?>
                            <td>
                              <a href="<?php echo base_url('harga/edit/' . $unit_type['price_choices'][$k]['price_choice_id']); ?>">
                                <span class="fa fa-pencil fa-fw" data-toggle="tooltip" data-placement="bottom" title="Edit"></span>
                              </a>
                              <?php include 'hapus_kreditn.php'; ?>
                            </td>
                            <?php endif; ?>
                          </tr>
                        <?php endfor; endif; ?>

                      <?php endforeach; ?>
                    </tbody>                    
                  </table>
                </div>
