Interim Notes
-------

[[Note Example here](http://www.geoplatform.gov/node/201/%26fq%3Dmetadata_type%3A%22geospatial%22%2BAND%2B)]
 
Find attached CKAN integration module, module acts as an interface between drupal and ckan.  It is used on geoplatform.gov to query ckan metadata.
There are three configuration options that come with this module (other options as facet names etc. are not configurable at this stage, but could be modified)
@ /admin/config/content/ckan_info
 
*Results per page — number of search results per page
*Default Server — ckan url (http://catalog.data.gov/)
*Organization Server Address -- The address to get the organization structure in a JSON format (http://idm.data.gov/agency.json)
 
The module provides a bunch of blocks that need to be arranged on a page.
 
I.e. http://geoplatform.gov/data
On this page, we are using panels module (https://drupal.org/project/panels) to divide the page in two rows (25% left and 75% right)
Ckan filter blocks were added to the left; page results, pagination, number of results, search blocks were added to the right.
Some css (theming) work has been done so that the interface looks exactly like the ckan dataset search page, and is part of the geoplatform theme.
Any potentials drupal website that will use this module will need to add some css styling to the theme (another option would be to include styling in a separate css within ckan_integration module).
 




