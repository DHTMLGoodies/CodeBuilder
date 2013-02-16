#CodeBuilder

The code builder has been created for LudoJS and DHTML Chess, but it works as a base for other
frameworks built on LudoJS.

Each software in the Code builder is represented by a config class implementing the PackageInterface interface. Based on
the configurations, the code builder will:

* Generate one Javascript file of all the small Javascript resource files.
* Generate one CSS file from multiple CSS files.
* Generated minimized Javascript and CSS files.
* Copy image files from LudoJS to local frameworks.
* Embed the necessary resource files from LudoJS when building for other frameworks, copy images files
and modify file paths in CSS files.

##LudoDBService

The Code builder is a LudoDBService(see the LudoDB framework) implementing two services, __build__ and __minify__. After making changes
to the code base of LudoJS or DHTML Chess, the services

```
http://<hostname>)/code-builder/Builder/DHTMLChess/minify
http://<hostname>)/code-builder/Builder/DHTMLChess/build
```

can be executed directly from the Web browser.

###Folder structure
The code builder requires that the software are located inside a top folder corresponding to the name of the software, example:

DhtmlChess -> folder dhtml-chess
LudoJS -> folder ludojs
LudoJs -> folder ludo-js

Other arrangement can be made by returning static value from the getName() method.
