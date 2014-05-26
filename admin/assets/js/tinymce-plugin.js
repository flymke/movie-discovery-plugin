(function() {
	tinymce.create('tinymce.plugins.Movie_Discovery', {
		init : function(ed, url) {
			ed.addButton('Movie_Discovery', {
				title : 'Movie_Discovery.movie',
				image : url+'/../img/md-icon.png',
				onclick : function() {
                                    var cmsURL = window.location.toString();
                                    //alert(url.substring(0, url.length -2) );
                                    //=http://127.0.0.1:8080/_mymoviepage/wp-content/plugins/movie-discovery/admin/assets/
                                    ed.windowManager.open({
                                            file : url.substring(0, url.length -2) + "../views/movie_selector.php",
                                            title : 'Movie Selector',
                                            width : 420,  // Your dimensions may differ - toy around with them!
                                            height : 400,
                                            resizable : "yes",
                                            inline : "yes",  // This parameter only has an effect if you use the inlinepopups plugin!
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
				longname : "Brett's YouTube Shortcode",
				author : 'Brett Terpstra',
				authorurl : 'http://brettterpstra.com/',
				infourl : 'http://brettterpstra.com/',
				version : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('Movie_Discovery', tinymce.plugins.Movie_Discovery);
})();