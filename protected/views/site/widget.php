<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
</head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<script type="text/javascript">
	// namespace
	var Paints = {
		widgetId: 'paint-widget',
		scriptRoot: 'http://paints/',
		listContainerId: 'paint-widget-list',
		listWidth: 800,
		printerId : 0,
		headId : 0
	}

	Paints.showLoader = function() {
		$('#paints-widget-loader').css('visibility', 'visible');
	}

	Paints.hideLoader = function() {
		$('#paints-widget-loader').css('visibility', 'hidden');
	}

	Paints.getPaints = function () {
		Paints.showLoader();
		$.ajax({
			url: Paints.scriptRoot + 'paint/search',
			data: {
				printer_id: Paints.printerId,
				head_id: Paints.headId
			},
			dataType: "json",
			success: function (data) {
				Paints.showList(data)
				Paints.hideLoader();
			},
			error: function (jqXHR, textStatus, errorThrown) {
				if (window.console) {
					console.log(textStatus, errorThrown);
				}
			}
		});
	}

	Paints.resetSearch = function() {
		this.printerId = 0;
		this.headId = 0;
		$('#printer-model-input').val('');
		$('#printer-brand-input').val('');
		$('#head-model-input').val('');
		$('#head-brand-input').val('');
		$('.suggestions').val('');

		$('#'+ Paints.listContainerId).fadeOut(function() {
			$(this).empty()
		});
	}

	Paints.showList = function (data) {
		var margin = 5,
			padding = 5,
			$container = $('#'+ Paints.listContainerId)

		var $list = $('<div></div>').css({ width : Paints.listWidth + 'px' });
		if(typeof data.paints != 'undefined') {
			for (var i in data.paints) {
				var paint = data.paints[i]
				var $item = $('<div style="clear: both;">' +
						'<div style="font: bold 14px Helvetica; margin: 10px 0;">' +
							paint.brand + ' / Class ' + paint.class.toUpperCase() +
						'</div>' +
					'</div>');
				var j = 0;
				for (var index in data.colors) {
					var color = data.colors[index]
					if(paint[color]) {
						var width = (Paints.listWidth / 4) - (margin + padding) * 4 ;
						var $paintImgDiv = $('<div></div>').css({
							width: width + 'px',
							float:'left',
							marginRight:margin + 'px',
							marginBottom:"10px",
							textAlign:'center',
							padding:padding + 'px',
							background:'#EEE',
							height:'150px',
							borderRadius:'5px',
							position: 'relative',
							overflow: 'hidden'
						}).html('<img src="' + Paints.scriptRoot + '/uploads/' + paint[color] + '" width="'+width+'" />');

						var $overlay = $("<div></div>").css({
							position: 'absolute',
							left: '40%',
							top: '40%',
							font: 'bold 20px Helvetica, Arial',
							color: '#333',
							zIndex: 999,
							textShadow: '1px 1px 1px white'
						}).html(color);

						$paintImgDiv.append($overlay)

						$item.append($paintImgDiv);
						$list.append($item);
						if (++j % 4 == 0)
							$list.append('<div style="clear:both"></div>')
					}
				}
			}
		}
		$container.hide()
			.html("<div><a href='#' onclick='Paints.resetSearch(); return false;'>Сброс</a></div>")
			.append($list)
			.fadeIn();
	}

	var mainInputStyles = {
		fontSize:'1.1em',
		color:'#333',
		border:'solid 1px #CCC',
		padding:'4px 6px',
		zIndex:-1,
		background:'transparent'
	}

	var suggestionInputStyles = {
		position:'absolute',
		fontSize:'1.1em',
		top:0,
		left:0,
		borderColor: 'transparent',
		padding:'4px 6px',
		color:'#CCC',
		zIndex:-10
	}

	var inputs = [
		$('<input type="text" id="printer-brand-input" />').css(mainInputStyles).attr('placeholder', 'Бренд принтера').attr('data-for', 'printer-brand'),
		$('<input type="text" class="model" id="printer-model-input" />').css(mainInputStyles).attr('placeholder', 'Модель принтера').attr('data-for', 'printer-model'),
		$('<input type="text" id="head-brand-input" />').css(mainInputStyles).attr('placeholder', 'Бренд головки').attr('data-for', 'head-brand'),
		$('<input type="text" class="model" id="head-model-input" />').css(mainInputStyles).attr('placeholder', 'Модель головки').attr('data-for', 'head-model')
	]


	/**
	 * Document ready code
	 */
	$(function() {
		$('meta[name=description]').remove();
		$('head').append( '<meta name="description" content="this is new">' );
		// appending inputs to the widget main div
		for (var i = 0; i < inputs.length; i++) {
			var $input = inputs[i];
			var $widgetDiv = $('#' + Paints.widgetId);
			var $suggestions = $('<input type="text" class="suggestions" />').css(suggestionInputStyles);
			$('<div style="float: left; margin-right: 5px; position: relative;"></div>"')
				.append($input)
				.append($suggestions)
				.appendTo($widgetDiv);

			$input.bind('keyup', function (event) {
				var $this = $(this);
				var $el = $this.parent().children('.suggestions');
				if (this.value == '')
					$el.val('');
			});
		}
		$widgetDiv
			.append("<div id='paints-widget-loader' style='clear: both; visibility: hidden; height: 20px; background: url(" + Paints.scriptRoot + "images/loader.gif) no-repeat;'></div>")
			.append("<div id='" + Paints.listContainerId +"'></div>")

		/**
		 * Init autocompletes
		 */
		var $printerBrandInput = inputs[0];
		var $printerModelInput = inputs[1];
		var $headBrandInput = inputs[2];
		var $headModelInput = inputs[3];
		/**
		 * Options for brand input autocomplete
		 * @type {Object}
		 */
		var brandSearch = {
			autoFocus:true,
			delay:100,
			minLength:1,
			source:function (request, response) {
				var $el = this.element.parent().children('.suggestions');
				var url = this.element.attr('id') == 'printer-brand-input' ? 'printerBrandSearch' :
					this.element.attr('id') == 'head-brand-input' ? 'headBrandSearch' : null;
				if(!url)
					return false;

				$.getJSON(
					Paints.scriptRoot + 'site/' + url , { term: request.term },
					function (data) {
						if(data && data.length == 1) {
							$el.val(data[0].suggestion);
						}
					}
				);
			}
		}
		/**
		 * Options for model autocomplete
		 * Should use previously selected brand for searching
		 * @type {Object}
		 */
		var modelSearch = {
			autoFocus:true,
			delay:100,
			minLength:1,
			source:function (request, response) {
				var url, brand, item;
				var $el = this.element.parent().children('.suggestions');
				if(this.element.attr('id') == 'printer-model-input') {
					item = 'printer';
					url = Paints.scriptRoot + 'site/printerModelSearch';
					brand = $printerBrandInput.val()
				} else if(this.element.attr('id') == 'head-model-input') {
					item = 'head';
					url = Paints.scriptRoot + 'site/headModelSearch';
					brand = $headBrandInput.val();
				}

				if(!url || !brand) {
					alert('Сначала нужно выбрать бренд');
					return false;
				}


				$.getJSON(
					url, { brand: brand, term: request.term },
					function (data) {
						if(data && data.length == 1) {
							$el.val(data[0].suggestion);
							if(item == 'printer')
								Paints.printerId = data[0].id
							else
								Paints.headId = data[0].id
						}
					}
				);
			}
		}
		/**
		 * Key down handler for inputs:
		 * On tab or Right Arrow set input's value to the given suggestion and
		 * display the list of paints available
		 * @param event
		 */
		var keyDownHandler = function (event) {
			if (event.keyCode === $.ui.keyCode.TAB || event.keyCode == 39) {
				event.preventDefault();
				var $this = $(this);
				var $el = $this.parent().children('.suggestions');
				$this.val($el.val());
				if($this.is('#printer-model-input') || $this.is('#head-model-input')) {
					Paints.getPaints();
				} else {
					if($this.is('#printer-brand-input'))
						$printerModelInput.focus();
					else if($this.is('#head-brand-input'))
						$headModelInput.focus();
				}
			}
		}


		/**
		 * Event binding code
		 */

		// Brands search autocomplete
		$printerBrandInput.autocomplete(brandSearch);
		$headBrandInput.autocomplete(brandSearch);

		// Model search autocomplete
		$headModelInput.autocomplete(modelSearch);
		$printerModelInput.autocomplete(modelSearch);

		// Keydown handlers
		$headModelInput.bind('keydown', keyDownHandler);
		$printerModelInput.bind('keydown', keyDownHandler);
		$headBrandInput.bind('keydown', keyDownHandler);
		$printerBrandInput.bind('keydown', keyDownHandler);

		$printerBrandInput.change(function() {
			$printerModelInput.val('');
		});

		$headBrandInput.change(function() {
			$headModelInput.val('');
		});
	})
	/**
	 * End of document ready
	 */
</script>

<div id="paint-widget"></div>