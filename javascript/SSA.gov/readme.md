* *[Example](http://ssa.gov/data/)*

* *Instructions - basic*

Here is the stripped down version of the page.  It just contains the table at the bottom.  The CSS and JS files need to be in separate folders one level below the index.html page.  The JSON file needs to be one level higher than the index.html. 
 
He should grab the current CSS and JS files from the public site and update the index.html below since I made a single CSS for testing.  The JS files can be downloaded directly from jQuery or use our public site.  Just make sure to update the references in the HTML page.
 
At this time we are using the reference key to create links under the title and Learn More section (should change to LandingPage but we need to review all the information).  If the reference key is not populated it will not create the links.  For the downloads column we created a new key called formatDisplay for readability.  They can change it to format but it’s not very readable since they wanted the mime types.  I think the format of our JSON file matches the schema from Project Open Data. 

-------------

* *Instructions - Complex*


The data is pulled directly from the data.json file.  If you look in the script.js file the second line reads in the data.json.
 
$.getJSON("../data.json", {}, function (data)
 
As long as the data.json file is at the root of the agency and the /data page is a folder level down it will work (you can move the location but need to update the highlighted section above).  Setup a folder structure.  Also, you can do this on your computer and it will still work. 
 
www.ssa.gov (root)  (data.json file is placed in the root directory)   
* www.ssa.gov/data  (Index.html is place in the data folder)   
  * www.ssa.gov/data/css  (Place CSS files in this folder)   
  * www.ssa.gov/data/js   (Place javascript files here)   


Make sure the following lines are included in the index.html file within the <head> tag.
```
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
``` 
The first is the jquery script files which allows you to read the JSON file.  The second is the custom script file to read the JSON file and implement the data table.  The last is the formatting for the data table like you mentioned below.
