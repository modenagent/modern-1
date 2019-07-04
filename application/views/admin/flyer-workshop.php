<!--extra css added for customization -->
<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>assets/css/editing-tool.css">

<link rel="stylesheet" href="<?php echo site_url(); ?>assets/editor/css/master.css">
<link rel="stylesheet" href="<?php echo site_url(); ?>assets/editor/css/prism.css">
<!-- cusotme plugins css for  tool -->
<!-- js -->
<!-- script js -->
<script src="<?php echo site_url(); ?>assets/editor/js/paster.js"></script>
<script src="<?php echo site_url(); ?>assets/editor/js/jquery.mousewheel.min.js"></script>
<script src="<?php echo site_url(); ?>assets/editor/js/font_definitions.js"></script>

<!-- plugins ends -->
<section class="wrapper"  >
    <!-- page start-->
    <!--  <div class="container">
        <ul class="breadcrumb">
            <li> <a href="<?php echo site_url(); ?>user/dashboard">Dashboard</a> </li>
            <li> <a class="current" href="javascript:;">Flyer Workshop</a> </li>
        </ul>
    </div> -->
    <section class="workshop">

       <!-- <form action="" method="POST" role="form" id="product_add"> -->
            <legend>Add New Product</legend>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="pname" name="pname" placeholder="Product Name">
                </div>
                <div class="form-group">
                    <select class="combobox input-large form-control" name="cname" id="cname">
                        <option value="">Choose a Category</option>
                        <?php 
                        foreach ($category as $value) {
                        ?>
                        <option value="<?php echo $value->category_id_pk;?>"><?php echo $value->category_name; ?></option>
                        <?php    
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6 form-group input-group">                            
                <input  type="text" placeholder="click to Show Date"  id="" class="form-control datepicker-default datepicker" name="adddate">
                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            </div>
            <span class="help-block"></span>
            <div class="col-md-4">         

                <div class="fileupload-buttonbar">
                    <div class="fileupload-buttons">
                        <!-- The fileinput-button span is used to style the file input field as button -->
                        <span class="fileinput-button">
                            <span class="btn btn-info btn-sm">Upload Flyer <i class="fa fa-upload"></i></span>
                            <input type="file" name="files" id="filePhoto">
                        </span>
                        <span class="fileupload-process"></span>
                    </div>
                    <!-- The global progress state -->
                    <div class="fileupload-progress fade" style="display:none">
                        <!-- The global progress bar -->
                        <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        <!-- The extended global progress state -->
                        <div class="progress-extended">&nbsp;</div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        <div class="main-warp-tool" id="canvas-wrapper">
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 sidebar-app-tool">
                <div class="panel ">
                    <!-- tabs left -->
                    <div class="tabbable tabs-left">
                        <ul class="nav nav-tabs">
                            <!-- <li class="active"><a href="#a" data-toggle="tab"> <i class="fa fa-file fa-2x"></i> Project</a> </li> -->
                            <!--   <li> <a href="#b" data-toggle="tab"> <i class="fa fa-tint fa-2x"></i> colors </a> </li> -->
                            <li> <a href="#c" data-toggle="tab"> <i class="fa fa-plus-square fa-2x"></i> Insert </a> </li>
                            <li> <a href="#d" data-toggle="tab" > <i class="fa fa-check fa-2x"></i> Finish </a> </li>
                            <!-- <li> <a href="#e" data-toggle="tab"> <i class="fa fa-info fa-2x"></i> Help </a> </li> -->
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active fade in" id="a">
                                <h2><?php echo $project_name; ?></h2>
                                <small><?php echo $category_name; ?></small>
                                <hr>
                                <!--  <div class="clearfix">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center"> <a href="javascript:;" class="box"> <i class="fa fa-angle-left"></i> Front Side </a> <a href="javascript:;" class="text-danger"> <small> Remove <i class="fa fa-times"></i> </small> </a> </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center"> <a href="javascript:;" class="box"> <i class="fa fa-angle-right"></i> Back Side </a> <a href="javascript:;" class="text-danger"> <small> Remove <i class="fa fa-times"></i> </small> </a> </div>
                                </div>
                                <hr> -->
                                <p align="center">Not Happy with the flyer?</p>
                                <a href="<?php echo site_url();?>user/flyer_category/<?php echo $projectId; ?>" class="btn btn-warning btn-lg btn-block"> <i class="fa fa-search"></i>&nbsp; Change Flyer </a>
                                <div class="clearfix">
                                    
                                </div>
                            </div>
                            
                            <div id="c" class="tab-pane fade ">
                               <div class="card-block" >

                                    <a class="" ng-click="addText()" style="cursor:pointer;">
                                        <div class="row">
                                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"> <i class="fa fa-font fa-3x"></i> </div>
                                             <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8"> Add Text <small>Insert text</small> </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="card-block" >

                                    <a class=""  href="#picture" data-toggle="modal"  >
                                        <div class="row">
                                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"> <i class="fa fa-image fa-3x"></i> </div>
                                             <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8"> Insert picure <small>choose picure</small> </div>
                                        </div>
                                    </a>
                                </div>
                              
                               

                              
                                <div class="card-block"> 
                                    <a class=""  data-toggle="modal" href='#partner' >
                                        <div class="row">
                                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"> <i class="fa fa-user fa-3x"></i> </div>
                                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8"> Insert Partner <small>name, Details etc.</small> </div>
                                        </div>
                                    </a> 
                                </div>
                                
                          <div class="clearfix" ng-show="canvas.getActiveObject()">
                          
                         
                          <hr>
                          <p>Edit Your Text</p>
                                    <textarea bind-value-to="text" class="form-control" rows="5"></textarea>
                                    <div class="clearfix">
                                        <p></p>
                                    </div>
                                    <p>Set Positions</p>
                                    <button id="send-backwards" class="btn btn-primary btn-sm  btn-block btn-object-action"
            ng-click="sendBackwards()">Send backwards</button>

          <button id="send-to-back" class="btn btn-primary btn-sm  btn-block  btn-object-action"
            ng-click="sendToBack()">Send to back</button>

             <button id="bring-forward" class="btn btn-primary btn-sm  btn-block  btn-object-action"
            ng-click="bringForward()">Bring forwards</button>

          <button id="bring-to-front" class="btn btn-primary btn-sm  btn-block  btn-object-action"
            ng-click="bringToFront()">Bring to front</button>
                              
                            </div>
                            <p></p>
                             <button class="btn btn-danger btn-block clear" ng-click="confirmClear()">Clear canvas</button>
                             </div>


                            <div class="tab-pane fade" id="d">
                                <!-- card -->
                                <div class="card">
                                    <div class="card-icon btn-success"> <span class="fa fa-2x fa-download"></span> </div>
                                    <div class="info">
                                        <h4 class="text-center">EXPORT PDF</h4>
                                        <p> Finish your project to download </p>
                                        <a href="javascript:;" class="btn btn-success btn-block" ng-click="finish_flayer('<?php echo $productId; ?>','<?php echo $projectId; ?>')" >Finish</a> <!-- onclick="flyer_cart('<?php echo $productId; ?>','<?php echo $projectId; ?>');" -->
                                        <a href="javascript:;" class="btn btn-success btn-block" ng-click="loadSVGWithoutGrouping2(SVGCONTENT)" >SVGCONTENT</a> <!-- onclick="flyer_cart('<?php echo $productId; ?>','<?php echo $projectId; ?>');" -->
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-icon btn-danger"> <span class="fa fa-2x fa-save"></span> </div>
                                    <div class="info">
                                        <h4 class="text-center">Save Your project</h4>
                                        <p> save your project as draft to print in future </p>
                                        <a href="javascript:;" class="btn btn-danger btn-block" id="savedraft">Save</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- editor start here -->
            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 frame-plate-app-tool" id="text-wrapper">

                <div class="btn-toolbar "  id="text-controls">
                    <div class="pull-left"  id="text-controls-additional">
                        
                        <button type="button" class="btn btn-object-action btn-sm btn-primary"
                        ng-click="toggleBold()"
                        ng-class="{'btn-inverse': isBold()}">
                        <i class="fa fa-bold"></i>
                        </button>
                        <button type="button" class="btn btn-object-action btn-sm btn-primary" id="text-cmd-italic"
                        ng-click="toggleItalic()"
                        ng-class="{'btn-inverse': isItalic()}">
                        <i class="fa fa-italic"></i>
                        </button>
                        <button type="button" class="btn btn-object-action btn-sm btn-primary" id="text-cmd-underline"
                        ng-click="toggleUnderline()"
                        ng-class="{'btn-inverse': isUnderline()}">
                        <i class="fa fa-underline"></i>
                        </button>
                    </div>

                <div class="pull-left">
                    <select id="font-family" class="btn-object-action btn btn-primary btn-sm" bind-value-to="fontFamily">
                        <option value="arial">Arial</option>
                        <option value="helvetica" selected>Helvetica</option>
                        <option value="myriad pro">Myriad Pro</option>
                        <option value="delicious">Delicious</option>
                        <option value="verdana">Verdana</option>
                        <option value="georgia">Georgia</option>
                        <option value="courier">Courier</option>
                        <option value="comic sans ms">Comic Sans MS</option>
                        <option value="impact">Impact</option>
                        <option value="monaco">Monaco</option>
                        <option value="optima">Optima</option>
                        <option value="hoefler text">Hoefler Text</option>
                        <option value="plaster">Plaster</option>
                        <option value="engagement">Engagement</option>
                    </select>
                    <select ng-show="canvas.getActiveObject()"  class="btn-object-action  btn btn-primary btn-sm" bind-value-to="textAlign">
                        <option>Left</option>
                        <option>Center</option>
                        <option>Right</option>
                        <option>Justify</option>
                    </select>
                </div>
                    <div  id="color-opacity-controls" ng-show="canvas.getActiveObject()" class="pull-left">
                    <label>Text Color</label>
                        <input type="color"   bind-value-to="fill">&nbsp;
                         <label>Text Background</label>
                        <input type="color" value="" id="text-bg-color"  class="btn-object-action "
                        bind-value-to="bgColor">
                    </div>
                    
                    
                        
                         
                            
                     <div class="pull-right" id="canvas-background">
                        
                        <label for="canvas-background-picker">Canvas background:</label>
                        <input type="color" bind-value-to="canvasBgColor">
                    </div> 

                    <div class="object-controls pull-left" object-buttons-enabled="getSelected()">
                        
                        <button class="btn btn-danger btn-sm btn-object-action" id="remove-selected"
              ng-click="removeSelected()">
              <i class="fa fa-times"></i> Remove
            </button>
                    </div> 
                    
                    
                </div>
                <div class="clearfix">
                
                </div>
                <div class="row">
                    <canvas id="canvas" width="991" height="600"></canvas>
                    
                    <!--   <div class="edit-wrapper" id="edit-wrapper">
                        <div id="alerts"></div>
                        <textarea class="summernote" name="flayerhtml">
                        <div class="flyer-body">
                            <?php echo $flyerhtml; ?>
                        </div>
                        </textarea>
                    </div> -->
                </div>
                <!-- editor ends here -->
            </div>
        </div>
    </section>
    <!-- page endUAE
</section>
<div class="clearfix"></div>
-->
<div class="modal fade" id="picture">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" >
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">Insert Image</h4>
            </div>

                          
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <div class=" radio ">
                                <label >
                                    <input type="radio" name="qr" id="input" value="true" ng-model="img_type" ng-change="image_type_changed('file')">
                                 Browse Image
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <div class=" radio ">
                                <label >
                                    <input type="radio" name="qr" id="input" value="false"  ng-model="img_type" checked="checked" ng-change="image_type_changed('url')"> 
                                Image Url {{image_type}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <input type="text" class="form-control" placeholder="Enter URL" ng-model="imageurl" ng-show="img_type=='url'">
                    <input type="file" id="logoToUpload" placeholder="Browse Image" class="form-control" ng-show="img_type=='file'">
                    <div class="clearfix"></div>
                </form>
            </div>

                                                
                                        
                
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" ng-click="insert_image()">Add Image</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                             
                                <!-- /.modal -->
                                <!-- /.modal-qr-code -->
                         
                                <!-- / end modal-qr-code -->
                                <div class="modal fade" id="partner">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Add Partner</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal">
                                                    
                                                    
                                                    
                                                    <div class="form-group">
                                                        <label class="col-sm-4">first name</label>
                                                        <div class="col-sm-8 ">
                                                            <input type="text" name="" id="input" class="form-control" value="" required="required" pattern="" title="" ng-model="partner.firstname">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-4">Last name</label>
                                                        <div class="col-sm-8 ">
                                                            <input type="text" name="" id="input" class="form-control" value="" required="required" pattern="" title=""  ng-model="partner.lastname">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-4">Title & License</label>
                                                        <div class="col-sm-8 ">
                                                            <input type="text" name="" id="input" class="form-control" value="" required="required" pattern="" title=""  ng-model="partner.license">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        
                                                        
                                                        <label class="col-sm-4">Phone</label>
                                                        <div class="col-sm-8 ">
                                                            <input type="text" name="" id="input" class="form-control" value="" required="required" pattern="" title=""  ng-model="partner.phone">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-4">E-mail</label>
                                                        <div class="col-sm-8 ">
                                                            <input type="text" name="" id="input" class="form-control" value="" required="required" pattern="" title=""  ng-model="partner.email">
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    
                                                    <div class="form-group">
                                                        <label class="col-sm-4">Company</label>
                                                        <div class="col-sm-8 ">
                                                            <input type="text" name="" id="input" class="form-control" value="" required="required" pattern="" title=""  ng-model="partner.company">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" ng-click="add_partner()">Save changes</button>
                                            </div>
                                            </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                          
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- loader -->
                                        <div id="addWait" class="page-loading"></div>
                                        <script>
                                        var kitchensink = { };
                                        var canvas = new fabric.Canvas('canvas');
                                        var SVGCONTENT = '';

                                        </script>
                                        <script src="<?php echo site_url(); ?>assets/editor/js/kitchensink/utils.js"></script>
                                        <script src="<?php echo site_url(); ?>assets/editor/js/kitchensink/app_config.js"></script>
                                        <script src="<?php echo site_url(); ?>assets/editor/js/kitchensink/controller.js"></script>
                                        <script>




  (function() {

    if (document.location.hash !== '#zoom') return;

    function renderVieportBorders() {
      var ctx = canvas.getContext();

      ctx.save();

      ctx.fillStyle = 'rgba(0,0,0,0.1)';

      ctx.fillRect(
        canvas.viewportTransform[4],
        canvas.viewportTransform[5],
        canvas.getWidth() * canvas.getZoom(),
        canvas.getHeight() * canvas.getZoom());

      ctx.setLineDash([5, 5]);

      ctx.strokeRect(
        canvas.viewportTransform[4],
        canvas.viewportTransform[5],
        canvas.getWidth() * canvas.getZoom(),
        canvas.getHeight() * canvas.getZoom());

      ctx.restore();
    }

    $(canvas.getElement().parentNode).on('mousewheel', function(e) {

      var newZoom = canvas.getZoom() + e.deltaY / 300;
      canvas.zoomToPoint({ x: e.offsetX, y: e.offsetY }, newZoom);

      renderVieportBorders();

      return false;
    });

    var viewportLeft = 0,
        viewportTop = 0,
        mouseLeft,
        mouseTop,
        _drawSelection = canvas._drawSelection,
        isDown = false;

    canvas.on('mouse:down', function(options) {
      isDown = true;

      viewportLeft = canvas.viewportTransform[4];
      viewportTop = canvas.viewportTransform[5];

      mouseLeft = options.e.x;
      mouseTop = options.e.y;

      if (options.e.altKey) {
        _drawSelection = canvas._drawSelection;
        canvas._drawSelection = function(){ };
      }

      renderVieportBorders();
    });

    canvas.on('mouse:move', function(options) {
      if (options.e.altKey && isDown) {
        var currentMouseLeft = options.e.x;
        var currentMouseTop = options.e.y;

        var deltaLeft = currentMouseLeft - mouseLeft,
            deltaTop = currentMouseTop - mouseTop;

        canvas.viewportTransform[4] = viewportLeft + deltaLeft;
        canvas.viewportTransform[5] = viewportTop + deltaTop;

        canvas.renderAll();
        renderVieportBorders();
      }
    });

    canvas.on('mouse:up', function() {
      canvas._drawSelection = _drawSelection;
      isDown = false;
    });
  })();

</script>

    </div>

    <script>
      (function(){
        var mainScriptEl = document.getElementById('main');
        if (!mainScriptEl) return;
        var preEl = document.createElement('pre');
        var codeEl = document.createElement('code');
        codeEl.innerHTML = mainScriptEl.innerHTML;
        codeEl.className = 'language-javascript';
        preEl.appendChild(codeEl);
        document.getElementById('bd-wrapper').appendChild(preEl);
      })();
    </script>

    <script>
(function() {
  fabric.util.addListener(fabric.window, 'load', function() {
    var canvas = this.__canvas || this.canvas,
        canvases = this.__canvases || this.canvases;

    canvas && canvas.calcOffset && canvas.calcOffset();

    if (canvases && canvases.length) {
      for (var i = 0, len = canvases.length; i < len; i++) {
        canvases[i].calcOffset();
      }
    }
  });
})();
</script>