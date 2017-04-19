<input type="number" class="form-control" name="<?php echo e($row->field); ?>"
        placeholder="<?php echo e(isset($options->placeholder)? old($row->field, $options->placeholder): $row->display_name); ?>"
       value="<?php if(isset($dataTypeContent->{$row->field})): ?><?php echo e(old($row->field, $dataTypeContent->{$row->field})); ?><?php else: ?><?php echo e(old($row->field)); ?><?php endif; ?>">
