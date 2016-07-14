<?php $this->load->view('common/header'); ?>
<section class="content-wrap">
  <div class="container youplay-content">
    <div class="row">
      <div class="col-md-9 col-md-push-3">
        <!-- Contact Form -->
        <div class="youplay-form p-0">
          <h1><?php echo lang('login_heading');?></h1>
          <p><?php echo lang('login_subheading');?></p>
          
          <div id="infoMessage"><?php echo $message;?></div>
          
          <?php echo form_open("auth/login");?>
            <div class="row">
              <div class="col-md-6">
                <div class="youplay-input form-group">
                    <?php echo form_input($identity);?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="youplay-input form-group">
                  <?php echo form_input($password);?>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="col-md-6">
                <!--div class="youplay-input form-group"-->
                  <?php echo lang('login_remember_label', 'remember');?>
                  <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
                <!--/div-->
              </div>
            </div>
            <?php echo form_submit($submit, lang('login_submit_btn'));?>
          
          <?php echo form_close();?>
          
          <a href="forgot_password"><?php echo lang('login_forgot_password');?></a>
        </div>
      </div>
    </div>
  </div>
</section>
<?php $this->load->view('common/footer'); ?>