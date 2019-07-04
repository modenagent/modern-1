$(function () {
	$(".open-tooltip").tooltip();
	$("[data-toggle=collapse]").click(function( ev ) {
	   ev.preventDefault();
	   $(this).find(".fa-plus-square").toggleClass("fa-minus-square");
	 });
	 
	 $(".btn-add-stock").click(function(){
		$("#add-stock").toggle("slow");
	});
	$("#add-stock .btn-close").click(function(){
		$("#add-stock").toggle("slow");
	});
	
	$(".portfolio-list").on('click', 'li a', function(){
		$(".btn .portfolio-type").text($(this).text());
		$(".btn .portfolio-type").val($(this).text());
	});

	$(".performance-list").on('click', 'li a', function(){
		$(".btn .performance-type").text($(this).text());
		$(".btn .performance-type").val($(this).text());
	});
	
	var curd = new Date(),
	hh = curd.getHours(),
	mm = curd.getMinutes();
	var date = $.datepicker.formatDate('M dd,  yy', new Date());
	
	$(".datetime").html(date + " " + hh+":"+mm);
	
	$('.datepicker-default').datepicker({
		showOn: "both",
		buttonImage: "images/sort_asc",
		buttonImageOnly: true
	});
    

    //BEGIN COUNTER FOR SUMMARY BOX
    /*counterNum($(".profit h4 span:first-child"), 289, 112, 1, 50);
    counterNum($(".income h4 span:first-child"), 636, 812, 1, 50);
    counterNum($(".task h4 span:first-child"), 103, 155 , 1, 100);
    counterNum($(".visit h4 span:first-child"), 310, 376, 1, 500);*/
    function counterNum(obj, start, end, step, duration) {
        $(obj).html(start);
        setInterval(function(){
            var val = Number($(obj).html());
            if (val < end) {
                $(obj).html(val+step);
            } else {
                clearInterval();
            }
        },duration);
    }
    //END COUNTER FOR SUMMARY BOX

});

/*Custom Combobox*/
(function( $ ) {
	$.widget( "custom.combobox", {
		_create: function() {
			this.wrapper = $( "<div>" )
			.addClass( "custom-combobox input-group")
			.insertAfter( this.element );
			this.element.hide();
			this._createAutocomplete();
			this._createShowAllButton();
		},
		_createAutocomplete: function() {
			var selected = this.element.children( ":selected" ),
			value = selected.val() ? selected.text() : "";
			this.input = $( "<input>" )
			.appendTo( this.wrapper )
			.val( value )
			.attr( "title", "" )
			.addClass( "form-control" )
			.autocomplete({
				delay: 0,
				minLength: 0,
				source: $.proxy( this, "_source" )
			})
			.tooltip({
				tooltipClass: "ui-state-highlight"
			});
			this._on( this.input, {
				autocompleteselect: function( event, ui ) {
					ui.item.option.selected = true;
					this._trigger( "select", event, {
					item: ui.item.option
				});
			},
			autocompletechange: "_removeIfInvalid"
			});
		},
		_createShowAllButton: function() {
			var input = this.input,
			wasOpen = false;
			$("<a><i class='fa fa-caret-down'></i>")
			.attr( "tabIndex", -1 )
			//.attr( "title", "Show All Items" )
			.tooltip()
			.appendTo( this.wrapper )
			
			.removeClass( "ui-corner-all" )
			.addClass( "custom-combobox-toggle ui-corner-right" )
			.mousedown(function() {
				wasOpen = input.autocomplete( "widget" ).is( ":visible" );
			})
			.click(function() {
			input.focus();
			// Close if already visible
			if ( wasOpen ) {
				return;
			}
			// Pass empty string as value to search for, displaying all results
			input.autocomplete( "search", "" );
			});
		},
		_source: function( request, response ) {
			var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
			response( this.element.children( "option" ).map(function() {
			var text = $( this ).text();
			if ( this.value && ( !request.term || matcher.test(text) ) )
			return {
			label: text,
			value: text,
			option: this
			};
			}) );
		},
		_removeIfInvalid: function( event, ui ) {
		// Selected an item, nothing to do
		if ( ui.item ) {
		return;
		}
		// Search for a match (case-insensitive)
		var value = this.input.val(),
		valueLowerCase = value.toLowerCase(),
		valid = false;
		this.element.children( "option" ).each(function() {
		if ( $( this ).text().toLowerCase() === valueLowerCase ) {
		this.selected = valid = true;
		return false;
		}
		});
		// Found a match, nothing to do
		if ( valid ) {
		return;
		}
		// Remove invalid value
		this.input
		.val( "" )
		.attr( "title", value + " didn't match any item" )
		.tooltip( "open" );
		this.element.val( "" );
		this._delay(function() {
		this.input.tooltip( "close" ).attr( "title", "" );
		}, 2500 );
		this.input.autocomplete( "instance" ).term = "";
		},
		_destroy: function() {
		this.wrapper.remove();
		this.element.show();
		}
	});
})( jQuery );
$(function() {
	$(".form-combobox").combobox();
});

$(document).on("change", function(){
	$(".form-combobox").combobox();	
});

