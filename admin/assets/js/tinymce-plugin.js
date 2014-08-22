(function() {
	tinymce.create('tinymce.plugins.Movie_Discovery', {
		init : function(ed, url) {
			ed.addButton('Movie_Discovery', {
				title : 'Movie_Discovery.movie',
				image : url+'/../img/md-icon.png',
				onclick : function() {
                                    var cmsURL = window.location.toString();
                                    //alert(url.substring(0, url.length -2) );
                                    ed.windowManager.open({
                                            file : url.substring(0, url.length -2) + "../views/movie_selector.php",
                                            title : 'Movie Discovery | Movie Selector',
                                            width : 620,  // Your dimensions may differ - toy around with them!
                                            height : 380,
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
		},
		mceInsertMdContent: function() {
			alert ("test");
			return 'test';
		}
	});
	tinymce.PluginManager.add('Movie_Discovery', tinymce.plugins.Movie_Discovery);
})();