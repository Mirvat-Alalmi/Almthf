<?php $__env->startSection('css'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopSection(); ?>

<?php if(isset($dataTypeContent->id)): ?>
    <?php $__env->startSection('page_title','Edit '.$dataType->display_name_singular); ?>
<?php else: ?>
    <?php $__env->startSection('page_title','Add '.$dataType->display_name_singular); ?>
<?php endif; ?>

<?php $__env->startSection('page_header'); ?>
    <h1 class="page-title">
        <i class="<?php echo e($dataType->icon); ?>"></i> <?php if(isset($dataTypeContent->id)): ?><?php echo e('Edit'); ?><?php else: ?><?php echo e('New'); ?><?php endif; ?> <?php echo e($dataType->display_name_singular); ?>

    </h1>
    <?php echo $__env->make('voyager::multilingual.language-selector', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">

                    <div class="panel-heading">
                        <h3 class="panel-title"><?php if(isset($dataTypeContent->id)): ?><?php echo e('Edit'); ?><?php else: ?><?php echo e('Add New'); ?><?php endif; ?> <?php echo e($dataType->display_name_singular); ?></h3>
                    </div>

                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form"
                          class="form-edit-add"
                          action="<?php if(isset($dataTypeContent->id)): ?><?php echo e(route('voyager.'.$dataType->slug.'.update', $dataTypeContent->id)); ?><?php else: ?><?php echo e(route('voyager.'.$dataType->slug.'.store')); ?><?php endif; ?>"
                          method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                        <?php if(isset($dataTypeContent->id)): ?>
                        <?php echo e(method_field("PUT")); ?>

                        <?php endif; ?>

                                <!-- CSRF TOKEN -->
                        <?php echo e(csrf_field()); ?>


                        <div class="panel-body">

                            <?php if(count($errors) > 0): ?>
                                <div class="alert alert-danger">
                                    <ul>
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </ul>
                                </div>
                                <?php endif; ?>

                                        <!-- If we are editing -->
                                <?php if(isset($dataTypeContent->id)): ?>
                                    <?php $dataTypeRows = $dataType->editRows; ?>
                                <?php else: ?>
                                    <?php $dataTypeRows = $dataType->addRows; ?>
                                <?php endif; ?>

                                <div class="form-group">
                                    <label>اسم المستخدم</label>
                                    <select id="user_id" name="user_id" class="form-control">
                                        <?php $__currentLoopData = \App\User::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>عدد البالغين</label>
                                    <input id="number_of_adults" type="number" name="number_of_adults"
                                           class="form-control" placeholder="1"
                                           value="<?php echo e(old('number_of_adults')); ?>">
                                </div>
                                <div class="form-group">
                                    <label>عدد الأطفال</label>
                                    <input id="number_of_children" type="number" name="number_of_children"
                                           class="form-control" placeholder="1"
                                           value="<?php echo e(old('number_of_children')); ?>">
                                </div>
                                <div class="form-group ">
                                    <label for="name">Come Date</label>
                                    <input id="come_date" required type="datetime" class="form-control datepicker"
                                           name="come_date"
                                           value="<?php echo e(old('come_date')); ?>">
                                </div>
                                <div class="form-group ">
                                    <label for="name">Leave Date</label>
                                    <input id="leave_date" required type="datetime" class="form-control datepicker"
                                           name="leave_date"
                                           value="<?php echo e(old('leave_date')); ?>">
                                </div>

                                
                                
                                
                                
                                

                                
                                
                                
                                
                                

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <button type="button" id="button"
                                    onclick="showUser(document.getElementById('user_id').value,document.getElementById('number_of_adults').value,document.getElementById('number_of_children').value,(new Date(document.getElementById('come_date').value)),(new Date(document.getElementById('leave_date').value)))"
                                    class="btn btn-default save">بحث عن غرفة
                            </button>
                        </div>
                    </form>
                    <br>
                    <div id="txtHint"><b></b></div>

                    <iframe id="form_target" name="form_target" style="display:none"></iframe>
                    <form id="my_form" action="<?php echo e(route('voyager.upload')); ?>" target="form_target" method="post"
                          enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                        <input name="image" id="upload_file" type="file"
                               onchange="$('#my_form').submit();this.value='';">
                        <input type="hidden" name="type_slug" id="type_slug" value="<?php echo e($dataType->slug); ?>">
                        <?php echo e(csrf_field()); ?>

                    </form>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script>
        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            <?php if($isModelTranslatable): ?>
                $('.side-body').multilingual({"editing": true});
            <?php endif; ?>

            $('.side-body input[data-slug-origin]').each(function (i, el) {
                $(el).slugify();
            });
        });
    </script>
    <?php if($isModelTranslatable): ?>
        <script src="<?php echo e(config('voyager.assets_path')); ?>/js/multilingual.js"></script>
    <?php endif; ?>
    <script src="<?php echo e(config('voyager.assets_path')); ?>/lib/js/tinymce/tinymce.min.js"></script>
    <script src="<?php echo e(config('voyager.assets_path')); ?>/js/voyager_tinymce.js"></script>
    <script src="<?php echo e(config('voyager.assets_path')); ?>/js/slugify.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('voyager::master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>