<a href="javascript:void(0)" data-toggle="modal" data-target="#HapusKredit<?php echo $unit_type['price_choices'][0]['price_choice_id']; ?>">
	<span class="fa fa-trash fa-fw" data-toggle="tooltip" data-placement="bottom" title="Hapus"></span>
</a>
<div class="modal fade" id="HapusKredit<?php echo $unit_type['price_choices'][0]['price_choice_id']; ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php //echo form_open('developer/rmteam'); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Hapus Harga Kredit</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger">
					<p>Pilihan harga kredit ini akan dihapus.</p>
					<p>DP <?php echo rupiah($unit_type['price_choices'][0]['dp']); ?>, angsuran <?php echo rupiah($unit_type['price_choices'][0]['installment']); ?> (<?php echo $unit_type['price_choices'][0]['tenor']/12; ?> tahun). Tipe <?php echo $unit_type['lb']; ?>/<?php echo $unit_type['lt']; ?> (<?php echo $unit_type['floor']; ?> lantai).</p>
					<p>Apakah Anda yakin ingin menghapus harga kredit ini?</p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					<i class="fa fa-undo fa-fw"></i> Tidak, Batalkan
				</button>
				<a href="<?php echo base_url('harga/hapus/'.$unit_type['price_choices'][0]['price_choice_id']); ?>" class="btn btn-danger">
					<span class="fa fa-trash fa-fw"></span>
					Ya, Hapus
				</a>
				
			</div>
			<?php //echo form_close(); ?>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
