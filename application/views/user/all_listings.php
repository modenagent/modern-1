 


<!-- Recent LP's section -->
<section id="recent-lp2">
     
  <div class="container">
    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a> 
        <strong>Success! </strong>
        <?php echo $this->session->flashdata('success') ?>
    </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')) : ?>
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert">&times;</a> 
        <strong>Error! </strong>
    <?php echo $this->session->flashdata('error') ?>
</div>
<?php endif; ?>
    <h1 class="page-header">Recently Created Reports</h1>
    <p class="subhead">We have stored all of your created reports so you can access them at anytime.</p>
    <p>&nbsp;</p>
    <?php $this->load->view('user/listing_table',array('reports'=>$reports)); ?>
  </div>
</section>
<!-- Screenshots section -->