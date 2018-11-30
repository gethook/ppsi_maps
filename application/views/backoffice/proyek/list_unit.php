<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover table-condensed">
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
				<!-- <th>Action</th> -->
			</tr>
		</thead>
		<tbody>
			<?php $no=0;foreach($units as $unit): ?>
				<tr>
					<td><?php echo ++$no; ?></td>
					<td><?php echo $unit['unit_name']; ?></td>
					<td>
						<?php echo $unit['status_unit_name']; ?>
						<?php if($is_devteam): ?>
						<div class="pull-right">
							<?php 
							include 'edit_unit.php';
							if(!$unit['types'][0]['floor']): 
								include 'hapus_unit.php';
							endif;
							?>
						</div>
						<?php endif; ?>
					</td>
					<td><?php if($unit['types'][0]['floor']) echo $unit['types'][0]['floor'] . ' lantai'; ?></td>
					<td><?php if($unit['types'][0]['lb']) echo $unit['types'][0]['lb'] . '/' . $unit['types'][0]['lt']; ?></td>
					<td class="text-center">
						<?php if($unit['types'][0]['kt']) { //echo $unit['types'][0]['kt'] . ' KT/' . $unit['types'][0]['km'].' KM'; ?>
							<a><?php echo $unit['types'][0]['kt']; ?> <span class="fa fa-bed fa-fw"></span></a>
							<a><?php echo $unit['types'][0]['km']; ?> <span class="fa fa-bath fa-fw"></span></a>
						<?php } ?>
						
					</td>
					<td class="text-right">
						<?php if($unit['types'][0]['price']) echo rupiah($unit['types'][0]['price']); ?>
					</td>
					<td class="text-right">
						<?php if($unit['types'][0]['price_choices']) echo rupiah($unit['types'][0]['price_choices'][0]['dp']); ?>
					</td>
					<td class="text-right">
						<?php if($unit['types'][0]['price_choices']) echo rupiah($unit['types'][0]['price_choices'][0]['installment']); ?>
					</td>
					<td>
						<?php if($unit['types'][0]['price_choices']) echo $unit['types'][0]['price_choices'][0]['tenor']/12 . ' thn'; ?>
					</td>
					<td class="text-right">
						<?php if($unit['types'][0]['price_choices']) echo rupiah($unit['types'][0]['price_choices'][0]['total']); ?>
					</td>
					<!-- <td> -->
						<!-- <a href=""> -->
							<!-- <span class="fa fa-pencil fa-fw"></span> -->
						<!-- </a> -->
						<!-- <a href=""> -->
							<!-- <span class="fa fa-trash fa-fw"></span> -->
						<!-- </a> -->
					<!-- </td> -->
				</tr>
				<?php 
				if(count($unit['types'])>1): 
					//$ct=0;
					foreach($unit['types'] as $ky => $type):
						if($ky == 0):
							foreach($type['price_choices'] as $kpc => $pc):
								if($kpc>0):
				?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td class="text-right"><?php echo rupiah($pc['dp']); ?></td>
					<td class="text-right"><?php echo rupiah($pc['installment']); ?></td>
					<td><?php echo $pc['tenor']/12 . ' thn'; ?></td>
					<td class="text-right"><?php echo rupiah($pc['total']); ?></td>
					<!-- <td></td> -->
				</tr>
				<?php
								endif;
							endforeach;
						else: // $ky > 0
				?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td><?php echo $type['floor'] . ' lantai'; ?></td>
					<td><?php echo $type['lb'] . '/' . $type['lt']; ?></td>
					<td class="text-center"><?php //echo $type['kt'] . '/' . $type['km']; ?>
						<a><?php echo $type['kt']; ?> <span class="fa fa-bed fa-fw"></span></a>
						<a><?php echo $type['km']; ?> <span class="fa fa-bath fa-fw"></span></a>
					</td>
					<td class="text-right"><?php echo rupiah($type['price']); ?></td>
					<td class="text-right"><?php if($type['price_choices']) echo rupiah($type['price_choices'][0]['dp']); ?></td>
					<td class="text-right"><?php if($type['price_choices']) echo rupiah($type['price_choices'][0]['installment']); ?></td>
					<td><?php if($type['price_choices']) echo ($type['price_choices'][0]['tenor'])/12 . ' thn'; ?></td>
					<td class="text-right"><?php if($type['price_choices']) echo rupiah($type['price_choices'][0]['total']); ?></td>
					<!-- <td></td> -->
				</tr>
				<?php
							foreach($type['price_choices'] as $kpc => $pc):
								if($kpc>0):
				?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td class="text-right"><?php echo rupiah($pc['dp']); ?></td>
					<td class="text-right"><?php echo rupiah($pc['installment']); ?></td>
					<td><?php echo $pc['tenor']/12 . ' thn'; ?></td>
					<td class="text-right"><?php echo rupiah($pc['total']); ?></td>
					<!-- <td></td> -->
				</tr>
				<?php
								endif;
							endforeach;
						endif;
					endforeach;
				endif;
				?>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>