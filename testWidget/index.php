<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript" src="cma.js"></script>
		<style type="text/css">
		#widget-loader {
		    left: 45%;
		    right: 0;
		    position: absolute;
		    top: 40%;
		}
		.loader {
			border: 16px solid #f3f3f3; /* Light grey */
			border-top: 16px solid #ababab;/*#3498db;*/ /* Blue */
			border-radius: 50%;
			width: 120px;
			height: 120px;
			animation: spin 2s linear infinite;
			text-align: center;
		}
		@keyframes spin {
			0% { transform: rotate(0deg); }
			100% { transform: rotate(360deg); }
		}
		</style>
	</head>
	<body>
		<div id="cma-widget-container" style="margin: 0 auto;max-width: 95%;display:none;"></div>
		<div id="widget-loader">
			<div class="loader"></div> 
		</div> 
	</body>
</html>