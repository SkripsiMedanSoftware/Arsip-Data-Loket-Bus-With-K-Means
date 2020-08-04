<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo isset($page_title)?$page_title:''; ?></h3>
	</div>
	<div class="box-body">
		<?php 
		if ($this->session->flashdata('flash_message'))
		{
			?>
				<div class="alert alert-<?php echo $this->session->flashdata('flash_message')['status'] ?> alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<?php echo $this->session->flashdata('flash_message')['message'] ?>
				</div>
			<?php
		}

		$this->kmeans->setAttributes(array('JUMLAH PENUMPANG TOTAL', 'KETERSEDIAAN BUS TOTAL', 'JUMLAH PAKET TOTAL'));
		?>
		<table class="table table-hover">
			<thead>
				<th>No</th>
				<th>Nama Loket</th>
				<th>Jumlah Penumpang Total</th>
				<th>Ketersediaan Bus Total</th>
				<th>Jumlah Paket Total</th>
			</thead>
			<tbody>
				<?php foreach ($loket as $key => $value) {?>
				<tr>
					<td><?php echo $key+1; ?></td>
					<td><?php echo $value['nama_loket'] ?></td>
					<td><?php echo $this->data_loket_model->jumlah_penumpang_total($value['id']); ?></td>
					<td><?php echo $this->data_loket_model->jumlah_bus_total($value['id']); ?></td>
					<td><?php echo $this->data_loket_model->jumlah_paket_total($value['id']); ?></td>
				</tr>
				<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>

<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">K-Means</h3>
	</div>
	<div class="box-body">
		<?php 
		$this->kmeans->setAttributes(array('JUMLAH PENUMPANG TOTAL', 'KETERSEDIAAN BUS TOTAL', 'JUMLAH PAKET TOTAL'));

		foreach ($loket as $key => $value) {
			$this->kmeans->setDataFromArgs($this->data_loket_model->jumlah_penumpang_total($value['id']), $this->data_loket_model->jumlah_bus_total($value['id']), $this->data_loket_model->jumlah_paket_total($value['id']));
		}

		if (count($this->kmeans->getData()) > 2) :
			$i = 1;
			for (; ; ) {
			    $this->kmeans->setIteration($i);
				$this->kmeans->run();
				if ($this->kmeans->isDone()) {
					// echo 'Kmeans end in : '.$this->kmeans->countIterations();
					$i = 0;
					foreach ($this->kmeans->getAllResults()['clusters'] as $iteration => $clusters) {
						echo '<center><h2>Iterasi '.($i+1).'</h2></center>';
						?>
						<div class="row">
							<div class="col-lg-12">
							<?php foreach ($this->kmeans->getLogs('centroids')[$iteration] as $key => $centroid) { ?>
								<div class="col-lg-4">
									<table class="table table-hover table-bordered">
										<th colspan="2"><center>Centroid <?php echo $key+=1 ?></center></th>
										<?php foreach ($centroid as $centroid_key => $centroid_val) {
										?>
										<tr>
											<td><?php echo $centroid_key ?></td>
											<td><?php echo $centroid_val ?></td>
										</tr>
										<?php	
										} ?>
									</table>
								</div>
							<?php } ?>
							</div>
						</div>
						<br>
						<?php
						foreach ($clusters as $cluster_key => $data) {
						    echo '<h4>Kelompok '.($cluster_key+=1).'</h4>';
						    ?>
						    <table class="table table-responsive table-bordered table-hover">
						    	<thead>
						    		<th>No</th>
						    		<th>Nama Loket</th>
						    		<th>Jumlah Penumpang Total</th>
									<th>Ketersediaan Bus Total</th>
									<th>Jumlah Paket Total</th>
						    	</thead>
						    	<tbody>
							    <?php
							    $no = 1;
							    foreach ($data as $data_key => $value) {
							    	?>
							    	<tr>
								    	<td><?php echo $no ?></td>
								    	<td style="width: 20%;"><?php echo $loket[$data_key]['nama_loket']; ?></td>
								    	<td style="width: 20%;"><?php echo $this->data_loket_model->jumlah_penumpang_total($loket[$data_key]['id']); ?></td>
										<td style="width: 20%;"><?php echo $this->data_loket_model->jumlah_bus_total($loket[$data_key]['id']); ?></td>
										<td style="width: 20%;"><?php echo $this->data_loket_model->jumlah_paket_total($loket[$data_key]['id']); ?></td>
									</tr>
							    	<?php
							    	$no++;
							    }
							    ?>
							    </tbody>
						    </table>
						    <hr>
						    <?php
						}
						$i++;
					}
					break;
				}
			    $i++;
			}

		else:
			echo('<center><h2>Data Tidak Mencukupi</h2></center>');
		endif;
		?>
	</div>
</div>