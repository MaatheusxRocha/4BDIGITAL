
jQuery(function($){
	var selection = false;
	var uf_epicoShortcodePanel = $('#uf-epico-shortcode-panel-tmpl').html();

	$('body').append(uf_epicoShortcodePanel);
	$('.media-modal-backdrop, .media-modal-close').on('click', function(){
		uf_epico_hideModal();
	})
	$(document).keyup(function(e) {
		if (e.keyCode == 27) {
			uf_epico_hideModal();
		}
	});

	// show modal
	$(document).on('click', '#uf-epico-shortcodeinsert', function(){
		if($(this).data('shortcode')){
			window.send_to_editor('['+$(this).data('shortcode')+']');
			return;
		}
				
		// autoload item
		var autoload = $('.uf-epico-autoload');
		if(autoload.length){
			uf_epico_loadtemplate(autoload.data('shortcode'));
		}
		$('#uf-epico-category-selector').on('change', function(){
			uf_epico_loadtemplate('');
			$('.uf-epico-elements-selector').hide();
			$('#uf-epico-elements-selector-'+this.value).show().val('');
		});

		$('.uf-epico-elements-selector').on('change', function(){
			uf_epico_loadtemplate(this.value);
		});

		if(typeof tinyMCE !== 'undefined'){
			if(tinyMCE.activeEditor !== null){
				selection = tinyMCE.activeEditor.selection.getContent();
			}else{
				selection = false;
			}
		}else{
			selection = false;
		}
		if(selection.length > 0){
			$('#uf-epico-content').html(selection);
		}
		$('#uf-epico-shortcode-panel').show();
	});
	$('#uf-epico-insert-shortcode').on('click', function(){
		uf_epico_sendCode();
	})
	// modal tabs
	$('#uf-epico-shortcode-config').on('click', '.uf-epico-shortcode-config-nav li a', function(){
		$('.uf-epico-shortcode-config-nav li').removeClass('current');
		$('.group').hide();
		$(''+$(this).attr('href')+'').show();
		$(this).parent().addClass('current');
		return false;
	});


});

function uf_epico_loadtemplate(shortcode){
	var target = jQuery('#uf-epico-shortcode-config');
	if(shortcode.length <= 0){
		target.html('');
	}
	target.html(jQuery('#uf-epico-'+shortcode+'-config-tmpl').html());
}

function uf_epico_sendCode(){

	var shortcode = jQuery('#uf-epico-shortcodekey').val(),
		output = '['+shortcode,
		ctype = '',
		fields = {};
	
	if(shortcode.length <= 0){return; }

	if(jQuery('#uf-epico-shortcodetype').val() === '2'){
		ctype = jQuery('#uf-epico-default-content').val()+'[/'+shortcode+']';
	}
	jQuery('#uf-epico-shortcode-config input,#uf-epico-shortcode-config select,#uf-epico-shortcode-config textarea').not('.configexclude').each(function(){
		if(this.value){
			// see if its a checkbox
			var thisinput = jQuery(this),
				attname = this.name;

			if(thisinput.prop('type') == 'checkbox'){
				if(!thisinput.prop('checked')){
					return;
				}
			}
			if(thisinput.prop('type') == 'radio'){
				if(!thisinput.prop('checked')){
					return;
				}
			}

			if(attname.indexOf('[') > -1){
				attname = attname.split('[')[0];
				var newloop = {};
				newloop[attname] = this.value;
				if(!fields[attname]){
					fields[attname] = [];
				}
				fields[attname].push(newloop);
			}else{
				var newfield = {};
				fields[attname] = this.value;
			}
		}
	});
	for( var field in fields){
		if(typeof fields[field] == 'object'){
			for(i=0;i<fields[field].length; i++){
				output += ' '+field+'_'+(i+1)+'="'+fields[field][i][field]+'"';
			}
		}else{
			output += ' '+field+'="'+fields[field]+'"';
		}
	}
	uf_epico_hideModal();
	window.send_to_editor(output+']'+ctype);

}
function uf_epico_hideModal(){
	jQuery('#uf-epico-shortcode-panel').hide();
	uf_epico_loadtemplate('');
	jQuery('#uf-epico-elements-selector').show();
	jQuery('.uf-epico-elements-selector').val('');	
	jQuery('#uf-epico-category-selector').val('');
}
