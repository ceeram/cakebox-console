<?php
use App\Form\SiteFileForm;
?>

<div class="index-main col-sm-10 column">

	<!-- Ajax success message -->
	<div class="alert alert-success alert-dismissible collapse" role="alert">
		<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<span class="message">
			ajax-loaded message
		</span>
	</div>

	<!-- Sitefiles widget -->
	<div class="widget stacked widget-table action-table">

		<div class="widget-header">
			<i class="fa fa-file-text-o"></i>
			<h3><?= __('Nginx Virtual Hosts') ?></h3>
		</div>

		<div class="widget-content">
			<div class="panel-body">
				<table class="table collection">
					<caption>
						<?= __('As found in ') . $data['directories']['sites-available'] ?>
					</caption>
					<thead>
						<tr>
							<th>#</th>
							<th><?= __("Site File") ?></th>
							<th><?= __("Enabled") ?></th>
							<th><?= __("Last Modified") ?></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data['sitefiles'] as $key => $file): ?>
							<tr>
								<td class="index"><?= $key + 1 ?></td>
								<td class="filename"><?= $file['name'] ?></td>
								<td><?= $file['enabled'] ? __('Yes') : __('No') ?></td>
								<td><?= $this->Time->format($file['modified'], 'YYYY-MM-dd'); ?></td>
								<td class="actions">
									<div class="btn-group pull-right">
										<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#fileModal">
											<?= __('View') ?>
										</button>
										<button type="button" class="confirm delete btn btn-danger btn-sm" rel="sitefiles/ajax_delete">
											<?= __('Delete') ?>
										</button>
									</div>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>

		</div> <!-- /widget-content -->

	</div> <!-- /widget -->

</div> <!-- col-sm-10 -->

<!-- Actions -->
<div class="col-sm-2 column">
	<div class="actions">
		<a href="#" class="ajax-form-modal btn btn-primary btn-block" data-target="#formModalAdd"><?= __('New Virtual Host') ?></a>
	</div>
</div>

<!-- View Modal -->
<div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">ajax-loaded-title</h4>
			</div>
			<div class="modal-body">
				ajax-loaded-content
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<!-- Form Modal -->
<div class="modal fade" id="formModalAdd" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title"><?= __('New Nginx website') ?></h4>
			</div>
			<div class="modal-body">
				<?php
					$form = new SiteFileForm();
					echo $this->Form->create($form, [
						'url' => ['controller' => 'sitefiles', 'action' => 'ajax_add.json']
					]);
				?>

				<div class="alert alert-danger alert-dismissible collapse" role="alert">
					<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<span>
						ajax-loaded error message
					</span>
				</div>
				<?php
					echo $this->Form->input('url');
					echo $this->Form->input('webroot');
					echo $this->Form->input('force');
					echo $this->Form->end();
				?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?= __('Cancel') ?></button>
				<button type="button" id="form-submit" class="btn btn-primary"><?= __('Submit') ?></button>
			</div>
		</div>
	</div>
</div>
