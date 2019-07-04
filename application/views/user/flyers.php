<!-- Include Final Tiles Gallery script -->
<script src="<?php echo base_url("assets/finaltilesgallery/jquery.finaltilesgallery.js") ?> "></script>
<script src="<?php echo base_url("assets/finaltilesgallery/jquery.magnific-popup.min.js") ?> "></script>
 
<!-- Include Final Tiles Gallery stylesheet -->
<link rel="stylesheet" href="<?php echo base_url("assets/finaltilesgallery/finaltilesgallery.css")?>">
<link rel="stylesheet" href="<?php echo base_url("assets/finaltilesgallery/magnific-popup.css") ?>">
 
<!-- Include icons stylesheet (only if you need it) -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> 

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
    <h1 class="page-header">Flyers Gallery</h1>
    <p>&nbsp;</p>
    <div class="final-tiles-gallery social-icons-right social-icons-none caption-top caption-left effect-slide-from-bottom effect-zoom-in effect-speed-very-slow caption-color-dark">
  <div class="ftg-items">
      <?php
      $themeData = array(
          array(
              'title'=>'Prudential Blue',
              'color'=>'rgb(8,72,135)'
          ),
          array(
              'title'=>'Coldwell Banker',
              'color'=>'rgb(0,41,128)'
          ),
          array(
              'title'=>'Keller Williams Burgundy',
              'color'=>'rgb(180,1,1)'
          ),
          array(
              'title'=>'Realty Excutives Blie',
              'color'=>'rgb(0,28,61)'
          ),
          array(
              'title'=>'Dilbeck Green',
              'color'=>'rgb(0,51,13)'
          ),
          array(
              'title'=>'Modern Black',
              'color'=>'rgb(15,15,15)'
          ),
          array(
              'title'=>'Modern Gray',
              'color'=>'rgb(149,165,166)'
          ),
          array(
              'title'=>'Modern Orange',
              'color'=>'rgb(255,92,57)'
          ),
          array(
              'title'=>'Modern Teal',
              'color'=>'rgb(27,188,155)'
          ),
          array(
              'title'=>'Purple like Intero',
              'color'=>'rgb(122,0,61)'
          ),
          array(
              'title'=>'Red Like Remax',
              'color'=>'rgb(180,28,48)'
          ),
          array(
              'title'=>'Teal Like Exit',
              'color'=>'rgb(0,140,154)'
          ),
          array(
              'title'=>"Sotheby's Blue",
              'color'=>'rgb(0, 35, 73)'
          ),
          array(
              'title'=>'Realty World Red',
              'color'=>'rgb(239, 26, 44)'
          )
      );
      ?>
      <?php foreach($themeData as $row): ?>
    <div class="tile">
      <a class="tile-inner" href="<?php echo base_url('assets/images/flyer/theme/Prudential Blue.png') ?>">
        <img class="item" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo base_url('assets/images/flyer/theme/Prudential Blue.png') ?>" />
        <div class="caption-block">
            <div class="text-wrapper">
                <h4 class='title'><?php echo $row['title']; ?></h4>
<!--                <h5 class='subtitle'>Subtitle here</h5>-->
            </div>
         </div>
      </a>
      <div class="ftg-social">
          <!-- <a href="<?php echo site_url("user/download_flyer?theme=".$row['color']); ?>" class="download-flyer" data-social="Download" ><i class="fa fa-download"></i></a> -->
          <a href="<?php echo site_url("user/twoSide_flyer_download?theme=".$row['color']); ?>" class="download-flyer" data-social="Download" ><i class="fa fa-download"></i></a>
      </div>
    </div>
      <?php endforeach; ?>
  </div>
</div>

  </div>
</section>
<!-- Screenshots section -->
<script>
    $(".download-flyer").click(function(){
        var win = window.open($(this).attr("href"), '_blank');
        win.focus();
        return false;
    });
</script>