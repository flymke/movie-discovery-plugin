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
           border:1px solid #555;
           height:30px;
           line-height:30px;
        }
        
        select {
           height:30px;            
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
            font-size: 12px;
            font-style: italic;
            margin-top: 3px;
            padding: 0 0px;
            width: 90%;
        }
        
    </style>
    </head>
<body>
<form>
    
    <div>
        <label for="md_provider">Select provider:</label>
        <select name="md_provider">
            <option value="md">Movie Discovery</option>
        </select>
        <small>Select the provider where to get the movie from</small>
    </div>
    
    <div>
        <label for="md_text_by_keyword">Insert a movie by keyword(s):</label>
        <input type="text" id="md_text_by_keyword" name="md_text_by_keyword" />
        <a href="#">Look up</a>
        <small>Inserts a movie by specifying keyword(s). For multiple keywords, please separate them with Comma.</small>
    </div>
    
    <div>
        <label for="md_text_by_id">Insert by specific ID:</label>
        <input type="text" id="md_text_by_id" name="md_text_by_id" />
        <small>Inserts a movie by specifying the ID. For this purpose you have to know the ID. Please see http://www.movie-discovery.com to obtain the right ID.</small>
    </div>
    
    </form>
    
    <p>Your Affiliate id: <strong>1234</strong></p>
    
</body>
</html>