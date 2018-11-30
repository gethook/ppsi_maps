                 <div class="table-responsive">
                	<table class="table table-bordered table-striped">
                		<thead>
                			<tr>
                				<th>No</th>
                				<th>Unit</th>
                        <th>Status</th>
                				<th>Jml Lt</th>
                				<th>LB/LT</th>
                				<th>KT/KM</th>
                				<th>Harga</th>
                				<th>DP</th>
                				<th>Angsuran</th>
                				<th>Tenor</th>
                				<th>Jml Kredit</th>
                				<th>Action</th>
                			</tr>
                		</thead>
                    <tbody>
                	<?php $no = 0; foreach($units as $unit): ?>
                		<?php
                    $rowspan = count($unit['unit_types']);
                    $ut0pcs = $unit['types'][0]['price_choices'];
                    ?>
                    <tr>
                      <td rowspan="<?php echo $rowspan; ?>"><?php $no++;echo $no . '.'; ?></td>
                			<td rowspan="<?php echo $rowspan; ?>"><?php echo $unit['unit_name']; ?></td>
                      <td rowspan="<?php echo $rowspan; ?>"><?php echo $unit['status_unit_name']; ?></td>
                      <td rowspan=""><?php echo $unit['types'][0]['floor'] . ' lt'; ?></td>
                      <td rowspan=""><?php echo $unit['types'][0]['lb'] . '/' . $unit['types'][0]['lt']; ?></td>
                      <td rowspan=""><?php echo $unit['types'][0]['kt'] . '/' . $unit['types'][0]['km']; ?></td>
                      <td rowspan="" class="text-right"><?php echo rupiah($unit['types'][0]['price']); ?></td>

                      <td><?php if($ut0pcs) echo rupiah($unit['types'][0]['price_choices'][0]['dp']); ?></td>
                      <td><?php if($ut0pcs) echo rupiah($unit['types'][0]['price_choices'][0]['installment']); ?></td>
                      <td><?php if($ut0pcs) echo $unit['types'][0]['price_choices'][0]['tenor']/12 . ' th'; ?></td>
                      <td><?php if($ut0pcs) echo rupiah($unit['types'][0]['price_choices'][0]['total']); ?></td>
                      <td>
                        <?php 
                        echo "<pre>";
                        print_r ($unit);
                        echo "</pre>";
                        ?>
                        <a href="">
                          <span class="fa fa-pencil fa-fw"></span>
                        </a>
                        <a href="">
                          <span class="fa fa-trash fa-fw"></span>
                        </a>
                        <a href="">
                          <span class="fa fa-book fa-fw"></span>
                        </a>
                      </td>
                		</tr>
                    <?php if($rowspan>1):for($i=1;$i<count($unit['unit_types']);$i++): ?>
                      <tr>
                        <?php $mx = count($unit['types'][$i]['price_choices']); ?>
                        <td><?php echo $unit['unit_types'][$i]['floor'] . ' lt'; ?></td>
                        <td><?php echo $unit['unit_types'][$i]['lb'] . '/' . $unit['unit_types'][$i]['lt']; ?></td>
                        <td><?php echo $unit['unit_types'][$i]['kt'] . '/' . $unit['unit_types'][$i]['km']; ?></td>
                        <td class="text-right"><?php echo rupiah($unit['unit_types'][$i]['price']); ?></td>
                      </tr>
                      
                      <?php if($mx>1):for($cnt=1;$cnt<$mx;$cnt++): ?>
                        <td><?php print_r($unit['types'][$i]);//echo rupiah($unit['types'][$i]['price_choices'][$cnt]['dp']); ?></td>
                        <td><?php //echo rupiah($unit['types'][$i]['price_choices'][$cnt]['installment']); ?></td>
                        <td><?php //echo $unit['types'][$i]['price_choices'][$cnt]['tenor']/12 . ' th'; ?></td>
                        <td class="text-right"><?php //echo rupiah($unit['types'][$i]['price_choices'][$cnt]['total']); ?></td>                        
                      <?php endfor;endif; ?>
                    <?php endfor;endif; ?>
                	<?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
