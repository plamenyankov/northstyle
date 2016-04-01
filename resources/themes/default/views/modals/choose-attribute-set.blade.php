<div id="chooseAttributeSetModal" class="modal choose-attribute-set-modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="" action="{{ $createProductUrl }}" method="get" class="choose-attribute-set-form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">Избери множество атрибути</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						{!! Form::select('attribute_set_id', $attributeSetDropdownOptions, null, ['class'=>'form-control']) !!}
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Откажи</button>
					<button type="submit" class="btn btn-primary">Напред</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->