<style type="text/css">

.btn-tools {
  background: none repeat scroll 0 0 #fafafa;
  border: 1px solid #ccc;
  margin: 0 -15px 10px;
  padding: 10px 0;
  border-right: none;
  border-left: none;
}
.btn-tools .row {
margin: 5px 0;
}
.well-line {
padding: 10px;
background: #fafafa;
border-top: 1px solid #ccc;
}
canvas{border: 1px solid #ccc;}
</style>
<ul class="breadcrumb">
  <li><a href="<?php echo base_url(); ?>index.php?/admin/dashboard">Dashboard</a></li>
  <li class="active">Manage Product</li>
</ul>
<div class="clearfix"></div>
<div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title"><?php if(!empty($products)){ echo 'Edit';}else{ echo 'Add New';} ?> Product
    
    </h4>
  </div>
  <div class="" id="">
    <div class="panel-body">
      <form action="" method="POST" role="form" id="product_<?php if(!empty($products)){ echo 'edit';}else{ echo 'add';} ?>">
        <div class="col-md-4">
          <div class="form-group">
            <input type="text" name="pid" class="hidden" value="<?php if(!empty($products)){ echo $products[0]->product_id_pk;}?>">
            <input type="text" class="form-control" id="pname" name="pname" placeholder="Product Name" value="<?php if(!empty($products)){ echo $products[0]->product_name;}else{ echo '';} ?>">
          </div>
         
        </div>
        <div class="col-md-4">
          <div class="form-group">
              <select class="input-large form-control" name="cname" id="cname">
                <option value="">Choose a Category</option>
                <?php
                foreach ($category as $value) {
                ?>
                <option value="<?php echo $value->category_id_pk;?>" <?php if(!empty($products)){ if($products[0]->category_id_fk == $value->category_id_pk){echo 'selected';} } ?> ><?php echo $value->category_name; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
        </div>

        <div class="col-md-4 form-group input-group">
          <input  type="text" placeholder="click to Show Date"  id="" class="form-control datepicker-default datepicker" name="adddate">
          <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
        </div>

        
        <div class="col-md-4">
          <div class="form-group">
            <input type="text" class="form-control" id="dname" name="dname" placeholder="Description" value="<?php if(!empty($products)){ echo $products[0]->product_desc;}else{ echo '';} ?>">            
          </div>
        </div>

        <div class="col-md-4">
       
          <div class="row">
            <div class="col-sm-5">
              <b>Upload Flyer <i class="fa fa-upload"></i></b>
            </div><div class="col-sm-7">
           <input type="file" name="files" id="filePhoto">

            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        
      </div>
    </div>
    
    <section class="panel-body">
      <div class="btn-tools">
        <div class="row ">
          <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
            
            <button type="button" class="btn btn-primary " ng-click="addText()"><i class="fa fa-font"></i></button>
            <button type="button" class="btn image1 btn-primary " ng-click="insert_image_admin()"><i class="fa fa-image"></i></button>
            <input type="file" id="logoToUpload" class="hidden" onchange="angular.element(this).scope().upload_image()" />
            <button type="button" class="btn btn-object-action btn-primary"
            ng-click="toggleBold()"
            ng-class="{'btn-inverse': isBold()}">
            <i class="fa fa-bold"></i>
            </button>
            <button type="button" class="btn btn-object-action btn-primary " id="text-cmd-italic"
            ng-click="toggleItalic()"
            ng-class="{'btn-inverse': isItalic()}">
            <i class="fa fa-italic"></i>
            </button>
            <button type="button" class="btn btn-object-action btn-primary " id="text-cmd-underline"
            ng-click="toggleUnderline()"
            ng-class="{'btn-inverse': isUnderline()}">
            <i class="fa fa-underline"></i>
            </button>
            <button type="button" class="btn btn-object-action btn-primary " id="text-cmd-linethrough"
            ng-click="toggleLinethrough()"
            ng-class="{'btn-inverse': isLinethrough()}">
            <i class="fa fa-strikethrough"></i>
            </button>
             <button type="button" class="btn btn-primary rect" ng-click="addRect()">Rectangle</button>
            <button type="button" class="btn btn-primary circle" ng-click="addCircle()">Circle</button>
            <button type="button" class="btn btn-primary triangle" ng-click="addTriangle()">Triangle</button>
            <button type="button" class="btn btn-primary line" ng-click="addLine()">Line</button>
            <button type="button" class="btn btn-primary polygon" ng-click="addPolygon()">Polygon</button>
            
            
          </div>
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-right">
            
            <button type="button" class="btn btn-danger btn-sm clear" ng-click="confirmClear()"><i class="fa fa-times"></i> Reset Flyer</button>
            <button type="button" class="btn btn-object-action btn-sm btn-danger" id="remove-selected"
            ng-click="removeSelected()">
            <i class="fa fa-times"></i> Remove selected object
            </button>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            
            <button type="button" class="btn btn-lock btn-object-action btn-primary"
            ng-click="setHorizontalLock(!getHorizontalLock())"
            ng-class="{'btn-inverse': getHorizontalLock()}">
            <i class="fa fa-lock" ng-class="{true:'fa-unlock-alt',false:'fa-lock'}[getHorizontalLock()]"></i>  Horizontal movement
            </button>
            
            <button type="button" class="btn btn-lock btn-object-action btn-primary"
            ng-click="setVerticalLock(!getVerticalLock())"
            ng-class="{'btn-inverse': getVerticalLock()}">
            <i class="fa fa-lock" ng-class="{true:'fa-unlock-alt',false:'fa-lock'}[getVerticalLock()]"></i>  Vertical movement
            </button>
            
            <button type="button" class="btn btn-lock btn-object-action btn-primary"
            ng-click="setScaleLockX(!getScaleLockX())"
            ng-class="{'btn-inverse': getScaleLockX()}">
            <i class="fa fa-lock" ng-class="{true:'fa-unlock-alt',false:'fa-lock'}[getScaleLockX()]"></i> Horizontal scaling
            </button>
            
            <button type="button" class="btn btn-lock btn-object-action btn-primary"
            ng-click="setScaleLockY(!getScaleLockY())"
            ng-class="{'btn-inverse': getScaleLockY()}">
            
            <i class="fa fa-lock" ng-class="{true:'fa-unlock-alt',false:'fa-lock'}[getScaleLockY()]"></i> Vertical scaling'
            </button>
            
            <button type="button" class="btn btn-lock btn-object-action btn-primary"
            ng-click="setRotationLock(!getRotationLock())"
            ng-class="{'btn-inverse': getRotationLock()}">
            
            <i class="fa fa-lock" ng-class="{true:'fa-unlock-alt',false:'fa-lock'}[getRotationLock()]"></i> Rotation
            </button>
          </div>
          <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
            
            <button type="button" class="btn btn-lock btn-object-action btn-primary"
            ng-click="setAllUnLock()"
            >
            Apply Lock
            </button>
            
            <button type="button" class="btn btn-lock btn-object-action btn-primary"
            ng-click="setAllLock()">
            Apply Unlock
            </button>
            
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <button type="button" id="send-backwards" class="btn btn-object-action btn-primary"
            ng-click="sendBackwards()">Send backwards</button>
            <button type="button" id="send-to-back" class="btn btn-object-action btn-primary"
            ng-click="sendToBack()">Send to back</button>
            <button type="button" id="bring-forward" class="btn btn-object-action btn-primary"
            ng-click="bringForward()">Bring forwards</button>
            <button type="button" id="bring-to-front" class="btn btn-object-action btn-primary"
            ng-click="bringToFront()">Bring to front</button>
          </div>
        
          
          
          
          
          
        </div>
        </div>
        
        <div class="clearfix">
        </div>
        <div class="clearfix">
          <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="border: 1px solid rgb(204, 204, 204); padding: 10px; background: none repeat scroll 0% 0% rgb(253, 253, 253);">
          <div class="form-group">
            <label for="canvas-background-picker">Canvas background:</label>
            <input type="color" bind-value-to="canvasBgColor">
          </div>
            <div class="form-group">
              <label for="opacity">Opacity: </label>
              <input value="100" type="range" bind-value-to="opacity">
            </div>
            <div class="form-group">
              <label  for="color" style="margin-left:10px">Color: </label>
              <input type="color" style="width:40px" bind-value-to="fill">
            </div>
            <div class="form-group" ng-show="getText()">
              <label for="font-family" style="display:inline-block">Font family:</label>
              <select id="font-family" class="btn-object-action form-control" bind-value-to="fontFamily">
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
              <br>
              <label for="text-align" style="display:inline-block">Text align:</label>
              <select id="text-align" class="btn-object-action form-control" bind-value-to="textAlign">
                <option>Left</option>
                <option>Center</option>
                <option>Right</option>
                <option>Justify</option>
              </select>
              
            </div>
            <div class="form-group" ng-show="getText()" >
              <label>Edit Your Text</label>
              <textarea bind-value-to="text" class="form-control" rows="5"></textarea>
            </div>
            <div class="form-group" ng-show="getText()">
              <label for="text-bg-color">Background color:</label>
              <input type="color" value="" id="text-bg-color" size="10" class="btn-object-action"
              bind-value-to="bgColor">
            </div>
            <div class="form-group" ng-show="getText()">
              <label for="text-lines-bg-color">Background text color:</label>
              <input type="color" value="" id="text-lines-bg-color" size="10" class="btn-object-action"
              bind-value-to="textBgColor">
            </div>
            <div class="form-group" ng-show="getText()">
              <label for="text-stroke-color">Stroke color:</label>
              <input type="color" value="" id="text-stroke-color" class="btn-object-action"
              bind-value-to="strokeColor">
            </div>
            <div class="form-group" ng-show="getText()">
              <label for="text-stroke-width">Stroke width:</label>
              <input type="range" value="1" min="1" max="5" id="text-stroke-width" class="btn-object-action"
              bind-value-to="strokeWidth">
            </div>
            <div class="form-group" ng-show="getText()">
              <label for="text-font-size">Font size:</label>
              <input type="range" value="" min="1" max="120" step="1" id="text-font-size" class="btn-object-action"
              bind-value-to="fontSize">
            </div>
            <div class="form-group" ng-show="getText()">
              <label for="text-line-height">Line height:</label>
              <input type="range" value="" min="0" max="10" step="0.1" id="text-line-height" class="btn-object-action"
              bind-value-to="lineHeight">
            </div>
            <div class="form-group">
              
            </div>
          </div>
          <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
            <canvas id="canvas" width="816" height="1054"></canvas>
          </div>

        </div>
        <div class="panel-body">
          <button type="submit" class="btn btn-primary "><?php if(!empty($products)){ echo 'Update';}else{ echo 'Add';} ?> Product</button> 
          <!--  ng-click="add_product()" -->
        </div>
     
        
        
      </div>
      <div class="col-md-2">
        
      </div>
      
    </form>
    <div class="clearfix">
      
    </div>
 <!--  </section> -->
</div>
</div>
</div>
</div>
<script>
var flayer_content;
<?php
if(!empty($products)){
echo 'flayer_content ='. $products[0]->product_content.';';
}
?>
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