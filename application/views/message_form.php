<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Message <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Group Id <?php echo form_error('group_id') ?></label>
            <input type="text" class="form-control" name="group_id" id="group_id" placeholder="Group Id" value="<?php echo $group_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Title <?php echo form_error('title') ?></label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?php echo $title; ?>" />
        </div>
	    <div class="form-group">
            <label for="body">Body <?php echo form_error('body') ?></label>
            <textarea class="form-control" rows="3" name="body" id="body" placeholder="Body"><?php echo $body; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="varchar">Icon <?php echo form_error('icon') ?></label>
            <input type="text" class="form-control" name="icon" id="icon" placeholder="Icon" value="<?php echo $icon; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Tag <?php echo form_error('tag') ?></label>
            <input type="text" class="form-control" name="tag" id="tag" placeholder="Tag" value="<?php echo $tag; ?>" />
        </div>
	    <div class="form-group">
            <label for="data">Data <?php echo form_error('data') ?></label>
            <textarea class="form-control" rows="3" name="data" id="data" placeholder="Data"><?php echo $data; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="timestamp">Created Date <?php echo form_error('created_date') ?></label>
            <input type="text" class="form-control" name="created_date" id="created_date" placeholder="Created Date" value="<?php echo $created_date; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('message') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>