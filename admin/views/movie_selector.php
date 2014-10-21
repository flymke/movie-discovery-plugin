<?php
/**
 * Movie Selector Popup
 *
 * Movie Discovery
 *
 * @package   Movie_Discovery
 * @author    Michael Schoenrock <hello@michaelschoenrock.com>
 * @license   GPL-2.0+
 * @link      https://github.com/flymke/movie-discovery-plugin
 * @copyright 2014 Michael Schoenrock
 */
?>
<html>
    <head>
    <style>
        
        * {
            font-family: 'Open Sans', sans-serif;
            color:rgb(68, 68, 68);
            background:#fcfcfc;
        }
        
        html {
            padding:10px;
        }
        
        input[type="text"] {
           border:1px solid #ccc;
           height:30px;
           line-height:30px;
           margin-left:0;
        }
        
        select {
           height:30px;
           margin-left:0;
        }
        
        label {
            color:rgb(68, 68, 68);
            font-size:13px;
            display:block;
            margin-bottom:5px;
        }
        
        form {
            border-bottom:1px solid #ccc
        }
        
        form div {
            margin-bottom:20px;
        }
        
        form a {
            color: #009dce;
            font-size: 12px;
            font-weight: bold;
        }
        
        form small {
            display: block;
            font-size: 11px;
            margin-top: 3px;
            padding: 0 0px;
            width: 90%;
        }
        
        .md_results {
            position: absolute;
            right: 15px;
            top: 15px;
            height: 270px;
            width: 250px;
            border: 1px solid #ccc;
            display: none;
            overflow-y: auto;
            font-size:12px;
            padding:5px;
        }
        
        .md_results h3 {
            font-size:12px;
            font-weight:bold;
            margin:0 0 10px 0;
            color:#2ebd5a;
        }
        
        .md_results ul {
            list-style:none;
            padding:0;
            margin:0;
        }
        
        .md_results ul li {
            padding:0;
            margin:0;
        }
        
        .button-primary {
            background: #2ea2cc;
            border-color: #0074a2;
            -webkit-box-shadow: inset 0 1px 0 rgba(120,200,230,.5),0 1px 0 rgba(0,0,0,.15);
            box-shadow: inset 0 1px 0 rgba(120,200,230,.5),0 1px 0 rgba(0,0,0,.15);
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
            -webkit-border-radius: 3px;
            white-space: nowrap;
            cursor: pointer;
            border-width: 1px;
            border-style: solid;
            -webkit-appearance: none;
            cursor: pointer;
            border-width: 1px;
            border-style: solid;
            margin:0;
            position:absolute;
            bottom:30px;
            right:18px;
            font-size:13px;
        }

    </style>
    </head>
<body>
<form>
    
    <div>
        <label for="md_provider">Select a provider:</label>
        <select class="md_provider" name="md_provider">
            <option value="all">All</option>
            <option value="">---</option>
            <option value="md">Movie Discovery</option>
            <option value="supermovies">Super Movies</option>
        </select>
        <small>Select a movie provider.<br />We provide only Movie Discovery at the moment.</small>
    </div>
    
    <div>
        <label for="md_text_by_keyword">Insert a movie by keyword(s):</label>
        <input type="text" id="md_text_by_keyword" name="md_text_by_keyword" />
        <small>Inserts a movie by specifying keyword(s).<br />
        For multiple keywords, please separate them by comma.<br />
        They will later be displayed individually.</small>
    </div>
    
    <div>
        <label for="md_text_by_id">Insert a specific movie:</label>
        <input type="text" id="md_text_by_id" name="md_text_by_id" />
        <small>Inserts a specific movie. Please type in to search.</small>
    </div>
    
    </form>

    <div class="md_results"></div>
    
    <input name="save" type="submit" class="button button-primary button-large md_insert" id="publish" accesskey="p" value="Insert to post/page" />
        
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <script>
        $(function() {
            
            var minlength = 3;
            
            $('input#md_text_by_keyword').keyup(function() {
                var that = this,
                value = $(this).val();
                
                var provider = $('.md_provider').val();
                
                if ( value.length >= minlength ) {
                    value = value.replace(",", "|");
                    value = value.replace(".", "|");
                    value = value.replace(/ /g,''); // replace all spaces
                    
                    $('.md_results').fadeIn();
                    $.getJSON( "ajax_data.php?k=" + value + "&p=" + provider, function( data ) {
                        
                        var list = '';
                        $.each( data, function( key, val ) {
                            list += '<li id="' + key + '">' + val.title + '</li>';
                        });
                            
                        $('.md_results').html('<h3>Possible movies that could match your keywords are:</h3><ul>' + list + '</ul>');
                        
                    });
                }
                
                else {
                    $('.md_results').html('');
                    $('.md_results').fadeOut();
                }
            
            });
            
            $('input#md_text_by_id').keyup(function() {
                var that = this,
                value = $(this).val();
                
                var provider = $('.md_provider').val();
                
                if ( value.length >= minlength ) {
                    value = value.replace(",", "|");
                    value = value.replace(".", "|");
                    value = value.replace(/ /g,''); // replace all spaces
                    $('.md_results').fadeIn();
                    $.getJSON( "ajax_data.php?m=" + value + "&p=" + provider, function( data ) {
                        
                        var list = '';
                        $.each( data, function( key, val ) {
                            list += '<option value="' + val.id + '">' + val.title + '</option>';
                        });
                            
                        $('.md_results').html('<h3>Search result:</h3><select id="md_movie_select">' + list + '</select>');
                        
                    
                    });
                }
                
                else {
                    $('.md_results').html('');
                    $('.md_results').fadeOut();
                }
            
            });
            
            $('.md_insert').click(function() {
                
                var keywords = $('input#md_text_by_keyword').val();
                keywords = keywords.replace(",", "|");
                keywords = keywords.replace(".", "|");
                keywords = keywords.replace(/ /g,''); // replace all spaces
                
                var movie = $('input#md_text_by_id').val();
                movie = movie.replace(",", "|");
                movie = movie.replace(".", "|");
                movie = movie.replace(/ /g,''); // replace all spaces
                
                if (movie.length > 0 && keywords.length > 0) {
                    alert('Please enter either keywords or a movie.');
                }
                else {
                        
                    var provider = $('.md_provider').val();
                    
                    if (keywords.length > 0 ) {
                        var mdShortcodeContent = '[md src="'+ provider +'" keywords="'+ keywords +'"]';
                    } 
                    if (movie.length > 0 ) {
                        var md_id = $('select#md_movie_select option:selected').val();
                        var mdShortcodeContent = '[md src="movie-discovery" id="'+ md_id +'"]';
                    }
                    
                    parent.tinyMCE.activeEditor.insertContent(mdShortcodeContent, {format : 'raw'});
                    parent.tinyMCE.activeEditor.windowManager.close(window);
                    
                }
                
            });
        });
    </script>
    
</body>
</html>