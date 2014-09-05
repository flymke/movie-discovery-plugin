(function() {
	tinymce.create('tinymce.plugins.Movie_Discovery', {
		init : function(ed, url) {
			ed.addButton('Movie_Discovery', {
				title : 'Insert movie',
				image : url+'/../img/md-icon.png',
				onclick : function() {
                                    var cmsURL = window.location.toString();
                                    ed.windowManager.open({
                                            file : url.substring(0, url.length -2) + "../views/movie_selector.php",
                                            title : 'Insert movie',
                                            width : 620,
                                            height : 380,
                                            resizable : "yes",
                                            inline : "no",  // This parameter only has an effect if you use the inlinepopups plugin!
                                            close_previous : "no"
                                        }, {
                                            plugin_url : url 
                                        });
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
				longname : 'Movie Discovery',
				author : 'Michael Schoenrock',
				authorurl : 'http://www.michaelschoenrock.com/',
				infourl : 'http://www.michaelschoenrock.com/',
				version : '1.0.0'
			};
		}
	});
	tinymce.PluginManager.add('Movie_Discovery', tinymce.plugins.Movie_Discovery);
})();